<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Potensi extends Model

{
    protected $table = 'potensi';

    protected $fillable = [

        'judul', 'slug', 'kategori', 'deskripsi', 'foto', 'urutan', 'tampil_home',

    ];

    protected $casts = [

        'tampil_home' => 'boolean',

    ];

}
