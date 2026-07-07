<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index()
    {
        $agenda = Agenda::orderBy('tanggal', 'desc')->paginate(10);
        return view('admin.agenda.index', compact('agenda'));
    }

    public function create()
    {
        return view('admin.agenda.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'      => 'required|string|max:200',
            'tanggal'    => 'required|date',
            'jam_mulai'  => 'nullable|date_format:H:i',
            'jam_selesai'=> 'nullable|date_format:H:i',
            'lokasi'     => 'nullable|string|max:200',
            'deskripsi'  => 'nullable|string',
        ]);

        Agenda::create($request->only(
            'judul', 'tanggal', 'jam_mulai', 'jam_selesai', 'lokasi', 'deskripsi'
        ));

        return redirect()->route('admin.agenda.index')
                         ->with('success', 'Agenda berhasil ditambahkan!');
    }

    public function edit(Agenda $agenda)
    {
        return view('admin.agenda.edit', compact('agenda'));
    }

    public function update(Request $request, Agenda $agenda)
    {
        $request->validate([
            'judul'      => 'required|string|max:200',
            'tanggal'    => 'required|date',
            'jam_mulai'  => 'nullable|date_format:H:i',
            'jam_selesai'=> 'nullable|date_format:H:i',
            'lokasi'     => 'nullable|string|max:200',
            'deskripsi'  => 'nullable|string',
        ]);

        $agenda->update($request->only(
            'judul', 'tanggal', 'jam_mulai', 'jam_selesai', 'lokasi', 'deskripsi'
        ));

        return redirect()->route('admin.agenda.index')
                         ->with('success', 'Agenda berhasil diperbarui!');
    }

    public function destroy(Agenda $agenda)
    {
        $agenda->delete();
        return redirect()->route('admin.agenda.index')
                         ->with('success', 'Agenda berhasil dihapus!');
    }
}