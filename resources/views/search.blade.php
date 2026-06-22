@extends('layouts.journal')

@section('title', 'Cari Artikel Ilmiah - EduJournal')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 transition-colors duration-200">
    <div class="mb-10 text-center md:text-left">
        <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Pencarian Artikel Ilmiah</h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Gunakan kata kunci, DOI, penulis, atau subjek pelajaran untuk menemukan publikasi artikel siswa.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Advanced Filter Sidebar -->
        <div class="lg:col-span-4 bg-white dark:bg-slate-900 rounded-3xl p-6 shadow-sm border border-slate-100 dark:border-slate-800/80 h-fit">
            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-6 flex items-center space-x-2">
                <svg class="w-5 h-5 text-brand-600 dark:text-brand-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                </svg>
                <span>Filter Pencarian</span>
            </h3>

            <form action="/search" method="GET" class="space-y-4">
                <div>
                    <label for="keyword" class="block text-xs font-bold text-slate-500 dark:text-slate-455 uppercase tracking-wider mb-2">Kata Kunci Umum</label>
                    <input type="text" name="keyword" id="keyword" value="{{ request('keyword') }}"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:outline-none focus:border-brand-500 text-slate-800 dark:text-slate-200 text-sm transition"
                        placeholder="Contoh: Ekosistem, Sensor...">
                </div>

                <div>
                    <label for="title" class="block text-xs font-bold text-slate-500 dark:text-slate-455 uppercase tracking-wider mb-2">Judul Artikel</label>
                    <input type="text" name="title" id="title" value="{{ request('title') }}"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:outline-none focus:border-brand-500 text-slate-800 dark:text-slate-200 text-sm transition"
                        placeholder="Cari judul spesifik...">
                </div>

                <div>
                    <label for="author" class="block text-xs font-bold text-slate-500 dark:text-slate-455 uppercase tracking-wider mb-2">Nama Penulis</label>
                    <input type="text" name="author" id="author" value="{{ request('author') }}"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:outline-none focus:border-brand-500 text-slate-800 dark:text-slate-200 text-sm transition"
                        placeholder="Nama siswa...">
                </div>

                <div>
                    <label for="doi" class="block text-xs font-bold text-slate-500 dark:text-slate-455 uppercase tracking-wider mb-2">Kode DOI Jurnal</label>
                    <input type="text" name="doi" id="doi" value="{{ request('doi') }}"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:outline-none focus:border-brand-500 text-slate-800 dark:text-slate-200 text-sm transition"
                        placeholder="Format: EDU-2026-...">
                </div>

                <div>
                    <label for="subject" class="block text-xs font-bold text-slate-500 dark:text-slate-455 uppercase tracking-wider mb-2">Subjek / Bidang Pelajaran</label>
                    <select name="subject" id="subject"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:outline-none focus:border-brand-500 text-slate-800 dark:text-slate-200 text-sm font-semibold transition">
                        <option value="" class="dark:bg-slate-900">Semua Subjek</option>
                        <option value="IPA" {{ request('subject') === 'IPA' ? 'selected' : '' }} class="dark:bg-slate-900">Sains (IPA)</option>
                        <option value="IPS" {{ request('subject') === 'IPS' ? 'selected' : '' }} class="dark:bg-slate-900">Humaniora (IPS)</option>
                        <option value="Matematika" {{ request('subject') === 'Matematika' ? 'selected' : '' }} class="dark:bg-slate-900">Matematika</option>
                        <option value="Bahasa" {{ request('subject') === 'Bahasa' ? 'selected' : '' }} class="dark:bg-slate-900">Bahasa & Sastra</option>
                    </select>
                </div>

                <div>
                    <label for="year" class="block text-xs font-bold text-slate-500 dark:text-slate-455 uppercase tracking-wider mb-2">Tahun Publikasi</label>
                    <input type="number" name="year" id="year" value="{{ request('year') }}"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:outline-none focus:border-brand-500 text-slate-800 dark:text-slate-200 text-sm transition"
                        placeholder="Contoh: 2026">
                </div>

                <div class="pt-4 flex gap-2">
                    <a href="/search" class="w-1/2 py-3 rounded-xl border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-805 text-slate-600 dark:text-slate-300 text-center font-bold text-sm transition block">
                        Reset
                    </a>
                    <button type="submit" class="w-1/2 py-3 rounded-xl bg-brand-600 text-white font-bold text-sm hover:bg-brand-700 transition">
                        Cari
                    </button>
                </div>
            </form>
        </div>

        <!-- Search Results List -->
        <div class="lg:col-span-8 space-y-6">
            <div class="bg-white dark:bg-slate-900 rounded-3xl px-6 py-4 shadow-sm border border-slate-100 dark:border-slate-800/80 flex justify-between items-center text-sm font-semibold text-slate-500 dark:text-slate-400 transition-colors duration-200">
                <span>Ditemukan {{ $results->total() }} hasil pencarian</span>
            </div>

            @forelse($results as $res)
            <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-100 dark:border-slate-800 hover:border-brand-200 dark:hover:border-brand-800 transition duration-300">
                <div class="flex items-center space-x-2 text-xs font-bold text-slate-400 dark:text-slate-500 mb-3">
                    <span class="px-2.5 py-0.5 rounded-md bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-350 uppercase">{{ $res->subject }}</span>
                    <span>•</span>
                    <span>DOI: {{ $res->doi }}</span>
                </div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white hover:text-brand-600 dark:hover:text-brand-400 transition">
                    <a href="/article/{{ $res->id }}">{{ $res->title }}</a>
                </h3>
                <p class="text-xs text-slate-400 dark:text-slate-500 mt-1">Oleh <strong>{{ $res->author->name }}</strong> ({{ $res->author->institution }}) — Diterbitkan pada {{ $res->published_at ? $res->published_at->format('d M Y') : $res->created_at->format('d M Y') }}</p>
                <p class="text-slate-505 dark:text-slate-400 text-sm mt-3 line-clamp-3 leading-relaxed">
                    {{ $res->abstract }}
                </p>
                <div class="mt-6 flex items-center justify-between border-t border-slate-50 dark:border-slate-800/80 pt-4">
                    <span class="text-xs font-semibold text-slate-400 dark:text-slate-505 flex items-center space-x-1">
                        <svg class="w-4 h-4 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 00-.8 2.4L6.8 10.333z" /></svg>
                        <span>{{ $res->likes }} menyukai</span>
                    </span>
                    <a href="/article/{{ $res->id }}" class="text-sm font-bold text-brand-600 dark:text-brand-400 hover:text-brand-700 dark:hover:text-brand-350 transition flex items-center space-x-1">
                        <span>Baca Fulltext</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                    </a>
                </div>
            </div>
            @empty
            <div class="bg-white dark:bg-slate-900 rounded-3xl p-12 text-center border border-slate-100 dark:border-slate-800 shadow-sm text-slate-400 dark:text-slate-500">
                <svg class="w-12 h-12 text-slate-300 dark:text-slate-700 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-sm">Tidak ditemukan artikel ilmiah yang cocok dengan kriteria pencarian Anda.</p>
            </div>
            @endforelse

            <div class="mt-6">
                {{ $results->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
