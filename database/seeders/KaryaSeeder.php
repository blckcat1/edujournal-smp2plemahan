<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Karya;

class KaryaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Karya::create([
            'title' => 'Analisis Dampak Sampah Plastik di Lingkungan Sekolah',
            'category' => 'akademik',
            'author' => 'Rian Hidayat',
            'class' => 'Kelas 8A',
            'likes' => 18,
            'excerpt' => 'Penelitian sederhana ini mengamati jumlah penggunaan botol plastik harian di kantin dan mengajukan solusi program isi ulang air minum berkelanjutan.',
            'content' => '
                <h3>Pendahuluan</h3>
                <p>Sampah plastik menjadi masalah global yang juga dirasakan di lingkungan sekolah kami. Kantin sekolah menghasilkan puluhan botol plastik sekali pakai setiap hari dari penjualan minuman kemasan. Penelitian ini bertujuan mengukur volume rata-rata sampah plastik harian dan merumuskan solusi alternatif yang ramah lingkungan.</p>
                
                <h3>Metode Penelitian</h3>
                <p>Kami melakukan observasi langsung di area pembuangan sampah kantin selama 5 hari berturut-turut pada jam istirahat pertama dan kedua. Kami juga menyebarkan kuesioner singkat kepada 50 siswa mengenai kebiasaan membawa botol minum (tumblr) sendiri dari rumah.</p>
                
                <h3>Hasil dan Pembahasan</h3>
                <p>Dari hasil observasi, rata-rata volume sampah botol plastik mencapai 120 botol per hari. Sebagian besar siswa (65%) menyatakan jarang membawa tumblr sendiri dengan alasan berat atau lupa. Namun, 80% dari mereka bersedia membawa tumblr jika sekolah menyediakan stasiun isi ulang air minum (water refill station) gratis yang higienis.</p>
                
                <h3>Kesimpulan dan Rekomendasi</h3>
                <p>Pengurangan sampah plastik di sekolah sangat bergantung pada ketersediaan fasilitas penunjang. Kami menyarankan sekolah untuk memasang water refill station berbasis filtrasi air bersih di area kantin dan selasar kelas untuk mendorong pengurangan kemasan sekali pakai.</p>
            '
        ]);

        Karya::create([
            'title' => 'Melodi di Balik Hujan Gerimis',
            'category' => 'kreatif',
            'author' => 'Keysha Putri',
            'class' => 'Kelas 9C',
            'likes' => 34,
            'excerpt' => 'Sebuah cerita pendek tentang perjuangan seorang anak kelas 9 meraih impian bermain biola di panggung festival seni sekolah meskipun terkendala alat musik tua.',
            'content' => '
                <p>Gerimis sore itu menyisakan aroma tanah yang basah di luar jendela kelas. Di tanganku, sebuah biola tua dengan kayu yang sudah memudar warnanya bersandar bisu. Gesekan busurnya masih terdengar merdu, meski terkadang terdengar sedikit berdecit di nada tinggi.</p>
                
                <p>"Kamu pasti bisa, Keysha. Biola ini saksi perjuangan ibumu dulu," bisik Bu Ratna, guru kesenian sekolah yang selalu sabar melatihku setelah jam pulang sekolah.</p>
                
                <p>Festival Seni Sekolah tinggal dua hari lagi. Aku terpilih mewakili kelasku untuk tampil solo. Rasa cemas menyelimuti benakku. Bagaimana jika biola tua ini tiba-tiba sumbang di tengah pertunjukan? Bagaimana jika senarnya putus seperti latihan minggu lalu?</p>
                
                <p>Hari yang dinanti tiba. Aula sekolah dipenuhi ratusan pasang mata. Ketika namaku dipanggil, lampu panggung terasa begitu menyilaukan. Aku memejamkan mata sejenak, menarik napas dalam-dalam, dan mulai menggesek senar pertama. Melodi lagu "Simfoni Gerimis" mengalir lambat, mengisi sudut-sudut aula dengan kehangatan. Semua kekhawatiranku lenyap, melebur ke dalam nada-nada yang meliuk indah dari biola kesayanganku.</p>
            '
        ]);

        Karya::create([
            'title' => 'Efektivitas Belajar Mandiri Menggunakan Mind Mapping',
            'category' => 'akademik',
            'author' => 'Farras Fathoni',
            'class' => 'Kelas 7B',
            'likes' => 12,
            'excerpt' => 'Mengulas bagaimana metode peta pikiran membantu siswa memahami konsep rumit di pelajaran IPA Biologi dengan visualisasi gambar dan relasi kata kunci.',
            'content' => '
                <h3>Latar Belakang</h3>
                <p>Transisi dari Sekolah Dasar ke Sekolah Menengah Pertama membawa materi pelajaran yang jauh lebih padat, salah satunya IPA Biologi. Banyak siswa kesulitan menghafal istilah-istilah ilmiah. Artikel ini mengulas implementasi metode peta pikiran (mind mapping) sebagai alternatif belajar mandiri yang efektif.</p>
                
                <h3>Apa itu Mind Mapping?</h3>
                <p>Mind mapping adalah teknik visual yang menyusun informasi dari satu gagasan pusat menyebar ke cabang-cabang sub-topik menggunakan gambar, warna, dan kata kunci. Ini menyelaraskan cara berpikir alami otak kita.</p>
                
                <h3>Studi Kasus Pembelajaran IPA</h3>
                <p>Kami membandingkan hasil ulangan harian bab "Sistem Organisasi Kehidupan" antara sebelum dan setelah menerapkan mind mapping. Peta pikiran dibuat secara kreatif dengan warna berbeda untuk setiap sistem organ (pencernaan, pernapasan, peredaran darah).</p>
                
                <h3>Kesimpulan</h3>
                <p>Metode ini terbukti meningkatkan daya ingat jangka panjang dan mempermudah peninjauan ulang materi sebelum ujian. Siswa menjadi lebih aktif menggambar alur konsep daripada sekadar membaca paragraf teks panjang.</p>
            '
        ]);

        Karya::create([
            'title' => 'Pencuri Bintang dari Utara',
            'category' => 'kreatif',
            'author' => 'Amanda Callista',
            'class' => 'Kelas 8D',
            'likes' => 48,
            'excerpt' => 'Penggalan novel fantasi bertema petualangan remaja yang menemukan gerbang kosmik rahasia di halaman belakang perpustakaan tua kota mereka.',
            'content' => '
                <p>Malam itu langit utara tampak janggal. Bintang-bintang paling terang perlahan meredup lalu menghilang satu demi satu, seolah-olah ada tangan raksasa tak terlihat yang memetiknya dari kanvas langit hitam.</p>
                
                <p>Luka, seorang remaja penggila astronomi, berdiri di balkon kamarnya dengan teropong bintang sederhana. Jantungnya berdegup kencang ketika ia melihat siluet sesosok makhluk kecil bersayap perak melintas cepat membawa wadah kaca yang bersinar sangat terang.</p>
                
                <p>"Mereka mencurinya lagi," bisik Luka pada dirinya sendiri. Berbekal peta bintang kuno milik mendiang kakeknya dan sebuah kompas magnetik yang jarumnya selalu berputar acak, Luka bertekad menyelidiki fenomena ini hingga ke hutan perbatasan utara kota.</p>
            '
        ]);
    }
}
