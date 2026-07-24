<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kontak;

class KontakController extends Controller
{
    public function index()
    {
        $pesan = Kontak::latest()->paginate(15);
        $totalDibaca = Kontak::where('sudah_dibaca', true)->count();
        $totalBelumDibaca = Kontak::where('sudah_dibaca', false)->count();
        
        return view('admin.kontak.index', compact('pesan', 'totalDibaca', 'totalBelumDibaca'));
    }

    public function show(Kontak $kontak)
    {
        // Tandai sudah dibaca
        if (!$kontak->sudah_dibaca) {
            $kontak->update(['sudah_dibaca' => true]);
        }
        return view('admin.kontak.show', compact('kontak'));
    }

    public function destroy(Kontak $kontak)
    {
        $kontak->delete();
        return redirect()->route('admin.kontak.index')
                         ->with('success', 'Pesan berhasil dihapus!');
    }
}