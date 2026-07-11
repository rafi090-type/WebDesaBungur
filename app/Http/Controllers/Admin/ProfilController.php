<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function index()
    {
        $profil = ProfilDesa::first();

        // Buat data awal jika belum ada
        if (!$profil) {
            $profil = ProfilDesa::create([
                'nama_desa'  => 'Desa Bungur',
                'kecamatan'  => 'Rangsang Pesisir',
                'kabupaten'  => 'Kepulauan Meranti',
                'provinsi'   => 'Riau',
            ]);
        }

        return view('admin.profil.index', compact('profil'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_desa'      => 'required|string|max:100',
            'kecamatan'      => 'required|string|max:100',
            'kabupaten'      => 'required|string|max:100',
            'provinsi'       => 'required|string|max:100',
            'kode_pos'       => 'nullable|string|max:10',
            'nama_kades'     => 'nullable|string|max:100',
            'telepon'        => 'nullable|string|max:20',
            'email'          => 'nullable|email|max:100',
            'alamat'         => 'nullable|string',
            'sejarah'        => 'nullable|string',
            'visi'           => 'nullable|string',
            'misi'           => 'nullable|string',
            'sambutan_kades' => 'nullable|string',
            'foto_kades'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'logo'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
        ]);

        $profil = ProfilDesa::first();

        // Upload foto kades
        $fotoKades = $profil->foto_kades;
        if ($request->hasFile('foto_kades')) {
            if ($profil->foto_kades) {
                Storage::disk('public')->delete($profil->foto_kades);
            }
            $fotoKades = $request->file('foto_kades')->store('profil', 'public');
        }

        // Upload logo
        $logo = $profil->logo;
        if ($request->hasFile('logo')) {
            if ($profil->logo) {
                Storage::disk('public')->delete($profil->logo);
            }
            $logo = $request->file('logo')->store('profil', 'public');
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
            'foto_kades'     => $fotoKades,
            'logo'           => $logo,
        ]);

        return redirect()->route('admin.profil.index')
                         ->with('success', 'Profil desa berhasil diperbarui!');
    }
}