@extends('layouts.journal')

@section('title', 'EduJournal - Platform Publikasi Karya Ilmiah Siswa')

@section('content')
<!-- 1. Hero Section -->
<section class="relative bg-gradient-to-r from-brand-900 via-brand-800 to-slate-900 py-20 px-4 sm:px-6 lg:px-8 overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(14,165,233,0.15),transparent_45%)]"></div>
    <div class="max-w-7xl mx-auto relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
        <!-- Hero Text -->
        <div class="lg:col-span-7 text-center lg:text-left">
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white tracking-tight leading-none mb-6">
                Wadah Publikasi & Penilaian <span class="text-brand-400">Manuskrip Siswa</span>
            </h1>
            <p class="text-lg text-slate-300 leading-relaxed max-w-2xl mb-10">
                Tumbuhkan jiwa periset masa depan. Kirim naskah penelitian sains, humaniora, maupun esai akademik Anda, dapatkan bimbingan review dari guru, dan raih sertifikat publikasi berstandar DOI.
            </p>
            <div class="flex flex-col sm:flex-row justify-center lg:justify-start gap-4">
                <a href="/search" class="px-8 py-4 rounded-2xl bg-white text-brand-900 font-extrabold text-base shadow-lg hover:bg-slate-100 transition flex items-center justify-center space-x-2">
                    <svg class="w-5 h-5 text-brand-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <span>Cari Artikel Ilmiah</span>
                </a>
                <a href="/author/submit" class="px-8 py-4 rounded-2xl bg-brand-500 text-white font-extrabold text-base shadow-lg hover:bg-brand-600 transition flex items-center justify-center space-x-2">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                    </svg>
                    <span>Kirim Manuskrip</span>
                </a>
            </div>
        </div>

        <!-- Hero Card Graphic -->
        <div class="lg:col-span-5 hidden lg:block">
            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-3xl p-6 shadow-2xl relative overflow-hidden">
                <div class="flex justify-between items-center mb-6">
                    <div class="flex space-x-1.5">
                        <div class="w-3 h-3 rounded-full bg-red-500/60"></div>
                        <div class="w-3 h-3 rounded-full bg-yellow-500/60"></div>
                        <div class="w-3 h-3 rounded-full bg-green-500/60"></div>
                    </div>
                    <span class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Digital Certificate</span>
                </div>
                <!-- Mini Cert Card -->
                <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 text-center text-slate-800 dark:text-slate-200 shadow-xl border border-slate-100 dark:border-slate-800/80 transition-colors duration-200">
                    <div class="w-12 h-12 rounded-full bg-brand-50 dark:bg-brand-950/40 border border-brand-100 dark:border-brand-900/60 flex items-center justify-center mx-auto mb-4">
                        <span class="text-brand-600 dark:text-brand-400 text-xl font-bold">✓</span>
                    </div>
                    <h3 class="text-base font-extrabold text-slate-900 dark:text-white">Certificate of Publication</h3>
                    <p class="text-xs text-slate-400 dark:text-slate-500 mt-1">Diberikan kepada siswa berprestasi atas dedikasi riset akademik.</p>
                    <div class="border-t border-slate-100 dark:border-slate-800 mt-6 pt-4 text-left grid grid-cols-2 gap-2 text-[10px] text-slate-505 font-medium">
                        <div>
                            <span class="block text-[8px] uppercase tracking-wider text-slate-400 dark:text-slate-500">Penerbit</span>
                            <span>EduJournal OJS</span>
                        </div>
                        <div>
                            <span class="block text-[8px] uppercase tracking-wider text-slate-400 dark:text-slate-500">Indeks DOI</span>
                            <span class="text-brand-600 dark:text-brand-400 font-bold">EDU-2026-V1-I1</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 2. Statistics Section -->
