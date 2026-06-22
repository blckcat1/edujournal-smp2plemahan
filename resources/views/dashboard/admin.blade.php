@extends('layouts.journal')

@section('title', 'Dashboard Admin - EduJournal')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 transition-colors duration-200">
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Dashboard Administrator</h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Kelola pengguna, kriteria rubrik penilaian, edisi issue jurnal, serta penugasan reviewer & penerbitan manuskrip.</p>
    </div>

    <!-- Stats row -->
    <div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mb-10 text-center">
        <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800 transition-colors duration-200">
            <span class="block text-2xl font-extrabold text-slate-900 dark:text-white">{{ $stats['users'] }}</span>
            <span class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase mt-1">Total User</span>
        </div>
        <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800 transition-colors duration-200">
            <span class="block text-2xl font-extrabold text-slate-900 dark:text-white">{{ $stats['manuscripts'] }}</span>
            <span class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase mt-1">Total Naskah</span>
        </div>
        <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800 transition-colors duration-200">
            <span class="block text-2xl font-extrabold text-emerald-600 dark:text-emerald-400">{{ $stats['published'] }}</span>
            <span class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase mt-1">Diterbitkan</span>
        </div>
        <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800 transition-colors duration-200">
            <span class="block text-2xl font-extrabold text-brand-600 dark:text-brand-400">{{ $stats['under_review'] }}</span>
            <span class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase mt-1">Under Review</span>
        </div>
        <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800 transition-colors duration-200">
            <span class="block text-2xl font-extrabold text-amber-600 dark:text-amber-400">{{ $stats['revisions'] }}</span>
            <span class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase mt-1">Butuh Revisi</span>
        </div>
    </div>

    <!-- Tabs controls -->
    <div class="border-b border-slate-200 dark:border-slate-800 mb-8 flex flex-wrap gap-4">
        <button onclick="switchTab('manuscriptsTab')" id="manuscriptsTabBtn" class="tab-btn pb-3 px-4 text-sm font-extrabold border-b-2 border-brand-500 text-brand-600 dark:text-brand-400 transition">
            Manajemen Manuskrip
        </button>
        <button onclick="switchTab('usersTab')" id="usersTabBtn" class="tab-btn pb-3 px-4 text-sm font-extrabold text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-200 transition">
            Kelola Pengguna
        </button>
        <button onclick="switchTab('issuesTab')" id="issuesTabBtn" class="tab-btn pb-3 px-4 text-sm font-extrabold text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-200 transition">
            Nomor Issue/Volume
        </button>
        <button onclick="switchTab('rubricsTab')" id="rubricsTabBtn" class="tab-btn pb-3 px-4 text-sm font-extrabold text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-200 transition">
            Rubrik Penilaian
        </button>
    </div>

    <!-- TAB CONTENTS -->
    <div class="space-y-8">
        
        <!-- Tab 1: Manuscripts Management -->
        <div id="manuscriptsTab" class="tab-content block space-y-6">
            <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 shadow-sm border border-slate-100 dark:border-slate-800/80">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Daftar Pengajuan Manuskrip Siswa</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600 dark:text-slate-350 border-collapse">
                        <thead>
                            <tr class="bg-slate-50 dark:bg-slate-950 text-slate-505 dark:text-slate-450 font-bold uppercase text-[10px] tracking-wider border-b border-slate-100 dark:border-slate-800/60">
                                <th class="p-4">Naskah</th>
                                <th class="p-4">Penulis</th>
                                <th class="p-4">Status</th>
                                <th class="p-4 text-right">Tindakan Admin</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800/80">
                            @forelse($manuscripts as $man)
                            <tr>
                                <td class="p-4">
                                    <span class="block text-xs font-bold text-brand-600 dark:text-brand-400 uppercase">{{ $man->subject }}</span>
                                    <span class="block font-bold text-slate-900 dark:text-white text-sm leading-snug mt-0.5">{{ $man->title }}</span>
                                    @if($man->doi)
                                    <span class="block text-[10px] text-emerald-600 dark:text-emerald-400 font-semibold uppercase mt-1">DOI: {{ $man->doi }}</span>
                                    @endif
                                </td>
                                <td class="p-4">
                                    <span class="block font-bold text-slate-800 dark:text-slate-200 text-sm">{{ $man->author->name }}</span>
                                    <span class="block text-xs text-slate-400 dark:text-slate-500">{{ $man->author->institution }}</span>
                                </td>
                                <td class="p-4">
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold tracking-wider uppercase bg-brand-50 dark:bg-brand-950/40 text-brand-700 dark:text-brand-400 border border-brand-200 dark:border-brand-900/60">{{ $man->status }}</span>
                                </td>
                                <td class="p-4 text-right space-y-3">
                                    <!-- Download link -->
                                    <div class="flex justify-end gap-2">
                                        @if($man->pdf_path)
                                        <a href="{{ asset($man->pdf_path) }}" target="_blank" class="px-2.5 py-1.5 rounded-lg border border-slate-200 dark:border-slate-700 text-xs font-semibold text-slate-600 dark:text-slate-350 hover:bg-slate-50 dark:hover:bg-slate-800">
                                            Unduh PDF
                                        </a>
                                        @endif
                                    </div>

                                    <!-- If submitted or initial review: Assign Reviewer Form -->
                                    @if(in_array($man->status, ['submitted', 'initial_review']))
                                    <form action="/admin/manuscript/{{ $man->id }}/assign" method="POST" class="flex justify-end items-center gap-2 mt-2">
                                        @csrf
                                        <select name="reviewer_id" required class="px-2 py-1.5 text-xs rounded-lg bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-800 dark:text-slate-200 focus:outline-none">
                                            <option value="" disabled selected class="dark:bg-slate-900">Pilih Guru Reviewer...</option>
                                            @foreach($reviewers as $rev)
                                                <option value="{{ $rev->id }}" class="dark:bg-slate-900">{{ $rev->name }} ({{ $rev->institution }})</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="px-3 py-1.5 rounded-lg bg-brand-600 text-white font-bold text-xs hover:bg-brand-700 whitespace-nowrap">
                                            Tugaskan
                                        </button>
                                    </form>
                                    @endif

                                    <!-- If accepted: Publish Form -->
                                    @if($man->status === 'accepted')
                                    <form action="/admin/manuscript/{{ $man->id }}/publish" method="POST" class="flex justify-end items-center gap-2 mt-2">
                                        @csrf
                                        <select name="issue_id" required class="px-2 py-1.5 text-xs rounded-lg bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-800 dark:text-slate-200 focus:outline-none">
                                            <option value="" disabled selected class="dark:bg-slate-900">Pilih Edisi Issue...</option>
                                            @foreach($issues as $iss)
                                                <option value="{{ $iss->id }}" class="dark:bg-slate-900">{{ $iss->title }}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="px-3 py-1.5 rounded-lg bg-emerald-600 text-white font-bold text-xs hover:bg-emerald-700 whitespace-nowrap">
                                            Terbitkan (Publish)
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="p-8 text-center text-slate-400 dark:text-slate-500 text-xs italic">Belum ada pengajuan manuskrip.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Tab 2: Users Management -->
        <div id="usersTab" class="tab-content hidden space-y-6">
            <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 shadow-sm border border-slate-100 dark:border-slate-800/80">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Daftar Pengguna Platform</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600 dark:text-slate-350 border-collapse">
                        <thead>
                            <tr class="bg-slate-50 dark:bg-slate-950 text-slate-500 dark:text-slate-400 font-bold uppercase text-[10px] tracking-wider border-b border-slate-100 dark:border-slate-800/60">
                                <th class="p-4">Nama</th>
                                <th class="p-4">Email</th>
                                <th class="p-4">Institusi</th>
                                <th class="p-4">Role Saat Ini</th>
                                <th class="p-4 text-right">Ubah Role</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800/80">
                            @foreach($users as $user)
                            <tr>
                                <td class="p-4 font-bold text-slate-900 dark:text-white">{{ $user->name }}</td>
                                <td class="p-4 font-mono text-xs text-slate-550 dark:text-slate-400">{{ $user->email }}</td>
                                <td class="p-4 text-xs">{{ $user->institution }}</td>
                                <td class="p-4">
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-slate-100 dark:bg-slate-805 text-slate-600 dark:text-slate-350">
                                        {{ $user->role }}
                                    </span>
                                </td>
                                <td class="p-4 text-right">
                                    <form action="/admin/user/{{ $user->id }}/role" method="POST" class="inline-flex justify-end gap-1.5">
                                        @csrf
                                        <select name="role" required class="px-2 py-1 text-xs rounded bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-800 dark:text-slate-200 focus:outline-none">
                                            <option value="reader" {{ $user->role === 'reader' ? 'selected' : '' }} class="dark:bg-slate-900">Reader</option>
                                            <option value="author" {{ $user->role === 'author' ? 'selected' : '' }} class="dark:bg-slate-900">Author</option>
                                            <option value="reviewer" {{ $user->role === 'reviewer' ? 'selected' : '' }} class="dark:bg-slate-900">Reviewer</option>
                                            <option value="partner" {{ $user->role === 'partner' ? 'selected' : '' }} class="dark:bg-slate-900">Partner</option>
                                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }} class="dark:bg-slate-900">Admin</option>
                                        </select>
                                        <button type="submit" class="px-2.5 py-1 rounded bg-slate-900 dark:bg-slate-800 text-white hover:bg-slate-800 dark:hover:bg-slate-700 text-[10px] font-bold transition">
                                            Simpan
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

        <!-- Tab 3: Issues Management -->
        <div id="issuesTab" class="tab-content hidden grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Left: Add Issue Form -->
            <div class="lg:col-span-4 bg-white dark:bg-slate-900 rounded-3xl p-6 shadow-sm border border-slate-100 dark:border-slate-800/80 h-fit">
                <h3 class="text-base font-bold text-slate-900 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-3 mb-4">Tambah Issue Jurnal Baru</h3>
                <form action="/admin/issue" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="volume" class="block text-xs font-bold text-slate-500 dark:text-slate-450 uppercase mb-2">Volume Nomor</label>
                        <input type="number" name="volume" id="volume" required class="w-full px-3 py-2 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-800 dark:text-slate-100 text-sm">
                    </div>
                    <div>
                        <label for="issue_number" class="block text-xs font-bold text-slate-500 dark:text-slate-455 uppercase mb-2">Issue Nomor</label>
                        <input type="number" name="issue_number" id="issue_number" required class="w-full px-3 py-2 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-800 dark:text-slate-100 text-sm">
                    </div>
                    <div>
                        <label for="year" class="block text-xs font-bold text-slate-500 dark:text-slate-455 uppercase mb-2">Tahun Terbit</label>
                        <input type="number" name="year" id="year" required class="w-full px-3 py-2 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-800 dark:text-slate-100 text-sm" placeholder="2026">
                    </div>
                    <div>
                        <label for="issue_title" class="block text-xs font-bold text-slate-500 dark:text-slate-455 uppercase mb-2">Judul Label Issue</label>
                        <input type="text" name="title" id="issue_title" required class="w-full px-3 py-2 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-800 dark:text-slate-100 text-sm" placeholder="Contoh: Vol. 1 No. 1 (2026)">
                    </div>
                    <button type="submit" class="w-full py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs transition">
                        Tambah Nomor Issue
                    </button>
                </form>
            </div>

            <!-- Right: Issues List -->
            <div class="lg:col-span-8 bg-white dark:bg-slate-900 rounded-3xl p-6 shadow-sm border border-slate-100 dark:border-slate-800/80">
                <h3 class="text-base font-bold text-slate-900 dark:text-white mb-4">Daftar Edisi / Issue Jurnal</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600 dark:text-slate-350 border-collapse">
                        <thead>
                            <tr class="bg-slate-50 dark:bg-slate-950 text-slate-505 dark:text-slate-450 font-bold uppercase text-[10px] tracking-wider border-b border-slate-100 dark:border-slate-800/60">
                                <th class="p-4">Nomor Label</th>
                                <th class="p-4">Tahun</th>
                                <th class="p-4">Artikel Terbit</th>
                                <th class="p-4">Status</th>
                                <th class="p-4 text-right">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800/80">
                            @foreach($issues as $iss)
                            <tr>
                                <td class="p-4 font-bold text-slate-900 dark:text-white">{{ $iss->title }}</td>
                                <td class="p-4 font-semibold text-slate-800 dark:text-slate-200">{{ $iss->year }}</td>
                                <td class="p-4 text-slate-500 dark:text-slate-400">{{ $iss->manuscripts_count }} artikel</td>
                                <td class="p-4">
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase {{ $iss->status === 'published' ? 'bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-400 border border-emerald-250 dark:border-emerald-900/60' : 'bg-amber-50 dark:bg-amber-950/40 text-amber-700 dark:text-amber-400 border border-amber-250 dark:border-amber-900/60' }}">
                                        {{ $iss->status }}
                                    </span>
                                </td>
                                <td class="p-4 text-right">
                                    @if($iss->status === 'draft')
                                    <a href="/admin/issue/{{ $iss->id }}/publish" class="px-3 py-1 rounded bg-emerald-600 text-white hover:bg-emerald-700 text-[10px] font-bold transition">
                                        Terbitkan Online
                                    </a>
                                    @else
                                    <span class="text-xs text-slate-400 dark:text-slate-500">Aktif Publik</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Tab 4: Rubrics Management -->
        <div id="rubricsTab" class="tab-content hidden grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Left: Add Criteria Form -->
            <div class="lg:col-span-4 bg-white dark:bg-slate-900 rounded-3xl p-6 shadow-sm border border-slate-100 dark:border-slate-800/80 h-fit">
                <h3 class="text-base font-bold text-slate-900 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-3 mb-4">Tambah Kriteria Rubrik</h3>
                <form action="/admin/rubric" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="criteria_name" class="block text-xs font-bold text-slate-505 dark:text-slate-450 uppercase mb-2">Nama Kriteria</label>
                        <input type="text" name="criteria_name" id="criteria_name" required class="w-full px-3 py-2 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-800 dark:text-slate-100 text-sm" placeholder="Contoh: Orisinalitas Penelitian">
                    </div>
                    <div>
                        <label for="weight" class="block text-xs font-bold text-slate-505 dark:text-slate-450 uppercase mb-2">Bobot Nilai (%)</label>
                        <input type="number" name="weight" id="weight" min="1" max="100" required class="w-full px-3 py-2 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-800 dark:text-slate-100 text-sm" placeholder="Contoh: 20">
                    </div>
                    <div>
                        <label for="max_score" class="block text-xs font-bold text-slate-505 dark:text-slate-455 uppercase mb-2">Skor Maksimal</label>
                        <input type="number" name="max_score" id="max_score" min="10" max="100" required class="w-full px-3 py-2 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-800 dark:text-slate-100 text-sm" value="100">
                    </div>
                    <button type="submit" class="w-full py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs transition">
                        Simpan Kriteria
                    </button>
                </form>
            </div>

            <!-- Right: Rubrics List -->
            <div class="lg:col-span-8 bg-white dark:bg-slate-900 rounded-3xl p-6 shadow-sm border border-slate-100 dark:border-slate-800/80">
                <h3 class="text-base font-bold text-slate-900 dark:text-white mb-4">Daftar Kriteria Penilaian Rubrik</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600 dark:text-slate-350 border-collapse">
                        <thead>
                            <tr class="bg-slate-50 dark:bg-slate-950 text-slate-505 dark:text-slate-450 font-bold uppercase text-[10px] tracking-wider border-b border-slate-100 dark:border-slate-800/60">
                                <th class="p-4">Kriteria Penilaian</th>
                                <th class="p-4">Bobot (%)</th>
                                <th class="p-4">Skor Maksimal</th>
                                <th class="p-4 text-right">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800/80">
                            @foreach($rubrics as $rub)
                            <tr>
                                <td class="p-4 font-bold text-slate-805 dark:text-slate-200">{{ $rub->criteria_name }}</td>
                                <td class="p-4 font-semibold text-brand-600 dark:text-brand-400">{{ $rub->weight }}%</td>
                                <td class="p-4">{{ $rub->max_score }}</td>
                                <td class="p-4 text-right">
                                    <a href="/admin/rubric/{{ $rub->id }}/delete" class="px-2.5 py-1 rounded bg-red-50 dark:bg-red-950/20 text-red-600 dark:text-red-400 hover:bg-red-100 hover:text-red-700 text-[10px] font-bold transition">
                                        Hapus
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            <tr class="bg-slate-50 dark:bg-slate-950 font-bold text-slate-900 dark:text-white">
                                <td class="p-4">Total Akumulasi Bobot Kriteria</td>
                                <td class="p-4 text-brand-600 dark:text-brand-400">{{ $rubrics->sum('weight') }}%</td>
                                <td colspan="2"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script>
    function switchTab(tabId) {
        // Hide all tab contents
        document.querySelectorAll('.tab-content').forEach(el => {
            el.classList.add('hidden');
            el.classList.remove('block');
        });

        // Show selected tab content
        document.getElementById(tabId).classList.remove('hidden');
        document.getElementById(tabId).classList.add('block');

        // Reset all tab button styles
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('border-b-2', 'border-brand-500', 'text-brand-600');
            btn.classList.add('text-slate-500');
        });

        // Highlight selected tab button
        document.getElementById(tabId + 'Btn').classList.add('border-b-2', 'border-brand-500', 'text-brand-600');
        document.getElementById(tabId + 'Btn').classList.remove('text-slate-500');
    }
</script>
@endsection
