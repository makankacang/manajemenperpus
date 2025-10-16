<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\PenulisController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Email Verification Routes - Custom untuk redirect ke dashboard
Route::get('/email/verify', function () {
    return redirect()->route('dashboard')->with('verification_required', true);
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

// Dashboard - accessible by all authenticated users dengan alert
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Routes yang membutuhkan verifikasi email
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('buku', BukuController::class)->names([
        'index' => 'buku',
        'create' => 'buku.create',
        'store' => 'buku.store', 
        'show' => 'buku.show',
        'edit' => 'buku.edit',
        'update' => 'buku.update',
        'destroy' => 'buku.destroy'
    ]);

    Route::resource('kategori', KategoriController::class)->except(['create', 'edit']);
    Route::resource('penulis', PenulisController::class)->except(['create', 'edit']);
    Route::get('/search', [App\Http\Controllers\SearchController::class, 'search'])->name('search');

    // Peminjaman - HANYA untuk user terverifikasi
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::get('/peminjaman/create', [PeminjamanController::class, 'create'])->name('peminjaman.create');
    Route::post('/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');
    Route::post('/peminjaman/{peminjaman}/confirm', [PeminjamanController::class, 'confirm'])->name('peminjaman.confirm');
    Route::put('/peminjaman/{peminjaman}/reject', [PeminjamanController::class, 'reject'])->name('peminjaman.reject');
    Route::delete('/peminjaman/{peminjaman}', [PeminjamanController::class, 'destroy'])->name('peminjaman.destroy');

    // Pengembalian - HANYA untuk user terverifikasi
    Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
    Route::get('/pengembalian/create', [PengembalianController::class, 'create'])->name('pengembalian.create');
    Route::post('/pengembalian', [PengembalianController::class, 'store'])->name('pengembalian.store');
    Route::delete('/pengembalian/{pengembalian}', [PengembalianController::class, 'destroy'])->name('pengembalian.destroy');

    Route::post('/buku-images/{image}/set-cover', [BukuController::class, 'setAsCover'])
        ->name('buku.images.set-cover');
    Route::delete('/buku-images/{image}', [BukuController::class, 'deleteImage'])
        ->name('buku.images.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('laporan')->group(function () {
    Route::get('/peminjaman', [LaporanController::class, 'peminjaman'])->name('laporan.peminjaman');
    Route::get('/pengembalian', [LaporanController::class, 'pengembalian'])->name('laporan.pengembalian');
    Route::get('/semua-peminjaman', [LaporanController::class, 'semuaPeminjaman'])->name('laporan.semua-peminjaman');
    Route::get('/semua-pengembalian', [LaporanController::class, 'semuaPengembalian'])->name('laporan.semua-pengembalian');
    Route::get('/data-buku', [LaporanController::class, 'dataBuku'])->name('laporan.data-buku');
    Route::get('/data-anggota', [LaporanController::class, 'dataAnggota'])->name('laporan.data-anggota');
    Route::get('/statistik', [LaporanController::class, 'statistik'])->name('laporan.statistik');
    Route::get('/invoice/{id}', [LaporanController::class, 'printInvoice'])->name('laporan.invoice');
});

Route::middleware(['auth', 'verified', 'role:Admin'])->group(function () {
    Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota.index');
    Route::put('/anggota/{user}/update-role', [AnggotaController::class, 'updateRole'])->name('anggota.update-role');
    Route::delete('/anggota/{user}', [AnggotaController::class, 'destroy'])->name('anggota.destroy');
});

require __DIR__.'/auth.php';