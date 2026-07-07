@extends('layouts.frontend')

@section('title', 'Beranda')

@section('content')

{{-- HERO --}}
<section style="background:linear-gradient(135deg,#1a4731 0%,#2d7a50 60%,#4caf82 100%);
                min-height:88vh; display:flex; align-items:center; position:relative;">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <span style="display:inline-block;background:rgba(200,168,75,.2);
                    border:1px solid #c8a84b;color:#f0d98a;font-size:12px;font-weight:700;
                    letter-spacing:1.5px;text-transform:uppercase;padding:5px 14px;
                    border-radius:20px;margin-bottom:20px;">
                    🌿 Desa Pesisir Kepulauan Meranti
                </span>
                <h1 style="font-size:clamp(2rem,5vw,3.2rem);font-weight:800;color:#fff;line-height:1.15;margin-bottom:16px;">
                    Selamat Datang di<br>
                    <span style="color:#c8a84b;">Desa Bungur</span>
                </h1>
                <p style="color:rgba(255,255,255,.8);font-size:16px;line-height:1.75;max-width:540px;margin-bottom:32px;">
                    Desa pesisir yang kaya potensi — dari perikanan tradisional, hasil perkebunan,
                    hingga UMKM lokal yang terus berkembang bersama masyarakat.
                </p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('profil') }}"
                       style="background:#c8a84b;color:#1a4731;font-weight:700;padding:12px 28px;
                              border-radius:8px;text-decoration:none;font-size:14px;">
                        <i class="fas fa-compass me-2"></i>Jelajahi Desa
                    </a>
                    <a href="{{ route('berita.index') }}"
                       style="border:1.5px solid rgba(255,255,255,.5);color:#fff;padding:12px 28px;
                              border-radius:8px;text-decoration:none;font-size:14px;">
                        <i class="fas fa-newspaper me-2"></i>Berita Terkini
                    </a>
                </div>
                <div class="d-flex gap-4 mt-4">
                    @if($profil)
                    <div>
                        <div style="font-size:1.8rem;font-weight:800;color:#c8a84b;line-height:1;">2.4K+</div>
                        <div style="font-size:11px;color:rgba(255,255,255,.6);">Penduduk</div>
                    </div>
                    @endif
                    <div>
                        <div style="font-size:1.8rem;font-weight:800;color:#c8a84b;line-height:1;">4</div>
                        <div style="font-size:11px;color:rgba(255,255,255,.6);">Dusun</div>
                    </div>
                    <div>
                        <div style="font-size:1.8rem;font-weight:800;color:#c8a84b;line-height:1;">120+</div>
                        <div style="font-size:11px;color:rgba(255,255,255,.6);">UMKM Aktif</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- POTENSI --}}
@if($potensi->count())
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <div class="section-eyebrow">Unggulan Desa</div>
            <h2 class="section-title">Potensi <span>Desa Bungur</span></h2>
            <div class="divider-emas mx-auto"></div>
        </div>
        <div class="row g-4">
            @foreach($potensi as $p)
            <div class="col-6 col-md-3">
                <div class="card border-0 h-100" style="border-radius:14px;box-shadow:0 4px 20px rgba(0,0,0,.07);transition:transform .25s;"
                     onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform=''">
                    <div style="height:140px;display:flex;align-items:center;justify-content:center;
                                font-size:3rem;background:linear-gradient(135deg,#e8f5e9,#c8e6c9);
                                border-radius:14px 14px 0 0;">
                        @switch($p->kategori)
                            @case('perikanan') 🐟 @break
                            @case('pertanian') 🌴 @break
                            @case('umkm')      🛒 @break
                            @case('wisata')    🌅 @break
                            @default           🌿
                        @endswitch
                    </div>
                    <div class="card-body p-3">
                        <span style="background:#e8f5e9;color:#2d7a50;font-size:11px;font-weight:700;
                                     padding:2px 10px;border-radius:20px;display:inline-block;margin-bottom:8px;">
                            {{ ucfirst($p->kategori) }}
                        </span>
                        <h6 class="fw-bold mb-1" style="font-size:14px;">{{ $p->judul }}</h6>
                        <p class="text-muted mb-0" style="font-size:12px;line-height:1.6;">
                            {{ Str::limit($p->deskripsi, 80) }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('potensi') }}" class="btn btn-outline-success">
                Lihat Semua Potensi <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
</section>
@endif

