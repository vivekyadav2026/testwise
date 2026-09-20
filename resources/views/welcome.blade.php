@extends('layouts.app')

@section('title', 'Testwise - MP Police Constable GD 2026 Complete Course & Test Engine')

@section('content')
<!-- Hero Section -->
<section class="relative pt-12 pb-20 overflow-hidden" style="background-color: var(--theme-bg);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Left Hero Content -->
            <div class="lg:col-span-7 space-y-6">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-extrabold tracking-wide uppercase" style="background-color: var(--teal-soft); color: var(--teal); border: 1px solid var(--teal);">
                    <span class="w-2 h-2 rounded-full animate-pulse" style="background-color: var(--teal);"></span>
                    MP POLICE GD ONLINE BATCH 2026
                </div>

                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-tight" style="color: white !important;">
                    MP Police Constable <span style="color: var(--theme-active);">GD 2026</span>
                </h1>

                <p class="text-lg font-medium leading-relaxed" style="color: rgba(255,255,255,0.7);">
                    Complete Preparation Course with Chapter-wise Notes & Tests | 32 अध्यायवार नोट्स व 10 फुल सीबीटी मॉक टेस्ट
                </p>

                <!-- Highlights Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                    <div class="flex items-center gap-2.5 text-sm" style="color: rgba(255,255,255,0.8);">
                        <div class="w-5 h-5 rounded-full flex items-center justify-center text-xs" style="background-color: rgba(255,255,255,0.1); color: var(--theme-active);">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <span>Complete Written Coverage</span>
                    </div>
                    <div class="flex items-center gap-2.5 text-sm" style="color: rgba(255,255,255,0.8);">
                        <div class="w-5 h-5 rounded-full flex items-center justify-center text-xs" style="background-color: rgba(255,255,255,0.1); color: var(--theme-active);">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <span>Chapter-wise Mock Tests</span>
                    </div>
                    <div class="flex items-center gap-2.5 text-sm" style="color: rgba(255,255,255,0.8);">
                        <div class="w-5 h-5 rounded-full flex items-center justify-center text-xs" style="background-color: rgba(255,255,255,0.1); color: var(--theme-active);">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <span>Performance Analytics & Weak Topics</span>
                    </div>
                    <div class="flex items-center gap-2.5 text-sm" style="color: rgba(255,255,255,0.8);">
                        <div class="w-5 h-5 rounded-full flex items-center justify-center text-xs" style="background-color: rgba(255,255,255,0.1); color: var(--theme-active);">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <span>10 Full-length CBT Mocks</span>
                    </div>
                </div>

                <!-- CTA Buttons -->
                <div class="flex flex-wrap gap-4 pt-4">
                    <a href="{{ route('login') }}" class="btn btn-gold text-sm shadow-xl">
                        <span>Start Learning Free</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                    <a href="{{ route('courses') }}" class="btn px-6 py-3.5 border text-sm" style="background-color: transparent; border-color: rgba(255,255,255,0.2); color: white;">
                        View Course Details
                    </a>
                </div>
            </div>

            <!-- Right Hero Card -->
            <div class="lg:col-span-5">
                <div class="p-6 sm:p-8 rounded-3xl shadow-2xl space-y-6 relative" style="background-color: white; border: 1px solid var(--border-color);">
                    <div class="flex items-center justify-between">
                        <span class="px-3 py-1 rounded-full text-xs font-bold" style="background-color: var(--rose-soft); color: var(--rose); border: 1px solid var(--rose);">
                            SPECIAL LAUNCH OFFER
                        </span>
                        <span class="text-xs" style="color: var(--text-muted);">Limited Seats Available</span>
                    </div>

                    <div class="space-y-1">
                        <h3 class="text-xl font-extrabold" style="color: var(--text-main) !important;">MP Police GD Complete Pass</h3>
                        <p class="text-xs" style="color: var(--text-muted);">32 अध्यायों के नोट्स, टेस्ट और 10 फुल सीबीटी मॉक टेस्ट का एक्सेस</p>
                    </div>

                    <div class="flex items-baseline gap-3">
                        <span class="text-4xl font-black" style="color: var(--text-main) !important;">₹499</span>
                        <span class="text-lg line-through" style="color: var(--text-muted);">₹1,499</span>
                        <span class="px-2 py-0.5 rounded text-xs font-bold" style="background-color: var(--teal-soft); color: var(--teal);">66% OFF</span>
                    </div>

                    <form action="{{ route('student.unlock-pro') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full py-3.5 btn btn-gold text-sm font-extrabold justify-center gap-2">
                            <i class="fa-solid fa-bolt"></i> Unlock Course Now (₹499)
                        </button>
                    </form>

                    <div class="pt-2 grid grid-cols-2 gap-2 text-xs" style="border-top: 1px solid var(--border-color); color: var(--text-muted);">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-infinity" style="color: var(--gold-deep);"></i>
                            <span>1 Year Full Validity</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-mobile-screen-button" style="color: var(--gold-deep);"></i>
                            <span>Mobile & PC Access</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Quick Stats Bar -->
