@extends('layouts.frontend')
@section('title', 'Peta Desa')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css">
<style>
#map { height: 520px; border-radius: 14px; z-index: 1; }
.legend-item {
    display: flex; align-items: center; gap: 8px;
    margin-bottom: 10px; font-size: 13px;
}
.legend-dot {
    width: 14px; height: 14px; border-radius: 50%; flex-shrink: 0;
}
</style>
@endpush

@section('content')

<div class="page-header">
    <div class="container">
        <h1>Peta Wilayah Desa Bungur</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Peta Desa</li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-5">
    <div class="container">
        <div class="row g-4">

            {{-- Peta --}}
            <div class="col-lg-9">
                <div id="map"></div>
            </div>

            {{-- Legenda --}}
            <div class="col-lg-3">
                <div style="background:#fff;border-radius:14px;padding:20px;
                             box-shadow:0 4px 20px rgba(0,0,0,.08);position:sticky;top:80px;">
                    <h6 style="font-weight:700;color:#1a4731;margin-bottom:16px;">
                        📍 Fasilitas Desa
                    </h6>

                    <div class="legend-item">
                        <div class="legend-dot" style="background:#1a4731;"></div>
                        Kantor Desa
                    </div>
                    <div class="legend-item">
                        <div class="legend-dot" style="background:#1565c0;"></div>
                        Masjid / Musholla
                    </div>
                    <div class="legend-item">
                        <div class="legend-dot" style="background:#e65100;"></div>
                        Sekolah
                    </div>
                    <div class="legend-item">
                        <div class="legend-dot" style="background:#6a1b9a;"></div>
                        Posyandu
                    </div>
                    <div class="legend-item">
                        <div class="legend-dot" style="background:#c8a84b;"></div>
                        Area Perikanan
                    </div>

                    <hr>

                    <div style="font-size:12px;color:#aaa;line-height:1.7;">
                        <i class="fas fa-info-circle me-1"></i>
                        Klik marker untuk melihat informasi lokasi.
                    </div>

                    <hr>

                    <h6 style="font-weight:700;color:#1a4731;margin-bottom:12px;">🗺️ Info Wilayah</h6>
                    <div style="font-size:13px;line-height:2;color:#555;">
                        <div><strong>Desa:</strong> Bungur</div>
                        <div><strong>Kecamatan:</strong> Rangsang Pesisir</div>
                        <div><strong>Kabupaten:</strong> Kepulauan Meranti</div>
                        <div><strong>Provinsi:</strong> Riau</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
<script>
// ─── Koordinat Desa Bungur (Rangsang Pesisir, Kepulauan Meranti)
// Sesuaikan koordinat lat/lng jika perlu
const DESA_LAT = 1.1830;
const DESA_LNG = 103.1040;

const map = L.map('map').setView([DESA_LAT, DESA_LNG], 14);

// Tile layer OpenStreetMap
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    maxZoom: 19,
}).addTo(map);

// Fungsi buat icon marker warna-warni
function buatIcon(warna) {
    return L.divIcon({
        className: '',
        html: `<div style="
            width:28px;height:28px;border-radius:50% 50% 50% 0;
            background:${warna};transform:rotate(-45deg);
            border:3px solid #fff;box-shadow:0 2px 6px rgba(0,0,0,.3);
        "></div>`,
        iconSize: [28, 28],
        iconAnchor: [14, 28],
        popupAnchor: [0, -28],
    });
}

// ─── Data Marker Lokasi Penting
// Sesuaikan koordinat setiap lokasi dengan kondisi nyata di lapangan
const lokasi = [
    {
        lat: DESA_LAT, lng: DESA_LNG,
        nama: '🏛️ Kantor Desa Bungur',
        desc: 'Pusat pemerintahan Desa Bungur',
        warna: '#1a4731'
    },
    {
        lat: DESA_LAT + 0.003, lng: DESA_LNG - 0.002,
        nama: '🕌 Masjid Jami Desa Bungur',
        desc: 'Masjid utama Desa Bungur',
        warna: '#1565c0'
    },
    {
        lat: DESA_LAT - 0.004, lng: DESA_LNG + 0.003,
        nama: '🏫 SD Negeri Desa Bungur',
        desc: 'Sekolah Dasar Negeri',
        warna: '#e65100'
    },
    {
        lat: DESA_LAT + 0.005, lng: DESA_LNG + 0.004,
        nama: '🏥 Posyandu Desa Bungur',
        desc: 'Pos Pelayanan Terpadu',
        warna: '#6a1b9a'
    },
    {
        lat: DESA_LAT - 0.006, lng: DESA_LNG - 0.005,
        nama: '🐟 Area Perikanan Tangkap',
        desc: 'Kawasan perikanan nelayan lokal',
        warna: '#c8a84b'
    },
];

// Tambahkan semua marker ke peta
lokasi.forEach(l => {
    L.marker([l.lat, l.lng], { icon: buatIcon(l.warna) })
        .addTo(map)
        .bindPopup(`
            <div style="font-family:'Segoe UI',sans-serif;min-width:160px;">
                <div style="font-weight:700;font-size:14px;color:#1a4731;margin-bottom:4px;">
                    ${l.nama}
                </div>
                <div style="font-size:12px;color:#666;">${l.desc}</div>
            </div>
        `);
});

// Gambar batas/area desa (polygon perkiraan)
const batasDesa = L.polygon([
    [DESA_LAT + 0.012, DESA_LNG - 0.010],
    [DESA_LAT + 0.012, DESA_LNG + 0.012],
    [DESA_LAT - 0.010, DESA_LNG + 0.012],
    [DESA_LAT - 0.010, DESA_LNG - 0.010],
], {
    color: '#1a4731',
    weight: 2,
    fillColor: '#4caf82',
    fillOpacity: 0.08,
    dashArray: '6, 6',
}).addTo(map);

batasDesa.bindPopup('<b style="color:#1a4731;">Wilayah Desa Bungur</b>');
</script>
@endpush