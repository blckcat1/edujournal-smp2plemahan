@extends('layouts.journal')

@section('title', 'Submission Summary - EduJournal')

@section('styles')
<style>
    @media print {
        body {
            background-color: white !important;
            color: black !important;
        }
        .print-card {
            border: none !important;
            box-shadow: none !important;
            padding: 0 !important;
        }
    }
</style>
@endsection

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <!-- Top toolbar / actions -->
    <div class="mb-6 flex flex-wrap items-center justify-between gap-4 no-print">
        <a href="/author" class="inline-flex items-center space-x-2 text-sm font-semibold text-slate-500 hover:text-sky-900 transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span>Kembali ke Dashboard</span>
        </a>
        <button onclick="window.print()" 
            class="px-5 py-2.5 rounded bg-sky-900 hover:bg-sky-950 text-white font-bold text-xs uppercase tracking-wider transition flex items-center space-x-2 shadow-sm cursor-pointer">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-3a2 2 0 00-2-2H9a2 2 0 00-2 2v3a2 2 0 002 2zm5-17v4m0 0V5m0 0h4m-4 0H8" />
            </svg>
            <span>Cetak / Simpan PDF</span>
        </button>
    </div>

    <!-- Summary Content Card -->
    <div class="bg-white dark:bg-slate-900 rounded-lg border border-slate-200 dark:border-slate-800 p-8 shadow-sm print-card space-y-8">
        <!-- Title block -->
        <div class="border-b border-slate-250 dark:border-slate-800 pb-6 text-center sm:text-left">
            <span class="text-[10px] font-extrabold uppercase tracking-widest text-sky-900 dark:text-sky-400">
                Bukti Pendaftaran Submisi Jurnal (Submission Receipt)
            </span>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white mt-2 font-heading">
                {{ $manuscript->title }}
            </h1>
            @if($manuscript->subtitle)
            <h2 class="text-base font-semibold text-slate-500 dark:text-slate-400 mt-1">
                {{ $manuscript->subtitle }}
            </h2>
            @endif
            
            <div class="flex flex-wrap gap-4 text-xs text-slate-400 dark:text-slate-500 mt-4 font-semibold">
                <div>ID Submisi: <span class="text-slate-700 dark:text-slate-350">#{{ $manuscript->id }}</span></div>
                <div>&bull;</div>
                <div>Tanggal Submit: <span class="text-slate-700 dark:text-slate-350">{{ $manuscript->created_at->format('d F Y, H:i') }}</span></div>
                <div>&bull;</div>
                <div>Subjek: <span class="text-slate-700 dark:text-slate-350">{{ $manuscript->subject }}</span></div>
            </div>
        </div>

        <!-- Abstract block -->
        <div class="space-y-3">
            <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">
                Abstrak / Abstract
            </h3>
            <p class="text-sm text-slate-700 dark:text-slate-300 leading-relaxed text-justify bg-slate-50 dark:bg-slate-950/40 p-5 rounded border border-slate-150 dark:border-slate-800 font-serif">
                {{ $manuscript->abstract }}
            </p>
        </div>

        <!-- Files list -->
        <div class="space-y-4">
            <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 border-b border-slate-100 dark:border-slate-800 pb-1">
                Berkas Naskah (Submission Files)
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="p-4 bg-slate-50 dark:bg-slate-950/40 border border-slate-200 dark:border-slate-800 rounded flex items-center justify-between text-xs">
                    <div>
                        <span class="block font-bold text-slate-800 dark:text-slate-200">Main Manuscript Document</span>
                        <span class="block text-[10px] text-slate-400 dark:text-slate-500 mt-0.5">Format: PDF</span>
                    </div>
                    @if($manuscript->pdf_path)
                    <a href="{{ asset($manuscript->pdf_path) }}" download 
                        class="px-3 py-1.5 bg-sky-900 hover:bg-sky-950 text-white rounded font-bold uppercase text-[10px] tracking-wider transition no-print">
                        Unduh
                    </a>
                    @else
                    <span class="text-slate-400 italic">No file uploaded</span>
                    @endif
                </div>

                @if($manuscript->supporting_files)
                <div class="p-4 bg-slate-50 dark:bg-slate-950/40 border border-slate-200 dark:border-slate-800 rounded flex items-center justify-between text-xs">
                    <div>
                        <span class="block font-bold text-slate-800 dark:text-slate-200">Supporting Attachment</span>
                        <span class="block text-[10px] text-slate-400 dark:text-slate-500 mt-0.5">Supplementary File</span>
                    </div>
                    <a href="{{ asset($manuscript->supporting_files) }}" download 
                        class="px-3 py-1.5 bg-slate-700 hover:bg-slate-800 text-white rounded font-bold uppercase text-[10px] tracking-wider transition no-print">
                        Unduh
                    </a>
                </div>
                @endif
            </div>
        </div>

        <!-- Contributors list -->
        <div class="space-y-4">
            <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 border-b border-slate-100 dark:border-slate-800 pb-1">
                Daftar Penulis (List of Contributors)
            </h3>
            
            <div class="overflow-x-auto border border-slate-200 dark:border-slate-800 rounded">
                <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-800 text-xs">
                    <thead class="bg-slate-50 dark:bg-slate-800/60 font-bold text-slate-505 uppercase">
                        <tr>
                            <th class="px-4 py-3 text-left">Nama</th>
                            <th class="px-4 py-3 text-left">Email</th>
                            <th class="px-4 py-3 text-left">Afiliasi / Universitas</th>
                            <th class="px-4 py-3 text-center">Peran</th>
                            <th class="px-4 py-3 text-center">Kontak Utama</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-800 text-slate-700 dark:text-slate-300">
                        @if($manuscript->contributors && is_array($manuscript->contributors))
                            @foreach($manuscript->contributors as $c)
                            <tr>
                                <td class="px-4 py-3 font-bold text-slate-900 dark:text-white">{{ $c['name'] }}</td>
                                <td class="px-4 py-3 text-slate-500 dark:text-slate-400">{{ $c['email'] }}</td>
                                <td class="px-4 py-3 text-slate-505 dark:text-slate-400">{{ $c['affiliation'] }} ({{ $c['country'] }})</td>
                                <td class="px-4 py-3 text-center">{{ $c['role'] }}</td>
                                <td class="px-4 py-3 text-center">
                                    @if(isset($c['principal']) && ($c['principal'] === true || $c['principal'] === 'true' || $c['principal'] == 1))
                                        <span class="px-2 py-0.5 rounded bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-400 font-bold border border-emerald-250 dark:border-emerald-900/60 text-[9px] uppercase tracking-wider">
                                            Primary Contact
                                        </span>
                                    @else
                                        <span class="text-slate-400">&mdash;</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="px-4 py-3 font-bold text-slate-900 dark:text-white">{{ $manuscript->author->name }}</td>
                                <td class="px-4 py-3 text-slate-500 dark:text-slate-400">{{ $manuscript->author->email }}</td>
                                <td class="px-4 py-3 text-slate-505 dark:text-slate-400">{{ $manuscript->author->institution }} ({{ $manuscript->author->country ?? 'Indonesia' }})</td>
                                <td class="px-4 py-3 text-center">Author</td>
                                <td class="px-4 py-3 text-center">
                                    <span class="px-2 py-0.5 rounded bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-400 font-bold border border-emerald-250 dark:border-emerald-900/60 text-[9px] uppercase tracking-wider">
                                        Primary Contact
                                    </span>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Keywords & Comments & References -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Keywords & Comments to Editor -->
            <div class="space-y-6">
                <!-- Keywords -->
                <div class="space-y-3">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">
                        Kata Kunci (Keywords)
                    </h3>
                    <div class="flex flex-wrap gap-2">
                        @if($manuscript->keywords)
                            @foreach(explode(',', $manuscript->keywords) as $keyword)
                                @if(trim($keyword) !== "")
                                <span class="px-2.5 py-1 rounded bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 font-semibold border border-slate-200 dark:border-slate-700">
                                    {{ trim($keyword) }}
                                </span>
                                @endif
                            @endforeach
                        @else
                            <span class="text-xs text-slate-400 italic">No keywords added</span>
                        @endif
                    </div>
                </div>

                <!-- Comments to Editor -->
                <div class="space-y-3">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">
                        Catatan untuk Editor (Comments to Editor)
                    </h3>
                    <div class="p-4 bg-slate-50 dark:bg-slate-950/40 border border-slate-200 dark:border-slate-800 rounded text-xs text-slate-700 dark:text-slate-350 leading-relaxed min-h-[80px]">
                        @if($manuscript->comments_to_editor)
                            {!! nl2br(e($manuscript->comments_to_editor)) !!}
                        @else
                            <span class="text-slate-400 italic">Tidak ada catatan untuk editor.</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- References -->
            <div class="space-y-3">
                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">
                    Daftar Pustaka (References)
                </h3>
                <div class="p-4 bg-slate-50 dark:bg-slate-950/40 border border-slate-200 dark:border-slate-800 rounded font-mono text-[10px] text-slate-600 dark:text-slate-400 leading-relaxed h-[180px] overflow-y-auto whitespace-pre-wrap select-all">@if($manuscript->references){{ trim($manuscript->references) }}@else<span class="text-slate-400 italic font-sans">No references provided.</span>@endif</div>
            </div>
        </div>

        <!-- Institutional Signature Box -->
        <div class="pt-8 border-t border-slate-250 dark:border-slate-800 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-400 dark:text-slate-550 gap-6">
            <div>
                <p>&copy; 2026 EduJournal. Hak Cipta Dilindungi.</p>
                <p class="mt-1">Dihasilkan secara otomatis oleh sistem publikasi OJS 3.</p>
            </div>
            <div class="text-center sm:text-right border-t sm:border-t-0 pt-4 sm:pt-0 border-dashed border-slate-200 dark:border-slate-800">
                <span class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest">Status Verifikasi</span>
                <span class="block font-bold text-emerald-600 dark:text-emerald-400 uppercase tracking-wider mt-1 text-sm">
                    Verified Submission
                </span>
            </div>
        </div>
    </div>
</div>
@endsection
