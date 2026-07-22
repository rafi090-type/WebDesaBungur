<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\BeritaController;
use App\Http\Controllers\Frontend\KontakController as FrontendKontakController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\AgendaController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\PotensiController;
use App\Http\Controllers\Admin\PerangkatController;
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\StatistikController;
use App\Http\Controllers\Admin\KontakController as AdminKontakController;

// FRONTEND
Route::get('/',          [HomeController::class, 'index'])->name('home');
Route::get('/profil',    [HomeController::class, 'profil'])->name('profil');
Route::get('/perangkat', [HomeController::class, 'perangkat'])->name('perangkat');
Route::get('/statistik', [HomeController::class, 'statistik'])->name('statistik');
Route::get('/galeri',    [HomeController::class, 'galeri'])->name('galeri');
Route::get('/potensi',   [HomeController::class, 'potensi'])->name('potensi');
Route::get('/berita',         [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}',  [BeritaController::class, 'show'])->name('berita.show');
Route::get('/kontak',         [FrontendKontakController::class, 'index'])->name('kontak');
Route::post('/kontak',        [FrontendKontakController::class, 'store'])->name('kontak.store');

// ADMIN
Route::prefix('admin')->name('admin.')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('berita',    AdminBeritaController::class);
    Route::resource('galeri',    GaleriController::class);
    Route::resource('potensi',   PotensiController::class);
    Route::resource('agenda',    AgendaController::class);
    Route::resource('perangkat', PerangkatController::class);

    Route::get('/profil',  [ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/profil',  [ProfilController::class, 'update'])->name('profil.update');

    Route::get('/setting', [SettingController::class, 'edit'])->name('setting.edit');
    Route::put('/setting', [SettingController::class, 'update'])->name('setting.update');

    Route::get('/statistik', [StatistikController::class, 'edit'])->name('statistik.edit');
    Route::put('/statistik', [StatistikController::class, 'update'])->name('statistik.update');
    Route::get('/statistik/create', [StatistikController::class, 'create'])->name('statistik.create');
    Route::post('/statistik', [StatistikController::class, 'store'])->name('statistik.store');
    Route::delete('/statistik/{id}', [StatistikController::class, 'destroy'])->name('statistik.destroy');

    Route::get('/kontak', [AdminKontakController::class, 'index'])->name('kontak.index');
    Route::get('/kontak/{id}', [AdminKontakController::class, 'show'])->name('kontak.show');
    Route::delete('/kontak/{id}', [AdminKontakController::class, 'destroy'])->name('kontak.destroy');
    Route::post('/kontak/{id}/mark-read', [AdminKontakController::class, 'markAsRead'])->name('kontak.mark-read');
    Route::post('/kontak/{id}/mark-unread', [AdminKontakController::class, 'markAsUnread'])->name('kontak.mark-unread');
});

require __DIR__.'/auth.php';