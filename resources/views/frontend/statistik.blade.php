@extends('layouts.frontend')
@section('title', 'Statistik Desa')

@push('styles')
<style>
.chart-card {
    background: #fff; border-radius: 14px;
    padding: 24px; box-shadow: 0 4px 20px rgba(0,0,0,.07);
    height: 100%;
}
.chart-card h5 {
    font-weight: 700; font-size: 15px;
    color: #1a4731; margin-bottom: 20px;
    padding-bottom: 12px; border-bottom: 2px solid #e8f5e9;
}
</style>
@endpush

@section('content')

<div class="page-header">
    <div class="container">
        <h1>Statistik Desa Bungur</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Statistik</li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-5">
    <div class="container">

        {{-- Total Summary --}}
        <div class="row g-3 mb-5">
            @php $totalPenduduk = $penduduk->sum('jumlah'); @endphp
            <div class="col-6 col-md-3">
                <div style="background:#1a4731;border-radius:14px;padding:24px;text-align:center;color:#fff;">
                    <div style="font-size:2rem;font-weight:800;color:#c8a84b;">{{ number_format($totalPenduduk) }}</div>
                    <div style="font-size:12px;color:rgba(255,255,255,.7);margin-top:4px;">Total Penduduk</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div style="background:#fff;border-radius:14px;padding:24px;text-align:center;box-shadow:0 4px 16px rgba(0,0,0,.07);">
                    <div style="font-size:2rem;font-weight:800;color:#2d7a50;">{{ number_format($penduduk->where('label','Laki-laki')->first()->jumlah ?? 0) }}</div>
                    <div style="font-size:12px;color:#aaa;margin-top:4px;">Laki-laki</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div style="background:#fff;border-radius:14px;padding:24px;text-align:center;box-shadow:0 4px 16px rgba(0,0,0,.07);">
                    <div style="font-size:2rem;font-weight:800;color:#e91e8c;">{{ number_format($penduduk->where('label','Perempuan')->first()->jumlah ?? 0) }}</div>
                    <div style="font-size:12px;color:#aaa;margin-top:4px;">Perempuan</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div style="background:#fff;border-radius:14px;padding:24px;text-align:center;box-shadow:0 4px 16px rgba(0,0,0,.07);">
                    <div style="font-size:2rem;font-weight:800;color:#c8a84b;">4</div>
                    <div style="font-size:12px;color:#aaa;margin-top:4px;">Dusun</div>
                </div>
            </div>
        </div>

        {{-- Charts --}}
        <div class="row g-4">

            {{-- Penduduk - Bar Chart --}}
            <div class="col-md-6">
                <div class="chart-card">
                    <h5><i class="fas fa-users me-2" style="color:#2d7a50;"></i>Penduduk berdasarkan Jenis Kelamin</h5>
                    <canvas id="chartPenduduk" height="200"></canvas>
                </div>
            </div>

            {{-- Agama - Doughnut Chart --}}
            <div class="col-md-6">
                <div class="chart-card">
                    <h5><i class="fas fa-mosque me-2" style="color:#2d7a50;"></i>Penduduk berdasarkan Agama</h5>
                    <canvas id="chartAgama" height="200"></canvas>
                </div>
            </div>

            {{-- Pekerjaan - Horizontal Bar --}}
            <div class="col-md-6">
                <div class="chart-card">
                    <h5><i class="fas fa-briefcase me-2" style="color:#2d7a50;"></i>Penduduk berdasarkan Pekerjaan</h5>
                    <canvas id="chartPekerjaan" height="220"></canvas>
                </div>
            </div>

            {{-- Pendidikan - Bar Chart --}}
            <div class="col-md-6">
                <div class="chart-card">
                    <h5><i class="fas fa-graduation-cap me-2" style="color:#2d7a50;"></i>Penduduk berdasarkan Pendidikan</h5>
                    <canvas id="chartPendidikan" height="220"></canvas>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
<script>
const hijauPalette = [
    '#1a4731','#2d7a50','#4caf82','#c8a84b','#f0d98a',
    '#80cbc4','#a5d6a7','#66bb6a','#81c784','#aed581'
];

// Chart Penduduk (Bar)
new Chart(document.getElementById('chartPenduduk'), {
    type: 'bar',
    data: {
        labels: {!! $penduduk->pluck('label')->toJson() !!},
        datasets: [{
            label: 'Jumlah',
            data: {!! $penduduk->pluck('jumlah')->toJson() !!},
            backgroundColor: ['#2d7a50', '#e91e8c'],
            borderRadius: 8,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true } }
    }
});

// Chart Agama (Doughnut)
new Chart(document.getElementById('chartAgama'), {
    type: 'doughnut',
    data: {
        labels: {!! $agama->pluck('label')->toJson() !!},
        datasets: [{
            data: {!! $agama->pluck('jumlah')->toJson() !!},
            backgroundColor: hijauPalette,
            borderWidth: 2,
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'bottom', labels: { font: { size: 12 } } }
        }
    }
});

// Chart Pekerjaan (Horizontal Bar)
new Chart(document.getElementById('chartPekerjaan'), {
    type: 'bar',
    data: {
        labels: {!! $pekerjaan->pluck('label')->toJson() !!},
        datasets: [{
            label: 'Jumlah',
            data: {!! $pekerjaan->pluck('jumlah')->toJson() !!},
            backgroundColor: hijauPalette,
            borderRadius: 6,
        }]
    },
    options: {
        indexAxis: 'y',
        responsive: true,
        plugins: { legend: { display: false } },
        scales: { x: { beginAtZero: true } }
    }
});

// Chart Pendidikan (Bar)
new Chart(document.getElementById('chartPendidikan'), {
    type: 'bar',
    data: {
        labels: {!! $pendidikan->pluck('label')->toJson() !!},
        datasets: [{
            label: 'Jumlah',
            data: {!! $pendidikan->pluck('jumlah')->toJson() !!},
            backgroundColor: '#2d7a50',
            borderRadius: 6,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true } }
    }
});
</script>
@endpush