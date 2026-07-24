<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Download;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function index()
    {
        $downloads = Download::latest()->paginate(10);
        return view('admin.download.index', compact('downloads'));
    }

    public function create()
    {
        return view('admin.download.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'      => 'required|string|max:200',
            'kategori'   => 'required|string|max:100',
            'keterangan' => 'nullable|string',
            'file'       => 'required|file|mimes:pdf,doc,docx,xls,xlsx,zip|max:10240',
        ], [
            'file.mimes' => 'Format file harus PDF, DOC, DOCX, XLS, XLSX, atau ZIP.',
            'file.max'   => 'Ukuran file maksimal 10MB.',
        ]);

        $filePath = $request->file('file')->store('downloads', 'public');

        Download::create([
            'judul'      => $request->judul,
            'kategori'   => $request->kategori,
            'keterangan' => $request->keterangan,
            'file'       => $filePath,
            'unduhan'    => 0,
        ]);

        return redirect()->route('admin.download.index')
                         ->with('success', 'Dokumen berhasil diupload!');
    }

    public function edit(Download $download)
    {
        return view('admin.download.edit', compact('download'));
    }

    public function update(Request $request, Download $download)
    {
        $request->validate([
            'judul'      => 'required|string|max:200',
            'kategori'   => 'required|string|max:100',
            'keterangan' => 'nullable|string',
            'file'       => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,zip|max:10240',
        ]);

        $filePath = $download->file;
        if ($request->hasFile('file')) {
            if ($download->file) {
                Storage::disk('public')->delete($download->file);
            }
            $filePath = $request->file('file')->store('downloads', 'public');
        }

        $download->update([
            'judul'      => $request->judul,
            'kategori'   => $request->kategori,
            'keterangan' => $request->keterangan,
            'file'       => $filePath,
        ]);

        return redirect()->route('admin.download.index')
                         ->with('success', 'Dokumen berhasil diperbarui!');
    }

    public function destroy(Download $download)
    {
        if ($download->file) {
            Storage::disk('public')->delete($download->file);
        }
        $download->delete();

        return redirect()->route('admin.download.index')
                         ->with('success', 'Dokumen berhasil dihapus!');
    }
}