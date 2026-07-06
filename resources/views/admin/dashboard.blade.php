@extends('layouts.admin')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('content')

{{-- Stat Cards --}}

<div class="row g-3 mb-4">

    <div class="col-6 col-md-3">

        <div class="stat-card bg-white">

            <div class="icon" style="background:#e8f5e9;color:#2d7a50;">

                <i class="fas fa-newspaper"></i>

            </div>

            <div>

                <div class="num">{{ $total_berita }}</div>

                <div class="lbl">Total Berita</div>

            </div>

        </div>

    </div>

    <div class="col-6 col-md-3">

        <div class="stat-card bg-white">

            <div class="icon" style="background:#e3f2fd;color:#1565c0;">

                <i class="fas fa-images"></i>

            </div>

            <div>

                <div class="num">{{ $total_galeri }}</div>

                <div class="lbl">Total Galeri</div>

            </div>

        </div>

    </div>

    <div class="col-6 col-md-3">

        <div class="stat-card bg-white">

            <div class="icon" style="background:#fff3e0;color:#e65100;">

                <i class="fas fa-envelope"></i>

            </div>

            <div>

                <div class="num">{{ $total_kontak }}</div>

                <div class="lbl">Pesan Belum Dibaca</div>

            </div>

        </div>

    </div>

    <div class="col-6 col-md-3">

        <div class="stat-card bg-white">

            <div class="icon" style="background:#fce4ec;color:#c62828;">

                <i class="fas fa-leaf"></i>

            </div>

            <div>

                <div class="num">{{ $total_potensi }}</div>

                <div class="lbl">Potensi Desa</div>

            </div>

        </div>

    </div>

</div>

<div class="row g-3">

    {{-- Tabel Berita Terbaru --}}

    <div class="col-lg-8">

        <div class="card border-0 shadow-sm" style="border-radius:12px;">

            <div class="card-header bg-white border-0 pt-3 pb-0">

                <h6 class="fw-bold mb-0">📰 Berita Terbaru</h6>

            </div>

            <div class="card-body p-0">

                <table class="table table-hover mb-0" style="font-size:13px;">

                    <thead class="table-light">

                        <tr>

                            <th class="ps-3">Judul</th>

                            <th>Kategori</th>

                            <th>Status</th>

                            <th>Tanggal</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($berita_terbaru as $b)

                        <tr>

                            <td class="ps-3">{{ Str::limit($b->judul, 45) }}</td>

                            <td>{{ $b->kategori->nama ?? '-' }}</td>

                            <td>

                                @if($b->status == 'publish')

                                    <span class="badge" style="background:#e8f5e9;color:#2d7a50;">Publish</span>

                                @else

                                    <span class="badge" style="background:#fff3e0;color:#e65100;">Draft</span>

                                @endif

                            </td>

                            <td>{{ $b->created_at->format('d M Y') }}</td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="4" class="text-center text-muted py-4">

                                Belum ada berita

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    {{-- Pesan Terbaru --}}

    <div class="col-lg-4">

        <div class="card border-0 shadow-sm" style="border-radius:12px;">

            <div class="card-header bg-white border-0 pt-3 pb-0">

                <h6 class="fw-bold mb-0">✉️ Pesan Terbaru</h6>

            </div>

            <div class="card-body" style="font-size:13px;">

                @forelse($pesan_terbaru as $p)

                <div class="d-flex gap-2 mb-3 pb-3 border-bottom">

                    <div style="width:36px;height:36px;border-radius:50%;background:#e8f5e9;

                                color:#2d7a50;display:flex;align-items:center;

                                justify-content:center;font-weight:700;flex-shrink:0;">

                        {{ strtoupper(substr($p->nama, 0, 1)) }}

                    </div>

                    <div>

                        <div class="fw-600">{{ $p->nama }}</div>

                        <div class="text-muted" style="font-size:12px;">

                            {{ Str::limit($p->perihal, 35) }}

                        </div>

                    </div>

                </div>

                @empty

                <p class="text-muted text-center py-3">Belum ada pesan</p>

                @endforelse

            </div>

        </div>

    </div>

</div>

@endsection
