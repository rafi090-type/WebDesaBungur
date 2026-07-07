@extends('layouts.frontend')

@section('title', 'Profil Desa')

@section('content')

<div class="page-header">
    <div class="container">
        <h1>Profil Desa Bungur</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Profil Desa</li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">

                {{-- Sejarah --}}
                <div class="mb-5">
                    <div class="section-eyebrow">Sejarah</div>
                    <h2 class="section-title">Sejarah <span>Desa Bungur</span></h2>
                    <div class="divider-emas"></div>
                    <div style="font-size:15px;line-height:1.85;color:#444;">
                        {!! $profil->sejarah ?? '<p class="text-muted">Sejarah desa belum diisi. Silakan update melalui panel admin.</p>' !!}
                    </div>
                </div>

                {{-- Visi Misi --}}
                <div class="mb-5">
                    <div class="section-eyebrow">Visi & Misi</div>
                    <h2 class="section-title">Visi & <span>Misi</span></h2>
                    <div class="divider-emas"></div>

                    @if($profil && $profil->visi)
                    <div style="background:#f0f7f3;border-left:4px solid #2d7a50;
                                padding:20px 24px;border-radius:0 10px 10px 0;margin-bottom:20px;">
                        <h5 style="color:#1a4731;font-weight:700;margin-bottom:8px;">Visi</h5>
                        <p class="mb-0" style="font-size:15px;color:#444;">{{ $profil->visi }}</p>
                    </div>
                    @endif

                    @if($profil && $profil->misi)
                    <div style="background:#fff8e8;border-left:4px solid #c8a84b;
                                padding:20px 24px;border-radius:0 10px 10px 0;">
                        <h5 style="color:#8a6a00;font-weight:700;margin-bottom:8px;">Misi</h5>
                        <div style="font-size:15px;color:#444;white-space:pre-line;">{{ $profil->misi }}</div>
                    </div>
                    @endif
                </div>

            </div>

            {{-- Sidebar Info Desa --}}
            <div class="col-lg-4">
                <div style="background:#fff;border-radius:14px;padding:24px;
                             box-shadow:0 4px 20px rgba(0,0,0,.08);position:sticky;top:80px;">
                    @if($profil && $profil->foto_kades)
                        <img src="{{ asset('storage/'.$profil->foto_kades) }}"
                             style="width:100%;border-radius:10px;margin-bottom:16px;" alt="Kepala Desa">
                    @endif
                    <h5 style="font-weight:700;color:#1a4731;font-size:15px;margin-bottom:4px;">
                        {{ $profil->nama_kades ?? 'Kepala Desa' }}
                    </h5>
                    <p style="font-size:12px;color:#6c7a7d;margin-bottom:20px;">Kepala Desa Bungur</p>

                    <hr>

                    <div style="font-size:13px;line-height:2;">
                        <div><i class="fas fa-map-marker-alt me-2" style="color:#2d7a50;width:16px;"></i>
                            {{ $profil->alamat ?? 'Desa Bungur, Kec. Rangsang Pesisir' }}
                        </div>
                        @if($profil && $profil->telepon)
                        <div><i class="fas fa-phone me-2" style="color:#2d7a50;width:16px;"></i>
                            {{ $profil->telepon }}
                        </div>
                        @endif
                        @if($profil && $profil->email)
                        <div><i class="fas fa-envelope me-2" style="color:#2d7a50;width:16px;"></i>
                            {{ $profil->email }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection