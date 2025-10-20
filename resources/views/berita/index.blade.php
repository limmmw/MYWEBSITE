@extends('layouts.app')

@section('title', 'Berita Desa')

@section('content')
<div class="bg-success text-white py-5">
    <div class="container">
        <h1 class="display-4 mb-2">Berita Desa</h1>
        <p class="lead">Informasi dan berita terkini dari desa kami</p>
        
        @if(request('search'))
            <div class="alert alert-light mt-3" role="alert">
                <i class="bi bi-search"></i> Hasil pencarian untuk: <strong>"{{ request('search') }}"</strong>
                <a href="{{ route('berita.index') }}" class="btn btn-sm btn-outline-light ms-2">
                    <i class="bi bi-x"></i> Hapus Filter
                </a>
            </div>
        @endif
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
                @if(request('search'))
                    <i class="bi bi-info-circle"></i> Tidak ada berita yang ditemukan untuk kata kunci "{{ request('search') }}".
                @else
                    <i class="bi bi-info-circle"></i> Belum ada berita yang dipublikasikan.
                @endif
            </div>
        </div>
        @endforelse
    </div>

    @if($berita->hasPages())
    <div class="d-flex justify-content-center mt-5">
        {{ $berita->appends(['search' => request('search')])->links() }}
    </div>
    @endif
</div>
@endsection