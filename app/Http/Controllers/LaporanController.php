<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Buku;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Penulis;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    // Method yang sudah ada
    public function peminjaman()
    {
        $peminjaman = Peminjaman::with(['user', 'buku'])
            ->where('status', 'dipinjam')
            ->get();
            
        return view('laporan.peminjaman', compact('peminjaman'));
    }

    public function pengembalian()
    {
        $pengembalian = Pengembalian::with(['peminjaman', 'user', 'buku', 'petugas'])
            ->latest()
            ->get();
            
        return view('laporan.pengembalian', compact('pengembalian'));
    }

    public function semuaPeminjaman()
    {
        $peminjaman = Peminjaman::with(['user', 'buku'])
            ->latest()
            ->get();
            
        return view('laporan.semua-peminjaman', compact('peminjaman'));
    }

    public function printInvoice($id)
    {
        $pengembalian = Pengembalian::with(['peminjaman', 'user', 'buku', 'petugas'])
            ->findOrFail($id);
            
        return view('laporan.invoice', compact('pengembalian'));
    }

    // Method baru untuk semua data
    public function semuaPengembalian()
    {
        $pengembalian = Pengembalian::with(['peminjaman', 'user', 'buku', 'petugas'])
            ->latest()
            ->get();
            
        return view('laporan.semua-pengembalian', compact('pengembalian'));
    }

    public function dataBuku()
    {
        $buku = Buku::with(['kategori', 'penulis'])
            ->latest()
            ->get();
            
        return view('laporan.data-buku', compact('buku'));
    }

    public function dataAnggota()
    {
        $anggota = User::with('role')
            ->whereHas('role', function($query) {
                $query->where('nama', '!=', 'Admin');
            })
            ->latest()
            ->get();
            
        return view('laporan.data-anggota', compact('anggota'));
    }

    public function statistik()
    {
        $totalBuku = Buku::count();
        $totalAnggota = User::whereHas('role', function($query) {
            $query->where('nama', '!=', 'Admin');
        })->count();
        $totalPeminjaman = Peminjaman::count();
        $totalPengembalian = Pengembalian::count();
        $peminjamanAktif = Peminjaman::where('status', 'dipinjam')->count();
        $totalDenda = Pengembalian::sum('denda');
        
        $bukuPopuler = Buku::withCount('peminjaman')
            ->orderBy('peminjaman_count', 'desc')
            ->take(5)
            ->get();
            
        return view('laporan.statistik', compact(
            'totalBuku', 'totalAnggota', 'totalPeminjaman', 
            'totalPengembalian', 'peminjamanAktif', 'totalDenda', 'bukuPopuler'
        ));
    }
}