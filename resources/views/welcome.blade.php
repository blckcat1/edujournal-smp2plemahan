<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Ruang Cipta - Platform Jurnal Digital & Kreativitas Remaja SMP. Tempat terbaik mempublikasikan artikel ilmiah, esai, cerpen, dan novel siswa.">
    <title>Ruang Cipta - Jurnal Digital & Kreativitas Remaja</title>
    
    <!-- Custom Style Asset -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    <!-- Aravel Animated Background Blobs -->
    <div class="background-blobs">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>
    </div>

    <!-- 1. FLOATING NAVBAR -->
    <header class="navbar-container">
        <nav class="navbar liquid-glass" id="mainNavbar">
            <div class="logo-section">
                <div class="logo-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                </div>
                <h1 class="logo-text">Ruang<span>Cipta</span></h1>
            </div>
            
            <ul class="nav-links" id="navLinks">
                <li class="active"><a href="#home">Beranda</a></li>
                <li><a href="#kategori">Kategori Karya</a></li>
                <li><a href="#panduan">Panduan</a></li>
                <li><a href="#karya" class="trigger-modal">Kirim Karya</a></li>
            </ul>

            <button class="nav-cta-btn trigger-modal" id="navCtaBtn">
                Mulai Berbagi
            </button>

            <button class="menu-toggle" id="menuToggle" aria-label="Toggle Menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </nav>
    </header>

    <!-- 2. HERO SECTION -->
    <section class="hero-wrapper" id="home">
        <div class="hero-banner liquid-glass aravel-curve-large">
            <div class="hero-shapes">
                <!-- Smooth organic decorative waves -->
                <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                    <path fill="url(#heroGrad)" d="M40,-58.2C54.4,-51.7,69.7,-43.3,77.5,-30.3C85.3,-17.3,85.6,0.3,81.1,16.5C76.7,32.7,67.6,47.5,54.7,57.1C41.7,66.7,24.9,71.1,8.1,70C-8.7,68.9,-25.6,62.3,-39.8,52.3C-54,42.4,-65.5,29.1,-70.7,13.6C-75.9,-1.9,-74.9,-19.6,-67.2,-33.4C-59.5,-47.1,-45.1,-56.9,-30.7,-63.3C-16.3,-69.7,-2.1,-72.7,11.2,-68.8C24.4,-64.8,36,-64.7,40,-58.2Z" transform="translate(100 100)" />
                    <defs>
                        <linearGradient id="heroGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="var(--neon-blue)" stop-opacity="0.25"/>
                            <stop offset="100%" stop-color="var(--neon-purple)" stop-opacity="0.05"/>
                        </linearGradient>
                    </defs>
                </svg>
            </div>
            
            <div class="hero-tag">Jurnal Remaja</div>
            <h1>Wadah Kreativitas & Jurnal Ilmiah Remaja</h1>
            <p>Salurkan ide kritis, karya ilmiah, dan imajinasi kreatifmu di portal jurnal digital resmi sekolah. Tunjukkan bakat menulismu hari ini!</p>
            
            <button class="hero-cta-btn trigger-modal" id="heroCtaBtn">
                <span>Mulai Menulis</span>
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </button>
        </div>
    </section>

    <!-- 3. CATEGORY SPLIT -->
    <section class="categories-section" id="kategori">
        <div class="categories-container">
            <!-- Card 1: Akademik -->
            <div class="category-card liquid-glass aravel-card-left interactive-tilt academic" id="cardAcademic">
                <div class="category-icon-wrapper">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--neon-blue)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                </div>
                <div class="category-info">
                    <h3>Karya Akademik</h3>
                    <p>Artikel penelitian sederhana, esai populer, opini ilmiah, laporan proyek sains, serta ulasan buku atau pelajaran sekolah.</p>
                    <a href="#karya" class="category-link">
                        <span>Jelajahi Artikel & Essay</span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Card 2: Kreatif -->
            <div class="category-card liquid-glass aravel-card-right interactive-tilt creative" id="cardCreative">
                <div class="category-icon-wrapper">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--neon-purple)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                    </svg>
                </div>
                <div class="category-info">
                    <h3>Karya Kreatif</h3>
                    <p>Dunia cerita fiksi, kumpulan cerpen bertema persahabatan/petualangan, sajak atau puisi penuh rasa, serta serial bab novel remaja.</p>
                    <a href="#karya" class="category-link">
                        <span>Jelajahi Cerpen & Novel</span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. "KARYA TERBARU" GRID -->
    <section class="recent-works-section" id="karya">
        <div class="section-header">
            <div class="section-title">
                <h2>Karya Terbaru</h2>
                <p>Sorotan tulisan segar langsung dari siswa kreatif sekolah kita.</p>
            </div>
            <div class="filter-tabs">
                <button class="filter-tab active" data-filter="all">Semua Karya</button>
                <button class="filter-tab" data-filter="akademik">Akademik</button>
                <button class="filter-tab" data-filter="kreatif">Kreatif</button>
            </div>
        </div>

        <div class="works-grid">
            @foreach($works as $work)
            <!-- Work Card: {{ $work->title }} -->
            <div class="work-card liquid-glass aravel-curve-medium interactive-tilt" data-category="{{ $work->category }}" id="workCard{{ $work->id }}">
                <div class="work-header">
                    <span class="work-badge {{ $work->category }}">{{ $work->category === 'akademik' ? 'Akademik' : 'Kreatif' }}</span>
                    <span class="work-date">{{ $work->created_at->diffForHumans() }}</span>
                </div>
                <div class="work-body">
                    <h4 class="work-title" onclick="window.location.href='/karya/{{ $work->id }}'">{{ $work->title }}</h4>
                    <p class="work-excerpt">{{ $work->excerpt }}</p>
                </div>
                <div class="work-footer">
                    <div class="student-info">
                        <div class="student-avatar">{{ strtoupper(substr($work->author, 0, 2)) }}</div>
                        <div class="student-name">
                            <span class="name">{{ $work->author }}</span>
                            <span class="class">{{ $work->class }}</span>
                        </div>
                    </div>
                    <div class="work-metrics">
                        <span class="metric-item like-btn" onclick="toggleLike(this, {{ $work->id }})" id="likeBtn{{ $work->id }}">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                            <span class="like-count">{{ $work->likes }}</span>
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- PANDUAN BANNER / BOTTOM CTA -->
    <section class="recent-works-section" id="panduan" style="padding-top: 0;">
        <div class="hero-banner liquid-glass aravel-curve-medium" style="min-height: 250px; padding: 45px 50px;">
            <h3 style="font-family: var(--font-heading); font-size: 1.8rem; font-weight: 700; color: #fff; margin-bottom: 12px;">Ingin Karyamu Dipublikasikan?</h3>
            <p style="margin-bottom: 20px; font-size: 1rem; color: #cbd5e1; max-width: 700px;">Tulis karya orisinalmu (minimal 300 kata untuk cerpen/artikel), mintalah bimbingan guru wali kelas, lalu unggah naskahmu langsung lewat tombol di bawah.</p>
            <button class="nav-cta-btn trigger-modal" style="padding: 12px 30px;">Baca Panduan Lengkap</button>
        </div>
    </section>

    <!-- 5. FLOATING INTERACTIVE MODAL FOR SUBMISSIONS -->
    <div class="modal-overlay" id="submissionModal">
        <div class="modal-container liquid-glass aravel-curve-large">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Kirim Karya Jurnal</h3>
                    <button class="modal-close-btn" id="closeModal" aria-label="Tutup Modal">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                
                <form id="submissionForm" enctype="multipart/form-data">
                    @csrf
                    <!-- Mode Switcher -->
                    <div class="modal-mode-switch">
                        <button type="button" class="modal-mode-btn active" id="modeWrite">Tulis Langsung</button>
                        <button type="button" class="modal-mode-btn" id="modeUpload">Unggah PDF</button>
                    </div>

                    <!-- PDF Upload Dropzone Container -->
                    <div class="pdf-upload-container" id="pdfUploadContainer">
                        <label class="form-label">Dokumen PDF Karya</label>
                        <div class="pdf-dropzone" id="pdfDropzone">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="12" y1="18" x2="12" y2="12"></line>
                                <polyline points="9 15 12 12 15 15"></polyline>
                            </svg>
                            <div class="pdf-dropzone-text">
                                Drag & drop file PDF karyamu di sini, atau <span>Pilih File</span>
                            </div>
                            <input type="file" id="pdfFileInput" name="pdf_file" accept="application/pdf" style="display: none;">
                        </div>
                        <div class="pdf-file-info" id="pdfFileInfo">
                            <span class="file-name" id="pdfFileName">nama_file.pdf</span>
                            <button type="button" class="pdf-file-remove" id="pdfFileRemove">×</button>
                        </div>
                        <div class="pdf-extract-loader" id="pdfExtractLoader">
                            <div class="spinner"></div>
                            <span>Mengekstrak teks & metadata dari PDF...</span>
                        </div>
                    </div>

                    <div class="form-group" id="titleGroup">
                        <label class="form-label" for="karyaTitle">Judul Karya</label>
                        <input type="text" class="form-input" id="karyaTitle" name="title" placeholder="Masukkan judul karyamu di sini..." required>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="studentName">Nama Lengkap</label>
                            <input type="text" class="form-input" id="studentName" name="author" placeholder="Nama lengkapmu" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="studentClass">Kelas</label>
                            <select class="form-select" id="studentClass" name="class" required>
                                <option value="" disabled selected>Pilih kelas...</option>
                                <option value="7A">Kelas 7A</option>
                                <option value="7B">Kelas 7B</option>
                                <option value="7C">Kelas 7C</option>
                                <option value="8A">Kelas 8A</option>
                                <option value="8B">Kelas 8B</option>
                                <option value="8C">Kelas 8C</option>
                                <option value="9A">Kelas 9A</option>
                                <option value="9B">Kelas 9B</option>
                                <option value="9C">Kelas 9C</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="karyaType">Kategori Karya</label>
                        <select class="form-select" id="karyaType" name="category" required>
                            <option value="akademik">Karya Akademik (Esai / Artikel Ilmiah)</option>
                            <option value="kreatif">Karya Kreatif (Cerpen / Puisi / Novel)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="karyaExcerpt">Abstrak / Sinopsis Singkat</label>
                        <textarea class="form-textarea" id="karyaExcerpt" name="excerpt" placeholder="Tuliskan rangkuman singkat tentang karyamu..."></textarea>
                    </div>

                    <button type="submit" class="form-submit-btn">Kirim Karya Sekarang</button>
                </form>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <footer>
        <div class="footer-content">
            <div class="footer-logo">
                Ruang<span>Cipta</span> © 2026
            </div>
            <div class="footer-copyright">
                Dikelola oleh Tim Literasi & Jurnalistik Sekolah Menengah Pertama
            </div>
        </div>
    </footer>

    <!-- Custom Script Asset -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