<section class="py-10" style="background-color: var(--bg-card); border-bottom: 1px solid var(--border-color);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
        <div class="p-4 rounded-2xl space-y-1 panel">
            <div class="text-3xl font-black" style="color: var(--theme-bg);">32</div>
            <div class="text-xs font-bold" style="color: var(--text-muted);">अध्यायवार नोट्स (Notes)</div>
        </div>
        <div class="p-4 rounded-2xl space-y-1 panel">
            <div class="text-3xl font-black" style="color: var(--theme-bg);">32</div>
            <div class="text-xs font-bold" style="color: var(--text-muted);">चैप्टर प्रैक्टिस टेस्ट</div>
        </div>
        <div class="p-4 rounded-2xl space-y-1 panel">
            <div class="text-3xl font-black" style="color: var(--theme-active);">10</div>
            <div class="text-xs font-bold" style="color: var(--text-muted);">फुल मॉक टेस्ट (CBT)</div>
        </div>
        <div class="p-4 rounded-2xl space-y-1 panel">
            <div class="text-3xl font-black" style="color: var(--teal);">100%</div>
            <div class="text-xs font-bold" style="color: var(--text-muted);">नवीनतम परीक्षा पैटर्न</div>
        </div>
    </div>
</section>

<!-- Course Overview -->
<section class="py-16" style="background-color: var(--bg-main);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        <div class="text-center max-w-3xl mx-auto space-y-3">
            <h2 class="text-3xl font-extrabold" style="color: var(--text-main) !important;">MP Police Constable GD 2026 सम्पूर्ण तैयारी कोर्स</h2>
            <p class="text-sm" style="color: var(--text-muted);">मध्य प्रदेश पुलिस आरक्षक भर्ती हेतु विषयवार थ्योरी नोट्स, प्रैक्टिस सेट्स एवं कमजोर विषय विश्लेषण।</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
            <div class="p-4 sm:p-6 rounded-2xl panel space-y-3">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-xl font-bold" style="background-color: var(--bg-main); color: var(--theme-bg);">
                    <i class="fa-solid fa-book-open"></i>
                </div>
                <h4 class="font-bold text-base" style="color: var(--text-main) !important;">32 अध्यायवार नोट्स</h4>
                <p class="text-xs leading-relaxed" style="color: var(--text-muted);">नवीनतम पाठ्यक्रम एवं विगत वर्षों के प्रश्नों पर आधारित थ्योरी व शॉर्टकट ट्रिक्स।</p>
            </div>

            <div class="p-4 sm:p-6 rounded-2xl panel space-y-3">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-xl font-bold" style="background-color: var(--bg-main); color: var(--theme-bg);">
                    <i class="fa-solid fa-list-check"></i>
                </div>
                <h4 class="font-bold text-base" style="color: var(--text-main) !important;">32 चैप्टर प्रैक्टिस टेस्ट</h4>
                <p class="text-xs leading-relaxed" style="color: var(--text-muted);">प्रत्येक अध्याय के बाद तुरंत स्व-मूल्यांकन के लिए वस्तुनिष्ठ प्रश्न उत्तर।</p>
            </div>

            <div class="p-4 sm:p-6 rounded-2xl panel space-y-3">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-xl font-bold" style="background-color: var(--bg-main); color: var(--theme-active);">
                    <i class="fa-solid fa-laptop-code"></i>
                </div>
                <h4 class="font-bold text-base" style="color: var(--text-main) !important;">10 फुल मॉक टेस्ट</h4>
                <p class="text-xs leading-relaxed" style="color: var(--text-muted);">100 प्रश्न | 120 मिनट समयसीमा के साथ वास्तविक CBT परीक्षा का अनुभव।</p>
            </div>

            <div class="p-4 sm:p-6 rounded-2xl panel space-y-3">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-xl font-bold" style="background-color: var(--bg-main); color: var(--rose);">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
                <h4 class="font-bold text-base" style="color: var(--text-main) !important;">स्मार्ट विश्लेषण व सुधार</h4>
                <p class="text-xs leading-relaxed" style="color: var(--text-muted);">गलती सुधार पुस्तिका (Error Workbook) द्वारा कमजोर विषयों में त्वरित सुधार।</p>
            </div>
        </div>
    </div>
