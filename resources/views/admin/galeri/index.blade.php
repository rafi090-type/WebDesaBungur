@extends('layouts.admin')
@section('title', 'Kelola Galeri')
@section('page-title', 'Kelola Galeri')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0" style="font-size:13px;">Total {{ $galeri->total() }} foto</p>
    <a href="{{ route('admin.galeri.create') }}"
       style="background:#1a4731;color:#fff;font-weight:600;border-radius:8px;
              padding:8px 18px;text-decoration:none;font-size:13px;">
        <i class="fas fa-plus me-1"></i> Upload Foto
    </a>
</div>

<div class="row g-3">
    @forelse($galeri as $g)
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius:12px;overflow:hidden;">
            <div style="height:160px;overflow:hidden;background:#f0f7f3;">
                <img src="{{ asset('storage/'.$g->file) }}"
                     style="width:100%;height:100%;object-fit:cover;" alt="{{ $g->judul }}">
            </div>
            <div class="card-body p-2">
                <div style="font-size:13px;font-weight:600;">{{ Str::limit($g->judul, 30) }}</div>
                @if($g->album)
                <div style="font-size:11px;color:#aaa;">{{ $g->album }}</div>
                @endif
                <div class="d-flex gap-1 mt-2">
                    <a href="{{ route('admin.galeri.edit', $g->id) }}"
                       class="btn btn-sm btn-outline-secondary w-50" style="font-size:11px;">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <button onclick="hapus({{ $g->id }}, '{{ addslashes($g->judul) }}')"
                            class="btn btn-sm btn-outline-danger w-50" style="font-size:11px;">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                    <form id="form-hapus-{{ $g->id }}"
                          action="{{ route('admin.galeri.destroy', $g->id) }}"
                          method="POST" style="display:none;">
                        @csrf @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center text-muted py-5">
        <i class="fas fa-images fa-3x mb-3 d-block" style="color:#ddd;"></i>
        Belum ada foto. <a href="{{ route('admin.galeri.create') }}">Upload sekarang</a>
    </div>
    @endforelse
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $galeri->links() }}
</div>

@endsection

@push('scripts')
<script>
function hapus(id, judul) {
    Swal.fire({
        title: 'Hapus Foto?',
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