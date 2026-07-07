@extends('layouts.admin')

@section('title', 'Edit Berita')
@section('page-title', 'Edit Berita')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="card border-0 shadow-sm" style="border-radius:12px;">
            <div class="card-body p-4">

                <form action="{{ route('admin.berita.update', $berita->id) }}"
                      method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    {{-- Judul --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size:13px;">
                            Judul Berita <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="judul"
                               value="{{ old('judul', $berita->judul) }}"
                               class="form-control @error('judul') is-invalid @enderror"
                               placeholder="Tulis judul berita...">
                        @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <div class="text-muted mt-1" style="font-size:12px;">
                            Slug saat ini: <span style="color:#2d7a50;">{{ $berita->slug }}</span>
                        </div>
                    </div>

                    {{-- Ringkasan --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size:13px;">Ringkasan</label>
                        <textarea name="ringkasan" rows="2"
                                  class="form-control" maxlength="300"
                                  placeholder="Ringkasan singkat (opsional)...">{{ old('ringkasan', $berita->ringkasan) }}</textarea>
                    </div>

                    {{-- Isi Berita --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size:13px;">
                            Isi Berita <span class="text-danger">*</span>
                        </label>
                        <textarea name="isi" rows="12"
                                  class="form-control @error('isi') is-invalid @enderror"
                                  placeholder="Tulis isi berita...">{{ old('isi', $berita->isi) }}</textarea>
                        @error('isi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="row g-3 mb-3">
                        {{-- Kategori --}}
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size:13px;">Kategori</label>
                            <select name="kategori_id" class="form-select">
                                @foreach($kategori as $k)
                                <option value="{{ $k->id }}"
                                    {{ old('kategori_id', $berita->kategori_id) == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Status --}}
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size:13px;">Status</label>
                            <select name="status" class="form-select">
                                <option value="draft" {{ old('status', $berita->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="publish" {{ old('status', $berita->status) == 'publish' ? 'selected' : '' }}>Publish</option>
                            </select>
                        </div>

                        {{-- Thumbnail --}}
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size:13px;">Thumbnail Baru</label>
                            <input type="file" name="thumbnail" accept="image/*"
                                   class="form-control" onchange="previewGambar(this)">
                            <small class="text-muted">Kosongkan jika tidak ingin mengubah foto</small>
                        </div>
                    </div>

                    {{-- Thumbnail saat ini --}}
                    @if($berita->thumbnail)
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size:13px;">Thumbnail Saat Ini</label><br>
                        <img src="{{ asset('storage/'.$berita->thumbnail) }}"
                             style="max-height:180px;border-radius:8px;border:1px solid #dee2e6;" alt="Thumbnail">
                    </div>
                    @endif

                    {{-- Preview Thumbnail Baru --}}
                    <div id="previewContainer" class="mb-3" style="display:none;">
                        <label class="form-label fw-bold" style="font-size:13px;">Preview Thumbnail Baru</label><br>
                        <img id="previewImg" src=""
                             style="max-height:180px;border-radius:8px;border:1px solid #dee2e6;" alt="Preview">
                    </div>

                    {{-- Tombol --}}
                    <div class="d-flex gap-2">
                        <button type="submit"
                                style="background:#1a4731;color:#fff;border:none;
                                       padding:10px 24px;border-radius:8px;font-weight:600;font-size:14px;">
                            <i class="fas fa-save me-1"></i> Update Berita
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