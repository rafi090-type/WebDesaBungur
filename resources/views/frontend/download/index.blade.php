@extends('layouts.frontend')
@section('title', 'Download Dokumen')

@section('content')

<div class="page-header">
    <div class="container">
        <h1>Download Dokumen</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Download</li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-5">
    <div class="container">
        <div class="row g-4">
            @forelse($downloads as $d)
            @php
                $ext = pathinfo($d->file, PATHINFO_EXTENSION);
                $ikonMap = [
                    'pdf'  => ['fas fa-file-pdf',  '#e53935'],
                    'doc'  => ['fas fa-file-word',  '#1565c0'],
                    'docx' => ['fas fa-file-word',  '#1565c0'],
                    'xls'  => ['fas fa-file-excel', '#2e7d32'],
                    'xlsx' => ['fas fa-file-excel', '#2e7d32'],
                    'zip'  => ['fas fa-file-archive','#f57f17'],
                ];
                $ikon  = $ikonMap[$ext] ?? ['fas fa-file', '#888'];
            @endphp
            <div class="col-md-4">
                <a href="{{ route('download.file', $d->id) }}" style="text-decoration:none;">
                    <div class="card border-0 h-100"
                         style="border-radius:14px;box-shadow:0 4px 18px rgba(0,0,0,.07);transition:transform .2s;"
                         onmouseover="this.style.transform='translateY(-4px)'"
                         onmouseout="this.style.transform=''">
                        <div class="card-body p-4">
                            <div style="width:60px;height:60px;border-radius:12px;
                                        background:{{ $ikon[1] }}20;
                                        display:flex;align-items:center;justify-content:center;margin-bottom:16px;">
                                <i class="{{ $ikon[0] }}" style="color:{{ $ikon[1] }};font-size:28px;"></i>
                            </div>
                            <span style="background:#e8f5e9;color:#2d7a50;font-size:10px;font-weight:700;
                                         padding:2px 8px;border-radius:20px;text-transform:uppercase;
                                         margin-bottom:8px;display:inline-block;">
                                {{ $d->kategori }}
                            </span>
                            <h6 class="fw-bold text-dark" style="font-size:15px;line-height:1.4;">
                                {{ Str::limit($d->judul, 60) }}
                            </h6>
                            @if($d->keterangan)
                            <p class="text-muted" style="font-size:13px;line-height:1.5;">
                                {{ Str::limit($d->keterangan, 80) }}
                            </p>
                            @endif
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <small class="text-muted">
                                    <i class="fas fa-download me-1"></i>
                                    {{ number_format($d->unduhan) }}x
                                </small>
                                <small class="text-muted">
                                    {{ strtoupper($ext) }} •
                                    {{ number_format(Storage::disk('public')->size($d->file) / 1024, 0) }} KB
                                </small>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-12 text-center text-muted py-5">
                <i class="fas fa-folder-open fa-3x mb-3 d-block" style="color:#ccc;"></i>
                Belum ada dokumen yang tersedia untuk diunduh.
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-5">
            {{ $downloads->links() }}
        </div>
    </div>
</section>

@endsection
