<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kontak extends Model

{

    protected $fillable = [

        'nama', 'no_hp', 'perihal', 'pesan', 'sudah_dibaca',

    ];

    protected $casts = [

        'sudah_dibaca' => 'boolean',

    ];

}
