<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model

{

    protected $fillable = ['key', 'value'];

    // Helper: ambil value berdasarkan key

    public static function get(string $key, $default = null)

    {

        $setting = static::where('key', $key)->first();

        return $setting ? $setting->value : $default;

    }

}
