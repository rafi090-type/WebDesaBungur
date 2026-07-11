@extends('layouts.admin')
@section('title', 'Tambah Perangkat')
@section('page-title', 'Tambah Perangkat Desa')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm" style="border-radius:12px;">
            <div class="card-body p-4">
                <form action="{{ route('admin.perangkat.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size:13px;">
                            Nama Lengkap <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="nama" value="{{ old('nama') }}"
                               class="form-control @error('nama') is-invalid @enderror"
                               placeholder="Nama perangkat desa...">
                        @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size:13px;">
                            Jabatan <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="jabatan" value="{{ old('jabatan') }}"
                               class="form-control @error('jabatan') is-invalid @enderror"
                               placeholder="Contoh: Kepala Desa, Sekretaris Desa...">
                        @error('jabatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size:13px;">No. HP</label>
                            <input type="text" name="no_hp" value="{{ old('no_hp') }}"
                                   class="form-control" placeholder="08xx...">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size:13px;">Urutan Tampil</label>
                            <input type="number" name="urutan" value="{{ old('urutan', 0) }}"
                                   class="form-control" min="0">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size:13px;">Foto</label>
                        <input type="file" name="foto" accept="image/*"
                               class="form-control @error('foto') is-invalid @enderror"
                               onchange="previewGambar(this)">
                        <small class="text-muted">Format: JPG, PNG. Maks: 2MB. Disarankan foto formal.</small>
                        @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div id="previewContainer" class="mb-3 text-center" style="display:none;">
                        <img id="previewImg" src=""
                             style="width:120px;height:120px;object-fit:cover;
                                    border-radius:50%;border:3px solid #e8f5e9;" alt="Preview">
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit"
                                style="background:#1a4731;color:#fff;border:none;padding:10px 24px;
                                       border-radius:8px;font-weight:600;font-size:14px;">
                            <i class="fas fa-save me-1"></i> Simpan
                        </button>
                        <a href="{{ route('admin.perangkat.index') }}"
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