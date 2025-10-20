@extends('layouts.admin')

@section('title', 'Edit Berita')

@section('content')
<div class="mb-4">
    <h2>Edit Berita</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.berita.index') }}">Berita</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.berita.update', $beritum) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="judul" class="form-label">Judul Berita <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul', $beritum->judul) }}" required>
                @error('judul')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar Berita</label>
                @if($beritum->gambar)
                    <div class="mb-2">
                        <img src="{{ Storage::url($beritum->gambar) }}" alt="{{ $beritum->judul }}" class="img-thumbnail" style="max-width: 200px;">
                        <p class="text-muted small mt-1">Gambar saat ini</p>
                    </div>
                @endif
                <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar" accept="image/*">
                <small class="text-muted">Format: JPG, JPEG, PNG. Max: 2MB. Kosongkan jika tidak ingin mengganti gambar.</small>
                @error('gambar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="konten" class="form-label">Konten Berita <span class="text-danger">*</span></label>
                <textarea class="form-control @error('konten') is-invalid @enderror" id="konten" name="konten" rows="10" required>{{ old('konten', $beritum->konten) }}</textarea>
                @error('konten')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                    <option value="published" {{ old('status', $beritum->status) == 'published' ? 'selected' : '' }}>Published</option>
                    <option value="draft" {{ old('status', $beritum->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Update Berita
                </button>
                <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection