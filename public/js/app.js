document.addEventListener('DOMContentLoaded', () => {
    // 1. Mobile Menu Toggle
    const menuToggle = document.getElementById('menuToggle');
    const navLinks = document.getElementById('navLinks');

    if (menuToggle && navLinks) {
        menuToggle.addEventListener('click', () => {
            menuToggle.classList.toggle('active');
            navLinks.classList.toggle('active');
        });
    }

    // Close menu when link is clicked
    document.querySelectorAll('.nav-links a').forEach(link => {
        link.addEventListener('click', () => {
            if (menuToggle && navLinks) {
                menuToggle.classList.remove('active');
                navLinks.classList.remove('active');
            }
        });
    });

    // 2. Liquid Glass Parallax Tilt Effect
    const glassCards = document.querySelectorAll('.liquid-glass.interactive-tilt');
    
    glassCards.forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left; // x position inside card
            const y = e.clientY - rect.top;  // y position inside card
            
            // Calculate rotation angles
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            const rotateX = ((centerY - y) / centerY) * 8; // max 8 degrees
            const rotateY = ((x - centerX) / centerX) * 8; // max 8 degrees
            
            // Apply transformations
            card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-8px)`;
            
            // Dynamic glowing border position (simulate light reflection)
            const angle = Math.atan2(y - centerY, x - centerX) * 180 / Math.PI;
            card.style.setProperty('--reflection-angle', `${angle}deg`);
        });
        
        card.addEventListener('mouseleave', () => {
            // Smoothly reset
            card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) translateY(0)';
        });
    });

    // 3. Modal Popup Logic
    const submissionModal = document.getElementById('submissionModal');
    const openModalBtns = document.querySelectorAll('.trigger-modal');
    const closeModalBtn = document.getElementById('closeModal');
    const submissionForm = document.getElementById('submissionForm');

    // PDF Mode Selectors
    const modeWrite = document.getElementById('modeWrite');
    const modeUpload = document.getElementById('modeUpload');
    const pdfUploadContainer = document.getElementById('pdfUploadContainer');
    const pdfDropzone = document.getElementById('pdfDropzone');
    const pdfFileInput = document.getElementById('pdfFileInput');
    const pdfFileInfo = document.getElementById('pdfFileInfo');
    const pdfFileName = document.getElementById('pdfFileName');
    const pdfFileRemove = document.getElementById('pdfFileRemove');
    const pdfExtractLoader = document.getElementById('pdfExtractLoader');

    let currentMode = 'write';

    if (submissionModal && closeModalBtn) {
        // Open Modal
        openModalBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                submissionModal.classList.add('active');
                document.body.style.overflow = 'hidden'; // Disable scroll behind
            });
        });

        // Close Modal
        closeModalBtn.addEventListener('click', () => {
            resetModalState();
        });

        // Close on outside click
        submissionModal.addEventListener('click', (e) => {
            if (e.target === submissionModal) {
                resetModalState();
            }
        });
    }

    function resetModalState() {
        if (submissionModal) {
            submissionModal.classList.remove('active');
            document.body.style.overflow = '';
            if (submissionForm) submissionForm.reset();
            // Reset PDF Upload Fields
            if (pdfUploadContainer) pdfUploadContainer.classList.remove('active');
            if (pdfFileInfo) pdfFileInfo.classList.remove('active');
            if (pdfExtractLoader) pdfExtractLoader.style.display = 'none';
            if (modeWrite) modeWrite.classList.add('active');
            if (modeUpload) modeUpload.classList.remove('active');
            currentMode = 'write';
        }
    }

    // Modal Mode Switch (Write vs PDF Upload)
    if (modeWrite && modeUpload) {
        modeWrite.addEventListener('click', () => {
            modeWrite.classList.add('active');
            modeUpload.classList.remove('active');
            pdfUploadContainer.classList.remove('active');
            currentMode = 'write';
        });

        modeUpload.addEventListener('click', () => {
            modeUpload.classList.add('active');
            modeWrite.classList.remove('active');
            pdfUploadContainer.classList.add('active');
            currentMode = 'upload';
        });
    }

    // Trigger File Input Click on Dropzone Click
    if (pdfDropzone && pdfFileInput) {
        pdfDropzone.addEventListener('click', () => {
            pdfFileInput.click();
        });

        pdfFileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                handleUploadedPDF(e.target.files[0]);
            }
        });

        // Drag & Drop events
        ['dragenter', 'dragover'].forEach(eventName => {
            pdfDropzone.addEventListener(eventName, (e) => {
                e.preventDefault();
                e.stopPropagation();
                pdfDropzone.classList.add('dragover');
            }, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            pdfDropzone.addEventListener(eventName, (e) => {
                e.preventDefault();
                e.stopPropagation();
                pdfDropzone.classList.remove('dragover');
            }, false);
        });

        pdfDropzone.addEventListener('drop', (e) => {
            const dt = e.dataTransfer;
            const files = dt.files;
            if (files.length > 0 && files[0].type === 'application/pdf') {
                handleUploadedPDF(files[0]);
            } else if (files.length > 0) {
                alert('Silakan unggah file berkas dengan format PDF saja!');
            }
        });
    }

    // Handle File Removal
    if (pdfFileRemove) {
        pdfFileRemove.addEventListener('click', (e) => {
            e.stopPropagation();
            pdfFileInput.value = '';
            pdfFileInfo.classList.remove('active');
            pdfExtractLoader.style.display = 'none';
            // Clear auto-filled form values
            document.getElementById('karyaTitle').value = '';
            document.getElementById('karyaExcerpt').value = '';
        });
    }

    // Simulate PDF Text Extraction
    function handleUploadedPDF(file) {
        pdfFileName.textContent = file.name;
        pdfFileInfo.classList.add('active');
        pdfExtractLoader.style.display = 'flex';

        // Auto Populate Form after 1.5s delay (Simulated PDF parsing)
        setTimeout(() => {
            pdfExtractLoader.style.display = 'none';
            
            // Clean file name for Title
            const rawName = file.name.replace(/\.[^/.]+$/, "");
            const formattedTitle = rawName.split(/[-_]+/).map(word => {
                return word.charAt(0).toUpperCase() + word.slice(1);
            }).join(' ');

            document.getElementById('karyaTitle').value = formattedTitle;
            
            // Auto Populate Excerpt text
            const author = document.getElementById('studentName').value || 'Penulis';
            document.getElementById('karyaExcerpt').value = `Karya ilmiah/kreatif ini berhasil diekstraksi dari dokumen PDF: "${file.name}". Tulisan ini membahas hasil studi lapangan secara menyeluruh dengan struktur penulisan akademis yang baik.`;
            
            // Auto Select category based on title keyword
            const karyaType = document.getElementById('karyaType');
            if (formattedTitle.toLowerCase().includes('cerpen') || formattedTitle.toLowerCase().includes('novel') || formattedTitle.toLowerCase().includes('puisi')) {
                karyaType.value = 'kreatif';
            } else {
                karyaType.value = 'akademik';
            }
        }, 1500);
    }


    // Handle Persistent Form Submission (AJAX to SQLite)
    if (submissionForm) {
        submissionForm.addEventListener('submit', (e) => {
            e.preventDefault();
            
            // Show loading submit feedback if uploading file
            const submitBtn = submissionForm.querySelector('.form-submit-btn');
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'Mengirim Karya...';
            submitBtn.disabled = true;

            const formData = new FormData(submissionForm);

            fetch('/karya', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.json())
            .then(data => {
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;

                if (data.success) {
                    // Generate a mockup tile linked to database ID
                    const grid = document.querySelector('.works-grid');
                    if (grid) {
                        const newCardHTML = `
                            <div class="work-card liquid-glass aravel-curve-medium interactive-tilt" data-category="${data.category}" id="workCard${data.id}">
                                <div class="work-header">
                                    <span class="work-badge ${data.category}">${data.category_label}</span>
                                    <span class="work-date">${data.date}</span>
                                </div>
                                <div class="work-body">
                                    <h4 class="work-title" onclick="window.location.href='/karya/${data.id}'">${data.title}</h4>
                                    <p class="work-excerpt">${data.excerpt}</p>
                                </div>
                                <div class="work-footer">
                                    <div class="student-info">
                                        <div class="student-avatar">${data.avatar}</div>
                                        <div class="student-name">
                                            <span class="name">${data.author}</span>
                                            <span class="class">Kelas ${data.class}</span>
                                        </div>
                                    </div>
                                    <div class="work-metrics">
                                        <span class="metric-item like-btn" onclick="toggleLike(this, ${data.id})" id="likeBtn${data.id}">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                                            <span class="like-count">0</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        `;

                        // Insert into grid
                        grid.insertAdjacentHTML('afterbegin', newCardHTML);
                        
                        // Setup dynamic tilt
                        setupCardTilt(grid.firstElementChild);
                    }

                    // Reset form and file inputs
                    resetModalState();
                    
                    alert('Selamat! Karyamu berhasil diunggah dan disimpan secara permanen di database!');
                } else {
                    alert('Gagal mengirim karya: Terjadi kesalahan di server.');
                }
            })
            .catch(err => {
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
                console.error(err);
                alert('Gagal mengirim karya: Periksa koneksi jaringan.');
            });
        });
    }

    // Setup function for single card tilt
    function setupCardTilt(card) {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            const rotateX = ((centerY - y) / centerY) * 8;
            const rotateY = ((x - centerX) / centerX) * 8;
            card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-8px)`;
        });
        
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) translateY(0)';
        });
    }

    // 4. Grid Tabs Filtering
    const tabs = document.querySelectorAll('.filter-tab');
    const works = document.querySelectorAll('.work-card');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');

            const category = tab.getAttribute('data-filter');

            document.querySelectorAll('.work-card').forEach(work => {
                const workCategory = work.getAttribute('data-category');
                if (category === 'all' || workCategory === category) {
                    work.style.display = 'flex';
                    work.style.opacity = '0';
                    setTimeout(() => {
                        work.style.opacity = '1';
                        work.style.transition = 'opacity 0.4s ease';
                    }, 50);
                } else {
                    work.style.display = 'none';
                }
            });
        });
    });
});

// 5. Interactive Persistent Metric Action (Likes DB Update)
function toggleLike(element, id) {
    element.classList.toggle('liked');
    const countSpan = element.querySelector('.like-count');
    
    const csrfToken = document.querySelector('input[name="_token"]').value;

    fetch(`/karya/${id}/like`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            countSpan.textContent = data.likes;
            if (element.classList.contains('liked')) {
                element.style.color = 'var(--neon-emerald)';
                element.querySelector('svg').setAttribute('fill', 'var(--neon-emerald)');
            } else {
                element.style.color = '';
                element.querySelector('svg').setAttribute('fill', 'none');
            }
        }
    })
    .catch(err => console.error(err));
}

