<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50 dark:bg-slate-950 transition-colors duration-200">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EduJournal - Platform Jurnal Ilmiah Siswa')</title>
    
    <!-- Dark Mode Initializer -->
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS Play CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        heading: ['Outfit', 'sans-serif'],
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Outfit', sans-serif;
        }
        .ojs-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(3, 105, 161, 0.1);
        }
        .dark .ojs-card {
            background: rgba(15, 23, 42, 0.9);
            border: 1px solid rgba(3, 105, 161, 0.2);
        }
        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
    @yield('styles')
</head>
<body class="flex flex-col min-h-screen text-slate-800 dark:text-slate-200 dark:bg-slate-950 transition-colors duration-200">

    <!-- Header Navbar -->
    <header class="sticky top-4 z-50 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 no-print w-full">
        <nav class="bg-white/90 dark:bg-slate-900/90 backdrop-blur-md border border-slate-200/60 dark:border-slate-800/80 shadow-lg rounded-full px-6 sm:px-8 transition-colors duration-200">
            <div class="flex justify-between h-16">
                <!-- Logo & Brand -->
                <div class="flex items-center">
                    <a href="/" class="flex items-center">
                        <div>
                            <span class="text-xl font-extrabold tracking-tight text-slate-950 dark:text-white">Edu<span class="text-brand-600 dark:text-brand-400">Journal</span></span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="/" class="text-sm font-semibold text-slate-700 dark:text-slate-300 hover:text-brand-600 dark:hover:text-brand-400 transition">Beranda</a>
                    <a href="/search" class="text-sm font-semibold text-slate-700 dark:text-slate-300 hover:text-brand-600 dark:hover:text-brand-400 transition flex items-center space-x-1">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <span>Cari Artikel</span>
                    </a>
                    @auth
                        @if(Auth::user()->role === 'author')
                            <a href="/author" class="text-sm font-semibold text-slate-700 dark:text-slate-300 hover:text-brand-600 dark:hover:text-brand-400 transition">Dashboard Siswa</a>
                            <a href="/author/submit" class="text-sm font-semibold text-slate-700 dark:text-slate-300 hover:text-brand-600 dark:hover:text-brand-400 transition">Kirim Manuskrip</a>
                        @elseif(Auth::user()->role === 'reviewer')
                            <a href="/reviewer" class="text-sm font-semibold text-slate-700 dark:text-slate-300 hover:text-brand-600 dark:hover:text-brand-400 transition">Dashboard Reviewer</a>
                        @elseif(Auth::user()->role === 'partner')
                            <a href="/partner" class="text-sm font-semibold text-slate-700 dark:text-slate-300 hover:text-brand-600 dark:hover:text-brand-400 transition">Dashboard Mitra</a>
                        @elseif(Auth::user()->role === 'admin')
                            <a href="/admin" class="text-sm font-semibold text-slate-700 dark:text-slate-300 hover:text-brand-600 dark:hover:text-brand-400 transition">Dashboard Admin</a>
                        @endif
                    @endauth
                </div>

                <!-- User Session / Action Buttons -->
                <div class="flex items-center space-x-4">
                    <!-- Theme Toggle Button -->
                    <button id="themeToggle" class="p-2.5 rounded-full text-slate-500 dark:text-slate-400 hover:text-brand-600 dark:hover:text-brand-400 hover:bg-slate-100 dark:hover:bg-slate-800/80 transition duration-200 focus:outline-none" title="Ubah Mode Tampilan">
                        <!-- Sun Icon -->
                        <svg id="sunIcon" class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l.707.707M12 8a4 4 0 100 8 4 4 0 000-8z" />
                        </svg>
                        <!-- Moon Icon -->
                        <svg id="moonIcon" class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                    </button>

                    @auth
                        <div class="flex items-center space-x-3 border-l pl-4 border-slate-100 dark:border-slate-800">
                            <div class="hidden lg:block text-right">
                                <span class="block text-sm font-bold text-slate-900 dark:text-white">{{ Auth::user()->name }}</span>
                                <span class="block text-[11px] text-brand-600 dark:text-brand-400 font-semibold uppercase">{{ Auth::user()->role === 'author' ? 'Siswa (Author)' : (Auth::user()->role === 'reviewer' ? 'Reviewer (Guru)' : (Auth::user()->role === 'partner' ? 'Mitra Universitas' : 'Administrator')) }}</span>
                            </div>
                            <form action="/logout" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="p-2 rounded-lg bg-slate-50 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-red-50 dark:hover:bg-red-950/30 hover:text-red-600 dark:hover:text-red-400 transition" title="Log Out">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="/login" class="text-sm font-semibold text-slate-700 dark:text-slate-300 hover:text-brand-600 dark:hover:text-brand-400 transition">Masuk</a>
                        <a href="/register" class="px-4 py-2 rounded-xl bg-brand-600 text-white font-bold text-sm shadow-md shadow-brand-600/15 hover:bg-brand-700 hover:shadow-brand-700/20 transition flex items-center space-x-1">
                            <span>Daftar</span>
                        </a>
                    @endauth
                </div>
            </div>
        </nav>
    </header>

    <!-- Success/Error Alert Container -->
    @if(session('success') || session('error'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 no-print">
        @if(session('success'))
            <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-sm font-medium flex items-center space-x-2">
                <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl text-sm font-medium flex items-center space-x-2">
                <svg class="w-5 h-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif
    </div>
    @endif

    <!-- Main Content Area -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 dark:bg-slate-950 text-slate-400 py-12 border-t border-slate-800 dark:border-slate-900 no-print transition-colors duration-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-size grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <span class="text-white text-lg font-extrabold">Edu<span class="text-brand-500">Journal</span></span>
                    <p class="mt-4 text-sm leading-relaxed text-slate-400">
                        Platform portal jurnal ilmiah siswa digital SMP Negeri 2 Plemahan. Mendorong budaya literasi kritis, analisis ilmiah, dan kreativitas riset sejak dini.
                    </p>
                </div>
                <div>
                    <h3 class="text-white text-sm font-bold tracking-wider uppercase mb-4">Informasi Jurnal</h3>
                    <ul class="space-y-2 text-sm">
                        <li>ISSN: 2984-XXXX (Online)</li>
                        <li>Penerbit: SMP Negeri 2 Plemahan</li>
                        <li>Mitra Institusi: Universitas Brawijaya</li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white text-sm font-bold tracking-wider uppercase mb-4">Akses Cepat</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="/" class="hover:text-white dark:hover:text-brand-400 transition">Beranda</a></li>
                        <li><a href="/search" class="hover:text-white dark:hover:text-brand-400 transition">Cari Artikel</a></li>
                        <li><a href="/login" class="hover:text-white dark:hover:text-brand-400 transition">Masuk Akun</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-slate-800 dark:border-slate-900 mt-12 pt-8 text-center text-xs">
                <p>&copy; 2026 EduJournal. Hak Cipta Dilindungi. Sistem Publikasi Siswa SMP/SMA.</p>
            </div>
        </div>
    </footer>

    <!-- Dark Mode Toggle Script -->
    <script>
        const themeToggleBtn = document.getElementById('themeToggle');
        const sunIcon = document.getElementById('sunIcon');
        const moonIcon = document.getElementById('moonIcon');

        function updateIcons() {
            if (document.documentElement.classList.contains('dark')) {
                sunIcon.classList.remove('hidden');
                moonIcon.classList.add('hidden');
            } else {
                sunIcon.classList.add('hidden');
                moonIcon.classList.remove('hidden');
            }
        }

        // Initialize icons state
        updateIcons();

        if (themeToggleBtn) {
            themeToggleBtn.addEventListener('click', () => {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.theme = 'light';
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.theme = 'dark';
                }
                updateIcons();
            });
        }
    </script>
    @yield('scripts')
</body>
</html>