</section>

<!-- How the Course Works (6 Steps) -->
<section class="py-16" style="background-color: var(--bg-card); border-top: 1px solid var(--border-color);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        <div class="text-center max-w-2xl mx-auto space-y-2">
            <span class="text-xs font-bold uppercase tracking-widest" style="color: var(--theme-active);">COURSE METHODOLOGY</span>
            <h2 class="text-3xl font-extrabold" style="color: var(--text-main) !important;">How the Course Works</h2>
            <p class="text-xs" style="color: var(--text-muted);">वैज्ञानिक विधि द्वारा 6 चरणों में अपनी तैयारी सुनिश्चित करें</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6">
            <div class="p-4 sm:p-6 rounded-2xl border space-y-2 relative" style="border-color: var(--border-color);">
                <div class="text-xs font-bold" style="color: var(--theme-bg);">STEP 1</div>
                <h4 class="font-bold text-base" style="color: var(--text-main) !important;">Study Chapter</h4>
                <p class="text-xs" style="color: var(--text-muted);">अध्याय के थ्योरी नोट्स ध्यानपूर्वक पढ़ें।</p>
            </div>
            <div class="p-4 sm:p-6 rounded-2xl border space-y-2 relative" style="border-color: var(--border-color);">
                <div class="text-xs font-bold" style="color: var(--theme-bg);">STEP 2</div>
                <h4 class="font-bold text-base" style="color: var(--text-main) !important;">Complete Notes</h4>
                <p class="text-xs" style="color: var(--text-muted);">महत्वपूर्ण बिंदु व सूत्रों का पुनरीक्षण करें।</p>
            </div>
            <div class="p-4 sm:p-6 rounded-2xl border space-y-2 relative" style="border-color: var(--border-color);">
                <div class="text-xs font-bold" style="color: var(--theme-bg);">STEP 3</div>
                <h4 class="font-bold text-base" style="color: var(--text-main) !important;">Take Chapter Test</h4>
                <p class="text-xs" style="color: var(--text-muted);">15 प्रश्नों का चैप्टर टेस्ट हल करें।</p>
            </div>
            <div class="p-4 sm:p-6 rounded-2xl border space-y-2 relative" style="border-color: var(--border-color);">
                <div class="text-xs font-bold" style="color: var(--theme-bg);">STEP 4</div>
                <h4 class="font-bold text-base" style="color: var(--text-main) !important;">Check Result</h4>
                <p class="text-xs" style="color: var(--text-muted);">अपनी सटीकता व स्कोर का विश्लेषण देखें।</p>
            </div>
            <div class="p-4 sm:p-6 rounded-2xl border space-y-2 relative" style="border-color: var(--border-color);">
                <div class="text-xs font-bold" style="color: var(--theme-bg);">STEP 5</div>
                <h4 class="font-bold text-base" style="color: var(--text-main) !important;">Improve Weak Topics</h4>
                <p class="text-xs" style="color: var(--text-muted);">गलत प्रश्नों को गलती सुधार पुस्तिका में दोहराएं।</p>
            </div>
            <div class="p-4 sm:p-6 rounded-2xl border space-y-2 relative" style="border-color: var(--border-color);">
                <div class="text-xs font-bold" style="color: var(--theme-bg);">STEP 6</div>
                <h4 class="font-bold text-base" style="color: var(--text-main) !important;">Attempt Full Mock Tests</h4>
                <p class="text-xs" style="color: var(--text-muted);">10 फुल मॉक टेस्ट देकर अपनी रैंक जानें।</p>
            </div>
        </div>
    </div>
