@extends('layouts.app')

@section('title', 'Berita Desa')

@section('content')
<div class="bg-success text-white py-5">
    <div class="container">
        <h1 class="display-4 mb-2">Berita Desa</h1>
        <p class="lead">Informasi dan berita terkini dari desa kami</p>
    </div>
</div>

<div class="container my-5">
    <div class="row g-4">
        @forelse($berita as $item)
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
                        {{ Str::limit(strip_tags($item->konten), 120) }}
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

    @if($berita->hasPages())
    <div class="d-flex justify-content-center mt-5">
        {{ $berita->links() }}
    </div>
    @endif
</div>
@endsection