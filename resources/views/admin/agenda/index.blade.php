@extends('layouts.admin')
@section('title', 'Kelola Agenda')
@section('page-title', 'Kelola Agenda Desa')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0" style="font-size:13px;">Total {{ $agenda->total() }} agenda</p>
    <a href="{{ route('admin.agenda.create') }}"
       style="background:#1a4731;color:#fff;font-weight:600;border-radius:8px;
              padding:8px 18px;text-decoration:none;font-size:13px;">
        <i class="fas fa-plus me-1"></i> Tambah Agenda
    </a>
</div>

<div class="card border-0 shadow-sm" style="border-radius:12px;">
    <div class="card-body p-0">
        <table class="table table-hover mb-0" style="font-size:13px;">
            <thead class="table-light">
                <tr>
                    <th class="ps-3">Kegiatan</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Lokasi</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($agenda as $a)
                <tr>
                    <td class="ps-3">
                        <div style="font-weight:600;">{{ $a->judul }}</div>
                        @if($a->deskripsi)
                        <div class="text-muted" style="font-size:12px;">{{ Str::limit($a->deskripsi, 60) }}</div>
                        @endif
                    </td>
                    <td>
                        <div style="font-weight:600;color:#1a4731;">
                            {{ \Carbon\Carbon::parse($a->tanggal)->format('d M Y') }}
                        </div>
                    </td>
                    <td>
                        @if($a->jam_mulai)
                            {{ $a->jam_mulai }} WIB
                            @if($a->jam_selesai) – {{ $a->jam_selesai }} WIB @endif
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>{{ $a->lokasi ?? '-' }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.agenda.edit', $a->id) }}"
                           class="btn btn-sm btn-outline-secondary" style="font-size:12px;padding:4px 10px;">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button onclick="hapus({{ $a->id }}, '{{ addslashes($a->judul) }}')"
                                class="btn btn-sm btn-outline-danger ms-1" style="font-size:12px;padding:4px 10px;">
                            <i class="fas fa-trash"></i>
                        </button>
                        <form id="form-hapus-{{ $a->id }}"
                              action="{{ route('admin.agenda.destroy', $a->id) }}"
                              method="POST" style="display:none;">
                            @csrf @method('DELETE')
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-5">
                        Belum ada agenda.
                        <a href="{{ route('admin.agenda.create') }}">Tambah sekarang</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="d-flex justify-content-center mt-4">{{ $agenda->links() }}</div>

@endsection

@push('scripts')
<script>
function hapus(id, judul) {
    Swal.fire({
        title: 'Hapus Agenda?',
        text: `"${judul}" akan dihapus!`,
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