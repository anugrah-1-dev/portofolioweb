<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Prestasi;
use App\Models\Projek;
use App\Models\Jurnal;
use App\Models\Profil;
use App\Models\Sosmed;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            ['name' => 'Admin', 'password' => Hash::make('admin123')]
        );

        // Profil
        Profil::firstOrCreate(['id' => 1], [
            'nama'     => 'Anugrah',
            'bio1'     => 'Saya adalah seorang Web Developer yang penuh semangat dalam menciptakan solusi digital yang inovatif dan berdampak. Dengan latar belakang kuat di pengembangan Full Stack, saya senang membangun aplikasi dari nol hingga siap produksi.',
            'bio2'     => 'Saya percaya bahwa kode yang baik bukan hanya yang bekerja, tapi juga yang mudah dibaca dan dipelihara. Setiap projek adalah kesempatan untuk belajar hal baru dan memberikan yang terbaik.',
            'status'   => 'Tersedia',
            'lokasi'   => 'Indonesia',
            'bahasa'   => 'ID / EN',
            'keahlian' => ['PHP', 'Laravel', 'Vue.js', 'MySQL', 'Tailwind CSS', 'JavaScript', 'Git', 'Docker'],
        ]);

        // Sosial Media
        $sosmed = [
            ['platform' => 'instagram', 'label' => 'Instagram', 'url' => 'https://instagram.com/',          'urutan' => 1],
            ['platform' => 'tiktok',    'label' => 'TikTok',    'url' => 'https://tiktok.com/',             'urutan' => 2],
            ['platform' => 'facebook',  'label' => 'Facebook',  'url' => 'https://facebook.com/',           'urutan' => 3],
            ['platform' => 'linkedin',  'label' => 'LinkedIn',  'url' => 'https://linkedin.com/in/anugrah', 'urutan' => 4],
        ];
        foreach ($sosmed as $s) {
            Sosmed::firstOrCreate(['platform' => $s['platform']], $s);
        }

        // Prestasi
        $prestasi = [
            ['icon' => '', 'year' => '2024', 'title' => 'Lulusan Terbaik Jurusan', 'description' => 'Meraih predikat lulusan terbaik jurusan dengan IPK tertinggi dan skripsi terbaik yang direkomendasikan untuk publikasi.', 'badge' => 'Akademik', 'kategori' => 'akademik', 'urutan' => 1],
            ['icon' => '', 'year' => '2024', 'title' => 'Laravel Certified Developer', 'description' => 'Mendapatkan sertifikasi resmi Laravel Certified Developer melalui ujian kompetensi framework Laravel tingkat lanjutan.', 'badge' => 'Sertifikasi', 'kategori' => 'akademik', 'urutan' => 2],
            ['icon' => '', 'year' => '2023', 'title' => 'Beasiswa Prestasi IT', 'description' => 'Meraih beasiswa penuh untuk program intensif pengembangan web dan mobile apps selama 6 bulan dari institusi terkemuka.', 'badge' => 'Beasiswa', 'kategori' => 'akademik', 'urutan' => 3],
            ['icon' => '', 'year' => '2024', 'title' => 'Juara 1 Web Development Competition', 'description' => 'Memenangkan kompetisi pembuatan website tingkat provinsi dengan kategori Best UI/UX Design dan Most Innovative Solution.', 'badge' => 'Kompetisi', 'kategori' => 'non_akademik', 'urutan' => 1],
            ['icon' => '', 'year' => '2023', 'title' => 'Top 5 Hackathon Nasional', 'description' => 'Masuk 5 besar hackathon nasional dengan solusi aplikasi berbasis AI untuk meningkatkan aksesibilitas pendidikan digital.', 'badge' => 'Hackathon', 'kategori' => 'non_akademik', 'urutan' => 2],
            ['icon' => '', 'year' => '2023', 'title' => 'Open Source Contributor', 'description' => 'Aktif berkontribusi pada proyek open source populer dengan lebih dari 50 pull request yang berhasil diterima dan di-merge.', 'badge' => 'Open Source', 'kategori' => 'non_akademik', 'urutan' => 3],
        ];
        foreach ($prestasi as $p) {
            Prestasi::firstOrCreate(['title' => $p['title']], $p);
        }

        // Projek (no icon column)
        $projek = [
            ['title' => 'E-Commerce Platform', 'description' => 'Platform e-commerce lengkap dengan manajemen produk, keranjang belanja, pembayaran online (Midtrans), dan dashboard admin real-time.', 'tags' => ['Laravel', 'Vue.js', 'Tailwind', 'MySQL'], 'thumb_color' => 1, 'demo_url' => null, 'github_url' => null, 'urutan' => 1],
            ['title' => 'Sistem Manajemen Sekolah', 'description' => 'Aplikasi manajemen sekolah dengan fitur absensi digital QR-code, penilaian siswa, laporan akademik, dan portal komunikasi orang tua.', 'tags' => ['Laravel', 'MySQL', 'Chart.js', 'Alpine.js'], 'thumb_color' => 2, 'demo_url' => null, 'github_url' => null, 'urutan' => 2],
            ['title' => 'Blog CMS Modern', 'description' => 'Platform blog dengan editor markdown visual, SEO optimization otomatis, dark mode, sistem komentar real-time, dan analytics dashboard.', 'tags' => ['Next.js', 'TypeScript', 'Prisma', 'PostgreSQL'], 'thumb_color' => 3, 'demo_url' => null, 'github_url' => null, 'urutan' => 3],
        ];
        foreach ($projek as $pr) {
            Projek::firstOrCreate(['title' => $pr['title']], $pr);
        }

        // Jurnal
        $jurnal = [
            ['icon' => '', 'title' => 'Implementasi Machine Learning untuk Deteksi Anomali Jaringan Berbasis PHP', 'authors' => 'Anugrah, et al.', 'journal_name' => 'Jurnal Teknologi Informasi dan Ilmu Komputer', 'year' => '2024', 'indexed_by' => 'Sinta 2', 'url' => null, 'description' => 'Penelitian ini membahas penerapan algoritma machine learning pada sistem deteksi anomali jaringan menggunakan framework Laravel dan Python.', 'urutan' => 1],
            ['icon' => '', 'title' => 'Perancangan Sistem Informasi Akademik Berbasis Web dengan Pendekatan Agile', 'authors' => 'Anugrah, Pembimbing A', 'journal_name' => 'Prosiding Seminar Nasional Teknologi Informasi', 'year' => '2023', 'indexed_by' => 'Sinta 3', 'url' => null, 'description' => 'Makalah ini memaparkan proses perancangan sistem informasi akademik menggunakan metodologi Agile Scrum dan framework Vue.js.', 'urutan' => 2],
            ['icon' => '', 'title' => 'Analisis Performa Framework PHP Modern: Laravel vs CodeIgniter 4', 'authors' => 'Anugrah', 'journal_name' => 'Jurnal Ilmu Komputer dan Informatika', 'year' => '2023', 'indexed_by' => 'Google Scholar', 'url' => null, 'description' => 'Studi komparatif performa antara Laravel 10 dan CodeIgniter 4 dalam konteks aplikasi web skala menengah.', 'urutan' => 3],
        ];
        foreach ($jurnal as $j) {
            Jurnal::firstOrCreate(['title' => $j['title']], $j);
        }
    }
}
