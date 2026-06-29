<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\VisionController;
use App\Http\Controllers\Admin\MissionController;
use App\Http\Controllers\Admin\ActivityCategoryController;
use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\NewsCategoryController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\Admin\GalleryItemController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfilController as PublicProfilController;
use App\Http\Controllers\VisiMisiController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\KontakController as PublicKontakController;
use App\Http\Controllers\FaqController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Profil (singleton)
        Route::get('/profil', [ProfileController::class, 'index'])->name('profil');
        Route::put('/profil', [ProfileController::class, 'update'])->name('profil.update');

        // Banner
        Route::resource('/banner', BannerController::class)->except(['show']);

        // Visi & Misi
        Route::get('/visi-misi', [VisionController::class, 'index'])->name('visi-misi');
        Route::post('/visi', [VisionController::class, 'store'])->name('vision.store');
        Route::put('/visi/{id}', [VisionController::class, 'update'])->name('vision.update');
        Route::delete('/visi/{id}', [VisionController::class, 'destroy'])->name('vision.destroy');
        Route::post('/misi', [MissionController::class, 'store'])->name('mission.store');
        Route::put('/misi/{id}', [MissionController::class, 'update'])->name('mission.update');
        Route::delete('/misi/{id}', [MissionController::class, 'destroy'])->name('mission.destroy');

        // Kegiatan
        Route::resource('/kategori-kegiatan', ActivityCategoryController::class)->except(['show']);
        Route::resource('/kegiatan', ActivityController::class)->except(['show']);

        // Berita
        Route::resource('/kategori-berita', NewsCategoryController::class)->except(['show']);
        Route::resource('/berita', NewsController::class)->except(['show']);

        // Galeri
        Route::resource('/album', AlbumController::class)->except(['show']);
        Route::resource('/galeri', GalleryItemController::class)->except(['show']);

        // Agenda
        Route::resource('/agenda', EventController::class)->except(['show']);

        // Kontak (singleton)
        Route::get('/kontak', [ContactController::class, 'index'])->name('kontak');
        Route::put('/kontak', [ContactController::class, 'update'])->name('kontak.update');

        // Pesan
        Route::get('/pesan', [MessageController::class, 'index'])->name('pesan');
        Route::get('/pesan/{id}', [MessageController::class, 'show'])->name('pesan.show');
        Route::delete('/pesan/{id}', [MessageController::class, 'destroy'])->name('pesan.destroy');

        // Pengaturan (singleton)
        Route::get('/pengaturan', [SettingController::class, 'index'])->name('pengaturan');
        Route::put('/pengaturan', [SettingController::class, 'update'])->name('pengaturan.update');

        // Akun Admin
        Route::get('/akun-admin', [AccountController::class, 'index'])->name('akun-admin');
        Route::put('/akun-admin', [AccountController::class, 'update'])->name('akun-admin.update');
    });
});

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil', [PublicProfilController::class, 'index'])->name('public.profil');
Route::get('/visi-misi', [VisiMisiController::class, 'index'])->name('public.visi-misi');
Route::get('/kegiatan', [KegiatanController::class, 'index'])->name('public.kegiatan');
Route::get('/kegiatan/{slug}', [KegiatanController::class, 'show'])->name('public.kegiatan.show');
Route::get('/berita', [BeritaController::class, 'index'])->name('public.berita');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('public.berita.show');
Route::get('/galeri', [GaleriController::class, 'index'])->name('public.galeri');
Route::get('/agenda', [AgendaController::class, 'index'])->name('public.agenda');
Route::get('/kontak', [PublicKontakController::class, 'index'])->name('public.kontak');
Route::post('/kontak/kirim', [PublicKontakController::class, 'kirim'])->name('public.kontak.kirim');
Route::get('/faq', [FaqController::class, 'index'])->name('public.faq');
