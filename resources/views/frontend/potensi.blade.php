@extends('layouts.frontend')

@section('title', 'Potensi Desa')

@section('content')

<div class="page-header">
    <div class="container">
        <h1>Potensi Desa</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Potensi Desa</li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-5">
    <div class="container">
        @if($potensi->count() > 0)
            <div class="row g-4">
                @foreach($potensi as $item)
                    <div class="col-lg-4 col-md-6">
                        <div style="background:#fff;border-radius:14px;overflow:hidden;
                                     box-shadow:0 4px 20px rgba(0,0,0,.08);height:100%;">
                            @if($item->gambar)
                                <img src="{{ asset('storage/'.$item->gambar) }}"
                                     style="width:100%;height:200px;object-fit:cover;" alt="{{ $item->judul }}">
                            @else
                                <div style="width:100%;height:200px;background:#f0f7f3;
                                            display:flex;align-items:center;justify-content:center;">
                                    <i class="fas fa-image" style="font-size:48px;color:#2d7a50;"></i>
                                </div>
                            @endif
                            <div style="padding:24px;">
                                <h5 style="font-weight:700;color:#1a4731;margin-bottom:12px;">
                                    {{ $item->judul }}
                                </h5>
                                <div style="font-size:14px;color:#555;line-height:1.7;">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($item->deskripsi), 150) }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-seedling" style="font-size:64px;color:#ccc;margin-bottom:20px;"></i>
                <h4 style="color:#666;">Belum ada potensi desa</h4>
                <p class="text-muted">Silakan tambahkan data potensi melalui panel admin.</p>
            </div>
        @endif
    </div>
</section>

@endsection
