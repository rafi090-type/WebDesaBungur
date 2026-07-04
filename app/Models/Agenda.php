<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model

{

    protected $fillable = [

        'judul', 'deskripsi', 'tanggal', 'jam_mulai', 'jam_selesai', 'lokasi',

    ];

    protected $casts = [

        'tanggal' => 'date',

    ];

}
