<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta-desc', 'Website resmi Desa Bungur, Kecamatan Rangsang Pesisir, Kabupaten Kepulauan Meranti, Riau.')">
    <title>@yield('title', 'Beranda') — Desa Bungur</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.10.1/sweetalert2.min.css" rel="stylesheet">

    <style>
        :root {
            --hijau-tua: #1a4731;
            --hijau-mid: #2d7a50;
            --hijau-muda: #4caf82;
            --emas: #c8a84b;
            --emas-muda: #f0d98a;
            --putih: #f9f7f2;
            --abu: #6c7a7d;
            --gelap: #0f2a1e;
        }

        body { font-family: 'Segoe UI', system-ui, sans-serif; background: var(--putih); color: var(--gelap); }

        /* NAVBAR */
        .navbar-utama {
            background: var(--hijau-tua);
            padding: 10px 0;
            position: sticky; top: 0; z-index: 999;
            box-shadow: 0 2px 16px rgba(0,0,0,0.2);
        }
        .navbar-brand-wrap { display: flex; align-items: center; gap: 12px; text-decoration: none; }
        .brand-logo {
            width: 44px; height: 44px; border-radius: 50%;
            background: var(--emas);
            display: flex; align-items: center; justify-content: center;
            font-weight: 900; font-size: 16px; color: var(--hijau-tua); flex-shrink: 0;
        }
        .brand-name { color: #fff; font-size: 14px; font-weight: 700; line-height: 1.2; }
        .brand-sub  { color: var(--emas-muda); font-size: 11px; }
        .navbar-utama .nav-link {
            color: rgba(255,255,255,0.82) !important;
            font-size: 13.5px; font-weight: 500;
            padding: 6px 13px !important;
            transition: color 0.2s;
        }
        .navbar-utama .nav-link:hover,
        .navbar-utama .nav-link.active { color: var(--emas) !important; }
        .navbar-toggler { border-color: rgba(255,255,255,0.3); }
        .navbar-toggler-icon { filter: invert(1); }

        /* FOOTER */
        footer { background: var(--gelap); padding: 48px 0 20px; }
        .footer-brand { color: #fff; font-weight: 700; font-size: 16px; }
        .footer-desc  { color: rgba(255,255,255,0.45); font-size: 13px; margin-top: 8px; line-height: 1.7; }
        .footer-heading { color: rgba(255,255,255,0.7); font-weight: 600; font-size: 13px; margin-bottom: 14px; }
        .footer-link {
            color: rgba(255,255,255,0.5); text-decoration: none;
            display: block; margin-bottom: 8px; font-size: 13px; transition: color 0.2s;
        }
        .footer-link:hover { color: var(--emas); }
        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.08);
            margin-top: 32px; padding-top: 20px;
            display: flex; justify-content: space-between;
            align-items: center; flex-wrap: wrap; gap: 8px;
            font-size: 12px; color: rgba(255,255,255,0.35);
        }
        .sosmed a {
            width: 34px; height: 34px; border-radius: 8px;
            background: rgba(255,255,255,0.07);
            display: inline-flex; align-items: center; justify-content: center;
            color: rgba(255,255,255,0.55); margin-left: 6px;
            text-decoration: none; transition: all 0.2s;
        }
        .sosmed a:hover { background: var(--emas); color: var(--gelap); }

        /* SECTION HELPERS */
        .section-eyebrow {
            font-size: 12px; font-weight: 700; letter-spacing: 2px;
            text-transform: uppercase; color: var(--hijau-mid); margin-bottom: 6px;
        }
        .section-title {
            font-size: clamp(1.5rem, 3vw, 2rem);
            font-weight: 800; color: var(--gelap); line-height: 1.2;
        }
        .section-title span { color: var(--hijau-mid); }
        .divider-emas {
            width: 44px; height: 3px;
            background: var(--emas); border-radius: 2px; margin: 14px 0 22px;
        }

        /* PAGE HEADER */
        .page-header {
            background: linear-gradient(135deg, var(--hijau-tua), var(--hijau-mid));
            padding: 52px 0 40px; color: #fff;
        }
        .page-header h1 { font-weight: 800; font-size: 1.9rem; }
        .page-header .breadcrumb-item, .page-header .breadcrumb-item a {
            color: rgba(255,255,255,0.65); font-size: 13px; text-decoration: none;
        }
        .page-header .breadcrumb-item.active { color: var(--emas); }
        .page-header .breadcrumb-item + .breadcrumb-item::before { color: rgba(255,255,255,0.4); }
    </style>

    @stack('styles')
