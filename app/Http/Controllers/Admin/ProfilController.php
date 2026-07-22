<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function edit()
    {
        $profil = ProfilDesa::firstOrCreate([], [
            'nama_desa'  => 'Desa Bungur',
            'kecamatan'  => 'Rangsang Pesisir',
            'kabupaten'  => 'Kepulauan Meranti',
            'provinsi'   => 'Riau',
        ]);

        return view('admin.profil.edit', compact('profil'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_desa'      => 'required|string|max:150',
            'kecamatan'      => 'required|string|max:150',
            'kabupaten'      => 'required|string|max:150',
            'provinsi'       => 'required|string|max:150',
            'nama_kades'     => 'nullable|string|max:150',
            'telepon'        => 'nullable|string|max:30',
            'email'          => 'nullable|email|max:150',
            'alamat'         => 'nullable|string',
            'sejarah'        => 'nullable|string',
            'visi'           => 'nullable|string',
            'misi'           => 'nullable|string',
            'sambutan_kades' => 'nullable|string',
            'logo'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
            'foto_kades'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $profil = ProfilDesa::first();

        $logoPath = $profil->logo;
        if ($request->hasFile('logo')) {
            if ($profil->logo) Storage::disk('public')->delete($profil->logo);
            $logoPath = $request->file('logo')->store('profil', 'public');
        }

        $fotoKadesPath = $profil->foto_kades;
        if ($request->hasFile('foto_kades')) {
            if ($profil->foto_kades) Storage::disk('public')->delete($profil->foto_kades);
            $fotoKadesPath = $request->file('foto_kades')->store('profil', 'public');
        }

        $profil->update([
            'nama_desa'      => $request->nama_desa,
            'kecamatan'      => $request->kecamatan,
            'kabupaten'      => $request->kabupaten,
            'provinsi'       => $request->provinsi,
            'kode_pos'       => $request->kode_pos,
            'nama_kades'     => $request->nama_kades,
            'telepon'        => $request->telepon,
            'email'          => $request->email,
            'alamat'         => $request->alamat,
            'sejarah'        => $request->sejarah,
            'visi'           => $request->visi,
            'misi'           => $request->misi,
            'sambutan_kades' => $request->sambutan_kades,
            'logo'           => $logoPath,
            'foto_kades'     => $fotoKadesPath,
        ]);

        return redirect()->route('admin.profil.edit')
                         ->with('success', 'Profil desa berhasil diperbarui!');
    }
}