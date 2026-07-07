<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\BeritaController;
use App\Http\Controllers\Frontend\KontakController;
use App\Http\Controllers\Admin\DashboardController;

// ─────────────────────────────────────────
// FRONTEND — Halaman Publik
// ─────────────────────────────────────────
Route::get('/',          [HomeController::class, 'index'])->name('home');
Route::get('/profil',    [HomeController::class, 'profil'])->name('profil');
Route::get('/galeri',    [HomeController::class, 'galeri'])->name('galeri');
Route::get('/potensi',   [HomeController::class, 'potensi'])->name('potensi');

Route::get('/berita',           [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}',    [BeritaController::class, 'show'])->name('berita.show');

Route::get('/kontak',           [KontakController::class, 'index'])->name('kontak');
Route::post('/kontak',          [KontakController::class, 'store'])->name('kontak.store');

// ─────────────────────────────────────────
// ADMIN — Protected
// ─────────────────────────────────────────
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'isAdmin'])
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        // CRUD routes ditambah di fase berikutnya
        Route::resource('berita', \App\Http\Controllers\Admin\BeritaController::class);
        Route::resource('agenda', \App\Http\Controllers\Admin\AgendaController::class);
        Route::resource('galeri', \App\Http\Controllers\Admin\GaleriController::class);
        Route::resource('potensi', \App\Http\Controllers\Admin\PotensiController::class);
    });

require __DIR__.'/auth.php';