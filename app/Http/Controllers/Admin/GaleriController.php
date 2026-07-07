<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::latest()->paginate(12);
        return view('admin.galeri.index', compact('galeri'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'      => 'required|string|max:200',
            'file'       => 'required|image|mimes:jpg,jpeg,png,webp|max:3072',
            'keterangan' => 'nullable|string',
            'album'      => 'nullable|string|max:100',
        ]);

        $filePath = $request->file('file')->store('galeri', 'public');

        Galeri::create([
            'judul'      => $request->judul,
            'file'       => $filePath,
            'tipe'       => 'foto',
            'keterangan' => $request->keterangan,
            'album'      => $request->album,
        ]);

        return redirect()->route('admin.galeri.index')
                         ->with('success', 'Foto berhasil ditambahkan!');
    }

    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $request->validate([
            'judul'      => 'required|string|max:200',
            'file'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'keterangan' => 'nullable|string',
            'album'      => 'nullable|string|max:100',
        ]);

        $filePath = $galeri->file;
        if ($request->hasFile('file')) {
            if ($galeri->file) {
                Storage::disk('public')->delete($galeri->file);
            }
            $filePath = $request->file('file')->store('galeri', 'public');
        }

        $galeri->update([
            'judul'      => $request->judul,
            'file'       => $filePath,
            'keterangan' => $request->keterangan,
            'album'      => $request->album,
        ]);

        return redirect()->route('admin.galeri.index')
                         ->with('success', 'Foto berhasil diperbarui!');
    }

    public function destroy(Galeri $galeri)
    {
        if ($galeri->file) {
            Storage::disk('public')->delete($galeri->file);
        }
        $galeri->delete();

        return redirect()->route('admin.galeri.index')
                         ->with('success', 'Foto berhasil dihapus!');
    }
}