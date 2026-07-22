<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
        // Ambil semua setting, jadikan array key => value
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.setting.edit', compact('settings'));
    }

    public function index()
    {
        // Ambil semua setting, jadikan array key => value
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.setting.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_website'   => 'required|string|max:100',
            'deskripsi_meta' => 'nullable|string|max:200',
            'telepon'        => 'nullable|string|max:20',
            'email'          => 'nullable|email|max:100',
            'facebook'       => 'nullable|string|max:200',
            'instagram'      => 'nullable|string|max:200',
            'youtube'        => 'nullable|string|max:200',
            'maps_embed'     => 'nullable|string',
        ]);

        $keys = [
            'nama_website', 'deskripsi_meta', 'telepon',
            'email', 'facebook', 'instagram', 'youtube', 'maps_embed',
        ];

        foreach ($keys as $key) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $request->input($key)]
            );
        }

        return redirect()->route('admin.setting.edit')
                         ->with('success', 'Pengaturan berhasil disimpan!');
    }
}