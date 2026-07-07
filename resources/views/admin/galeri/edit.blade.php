@extends('layouts.admin')
@section('title', 'Edit Foto')
@section('page-title', 'Edit Foto Galeri')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm" style="border-radius:12px;">
            <div class="card-body p-4">
                <form action="{{ route('admin.galeri.update', $galeri->id) }}"
                      method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size:13px;">Judul Foto</label>
                        <input type="text" name="judul"
                               value="{{ old('judul', $galeri->judul) }}"
                               class="form-control @error('judul') is-invalid @enderror">
                        @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size:13px;">Album</label>
                        <input type="text" name="album"
                               value="{{ old('album', $galeri->album) }}"
                               class="form-control" placeholder="Nama album...">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size:13px;">Foto Saat Ini</label><br>
                        <img src="{{ asset('storage/'.$galeri->file) }}"
                             style="max-height:180px;border-radius:8px;border:1px solid #dee2e6;" alt="Foto">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size:13px;">Ganti Foto</label>
                        <input type="file" name="file" accept="image/*"
                               class="form-control" onchange="previewGambar(this)">
                        <small class="text-muted">Kosongkan jika tidak ingin mengganti foto</small>
                    </div>

                    <div id="previewContainer" class="mb-3" style="display:none;">
                        <img id="previewImg" src=""
                             style="max-height:180px;border-radius:8px;border:1px solid #dee2e6;" alt="Preview">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size:13px;">Keterangan</label>
                        <textarea name="keterangan" rows="3"
                                  class="form-control">{{ old('keterangan', $galeri->keterangan) }}</textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit"
                                style="background:#1a4731;color:#fff;border:none;padding:10px 24px;
                                       border-radius:8px;font-weight:600;font-size:14px;">
                            <i class="fas fa-save me-1"></i> Update Foto
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