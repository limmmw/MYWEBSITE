@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Dashboard</h2>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle mb-2">Total Berita</h6>
                        <h2 class="card-title mb-0">{{ $totalBerita }}</h2>
                    </div>
                    <i class="bi bi-newspaper" style="font-size: 3rem; opacity: 0.5;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle mb-2">Berita Published</h6>
                        <h2 class="card-title mb-0">{{ $beritaPublished }}</h2>
                    </div>
                    <i class="bi bi-check-circle" style="font-size: 3rem; opacity: 0.5;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle mb-2">Berita Draft</h6>
                        <h2 class="card-title mb-0">{{ $beritaDraft }}</h2>
                    </div>
                    <i class="bi bi-file-earmark-text" style="font-size: 3rem; opacity: 0.5;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Selamat Datang di Portal Desa Admin</h5>
            </div>
            <div class="card-body">
                <p>Anda login sebagai: <strong>{{ Auth::user()->name }}</strong></p>
                <p>Email: <strong>{{ Auth::user()->email }}</strong></p>
                <p>Gunakan menu di atas untuk mengelola berita desa.</p>
                <a href="{{ route('admin.berita.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Buat Berita Baru
                </a>
            </div>
        </div>
    </div>
</div>
@endsection