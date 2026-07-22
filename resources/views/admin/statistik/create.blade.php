@extends('layouts.admin')
@section('title', 'Tambah Data Statistik')
@section('page-title', 'Tambah Data Statistik Baru')

@section('content')

<form action="{{ route('admin.statistik.store') }}" method="POST">
    @csrf

    <div class="card border-0 shadow-sm" style="border-radius:12px;">
        <div class="card-body p-4">
            <div class="mb-4">
                <label class="form-label fw-bold" style="color:#1a4731;">Kategori</label>
                <select name="kategori" class="form-select" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategori as $kat)
                    <option value="{{ $kat }}">{{ ucfirst($kat) }}</option>
                    @endforeach
                </select>
                @error('kategori')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold" style="color:#1a4731;">Label</label>
                <input type="text" name="label" class="form-control" placeholder="Contoh: Laki-laki, Islam, Petani, dll" required>
                @error('label')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold" style="color:#1a4731;">Jumlah</label>
                <input type="number" name="jumlah" class="form-control" min="0" placeholder="0" required>
                @error('jumlah')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold" style="color:#1a4731;">Urutan</label>
                <input type="number" name="urutan" class="form-control" min="0" placeholder="0" required>
                <small class="text-muted">Urutan tampilan (semakin kecil semakin atas)</small>
                @error('urutan')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit"
                        style="background:#1a4731;color:#fff;border:none;padding:12px 32px;
                               border-radius:8px;font-weight:700;font-size:14px;">
                    <i class="fas fa-plus me-2"></i> Tambah Data
                </button>
                <a href="{{ route('admin.statistik.edit') }}"
                   class="btn btn-secondary"
                   style="padding:12px 32px;border-radius:8px;font-weight:700;font-size:14px;">
                    <i class="fas fa-arrow-left me-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>

</form>

@endsection
