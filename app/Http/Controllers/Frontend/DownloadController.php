<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Download;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function index()
    {
        $downloads = Download::latest()->paginate(10);
        return view('frontend.download.index', compact('downloads'));
    }

    public function download(Download $download)
    {
        // Increment download counter
        $download->increment('unduhan');

        // Return file download
        $filePath = storage_path('app/public/' . $download->file);
        $fileName = $download->judul . '.' . pathinfo($download->file, PATHINFO_EXTENSION);
        
        return response()->download($filePath, $fileName);
    }
}
