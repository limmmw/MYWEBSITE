<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::where('status', 'published')
            ->latest('tanggal_publish')
            ->paginate(9);
        
        return view('berita.index', compact('berita'));
    }

    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();
        
        // Berita terkait (3 berita terbaru selain yang sedang dibuka)
        $beritaTerkait = Berita::where('status', 'published')
            ->where('id', '!=', $berita->id)
            ->latest('tanggal_publish')
            ->take(3)
            ->get();
        
        return view('berita.show', compact('berita', 'beritaTerkait'));
    }
}