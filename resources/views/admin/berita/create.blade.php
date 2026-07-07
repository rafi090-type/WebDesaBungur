@extends('layouts.admin')

@section('title', 'Tambah Berita')
@section('page-title', 'Tambah Berita')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="card border-0 shadow-sm" style="border-radius:12px;">
            <div class="card-body p-4">

                <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Judul --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size:13px;">
                            Judul Berita <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="judul" value="{{ old('judul') }}"
                               class="form-control @error('judul') is-invalid @enderror"
                               placeholder="Tulis judul berita..." id="inputJudul">
                        @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <div class="text-muted mt-1" style="font-size:12px;">
                            Slug: <span id="previewSlug" style="color:#2d7a50;">-</span>
                        </div>
                    </div>

                    {{-- Ringkasan --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size:13px;">Ringkasan</label>
                        <textarea name="ringkasan" rows="2"
                                  class="form-control @error('ringkasan') is-invalid @enderror"
                                  placeholder="Ringkasan singkat berita (opsional, max 300 karakter)..."
                                  maxlength="300">{{ old('ringkasan') }}</textarea>
                        @error('ringkasan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Isi Berita --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size:13px;">
                            Isi Berita <span class="text-danger">*</span>
                        </label>
                        <textarea name="isi" id="isiBerita" rows="12"
                                  class="form-control @error('isi') is-invalid @enderror"
                                  placeholder="Tulis isi berita di sini...">{{ old('isi') }}</textarea>
                        @error('isi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="row g-3 mb-3">
                        {{-- Kategori --}}
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size:13px;">
                                Kategori <span class="text-danger">*</span>
                            </label>
                            <select name="kategori_id"
                                    class="form-select @error('kategori_id') is-invalid @enderror">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategori as $k)
                                <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama }}
                                </option>
                                @endforeach
                            </select>
                            @error('kategori_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Status --}}
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size:13px;">Status</label>
                            <select name="status" class="form-select">
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="publish" {{ old('status') == 'publish' ? 'selected' : '' }}>Publish</option>
                            </select>
                        </div>

                        {{-- Thumbnail --}}
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size:13px;">Thumbnail</label>
                            <input type="file" name="thumbnail" accept="image/*"
                                   class="form-control @error('thumbnail') is-invalid @enderror"
                                   onchange="previewGambar(this)">
                            @error('thumbnail')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    {{-- Preview Thumbnail --}}
                    <div id="previewContainer" class="mb-3" style="display:none;">
                        <img id="previewImg" src=""
                             style="max-height:200px;border-radius:8px;border:1px solid #dee2e6;" alt="Preview">
                    </div>

                    {{-- Tombol --}}
                    <div class="d-flex gap-2">
                        <button type="submit"
                                style="background:#1a4731;color:#fff;border:none;
                                       padding:10px 24px;border-radius:8px;font-weight:600;font-size:14px;">
                            <i class="fas fa-save me-1"></i> Simpan Berita
                        </button>
                        <a href="{{ route('admin.berita.index') }}"
                           class="btn btn-outline-secondary" style="border-radius:8px;">
                            Batal
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
// Preview gambar sebelum upload
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

// Auto-generate slug dari judul
function slugify(text) {
    return text.toString().toLowerCase()
        .replace(/\s+/g, '-')
        .replace(/[^\w\-]+/g, '')
        .replace(/\-\-+/g, '-')
        .replace(/^-+/, '')
        .replace(/-+$/, '');
}

document.getElementById('inputJudul').addEventListener('input', function() {
    document.getElementById('previewSlug').textContent = slugify(this.value) || '-';
});
</script>
@endpush