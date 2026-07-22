@extends('layouts.admin')
@section('title', 'Pesan Masuk')
@section('page-title', 'Pesan Masuk')

@section('content')

<div class="card border-0 shadow-sm" style="border-radius:12px;">
    <div class="card-header bg-white border-0 pt-3 pb-0 d-flex justify-content-between align-items-center">
        <h6 class="fw-bold mb-0">✉️ Daftar Pesan Masuk</h6>
        <div>
            <span class="badge bg-success">{{ $kontak->where('sudah_dibaca', true)->count() }} Dibaca</span>
            <span class="badge bg-warning text-dark">{{ $kontak->where('sudah_dibaca', false)->count() }} Belum Dibaca</span>
        </div>
    </div>
    <div class="card-body p-0">
        @if($kontak->isEmpty())
            <div class="text-center py-5">
                <i class="fas fa-envelope-open" style="font-size:48px;color:#ddd;"></i>
                <p class="text-muted mt-3">Belum ada pesan masuk</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover mb-0" style="font-size:13px;">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3">Status</th>
                            <th>Nama</th>
                            <th>Perihal</th>
                            <th>No. HP</th>
                            <th>Tanggal</th>
                            <th class="text-end pe-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kontak as $k)
                        <tr class="{{ !$k->sudah_dibaca ? 'table-light' : '' }}">
                            <td class="ps-3">
                                @if($k->sudah_dibaca)
                                    <span class="badge bg-success">Dibaca</span>
                                @else
                                    <span class="badge bg-warning text-dark">Baru</span>
                                @endif
                            </td>
                            <td class="fw-bold">{{ $k->nama }}</td>
                            <td>{{ Str::limit($k->perihal, 40) }}</td>
                            <td>{{ $k->no_hp ?? '-' }}</td>
                            <td>{{ $k->created_at->format('d M Y, H:i') }}</td>
                            <td class="text-end pe-3">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.kontak.show', $k->id) }}"
                                       class="btn btn-info text-white"
                                       title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if($k->sudah_dibaca)
                                        <form action="{{ route('admin.kontak.mark-unread', $k->id) }}"
                                              method="POST"
                                              style="display:inline;">
                                            @csrf
                                            <button type="submit"
                                                    class="btn btn-warning"
                                                    title="Tandai Belum Dibaca">
                                                <i class="fas fa-envelope"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.kontak.mark-read', $k->id) }}"
                                              method="POST"
                                              style="display:inline;">
                                            @csrf
                                            <button type="submit"
                                                    class="btn btn-success"
                                                    title="Tandai Dibaca">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('admin.kontak.destroy', $k->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?');"
                                          style="display:inline;">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-danger"
                                                title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

@endsection
