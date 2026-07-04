<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilDesa extends Model

{

    protected $table = 'profil_desa';

    protected $fillable = [

        'nama_desa', 'kecamatan', 'kabupaten', 'provinsi', 'kode_pos',

        'sejarah', 'visi', 'misi', 'sambutan_kades', 'foto_kades',

        'nama_kades', 'logo', 'telepon', 'email', 'alamat',

    ];

}