</head>
<body>

{{-- NAVBAR --}}
<nav class="navbar-utama navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand-wrap" href="{{ route('home') }}">
            <div class="brand-logo">DB</div>
            <div>
                <div class="brand-name">Desa Bungur</div>
                <div class="brand-sub">Kec. Rangsang Pesisir · Kep. Meranti</div>
            </div>
        </a>

        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navMenu">
            <ul class="navbar-nav gap-1 mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                       href="{{ route('home') }}">Beranda</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('profil') ? 'active' : '' }}"
                       href="#" data-bs-toggle="dropdown">Profil</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('profil') }}">Sejarah & Visi Misi</a></li>
                        <li><a class="dropdown-item {{ request()->routeIs('perangkat') ? 'active' : '' }}" href="{{ route('perangkat') }}">Perangkat Desa</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('potensi') ? 'active' : '' }}"
                       href="{{ route('potensi') }}">Potensi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('berita*') ? 'active' : '' }}"
                       href="{{ route('berita.index') }}">Berita</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('galeri') ? 'active' : '' }}"
                       href="{{ route('galeri') }}">Galeri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('kontak') ? 'active' : '' }}"
                       href="{{ route('kontak') }}">Kontak</a>
                </li>
                {{-- Statistik: arahkan ke section di Home, bukan route terpisah --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('statistik') ? 'active' : '' }}" href="{{ route('statistik') }}">Statistik</a>
                </li>
                {{-- Peta: arahkan ke section di Kontak, bukan route terpisah --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('kontak') }}#peta">Peta Desa</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

{{-- CONTENT --}}
@yield('content')

{{-- FOOTER --}}
<footer>
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="footer-brand">🏘️ Desa Bungur</div>
                <p class="footer-desc">Desa pesisir di Kecamatan Rangsang Pesisir, Kabupaten Kepulauan Meranti, Provinsi Riau.</p>
            </div>
            <div class="col-md-2">
                <div class="footer-heading">Menu</div>
                <a href="{{ route('home') }}"         class="footer-link">Beranda</a>
                <a href="{{ route('profil') }}"       class="footer-link">Profil Desa</a>
                <a href="{{ route('potensi') }}"      class="footer-link">Potensi</a>
                <a href="{{ route('berita.index') }}" class="footer-link">Berita</a>
                {{-- PERBAIKAN: gunakan anchor ke section, bukan route terpisah --}}
                <a href="{{ route('statistik') }}" class="footer-link">Statistik</a>
                <a href="{{ route('kontak') }}#peta"    class="footer-link">Peta Desa</a>
            </div>
            <div class="col-md-2">
                <div class="footer-heading">Layanan</div>
                <a href="{{ route('galeri') }}"  class="footer-link">Galeri</a>
                <a href="{{ route('kontak') }}"  class="footer-link">Kontak</a>
                <a href="/login"                 class="footer-link">Login Admin</a>
            </div>
            <div class="col-md-4">
                <div class="footer-heading">Kontak Desa</div>
                <p style="color:rgba(255,255,255,0.5);font-size:13px;line-height:1.8;">
                    <i class="fas fa-map-marker-alt me-2" style="color:var(--emas);"></i>
                    Desa Bungur, Kec. Rangsang Pesisir<br>
                    <i class="fas fa-phone me-2" style="color:var(--emas);"></i>
                    +62 812-XXXX-XXXX
                </p>
            </div>
        </div>

        <div class="footer-bottom">
            <span>© {{ date('Y') }} Desa Bungur · Dikembangkan oleh Mahasiswa KKN UNRI</span>
            <div class="sosmed">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.10.1/sweetalert2.min.js"></script>

@if(session('success'))
<script>
    Swal.fire({ icon:'success', title:'Berhasil!',
        text:'{{ addslashes(session("success")) }}', timer:3000, showConfirmButton:false });
</script>
@endif

@stack('scripts')
</body>
</html>
