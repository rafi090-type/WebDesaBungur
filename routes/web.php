<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\BeritaController;
use App\Http\Controllers\Frontend\KontakController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\AgendaController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\PotensiController;
use App\Http\Controllers\Admin\PerangkatController;
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\Admin\SettingController;

// FRONTEND
Route::get('/',          [HomeController::class, 'index'])->name('home');
Route::get('/profil',    [HomeController::class, 'profil'])->name('profil');
Route::get('/perangkat', [HomeController::class, 'perangkat'])->name('perangkat');
Route::get('/statistik', [HomeController::class, 'statistik'])->name('statistik');
Route::get('/galeri',    [HomeController::class, 'galeri'])->name('galeri');
Route::get('/potensi',   [HomeController::class, 'potensi'])->name('potensi');
Route::get('/berita',         [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}',  [BeritaController::class, 'show'])->name('berita.show');
Route::get('/kontak',         [KontakController::class, 'index'])->name('kontak');
Route::post('/kontak',        [KontakController::class, 'store'])->name('kontak.store');

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
});

require __DIR__.'/auth.php';