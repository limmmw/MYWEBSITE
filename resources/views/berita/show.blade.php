@extends('layouts.app')

@section('title', $berita->judul)

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-lg-8">
            <article>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('berita.index') }}">Berita</a></li>
                        <li class="breadcrumb-item active">{{ Str::limit($berita->judul, 30) }}</li>
                    </ol>
                </nav>

                <h1 class="mb-3">{{ $berita->judul }}</h1>
                
                <div class="text-muted mb-4">
                    <i class="bi bi-calendar"></i> {{ $berita->tanggal_publish->format('d F Y') }}
                    <span class="mx-2">|</span>
                    <i class="bi bi-person"></i> {{ $berita->user->name }}
                </div>

                @if($berita->gambar)
                    <img src="{{ Storage::url($berita->gambar) }}" class="img-fluid rounded mb-4" alt="{{ $berita->judul }}">
                @endif

                <div class="content" style="line-height: 1.8; text-align: justify;">
                    {!! nl2br(e($berita->konten)) !!}
                </div>

                <hr class="my-5">

                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('berita.index') }}" class="btn btn-outline-success">
                        <i class="bi bi-arrow-left"></i> Kembali ke Berita
                    </a>
                    <div>
                        <small class="text-muted">Bagikan:</small>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('berita.show', $berita->slug)) }}" target="_blank" class="btn btn-sm btn-outline-primary ms-2">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('berita.show', $berita->slug)) }}&text={{ urlencode($berita->judul) }}" target="_blank" class="btn btn-sm btn-outline-info">
                            <i class="bi bi-twitter"></i>
                        </a>
                        <a href="https://api.whatsapp.com/send?text={{ urlencode($berita->judul . ' ' . route('berita.show', $berita->slug)) }}" target="_blank" class="btn btn-sm btn-outline-success">
                            <i class="bi bi-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </article>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="bi bi-newspaper"></i> Berita Terkait</h5>
                </div>
                <div class="card-body">
                    @forelse($beritaTerkait as $item)
                        <div class="mb-3 pb-3 @if(!$loop->last) border-bottom @endif">
                            <h6>
                                <a href="{{ route('berita.show', $item->slug) }}" class="text-decoration-none text-dark">
                                    {{ $item->judul }}
                                </a>
                            </h6>
                            <small class="text-muted">
                                <i class="bi bi-calendar"></i> {{ $item->tanggal_publish->format('d M Y') }}
                            </small>
                        </div>
                    @empty
                        <p class="text-muted mb-0">Belum ada berita lainnya.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection