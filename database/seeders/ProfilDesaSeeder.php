<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\ProfilDesa;

class ProfilDesaSeeder extends Seeder

{

    public function run(): void

    {

        ProfilDesa::create([

            'nama_desa'  => 'Desa Bungur',

            'kecamatan'  => 'Rangsang Pesisir',

            'kabupaten'  => 'Kepulauan Meranti',

            'provinsi'   => 'Riau',

            'kode_pos'   => '28772',

            'nama_kades' => 'Nama Kepala Desa',

            'visi'       => 'Terwujudnya Desa Bungur yang maju, mandiri, dan sejahtera.',

            'misi'       => "1. Meningkatkan kualitas pelayanan publik.\n2. Mengembangkan potensi ekonomi lokal.\n3. Meningkatkan kualitas pendidikan dan kesehatan.",

            'alamat'     => 'Desa Bungur, Kecamatan Rangsang Pesisir, Kabupaten Kepulauan Meranti, Riau',

        ]);

    }

}
