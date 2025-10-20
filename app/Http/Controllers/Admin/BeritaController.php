<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::with('user')->latest()->paginate(10);
        return view('admin.berita.index', compact('berita'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'konten' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:draft,published'
        ]);

        $validated['user_id'] = auth()->id();
        $validated['slug'] = Str::slug($request->judul);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        Berita::create($validated);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan');
    }

    public function edit(Berita $beritum)
    {
        return view('admin.berita.edit', compact('beritum'));
    }

    public function update(Request $request, Berita $beritum)
    {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'konten' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:draft,published'
        ]);

        $validated['slug'] = Str::slug($request->judul);

        if ($request->hasFile('gambar')) {
            if ($beritum->gambar) {
                Storage::disk('public')->delete($beritum->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        $beritum->update($validated);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diupdate');
    }

    public function destroy(Berita $beritum)
    {
        if ($beritum->gambar) {
            Storage::disk('public')->delete($beritum->gambar);
        }

        $beritum->delete();

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus');
    }
}