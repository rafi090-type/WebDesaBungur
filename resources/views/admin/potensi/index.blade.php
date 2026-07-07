@extends('layouts.admin')
@section('title', 'Kelola Potensi')
@section('page-title', 'Kelola Potensi Desa')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0" style="font-size:13px;">Total {{ $potensi->total() }} potensi</p>
    <a href="{{ route('admin.potensi.create') }}"
       style="background:#1a4731;color:#fff;font-weight:600;border-radius:8px;
              padding:8px 18px;text-decoration:none;font-size:13px;">
        <i class="fas fa-plus me-1"></i> Tambah Potensi
    </a>
</div>

<div class="card border-0 shadow-sm" style="border-radius:12px;">
    <div class="card-body p-0">
        <table class="table table-hover mb-0" style="font-size:13px;">
            <thead class="table-light">
                <tr>
                    <th class="ps-3">Foto</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Urutan</th>
                    <th>Tampil Home</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($potensi as $p)
                <tr>
                    <td class="ps-3">
                        @if($p->foto)
                        <img src="{{ asset('storage/'.$p->foto) }}"
                             style="width:50px;height:50px;object-fit:cover;border-radius:8px;" alt="">
                        @else
                        <div style="width:50px;height:50px;background:#e8f5e9;border-radius:8px;
                                    display:flex;align-items:center;justify-content:center;font-size:1.4rem;">
                            🌿
                        </div>
                        @endif
                    </td>
                    <td>
                        <div style="font-weight:600;">{{ Str::limit($p->judul, 50) }}</div>
                        <div class="text-muted" style="font-size:12px;">{{ Str::limit($p->deskripsi, 60) }}</div>
                    </td>
                    <td>
                        <span style="background:#e8f5e9;color:#2d7a50;font-size:11px;
                                     font-weight:600;padding:2px 10px;border-radius:20px;">
                            {{ ucfirst($p->kategori) }}
                        </span>
                    </td>
                    <td>{{ $p->urutan }}</td>
                    <td>
                        @if($p->tampil_home)
                            <span style="background:#e8f5e9;color:#2d7a50;font-size:11px;
                                         font-weight:600;padding:2px 10px;border-radius:20px;">Ya</span>
                        @else
                            <span style="background:#f5f5f5;color:#aaa;font-size:11px;
                                         padding:2px 10px;border-radius:20px;">Tidak</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.potensi.edit', $p->id) }}"
                           class="btn btn-sm btn-outline-secondary" style="font-size:12px;padding:4px 10px;">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button onclick="hapus({{ $p->id }}, '{{ addslashes($p->judul) }}')"
                                class="btn btn-sm btn-outline-danger ms-1" style="font-size:12px;padding:4px 10px;">
                            <i class="fas fa-trash"></i>
                        </button>
                        <form id="form-hapus-{{ $p->id }}"
                              action="{{ route('admin.potensi.destroy', $p->id) }}"
                              method="POST" style="display:none;">
                            @csrf @method('DELETE')
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-5">
                        Belum ada data potensi.
                        <a href="{{ route('admin.potensi.create') }}">Tambah sekarang</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="d-flex justify-content-center mt-4">{{ $potensi->links() }}</div>

@endsection

@push('scripts')
<script>
function hapus(id, judul) {
    Swal.fire({
        title: 'Hapus Potensi?',
        text: `"${judul}" akan dihapus permanen!`,
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