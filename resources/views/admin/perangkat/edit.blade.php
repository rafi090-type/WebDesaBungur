@extends('layouts.admin')
@section('title', 'Edit Perangkat')
@section('page-title', 'Edit Perangkat Desa')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm" style="border-radius:12px;">
            <div class="card-body p-4">
                <form action="{{ route('admin.perangkat.update', $perangkat->id) }}"
                      method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size:13px;">Nama Lengkap</label>
                        <input type="text" name="nama"
                               value="{{ old('nama', $perangkat->nama) }}"
                               class="form-control @error('nama') is-invalid @enderror">
                        @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size:13px;">Jabatan</label>
                        <input type="text" name="jabatan"
                               value="{{ old('jabatan', $perangkat->jabatan) }}"
                               class="form-control @error('jabatan') is-invalid @enderror">
                        @error('jabatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size:13px;">No. HP</label>
                            <input type="text" name="no_hp"
                                   value="{{ old('no_hp', $perangkat->no_hp) }}"
                                   class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size:13px;">Urutan</label>
                            <input type="number" name="urutan"
                                   value="{{ old('urutan', $perangkat->urutan) }}"
                                   class="form-control" min="0">
                        </div>
                    </div>

                    {{-- Foto saat ini --}}
                    @if($perangkat->foto)
                    <div class="mb-3 text-center">
                        <label class="form-label fw-bold d-block" style="font-size:13px;">Foto Saat Ini</label>
                        <img src="{{ asset('storage/'.$perangkat->foto) }}"
                             style="width:100px;height:100px;object-fit:cover;
                                    border-radius:50%;border:3px solid #e8f5e9;" alt="">
                    </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size:13px;">Ganti Foto</label>
                        <input type="file" name="foto" accept="image/*"
                               class="form-control" onchange="previewGambar(this)">
                        <small class="text-muted">Kosongkan jika tidak ingin mengganti foto</small>
                    </div>

                    <div id="previewContainer" class="mb-3 text-center" style="display:none;">
                        <img id="previewImg" src=""
                             style="width:100px;height:100px;object-fit:cover;
                                    border-radius:50%;border:3px solid #e8f5e9;" alt="Preview">
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="aktif"
                                   id="aktif" {{ $perangkat->aktif ? 'checked' : '' }}>
                            <label class="form-check-label" for="aktif" style="font-size:13px;">
                                Status Aktif
                            </label>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit"
                                style="background:#1a4731;color:#fff;border:none;padding:10px 24px;
                                       border-radius:8px;font-weight:600;font-size:14px;">
                            <i class="fas fa-save me-1"></i> Update
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