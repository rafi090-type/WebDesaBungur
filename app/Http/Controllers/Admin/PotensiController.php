<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Potensi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PotensiController extends Controller
{
    public function index()
    {
        $potensi = Potensi::orderBy('urutan')->paginate(10);
        return view('admin.potensi.index', compact('potensi'));
    }

    public function create()
    {
        return view('admin.potensi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'       => 'required|string|max:200',
            'kategori'    => 'required|in:pertanian,perikanan,umkm,wisata,lainnya',
            'deskripsi'   => 'required|string',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'urutan'      => 'nullable|integer',
            'tampil_home' => 'nullable|boolean',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('potensi', 'public');
        }

        $slug = Str::slug($request->judul);
        $originalSlug = $slug;
        $count = 1;
        while (Potensi::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        Potensi::create([
            'judul'       => $request->judul,
            'slug'        => $slug,
            'kategori'    => $request->kategori,
            'deskripsi'   => $request->deskripsi,
            'foto'        => $fotoPath,
            'urutan'      => $request->urutan ?? 0,
            'tampil_home' => $request->has('tampil_home'),
        ]);

        return redirect()->route('admin.potensi.index')
                         ->with('success', 'Potensi berhasil ditambahkan!');
    }

    public function edit(Potensi $potensi)
    {
        return view('admin.potensi.edit', compact('potensi'));
    }

    public function update(Request $request, Potensi $potensi)
    {
        $request->validate([
            'judul'       => 'required|string|max:200',
            'kategori'    => 'required|in:pertanian,perikanan,umkm,wisata,lainnya',
            'deskripsi'   => 'required|string',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'urutan'      => 'nullable|integer',
        ]);

        $fotoPath = $potensi->foto;
        if ($request->hasFile('foto')) {
            if ($potensi->foto) {
                Storage::disk('public')->delete($potensi->foto);
            }
            $fotoPath = $request->file('foto')->store('potensi', 'public');
        }

        $potensi->update([
            'judul'       => $request->judul,
            'kategori'    => $request->kategori,
            'deskripsi'   => $request->deskripsi,
            'foto'        => $fotoPath,
            'urutan'      => $request->urutan ?? 0,
            'tampil_home' => $request->has('tampil_home'),
        ]);

        return redirect()->route('admin.potensi.index')
                         ->with('success', 'Potensi berhasil diperbarui!');
    }

    public function destroy(Potensi $potensi)
    {
        if ($potensi->foto) {
            Storage::disk('public')->delete($potensi->foto);
        }
        $potensi->delete();

        return redirect()->route('admin.potensi.index')
                         ->with('success', 'Potensi berhasil dihapus!');
    }
}