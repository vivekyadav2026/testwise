@extends('layouts.app')

@section('title', 'Course Syllabus & Structure - Testwise MP Police GD 2026')

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 space-y-10">
    <div class="text-center max-w-3xl mx-auto space-y-3">
        <h1 class="text-3xl font-extrabold" style="color: var(--text-main) !important;">Complete Course Syllabus & 32 Chapters</h1>
        <p class="text-sm" style="color: var(--text-muted);">MP Police Constable GD 2026 लिखित परीक्षा के लिए संपूर्ण 3 विषयों का अध्यायवार विवरण</p>
    </div>

    <div class="space-y-8">
        @foreach($subjects as $sub)
            <div class="p-8 rounded-3xl panel space-y-6">
                <div class="flex items-center justify-between pb-4 border-b" style="border-color: var(--border-color);">
                    <div>
                        <h2 class="text-2xl font-bold" style="color: var(--text-main) !important;">{{ $sub->name_hi }}</h2>
                        <p class="text-xs mt-0.5" style="color: var(--text-muted);">{{ $sub->name_en }}</p>
                    </div>
                    <span class="px-4 py-1.5 rounded-full font-extrabold text-sm border" style="background-color: rgba(217,154,43,0.1); color: var(--gold-deep); border-color: var(--gold);">
                        {{ $sub->total_marks }} अंक
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($sub->chapters as $ch)
                        <div class="p-4 rounded-2xl flex items-center justify-between gap-4 border" style="background-color: var(--bg-main); border-color: var(--border-hard);">
                            <div class="flex items-center gap-3">
                                <span class="w-8 h-8 rounded-xl font-bold text-xs flex items-center justify-center border shrink-0" style="background-color: var(--bg-card); color: var(--text-muted); border-color: var(--border-hard);">
                                    {{ $ch->chapter_number }}
                                </span>
                                <div>
                                    <h4 class="text-sm font-bold" style="color: var(--text-main) !important;">{{ $ch->title_hi }}</h4>
                                    <p class="text-[11px]" style="color: var(--text-muted);">{{ $ch->title_en }}</p>
                                </div>
                            </div>

                            @if($ch->is_free_preview)
                                <span class="px-2.5 py-1 rounded-full font-extrabold text-[11px] border shrink-0" style="background-color: var(--teal-soft); color: var(--teal); border-color: var(--teal);">
                                    FREE PREVIEW
                                </span>
                            @else
                                <span class="px-2.5 py-1 rounded-full font-extrabold text-[11px] border shrink-0 flex items-center gap-1" style="background-color: rgba(217,154,43,0.1); color: var(--gold-deep); border-color: var(--gold);">
                                    <i class="fa-solid fa-lock text-[10px]"></i> PRO
                                </span>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
