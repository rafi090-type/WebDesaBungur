<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Statistik;
use Illuminate\Http\Request;

class StatistikController extends Controller
{
    public function edit()
    {
        $kategori = ['penduduk', 'agama', 'pekerjaan', 'pendidikan'];
        $data = [];
        foreach ($kategori as $k) {
            $data[$k] = Statistik::where('kategori', $k)->orderBy('urutan')->get();
        }
        return view('admin.statistik.edit', compact('data', 'kategori'));
    }

    public function update(Request $request)
    {
        // Update jumlah setiap item statistik
        if ($request->has('statistik')) {
            foreach ($request->statistik as $id => $jumlah) {
                Statistik::where('id', $id)->update(['jumlah' => (int) $jumlah]);
            }
        }

        return redirect()->route('admin.statistik.edit')
                         ->with('success', 'Data statistik berhasil diperbarui!');
    }

    public function create()
    {
        $kategori = ['penduduk', 'agama', 'pekerjaan', 'pendidikan'];
        return view('admin.statistik.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori' => 'required|in:penduduk,agama,pekerjaan,pendidikan',
            'label' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:0',
            'urutan' => 'required|integer|min:0',
        ]);

        Statistik::create($validated);

        return redirect()->route('admin.statistik.edit')
                         ->with('success', 'Data statistik baru berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $statistik = Statistik::findOrFail($id);
        $statistik->delete();

        return redirect()->route('admin.statistik.edit')
                         ->with('success', 'Data statistik berhasil dihapus!');
    }
}