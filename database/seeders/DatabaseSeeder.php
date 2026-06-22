<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use App\Models\Issue;
use App\Models\Manuscript;
use App\Models\Rubric;
use App\Models\Review;
use App\Models\RubricScore;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Certificate;
use App\Models\Notification;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Copy dummy PDF files to public uploads
        $destPath = public_path('uploads/manuscripts');
        File::ensureDirectoryExists($destPath);
        $sourcePdf = base_path('analisis_keseimbangan_ekosistem.pdf');
        if (File::exists($sourcePdf)) {
            File::copy($sourcePdf, $destPath . '/dummy_manuscript_1.pdf');
            File::copy($sourcePdf, $destPath . '/dummy_manuscript_2.pdf');
            File::copy($sourcePdf, $destPath . '/dummy_manuscript_3.pdf');
            File::copy($sourcePdf, $destPath . '/dummy_manuscript_4.pdf');
        }

        // 2. Create Users
        $admin = User::create([
            'name' => 'Dr. Budi Santoso, M.Pd.',
            'email' => 'admin@edujournal.org',
            'username' => 'admin',
            'country' => 'Indonesia',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'institution' => 'SMP Negeri 2 Plemahan',
        ]);

        $reviewer = User::create([
            'name' => 'Dewi Lestari, S.Pd.',
            'email' => 'reviewer@edujournal.org',
            'username' => 'reviewer',
            'country' => 'Indonesia',
            'password' => Hash::make('password'),
            'role' => 'reviewer',
            'institution' => 'SMP Negeri 2 Plemahan',
        ]);

        $partner = User::create([
            'name' => 'Prof. Dr. Ir. Ahmad Fauzi',
            'email' => 'partner@edujournal.org',
            'username' => 'partner',
            'country' => 'Indonesia',
            'password' => Hash::make('password'),
            'role' => 'partner',
            'institution' => 'Universitas Brawijaya',
        ]);

        $author1 = User::create([
            'name' => 'Rian Hidayat',
            'email' => 'author1@edujournal.org',
            'username' => 'rianh',
            'country' => 'Indonesia',
            'password' => Hash::make('password'),
            'role' => 'author',
            'institution' => 'SMP Negeri 2 Plemahan (Kelas 7A)',
        ]);

        $author2 = User::create([
            'name' => 'Siti Aminah',
            'email' => 'author2@edujournal.org',
            'username' => 'sitia',
            'country' => 'Indonesia',
            'password' => Hash::make('password'),
            'role' => 'author',
            'institution' => 'SMP Negeri 2 Plemahan (Kelas 8B)',
        ]);

        $reader = User::create([
            'name' => 'Andi Wijaya',
            'email' => 'reader@edujournal.org',
            'username' => 'andiw',
            'country' => 'Indonesia',
            'password' => Hash::make('password'),
            'role' => 'reader',
            'institution' => 'Masyarakat Umum',
        ]);

        // Profiles
        foreach ([$admin, $reviewer, $partner, $author1, $author2, $reader] as $usr) {
            Profile::create([
                'user_id' => $usr->id,
                'bio' => 'Profil resmi dari ' . $usr->name . ' di EduJournal.',
                'specialization' => $usr->role === 'reviewer' ? 'Sains & Teknologi' : ($usr->role === 'partner' ? 'Biologi Ekosistem' : null),
            ]);
        }

        // 3. Create Rubrics Criteria
        $rubric1 = Rubric::create([
            'criteria_name' => 'Orisinalitas Ide & Plagiarisme',
            'weight' => 25,
            'max_score' => 100,
        ]);
        $rubric2 = Rubric::create([
            'criteria_name' => 'Kesesuaian Metodologi Penelitian',
            'weight' => 25,
            'max_score' => 100,
        ]);
        $rubric3 = Rubric::create([
            'criteria_name' => 'Kedalaman Analisis Data & Pembahasan',
            'weight' => 30,
            'max_score' => 100,
        ]);
        $rubric4 = Rubric::create([
            'criteria_name' => 'Kualitas Referensi & Sitasi',
            'weight' => 20,
            'max_score' => 100,
        ]);

        // 4. Create Issues
        $issue1 = Issue::create([
            'volume' => 1,
            'issue_number' => 1,
            'year' => 2026,
            'title' => 'Volume 1 Nomor 1 (2026)',
            'status' => 'published',
        ]);

        $issue2 = Issue::create([
            'volume' => 1,
            'issue_number' => 2,
            'year' => 2026,
            'title' => 'Volume 1 Nomor 2 (2026) - Antrean',
            'status' => 'draft',
        ]);

        // 5. Create Manuscripts
        // Manuscript 1 (Published)
        $m1 = Manuscript::create([
            'author_id' => $author1->id,
            'issue_id' => $issue1->id,
            'title' => 'Analisis Kandungan Klorofil Daun Mangga Berdasarkan Tingkat Paparan Polusi Kendaraan Bermotor',
            'abstract' => 'Penelitian ini bertujuan untuk menganalisis kandungan klorofil pada daun mangga (Mangifera indica) yang tumbuh di lingkungan padat lalu lintas dibandingkan dengan daun mangga di area sekolah yang minim polusi. Metode penelitian dilakukan secara eksperimen sederhana di laboratorium biologi sekolah menggunakan metode spektrofotometri kertas kromatografi. Hasil menunjukkan terdapat penurunan kadar klorofil total hingga 34% pada tanaman yang terpapar asap knalpot kendaraan secara terus-menerus. Kesimpulan dari riset ini adalah polusi udara berdampak buruk terhadap kesehatan kloroplas tanaman perkotaan.',
            'keywords' => 'klorofil, polusi udara, Mangifera indica, kromatografi',
            'subject' => 'IPA',
            'pdf_path' => 'uploads/manuscripts/dummy_manuscript_1.pdf',
            'status' => 'published',
            'doi' => 'EDU-2026-V1-I1-0001',
            'likes' => 8,
            'published_at' => now()->subDays(5),
        ]);

        // Manuscript 2 (Published)
        $m2 = Manuscript::create([
            'author_id' => $author2->id,
            'issue_id' => $issue1->id,
            'title' => 'Hubungan Penggunaan Media Sosial Terhadap Minat Baca Buku Non-Fiksi Siswa Kelas 7',
            'abstract' => 'Penelitian sosial sederhana ini meneliti tentang durasi waktu yang dihabiskan siswa kelas 7 SMP dalam mengakses media sosial (seperti TikTok dan Instagram) dan hubungannya terhadap ketertarikan membaca buku bacaan ilmiah populer/non-fiksi. Pengumpulan data dilakukan dengan menyebarkan kuesioner kepada 60 responden siswa. Analisis korelasi menunjukkan terdapat hubungan negatif yang signifikan (r = -0.62) antara durasi screen time media sosial dan intensitas membaca buku cetak non-fiksi.',
            'keywords' => 'media sosial, minat baca, non-fiksi, korelasi sosial',
            'subject' => 'IPS',
            'pdf_path' => 'uploads/manuscripts/dummy_manuscript_2.pdf',
            'status' => 'published',
            'doi' => 'EDU-2026-V1-I1-0002',
            'likes' => 5,
            'published_at' => now()->subDays(2),
        ]);

        // Manuscript 3 (Under Review)
        $m3 = Manuscript::create([
            'author_id' => $author1->id,
            'title' => 'Rancang Bangun Sistem Pendeteksi Kelembapan Tanah Berbasis IoT untuk Taman Sekolah',
            'abstract' => 'Proyek rekayasa teknologi ini bertujuan merakit sensor kelembapan tanah sederhana berbasis mikrokontroler Arduino Uno untuk membantu penyiraman otomatis taman sekolah secara presisi. Alat diuji selama 2 minggu dengan hasil penyiraman air hemat hingga 40%.',
            'keywords' => 'Arduino, IoT, kelembapan tanah, taman sekolah',
            'subject' => 'IPA',
            'pdf_path' => 'uploads/manuscripts/dummy_manuscript_3.pdf',
            'status' => 'under_review',
        ]);

        // Manuscript 4 (Revision Required)
        $m4 = Manuscript::create([
            'author_id' => $author2->id,
            'title' => 'Dampak Sampah Plastik terhadap Ekosistem Sungai di Sekitar Lingkungan Sekolah',
            'abstract' => 'Penelitian ekologi ini mengamati akumulasi sampah makroplastik di bantaran sungai sekolah dan dampaknya terhadap keanekaragaman organisme air. Data diambil dengan metode kuadrat plot sampling.',
            'keywords' => 'makroplastik, ekosistem sungai, sampling biota',
            'subject' => 'IPA',
            'pdf_path' => 'uploads/manuscripts/dummy_manuscript_4.pdf',
            'status' => 'revision_required',
        ]);

        // Manuscript 5 (Submitted)
        $m5 = Manuscript::create([
            'author_id' => $author1->id,
            'title' => 'Kajian Etika Penggunaan Kecerdasan Buatan dalam Mengerjakan Tugas Pelajaran Sekolah',
            'abstract' => 'Esai kritis ini mengevaluasi tren penggunaan model kecerdasan buatan AI di kalangan siswa SMP dalam menulis laporan tugas pelajaran dan dampaknya terhadap kemandirian berpikir kritis.',
            'keywords' => 'etika AI, kemandirian berpikir, tugas sekolah',
            'subject' => 'Bahasa',
            'status' => 'submitted',
        ]);

        // 6. Create Reviews
        $r1 = Review::create([
            'manuscript_id' => $m1->id,
            'reviewer_id' => $reviewer->id,
            'comments' => 'Metode riset yang sangat baik untuk siswa SMP. Penjelasan spektrofotometri sederhana sangat detail. Diperlukan penambahan sitasi buku pelajaran biologi dasar.',
            'recommendation' => 'approve',
            'status' => 'completed',
        ]);

        $r2 = Review::create([
            'manuscript_id' => $m2->id,
            'reviewer_id' => $reviewer->id,
            'comments' => 'Analisis korelasi telah dilakukan dengan benar. Harap diperjelas batasan sampel agar lebih objektif.',
            'recommendation' => 'approve',
            'status' => 'completed',
        ]);

        Review::create([
            'manuscript_id' => $m3->id,
            'reviewer_id' => $reviewer->id,
            'status' => 'assigned',
        ]);

        Review::create([
            'manuscript_id' => $m4->id,
            'reviewer_id' => $reviewer->id,
            'comments' => 'Analisis data plot kurang lengkap. Tambahkan diagram keanekaragaman makroinvertebrata sungai.',
            'recommendation' => 'revision',
            'status' => 'completed',
        ]);

        // Rubric Scores
        foreach ([$rubric1, $rubric2, $rubric3, $rubric4] as $rub) {
            // Manuscript 1 scores
            RubricScore::create([
                'review_id' => $r1->id,
                'rubric_id' => $rub->id,
                'score' => rand(85, 95),
                'comments' => 'Bagus sekali untuk kriteria ' . $rub->criteria_name,
            ]);
            // Manuscript 2 scores
            RubricScore::create([
                'review_id' => $r2->id,
                'rubric_id' => $rub->id,
                'score' => rand(80, 90),
                'comments' => 'Sesuai dengan ekspektasi ' . $rub->criteria_name,
            ]);
        }

        // 7. Comments
        Comment::create([
            'manuscript_id' => $m1->id,
            'user_id' => $reader->id,
            'author_name' => $reader->name,
            'content' => 'Riset yang sangat menginspirasi saya untuk melakukan hal serupa di pekarangan rumah!',
            'type' => 'public',
        ]);

        Comment::create([
            'manuscript_id' => $m1->id,
            'user_id' => $partner->id,
            'author_name' => $partner->name,
            'content' => 'Luar biasa untuk siswa tingkat SMP. Metodologi spektrofotometri kertas kromatografinya solid. Rekomendasi saya: perluas riset dengan membedakan posisi daun mangga (tinggi vs rendah).',
            'type' => 'academic',
        ]);

        Comment::create([
            'manuscript_id' => $m2->id,
            'user_id' => $partner->id,
            'author_name' => $partner->name,
            'content' => 'Riset sosial yang menarik. Ingatlah bahwa hubungan korelasi tidak langsung berarti hubungan sebab-akibat (causation). Tambahkan ulasan teori determinasi teknologi.',
            'type' => 'academic',
        ]);

        // 8. Likes
        Like::create(['manuscript_id' => $m1->id, 'user_id' => $reader->id]);
        Like::create(['manuscript_id' => $m1->id, 'user_id' => $partner->id]);
        Like::create(['manuscript_id' => $m2->id, 'user_id' => $admin->id]);

        // 9. Certificates
        Certificate::create([
            'manuscript_id' => $m1->id,
            'author_id' => $author1->id,
            'hash' => sha1('m1-' . $author1->id),
        ]);

        Certificate::create([
            'manuscript_id' => $m2->id,
            'author_id' => $author2->id,
            'hash' => sha1('m2-' . $author2->id),
        ]);

        // 10. Notifications
        Notification::create([
            'user_id' => $author1->id,
            'title' => 'Manuskrip Diterbitkan!',
            'message' => 'Manuskrip Anda "' . $m1->title . '" resmi terbit di Volume 1 Nomor 1 (2026). DOI: ' . $m1->doi,
        ]);

        Notification::create([
            'user_id' => $author2->id,
            'title' => 'Revisi Dibutuhkan',
            'message' => 'Reviewer meminta revisi untuk manuskrip Anda: "' . $m4->title . '". Silakan periksa detailnya.',
        ]);
    }
}
