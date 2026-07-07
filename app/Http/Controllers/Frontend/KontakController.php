<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        return view('frontend.kontak');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string|max:100',
            'no_hp'   => 'nullable|string|max:20',
            'perihal' => 'required|string|max:150',
            'pesan'   => 'required|string',
        ], [
            'nama.required'    => 'Nama wajib diisi.',
            'perihal.required' => 'Perihal wajib diisi.',
            'pesan.required'   => 'Pesan wajib diisi.',
        ]);

        Kontak::create($request->only('nama', 'no_hp', 'perihal', 'pesan'));

        return back()->with('success', 'Pesan berhasil dikirim! Kami akan segera menghubungi Anda.');
    }
}