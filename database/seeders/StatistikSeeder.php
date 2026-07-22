<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Statistik;

class StatistikSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // Penduduk berdasarkan jenis kelamin
            ['kategori' => 'penduduk', 'label' => 'Laki-laki',  'jumlah' => 1245, 'urutan' => 1],
            ['kategori' => 'penduduk', 'label' => 'Perempuan',   'jumlah' => 1186, 'urutan' => 2],

            // Agama
            ['kategori' => 'agama', 'label' => 'Islam',     'jumlah' => 2380, 'urutan' => 1],
            ['kategori' => 'agama', 'label' => 'Kristen',   'jumlah' => 42,   'urutan' => 2],
            ['kategori' => 'agama', 'label' => 'Lainnya',   'jumlah' => 9,    'urutan' => 3],

            // Pekerjaan
            ['kategori' => 'pekerjaan', 'label' => 'Nelayan',   'jumlah' => 320, 'urutan' => 1],
            ['kategori' => 'pekerjaan', 'label' => 'Petani',    'jumlah' => 215, 'urutan' => 2],
            ['kategori' => 'pekerjaan', 'label' => 'Pedagang',  'jumlah' => 148, 'urutan' => 3],
            ['kategori' => 'pekerjaan', 'label' => 'PNS/TNI',   'jumlah' => 42,  'urutan' => 4],
            ['kategori' => 'pekerjaan', 'label' => 'Lainnya',   'jumlah' => 706, 'urutan' => 5],

            // Pendidikan
            ['kategori' => 'pendidikan', 'label' => 'Tidak Sekolah', 'jumlah' => 120, 'urutan' => 1],
            ['kategori' => 'pendidikan', 'label' => 'SD',            'jumlah' => 680, 'urutan' => 2],
            ['kategori' => 'pendidikan', 'label' => 'SMP',           'jumlah' => 520, 'urutan' => 3],
            ['kategori' => 'pendidikan', 'label' => 'SMA',           'jumlah' => 810, 'urutan' => 4],
            ['kategori' => 'pendidikan', 'label' => 'D3/S1+',        'jumlah' => 301, 'urutan' => 5],
        ];

        foreach ($data as $d) {
            Statistik::create($d);
        }
    }
}