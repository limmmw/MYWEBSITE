@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<!-- Hero Section -->
<div class="bg-success text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-3 fw-bold mb-4">Selamat Datang di Portal Desa</h1>
                <p class="lead mb-4">Informasi terkini, layanan, dan berita dari desa kami untuk kemajuan bersama.</p>
                <a href="{{ route('berita.index') }}" class="btn btn-light btn-lg">
                    <i class="bi bi-newspaper"></i> Lihat Berita
                </a>
            </div>
            <div class="col-lg-6 text-center">
                <i class="bi bi-house-heart-fill" style="font-size: 15rem; opacity: 0.2;"></i>
            </div>
        </div>
    </div>
</div>

<!-- Berita Terbaru Section -->
<div class="container my-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Berita Terbaru</h2>
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
                    <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 200px;">
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
                            <a href="{{ route('berita.show', $item->slug) }}" class="btn btn-success btn-sm">
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
        <a href="{{ route('berita.index') }}" class="btn btn-outline-success">
            Lihat Semua Berita <i class="bi bi-arrow-right"></i>
        </a>
    </div>
    @endif
</div>

<!-- Info Section -->
<div class="bg-light py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4 text-center">
                <div class="mb-3">
                    <i class="bi bi-newspaper text-success" style="font-size: 3rem;"></i>
                </div>
                <h4>Berita Terkini</h4>
                <p class="text-muted">Dapatkan informasi dan berita terbaru dari desa</p>
            </div>
            <div class="col-md-4 text-center">
                <div class="mb-3">
                    <i class="bi bi-people text-success" style="font-size: 3rem;"></i>
                </div>
                <h4>Layanan Masyarakat</h4>
                <p class="text-muted">Berbagai layanan untuk kemudahan warga desa</p>
            </div>
            <div class="col-md-4 text-center">
                <div class="mb-3">
                    <i class="bi bi-building text-success" style="font-size: 3rem;"></i>
                </div>
                <h4>Informasi Desa</h4>
                <p class="text-muted">Profil, struktur, dan informasi lengkap desa</p>
            </div>
        </div>
    </div>
</div>
@endsection