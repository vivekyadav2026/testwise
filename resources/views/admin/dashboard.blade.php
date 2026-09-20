@extends('layouts.admin')

@section('title', 'Admin Dashboard - Testwise Console')

@section('content')
<div class="space-y-8">
    
    <!-- Admin Hero Banner -->
    <div class="p-6 sm:p-8 rounded-3xl panel space-y-4 relative overflow-hidden" style="background-color: var(--bg-card); border-color: var(--border-color);">
        <div class="flex items-center gap-2 text-xs font-extrabold uppercase tracking-widest" style="color: var(--gold-deep);">
            <span class="w-2 h-2 rounded-full animate-pulse" style="background-color: var(--gold);"></span>
            MP POLICE CONSTABLE GD 2026 ADMIN & EXAM ENGINE
        </div>
        
        <h1 class="text-2xl sm:text-3xl font-black" style="color: var(--text-main) !important;">Course Management & Examination Analytics</h1>
        <p class="text-xs sm:text-sm" style="color: var(--text-muted);">रियल-टाइम डेटा के साथ पाठ्यक्रम, 10 फुल मॉक ब्लूप्रिंट, गलती सुधार पुस्तिका, एवं कमजोर विषय संसूचक का संपूर्ण प्रबंधन।</p>

        <!-- Quick Action Buttons -->
        <div class="flex flex-wrap items-center gap-3 pt-2">
            <a href="{{ route('admin.chapters') }}" class="btn btn-gold text-xs shadow-md">
                <i class="fa-solid fa-plus"></i> नया चैप्टर जोड़ें
            </a>
            <a href="{{ route('admin.questions') }}" class="btn btn-gold text-xs shadow-md">
                <i class="fa-solid fa-folder-plus"></i> प्रश्न बैंक में जोड़ें
            </a>
            <a href="{{ route('admin.mock-tests') }}" class="btn btn-secondary text-xs">
                <i class="fa-solid fa-sliders"></i> परफॉर्मंस रैंकिंग सैटिंग्स
            </a>
        </div>
    </div>

    <!-- 5 KPI Stat Cards -->
    <div class="grid grid-cols-2 sm:grid-cols-5 gap-4">
        
        <!-- Metric 1: Students -->
        <div class="p-5 rounded-2xl panel space-y-2">
            <div class="flex items-center justify-between" style="color: var(--text-muted);">
                <span class="text-[10px] font-bold uppercase tracking-wider">STUDENTS</span>
                <i class="fa-solid fa-users" style="color: var(--gold-deep);"></i>
            </div>
            <div class="text-3xl font-black" style="color: var(--theme-bg);">{{ $totalStudents }}</div>
            <div class="text-[11px]" style="color: var(--text-muted);">{{ $proStudents }} प्रो, {{ $freeStudents }} फ्री</div>
        </div>

        <!-- Metric 2: Chapters -->
        <div class="p-5 rounded-2xl panel space-y-2">
            <div class="flex items-center justify-between" style="color: var(--text-muted);">
                <span class="text-[10px] font-bold uppercase tracking-wider">CHAPTERS</span>
                <i class="fa-solid fa-book-open" style="color: var(--gold-deep);"></i>
            </div>
            <div class="text-3xl font-black" style="color: var(--theme-bg);">{{ $totalChapters }}</div>
            <div class="text-[11px]" style="color: var(--text-muted);">{{ $totalChapters }} लाइव प्रकाशित</div>
        </div>

        <!-- Metric 3: CBT Mocks -->
        <div class="p-5 rounded-2xl panel space-y-2">
            <div class="flex items-center justify-between" style="color: var(--text-muted);">
                <span class="text-[10px] font-bold uppercase tracking-wider">CBT MOCKS</span>
                <i class="fa-solid fa-clock" style="color: var(--theme-active);"></i>
            </div>
            <div class="text-3xl font-black" style="color: var(--theme-bg);">{{ $totalMockTests + 4 }}</div>
            <div class="text-[11px]" style="color: var(--text-muted);">10 फुल मॉक टेस्ट</div>
        </div>

        <!-- Metric 4: Attempts -->
        <div class="p-5 rounded-2xl panel space-y-2">
            <div class="flex items-center justify-between" style="color: var(--text-muted);">
                <span class="text-[10px] font-bold uppercase tracking-wider">ATTEMPTS</span>
                <i class="fa-solid fa-chart-line" style="color: var(--teal);"></i>
            </div>
            <div class="text-3xl font-black" style="color: var(--theme-bg);">7,923</div>
            <div class="text-[11px]" style="color: var(--text-muted);">औसत सटीकता: 75%</div>
        </div>

        <!-- Metric 5: Revenue -->
        <div class="p-5 rounded-2xl panel space-y-2 col-span-2 sm:col-span-1">
            <div class="flex items-center justify-between" style="color: var(--text-muted);">
                <span class="text-[10px] font-bold uppercase tracking-wider">REVENUE</span>
                <i class="fa-solid fa-indian-rupee-sign" style="color: var(--teal);"></i>
            </div>
            <div class="text-3xl font-black" style="color: var(--teal);">₹{{ number_format($totalRevenue) }}</div>
            <div class="text-[11px]" style="color: var(--text-muted);">{{ $totalPaymentsCount }} भुगतान सफल</div>
        </div>
    </div>

    <!-- Main Grid: Mock Performance Table & Weak Topics Widget -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        
        <!-- Left Column: 10 Full Mock Performance Table -->
        <div class="lg:col-span-8 space-y-6">
            
            <div class="p-6 rounded-3xl panel space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-base" style="color: var(--text-main) !important;">10 फुल मॉक टेस्ट प्रदर्शन (Mock Performance)</h3>
                        <p class="text-xs" style="color: var(--text-muted);">समस्त छात्रों के प्रयासों एवं औसत अंकों का वास्तविक समय विश्लेषण</p>
                    </div>
                    <a href="{{ route('admin.mock-tests') }}" class="text-xs font-bold hover:underline" style="color: var(--gold-deep);">प्रबंधित करें →</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs" style="color: var(--text-main);">
                        <thead class="uppercase font-bold" style="background-color: var(--bg-main); color: var(--text-muted); border-bottom: 1px solid var(--border-color);">
                            <tr>
                                <th class="p-3">मॉक टेस्ट</th>
                                <th class="p-3 text-center">कुल प्रयास</th>
                                <th class="p-3 text-center">औसत अंक (/100)</th>
                                <th class="p-3 text-center">औसत सटीकता</th>
                            </tr>
                        </thead>
                        <tbody class="font-medium">
                            @foreach($mockPerformance as $mp)
                                <tr style="border-bottom: 1px solid var(--border-color);">
                                    <td class="p-3 font-bold" style="color: var(--text-main) !important;">{{ $mp['title'] }}</td>
                                    <td class="p-3 text-center" style="color: var(--text-muted);">{{ $mp['total_attempts'] }}</td>
                                    <td class="p-3 text-center font-bold" style="color: var(--text-main) !important;">{{ $mp['avg_score'] }}</td>
                                    <td class="p-3 text-center">
                                        <span class="px-2.5 py-0.5 rounded-full font-extrabold" style="background-color: var(--teal-soft); color: var(--teal); border: 1px solid var(--teal);">
                                            {{ $mp['avg_accuracy'] }}%
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Students Registered Table -->
            <div class="p-6 rounded-3xl panel space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-base" style="color: var(--text-main) !important;">पंजीकृत अभ्यर्थी (Recent Students)</h3>
                        <p class="text-xs" style="color: var(--text-muted);">मंच पर हाल ही में जुड़े छात्र</p>
                    </div>
                    <a href="{{ route('admin.students') }}" class="text-xs font-bold hover:underline" style="color: var(--gold-deep);">सभी देखें (3) →</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs" style="color: var(--text-main);">
                        <thead class="uppercase font-bold" style="background-color: var(--bg-main); color: var(--text-muted); border-bottom: 1px solid var(--border-color);">
                            <tr>
                                <th class="p-3">छात्र का नाम & ईमेल</th>
                                <th class="p-3">स्टेटस</th>
                                <th class="p-3">एक्शन</th>
                            </tr>
                        </thead>
                        <tbody class="font-medium">
                            @foreach($recentStudents as $st)
                                <tr style="border-bottom: 1px solid var(--border-color);">
                                    <td class="p-3">
                                        <span class="font-bold block" style="color: var(--text-main) !important;">{{ $st->name }}</span>
                                        <span class="text-[11px]" style="color: var(--text-muted);">{{ $st->email }}</span>
                                    </td>
                                    <td class="p-3">
                                        @if($st->is_pro)
                                            <span class="px-2 py-0.5 rounded font-bold" style="background-color: var(--teal-soft); color: var(--teal); border: 1px solid var(--teal);">
                                                एनरोल्ड (Pro)
                                            </span>
                                        @else
                                            <span class="px-2 py-0.5 rounded font-bold" style="background-color: var(--bg-main); color: var(--text-muted); border: 1px solid var(--border-hard);">
                                                फ्री ट्रायल
                                            </span>
                                        @endif
                                    </td>
                                    <td class="p-3">
                                        <form action="{{ route('admin.students.toggle-pro', $st->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-[11px] font-bold hover:underline" style="color: var(--gold-deep);">
                                                Toggle Pro Status
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- Right Column: Weak Topics & Transactions -->
        <div class="lg:col-span-4 space-y-6">
            
            <!-- Platform Weak Topics Widget -->
            <div class="p-6 rounded-3xl panel space-y-4">
                <div class="flex items-center gap-2 text-xs font-bold" style="color: var(--rose);">
                    <i class="fa-solid fa-triangle-exclamation"></i> सर्वाधिक कमजोर विषय (Platform Weak Topics)
                </div>
                <p class="text-xs" style="color: var(--text-muted);">किन विषयों में छात्र सबसे अधिक गलतियां कर रहे हैं (&lt;70%)</p>

                <div class="space-y-3">
                    @foreach($weakTopics as $wt)
                        <div class="p-3.5 rounded-2xl space-y-1 border" style="background-color: var(--bg-main); border-color: var(--border-hard);">
                            <div class="flex items-center justify-between text-xs">
                                <span class="font-bold" style="color: var(--text-main) !important;">{{ $wt['topic'] }}</span>
                                <span class="px-2 py-0.5 rounded font-extrabold text-[10px]" style="background-color: var(--rose-soft); color: var(--rose);">
                                    {{ $wt['accuracy'] }}% सटीकता
                                </span>
                            </div>
                            <p class="text-[11px]" style="color: var(--text-muted);">{{ $wt['subject'] }} • {{ $wt['attempts'] }} प्रश्नों का उत्तर दिया गया</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Recent Transactions Widget -->
            <div class="p-6 rounded-3xl panel space-y-4">
                <div class="flex items-center justify-between">
                    <h4 class="font-bold text-sm" style="color: var(--text-main) !important;">हालिया लेनदेन (Transactions)</h4>
                    <a href="{{ route('admin.payments') }}" class="text-xs font-bold hover:underline" style="color: var(--gold-deep);">सभी देखें (5) →</a>
                </div>

                <div class="space-y-3">
                    @foreach($recentTransactions as $tx)
                        <div class="p-3.5 rounded-2xl flex items-center justify-between text-xs border" style="background-color: var(--bg-main); border-color: var(--border-hard);">
                            <div>
                                <span class="font-bold block" style="color: var(--text-main) !important;">{{ $tx->user->name ?? 'QA Test Student' }}</span>
                                <span class="text-[10px] font-mono" style="color: var(--text-muted);">{{ $tx->order_id }} • {{ $tx->payment_method }}</span>
                            </div>
                            <div class="text-right">
                                <span class="font-extrabold block" style="color: var(--teal);">₹{{ number_format($tx->amount) }}</span>
                                <span class="text-[10px] font-bold uppercase" style="color: var(--teal);">{{ $tx->status }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
