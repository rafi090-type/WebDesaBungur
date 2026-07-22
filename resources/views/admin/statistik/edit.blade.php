@extends('layouts.admin')
@section('title', 'Data Statistik')
@section('page-title', 'Edit Data Statistik Desa')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0" style="color:#1a4731;">Edit Data Statistik Desa</h5>
    <a href="{{ route('admin.statistik.create') }}"
       class="btn"
       style="background:#1a4731;color:#fff;border:none;padding:10px 24px;
              border-radius:8px;font-weight:700;font-size:14px;">
        <i class="fas fa-plus me-2"></i> Tambah Data Baru
    </a>
</div>

<form action="{{ route('admin.statistik.update') }}" method="POST">
    @csrf @method('PUT')

    <div class="row g-4">
        @foreach($data as $kat => $items)
        <div class="col-md-6">
            <div class="card border-0 shadow-sm" style="border-radius:12px;">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3" style="color:#1a4731;text-transform:capitalize;">
                        📊 {{ ucfirst($kat) }}
                    </h6>
                    @foreach($items as $item)
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <label style="font-size:13px;min-width:120px;font-weight:500;">
                            {{ $item->label }}
                        </label>
                        <input type="number" name="statistik[{{ $item->id }}]"
                               value="{{ $item->jumlah }}"
                               class="form-control" min="0" style="max-width:140px;">
                        <span style="font-size:12px;color:#aaa;">orang</span>
                        <form action="{{ route('admin.statistik.destroy', $item->id) }}"
                              method="POST"
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    class="btn btn-sm btn-danger"
                                    style="padding:6px 12px;font-size:12px;">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-4">
        <button type="submit"
                style="background:#1a4731;color:#fff;border:none;padding:12px 32px;
                       border-radius:8px;font-weight:700;font-size:14px;">
            <i class="fas fa-save me-2"></i> Simpan Semua Data Statistik
        </button>
    </div>
</form>

@endsection