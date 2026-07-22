@extends('layouts.frontend')
@section('title', 'Galeri Foto')

@push('styles')
<style>
/* Lightbox overlay */
.lightbox-overlay {
    display: none; position: fixed; inset: 0;
    background: rgba(0,0,0,0.92); z-index: 9999;
    align-items: center; justify-content: center;
    flex-direction: column;
}
.lightbox-overlay.active { display: flex; }
.lightbox-img {
    max-width: 90vw; max-height: 80vh;
    border-radius: 8px; object-fit: contain;
}
.lightbox-caption {
    color: #fff; margin-top: 14px;
    font-size: 14px; text-align: center;
}
.lightbox-close {
    position: absolute; top: 20px; right: 28px;
    color: #fff; font-size: 28px; cursor: pointer;
    background: none; border: none; line-height: 1;
}
.lightbox-nav {
    position: absolute; top: 50%; transform: translateY(-50%);
    color: #fff; font-size: 28px; cursor: pointer;
    background: rgba(255,255,255,0.1); border: none;
    padding: 10px 16px; border-radius: 8px; transition: background 0.2s;
}
.lightbox-nav:hover { background: rgba(255,255,255,0.25); }
.lightbox-prev { left: 20px; }
.lightbox-next { right: 20px; }

/* Grid foto */
.foto-item {
    border-radius: 12px; overflow: hidden;
    aspect-ratio: 1; cursor: pointer; position: relative;
    background: #e8f5e9;
    box-shadow: 0 3px 12px rgba(0,0,0,0.08);
    transition: transform 0.25s;
}
.foto-item:hover { transform: scale(1.03); }
.foto-item img { width: 100%; height: 100%; object-fit: cover; }
.foto-item .overlay {
    position: absolute; inset: 0;
    background: rgba(26,71,49,0); display: flex;
    align-items: center; justify-content: center;
    transition: background 0.2s;
}
.foto-item:hover .overlay { background: rgba(26,71,49,0.4); }
.foto-item .overlay i {
    color: #fff; font-size: 2rem;
    opacity: 0; transition: opacity 0.2s;
}
.foto-item:hover .overlay i { opacity: 1; }
</style>
@endpush

@section('content')

<div class="page-header">
    <div class="container">
        <h1>Galeri Foto Desa Bungur</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Galeri</li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-5">
    <div class="container">

        {{-- Filter Album --}}
        @if($album->count() > 0)
        <div class="d-flex gap-2 flex-wrap mb-4">
            <button onclick="filterAlbum('semua')"
                    class="btn-filter active" data-album="semua"
                    style="background:#1a4731;color:#fff;border:none;padding:6px 16px;
                           border-radius:20px;font-size:13px;font-weight:600;cursor:pointer;">
                Semua
            </button>
            @foreach($album as $a)
            <button onclick="filterAlbum('{{ $a }}')"
                    class="btn-filter" data-album="{{ $a }}"
                    style="background:#f0f0f0;color:#555;border:none;padding:6px 16px;
                           border-radius:20px;font-size:13px;font-weight:600;cursor:pointer;">
                {{ $a }}
            </button>
            @endforeach
        </div>
        @endif

        {{-- Grid Foto --}}
        <div class="row g-3" id="galeriGrid">
            @forelse($galeri as $index => $g)
            <div class="col-6 col-md-4 col-lg-3 foto-wrapper"
                 data-album="{{ $g->album ?? 'tanpa-album' }}">
                <div class="foto-item"
                     onclick="bukaLightbox({{ $index }})"
                     data-judul="{{ addslashes($g->judul) }}"
                     data-src="{{ asset('storage/'.$g->file) }}">
                    <img src="{{ asset('storage/'.$g->file) }}"
                         alt="{{ $g->judul }}" loading="lazy">
                    <div class="overlay">
                        <i class="fas fa-search-plus"></i>
                    </div>
                </div>
                <div style="font-size:12px;color:#666;margin-top:6px;text-align:center;">
                    {{ Str::limit($g->judul, 30) }}
                </div>
            </div>
            @empty
            <div class="col-12 text-center text-muted py-5">
                <i class="fas fa-images fa-3x mb-3 d-block" style="color:#ccc;"></i>
                Belum ada foto di galeri.
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-5">
            {{ $galeri->links() }}
        </div>
    </div>
</section>

{{-- LIGHTBOX --}}
<div class="lightbox-overlay" id="lightbox">
    <button class="lightbox-close" onclick="tutupLightbox()">
        <i class="fas fa-times"></i>
    </button>
    <button class="lightbox-nav lightbox-prev" onclick="prevFoto()">
        <i class="fas fa-chevron-left"></i>
    </button>
    <img class="lightbox-img" id="lightboxImg" src="" alt="">
    <div class="lightbox-caption" id="lightboxCaption"></div>
    <button class="lightbox-nav lightbox-next" onclick="nextFoto()">
        <i class="fas fa-chevron-right"></i>
    </button>
</div>

@endsection

@push('scripts')
<script>
// Kumpulkan semua foto
const fotoList = [];
document.querySelectorAll('.foto-item').forEach(el => {
    fotoList.push({ src: el.dataset.src, judul: el.dataset.judul });
});

let currentIndex = 0;

function bukaLightbox(index) {
    currentIndex = index;
    tampilFoto();
    document.getElementById('lightbox').classList.add('active');
    document.body.style.overflow = 'hidden';
}

function tutupLightbox() {
    document.getElementById('lightbox').classList.remove('active');
    document.body.style.overflow = '';
}

function tampilFoto() {
    document.getElementById('lightboxImg').src    = fotoList[currentIndex].src;
    document.getElementById('lightboxCaption').textContent = fotoList[currentIndex].judul;
}

function prevFoto() {
    currentIndex = (currentIndex - 1 + fotoList.length) % fotoList.length;
    tampilFoto();
}

function nextFoto() {
    currentIndex = (currentIndex + 1) % fotoList.length;
    tampilFoto();
}

// Keyboard navigation
document.addEventListener('keydown', e => {
    if (!document.getElementById('lightbox').classList.contains('active')) return;
    if (e.key === 'ArrowLeft')  prevFoto();
    if (e.key === 'ArrowRight') nextFoto();
    if (e.key === 'Escape')     tutupLightbox();
});

// Filter album
function filterAlbum(album) {
    document.querySelectorAll('.btn-filter').forEach(btn => {
        btn.style.background = '#f0f0f0';
        btn.style.color = '#555';
    });
    event.target.style.background = '#1a4731';
    event.target.style.color = '#fff';

    document.querySelectorAll('.foto-wrapper').forEach(item => {
        if (album === 'semua' || item.dataset.album === album) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
}
</script>
@endpush