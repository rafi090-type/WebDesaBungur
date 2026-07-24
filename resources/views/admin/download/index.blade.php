@extends('layouts.admin')
@section('title', 'Kelola Download')
@section('page-title', 'Kelola Download Dokumen')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0" style="font-size:13px;">Total {{ $downloads->total() }} dokumen</p>
    <a href="{{ route('admin.download.create') }}"
       style="background:#1a4731;color:#fff;font-weight:600;border-radius:8px;
              padding:8px 18px;text-decoration:none;font-size:13px;">
        <i class="fas fa-upload me-1"></i> Upload Dokumen
    </a>
</div>

<div class="card border-0 shadow-sm" style="border-radius:12px;">
    <div class="card-body p-0">
        <table class="table table-hover mb-0" style="font-size:13px;">
            <thead class="table-light">
                <tr>
                    <th class="ps-3">Ikon</th>
                    <th>Nama Dokumen</th>
                    <th>Kategori</th>
                    <th>Diunduh</th>
                    <th>Tanggal</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($downloads as $d)
                @php
                    $ext = pathinfo($d->file, PATHINFO_EXTENSION);
                    $ikonMap = [
                        'pdf'  => ['fas fa-file-pdf',  '#e53935'],
                        'doc'  => ['fas fa-file-word',  '#1565c0'],
                        'docx' => ['fas fa-file-word',  '#1565c0'],
                        'xls'  => ['fas fa-file-excel', '#2e7d32'],
                        'xlsx' => ['fas fa-file-excel', '#2e7d32'],
                        'zip'  => ['fas fa-file-archive','#f57f17'],
                    ];
                    $ikon  = $ikonMap[$ext] ?? ['fas fa-file', '#888'];
                @endphp
                <tr>
                    <td class="ps-3">
                        <div style="width:38px;height:38px;border-radius:8px;
                                    background:{{ $ikon[1] }}20;
                                    display:flex;align-items:center;justify-content:center;">
                            <i class="{{ $ikon[0] }}" style="color:{{ $ikon[1] }};font-size:18px;"></i>
                        </div>
                    </td>
                    <td>
                        <div style="font-weight:600;">{{ Str::limit($d->judul, 55) }}</div>
                        @if($d->keterangan)
                        <div class="text-muted" style="font-size:12px;">{{ Str::limit($d->keterangan, 60) }}</div>
                        @endif
                        <div style="font-size:11px;color:#aaa;margin-top:2px;">
                            {{ strtoupper($ext) }} •
                            {{ number_format(Storage::disk('public')->size($d->file) / 1024, 0) }} KB
                        </div>
                    </td>
                    <td>
                        <span style="background:#e8f5e9;color:#2d7a50;font-size:11px;
                                     font-weight:600;padding:2px 10px;border-radius:20px;">
                            {{ $d->kategori }}
                        </span>
                    </td>
                    <td>
                        <i class="fas fa-download me-1" style="color:#aaa;"></i>
                        {{ number_format($d->unduhan) }}x
                    </td>
                    <td>{{ $d->created_at->format('d M Y') }}</td>
                    <td class="text-center">
                        <a href="{{ asset('storage/'.$d->file) }}" target="_blank"
                           class="btn btn-sm btn-outline-success" style="font-size:12px;padding:4px 10px;"
                           title="Preview">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.download.edit', $d->id) }}"
                           class="btn btn-sm btn-outline-secondary ms-1" style="font-size:12px;padding:4px 10px;">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button onclick="hapus({{ $d->id }}, '{{ addslashes($d->judul) }}')"
                                class="btn btn-sm btn-outline-danger ms-1" style="font-size:12px;padding:4px 10px;">
                            <i class="fas fa-trash"></i>
                        </button>
                        <form id="form-hapus-{{ $d->id }}"
                              action="{{ route('admin.download.destroy', $d->id) }}"
                              method="POST" style="display:none;">
                            @csrf @method('DELETE')
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-5">
                        <i class="fas fa-folder-open fa-2x mb-2 d-block" style="color:#ddd;"></i>
                        Belum ada dokumen. <a href="{{ route('admin.download.create') }}">Upload sekarang</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $downloads->links() }}
</div>

@endsection

@push('scripts')
<script>
function hapus(id, judul) {
    Swal.fire({
        title: 'Hapus Dokumen?',
        text: `"${judul}" akan dihapus permanen termasuk filenya!`,
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