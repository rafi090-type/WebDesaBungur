<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model

{

    protected $fillable = [

        'kategori_id', 'user_id', 'judul', 'slug', 'ringkasan',

        'isi', 'thumbnail', 'status', 'views', 'published_at',

    ];

    protected $casts = [

        'published_at' => 'datetime',

    ];

    public function kategori()

    {

        return $this->belongsTo(KategoriBerita::class, 'kategori_id');

    }

    public function penulis()

    {

        return $this->belongsTo(User::class, 'user_id');

    }

}
