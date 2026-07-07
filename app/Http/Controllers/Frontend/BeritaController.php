<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\KategoriBerita;

class BeritaController extends Controller
{
    public function index()
    {
        $berita    = Berita::with('kategori')
                        ->where('status', 'publish')
                        ->latest('published_at')
                        ->paginate(9);
        $kategori  = KategoriBerita::withCount(['berita' => function($q) {
                        $q->where('status', 'publish');
                    }])->get();

        return view('frontend.berita.index', compact('berita', 'kategori'));
    }

    public function show($slug)
    {
        $berita = Berita::with(['kategori', 'penulis'])
                    ->where('slug', $slug)
                    ->where('status', 'publish')
                    ->firstOrFail();

        // Tambah view count
        $berita->increment('views');

        $berita_lain = Berita::where('status', 'publish')
                            ->where('id', '!=', $berita->id)
                            ->latest('published_at')
                            ->take(3)
                            ->get();

        return view('frontend.berita.show', compact('berita', 'berita_lain'));
    }
}