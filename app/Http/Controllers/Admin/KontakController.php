<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        $kontak = Kontak::orderBy('created_at', 'desc')->get();
        return view('admin.kontak.index', compact('kontak'));
    }

    public function show($id)
    {
        $kontak = Kontak::findOrFail($id);
        
        // Tandai sebagai sudah dibaca
        if (!$kontak->sudah_dibaca) {
            $kontak->update(['sudah_dibaca' => true]);
        }
        
        return view('admin.kontak.show', compact('kontak'));
    }

    public function destroy($id)
    {
        $kontak = Kontak::findOrFail($id);
        $kontak->delete();

        return redirect()->route('admin.kontak.index')
                         ->with('success', 'Pesan berhasil dihapus!');
    }

    public function markAsRead($id)
    {
        $kontak = Kontak::findOrFail($id);
        $kontak->update(['sudah_dibaca' => true]);

        return redirect()->route('admin.kontak.index')
                         ->with('success', 'Pesan ditandai sebagai sudah dibaca!');
    }

    public function markAsUnread($id)
    {
        $kontak = Kontak::findOrFail($id);
        $kontak->update(['sudah_dibaca' => false]);

        return redirect()->route('admin.kontak.index')
                         ->with('success', 'Pesan ditandai sebagai belum dibaca!');
    }
}
