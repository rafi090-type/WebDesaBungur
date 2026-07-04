<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\KategoriBerita;

class KategoriBeritaSeeder extends Seeder

{

    public function run(): void

    {

        $kategori = [

            ['nama' => 'Pembangunan',  'slug' => 'pembangunan'],

            ['nama' => 'Ekonomi',      'slug' => 'ekonomi'],

            ['nama' => 'Kesehatan',    'slug' => 'kesehatan'],

            ['nama' => 'Pendidikan',   'slug' => 'pendidikan'],

            ['nama' => 'Pemerintahan', 'slug' => 'pemerintahan'],

            ['nama' => 'Kegiatan',     'slug' => 'kegiatan'],

        ];

        foreach ($kategori as $k) {

            KategoriBerita::create($k);

        }

    }

}
