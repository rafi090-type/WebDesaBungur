<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — Admin Desa Bungur</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.10.1/sweetalert2.min.css" rel="stylesheet">

    <style>
        :root {
            --hijau-tua: #1a4731;
            --hijau-mid: #2d7a50;
            --emas: #c8a84b;
        }
        body { background: #f4f6f9; font-family: 'Segoe UI', sans-serif; }
        .sidebar {
            width: 240px; min-height: 100vh;
            background: var(--hijau-tua);
            position: fixed; top: 0; left: 0;
            z-index: 100; transition: all 0.3s;
            overflow-y: auto;
        }
        .sidebar-brand {
            padding: 20px 16px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .sidebar-brand .brand-name { color: #fff; font-weight: 700; font-size: 15px; }
        .sidebar-brand .brand-sub  { color: var(--emas); font-size: 11px; }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.7);
            padding: 10px 16px; font-size: 13.5px;
            border-radius: 0; transition: all 0.2s;
            display: flex; align-items: center; gap: 10px;
            text-decoration: none;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: #fff;
            background: rgba(255,255,255,0.1);
            border-left: 3px solid var(--emas);
        }
        .sidebar .nav-link i { width: 18px; text-align: center; }
        .sidebar-section {
            font-size: 10px; font-weight: 700;
            color: rgba(255,255,255,0.3);
            letter-spacing: 1.5px; text-transform: uppercase;
            padding: 16px 16px 6px;
        }
        .topbar {
            margin-left: 240px; background: #fff;
            padding: 12px 24px; border-bottom: 1px solid #e9ecef;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 99;
        }
        .topbar .page-title { font-weight: 700; font-size: 16px; color: #2d3748; }
        .topbar .user-dropdown { display: flex; align-items: center; gap: 10px; cursor: pointer; }
        .topbar .avatar {
            width: 34px; height: 34px; border-radius: 50%;
            background: var(--hijau-tua); color: #fff;
            font-weight: 700; font-size: 13px;
            display: flex; align-items: center; justify-content: center;
        }
        .main-content { margin-left: 240px; padding: 24px; min-height: calc(100vh - 57px); }
        .stat-card {
            border: none; border-radius: 12px; padding: 20px;
            display: flex; align-items: center; gap: 16px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        }
        .stat-card .icon {
            width: 52px; height: 52px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px; flex-shrink: 0;
        }
        .stat-card .num { font-size: 1.6rem; font-weight: 800; line-height: 1; }
        .stat-card .lbl { font-size: 12px; color: #6c757d; margin-top: 3px; }
    </style>

    @stack('styles')
</head>
<body>

{{-- SIDEBAR --}}
<div class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-name">🏘️ Desa Bungur</div>
        <div class="brand-sub">Panel Admin</div>
    </div>

    <nav class="mt-2">
        <div class="sidebar-section">Utama</div>
        <a href="{{ route('admin.dashboard') }}"
           class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>

        <div class="sidebar-section">Konten</div>
        <a href="{{ route('admin.berita.index') }}"
           class="nav-link {{ request()->routeIs('admin.berita*') ? 'active' : '' }}">
            <i class="fas fa-newspaper"></i> Berita
        </a>
        <a href="{{ route('admin.galeri.index') }}"
           class="nav-link {{ request()->routeIs('admin.galeri*') ? 'active' : '' }}">
            <i class="fas fa-images"></i> Galeri
        </a>
        <a href="{{ route('admin.potensi.index') }}"
           class="nav-link {{ request()->routeIs('admin.potensi*') ? 'active' : '' }}">
            <i class="fas fa-leaf"></i> Potensi Desa
        </a>
        <a href="{{ route('admin.agenda.index') }}"
           class="nav-link {{ request()->routeIs('admin.agenda*') ? 'active' : '' }}">
            <i class="fas fa-calendar-alt"></i> Agenda
        </a>
        {{-- Download: pakai # dulu, akan diaktifkan di Fase 9 --}}
        <a href="#"
           class="nav-link {{ request()->routeIs('admin.download*') ? 'active' : '' }}">
            <i class="fas fa-download"></i> Download
        </a>

        <div class="sidebar-section">Desa</div>
        {{-- PERBAIKAN: profil.index → profil.edit --}}
        <a href="{{ route('admin.profil.edit') }}"
           class="nav-link {{ request()->routeIs('admin.profil*') ? 'active' : '' }}">
            <i class="fas fa-info-circle"></i> Profil Desa
        </a>
        <a href="{{ route('admin.perangkat.index') }}"
           class="nav-link {{ request()->routeIs('admin.perangkat*') ? 'active' : '' }}">
            <i class="fas fa-users"></i> Perangkat Desa
        </a>
        {{-- Statistik: pakai # dulu, belum ada halaman terpisah --}}
        <a href="#" class="nav-link">
            <i class="fas fa-chart-bar"></i> Statistik
        </a>

        <div class="sidebar-section">Lainnya</div>
        {{-- Pesan Masuk: pakai # dulu, akan diaktifkan di Fase 9 --}}
        <a href="#"
           class="nav-link {{ request()->routeIs('admin.kontak*') ? 'active' : '' }}">
            <i class="fas fa-envelope"></i> Pesan Masuk
        </a>
        {{-- PERBAIKAN: setting.index → setting.edit --}}
        <a href="{{ route('admin.setting.edit') }}"
           class="nav-link {{ request()->routeIs('admin.setting*') ? 'active' : '' }}">
            <i class="fas fa-cog"></i> Pengaturan
        </a>
    </nav>
</div>

{{-- TOPBAR --}}
<div class="topbar">
    <div class="page-title">@yield('page-title', 'Dashboard')</div>
    <div class="dropdown">
        <div class="user-dropdown" data-bs-toggle="dropdown">
            <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <span style="font-size:13px;font-weight:600;">{{ auth()->user()->name }}</span>
            <i class="fas fa-chevron-down" style="font-size:11px;color:#aaa;"></i>
        </div>
        <ul class="dropdown-menu dropdown-menu-end">
            <li>
                <a class="dropdown-item" href="{{ route('home') }}">
                    <i class="fas fa-globe me-2"></i>Lihat Website
                </a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>
</div>

{{-- MAIN CONTENT --}}
<div class="main-content">
    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success', title: 'Berhasil!',
                text: '{{ addslashes(session("success")) }}',
                timer: 2500, showConfirmButton: false
            });
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error', title: 'Gagal!',
                text: '{{ addslashes(session("error")) }}',
                timer: 2500, showConfirmButton: false
            });
        });
    </script>
    @endif

    @yield('content')
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.10.1/sweetalert2.min.js"></script>
@stack('scripts')

</body>
</html>