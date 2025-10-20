@extends('layouts.admin')

@section('title', 'Kelola Berita')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Kelola Berita</h2>
    <a href="{{ route('admin.berita.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Berita
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="10%">Gambar</th>
                        <th>Judul</th>
                        <th width="12%">Penulis</th>
                        <th width="12%">Tanggal</th>
                        <th width="10%">Status</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($berita as $item)
                    <tr>
                        <td>{{ $loop->iteration + ($berita->currentPage() - 1) * $berita->perPage() }}</td>
                        <td>
                            @if($item->gambar)
                                <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->judul }}" class="img-thumbnail" style="max-width: 80px;">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->tanggal_publish->format('d M Y') }}</td>
                        <td>
                            @if($item->status == 'published')
                                <span class="badge bg-success">Published</span>
                            @else
                                <span class="badge bg-warning">Draft</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.berita.edit', $item) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.berita.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <p class="text-muted mb-0">Belum ada berita. <a href="{{ route('admin.berita.create') }}">Tambah berita pertama</a></p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($berita->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $berita->links() }}
        </div>
        @endif
    </div>
</div>
@endsection