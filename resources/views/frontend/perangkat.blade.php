@extends('layouts.frontend')

@section('title', 'Perangkat Desa')

@section('content')

<div class="page-header">
    <div class="container">
        <h1>Perangkat Desa Bungur</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Perangkat Desa</li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-5">
    <div class="container">
        @if($perangkat->count() > 0)
            <div class="row g-4">
                @foreach($perangkat as $item)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div style="background:#fff;border-radius:14px;overflow:hidden;
                                     box-shadow:0 4px 20px rgba(0,0,0,.08);text-align:center;">
                            @if($item->foto)
                                <img src="{{ asset('storage/'.$item->foto) }}"
                                     style="width:100%;height:220px;object-fit:cover;" alt="{{ $item->nama }}">
                            @else
                                <div style="width:100%;height:220px;background:#f0f7f3;
                                            display:flex;align-items:center;justify-content:center;">
                                    <i class="fas fa-user-tie" style="font-size:64px;color:#2d7a50;"></i>
                                </div>
                            @endif
                            <div style="padding:24px;">
                                <h5 style="font-weight:700;color:#1a4731;margin-bottom:8px;font-size:16px;">
                                    {{ $item->nama }}
                                </h5>
                                <div style="font-size:13px;color:#2d7a50;font-weight:600;margin-bottom:12px;">
                                    {{ $item->jabatan }}
                                </div>
                                @if($item->no_hp)
                                <div style="font-size:12px;color:#666;">
                                    <i class="fas fa-phone me-1" style="color:#c8a84b;"></i>
                                    {{ $item->no_hp }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-users-cog" style="font-size:64px;color:#ccc;margin-bottom:20px;"></i>
                <h4 style="color:#666;">Belum ada data perangkat desa</h4>
                <p class="text-muted">Silakan tambahkan data perangkat desa melalui panel admin.</p>
            </div>
        @endif
    </div>
</section>

@endsection
