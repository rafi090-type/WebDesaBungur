@extends('layouts.admin')
@section('title', 'Tambah Agenda')
@section('page-title', 'Tambah Agenda Desa')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm" style="border-radius:12px;">
            <div class="card-body p-4">
                <form action="{{ route('admin.agenda.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size:13px;">
                            Judul Kegiatan <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="judul" value="{{ old('judul') }}"
                               class="form-control @error('judul') is-invalid @enderror"
                               placeholder="Nama kegiatan...">
                        @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size:13px;">
                                Tanggal <span class="text-danger">*</span>
                            </label>
                            <input type="date" name="tanggal" value="{{ old('tanggal') }}"
                                   class="form-control @error('tanggal') is-invalid @enderror">
                            @error('tanggal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size:13px;">Jam Mulai</label>
                            <input type="time" name="jam_mulai" value="{{ old('jam_mulai') }}"
                                   class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size:13px;">Jam Selesai</label>
                            <input type="time" name="jam_selesai" value="{{ old('jam_selesai') }}"
                                   class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size:13px;">Lokasi</label>
                        <input type="text" name="lokasi" value="{{ old('lokasi') }}"
                               class="form-control" placeholder="Lokasi kegiatan...">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size:13px;">Deskripsi</label>
                        <textarea name="deskripsi" rows="4" class="form-control"
                                  placeholder="Deskripsi kegiatan (opsional)...">{{ old('deskripsi') }}</textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit"
                                style="background:#1a4731;color:#fff;border:none;padding:10px 24px;
                                       border-radius:8px;font-weight:600;font-size:14px;">
                            <i class="fas fa-save me-1"></i> Simpan
                        </button>
                        <a href="{{ route('admin.agenda.index') }}"
                           class="btn btn-outline-secondary" style="border-radius:8px;">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection