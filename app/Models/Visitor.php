<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model

{

    protected $fillable = ['tanggal', 'jumlah'];

    protected $casts = [

        'tanggal' => 'date',

    ];

}
