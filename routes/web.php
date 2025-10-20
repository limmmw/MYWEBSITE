<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// ========================================
// PUBLIC ROUTES
// ========================================

// Halaman Beranda
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Halaman Berita Public
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');

// ========================================
// AUTHENTICATION ROUTES
// ========================================

// Generate authentication routes (login, logout)
// Register dinonaktifkan untuk keamanan
Auth::routes(['register' => false]);

// Redirect setelah login ke admin dashboard
Route::get('/home54321', function () {
    return redirect()->route('admin.dashboard');
})->middleware('auth');

// ========================================
// ADMIN ROUTES (Protected)
// ========================================

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', function () {
        $totalBerita = \App\Models\Berita::count();
        $beritaPublished = \App\Models\Berita::where('status', 'published')->count();
        $beritaDraft = \App\Models\Berita::where('status', 'draft')->count();
        $beritaTerbaru = \App\Models\Berita::with('user')->latest()->take(5)->get();
        
        return view('admin.dashboard', compact('totalBerita', 'beritaPublished', 'beritaDraft', 'beritaTerbaru'));
    })->name('dashboard');
    
    // Resource Routes untuk Berita
    // Otomatis generate: index, create, store, show, edit, update, destroy
    Route::resource('berita', AdminBeritaController::class);
    
    /* 
    Route resource di atas sama dengan:
    Route::get('/berita', [AdminBeritaController::class, 'index'])->name('berita.index');
    Route::get('/berita/create', [AdminBeritaController::class, 'create'])->name('berita.create');
    Route::post('/berita', [AdminBeritaController::class, 'store'])->name('berita.store');
    Route::get('/berita/{beritum}', [AdminBeritaController::class, 'show'])->name('berita.show');
    Route::get('/berita/{beritum}/edit', [AdminBeritaController::class, 'edit'])->name('berita.edit');
    Route::put('/berita/{beritum}', [AdminBeritaController::class, 'update'])->name('berita.update');
    Route::delete('/berita/{beritum}', [AdminBeritaController::class, 'destroy'])->name('berita.destroy');
    */
    
    // Route tambahan untuk fitur berita (opsional)
    // Route::post('/berita/{beritum}/publish', [AdminBeritaController::class, 'publish'])->name('berita.publish');
    // Route::post('/berita/{beritum}/draft', [AdminBeritaController::class, 'draft'])->name('berita.draft');
});