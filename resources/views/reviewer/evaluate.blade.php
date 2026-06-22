@extends('layouts.journal')

@section('title', 'Penilaian Manuskrip - EduJournal')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <div class="mb-8">
        <a href="/reviewer" class="inline-flex items-center space-x-2 text-sm font-semibold text-slate-500 hover:text-brand-600 dark:text-slate-400 dark:hover:text-brand-400 transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            <span>Kembali ke Dashboard Reviewer</span>
        </a>
        <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight mt-3">Lembar Penilaian & Review Manuskrip</h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Evaluasi manuskrip siswa secara objektif dengan mengisi skor kriteria rubrik di bawah.</p>
    </div>

    <!-- Manuscript brief details card -->
    <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 shadow-sm border border-slate-100 dark:border-slate-800 mb-8 flex justify-between items-start flex-wrap gap-4">
        <div class="space-y-1">
            <span class="px-2 py-0.5 rounded bg-brand-50 text-brand-700 dark:bg-brand-900/30 dark:text-brand-400 text-[10px] font-bold uppercase">{{ $review->manuscript->subject }}</span>
            <h3 class="font-extrabold text-slate-900 dark:text-white text-lg leading-snug">{{ $review->manuscript->title }}</h3>
            <p class="text-xs text-slate-400 dark:text-slate-500">Penulis: <strong>{{ $review->manuscript->author->name }}</strong> ({{ $review->manuscript->author->institution }})</p>
        </div>
        @if($review->manuscript->pdf_path)
        <a href="{{ asset($review->manuscript->pdf_path) }}" download class="px-4 py-2.5 rounded-xl bg-slate-900 dark:bg-slate-800 text-white hover:bg-slate-800 dark:hover:bg-slate-700 transition flex items-center space-x-1 whitespace-nowrap">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
            <span>Unduh Naskah Utama (PDF)</span>
        </a>
        @endif
    </div>

    <form action="/reviewer/review/{{ $review->id }}" method="POST" class="space-y-8">
        @csrf
        
        <!-- Rubric scoring card -->
        <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-100 dark:border-slate-800 space-y-6">
            <h3 class="text-lg font-bold text-slate-900 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-3">1. Penilaian Kriteria Rubrik</h3>
            
            <div class="space-y-6 divide-y divide-slate-100 dark:divide-slate-800">
                @foreach($rubrics as $rub)
                <div class="pt-6 first:pt-0 space-y-4">
                    <div class="flex justify-between items-start flex-wrap gap-2">
                        <div>
                            <h4 class="font-bold text-slate-800 dark:text-slate-200 text-sm">{{ $rub->criteria_name }}</h4>
                            <span class="text-[10px] text-brand-600 dark:text-brand-400 font-semibold uppercase">Bobot: {{ $rub->weight }}% (Skor Maksimal: {{ $rub->max_score }})</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <label for="score_{{ $rub->id }}" class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase">Skor:</label>
                            <input type="number" name="score_{{ $rub->id }}" id="score_{{ $rub->id }}" min="0" max="{{ $rub->max_score }}" required
                                class="w-20 px-3 py-1.5 rounded-lg bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:outline-none focus:border-brand-500 font-bold text-center text-sm text-slate-800 dark:text-slate-200"
                                placeholder="0-{{ $rub->max_score }}">
                        </div>
                    </div>
                    <div>
                        <input type="text" name="comment_{{ $rub->id }}" placeholder="Catatan perbaikan khusus kriteria ini (opsional)..."
                            class="w-full px-3.5 py-2 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-150 dark:border-slate-700 focus:outline-none focus:border-brand-500 text-slate-600 dark:text-slate-350 text-xs transition">
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Recommendation and Comments Card -->
        <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-100 dark:border-slate-800 space-y-6">
            <h3 class="text-lg font-bold text-slate-900 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-3">2. Rekomendasi & Catatan Umum</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="recommendation" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Rekomendasi Reviewer</label>
                    <select name="recommendation" id="recommendation" required
                        class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:outline-none focus:border-brand-500 text-slate-800 dark:text-slate-200 text-sm font-semibold transition">
                        <option value="" disabled selected>Pilih rekomendasi...</option>
                        <option value="approve" class="dark:bg-slate-850">Setujui (Approve)</option>
                        <option value="revision" class="dark:bg-slate-850">Minta Revisi (Request Revision)</option>
                        <option value="reject" class="dark:bg-slate-850">Tolak (Reject)</option>
                    </select>
                </div>

                <div>
                    <label for="status_update" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Ubah Status Manuskrip Menjadi</label>
                    <select name="status_update" id="status_update" required
                        class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:outline-none focus:border-brand-500 text-slate-800 dark:text-slate-200 text-sm font-semibold transition">
                        <option value="" disabled selected>Pilih status baru...</option>
                        <option value="under_review" class="dark:bg-slate-850">Under Review</option>
                        <option value="revision_required" class="dark:bg-slate-850">Revision Required</option>
                        <option value="accepted" class="dark:bg-slate-850">Accepted (Diterima)</option>
                        <option value="rejected" class="dark:bg-slate-850">Rejected (Ditolak)</option>
                    </select>
                </div>
            </div>

            <div>
                <label for="comments" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Komentar & Catatan Review Umum</label>
                <textarea name="comments" id="comments" rows="5" required
                    class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:outline-none focus:border-brand-500 text-slate-800 dark:text-slate-200 text-sm transition"
                    placeholder="Masukkan alasan rekomendasi, kritik konstruktif, serta daftar bagian artikel yang wajib direvisi oleh siswa..."></textarea>
            </div>
        </div>

        <button type="submit" class="w-full py-4 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-base transition shadow-md shadow-brand-600/10">
            Kirim Hasil Peninjauan & Nilai Jurnal
        </button>
    </form>
</div>
@endsection
