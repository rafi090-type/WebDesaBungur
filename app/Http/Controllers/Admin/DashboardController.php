<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Berita;

use App\Models\Galeri;

use App\Models\Kontak;

use App\Models\Potensi;

use App\Models\Visitor;

class DashboardController extends Controller

{

    public function index()

    {

        $data = [

            'total_berita'  => Berita::count(),

            'total_galeri'  => Galeri::count(),

            'total_kontak'  => Kontak::where('sudah_dibaca', false)->count(),

            'total_potensi' => Potensi::count(),

            'berita_terbaru' => Berita::with('kategori')

                                    ->latest()

                                    ->take(5)

                                    ->get(),

            'pesan_terbaru' => Kontak::latest()

                                    ->take(5)

                                    ->get(),

            'pengunjung_minggu' => Visitor::orderBy('tanggal', 'desc')

                                         ->take(7)

                                         ->get()

                                         ->reverse()

                                         ->values(),

        ];

        return view('admin.dashboard', $data);

    }

}