{{-- BERITA --}}
<section class="py-5" style="background:#f0f7f3;">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <div class="section-eyebrow">Informasi</div>
                <h2 class="section-title mb-0">Berita <span>Terkini</span></h2>
            </div>
            <a href="{{ route('berita.index') }}" style="color:#2d7a50;font-size:13px;font-weight:600;text-decoration:none;">
                Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>
        <div class="row g-4">
            @forelse($berita as $b)
            <div class="col-md-4">
                <a href="{{ route('berita.show', $b->slug) }}" style="text-decoration:none;">
                    <div class="card border-0 h-100" style="border-radius:14px;box-shadow:0 4px 18px rgba(0,0,0,.06);transition:transform .2s;"
                         onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform=''">
                        <div style="height:160px;border-radius:14px 14px 0 0;overflow:hidden;background:#e8f5e9;
                                    display:flex;align-items:center;justify-content:center;">
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
                                         letter-spacing:.5px;margin-bottom:8px;display:inline-block;">
                                {{ $b->kategori->nama ?? 'Umum' }}
                            </span>
                            <h6 class="fw-bold text-dark" style="font-size:14px;line-height:1.45;">
                                {{ Str::limit($b->judul, 70) }}
                            </h6>
                            <small class="text-muted">
                                <i class="far fa-calendar me-1"></i>
                                {{ $b->published_at ? $b->published_at->format('d M Y') : $b->created_at->format('d M Y') }}
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
    </div>
</section>

{{-- AGENDA --}}
@if($agenda->count())
<section class="py-5">
    <div class="container">
        <div class="row g-5 align-items-start">
            <div class="col-lg-6">
                <div class="section-eyebrow">Kegiatan</div>
                <h2 class="section-title">Agenda <span>Desa</span></h2>
                <div class="divider-emas"></div>
                @foreach($agenda as $a)
                <div style="background:#fff;border-radius:12px;padding:16px 20px;margin-bottom:12px;
                             display:flex;align-items:center;gap:16px;
                             box-shadow:0 2px 10px rgba(0,0,0,.05);">
                    <div style="min-width:50px;height:50px;border-radius:10px;background:#1a4731;
                                display:flex;flex-direction:column;align-items:center;justify-content:center;color:#fff;">
                        <div style="font-size:17px;font-weight:800;line-height:1;">{{ $a->tanggal->format('d') }}</div>
                        <div style="font-size:10px;color:#f0d98a;text-transform:uppercase;">{{ $a->tanggal->format('M') }}</div>
                    </div>
                    <div>
                        <div style="font-weight:700;font-size:14px;">{{ $a->judul }}</div>
                        <div style="font-size:12px;color:#6c7a7d;">
                            <i class="fas fa-map-marker-alt me-1"></i>{{ $a->lokasi ?? 'Lokasi menyusul' }}
                            @if($a->jam_mulai) · {{ $a->jam_mulai }} WIB @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- GALERI --}}
            @if($galeri->count())
            <div class="col-lg-6">
                <div class="section-eyebrow">Dokumentasi</div>
                <h2 class="section-title">Galeri <span>Foto</span></h2>
                <div class="divider-emas"></div>
                <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:10px;">
                    @foreach($galeri as $g)
                    <div style="border-radius:10px;overflow:hidden;aspect-ratio:1;background:#e8f5e9;">
                        @if($g->file)
                            <img src="{{ asset('storage/'.$g->file) }}"
                                 style="width:100%;height:100%;object-fit:cover;" alt="{{ $g->judul }}">
                        @else
                            <div style="width:100%;height:100%;display:flex;align-items:center;
                                        justify-content:center;font-size:2rem;">🏘️</div>
                        @endif
                    </div>
                    @endforeach
                </div>
                <div class="mt-3">
                    <a href="{{ route('galeri') }}" class="btn btn-outline-success btn-sm">
                        Lihat Semua Foto <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endif

{{-- KONTAK CTA --}}
<section style="background:#1a4731;padding:60px 0;">
    <div class="container text-center">
        <h2 style="color:#fff;font-weight:800;font-size:1.8rem;margin-bottom:12px;">
            Ada Pertanyaan untuk Desa?
        </h2>
        <p style="color:rgba(255,255,255,.7);font-size:15px;margin-bottom:28px;">
            Hubungi kami melalui form kontak atau datang langsung ke kantor desa.
        </p>
        <a href="{{ route('kontak') }}"
           style="background:#c8a84b;color:#1a4731;font-weight:700;padding:13px 32px;
                  border-radius:8px;text-decoration:none;font-size:14px;">
            <i class="fas fa-envelope me-2"></i>Kirim Pesan Sekarang
        </a>
    </div>
</section>

@endsection