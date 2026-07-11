@extends('layouts.admin')
@section('title', 'Perangkat Desa')
@section('page-title', 'Kelola Perangkat Desa')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0" style="font-size:13px;">Total {{ $perangkat->total() }} perangkat</p>
    <a href="{{ route('admin.perangkat.create') }}"
       style="background:#1a4731;color:#fff;font-weight:600;border-radius:8px;
              padding:8px 18px;text-decoration:none;font-size:13px;">
        <i class="fas fa-plus me-1"></i> Tambah Perangkat
    </a>
</div>

<div class="card border-0 shadow-sm" style="border-radius:12px;">
    <div class="card-body p-0">
        <table class="table table-hover mb-0" style="font-size:13px;">
            <thead class="table-light">
                <tr>
                    <th class="ps-3">Foto</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>No. HP</th>
                    <th>Urutan</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($perangkat as $p)
                <tr>
                    <td class="ps-3">
                        @if($p->foto)
                            <img src="{{ asset('storage/'.$p->foto) }}"
                                 style="width:44px;height:44px;object-fit:cover;
                                        border-radius:50%;border:2px solid #e8f5e9;" alt="">
                        @else
                            <div style="width:44px;height:44px;border-radius:50%;
                                        background:#e8f5e9;display:flex;align-items:center;
                                        justify-content:center;font-size:1.2rem;">👤</div>
                        @endif
                    </td>
                    <td><div style="font-weight:600;">{{ $p->nama }}</div></td>
                    <td>{{ $p->jabatan }}</td>
                    <td>{{ $p->no_hp ?? '-' }}</td>
                    <td>{{ $p->urutan }}</td>
                    <td>
                        @if($p->aktif)
                            <span style="background:#e8f5e9;color:#2d7a50;font-size:11px;
                                         font-weight:600;padding:2px 10px;border-radius:20px;">Aktif</span>
                        @else
                            <span style="background:#f5f5f5;color:#aaa;font-size:11px;
                                         padding:2px 10px;border-radius:20px;">Nonaktif</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.perangkat.edit', $p->id) }}"
                           class="btn btn-sm btn-outline-secondary" style="font-size:12px;padding:4px 10px;">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button onclick="hapus({{ $p->id }}, '{{ addslashes($p->nama) }}')"
                                class="btn btn-sm btn-outline-danger ms-1" style="font-size:12px;padding:4px 10px;">
                            <i class="fas fa-trash"></i>
                        </button>
                        <form id="form-hapus-{{ $p->id }}"
                              action="{{ route('admin.perangkat.destroy', $p->id) }}"
                              method="POST" style="display:none;">
                            @csrf @method('DELETE')
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-5">
                        Belum ada data perangkat desa.
                        <a href="{{ route('admin.perangkat.create') }}">Tambah sekarang</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="d-flex justify-content-center mt-4">{{ $perangkat->links() }}</div>

@endsection

@push('scripts')
<script>
function hapus(id, nama) {
    Swal.fire({
        title: 'Hapus Perangkat?',
        text: `"${nama}" akan dihapus permanen!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then(result => {
        if (result.isConfirmed) {
            document.getElementById('form-hapus-' + id).submit();
        }
    });
}
</script>
@endpush