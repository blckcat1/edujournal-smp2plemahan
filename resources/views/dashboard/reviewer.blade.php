@extends('layouts.journal')

@section('title', 'Dashboard Reviewer - EduJournal')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 transition-colors duration-200">
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Dashboard Reviewer (Guru)</h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Evaluasi naskah yang ditugaskan kepada Anda, isi skor rubrik penilaian, dan berikan masukan akademis.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Left Column: Review Tasks -->
        <div class="lg:col-span-8 space-y-8">
            
            <!-- Assigned Reviews (To Do) -->
            <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 shadow-sm border border-slate-100 dark:border-slate-800/80">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4 flex items-center space-x-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-brand-500"></span>
                    <span>Tugas Review Aktif (Menunggu Evaluasi)</span>
                </h3>
                
                <div class="space-y-4">
                    @forelse($assignedReviews as $rev)
                    <div class="border border-slate-100 dark:border-slate-800 rounded-2xl p-5 hover:bg-slate-50/50 dark:hover:bg-slate-800/40 transition flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <div class="space-y-1 max-w-xl">
                            <span class="px-2 py-0.5 rounded bg-brand-50 dark:bg-brand-950/40 text-brand-700 dark:text-brand-400 text-[10px] font-bold uppercase tracking-wider">{{ $rev->manuscript->subject }}</span>
                            <h4 class="font-bold text-slate-900 dark:text-white text-base leading-snug">
                                <a href="/article/{{ $rev->manuscript->id }}">{{ $rev->manuscript->title }}</a>
                            </h4>
                            <p class="text-xs text-slate-400 dark:text-slate-500">Penulis: <strong>{{ $rev->manuscript->author->name }}</strong> ({{ $rev->manuscript->author->institution }}) — Ditugaskan {{ $rev->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="flex gap-2 whitespace-nowrap">
                            @if($rev->manuscript->pdf_path)
                            <a href="{{ asset($rev->manuscript->pdf_path) }}" target="_blank" class="px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-600 dark:text-slate-350 font-bold text-xs transition">
                                Baca PDF
                            </a>
                            @endif
                            <a href="/reviewer/review/{{ $rev->id }}" class="px-3.5 py-2 rounded-xl bg-brand-600 text-white font-bold text-xs hover:bg-brand-700 transition">
                                Isi Penilaian
                            </a>
                        </div>
                    </div>
                    @empty
                    <p class="text-xs text-slate-400 dark:text-slate-500 italic text-center py-6">Tidak ada tugas peninjauan aktif saat ini.</p>
                    @endforelse
                </div>
            </div>

            <!-- Completed Reviews (History) -->
            <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 shadow-sm border border-slate-100 dark:border-slate-800/80">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4 flex items-center space-x-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                    <span>Riwayat Evaluasi Selesai</span>
                </h3>
                
                <div class="space-y-4">
                    @forelse($completedReviews as $rev)
                    <div class="border border-slate-100 dark:border-slate-800 rounded-2xl p-5 hover:bg-slate-50/50 dark:hover:bg-slate-800/40 transition">
                        <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                            <span class="px-2 py-0.5 rounded bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-350 text-[10px] font-bold uppercase">{{ $rev->manuscript->subject }}</span>
                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $rev->recommendation === 'approve' ? 'bg-emerald-50 dark:bg-emerald-950/30 text-emerald-700 dark:text-emerald-400' : ($rev->recommendation === 'revision' ? 'bg-amber-50 dark:bg-amber-950/30 text-amber-700 dark:text-amber-400' : 'bg-red-50 dark:bg-red-950/30 text-red-700 dark:text-red-400') }}">
                                Rekomendasi: {{ $rev->recommendation }}
                            </span>
                        </div>
                        <h4 class="font-bold text-slate-900 dark:text-white text-base leading-snug">
                            <a href="/article/{{ $rev->manuscript->id }}">{{ $rev->manuscript->title }}</a>
                        </h4>
                        <p class="text-xs text-slate-400 dark:text-slate-500 mt-1">Penulis: {{ $rev->manuscript->author->name }} — Selesai dinilai {{ $rev->updated_at->diffForHumans() }}</p>
                        
                        <div class="mt-4 bg-slate-50 dark:bg-slate-950/40 rounded-xl p-3.5 border border-slate-100 dark:border-slate-800 text-xs">
                            <strong class="block text-slate-700 dark:text-slate-300 mb-1">Catatan Anda:</strong>
                            <p class="text-slate-600 dark:text-slate-400 italic leading-relaxed">{{ $rev->comments }}</p>
                        </div>
                    </div>
                    @empty
                    <p class="text-xs text-slate-400 dark:text-slate-500 italic text-center py-6">Anda belum menyelesaikan peninjauan naskah apapun.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Right Column: Notifications -->
        <div class="lg:col-span-4 space-y-6">
            <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 shadow-sm border border-slate-100 dark:border-slate-800/80 space-y-4">
                <h3 class="text-base font-bold text-slate-900 dark:text-white">Pemberitahuan</h3>
                <div class="space-y-3">
                    @forelse($notifications as $not)
                    <div class="p-3.5 bg-slate-50 dark:bg-slate-950/40 border border-slate-100 dark:border-slate-800 rounded-xl text-xs">
                        <div class="flex justify-between items-start">
                            <span class="font-bold text-slate-900 dark:text-white block">{{ $not->title }}</span>
                            <span class="text-[9px] text-slate-400 dark:text-slate-500 font-semibold">{{ $not->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-slate-500 dark:text-slate-400 mt-1 leading-relaxed">{{ $not->message }}</p>
                    </div>
                    @empty
                    <p class="text-xs text-slate-400 dark:text-slate-500 italic text-center py-4">Tidak ada pemberitahuan baru.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
