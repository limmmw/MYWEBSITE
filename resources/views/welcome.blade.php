@extends('layouts.app')

@section('title', 'Beranda')

@section('body-class', 'has-hero')

@section('content')
<!-- Hero Section yang Menyatu dengan Navbar -->
<div class="hero-section">
    <div class="container text-white py-5">
        <div class="row align-items-center" style="min-height: 70vh;">
            <div class="col-lg-6">
                <h1 class="display-3 fw-bold mb-4" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">Selamat Datang di Portal Desa</h1>
                <p class="lead mb-4" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.2);">Informasi terkini, layanan, dan berita dari desa kami untuk kemajuan bersama.</p>
                <a href="{{ route('berita.index') }}" class="btn btn-light btn-lg px-4 py-3" style="border-radius: 30px; font-weight: 600; box-shadow: 0 5px 15px rgba(0,0,0,0.2); transition: all 0.3s;">
                    <i class="bi bi-newspaper"></i> Lihat Berita
                </a>
            </div>
            <div class="col-lg-6 text-center">
                <i class="bi bi-cpu-fill" style="font-size: 15rem; opacity: 0.2;"></i>
            </div>
        </div>
    </div>
</div>

<!-- Berita Terbaru Section -->
<div class="container my-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold gradient-text">Berita Terbaru</h2>
        <p class="text-muted">Informasi dan kabar terkini dari desa kami</p>
    </div>

    <div class="row g-4">
        @php
            $beritaTerbaru = \App\Models\Berita::where('status', 'published')
                ->latest('tanggal_publish')
                ->take(3)
                ->get();
        @endphp

        @forelse($beritaTerbaru as $item)
        <div class="col-md-4">
            <div class="card berita-card h-100 shadow-sm">
                @if($item->gambar)
                    <img src="{{ Storage::url($item->gambar) }}" class="card-img-top" alt="{{ $item->judul }}" style="height: 200px; object-fit: cover;">
                @else
                    <div class="text-white d-flex align-items-center justify-content-center" style="height: 200px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <i class="bi bi-image" style="font-size: 3rem;"></i>
                    </div>
                @endif
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $item->judul }}</h5>
                    <p class="card-text text-muted">
                        {{ Str::limit(strip_tags($item->konten), 100) }}
                    </p>
                    <div class="mt-auto">
                        <small class="text-muted">
                            <i class="bi bi-calendar"></i> {{ $item->tanggal_publish->format('d M Y') }}
                        </small>
                        <div class="mt-2">
                            <a href="{{ route('berita.show', $item->slug) }}" class="btn btn-sm gradient-btn">
                                Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                <i class="bi bi-info-circle"></i> Belum ada berita yang dipublikasikan.
            </div>
        </div>
        @endforelse
    </div>

    @if($beritaTerbaru->count() > 0)
    <div class="text-center mt-4">
        <a href="{{ route('berita.index') }}" class="btn btn-outline-custom">
            Lihat Semua Berita <i class="bi bi-arrow-right"></i>
        </a>
    </div>
    @endif
</div>

<!-- Info Section -->
<div class="py-5 info-section">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4 text-center">
                <div class="mb-3">
                    <div class="icon-circle icon-circle-1">
                        <i class="bi bi-newspaper text-white" style="font-size: 2rem;"></i>
                    </div>
                </div>
                <h4 class="gradient-text">Berita Terkini</h4>
                <p class="text-muted">Dapatkan informasi dan berita terbaru dari desa</p>
            </div>
            <div class="col-md-4 text-center">
                <div class="mb-3">
                    <div class="icon-circle icon-circle-2">
                        <i class="bi bi-people text-white" style="font-size: 2rem;"></i>
                    </div>
                </div>
                <h4 class="gradient-text">Layanan Masyarakat</h4>
                <p class="text-muted">Berbagai layanan untuk kemudahan warga desa</p>
            </div>
            <div class="col-md-4 text-center">
                <div class="mb-3">
                    <div class="icon-circle icon-circle-3">
                        <i class="bi bi-building text-white" style="font-size: 2rem;"></i>
                    </div>
                </div>
                <h4 class="gradient-text">Informasi Desa</h4>
                <p class="text-muted">Profil, struktur, dan informasi lengkap desa</p>
            </div>
        </div>
    </div>
</div>

<style>
/* Hero Section yang Menyatu dengan Navbar */
.hero-section {
    position: relative;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.75), rgba(118, 75, 162, 0.75)),
                url('https://images.unsplash.com/photo-1639322537228-f710d846310a?w=1920&q=80') center/cover no-repeat;
    background-attachment: fixed;
    min-height: 100vh;
    margin-top: 0;
    padding-top: 6rem; /* beri ruang agar teks tidak tertimpa navbar */
}


.hero-section::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; height: 80px;
    background: linear-gradient(to bottom, rgba(102,126,234,0.9), transparent);
    z-index: 1;
}


/* Gradient Text */
.gradient-text {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Gradient Button */
.gradient-btn {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 20px;
    padding: 0.5rem 1.2rem;
    border: none;
    transition: all 0.3s;
}

.gradient-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    color: white;
}

/* Outline Button */
.btn-outline-custom {
    border-radius: 30px;
    padding: 0.7rem 2rem;
    font-weight: 600;
    border: 2px solid #667eea;
    color: #667eea;
    transition: all 0.3s;
    background: transparent;
}

.btn-outline-custom:hover {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white !important;
    border-color: transparent;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
}

/* Icon Circles */
.icon-circle {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 80px;
    height: 80px;
    border-radius: 50%;
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
}

.icon-circle-1 {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.icon-circle-2 {
    background: linear-gradient(135deg, #764ba2 0%, #f093fb 100%);
}

.icon-circle-3 {
    background: linear-gradient(135deg, #667eea 0%, #f093fb 100%);
}

/* Info Section Background */
.info-section {
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
}

/* Rotating Gear Animation */
.rotating-gear {
    animation: rotate-slow 20s linear infinite;
}

@keyframes rotate-slow {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

/* Hover Effects */
.btn-light:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.3) !important;
}
</style>
@endsection