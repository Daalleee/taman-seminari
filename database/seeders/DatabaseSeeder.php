<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use App\Models\Vision;
use App\Models\Mission;
use App\Models\Banner;
use App\Models\ActivityCategory;
use App\Models\Activity;
use App\Models\NewsCategory;
use App\Models\News;
use App\Models\Album;
use App\Models\GalleryItem;
use App\Models\Event;
use App\Models\Contact;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Taman Seminari',
            'email' => 'admin@tamanseminari.com',
            'password' => bcrypt('password'),
        ]);

        Profile::create([
            'name' => 'Taman Seminari ITCI',
            'history' => 'Taman Seminari ITCI berdiri sejak tahun 2010 sebagai pusat pembinaan iman dan pengembangan karakter bagi generasi muda di wilayah Maridan, Kalimantan Timur. Berawal dari sekelompok kecil umat yang ingin memiliki tempat retret dan rekoleksi yang representatif, kini Taman Seminari ITCI telah berkembang menjadi pusat kegiatan rohani yang melayani berbagai kalangan.',
            'description' => 'Taman Seminari ITCI adalah pusat pembinaan iman Katolik yang menyediakan berbagai kegiatan rohani, retret, rekoleksi, dan pelatihan bagi umat. Kami berkomitmen untuk menjadi tempat yang nyaman dan kondusif bagi pertumbuhan iman dan karakter.',
            'goal' => 'Menjadi pusat pembinaan iman terdepan di Kalimantan Timur yang melahirkan generasi muda berkarakter Kristiani dan berkontribusi positif bagi masyarakat.',
            'motto' => 'Membina Iman, Membangun Karakter, Melayani Sesama',
        ]);

        Vision::create(['vision' => 'Menjadi pusat pembinaan iman yang unggul dalam melahirkan generasi muda yang beriman, berkarakter, dan berkontribusi nyata bagi Gereja dan Masyarakat.']);

        Mission::create(['mission' => 'Menyelenggarakan kegiatan pembinaan iman yang berkualitas dan berkesinambungan.']);
        Mission::create(['mission' => 'Menyediakan fasilitas yang nyaman dan memadai bagi kegiatan rohani.']);
        Mission::create(['mission' => 'Membangun komunitas iman yang saling mendukung dan bertumbuh bersama.']);
        Mission::create(['mission' => 'Berkolaborasi dengan berbagai pihak untuk memperluas dampak pelayanan.']);

        Banner::create([
            'title' => 'Selamat Datang di Taman Seminari ITCI',
            'subtitle' => 'Pusat Pembinaan Iman dan Pengembangan Karakter',
            'image' => 'banners/hero-default.jpg',
            'button_text' => 'Jelajahi Kami',
            'button_url' => '/profil',
            'order' => 1,
            'is_active' => true,
        ]);
        Banner::create([
            'title' => 'Kegiatan Rohani',
            'subtitle' => 'Berbagai kegiatan rohani untuk memperkuat iman Anda',
            'image' => 'banners/hero-default.jpg',
            'button_text' => 'Lihat Kegiatan',
            'button_url' => '/kegiatan',
            'order' => 2,
            'is_active' => true,
        ]);

        $catPembinaan = ActivityCategory::create(['name' => 'Pembinaan Iman', 'slug' => 'pembinaan-iman']);
        $catRekoleksi = ActivityCategory::create(['name' => 'Rekoleksi', 'slug' => 'rekoleksi']);
        $catBaktiSosial = ActivityCategory::create(['name' => 'Bakti Sosial', 'slug' => 'bakti-sosial']);
        $catPelatihan = ActivityCategory::create(['name' => 'Pelatihan', 'slug' => 'pelatihan']);

        Activity::create([
            'category_id' => $catRekoleksi->id,
            'title' => 'Rekoleksi Masa Adven',
            'slug' => 'rekoleksi-masa-adven',
            'description' => 'Rekoleksi menyambut masa Adven dengan tema "Mempersiapkan Hati Menyambut Tuhan". Kegiatan ini diikuti oleh 50 peserta dari berbagai paroki.',
            'thumbnail' => null,
            'activity_date' => '2024-12-10',
            'location' => 'Aula Taman Seminari ITCI',
            'status' => 'published',
        ]);
        Activity::create([
            'category_id' => $catPembinaan->id,
            'title' => 'Pendalaman Ihan Kaum Muda',
            'slug' => 'pendalaman-iman-kaum-muda',
            'description' => 'Kegiatan pendalaman iman khusus bagi kaum muda untuk memperkuat fondasi iman dan membangun persaudaraan.',
            'thumbnail' => null,
            'activity_date' => '2024-11-20',
            'location' => 'Taman Seminari ITCI',
            'status' => 'published',
        ]);
        Activity::create([
            'category_id' => $catBaktiSosial->id,
            'title' => 'Bakti Sosial Natal',
            'slug' => 'bakti-sosial-natal',
            'description' => 'Kegiatan bakti sosial dalam rangka merayakan Natal dengan berbagi kasih kepada sesama yang membutuhkan di sekitar Maridan.',
            'thumbnail' => null,
            'activity_date' => '2024-12-20',
            'location' => 'Maridan dan Sekitarnya',
            'status' => 'published',
        ]);
        Activity::create([
            'category_id' => $catPelatihan->id,
            'title' => 'Pelatihan Kepemimpinan Kristiani',
            'slug' => 'pelatihan-kepemimpinan-kristiani',
            'description' => 'Pelatihan kepemimpinan bagi pengurus muda gereja untuk mengembangkan kemampuan memimpin yang berlandaskan nilai-nilai Kristiani.',
            'thumbnail' => null,
            'activity_date' => '2025-01-15',
            'location' => 'Aula Taman Seminari ITCI',
            'status' => 'published',
        ]);

        $newsCatBerita = NewsCategory::create(['name' => 'Berita', 'slug' => 'berita']);
        $newsCatPengumuman = NewsCategory::create(['name' => 'Pengumuman', 'slug' => 'pengumuman']);

        News::create([
            'category_id' => $newsCatBerita->id,
            'title' => 'Pembukaan Pendaftaran Rekoleksi Tahun 2025',
            'slug' => 'pembukaan-pendaftaran-rekoleksi-2025',
            'excerpt' => 'Taman Seminari ITCI membuka pendaftaran untuk kegiatan rekoleksi tahun 2025. Berbagai jadwal dan tema menarik telah disiapkan.',
            'content' => '<p>Taman Seminari ITCI dengan sukacita mengumumkan pembukaan pendaftaran untuk kegiatan rekoleksi tahun 2025. Berbagai jadwal dan tema menarik telah disiapkan untuk melayani umat dari berbagai kalangan.</p><p>Untuk informasi lebih lanjut, silakan menghubungi kontak kami atau datang langsung ke Taman Seminari ITCI.</p>',
            'thumbnail' => null,
            'status' => 'published',
            'published_at' => now(),
        ]);
        News::create([
            'category_id' => $newsCatPengumuman->id,
            'title' => 'Jadwal Misa Hari Minggu Bulan Januari 2025',
            'slug' => 'jadwal-misa-januari-2025',
            'excerpt' => 'Berikut adalah jadwal misa hari Minggu di Taman Seminari ITCI selama bulan Januari 2025.',
            'content' => '<p>Berikut adalah jadwal misa hari Minggu di Taman Seminari ITCI selama bulan Januari 2025:</p><ul><li>Minggu, 5 Januari 2025 - Pukul 07.00 WITA</li><li>Minggu, 12 Januari 2025 - Pukul 07.00 WITA</li><li>Minggu, 19 Januari 2025 - Pukul 07.00 WITA</li><li>Minggu, 26 Januari 2025 - Pukul 07.00 WITA</li></ul>',
            'thumbnail' => null,
            'status' => 'published',
            'published_at' => now(),
        ]);
        News::create([
            'category_id' => $newsCatBerita->id,
            'title' => 'Kunjungan dari Paroki Santo Petrus',
            'slug' => 'kunjungan-paroki-santo-petrus',
            'excerpt' => 'Paroki Santo Petrus melakukan kunjungan ke Taman Seminari ITCI dalam rangka studi banding pengelolaan pusat kegiatan rohani.',
            'content' => '<p>Pada hari Sabtu, 12 Januari 2025, Taman Seminari ITCI menerima kunjungan dari rombongan Paroki Santo Petrus. Kunjungan ini bertujuan untuk studi banding dalam rangka pengelolaan pusat kegiatan rohani.</p><p>Rombongan diterima langsung oleh pengurus Taman Seminari ITCI dan diajak berkeliling melihat fasilitas yang tersedia.</p>',
            'thumbnail' => null,
            'status' => 'published',
            'published_at' => now(),
        ]);

        $album = Album::create(['name' => 'Kegiatan Taman Seminari', 'cover' => null]);

        Contact::create([
            'address' => 'Maridan, Kec. Sangatta Selatan, Kab. Kutai Timur, Kalimantan Timur',
            'phone' => '0812-3456-7890',
            'email' => 'info@tamanseminari.com',
            'maps' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127628.123456!2d117.123456!3d0.123456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMMKwMDcnMjQuNiJTIDExN8KwMTEnMjAuMCJF!5e0!3m2!1sid!2sid!4v1234567890" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
            'facebook' => 'https://facebook.com/tamanseminari',
            'instagram' => 'https://instagram.com/tamanseminari',
            'youtube' => 'https://youtube.com/@tamanseminari',
        ]);

        Setting::create([
            'site_name' => 'Taman Seminari ITCI',
            'footer' => 'Taman Seminari ITCI - Pusat Pembinaan Ian dan Pengembangan Karakter',
            'copyright' => '2025 Taman Seminari ITCI. All rights reserved.',
        ]);

        Event::create([
            'title' => 'Rekoleksi Masa Prapaskah',
            'description' => 'Rekoleksi menyambut masa Prapaskah dengan tema "Pertobatan dan Pembaharuan Iman".',
            'event_date' => '2025-03-05 08:00:00',
            'location' => 'Aula Taman Seminari ITCI',
            'poster' => null,
        ]);
        Event::create([
            'title' => 'Misa Rabu Abu',
            'description' => 'Perayaan Misa Rabu Abu menandai awal masa Prapaskah.',
            'event_date' => '2025-03-05 07:00:00',
            'location' => 'Kapel Taman Seminari ITCI',
            'poster' => null,
        ]);
    }
}
