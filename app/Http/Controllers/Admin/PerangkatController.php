<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PerangkatDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PerangkatController extends Controller
{
    public function index()
    {
        $perangkat = PerangkatDesa::orderBy('urutan')->paginate(15);
        return view('admin.perangkat.index', compact('perangkat'));
    }

    public function create()
    {
        return view('admin.perangkat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string|max:100',
            'jabatan' => 'required|string|max:100',
            'foto'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'no_hp'   => 'nullable|string|max:20',
            'urutan'  => 'nullable|integer',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('perangkat', 'public');
        }

        PerangkatDesa::create([
            'nama'    => $request->nama,
            'jabatan' => $request->jabatan,
            'foto'    => $fotoPath,
            'no_hp'   => $request->no_hp,
            'urutan'  => $request->urutan ?? 0,
            'aktif'   => true,
        ]);

        return redirect()->route('admin.perangkat.index')
                         ->with('success', 'Perangkat desa berhasil ditambahkan!');
    }

    public function edit(PerangkatDesa $perangkat)
    {
        return view('admin.perangkat.edit', compact('perangkat'));
    }

    public function update(Request $request, PerangkatDesa $perangkat)
    {
        $request->validate([
            'nama'    => 'required|string|max:100',
            'jabatan' => 'required|string|max:100',
            'foto'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'no_hp'   => 'nullable|string|max:20',
            'urutan'  => 'nullable|integer',
        ]);

        $fotoPath = $perangkat->foto;
        if ($request->hasFile('foto')) {
            if ($perangkat->foto) {
                Storage::disk('public')->delete($perangkat->foto);
            }
            $fotoPath = $request->file('foto')->store('perangkat', 'public');
        }

        $perangkat->update([
            'nama'    => $request->nama,
            'jabatan' => $request->jabatan,
            'foto'    => $fotoPath,
            'no_hp'   => $request->no_hp,
            'urutan'  => $request->urutan ?? 0,
            'aktif'   => $request->has('aktif'),
        ]);

        return redirect()->route('admin.perangkat.index')
                         ->with('success', 'Perangkat desa berhasil diperbarui!');
    }

    public function destroy(PerangkatDesa $perangkat)
    {
        if ($perangkat->foto) {
            Storage::disk('public')->delete($perangkat->foto);
        }
        $perangkat->delete();

        return redirect()->route('admin.perangkat.index')
                         ->with('success', 'Perangkat desa berhasil dihapus!');
    }
}