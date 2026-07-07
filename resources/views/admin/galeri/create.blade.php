@extends('layouts.admin')
@section('title', 'Upload Foto')
@section('page-title', 'Upload Foto Galeri')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm" style="border-radius:12px;">
            <div class="card-body p-4">
                <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size:13px;">
                            Judul Foto <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="judul" value="{{ old('judul') }}"
                               class="form-control @error('judul') is-invalid @enderror"
                               placeholder="Judul foto...">
                        @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size:13px;">Album</label>
                        <input type="text" name="album" value="{{ old('album') }}"
                               class="form-control" placeholder="Nama album (opsional)...">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size:13px;">
                            File Foto <span class="text-danger">*</span>
                        </label>
                        <input type="file" name="file" accept="image/*"
                               class="form-control @error('file') is-invalid @enderror"
                               onchange="previewGambar(this)">
                        <small class="text-muted">Format: JPG, PNG, WebP. Maks: 3MB</small>
                        @error('file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div id="previewContainer" class="mb-3" style="display:none;">
                        <img id="previewImg" src=""
                             style="max-height:220px;border-radius:8px;border:1px solid #dee2e6;" alt="Preview">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size:13px;">Keterangan</label>
                        <textarea name="keterangan" rows="3" class="form-control"
                                  placeholder="Keterangan foto (opsional)...">{{ old('keterangan') }}</textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit"
                                style="background:#1a4731;color:#fff;border:none;padding:10px 24px;
                                       border-radius:8px;font-weight:600;font-size:14px;">
                            <i class="fas fa-upload me-1"></i> Upload Foto
                        </button>
                        <a href="{{ route('admin.galeri.index') }}"
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