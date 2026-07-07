@extends('layouts.frontend')
@section('title', 'Berita Desa')

@section('content')

<div class="page-header">
    <div class="container">
        <h1>Berita Desa Bungur</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Berita</li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-5">
    <div class="container">
        <div class="row g-4">
            @forelse($berita as $b)
            <div class="col-md-4">
                <a href="{{ route('berita.show', $b->slug) }}" style="text-decoration:none;">
                    <div class="card border-0 h-100"
                         style="border-radius:14px;box-shadow:0 4px 18px rgba(0,0,0,.07);transition:transform .2s;"
                         onmouseover="this.style.transform='translateY(-4px)'"
                         onmouseout="this.style.transform=''">
                        <div style="height:180px;border-radius:14px 14px 0 0;overflow:hidden;
                                    background:#e8f5e9;display:flex;align-items:center;justify-content:center;">
                            @if($b->thumbnail)
                                <img src="{{ asset('storage/'.$b->thumbnail) }}"
                                     style="width:100%;height:100%;object-fit:cover;" alt="{{ $b->judul }}">
                            @else
                                <span style="font-size:3rem;">📰</span>
                            @endif
                        </div>
                        <div class="card-body p-3">
                            <span style="background:#e8f5e9;color:#2d7a50;font-size:10px;font-weight:700;
                                         padding:2px 8px;border-radius:20px;text-transform:uppercase;
                                         margin-bottom:8px;display:inline-block;">
                                {{ $b->kategori->nama ?? 'Umum' }}
                            </span>
                            <h6 class="fw-bold text-dark" style="font-size:14px;line-height:1.45;">
                                {{ Str::limit($b->judul, 70) }}
                            </h6>
                            @if($b->ringkasan)
                            <p class="text-muted" style="font-size:13px;line-height:1.6;">
                                {{ Str::limit($b->ringkasan, 90) }}
                            </p>
                            @endif
                            <small class="text-muted">
                                <i class="far fa-calendar me-1"></i>
                                {{ $b->published_at ? $b->published_at->format('d M Y') : $b->created_at->format('d M Y') }}
                                <i class="fas fa-eye ms-2 me-1"></i>{{ $b->views }}
                            </small>
                        </div>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-12 text-center text-muted py-5">
                <i class="fas fa-newspaper fa-3x mb-3 d-block" style="color:#ccc;"></i>
                Belum ada berita yang dipublikasikan.
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-5">
            {{ $berita->links() }}
        </div>
    </div>
</section>

@endsection