</section>

<!-- Syllabus Breakdown Cards -->
<section class="py-16" style="background-color: var(--bg-main);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        <div class="text-center max-w-2xl mx-auto space-y-2">
            <h2 class="text-3xl font-extrabold" style="color: var(--text-main) !important;">MP Police Exam Structure & Syllabus</h2>
            <p class="text-xs" style="color: var(--text-muted);">100 अंक | 120 मिनट समयसीमा | 3 मुख्य विषय</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6">
            @foreach($subjects as $sub)
                <div class="p-4 sm:p-6 rounded-2xl panel space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="px-2.5 py-1 rounded-full text-xs font-extrabold" style="background-color: var(--bg-main); color: var(--theme-bg);">
                            {{ $sub->total_marks }} अंक
                        </span>
                        <span class="text-xs" style="color: var(--text-muted);">{{ $sub->chapters_count }} अध्यायों में विभाजित</span>
                    </div>

                    <h3 class="text-lg font-bold" style="color: var(--text-main) !important;">{{ $sub->name_hi }}</h3>
                    <p class="text-xs" style="color: var(--text-muted);">{{ $sub->name_en }}</p>

                    <div class="pt-4 flex items-center justify-between text-xs" style="border-top: 1px solid var(--border-color);">
                        <a href="{{ route('login') }}" class="hover:underline font-bold" style="color: var(--theme-bg);">
                            Read Notes →
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-secondary text-xs">
                            Take Test
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Free Preview CTA Banner -->
<section class="py-12" style="background-color: var(--theme-bg);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-6">
        <div class="space-y-2">
            <span class="px-3 py-1 rounded-full text-xs font-bold" style="background-color: rgba(255,255,255,0.1); color: var(--theme-active);">FREE TRIAL ACCESS</span>
            <h3 class="text-2xl font-black" style="color: white !important;">प्रथम 3 अध्यायों के नोट्स और टेस्ट अभी मुफ्त में हल करें!</h3>
            <p class="text-xs" style="color: rgba(255,255,255,0.7);">बिना किसी शुल्क के ट्रायल शुरू करें और Testwise CBT परीक्षा इंजन का अनुभव करें।</p>
        </div>
        <div class="flex items-center gap-3 shrink-0">
            <a href="{{ route('login') }}" class="btn btn-gold text-sm shadow-xl">
                निःशुल्क ट्रायल शुरू करें
            </a>
            <a href="{{ route('courses') }}" class="btn px-6 py-3 border text-sm" style="background-color: transparent; border-color: rgba(255,255,255,0.2); color: white;">
                पूरा सिलेबस देखें
            </a>
        </div>
    </div>
</section>
@endsection
