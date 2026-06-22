<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Membaca {{ $work['title'] }} oleh {{ $work['author'] }} - Ruang Cipta Digital Journal.">
    <title>{{ $work['title'] }} - Ruang Cipta</title>
    
    <!-- Custom Style Asset -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .reader-wrapper {
            width: 100%;
            max-width: 900px;
            margin: 120px auto 60px;
            padding: 0 20px;
            position: relative;
            z-index: 10;
        }
        
        .back-btn-container {
            margin-bottom: 30px;
        }
        
        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: #cbd5e1;
            text-decoration: none;
            font-family: var(--font-heading);
            font-weight: 600;
            padding: 10px 24px;
            border-radius: 20px;
            font-size: 0.9rem;
        }
        
        .back-btn svg {
            transition: transform 0.3s ease;
        }
        
        .back-btn:hover svg {
            transform: translateX(-4px);
        }
        
        .reader-card {
            padding: 50px 60px;
        }
        
        .reader-header {
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            padding-bottom: 30px;
            margin-bottom: 40px;
        }
        
        .reader-meta-top {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .reader-title {
            font-family: var(--font-heading);
            font-size: 2.5rem;
            font-weight: 800;
            line-height: 1.25;
            color: #ffffff;
            letter-spacing: -0.8px;
            margin-bottom: 25px;
            background: linear-gradient(135deg, #ffffff 60%, #cbd5e1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .author-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .reader-content {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #cbd5e1;
        }
        
        .reader-content p {
            margin-bottom: 24px;
        }
        
        .reader-content h3 {
            font-family: var(--font-heading);
            font-size: 1.6rem;
            font-weight: 700;
            color: #ffffff;
            margin-top: 40px;
            margin-bottom: 18px;
        }
        
        .reader-footer-actions {
            display: flex;
            justify-content: center;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            padding-top: 40px;
            margin-top: 50px;
        }
        
        .like-bar-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 30px;
            border-radius: 30px;
            background: rgba(0, 255, 135, 0.05);
            border: 1px solid rgba(0, 255, 135, 0.25);
            color: var(--neon-emerald);
            font-family: var(--font-heading);
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 255, 135, 0.1);
        }
        
        .like-bar-btn:hover {
            transform: translateY(-2px);
            background: rgba(0, 255, 135, 0.15);
            box-shadow: 0 8px 25px rgba(0, 255, 135, 0.2);
        }
        
        .like-bar-btn.liked svg {
            fill: var(--neon-emerald);
        }
        
        @media (max-width: 768px) {
            .reader-wrapper {
                margin-top: 100px;
            }
            .reader-card {
                padding: 30px 25px;
            }
            .reader-title {
                font-size: 1.8rem;
            }
            .author-card {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
            }
        }
    </style>
</head>
<body>

    <!-- Aravel Animated Background Blobs -->
    <div class="background-blobs">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>
    </div>

    <!-- MAIN READING CONTAINER -->
    <main class="reader-wrapper">
        
        <!-- Back Navigation Button -->
        <div class="back-btn-container">
            <a href="/" class="back-btn liquid-glass">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                <span>Kembali ke Beranda</span>
            </a>
        </div>

        <!-- Read Content Card -->
        <article class="reader-card liquid-glass aravel-curve-large">
            
            <header class="reader-header">
                <div class="reader-meta-top">
                    <span class="work-badge {{ $work['category'] }}">{{ $work['category_label'] }}</span>
                    <span class="work-date">{{ $work['date'] }}</span>
                </div>
                
                <h2 class="reader-title">{{ $work['title'] }}</h2>
                
                <div class="author-card">
                    <div class="student-info">
                        <div class="student-avatar">{{ $work['avatar'] }}</div>
                        <div class="student-name">
                            <span class="name" style="font-size: 1.05rem;">{{ $work['author'] }}</span>
                            <span class="class" style="font-size: 0.85rem;">{{ $work['class'] }}</span>
                        </div>
                    </div>
                    
                    <div class="work-metrics" style="font-size: 0.9rem;">
                        <span class="metric-item liked" style="cursor: default; color: var(--neon-emerald);">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="var(--neon-emerald)" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                            <span><span id="headerLikeCount">{{ $work['likes'] }}</span> Menyukai</span>
                        </span>
                    </div>
                </div>
            </header>

            <section class="reader-content">
                @if($work['pdf_path'])
                    <!-- PDF vs Web Text switcher tabs -->
                    <div class="modal-mode-switch" style="max-width: 350px; margin: 0 auto 30px;">
                        <button type="button" class="modal-mode-btn active" id="btnViewPdf">Dokumen Asli (PDF)</button>
                        <button type="button" class="modal-mode-btn" id="btnViewText">Hasil Ekstraksi Teks</button>
                    </div>

                    <!-- PDF Reader Panel -->
                    <div id="pdfViewerPanel" class="view-panel" style="margin-bottom: 30px;">
                        <iframe src="{{ asset($work['pdf_path']) }}" width="100%" height="750px" style="border: 1px solid rgba(5, 150, 105, 0.15); border-radius: 20px; box-shadow: 0 10px 30px rgba(5, 50, 30, 0.05);"></iframe>
                    </div>

                    <!-- Web Text Panel -->
                    <div id="webTextPanel" class="view-panel" style="display: none;">
                        {!! $work['content'] !!}
                    </div>
                @else
                    {!! $work['content'] !!}
                @endif
            </section>

            <footer class="reader-footer-actions">
                <button class="like-bar-btn" onclick="toggleReadPageLike(this)">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                    <span>Sukai Karya Ini</span>
                </button>
            </footer>

        </article>

    </main>

    <!-- Footer Space -->
    <footer style="margin-top: 40px;">
        <div class="footer-content">
            <div class="footer-logo">
                Ruang<span>Cipta</span> © 2026
            </div>
            <div class="footer-copyright">
                SMP Digital Journal Platform • Menginspirasi Melalui Tulisan
            </div>
        </div>
    </footer>

    <script>
        function toggleReadPageLike(btn) {
            btn.classList.toggle('liked');
            const countText = document.getElementById('headerLikeCount');
            
            fetch('/karya/{{ $id }}/like', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    countText.textContent = data.likes;
                    if (btn.classList.contains('liked')) {
                        btn.style.background = 'var(--neon-emerald)';
                        btn.style.color = '#000000';
                        btn.querySelector('svg').setAttribute('fill', '#000000');
                    } else {
                        btn.style.background = '';
                        btn.style.color = '';
                        btn.querySelector('svg').setAttribute('fill', 'none');
                    }
                }
            })
            .catch(err => console.error(err));
        }

        @if($work['pdf_path'])
        const btnViewPdf = document.getElementById('btnViewPdf');
        const btnViewText = document.getElementById('btnViewText');
        const pdfViewerPanel = document.getElementById('pdfViewerPanel');
        const webTextPanel = document.getElementById('webTextPanel');

        if (btnViewPdf && btnViewText) {
            btnViewPdf.addEventListener('click', () => {
                btnViewPdf.classList.add('active');
                btnViewText.classList.remove('active');
                pdfViewerPanel.style.display = 'block';
                webTextPanel.style.display = 'none';
            });

            btnViewText.addEventListener('click', () => {
                btnViewText.classList.add('active');
                btnViewPdf.classList.remove('active');
                pdfViewerPanel.style.display = 'none';
                webTextPanel.style.display = 'block';
            });
        }
        @endif
    </script>
</body>
</html>
