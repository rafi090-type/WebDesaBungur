<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Setting;

class SettingSeeder extends Seeder

{

    public function run(): void

    {

        $settings = [

            ['key' => 'nama_website',   'value' => 'Website Desa Bungur'],

            ['key' => 'deskripsi_meta', 'value' => 'Website resmi Desa Bungur, Kec. Rangsang Pesisir, Kab. Kepulauan Meranti'],

            ['key' => 'telepon',        'value' => '+62 812-XXXX-XXXX'],

            ['key' => 'email',          'value' => 'desabungur@gmail.com'],

            ['key' => 'facebook',       'value' => ''],

            ['key' => 'instagram',      'value' => ''],

            ['key' => 'youtube',        'value' => ''],

            ['key' => 'maps_embed',     'value' => ''],

        ];

        foreach ($settings as $s) {

            Setting::create($s);

        }

    }

}
