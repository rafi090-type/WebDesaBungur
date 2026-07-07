@extends('layouts.frontend')
@section('title', $berita->judul)

@section('content')

<div class="page-header">
    <div class="container">
        <h1 style="font-size:1.5rem;">{{ Str::limit($berita->judul, 70) }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('berita.index') }}">Berita</a></li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <span style="background:#e8f5e9;color:#2d7a50;font-size:12px;font-weight:700;
                             padding:3px 12px;border-radius:20px;">
                    {{ $berita->kategori->nama ?? 'Umum' }}
                </span>
                <h1 style="font-size:1.6rem;font-weight:800;margin:12px 0 8px;">{{ $berita->judul }}</h1>
                <div style="font-size:13px;color:#aaa;margin-bottom:24px;">
                    <i class="far fa-calendar me-1"></i>
                    {{ $berita->published_at ? $berita->published_at->format('d F Y') : $berita->created_at->format('d F Y') }}
                    <i class="fas fa-user ms-3 me-1"></i>{{ $berita->penulis->name ?? 'Admin' }}
                    <i class="fas fa-eye ms-3 me-1"></i>{{ $berita->views }} kali dilihat
                </div>

                @if($berita->thumbnail)
                <img src="{{ asset('storage/'.$berita->thumbnail) }}"
                     style="width:100%;border-radius:12px;margin-bottom:28px;max-height:400px;object-fit:cover;"
                     alt="{{ $berita->judul }}">
                @endif

                <div style="font-size:15px;line-height:1.85;color:#333;">
                    {!! $berita->isi !!}
                </div>
            </div>

            {{-- Sidebar Berita Lain --}}
            <div class="col-lg-4">
                <h5 style="font-weight:700;color:#1a4731;margin-bottom:16px;">Berita Lainnya</h5>
                @foreach($berita_lain as $bl)
                <a href="{{ route('berita.show', $bl->slug) }}" style="text-decoration:none;">
                    <div style="display:flex;gap:12px;margin-bottom:16px;padding-bottom:16px;border-bottom:1px solid #f0f0f0;">
                        <div style="width:70px;height:70px;border-radius:8px;overflow:hidden;
                                    background:#e8f5e9;flex-shrink:0;display:flex;align-items:center;justify-content:center;">
                            @if($bl->thumbnail)
                                <img src="{{ asset('storage/'.$bl->thumbnail) }}"
                                     style="width:100%;height:100%;object-fit:cover;" alt="">
                            @else
                                <span style="font-size:1.5rem;">📰</span>
                            @endif
                        </div>
                        <div>
                            <p style="font-size:13px;font-weight:600;color:#333;margin-bottom:4px;line-height:1.4;">
                                {{ Str::limit($bl->judul, 55) }}
                            </p>
                            <small style="color:#aaa;">{{ $bl->created_at->format('d M Y') }}</small>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</section>

@endsection