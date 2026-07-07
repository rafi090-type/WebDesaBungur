@extends('layouts.admin')
@section('title', 'Edit Agenda')
@section('page-title', 'Edit Agenda Desa')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm" style="border-radius:12px;">
            <div class="card-body p-4">
                <form action="{{ route('admin.agenda.update', $agenda->id) }}" method="POST">
                    @csrf @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size:13px;">Judul Kegiatan</label>
                        <input type="text" name="judul"
                               value="{{ old('judul', $agenda->judul) }}"
                               class="form-control @error('judul') is-invalid @enderror">
                        @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size:13px;">Tanggal</label>
                            <input type="date" name="tanggal"
                                   value="{{ old('tanggal', \Carbon\Carbon::parse($agenda->tanggal)->format('Y-m-d')) }}"
                                   class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size:13px;">Jam Mulai</label>
                            <input type="time" name="jam_mulai"
                                   value="{{ old('jam_mulai', $agenda->jam_mulai) }}"
                                   class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size:13px;">Jam Selesai</label>
                            <input type="time" name="jam_selesai"
                                   value="{{ old('jam_selesai', $agenda->jam_selesai) }}"
                                   class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size:13px;">Lokasi</label>
                        <input type="text" name="lokasi"
                               value="{{ old('lokasi', $agenda->lokasi) }}"
                               class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size:13px;">Deskripsi</label>
                        <textarea name="deskripsi" rows="4"
                                  class="form-control">{{ old('deskripsi', $agenda->deskripsi) }}</textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit"
                                style="background:#1a4731;color:#fff;border:none;padding:10px 24px;
                                       border-radius:8px;font-weight:600;font-size:14px;">
                            <i class="fas fa-save me-1"></i> Update
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