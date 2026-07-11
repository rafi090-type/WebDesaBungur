@extends('layouts.admin')
@section('title', 'Pengaturan')
@section('page-title', 'Pengaturan Website')

@section('content')

<form action="{{ route('admin.setting.update') }}" method="POST">
    @csrf @method('PUT')

    <div class="row g-4">
        <div class="col-lg-8">

            {{-- Info Website --}}
            <div class="card border-0 shadow-sm mb-4" style="border-radius:12px;">
                <div class="card-header bg-white border-0 pt-3 pb-0">
                    <h6 class="fw-bold mb-0">🌐 Informasi Website</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size:13px;">Nama Website</label>
                        <input type="text" name="nama_website"
                               value="{{ old('nama_website', $settings['nama_website'] ?? '') }}"
                               class="form-control @error('nama_website') is-invalid @enderror"
                               placeholder="Website Desa Bungur">
                        @error('nama_website')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-bold" style="font-size:13px;">Deskripsi Meta (SEO)</label>
                        <textarea name="deskripsi_meta" rows="2" class="form-control"
                                  placeholder="Deskripsi singkat untuk mesin pencari...">{{ old('deskripsi_meta', $settings['deskripsi_meta'] ?? '') }}</textarea>
                        <small class="text-muted">Maks 200 karakter. Muncul di hasil pencarian Google.</small>
                    </div>
                </div>
            </div>

            {{-- Kontak --}}
            <div class="card border-0 shadow-sm mb-4" style="border-radius:12px;">
                <div class="card-header bg-white border-0 pt-3 pb-0">
                    <h6 class="fw-bold mb-0">📞 Kontak Desa</h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size:13px;">No. WhatsApp / Telepon</label>
                            <input type="text" name="telepon"
                                   value="{{ old('telepon', $settings['telepon'] ?? '') }}"
                                   class="form-control" placeholder="+62 812-XXXX-XXXX">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size:13px;">Email</label>
                            <input type="email" name="email"
                                   value="{{ old('email', $settings['email'] ?? '') }}"
                                   class="form-control" placeholder="desa@gmail.com">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Media Sosial --}}
            <div class="card border-0 shadow-sm mb-4" style="border-radius:12px;">
                <div class="card-header bg-white border-0 pt-3 pb-0">
                    <h6 class="fw-bold mb-0">📱 Media Sosial</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size:13px;">
                            <i class="fab fa-facebook me-1" style="color:#1877f2;"></i> Facebook
                        </label>
                        <input type="text" name="facebook"
                               value="{{ old('facebook', $settings['facebook'] ?? '') }}"
                               class="form-control" placeholder="https://facebook.com/desabungur">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size:13px;">
                            <i class="fab fa-instagram me-1" style="color:#e1306c;"></i> Instagram
                        </label>
                        <input type="text" name="instagram"
                               value="{{ old('instagram', $settings['instagram'] ?? '') }}"
                               class="form-control" placeholder="https://instagram.com/desabungur">
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-bold" style="font-size:13px;">
                            <i class="fab fa-youtube me-1" style="color:#ff0000;"></i> YouTube
                        </label>
                        <input type="text" name="youtube"
                               value="{{ old('youtube', $settings['youtube'] ?? '') }}"
                               class="form-control" placeholder="https://youtube.com/@desabungur">
                    </div>
                </div>
            </div>

            {{-- Google Maps --}}
            <div class="card border-0 shadow-sm mb-4" style="border-radius:12px;">
                <div class="card-header bg-white border-0 pt-3 pb-0">
                    <h6 class="fw-bold mb-0">🗺️ Google Maps Embed</h6>
                </div>
                <div class="card-body">
                    <textarea name="maps_embed" rows="4" class="form-control"
                              placeholder='<iframe src="https://www.google.com/maps/embed?..." ...></iframe>'>{{ old('maps_embed', $settings['maps_embed'] ?? '') }}</textarea>
                    <small class="text-muted">
                        Buka Google Maps → Cari lokasi desa → Share → Embed a map → Salin kode iframe
                    </small>
                </div>
            </div>

        </div>

        {{-- Kolom Kanan --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm" style="border-radius:12px;position:sticky;top:80px;">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">💡 Panduan</h6>
                    <p style="font-size:13px;color:#6c757d;line-height:1.7;">
                        Pengaturan ini mempengaruhi tampilan seluruh website, termasuk nama di browser,
                        deskripsi di Google, dan link media sosial di footer.
                    </p>
                    <hr>
                    <button type="submit"
                            style="background:#1a4731;color:#fff;border:none;padding:12px;
                                   border-radius:8px;font-weight:700;font-size:14px;width:100%;">
                        <i class="fas fa-save me-2"></i> Simpan Pengaturan
                    </button>
                </div>
            </div>
        </div>
    </div>

</form>

@endsection