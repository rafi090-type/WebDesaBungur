<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Download extends Model

{

    protected $fillable = [

        'judul', 'file', 'kategori', 'keterangan', 'unduhan',

    ];

}
