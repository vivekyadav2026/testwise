@extends('layouts.student')

@section('title', '10 Full Mock Tests - Testwise MP Police GD 2026')

@section('content')
<div class="space-y-8">
    <div class="p-6 sm:p-8 rounded-3xl panel space-y-3">
        <span class="px-3 py-1 rounded-full text-xs font-bold" style="background-color: rgba(217,154,43,0.1); color: var(--theme-active); border: 1px solid var(--gold);">
            REAL CBT EXAMINATION BLUEPRINT
        </span>
        <h1 class="text-2xl sm:text-3xl font-black" style="color: var(--text-main) !important;">10 Full CBT Mock Tests Series</h1>
        <p class="text-xs sm:text-sm" style="color: var(--text-muted);">100 प्रश्न • 120 मिनट समयसीमा • परीक्षा हॉल जैसा इंटरफ़ेस व तुरंत रैंक रिपोर्ट</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($mockTests as $mock)
            @php
                $att = $userAttempts[$mock->id] ?? null;
                $isUnlocked = $mock->is_free || $user->is_pro;
            @endphp

            <div class="p-6 rounded-3xl panel space-y-4 flex flex-col justify-between border" style="background-color: var(--bg-card); border-color: var(--border-color);">
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase" style="color: var(--theme-active);">MOCK TEST {{ sprintf('%02d', $mock->test_number) }}</span>
                        @if($mock->is_free)
                            <span class="px-2.5 py-0.5 rounded-full font-extrabold text-[10px]" style="background-color: var(--teal-soft); color: var(--teal); border: 1px solid var(--teal);">FREE MOCK</span>
                        @else
                            <span class="px-2.5 py-0.5 rounded-full font-extrabold text-[10px]" style="background-color: rgba(217,154,43,0.1); color: var(--gold-deep); border: 1px solid var(--gold);">PRO</span>
                        @endif
                    </div>

                    <h3 class="text-lg font-bold" style="color: var(--text-main) !important;">{{ $mock->title_hi }}</h3>
                    <p class="text-xs" style="color: var(--text-muted);">{{ $mock->description_hi }}</p>

                    @if($att)
                        <div class="p-3 rounded-xl flex justify-between text-xs font-bold border" style="background-color: var(--bg-main); border-color: var(--border-hard);">
                            <span style="color: var(--text-muted);">पिछला अंक: <strong style="color: var(--teal);">{{ $att->score }}/{{ $att->total_marks }}</strong></span>
                            <span style="color: var(--text-muted);">सटीकता: <strong style="color: var(--theme-active);">{{ round($att->accuracy_percentage, 1) }}%</strong></span>
                        </div>
                    @endif
                </div>

                <div class="pt-4 flex items-center justify-between border-t" style="border-color: var(--border-color);">
                    <span class="text-xs" style="color: var(--text-muted);"><i class="fa-solid fa-clock mr-1" style="color: var(--gold-deep);"></i> 120 Mins</span>

                    @if($isUnlocked)
                        <a href="{{ route('student.cbt-test', ['type' => 'full_mock', 'id' => $mock->id]) }}" class="btn btn-gold text-xs shadow-md">
                            <i class="fa-solid fa-play"></i> Start CBT Test
                        </a>
                    @else
                        <form action="{{ route('student.unlock-pro') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-gold text-xs shadow-md">
                                <i class="fa-solid fa-lock"></i> Unlock Test (₹499)
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
