<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Chapter;
use App\Models\MockTest;
use App\Models\Certificate;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $subjects = Subject::withCount('chapters')->orderBy('order')->get();
        $chapters = Chapter::with('subject')->orderBy('chapter_number')->get();
        $freeChaptersCount = Chapter::where('is_free_preview', true)->count();
        $mockTestsCount = MockTest::count();

        return view('welcome', compact('subjects', 'chapters', 'freeChaptersCount', 'mockTestsCount'));
    }

    public function courses()
    {
        $subjects = Subject::with(['chapters' => function($query) {
            $query->orderBy('chapter_number');
        }])->orderBy('order')->get();

        return view('courses', compact('subjects'));
    }

    public function freeContent()
    {
        $freeChapters = Chapter::where('is_free_preview', true)->with('subject')->get();
        $freeMockTest = MockTest::where('is_free', true)->first();

        return view('free-content', compact('freeChapters', 'freeMockTest'));
    }

    public function verifyCertificate(Request $request)
    {
        $searchCode = $request->input('code');
        $certificate = null;

        if ($searchCode) {
            $certificate = Certificate::where('certificate_code', trim($searchCode))->with('user')->first();
        }

        return view('verify-certificate', compact('certificate', 'searchCode'));
    }

    public function examInfo()
    {
        return view('exam-info');
    }

    public function contact()
    {
        return view('contact');
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        $chapters = Chapter::where('title_hi', 'LIKE', "%{$query}%")
            ->orWhere('title_en', 'LIKE', "%{$query}%")
            ->get();

        return response()->json([
            'query' => $query,
            'results' => $chapters,
        ]);
    }
}
