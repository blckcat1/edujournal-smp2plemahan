@extends('layouts.journal')

@section('title', 'Dashboard Mitra Universitas - EduJournal')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 transition-colors duration-200">
    <div class="mb-8">
        <span class="px-3 py-1 rounded bg-amber-50 dark:bg-amber-950/40 text-amber-700 dark:text-amber-400 text-xs font-bold border border-amber-200 dark:border-amber-900/60 uppercase">External Academic Panel</span>
        <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight mt-2">Dashboard Mitra Universitas / Dosen</h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Dukung riset siswa sekolah dengan menyumbang ulasan akademik, saran metodologi, serta komentar bimbingan luar.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Left: Manuscripts for feedback -->
        <div class="lg:col-span-8 space-y-6">
            <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 shadow-sm border border-slate-100 dark:border-slate-800/80">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4 flex items-center space-x-2">
                    <svg class="w-5 h-5 text-brand-600 dark:text-brand-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 9.172V5L8 4z" /></svg>
                    <span>Daftar Manuskrip Aktif</span>
                </h3>

                <div class="space-y-4">
                    @forelse($assignedManuscripts as $man)
                    <div class="border border-slate-100 dark:border-slate-800 rounded-2xl p-5 hover:bg-slate-50/50 dark:hover:bg-slate-805/40 transition">
                        <div class="flex justify-between items-start flex-wrap gap-2 mb-2">
                            <span class="px-2 py-0.5 rounded bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-350 text-[10px] font-bold uppercase">{{ $man->subject }}</span>
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-brand-50 dark:bg-brand-950/40 text-brand-700 dark:text-brand-400 border border-brand-200 dark:border-brand-900/60">{{ $man->status }}</span>
                        </div>
                        <h4 class="font-extrabold text-slate-900 dark:text-white text-base leading-snug">
                            <a href="/article/{{ $man->id }}">{{ $man->title }}</a>
                        </h4>
                        <p class="text-xs text-slate-400 dark:text-slate-500 mt-1">Penulis: <strong>{{ $man->author->name }}</strong> ({{ $man->author->institution }})</p>

                        <div class="mt-4 flex gap-2">
                            @if($man->pdf_path)
                            <a href="{{ asset($man->pdf_path) }}" target="_blank" class="px-3.5 py-1.5 rounded-lg border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-600 dark:text-slate-300 font-bold text-xs transition">
                                Baca Naskah PDF
                            </a>
                            @endif
                            <a href="/article/{{ $man->id }}#content" class="px-3.5 py-1.5 rounded-lg bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs transition">
                                Berikan Komentar Akademik
                            </a>
                        </div>
                    </div>
                    @empty
                    <p class="text-xs text-slate-400 dark:text-slate-500 italic text-center py-6">Belum ada manuskrip aktif untuk diulas.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Right: Contribution history logs -->
        <div class="lg:col-span-4 space-y-6">
            <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 shadow-sm border border-slate-100 dark:border-slate-800/80 space-y-4">
                <h3 class="text-base font-bold text-slate-900 dark:text-white">Riwayat Kontribusi Anda</h3>
                <div class="space-y-3">
                    @forelse($commentsHistory as $log)
                    <div class="p-3.5 bg-slate-50 dark:bg-slate-950/40 border border-slate-100 dark:border-slate-800 rounded-xl text-xs space-y-1">
                        <div class="flex justify-between items-start">
                            <span class="font-bold text-slate-900 dark:text-white block truncate max-w-[180px]">{{ $log->manuscript->title }}</span>
                            <span class="text-[9px] text-slate-400 dark:text-slate-500 font-semibold">{{ $log->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-slate-600 dark:text-slate-400 italic">"{{ $log->content }}"</p>
                    </div>
                    @empty
                    <p class="text-xs text-slate-400 dark:text-slate-550 italic text-center py-4">Belum ada riwayat komentar akademik.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
