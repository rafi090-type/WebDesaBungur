<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;

// ─────────────────────────────────────────

// FRONTEND (Halaman Publik)

// ─────────────────────────────────────────

Route::get('/', function () {

    return view('frontend.home');

})->name('home');

// ─────────────────────────────────────────

// ADMIN (Protected by isAdmin middleware)

// ─────────────────────────────────────────

Route::prefix('admin')

    ->name('admin.')

    ->middleware(['auth', 'isAdmin'])

    ->group(function () {

        // Dashboard

        Route::get('/dashboard', [DashboardController::class, 'index'])

            ->name('dashboard');

        // Nanti ditambah route CRUD lainnya di fase berikutnya:

        // Route::resource('berita', BeritaController::class);

        // Route::resource('galeri', GaleriController::class);

        // dst...

    });

// Auth routes (login, logout) dari Breeze

require __DIR__.'/auth.php';
