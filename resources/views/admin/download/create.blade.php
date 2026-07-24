@extends('layouts.admin')
@section('title', 'Upload Dokumen')
@section('page-title', 'Upload Dokumen')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm" style="border-radius:12px;">
            <div class="card-body p-4">
                <form action="{{ route('admin.download.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size:13px;">
                            Nama Dokumen <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="judul" value="{{ old('judul') }}"
                               class="form-control @error('judul') is-invalid @enderror"
                               placeholder="Contoh: APBDes Tahun 2025...">
                        @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size:13px;">
                            Kategori <span class="text-danger">*</span>
                        </label>
                        <select name="kategori" class="form-select @error('kategori') is-invalid @enderror">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach([
                                'Keuangan Desa',
                                'Perencanaan Desa',
                                'Peraturan Desa',
                                'Formulir Pelayanan',
                                'Laporan Kegiatan',
                                'Pengumuman',
                                'Lainnya',
                            ] as $kat)
                            <option value="{{ $kat }}" {{ old('kategori') == $kat ? 'selected' : '' }}>
                                {{ $kat }}
                            </option>
                            @endforeach
                        </select>
                        @error('kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size:13px;">Keterangan</label>
                        <textarea name="keterangan" rows="3" class="form-control"
                                  placeholder="Deskripsi singkat dokumen (opsional)...">{{ old('keterangan') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size:13px;">
                            File Dokumen <span class="text-danger">*</span>
                        </label>
                        <input type="file" name="file"
                               class="form-control @error('file') is-invalid @enderror"
                               onchange="previewFile(this)">
                        <small class="text-muted">
                            Format: PDF, DOC, DOCX, XLS, XLSX, ZIP. Maks: <strong>10MB</strong>
                        </small>
                        @error('file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Preview file yang dipilih --}}
                    <div id="filePreview" class="mb-3 p-3"
                         style="display:none;background:#f0f7f3;border-radius:8px;border:1px solid #c8e6c9;">
                        <div class="d-flex align-items-center gap-3">
                            <i id="fileIcon" class="fas fa-file fa-2x" style="color:#2d7a50;"></i>
                            <div>
                                <div id="fileName" style="font-weight:600;font-size:13px;"></div>
                                <div id="fileSize" style="font-size:12px;color:#aaa;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit"
                                style="background:#1a4731;color:#fff;border:none;padding:10px 24px;
                                       border-radius:8px;font-weight:600;font-size:14px;">
                            <i class="fas fa-upload me-1"></i> Upload Dokumen
                        </button>
                        <a href="{{ route('admin.download.index') }}"
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
function previewFile(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const ext  = file.name.split('.').pop().toLowerCase();
        const size = (file.size / 1024).toFixed(0);

        const iconMap = {
            pdf:  ['fas fa-file-pdf',    '#e53935'],
            doc:  ['fas fa-file-word',   '#1565c0'],
            docx: ['fas fa-file-word',   '#1565c0'],
            xls:  ['fas fa-file-excel',  '#2e7d32'],
            xlsx: ['fas fa-file-excel',  '#2e7d32'],
            zip:  ['fas fa-file-archive','#f57f17'],
        };
        const [iconClass, iconColor] = iconMap[ext] || ['fas fa-file', '#888'];

        document.getElementById('fileIcon').className = iconClass + ' fa-2x';
        document.getElementById('fileIcon').style.color = iconColor;
        document.getElementById('fileName').textContent = file.name;
        document.getElementById('fileSize').textContent = size + ' KB';
        document.getElementById('filePreview').style.display = 'block';
    }
}
</script>
@endpush