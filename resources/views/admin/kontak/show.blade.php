@extends('layouts.admin')
@section('title', 'Detail Pesan')
@section('page-title', 'Detail Pesan Masuk')

@section('content')

<div class="card border-0 shadow-sm" style="border-radius:12px;">
    <div class="card-header bg-white border-0 pt-3 pb-0 d-flex justify-content-between align-items-center">
        <h6 class="fw-bold mb-0">✉️ Detail Pesan</h6>
        <a href="{{ route('admin.kontak.index') }}" class="btn btn-sm btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>
    <div class="card-body p-4">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="fw-bold text-muted" style="font-size:12px;">NAMA PENGIRIM</label>
                    <div class="fw-bold fs-5">{{ $kontak->nama }}</div>
                </div>
                <div class="mb-3">
                    <label class="fw-bold text-muted" style="font-size:12px;">NO. HP</label>
                    <div>{{ $kontak->no_hp ?? '-' }}</div>
                </div>
                <div class="mb-3">
                    <label class="fw-bold text-muted" style="font-size:12px;">PERIHAL</label>
                    <div class="fw-bold">{{ $kontak->perihal }}</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="fw-bold text-muted" style="font-size:12px;">STATUS</label>
                    <div>
                        @if($kontak->sudah_dibaca)
                            <span class="badge bg-success">Sudah Dibaca</span>
                        @else
                            <span class="badge bg-warning text-dark">Belum Dibaca</span>
                        @endif
                    </div>
                </div>
                <div class="mb-3">
                    <label class="fw-bold text-muted" style="font-size:12px;">TANGGAL DITERIMA</label>
                    <div>{{ $kontak->created_at->format('d M Y, H:i') }}</div>
                </div>
            </div>
        </div>
        
        <hr class="my-4">
        
        <div class="mb-4">
            <label class="fw-bold text-muted" style="font-size:12px;">ISI PESAN</label>
            <div class="p-3 bg-light rounded" style="white-space:pre-wrap;line-height:1.6;">
                {{ $kontak->pesan }}
            </div>
        </div>

        <div class="d-flex gap-2">
            @if($kontak->sudah_dibaca)
                <form action="{{ route('admin.kontak.mark-unread', $kontak->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-envelope me-2"></i> Tandai Belum Dibaca
                    </button>
                </form>
            @else
                <form action="{{ route('admin.kontak.mark-read', $kontak->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check me-2"></i> Tandai Sudah Dibaca
                    </button>
                </form>
            @endif
            <form action="{{ route('admin.kontak.destroy', $kontak->id) }}"
                  method="POST"
                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?');">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash me-2"></i> Hapus Pesan
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