<section class="bg-white dark:bg-slate-900 py-12 border-b border-slate-100 dark:border-slate-800/80 shadow-sm relative z-25 -mt-6 max-w-6xl mx-auto rounded-3xl grid grid-cols-2 md:grid-cols-4 divide-x divide-slate-100 dark:divide-slate-800 shadow-xl dark:shadow-slate-950/40 transition-colors duration-200">
    <div class="text-center p-6">
        <span class="block text-3xl sm:text-4xl font-extrabold text-brand-600 dark:text-brand-400">{{ $stats['articles'] }}</span>
        <span class="block text-xs font-semibold text-slate-500 dark:text-slate-450 uppercase tracking-widest mt-1">Total Artikel</span>
    </div>
    <div class="text-center p-6">
        <span class="block text-3xl sm:text-4xl font-extrabold text-brand-600 dark:text-brand-400">{{ $stats['authors'] }}</span>
        <span class="block text-xs font-semibold text-slate-500 dark:text-slate-450 uppercase tracking-widest mt-1">Total Penulis</span>
    </div>
    <div class="text-center p-6">
        <span class="block text-3xl sm:text-4xl font-extrabold text-brand-600 dark:text-brand-400">{{ $stats['issues'] }}</span>
        <span class="block text-xs font-semibold text-slate-500 dark:text-slate-450 uppercase tracking-widest mt-1">Total Edisi/Issue</span>
    </div>
    <div class="text-center p-6">
        <span class="block text-3xl sm:text-4xl font-extrabold text-brand-600 dark:text-brand-400">{{ $stats['publications'] }}</span>
        <span class="block text-xs font-semibold text-slate-500 dark:text-slate-450 uppercase tracking-widest mt-1">Publikasi Aktif</span>
    </div>
</section>

<!-- 3. Latest Publications Section -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="text-center max-w-3xl mx-auto mb-16">
        <h2 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Publikasi Jurnal Terbaru</h2>
        <p class="text-slate-500 dark:text-slate-400 mt-2">Daftar manuskrip orisinal siswa terbaik yang baru diterbitkan dan dapat diunduh bebas secara publik.</p>
    </div>

    <div class="space-y-6">
        @forelse($latestPublications as $pub)
        <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 sm:p-8 shadow-md border border-slate-100 dark:border-slate-800/80 hover:border-brand-200 dark:hover:border-brand-800 transition duration-300 grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
            <div class="lg:col-span-9">
                <div class="flex flex-wrap items-center gap-2 mb-3">
                    <span class="px-3 py-1 rounded-full bg-brand-50 dark:bg-brand-950/40 border border-brand-100 dark:border-brand-900/60 text-xs font-bold text-brand-700 dark:text-brand-400 uppercase tracking-wide">
                        {{ $pub->subject }}
                    </span>
                    <span class="text-xs text-slate-400 dark:text-slate-500 font-semibold flex items-center">
                        <svg class="w-3.5 h-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        {{ $pub->published_at ? $pub->published_at->format('d M Y') : $pub->created_at->format('d M Y') }}
                    </span>
                </div>
                <h3 class="text-xl font-bold text-slate-900 dark:text-white hover:text-brand-600 dark:hover:text-brand-400 transition leading-snug">
                    <a href="/article/{{ $pub->id }}">{{ $pub->title }}</a>
                </h3>
                <p class="text-slate-500 dark:text-slate-400 text-sm mt-3 line-clamp-3 leading-relaxed">
                    {{ $pub->abstract }}
                </p>
                <div class="mt-6 flex items-center space-x-3">
                    <!-- Author Avatar Initials -->
                    <div class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-xs font-bold text-slate-700 dark:text-slate-300 flex items-center justify-center">
                        {{ strtoupper(substr($pub->author->name, 0, 2)) }}
                    </div>
                    <div class="text-xs">
                        <span class="block font-bold text-slate-800 dark:text-slate-200">{{ $pub->author->name }}</span>
                        <span class="block text-slate-400 dark:text-slate-550">{{ $pub->author->institution }}</span>
                    </div>
                </div>
            </div>
            
            <div class="lg:col-span-3 lg:border-l lg:border-slate-100 dark:lg:border-slate-800/80 lg:pl-6 w-full flex flex-col justify-between h-full space-y-4">
                <div class="text-xs font-medium text-slate-500 dark:text-slate-450">
                    <span class="block uppercase tracking-wider text-[9px] text-slate-400 dark:text-slate-500 font-bold mb-1">DOI Jurnal</span>
                    <span class="font-bold text-brand-700 dark:text-brand-400 bg-brand-50 dark:bg-brand-950/30 px-2.5 py-1 rounded-md block text-center overflow-x-auto whitespace-nowrap">{{ $pub->doi }}</span>
                </div>
                @if($pub->issue)
                <div class="text-xs font-medium text-slate-500 dark:text-slate-450">
                    <span class="block uppercase tracking-wider text-[9px] text-slate-400 dark:text-slate-500 font-bold mb-1">Nomor Edisi</span>
                    <span>{{ $pub->issue->title }}</span>
                </div>
                @endif
                <div class="flex items-center justify-between mt-auto">
                    <span class="text-xs font-semibold text-slate-400 dark:text-slate-505 flex items-center space-x-1">
                        <svg class="w-4 h-4 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 00-.8 2.4L6.8 10.333z" /></svg>
                        <span>{{ $pub->likes }} menyukai</span>
                    </span>
                    <a href="/article/{{ $pub->id }}" class="px-4 py-2.5 rounded-xl border border-brand-100 dark:border-brand-900/60 hover:border-brand-500 dark:hover:border-brand-500 hover:bg-brand-50 dark:hover:bg-brand-950/20 text-xs font-bold text-brand-600 dark:text-brand-400 transition">
                        Buka Metadata
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white dark:bg-slate-900 rounded-3xl p-12 text-center border border-slate-100 dark:border-slate-800 shadow-md">
            <p class="text-slate-400 dark:text-slate-500 text-sm">Belum ada manuskrip yang dipublikasikan dalam edisi aktif.</p>
        </div>
        @endforelse
    </div>
