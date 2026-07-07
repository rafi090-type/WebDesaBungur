<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::with('kategori')
                    ->latest()
                    ->paginate(10);

        return view('admin.berita.index', compact('berita'));
    }

    public function create()
    {
        $kategori = KategoriBerita::all();
        return view('admin.berita.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'       => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori_berita,id',
            'isi'         => 'required',
            'status'      => 'required|in:draft,publish',
            'thumbnail'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'ringkasan'   => 'nullable|string|max:300',
        ]);

        // Upload thumbnail
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('berita', 'public');
        }

        // Generate slug unik
        $slug = Str::slug($request->judul);
        $originalSlug = $slug;
        $count = 1;
        while (Berita::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        Berita::create([
            'judul'        => $request->judul,
            'slug'         => $slug,
            'kategori_id'  => $request->kategori_id,
            'user_id'      => auth()->id(),
            'ringkasan'    => $request->ringkasan,
            'isi'          => $request->isi,
            'thumbnail'    => $thumbnailPath,
            'status'       => $request->status,
            'published_at' => $request->status === 'publish' ? now() : null,
        ]);

        return redirect()->route('admin.berita.index')
                         ->with('success', 'Berita berhasil ditambahkan!');
    }

    public function edit(Berita $beritum)
    {
        $kategori = KategoriBerita::all();
        return view('admin.berita.edit', [
            'berita'   => $beritum,
            'kategori' => $kategori,
        ]);
    }

    public function update(Request $request, Berita $beritum)
    {
        $request->validate([
            'judul'       => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori_berita,id',
            'isi'         => 'required',
            'status'      => 'required|in:draft,publish',
            'thumbnail'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'ringkasan'   => 'nullable|string|max:300',
        ]);

        // Upload thumbnail baru jika ada
        $thumbnailPath = $beritum->thumbnail;
        if ($request->hasFile('thumbnail')) {
            // Hapus thumbnail lama
            if ($beritum->thumbnail) {
                Storage::disk('public')->delete($beritum->thumbnail);
            }
            $thumbnailPath = $request->file('thumbnail')->store('berita', 'public');
        }

        // Update slug hanya jika judul berubah
        $slug = $beritum->slug;
        if ($request->judul !== $beritum->judul) {
            $slug = Str::slug($request->judul);
            $originalSlug = $slug;
            $count = 1;
            while (Berita::where('slug', $slug)->where('id', '!=', $beritum->id)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }
        }

        $beritum->update([
            'judul'        => $request->judul,
            'slug'         => $slug,
            'kategori_id'  => $request->kategori_id,
            'ringkasan'    => $request->ringkasan,
            'isi'          => $request->isi,
            'thumbnail'    => $thumbnailPath,
            'status'       => $request->status,
            'published_at' => $request->status === 'publish' && !$beritum->published_at
                                ? now() : $beritum->published_at,
        ]);

        return redirect()->route('admin.berita.index')
                         ->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy(Berita $beritum)
    {
        // Hapus thumbnail dari storage
        if ($beritum->thumbnail) {
            Storage::disk('public')->delete($beritum->thumbnail);
        }

        $beritum->delete();

        return redirect()->route('admin.berita.index')
                         ->with('success', 'Berita berhasil dihapus!');
    }
}