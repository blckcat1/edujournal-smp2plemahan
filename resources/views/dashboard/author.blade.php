@extends('layouts.journal')

@section('title', 'Dashboard Siswa - EduJournal')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 transition-colors duration-200">
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Dashboard Siswa (Author)</h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Kelola manuskrip Anda, lihat status publikasi, unduh sertifikat akademik, dan tinjau masukan reviewer.</p>
    </div>

    <!-- 4. Stats Row -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-800/80 flex items-center justify-between transition-colors duration-200">
            <div>
                <span class="block text-2xl font-extrabold text-slate-900 dark:text-white">{{ $stats['submissions'] }}</span>
                <span class="block text-xs font-bold text-slate-400 dark:text-slate-550 uppercase tracking-wider mt-1">Total Pengajuan</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-brand-50 dark:bg-brand-950/40 flex items-center justify-center text-brand-600 dark:text-brand-400">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
            </div>
        </div>
        <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-800/80 flex items-center justify-between transition-colors duration-200">
            <div>
                <span class="block text-2xl font-extrabold text-slate-900 dark:text-white">{{ $stats['published'] }}</span>
                <span class="block text-xs font-bold text-slate-400 dark:text-slate-550 uppercase tracking-wider mt-1">Terbit Online</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 flex items-center justify-center text-emerald-600 dark:text-emerald-400">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
        </div>
        <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-800/80 flex items-center justify-between transition-colors duration-200">
            <div>
                <span class="block text-2xl font-extrabold text-slate-900 dark:text-white">{{ $stats['revisions'] }}</span>
                <span class="block text-xs font-bold text-slate-400 dark:text-slate-550 uppercase tracking-wider mt-1">Butuh Revisi</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-amber-50 dark:bg-amber-950/40 flex items-center justify-center text-amber-600 dark:text-amber-400">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 1121.21 8H17" /></svg>
            </div>
        </div>
        <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-800/80 flex items-center justify-between transition-colors duration-200">
            <div>
                <span class="block text-2xl font-extrabold text-slate-900 dark:text-white">{{ $stats['likes'] }}</span>
                <span class="block text-xs font-bold text-slate-400 dark:text-slate-550 uppercase tracking-wider mt-1">Total Like</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-rose-50 dark:bg-rose-950/40 flex items-center justify-center text-rose-600 dark:text-rose-400">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h2a2 2 0 012 2v6a2 2 0 01-2 2H7a2 2 0 01-2-2v-5a2 2 0 012-2m4 0V4a2 2 0 00-2-2 2 2 0 00-2 2v4h5z" /></svg>
            </div>
        </div>
    </div>

    <!-- Main Grid Content -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Left: Manuscripts status & history -->
        <div class="lg:col-span-8 space-y-6">
            <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 shadow-sm border border-slate-100 dark:border-slate-800/80 transition-colors duration-200">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Manuskrip Karya Ilmiah Anda</h3>
                    <a href="/author/submit" class="px-4 py-2 rounded-xl bg-brand-600 text-white font-bold text-xs shadow-md shadow-brand-600/10 hover:bg-brand-700 transition">
                        Submit Baru
                    </a>
                </div>

                <div class="space-y-6">
                    @forelse($manuscripts as $man)
                    <div class="border border-slate-100 dark:border-slate-800 rounded-2xl p-5 hover:bg-slate-50/50 dark:hover:bg-slate-805/40 transition">
                        <div class="flex flex-wrap items-center justify-between gap-2 mb-3">
                            <span class="px-2.5 py-0.5 rounded bg-slate-100 dark:bg-slate-800 text-[10px] font-bold text-slate-600 dark:text-slate-350 uppercase">{{ $man->subject }}</span>
                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold tracking-wider uppercase bg-brand-50 dark:bg-brand-950/40 text-brand-700 dark:text-brand-400 border border-brand-200 dark:border-brand-900/60">{{ $man->status }}</span>
                        </div>
                        <h4 class="font-extrabold text-slate-900 dark:text-white text-base hover:text-brand-600 dark:hover:text-brand-400 transition">
                            <a href="/article/{{ $man->id }}">{{ $man->title }}</a>
                        </h4>
                        <p class="text-xs text-slate-400 dark:text-slate-500 mt-1">Dibuat {{ $man->created_at->diffForHumans() }}</p>

                        <!-- Workflow Visual Progress Tracker -->
                        <div class="mt-6 space-y-2">
                            <span class="text-[10px] text-slate-400 dark:text-slate-500 font-bold uppercase tracking-wider block">Progress Publikasi</span>
                            <div class="w-full bg-slate-200 dark:bg-slate-850 h-2.5 rounded-full overflow-hidden flex">
                                @php
                                    $percent = match($man->status) {
                                        'submitted' => 15,
                                        'initial_review' => 30,
                                        'reviewer_assigned' => 45,
                                        'under_review' => 60,
                                        'revision_required' => 75,
                                        'revised_submission' => 85,
                                        'accepted' => 95,
                                        'published' => 100,
                                        default => 10
                                    };
                                    $barColor = $man->status === 'revision_required' ? 'bg-amber-500' : ($man->status === 'rejected' ? 'bg-red-500' : 'bg-brand-500');
                                @endphp
                                <div class="{{ $barColor }} h-full" style="width: {{ $man->status === 'rejected' ? 100 : $percent }}%"></div>
                            </div>
                            <div class="flex justify-between text-[9px] text-slate-400 dark:text-slate-505 font-bold uppercase tracking-wider">
                                <span>Submitted</span>
                                <span>Review</span>
                                <span>{{ $man->status === 'revision_required' ? 'Revisi Diminta' : ($man->status === 'rejected' ? 'Ditolak' : 'Accepted') }}</span>
                                <span>Published</span>
                            </div>
                        </div>

                        <!-- If revision required form -->
                        @if($man->status === 'revision_required')
                        <div class="mt-5 bg-amber-50/50 dark:bg-amber-950/20 border border-amber-200/60 dark:border-amber-900/40 rounded-xl p-4">
                            <span class="block text-xs font-bold text-amber-800 dark:text-amber-400 mb-2">Unggah Dokumen Hasil Revisi:</span>
                            <form action="/author/manuscript/{{ $man->id }}/revision" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row gap-3">
                                @csrf
                                <input type="file" name="pdf_file" required accept="application/pdf"
                                    class="w-full text-xs text-slate-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-amber-100 dark:file:bg-amber-950 file:text-amber-700 dark:file:text-amber-400 hover:file:bg-amber-200 dark:hover:file:bg-amber-900">
                                <button type="submit" class="px-4 py-2 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs transition whitespace-nowrap">
                                    Kirim Revisi
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                    @empty
                    <div class="p-8 text-center text-slate-400 dark:text-slate-500 text-xs italic">
                        Anda belum mengirimkan manuskrip apapun.
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Right: Notifications & Certificates -->
        <div class="lg:col-span-4 space-y-6">
            <!-- Author resources (Downloads) -->
            <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 shadow-sm border border-slate-100 dark:border-slate-800/80 space-y-4 transition-colors duration-200">
                <h3 class="text-base font-bold text-slate-900 dark:text-white">Panduan & Template</h3>
                <p class="text-xs text-slate-400 dark:text-slate-500">Unduh berkas template manuskrip dan pedoman tata tulis artikel di bawah:</p>
                <div class="grid grid-cols-1 gap-2 pt-1">
                    <a href="{{ asset('templates/template_manuskrip.txt') }}" download class="w-full py-2.5 rounded-xl bg-slate-900 dark:bg-slate-800 text-white dark:text-slate-200 font-bold text-xs hover:bg-slate-800 dark:hover:bg-slate-700 transition flex items-center justify-center space-x-2">
                        <svg class="w-4 h-4 text-slate-300 dark:text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        <span>Template Penulisan (.txt)</span>
                    </a>
                    <a href="{{ asset('templates/panduan_penulisan.pdf') }}" download class="w-full py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 font-bold text-xs hover:bg-slate-50 dark:hover:bg-slate-800 transition flex items-center justify-center space-x-2">
                        <svg class="w-4 h-4 text-slate-505 dark:text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        <span>Panduan Penulisan (PDF)</span>
                    </a>
                </div>
            </div>

            <!-- Certificates list -->
            <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 shadow-sm border border-slate-100 dark:border-slate-800/80 space-y-4 transition-colors duration-200">
                <h3 class="text-base font-bold text-slate-900 dark:text-white">Sertifikat Publikasi</h3>
                <p class="text-xs text-slate-400 dark:text-slate-500">Sertifikat diterbitkan secara otomatis setelah manuskrip dipublikasikan.</p>
                <div class="space-y-3">
                    @forelse($certificates as $cert)
                    <div class="p-3 bg-slate-50 dark:bg-slate-950/40 border border-slate-100 dark:border-slate-800 rounded-xl text-xs flex justify-between items-center">
                        <div class="truncate mr-3">
                            <span class="block font-bold text-slate-900 dark:text-white truncate">{{ $cert->manuscript->title }}</span>
                            <span class="block text-[10px] text-slate-400 dark:text-slate-550">DOI: {{ $cert->manuscript->doi }}</span>
                        </div>
                        <a href="/certificate/{{ $cert->hash }}" target="_blank" 
                            class="px-3 py-1.5 rounded-lg bg-brand-50 dark:bg-brand-950/40 border border-brand-100 dark:border-brand-900/60 font-bold text-brand-600 dark:text-brand-400 hover:bg-brand-600 hover:text-white transition whitespace-nowrap">
                            Cetak
                        </a>
                    </div>
                    @empty
                    <p class="text-xs text-slate-400 dark:text-slate-550 italic text-center py-4">Belum ada sertifikat terbit.</p>
                    @endforelse
                </div>
            </div>

            <!-- Notifications list -->
            <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 shadow-sm border border-slate-100 dark:border-slate-800/80 space-y-4 transition-colors duration-200">
                <h3 class="text-base font-bold text-slate-900 dark:text-white">Pemberitahuan Baru</h3>
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