</section>

<!-- 4. Publication Process Tracker (Workflow) -->
<section class="bg-slate-100 dark:bg-slate-900/40 border-y border-slate-200/50 dark:border-slate-800/80 py-20 px-4 sm:px-6 lg:px-8 transition-colors duration-200">
    <div class="max-w-7xl mx-auto">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Alur Proses Publikasi Jurnal</h2>
            <p class="text-slate-500 dark:text-slate-400 mt-2">EduJournal menggunakan alur kerja penilaian sejawat (peer review) profesional untuk memastikan orisinalitas riset.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-5 gap-8 relative">
            <div class="text-center">
                <div class="w-16 h-16 rounded-full bg-white dark:bg-slate-800 shadow-md border border-slate-200 dark:border-slate-700 flex items-center justify-center mx-auto mb-4 text-brand-600 dark:text-brand-400 font-extrabold text-lg">1</div>
                <h4 class="font-bold text-slate-900 dark:text-white text-sm">Submit Naskah</h4>
                <p class="text-xs text-slate-400 dark:text-slate-500 mt-2">Siswa mengunggah abstrak, manuskrip PDF, dan kata kunci.</p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 rounded-full bg-white dark:bg-slate-800 shadow-md border border-slate-200 dark:border-slate-700 flex items-center justify-center mx-auto mb-4 text-brand-600 dark:text-brand-400 font-extrabold text-lg">2</div>
                <h4 class="font-bold text-slate-900 dark:text-white text-sm">Penugasan Reviewer</h4>
                <p class="text-xs text-slate-400 dark:text-slate-500 mt-2">Admin/Guru menugaskan reviewer internal untuk meninjau materi naskah.</p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 rounded-full bg-white dark:bg-slate-800 shadow-md border border-slate-200 dark:border-slate-700 flex items-center justify-center mx-auto mb-4 text-brand-600 dark:text-brand-400 font-extrabold text-lg">3</div>
                <h4 class="font-bold text-slate-900 dark:text-white text-sm">Penilaian Rubrik</h4>
                <p class="text-xs text-slate-400 dark:text-slate-500 mt-2">Reviewer memberikan ulasan terperinci, nilai rubrik, dan saran revisi.</p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 rounded-full bg-white dark:bg-slate-800 shadow-md border border-slate-200 dark:border-slate-700 flex items-center justify-center mx-auto mb-4 text-brand-600 dark:text-brand-400 font-extrabold text-lg">4</div>
                <h4 class="font-bold text-slate-900 dark:text-white text-sm">Keputusan Publikasi</h4>
                <p class="text-xs text-slate-400 dark:text-slate-500 mt-2">Naskah dinyatakan Accepted, Revision Required, atau Rejected.</p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 rounded-full bg-white dark:bg-slate-800 shadow-md border border-slate-200 dark:border-slate-700 flex items-center justify-center mx-auto mb-4 text-brand-600 dark:text-brand-400 font-extrabold text-lg">5</div>
                <h4 class="font-bold text-slate-900 dark:text-white text-sm">Publish & DOI</h4>
                <p class="text-xs text-slate-400 dark:text-slate-500 mt-2">Artikel diterbitkan resmi dengan kode DOI indeks dan sertifikat PDF.</p>
            </div>
        </div>
    </div>
</section>

<!-- 5. Partner Universities -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
    <h3 class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-10">Mitra Akademik & Reviewer Universitas</h3>
    <div class="flex flex-wrap items-center justify-center gap-12 opacity-80 hover:opacity-100 transition duration-300">
        <span class="text-xl font-extrabold text-slate-800 dark:text-slate-200 tracking-wider font-heading">UNIVERSITAS BRAWIJAYA</span>
    </div>
</section>
@endsection
