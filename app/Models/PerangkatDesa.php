<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerangkatDesa extends Model

{

    protected $table = 'perangkat_desa';

    protected $fillable = [

        'nama', 'jabatan', 'foto', 'no_hp', 'urutan', 'aktif',

    ];

    protected $casts = [

        'aktif' => 'boolean',

    ];

}

