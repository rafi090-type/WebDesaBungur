@extends('layouts.admin')

@section('title', 'Kelola Berita')
@section('page-title', 'Kelola Berita')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <p class="text-muted mb-0" style="font-size:13px;">
            Total {{ $berita->total() }} berita
        </p>
    </div>
    <a href="{{ route('admin.berita.create') }}"
       class="btn btn-sm"
       style="background:#1a4731;color:#fff;font-weight:600;border-radius:8px;padding:8px 18px;">
        <i class="fas fa-plus me-1"></i> Tambah Berita
    </a>
</div>

<div class="card border-0 shadow-sm" style="border-radius:12px;">
    <div class="card-body p-0">
        <table class="table table-hover mb-0" style="font-size:13px;">
            <thead class="table-light">
                <tr>
                    <th class="ps-3" style="width:40%">Judul</th>
                    <th>Kategori</th>
                    <th>Penulis</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($berita as $b)
                <tr>
                    <td class="ps-3">
                        <div style="font-weight:600;">{{ Str::limit($b->judul, 60) }}</div>
                        @if($b->ringkasan)
                        <div class="text-muted" style="font-size:12px;">{{ Str::limit($b->ringkasan, 70) }}</div>
                        @endif
                    </td>
                    <td>
                        <span style="background:#e8f5e9;color:#2d7a50;font-size:11px;
                                     font-weight:600;padding:2px 10px;border-radius:20px;">
                            {{ $b->kategori->nama ?? '-' }}
                        </span>
                    </td>
                    <td>{{ $b->penulis->name ?? '-' }}</td>
                    <td>
                        @if($b->status === 'publish')
                            <span style="background:#e8f5e9;color:#2d7a50;font-size:11px;
                                         font-weight:600;padding:2px 10px;border-radius:20px;">
                                Publish
                            </span>
                        @else
                            <span style="background:#fff3e0;color:#e65100;font-size:11px;
                                         font-weight:600;padding:2px 10px;border-radius:20px;">
                                Draft
                            </span>
                        @endif
                    </td>
                    <td>{{ $b->created_at->format('d M Y') }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.berita.edit', $b->id) }}"
                           class="btn btn-sm btn-outline-secondary"
                           style="font-size:12px;padding:4px 10px;border-radius:6px;">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button onclick="hapusBerita({{ $b->id }}, '{{ addslashes($b->judul) }}')"
                                class="btn btn-sm btn-outline-danger ms-1"
                                style="font-size:12px;padding:4px 10px;border-radius:6px;">
                            <i class="fas fa-trash"></i>
                        </button>
                        <form id="form-hapus-{{ $b->id }}"
                              action="{{ route('admin.berita.destroy', $b->id) }}"
                              method="POST" style="display:none;">
                            @csrf @method('DELETE')
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-5">
                        <i class="fas fa-newspaper fa-2x mb-2 d-block" style="color:#ddd;"></i>
                        Belum ada berita. <a href="{{ route('admin.berita.create') }}">Tambah sekarang</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Pagination --}}
<div class="d-flex justify-content-center mt-4">
    {{ $berita->links() }}
</div>

@endsection

@push('scripts')
<script>
function hapusBerita(id, judul) {
    Swal.fire({
        title: 'Hapus Berita?',
        text: `"${judul}" akan dihapus permanen!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('form-hapus-' + id).submit();
        }
    });
}
</script>
@endpush