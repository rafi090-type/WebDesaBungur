@extends('layouts.admin')
@section('title', 'Edit Potensi')
@section('page-title', 'Edit Potensi Desa')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm" style="border-radius:12px;">
            <div class="card-body p-4">
                <form action="{{ route('admin.potensi.update', $potensi->id) }}"
                      method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size:13px;">Judul</label>
                        <input type="text" name="judul"
                               value="{{ old('judul', $potensi->judul) }}"
                               class="form-control @error('judul') is-invalid @enderror">
                        @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size:13px;">Kategori</label>
                            <select name="kategori" class="form-select">
                                @foreach(['perikanan','pertanian','umkm','wisata','lainnya'] as $kat)
                                <option value="{{ $kat }}"
                                    {{ old('kategori', $potensi->kategori) == $kat ? 'selected' : '' }}>
                                    {{ ucfirst($kat) }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size:13px;">Urutan</label>
                            <input type="number" name="urutan"
                                   value="{{ old('urutan', $potensi->urutan) }}"
                                   class="form-control" min="0">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size:13px;">Ganti Foto</label>
                            <input type="file" name="foto" accept="image/*"
                                   class="form-control" onchange="previewGambar(this)">
                            <small class="text-muted">Kosongkan jika tidak ingin mengganti</small>
                        </div>
                    </div>

                    @if($potensi->foto)
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size:13px;">Foto Saat Ini</label><br>
                        <img src="{{ asset('storage/'.$potensi->foto) }}"
                             style="max-height:160px;border-radius:8px;border:1px solid #dee2e6;" alt="">
                    </div>
                    @endif

                    <div id="previewContainer" class="mb-3" style="display:none;">
                        <img id="previewImg" src=""
                             style="max-height:160px;border-radius:8px;border:1px solid #dee2e6;" alt="Preview">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size:13px;">Deskripsi</label>
                        <textarea name="deskripsi" rows="5"
                                  class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $potensi->deskripsi) }}</textarea>
                        @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="tampil_home"
                                   id="tampilHome" {{ $potensi->tampil_home ? 'checked' : '' }}>
                            <label class="form-check-label" for="tampilHome" style="font-size:13px;">
                                Tampilkan di Halaman Home
                            </label>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit"
                                style="background:#1a4731;color:#fff;border:none;padding:10px 24px;
                                       border-radius:8px;font-weight:600;font-size:14px;">
                            <i class="fas fa-save me-1"></i> Update
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