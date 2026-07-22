@extends('layouts.admin')
@section('title', 'Profil Desa')
@section('page-title', 'Edit Profil Desa')

@section('content')

<form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')

    <div class="row g-4">

        {{-- Kolom Kiri --}}
        <div class="col-lg-8">

            {{-- Info Dasar --}}
            <div class="card border-0 shadow-sm mb-4" style="border-radius:12px;">
                <div class="card-header bg-white border-0 pt-3 pb-0">
                    <h6 class="fw-bold mb-0">📍 Informasi Dasar</h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size:13px;">Nama Desa</label>
                            <input type="text" name="nama_desa"
                                   value="{{ old('nama_desa', $profil->nama_desa) }}"
                                   class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size:13px;">Kecamatan</label>
                            <input type="text" name="kecamatan"
                                   value="{{ old('kecamatan', $profil->kecamatan) }}"
                                   class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size:13px;">Kabupaten</label>
                            <input type="text" name="kabupaten"
                                   value="{{ old('kabupaten', $profil->kabupaten) }}"
                                   class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size:13px;">Provinsi</label>
                            <input type="text" name="provinsi"
                                   value="{{ old('provinsi', $profil->provinsi) }}"
                                   class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-bold" style="font-size:13px;">Kode Pos</label>
                            <input type="text" name="kode_pos"
                                   value="{{ old('kode_pos', $profil->kode_pos) }}"
                                   class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold" style="font-size:13px;">Alamat Lengkap</label>
                            <textarea name="alamat" rows="2"
                                      class="form-control">{{ old('alamat', $profil->alamat) }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size:13px;">Telepon</label>
                            <input type="text" name="telepon"
                                   value="{{ old('telepon', $profil->telepon) }}"
                                   class="form-control" placeholder="+62 812-XXXX-XXXX">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size:13px;">Email</label>
                            <input type="email" name="email"
                                   value="{{ old('email', $profil->email) }}"
                                   class="form-control" placeholder="desa@gmail.com">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Visi & Misi --}}
            <div class="card border-0 shadow-sm mb-4" style="border-radius:12px;">
                <div class="card-header bg-white border-0 pt-3 pb-0">
                    <h6 class="fw-bold mb-0">🎯 Visi & Misi</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size:13px;">Visi Desa</label>
                        <textarea name="visi" rows="3"
                                  class="form-control"
                                  placeholder="Visi desa...">{{ old('visi', $profil->visi) }}</textarea>
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-bold" style="font-size:13px;">Misi Desa</label>
                        <textarea name="misi" rows="5"
                                  class="form-control"
                                  placeholder="Tulis misi desa, tiap poin di baris baru...">{{ old('misi', $profil->misi) }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Sejarah --}}
            <div class="card border-0 shadow-sm mb-4" style="border-radius:12px;">
                <div class="card-header bg-white border-0 pt-3 pb-0">
                    <h6 class="fw-bold mb-0">📜 Sejarah Desa</h6>
                </div>
                <div class="card-body">
                    <textarea name="sejarah" rows="8"
                              class="form-control"
                              placeholder="Tulis sejarah desa...">{{ old('sejarah', $profil->sejarah) }}</textarea>
                </div>
            </div>

            {{-- Sambutan Kades --}}
            <div class="card border-0 shadow-sm mb-4" style="border-radius:12px;">
                <div class="card-header bg-white border-0 pt-3 pb-0">
                    <h6 class="fw-bold mb-0">💬 Sambutan Kepala Desa</h6>
                </div>
                <div class="card-body">
                    <textarea name="sambutan_kades" rows="6"
                              class="form-control"
                              placeholder="Tulis sambutan kepala desa...">{{ old('sambutan_kades', $profil->sambutan_kades) }}</textarea>
                </div>
            </div>

        </div>

        {{-- Kolom Kanan --}}
        <div class="col-lg-4">

            {{-- Kepala Desa --}}
            <div class="card border-0 shadow-sm mb-4" style="border-radius:12px;">
                <div class="card-header bg-white border-0 pt-3 pb-0">
                    <h6 class="fw-bold mb-0">👤 Kepala Desa</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size:13px;">Nama Kepala Desa</label>
                        <input type="text" name="nama_kades"
                               value="{{ old('nama_kades', $profil->nama_kades) }}"
                               class="form-control" placeholder="Nama lengkap...">
                    </div>

                    @if($profil->foto_kades)
                    <div class="text-center mb-3">
                        <img src="{{ asset('storage/'.$profil->foto_kades) }}"
                             style="width:100px;height:100px;object-fit:cover;
                                    border-radius:50%;border:3px solid #e8f5e9;" alt="Foto Kades">
                    </div>
                    @endif

                    <div class="mb-0">
                        <label class="form-label fw-bold" style="font-size:13px;">
                            {{ $profil->foto_kades ? 'Ganti Foto Kades' : 'Upload Foto Kades' }}
                        </label>
                        <input type="file" name="foto_kades" accept="image/*"
                               class="form-control" onchange="previewKades(this)">
                        <div id="previewKadesContainer" class="mt-2 text-center" style="display:none;">
                            <img id="previewKadesImg" src=""
                                 style="width:90px;height:90px;object-fit:cover;
                                        border-radius:50%;border:3px solid #e8f5e9;" alt="">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Logo Desa --}}
            <div class="card border-0 shadow-sm mb-4" style="border-radius:12px;">
                <div class="card-header bg-white border-0 pt-3 pb-0">
                    <h6 class="fw-bold mb-0">🏛️ Logo Desa</h6>
                </div>
                <div class="card-body">
                    @if($profil->logo)
                    <div class="text-center mb-3">
                        <img src="{{ asset('storage/'.$profil->logo) }}"
                             style="width:80px;height:80px;object-fit:contain;" alt="Logo">
                    </div>
                    @endif
                    <input type="file" name="logo" accept="image/*"
                           class="form-control" onchange="previewLogo(this)">
                    <small class="text-muted">Format PNG transparan disarankan</small>
                    <div id="previewLogoContainer" class="mt-2 text-center" style="display:none;">
                        <img id="previewLogoImg" src=""
                             style="width:70px;height:70px;object-fit:contain;" alt="">
                    </div>
                </div>
            </div>

            {{-- Tombol Simpan --}}
            <div class="card border-0 shadow-sm" style="border-radius:12px;">
                <div class="card-body">
                    <button type="submit"
                            style="background:#1a4731;color:#fff;border:none;padding:12px;
                                   border-radius:8px;font-weight:700;font-size:14px;width:100%;">
                        <i class="fas fa-save me-2"></i> Simpan Profil Desa
                    </button>
                </div>
            </div>

        </div>
    </div>

</form>

@endsection

@push('scripts')
<script>
function previewKades(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('previewKadesImg').src = e.target.result;
            document.getElementById('previewKadesContainer').style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function previewLogo(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('previewLogoImg').src = e.target.result;
            document.getElementById('previewLogoContainer').style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush