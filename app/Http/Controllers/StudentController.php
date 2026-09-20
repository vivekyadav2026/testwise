<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Chapter;
use App\Models\MockTest;
use App\Models\Question;
use App\Models\TestAttempt;
use App\Models\Certificate;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class StudentController extends Controller
{
    private function getStudentUser()
    {
        $user = Auth::user();
        if (!$user) {
            abort(403, 'Unauthorized. Please login first.');
        }
        return $user;
    }

    public function dashboard()
    {
        $user = $this->getStudentUser();

        $totalChapters = Chapter::count();
        $completedAttempts = TestAttempt::where('user_id', $user->id)->get();
        $completedChaptersCount = TestAttempt::where('user_id', $user->id)
            ->where('test_type', 'chapter')
            ->distinct('chapter_id')
            ->count();

        $overallAccuracy = $completedAttempts->avg('accuracy_percentage') ?: 0;
        $totalStudySeconds = $completedAttempts->sum('time_taken_seconds');
        $totalStudyMinutes = floor($totalStudySeconds / 60);

        $mockTests = MockTest::orderBy('test_number')->get();
        $mockAttempts = TestAttempt::where('user_id', $user->id)
            ->where('test_type', 'full_mock')
            ->get()
            ->keyBy('mock_test_id');

        $subjects = Subject::with('chapters')->get();
        foreach ($subjects as $sub) {
            $chapterIds = $sub->chapters->pluck('id');
            $done = TestAttempt::where('user_id', $user->id)
                ->whereIn('chapter_id', $chapterIds)
                ->distinct('chapter_id')
                ->count();
            $sub->completed_chapters = $done;
            $sub->total_count = $sub->chapters->count();
            $sub->percentage = $sub->total_count > 0 ? round(($done / $sub->total_count) * 100) : 0;
        }

        $recentAttempts = TestAttempt::where('user_id', $user->id)
            ->with(['chapter', 'mockTest'])
            ->latest()
            ->take(5)
            ->get();

        $certificate = Certificate::where('user_id', $user->id)->first();

        // Weak topics count
        $weakCount = 2; // e.g. MP Rivers & Speed Distance

        return view('student.dashboard', compact(
            'user',
            'totalChapters',
            'completedChaptersCount',
            'overallAccuracy',
            'totalStudyMinutes',
            'mockTests',
            'mockAttempts',
            'subjects',
            'recentAttempts',
            'certificate',
            'weakCount'
        ));
    }

    public function course(Request $request)
    {
        $user = $this->getStudentUser();

        $selectedSubject = $request->input('subject', 'all');
        $query = Chapter::with('subject')->orderBy('chapter_number');

        if ($selectedSubject !== 'all') {
            $query->whereHas('subject', function($q) use ($selectedSubject) {
                $q->where('code', $selectedSubject);
            });
        }

        $chapters = $query->get();
        $subjects = Subject::orderBy('order')->get();

        $userAttempts = TestAttempt::where('user_id', $user->id)
            ->where('test_type', 'chapter')
            ->get()
            ->keyBy('chapter_id');

        return view('student.chapter-tests', compact('user', 'chapters', 'subjects', 'selectedSubject', 'userAttempts'));
    }

    public function readNotes($id)
    {
        $user = $this->getStudentUser();
        $chapter = Chapter::with('subject')->findOrFail($id);

        if (!$chapter->is_free_preview && !$user->is_pro) {
            return redirect()->route('student.course')->with('error', 'यह अध्याय Pro सब्सक्रिप्शन के साथ अनलॉक होगा! (This chapter requires Pro unlock ₹499)');
        }

        return view('student.notes', compact('user', 'chapter'));
    }

    public function mockTests()
    {
        $user = $this->getStudentUser();
        $mockTests = MockTest::orderBy('test_number')->get();
        $userAttempts = TestAttempt::where('user_id', $user->id)
            ->where('test_type', 'full_mock')
            ->get()
            ->keyBy('mock_test_id');

        return view('student.mock-tests', compact('user', 'mockTests', 'userAttempts'));
    }

    public function takeCbtTest($type, $id)
    {
        $user = $this->getStudentUser();

        if ($type === 'chapter') {
            $item = Chapter::with('subject')->findOrFail($id);
            if (!$item->is_free_preview && !$user->is_pro) {
                return redirect()->route('student.course')->with('error', 'यह टेस्ट केवल Pro सदस्यों के लिए उपलब्ध है। (Unlock for ₹499)');
            }
            $questions = Question::where('chapter_id', $id)->get();
            if ($questions->count() == 0) {
                // Fallback sample questions
                $questions = Question::whereNotNull('subject_id')->take(10)->get();
            }
            $title = $item->title_hi;
            $durationMinutes = $item->duration_minutes ?: 20;
        } else {
            $item = MockTest::findOrFail($id);
            if (!$item->is_free && !$user->is_pro) {
                return redirect()->route('student.mock-tests')->with('error', 'यह फुल मॉक टेस्ट Pro सब्सक्रिप्शन के साथ उपलब्ध है।');
            }
            $questions = Question::where('mock_test_id', $id)->get();
            if ($questions->count() == 0) {
                $questions = Question::take(20)->get();
            }
            $title = $item->title_hi;
            $durationMinutes = $item->duration_minutes ?: 120;
        }

        return view('student.cbt-engine', compact('user', 'type', 'id', 'item', 'questions', 'title', 'durationMinutes'));
    }

    public function submitCbtTest(Request $request, $type, $id)
    {
        $user = $this->getStudentUser();
        $answers = $request->input('answers', []);
        $timeTaken = (int) $request->input('time_taken_seconds', 300);

        if ($type === 'chapter') {
            $chapter = Chapter::findOrFail($id);
            $questions = Question::where('chapter_id', $id)->get();
            if ($questions->count() == 0) {
                $questions = Question::take(10)->get();
            }
            $totalQuestions = $questions->count();
        } else {
            $mockTest = MockTest::findOrFail($id);
            $questions = Question::where('mock_test_id', $id)->get();
            if ($questions->count() == 0) {
                $questions = Question::take(20)->get();
            }
            $totalQuestions = $questions->count();
        }

        $correctCount = 0;
        $attemptedCount = 0;
        $wrongCount = 0;
        $processedAnswers = [];

        foreach ($questions as $q) {
            $userAns = $answers[$q->id] ?? null;
            $isCorrect = false;

            if ($userAns) {
                $attemptedCount++;
                if (strtoupper($userAns) === strtoupper($q->correct_option)) {
                    $correctCount++;
                    $isCorrect = true;
                } else {
                    $wrongCount++;
                }
            }

            $processedAnswers[$q->id] = [
                'user_option' => $userAns,
                'correct_option' => $q->correct_option,
                'is_correct' => $isCorrect,
            ];
        }

        $score = $correctCount;
        $percentage = $totalQuestions > 0 ? round(($score / $totalQuestions) * 100, 2) : 0;
        $accuracy = $attemptedCount > 0 ? round(($correctCount / $attemptedCount) * 100, 2) : 0;

        $attempt = TestAttempt::create([
            'user_id' => $user->id,
            'test_type' => $type === 'chapter' ? 'chapter' : 'full_mock',
            'chapter_id' => $type === 'chapter' ? $id : null,
            'mock_test_id' => $type === 'full_mock' ? $id : null,
            'total_questions' => $totalQuestions,
            'attempted_questions' => $attemptedCount,
            'correct_answers' => $correctCount,
            'wrong_answers' => $wrongCount,
            'score' => $score,
            'total_marks' => $totalQuestions,
            'percentage' => $percentage,
            'accuracy_percentage' => $accuracy,
            'time_taken_seconds' => $timeTaken,
            'answers_json' => $processedAnswers,
            'completed_at' => Carbon::now(),
        ]);

        return redirect()->route('student.test-result', $attempt->id);
    }

    public function testResult($attemptId)
    {
        $user = $this->getStudentUser();
        $attempt = TestAttempt::where('user_id', $user->id)
            ->with(['chapter', 'mockTest'])
            ->findOrFail($attemptId);

        if ($attempt->test_type === 'chapter' && $attempt->chapter_id) {
            $questions = Question::where('chapter_id', $attempt->chapter_id)->get();
        } else if ($attempt->mock_test_id) {
            $questions = Question::where('mock_test_id', $attempt->mock_test_id)->get();
        } else {
            $questions = Question::take(10)->get();
        }

        return view('student.test-result', compact('user', 'attempt', 'questions'));
    }

    public function mistakes()
    {
        $user = $this->getStudentUser();
        // Extract wrong questions from user's attempts
        $attempts = TestAttempt::where('user_id', $user->id)->get();
        $wrongQuestionIds = [];

        foreach ($attempts as $att) {
            if ($att->answers_json) {
                foreach ($att->answers_json as $qId => $data) {
                    if (isset($data['is_correct']) && !$data['is_correct'] && $data['user_option']) {
                        $wrongQuestionIds[] = $qId;
                    }
                }
            }
        }

        $mistakeQuestions = Question::whereIn('id', array_unique($wrongQuestionIds))->with('subject')->get();

        return view('student.mistakes', compact('user', 'mistakeQuestions'));
    }

    public function weakTopics()
    {
        $user = $this->getStudentUser();

        // Sample weak topics identified for MP Police GD
        $attempts = TestAttempt::where('user_id', $user->id)->whereNotNull('chapter_id')->with('chapter.subject')->get();
        $chapterStats = [];

        foreach ($attempts as $attempt) {
            $ch = $attempt->chapter;
            if (!$ch) continue;

            $cid = $ch->id;
            if (!isset($chapterStats[$cid])) {
                $chapterStats[$cid] = [
                    'subject' => $ch->subject ? $ch->subject->name_hi : 'General',
                    'topic_hi' => $ch->title_hi,
                    'total_attempted' => 0,
                    'total_correct' => 0,
                ];
            }
            $chapterStats[$cid]['total_attempted'] += $attempt->attempted_questions;
            $chapterStats[$cid]['total_correct'] += $attempt->correct_answers;
        }

        $weakTopics = [];
        foreach ($chapterStats as $cid => $stats) {
            if ($stats['total_attempted'] > 0) {
                $acc = round(($stats['total_correct'] / $stats['total_attempted']) * 100);
                if ($acc < 70) {
                    $weakTopics[] = [
                        'subject' => $stats['subject'],
                        'topic_hi' => $stats['topic_hi'],
                        'accuracy' => $acc,
                        'total_questions' => $stats['total_attempted'], // User's total attempts
                    ];
                }
            }
        }
        
        usort($weakTopics, function($a, $b) {
            return $a['accuracy'] <=> $b['accuracy'];
        });

        return view('student.weak-topics', compact('user', 'weakTopics'));
    }

    public function certificate()
    {
        $user = $this->getStudentUser();
        $certificate = Certificate::where('user_id', $user->id)->first();

        if (!$certificate) {
            $accuracy = \App\Models\TestAttempt::where('user_id', $user->id)->avg('accuracy_percentage') ?: 85.0;

            $certificate = Certificate::create([
                'user_id' => $user->id,
                'certificate_code' => 'TW-CERT-' . date('Y') . '-' . strtoupper(\Illuminate\Support\Str::random(6)),
                'course_name' => 'MP Police Constable GD 2026',
                'issue_date' => \Carbon\Carbon::now(),
                'score_achieved' => round($accuracy, 1),
                'is_verified' => true,
            ]);
        }

        return view('student.certificate', compact('user', 'certificate'));
    }

    public function performance()
    {
        $user = $this->getStudentUser();
        $attempts = TestAttempt::where('user_id', $user->id)->latest()->get();

        return view('student.performance', compact('user', 'attempts'));
    }

    public function unlockPro(Request $request)
    {
        $user = $this->getStudentUser();
        $user->is_pro = true;
        $user->save();

        Payment::create([
            'user_id' => $user->id,
            'order_id' => 'ORD_' . date('Y') . '_' . rand(10000, 99999),
            'amount' => 499.00,
            'payment_method' => 'UPI',
            'status' => 'PAID',
            'transaction_ref' => 'order_' . uniqid(),
        ]);

        return redirect()->back()->with('success', 'बधाई हो! आपका MP Police Constable GD 2026 Pro कोर्स सफलतापूर्वक अनलॉक हो गया है!');
    }

    public function profile()
    {
        $user = $this->getStudentUser();
        return view('student.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = $this->getStudentUser();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'goal' => 'nullable|string|max:255',
            'daily_study_goal_minutes' => 'nullable|integer|min:10',
        ]);

        $user->update($validated);
        return redirect()->back()->with('success', 'आपकी प्रोफाइल जानकारी सफलतापूर्वक अपडेट कर दी गई है।');
    }

    public function updatePassword(Request $request)
    {
        $user = $this->getStudentUser();
        
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        if (!\Illuminate\Support\Facades\Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'वर्तमान पासवर्ड गलत है।']);
        }

        $user->update([
            'password' => \Illuminate\Support\Facades\Hash::make($request->new_password)
        ]);

        return redirect()->back()->with('success', 'आपका पासवर्ड सफलतापूर्वक बदल दिया गया है।');
    }
}
