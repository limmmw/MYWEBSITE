@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<!-- Hero Section -->
<div class="py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);">
    <div class="container text-white">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-3 fw-bold mb-4" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">Selamat Datang di Portal Desa</h1>
                <p class="lead mb-4" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.2);">Informasi terkini, layanan, dan berita dari desa kami untuk kemajuan bersama.</p>
                <a href="{{ route('berita.index') }}" class="btn btn-light btn-lg px-4 py-3" style="border-radius: 30px; font-weight: 600; box-shadow: 0 5px 15px rgba(0,0,0,0.2); transition: all 0.3s;">
                    <i class="bi bi-newspaper"></i> Lihat Berita
                </a>
            </div>
            <div class="col-lg-6 text-center">
                <i class="bi bi-cpu-fill" style="font-size: 15rem; opacity: 0.2; animation: rotate 20s linear infinite;"></i>
            </div>
        </div>
    </div>
</div>

<!-- Berita Terbaru Section -->
<div class="container my-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Berita Terbaru</h2>
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
                            <a href="{{ route('berita.show', $item->slug) }}" class="btn btn-sm" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 20px; padding: 0.5rem 1.2rem; transition: all 0.3s;">
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
        <a href="{{ route('berita.index') }}" class="btn btn-outline-primary" style="border-radius: 30px; padding: 0.7rem 2rem; font-weight: 600; border: 2px solid #667eea; color: #667eea; transition: all 0.3s;">
            Lihat Semua Berita <i class="bi bi-arrow-right"></i>
        </a>
    </div>
    @endif
</div>

<!-- Info Section -->
<div class="py-5" style="background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4 text-center">
                <div class="mb-3">
                    <div class="d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);">
                        <i class="bi bi-newspaper text-white" style="font-size: 2rem;"></i>
                    </div>
                </div>
                <h4 style="color: #667eea;">Berita Terkini</h4>
                <p class="text-muted">Dapatkan informasi dan berita terbaru dari desa</p>
            </div>
            <div class="col-md-4 text-center">
                <div class="mb-3">
                    <div class="d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, #764ba2 0%, #f093fb 100%); box-shadow: 0 5px 15px rgba(118, 75, 162, 0.3);">
                        <i class="bi bi-people text-white" style="font-size: 2rem;"></i>
                    </div>
                </div>
                <h4 style="color: #764ba2;">Layanan Masyarakat</h4>
                <p class="text-muted">Berbagai layanan untuk kemudahan warga desa</p>
            </div>
            <div class="col-md-4 text-center">
                <div class="mb-3">
                    <div class="d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, #667eea 0%, #f093fb 100%); box-shadow: 0 5px 15px rgba(240, 147, 251, 0.3);">
                        <i class="bi bi-building text-white" style="font-size: 2rem;"></i>
                    </div>
                </div>
                <h4 style="color: #667eea;">Informasi Desa</h4>
                <p class="text-muted">Profil, struktur, dan informasi lengkap desa</p>
            </div>
        </div>
    </div>
</div>

<style>
.btn-light:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.3) !important;
}

.btn-outline-primary:hover {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white !important;
    border-color: transparent;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
}

.berita-card .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
}
</style>
@endsection