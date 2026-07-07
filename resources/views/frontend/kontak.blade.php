@extends('layouts.frontend')

@section('title', 'Kontak')

@section('content')

<div class="page-header">
    <div class="container">
        <h1>Hubungi Kami</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Kontak</li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-5">
    <div class="container">
        <div class="row g-5">

            {{-- Info Kontak --}}
            <div class="col-lg-4">
                <div class="section-eyebrow">Informasi</div>
                <h2 class="section-title">Kontak <span>Desa</span></h2>
                <div class="divider-emas"></div>

                @foreach([
                    ['fas fa-map-marker-alt', 'Alamat', 'Desa Bungur, Kec. Rangsang Pesisir, Kab. Kepulauan Meranti, Riau 28772'],
                    ['fas fa-phone', 'Telepon', '+62 812-XXXX-XXXX'],
                    ['fas fa-clock', 'Jam Pelayanan', 'Senin – Jumat: 08.00 – 16.00 WIB'],
                ] as [$icon, $label, $value])
                <div style="display:flex;gap:14px;margin-bottom:24px;">
                    <div style="width:42px;height:42px;border-radius:10px;background:#e8f5e9;
                                display:flex;align-items:center;justify-content:center;
                                color:#2d7a50;font-size:16px;flex-shrink:0;">
                        <i class="{{ $icon }}"></i>
                    </div>
                    <div>
                        <div style="font-size:11px;color:#aaa;text-transform:uppercase;letter-spacing:1px;">{{ $label }}</div>
                        <div style="font-size:14px;font-weight:500;margin-top:2px;">{{ $value }}</div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Form Kontak --}}
            <div class="col-lg-8">
                <div style="background:#fff;border-radius:16px;padding:36px;box-shadow:0 4px 20px rgba(0,0,0,.08);">
                    <h4 style="font-weight:700;color:#1a4731;margin-bottom:24px;">Kirim Pesan ke Desa</h4>

                    <form action="{{ route('kontak.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-600" style="font-size:13px;">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="nama" value="{{ old('nama') }}"
                                    class="form-control @error('nama') is-invalid @enderror"
                                    placeholder="Nama kamu...">
                                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-600" style="font-size:13px;">No. WhatsApp</label>
                                <input type="text" name="no_hp" value="{{ old('no_hp') }}"
                                    class="form-control" placeholder="08xx...">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-600" style="font-size:13px;">Perihal <span class="text-danger">*</span></label>
                                <input type="text" name="perihal" value="{{ old('perihal') }}"
                                    class="form-control @error('perihal') is-invalid @enderror"
                                    placeholder="Topik pesan...">
                                @error('perihal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-600" style="font-size:13px;">Pesan <span class="text-danger">*</span></label>
                                <textarea name="pesan" rows="5"
                                    class="form-control @error('pesan') is-invalid @enderror"
                                    placeholder="Tulis pesan kamu...">{{ old('pesan') }}</textarea>
                                @error('pesan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <button type="submit"
                                    style="background:#1a4731;color:#fff;border:none;padding:12px 32px;
                                           border-radius:8px;font-weight:700;font-size:14px;cursor:pointer;">
                                    <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection