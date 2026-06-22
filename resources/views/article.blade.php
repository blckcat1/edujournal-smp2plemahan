@extends('layouts.journal')

@section('title', $manuscript->title . ' - EduJournal')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Back to search -->
    <div class="mb-6">
        <a href="/search" class="inline-flex items-center space-x-2 text-sm font-semibold text-slate-500 dark:text-slate-400 hover:text-brand-600 dark:hover:text-brand-400 transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            <span>Kembali ke Hasil Pencarian</span>
        </a>
    </div>

    <!-- Main Grid Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Left: Article Content -->
        <div class="lg:col-span-8 space-y-8">
            <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-100 dark:border-slate-800/80 transition-colors duration-200">
                <!-- Metadata header -->
                <div class="flex flex-wrap items-center gap-2 mb-4 text-xs font-bold">
                    <span class="px-2.5 py-0.5 rounded-md bg-brand-50 dark:bg-brand-950/40 text-brand-700 dark:text-brand-400 uppercase tracking-wide">{{ $manuscript->subject }}</span>
                    <span class="text-slate-300">|</span>
                    <span class="text-slate-400 dark:text-slate-500">Dipublikasikan pada {{ $manuscript->published_at ? $manuscript->published_at->format('d M Y') : $manuscript->created_at->format('d M Y') }}</span>
                </div>

                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white leading-snug mb-4">
                    {{ $manuscript->title }}
                </h1>

                <!-- Author list -->
                <div class="flex items-center space-x-3 mb-8 pb-6 border-b border-slate-100 dark:border-slate-800">
                    <div class="w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-sm font-bold text-slate-700 dark:text-slate-300 flex items-center justify-center">
                        {{ strtoupper(substr($manuscript->author->name, 0, 2)) }}
                    </div>
                    <div>
                        <span class="block text-sm font-bold text-slate-900 dark:text-white">{{ $manuscript->author->name }}</span>
                        <span class="block text-xs text-slate-500 dark:text-slate-400">{{ $manuscript->author->institution }}</span>
                    </div>
                </div>

                <!-- Abstract -->
                <div class="mb-8">
                    <h3 class="text-sm font-extrabold uppercase text-slate-400 dark:text-slate-500 tracking-wider mb-3">Abstract / Abstrak</h3>
                    <p class="text-slate-700 dark:text-slate-300 text-sm leading-relaxed text-justify bg-slate-50 dark:bg-slate-950/40 p-6 rounded-2xl border border-slate-100 dark:border-slate-800">
                        {{ $manuscript->abstract }}
                    </p>
                </div>

                <!-- Keywords -->
                <div class="mb-8 flex flex-wrap items-center gap-2">
                    <span class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Keywords:</span>
                    @foreach(explode(',', $manuscript->keywords) as $keyword)
                        <span class="px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-350 text-xs font-medium border border-slate-200/50 dark:border-slate-700">
                            {{ trim($keyword) }}
                        </span>
                    @endforeach
                </div>

                <!-- Action Toolbar -->
                <div class="flex flex-wrap items-center justify-between gap-4 pt-6 border-t border-slate-100 dark:border-slate-800">
                    <!-- Like button (AJAX) -->
                    <button onclick="toggleLike({{ $manuscript->id }})" id="likeBtn" 
                        class="px-5 py-2.5 rounded-xl border flex items-center space-x-2 text-sm font-bold transition {{ $alreadyLiked ? 'bg-emerald-50 dark:bg-emerald-950/30 border-emerald-200 dark:border-emerald-800/80 text-emerald-700 dark:text-emerald-400' : 'border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-850' }}">
                        <svg class="w-5 h-5 {{ $alreadyLiked ? 'fill-emerald-600 text-emerald-600' : 'text-slate-400 dark:text-slate-500' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" id="likeIcon">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h2a2 2 0 012 2v6a2 2 0 01-2 2H7a2 2 0 01-2-2v-5a2 2 0 012-2m4 0V4a2 2 0 00-2-2 2 2 0 00-2 2v4h5z" />
                        </svg>
                        <span id="likeText">{{ $alreadyLiked ? 'Disukai' : 'Sukai Artikel' }}</span>
                        <span id="likeCount" class="bg-white/60 dark:bg-slate-800/60 px-2 py-0.5 rounded text-xs ml-1 border border-slate-100 dark:border-slate-700">{{ $manuscript->likes }}</span>
                    </button>

                    <!-- PDF Download Button -->
                    @if($manuscript->pdf_path)
                    <a href="{{ asset($manuscript->pdf_path) }}" download class="px-5 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-sm shadow-md shadow-brand-600/10 transition flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                        <span>Unduh PDF Fulltext</span>
                    </a>
                    @endif
                </div>
            </div>

            <!-- PDF Viewer Panel -->
            @if($manuscript->pdf_path)
            <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 shadow-sm border border-slate-100 dark:border-slate-800">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4 flex items-center space-x-2">
                    <svg class="w-5 h-5 text-brand-600 dark:text-brand-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                    <span>Pratinjau PDF Dokumen</span>
                </h3>
                <iframe src="{{ asset($manuscript->pdf_path) }}" width="100%" height="600px" class="border border-slate-150 dark:border-slate-800 rounded-2xl shadow-inner"></iframe>
            </div>
            @endif

            <!-- Comment Section -->
            <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-100 dark:border-slate-800 space-y-8">
                <div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Diskusi & Komentar</h3>
                    <p class="text-xs text-slate-400 dark:text-slate-500">Berikan masukan akademik, apresiasi, atau pertanyaan penelitian Anda.</p>
                </div>

                <!-- Academic Comments / Mitra Universitas (highlighted) -->
                @php
                    $academicComments = $comments->where('type', 'academic');
                    $publicComments = $comments->where('type', 'public');
                @endphp

                @if($academicComments->count() > 0)
                <div class="space-y-4">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-amber-600 dark:text-amber-400 flex items-center space-x-1">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 9.172V5L8 4z" /></svg>
                        <span>Tinjauan Mitra Universitas & Dosen (Komentar Akademik)</span>
                    </h4>
                    <div class="space-y-3">
                        @foreach($academicComments as $ac)
                        <div class="bg-amber-50/50 dark:bg-amber-950/20 border border-amber-200/60 dark:border-amber-900/40 rounded-2xl p-5 text-sm">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <span class="font-bold text-slate-900 dark:text-white">{{ $ac->author_name }}</span>
                                    <span class="block text-[10px] text-amber-700 dark:text-amber-400 font-bold uppercase mt-0.5">{{ $ac->user ? $ac->user->institution : 'Mitra Eksternal' }}</span>
                                </div>
                                <span class="text-[10px] text-slate-400 dark:text-slate-550 font-semibold">{{ $ac->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-slate-700 dark:text-slate-300 mt-2 italic leading-relaxed">{{ $ac->content }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Comment submission form -->
                <form action="/article/{{ $manuscript->id }}/comment" method="POST" class="space-y-4 pt-4 border-t border-slate-100 dark:border-slate-800">
                    @csrf
                    @auth
                        @if(Auth::user()->role === 'partner')
                        <div>
                            <label for="type" class="block text-xs font-bold text-slate-505 dark:text-slate-450 uppercase tracking-wider mb-2">Jenis Komentar</label>
                            <select name="type" id="type" required 
                                class="px-3.5 py-2 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-sm font-semibold text-slate-700 dark:text-slate-300 focus:outline-none">
                                <option value="academic" class="dark:bg-slate-900">Komentar Akademik / Saran Perbaikan Mitra</option>
                                <option value="public" class="dark:bg-slate-900">Komentar Pembaca Umum</option>
                            </select>
                        </div>
                        @else
                        <input type="hidden" name="type" value="public">
                        @endif
                    @else
                        <input type="hidden" name="type" value="public">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="author_name" class="block text-xs font-bold text-slate-505 dark:text-slate-450 uppercase tracking-wider mb-2">Nama Anda</label>
                                <input type="text" name="author_name" id="author_name" required 
                                    class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:outline-none focus:border-brand-500 text-slate-800 dark:text-slate-200 text-sm transition"
                                    placeholder="Masukkan nama Anda...">
                            </div>
                        </div>
                    @endauth

                    <div>
                        <label for="content" class="block text-xs font-bold text-slate-505 dark:text-slate-450 uppercase tracking-wider mb-2">Tulis Komentar</label>
                        <textarea name="content" id="content" rows="4" required 
                            class="w-full px-4 py-3 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:outline-none focus:border-brand-500 focus:bg-white dark:focus:bg-slate-850 text-slate-800 dark:text-slate-200 text-sm transition"
                            placeholder="Tuliskan komentar, pertanyaan, atau ulasan Anda di sini..."></textarea>
                    </div>

                    <button type="submit" class="px-5 py-3 rounded-xl bg-slate-900 dark:bg-slate-800 hover:bg-slate-800 dark:hover:bg-slate-700 text-white font-bold text-xs transition">
                        Kirim Komentar
                    </button>
                </form>

                <!-- Public Comments list -->
                <div class="space-y-4 pt-6 border-t border-slate-100 dark:border-slate-800">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Semua Komentar Publik ({{ $publicComments->count() }})</h4>
                    <div class="space-y-4">
                        @forelse($publicComments as $pc)
                        <div class="bg-slate-50/50 dark:bg-slate-850/40 border border-slate-100 dark:border-slate-800/80 rounded-2xl p-4 text-sm">
                            <div class="flex justify-between items-start">
                                <div>
                                    <span class="font-bold text-slate-800 dark:text-slate-200">{{ $pc->author_name }}</span>
                                    <span class="block text-[9px] text-slate-400 dark:text-slate-500 font-semibold uppercase">{{ $pc->user ? $pc->user->role : 'Reader' }}</span>
                                </div>
                                <span class="text-[10px] text-slate-400 dark:text-slate-550 font-semibold">{{ $pc->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-slate-600 dark:text-slate-350 mt-2 leading-relaxed">{{ $pc->content }}</p>
                        </div>
                        @empty
                        <p class="text-xs text-slate-400 dark:text-slate-500 italic">Belum ada diskusi publik pada artikel ini.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Metadata & Cite Box -->
        <div class="lg:col-span-4 space-y-6">
            <!-- Article info details -->
            <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 shadow-sm border border-slate-100 dark:border-slate-800 space-y-4 text-sm transition-colors duration-200">
                <h3 class="text-base font-extrabold text-slate-900 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-3">Informasi Manuskrip</h3>
                
                <div>
                    <span class="block text-[10px] text-slate-400 dark:text-slate-500 font-bold uppercase">Kode DOI Unik</span>
                    <span class="font-bold text-brand-700 dark:text-brand-400">{{ $manuscript->doi }}</span>
                </div>

                @if($manuscript->issue)
                <div>
                    <span class="block text-[10px] text-slate-400 dark:text-slate-500 font-bold uppercase">Volume & Nomor Edisi</span>
                    <span class="text-slate-800 dark:text-slate-350">{{ $manuscript->issue->title }}</span>
                </div>
                @endif

                <div>
                    <span class="block text-[10px] text-slate-400 dark:text-slate-500 font-bold uppercase">Subjek Penelitian</span>
                    <span class="text-slate-800 dark:text-slate-350">Pelajaran {{ $manuscript->subject }}</span>
                </div>

                <div>
                    <span class="block text-[10px] text-slate-400 dark:text-slate-500 font-bold uppercase">Status Publikasi</span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold uppercase tracking-wider {{ $manuscript->status === 'published' ? 'bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-900/60' : 'bg-brand-50 dark:bg-brand-950/40 text-brand-700 dark:text-brand-400 border border-brand-200 dark:border-brand-900/60' }} mt-1">
                        {{ $manuscript->status === 'published' ? 'Published' : $manuscript->status }}
                    </span>
                </div>
            </div>

            <!-- Citation Box -->
            <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 shadow-sm border border-slate-100 dark:border-slate-800 space-y-4 text-sm transition-colors duration-200">
                <h3 class="text-base font-extrabold text-slate-900 dark:text-white flex items-center space-x-2">
                    <svg class="w-5 h-5 text-brand-600 dark:text-brand-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
                    <span>Format Sitasi (APA)</span>
                </h3>
                <div class="bg-slate-50 dark:bg-slate-950 p-4 rounded-xl border border-slate-100 dark:border-slate-800 text-xs text-slate-600 dark:text-slate-400 select-all font-mono leading-relaxed break-words">
                    {{ $manuscript->author->name }}. ({{ $manuscript->published_at ? $manuscript->published_at->format('Y') : $manuscript->created_at->format('Y') }}). {{ $manuscript->title }}. EduJournal, {{ $manuscript->issue ? 'Vol. ' . $manuscript->issue->volume . ' No. ' . $manuscript->issue->issue_number : '' }}. DOI: {{ $manuscript->doi }}
                </div>
            </div>

            <!-- Download Supporting Files -->
            @if($manuscript->supporting_files)
            <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 shadow-sm border border-slate-100 dark:border-slate-800 space-y-3 text-sm transition-colors duration-200">
                <h3 class="text-base font-bold text-slate-900 dark:text-white">Dokumen Pendukung</h3>
                <p class="text-xs text-slate-400 dark:text-slate-500">Unduh data tambahan, instrumen penilaian, atau media pelengkap.</p>
                <a href="{{ asset($manuscript->supporting_files) }}" download class="w-full py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-350 text-center font-bold text-xs transition flex items-center justify-center space-x-2">
                    <svg class="w-4 h-4 text-slate-500 dark:text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    <span>Unduh Lampiran Riset</span>
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function toggleLike(manuscriptId) {
        fetch('/article/' + manuscriptId + '/like', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                const countText = document.getElementById('likeCount');
                const btn = document.getElementById('likeBtn');
                const icon = document.getElementById('likeIcon');
                const text = document.getElementById('likeText');
                
                countText.textContent = data.likes;
                if (data.liked) {
                    btn.classList.add('bg-emerald-50', 'dark:bg-emerald-950/30', 'border-emerald-200', 'dark:border-emerald-800/80', 'text-emerald-700', 'dark:text-emerald-400');
                    btn.classList.remove('border-slate-200', 'dark:border-slate-700', 'text-slate-600', 'dark:text-slate-300');
                    icon.classList.add('fill-emerald-600', 'text-emerald-600');
                    text.textContent = 'Disukai';
                } else {
                    btn.classList.remove('bg-emerald-50', 'dark:bg-emerald-950/30', 'border-emerald-200', 'dark:border-emerald-800/80', 'text-emerald-700', 'dark:text-emerald-400');
                    btn.classList.add('border-slate-200', 'dark:border-slate-700', 'text-slate-600', 'dark:text-slate-300');
                    icon.classList.remove('fill-emerald-600', 'text-emerald-600');
                    text.textContent = 'Sukai Artikel';
                }
            }
        })
        .catch(err => console.error(err));
    }
</script>
@endsection
