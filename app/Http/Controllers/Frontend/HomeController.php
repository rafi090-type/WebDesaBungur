<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Agenda;
use App\Models\Galeri;
use App\Models\Potensi;
use App\Models\ProfilDesa;
use App\Models\PerangkatDesa;
use App\Models\Visitor;
use App\Models\Statistik;
use Carbon\Carbon;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        // Hitung pengunjung hari ini
        $today = Carbon::today();
        $visitor = Visitor::firstOrCreate(['tanggal' => $today]);
        $visitor->increment('jumlah');

        $data = [
            'profil'   => ProfilDesa::first(),
            'berita'   => Berita::with('kategori')
                            ->where('status', 'publish')
                            ->latest('published_at')
                            ->take(3)
                            ->get(),
            'agenda'   => Agenda::where('tanggal', '>=', $today)
                            ->orderBy('tanggal')
                            ->take(3)
                            ->get(),
            'galeri'   => Galeri::where('tipe', 'foto')
                            ->latest()
                            ->take(6)
                            ->get(),
            'potensi'  => Potensi::where('tampil_home', true)
                            ->orderBy('urutan')
                            ->take(4)
                            ->get(),
        ];

        return view('frontend.home', $data);
    }

    public function profil()
    {
        $profil = ProfilDesa::first();
        return view('frontend.profil', compact('profil'));
    }

    public function galeri()
    {
        $galeri = Galeri::where('tipe', 'foto')
                    ->latest()
                    ->paginate(12);

        $album = Galeri::select('album')
                    ->whereNotNull('album')
                    ->distinct()
                    ->pluck('album');

        return view('frontend.galeri', compact('galeri', 'album'));
    }

    public function potensi()
    {
        $potensi = Potensi::orderBy('urutan')->get();
        return view('frontend.potensi', compact('potensi'));
    }

    public function statistik()
    {
        $penduduk   = Statistik::where('kategori', 'penduduk')->orderBy('urutan')->get();
        $agama      = Statistik::where('kategori', 'agama')->orderBy('urutan')->get();
        $pekerjaan  = Statistik::where('kategori', 'pekerjaan')->orderBy('urutan')->get();
        $pendidikan = Statistik::where('kategori', 'pendidikan')->orderBy('urutan')->get();

        return view('frontend.statistik', compact('penduduk', 'agama', 'pekerjaan', 'pendidikan'));
    }

    public function perangkat()
    {
        $perangkat = PerangkatDesa::where('aktif', true)->orderBy('urutan')->get();
        return view('frontend.perangkat', compact('perangkat'));
    }

    public function peta()
    {
        return view('frontend.peta');
    }
}