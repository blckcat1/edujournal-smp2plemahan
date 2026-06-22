<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat Publikasi - {{ $certificate->manuscript->title }}</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800&family=Montserrat:wght@400;500;600;700;800&family=Great+Vibes&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f1f5f9;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .cert-container {
            font-family: 'Montserrat', sans-serif;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
            border: 24px solid #1e3a8a;
            position: relative;
        }
        .cert-inner {
            border: 4px solid #d97706;
            height: 100%;
            padding: 50px 80px;
            box-sizing: border-box;
            background-image: radial-gradient(rgba(244, 245, 247, 0.4) 2px, transparent 2px);
            background-size: 30px 30px;
        }
        .cert-title {
            font-family: 'Cinzel', serif;
            letter-spacing: 2px;
        }
        .signature-font {
            font-family: 'Great Vibes', cursive;
        }
        @media print {
            body {
                background-color: #ffffff;
            }
            .cert-container {
                box-shadow: none;
                margin: 0;
                border: 20px solid #1e3a8a;
            }
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body class="flex flex-col items-center justify-center min-h-screen py-10 px-4">

    <!-- Print control bar -->
    <div class="max-w-5xl w-full mb-6 flex justify-between items-center no-print">
        <a href="/author" class="inline-flex items-center space-x-2 text-sm font-semibold text-slate-600 hover:text-slate-900">
            <span>&larr; Kembali ke Dashboard</span>
        </a>
        <button onclick="window.print()" class="px-5 py-2.5 rounded-xl bg-blue-950 text-white hover:bg-blue-900 font-bold text-sm shadow-md transition flex items-center space-x-2">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-5a2 2 0 00-2-2H5a2 2 0 00-2 2v5a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
            <span>Cetak / Simpan PDF</span>
        </button>
    </div>

    <!-- Certificate Frame -->
    <div class="max-w-5xl w-full aspect-[1.414/1] cert-container rounded-sm overflow-hidden">
        <div class="cert-inner flex flex-col justify-between text-center relative">
            
            <!-- Corner Decorative Badges -->
            <div class="absolute top-2 left-2 w-10 h-10 border-t-2 border-l-2 border-amber-600"></div>
            <div class="absolute top-2 right-2 w-10 h-10 border-t-2 border-r-2 border-amber-600"></div>
            <div class="absolute bottom-2 left-2 w-10 h-10 border-b-2 border-l-2 border-amber-600"></div>
            <div class="absolute bottom-2 right-2 w-10 h-10 border-b-2 border-r-2 border-amber-600"></div>

            <!-- Header -->
            <div class="space-y-2">
                <span class="text-xs font-bold text-amber-600 uppercase tracking-widest">EduJournal Jurnal Ilmiah Sekolah</span>
                <h1 class="text-4xl font-extrabold text-blue-950 cert-title">SERTIFIKAT PUBLIKASI</h1>
                <div class="w-40 h-1 bg-amber-600 mx-auto mt-2"></div>
            </div>

            <!-- Recipient & Body -->
            <div class="my-6 space-y-4">
                <p class="text-sm text-slate-500 font-medium italic">Sertifikat ini secara resmi diberikan kepada:</p>
                <h2 class="text-3xl font-extrabold text-slate-900 border-b border-slate-100 pb-2 inline-block tracking-wide">{{ $certificate->author->name }}</h2>
                <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">{{ $certificate->author->institution }}</p>
                
                <div class="max-w-2xl mx-auto pt-4">
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Atas keberhasilan mempublikasikan manuskrip karya tulis ilmiah orisinal siswa di platform jurnal sekolah berstandar peninjauan akademis (peer-reviewed) dengan judul:
                    </p>
                    <h3 class="text-lg font-bold text-blue-900 mt-3 italic leading-snug">"{{ $certificate->manuscript->title }}"</h3>
                </div>
            </div>

            <!-- Verification Metadata & Footer Signatures -->
            <div class="grid grid-cols-3 gap-6 items-end mt-4">
                <!-- Left: Verifikasi -->
                <div class="text-left text-[10px] text-slate-400 space-y-1">
                    <span class="block uppercase tracking-wider font-bold">Verifikasi Online</span>
                    <span class="block">DOI: <strong class="text-blue-950 font-bold">{{ $certificate->manuscript->doi }}</strong></span>
                    <span class="block font-mono text-[9px]">ID Hash: {{ substr($certificate->hash, 0, 16) }}...</span>
                    <span class="block">Terbit Edisi: {{ $certificate->manuscript->issue ? $certificate->manuscript->issue->title : 'N/A' }}</span>
                </div>

                <!-- Center: Seal -->
                <div class="flex justify-center">
                    <div class="w-20 h-20 rounded-full border-4 border-amber-600/80 bg-amber-50 flex items-center justify-center flex-col relative shadow-inner rotate-12">
                        <span class="text-[7px] text-amber-700 font-extrabold uppercase tracking-widest">OFFICIAL SEAL</span>
                        <svg class="w-7 h-7 text-amber-700 my-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        <span class="text-[7px] text-amber-700 font-bold">EDUJOURNAL</span>
                    </div>
                </div>

                <!-- Right: Signature -->
                <div class="text-right space-y-1 text-slate-500">
                    <span class="block text-xs font-semibold">Dewan Redaksi Jurnal,</span>
                    <span class="block signature-font text-3xl text-blue-900 h-10 py-1 select-none">H. Supriadi, M.Pd.</span>
                    <span class="block text-[10px] font-bold text-slate-800 uppercase tracking-wider border-t border-slate-200 pt-1">Kepala Komite Literasi</span>
                </div>
            </div>

        </div>
    </div>

</body>
</html>
