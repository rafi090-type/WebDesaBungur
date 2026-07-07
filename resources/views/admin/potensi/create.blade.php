@extends('layouts.admin')
@section('title', 'Tambah Potensi')
@section('page-title', 'Tambah Potensi Desa')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm" style="border-radius:12px;">
            <div class="card-body p-4">
                <form action="{{ route('admin.potensi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size:13px;">
                            Judul <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="judul" value="{{ old('judul') }}"
                               class="form-control @error('judul') is-invalid @enderror"
                               placeholder="Nama potensi desa...">
                        @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size:13px;">
                                Kategori <span class="text-danger">*</span>
                            </label>
                            <select name="kategori" class="form-select @error('kategori') is-invalid @enderror">
                                <option value="">-- Pilih --</option>
                                <option value="perikanan" {{ old('kategori') == 'perikanan' ? 'selected' : '' }}>Perikanan</option>
                                <option value="pertanian" {{ old('kategori') == 'pertanian' ? 'selected' : '' }}>Pertanian</option>
                                <option value="umkm"      {{ old('kategori') == 'umkm'      ? 'selected' : '' }}>UMKM</option>
                                <option value="wisata"    {{ old('kategori') == 'wisata'    ? 'selected' : '' }}>Wisata</option>
                                <option value="lainnya"   {{ old('kategori') == 'lainnya'   ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size:13px;">Urutan Tampil</label>
                            <input type="number" name="urutan" value="{{ old('urutan', 0) }}"
                                   class="form-control" min="0">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size:13px;">Upload Foto</label>
                            <input type="file" name="foto" accept="image/*"
                                   class="form-control" onchange="previewGambar(this)">
                        </div>
                    </div>

                    <div id="previewContainer" class="mb-3" style="display:none;">
                        <img id="previewImg" src=""
                             style="max-height:180px;border-radius:8px;border:1px solid #dee2e6;" alt="Preview">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size:13px;">
                            Deskripsi <span class="text-danger">*</span>
                        </label>
                        <textarea name="deskripsi" rows="5"
                                  class="form-control @error('deskripsi') is-invalid @enderror"
                                  placeholder="Deskripsi potensi desa...">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="tampil_home"
                                   id="tampilHome" {{ old('tampil_home') ? 'checked' : '' }}>
                            <label class="form-check-label" for="tampilHome" style="font-size:13px;">
                                Tampilkan di Halaman Home
                            </label>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit"
                                style="background:#1a4731;color:#fff;border:none;padding:10px 24px;
                                       border-radius:8px;font-weight:600;font-size:14px;">
                            <i class="fas fa-save me-1"></i> Simpan
                        </button>
                        <a href="{{ route('admin.potensi.index') }}"
                           class="btn btn-outline-secondary" style="border-radius:8px;">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function previewGambar(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('previewContainer').style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush