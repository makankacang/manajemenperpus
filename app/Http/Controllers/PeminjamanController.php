<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index()
    {
        if (Auth::user()->role->nama === 'Admin') {
            $peminjaman = Peminjaman::with(['user', 'buku'])->get();
        } else {
            $peminjaman = Peminjaman::with(['user', 'buku'])
                ->where('user_id', Auth::id())
                ->get();
        }
        
        return view('peminjaman.index', compact('peminjaman'));
    }

    public function create()
    {
        $users = User::all();
        $buku = Buku::where('stok', '>', 0)->get();
        
        $selectedBukuId = request('buku_id');
        
        return view('peminjaman.create', compact('users', 'buku', 'selectedBukuId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:buku,id',
            'tanggal_jatuh_tempo' => 'required|date|after:today',
        ]);

         if (!Auth::user()->hasVerifiedEmail()) {
            return redirect()->route('verification.notice')
                ->with('error', 'Anda harus memverifikasi email terlebih dahulu untuk meminjam buku.');
        }

        $buku = Buku::findOrFail($request->buku_id);

        // Cek stok buku
        if ($buku->stok <= 0) {
            return back()->with('error', 'Buku tidak tersedia untuk dipinjam!');
        }

        // Cek apakah user sudah meminjam buku yang sama
        $existingPeminjaman = Peminjaman::where('user_id', Auth::id())
            ->where('buku_id', $buku->id)
            ->whereIn('status', ['menunggu_konfirmasi', 'dipinjam'])
            ->exists();

        if ($existingPeminjaman) {
            return back()->with('error', 'Anda sudah meminjam buku ini dan belum mengembalikannya!');
        }

        // Generate kode peminjaman
        $kodePeminjaman = Peminjaman::generateKodePeminjaman();

        $peminjaman = Peminjaman::create([
            'user_id' => Auth::id(),
            'buku_id' => $buku->id,
            'kode_peminjaman' => $kodePeminjaman,
            'tanggal_pinjam' => now(),
            'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
            'status' => 'menunggu_konfirmasi',
        ]);

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil diajukan! Kode: ' . $kodePeminjaman);
    }

    public function confirm(Request $request, Peminjaman $peminjaman)
    {
        if (Auth::user()->role->nama !== 'Admin') {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'kode_konfirmasi' => 'required'
        ]);

        // Verifikasi kode konfirmasi
        if ($request->kode_konfirmasi !== $peminjaman->kode_peminjaman) {
            return back()->with('error', 'Kode konfirmasi tidak sesuai!');
        }

        $peminjaman->update([
            'status' => 'dipinjam',
            'tanggal_pinjam' => now(),
        ]);

        // Kurangi stok buku
        $buku = $peminjaman->buku;
        $buku->decrement('stok');

        return back()->with('success', 'Peminjaman berhasil dikonfirmasi!');
    }

    public function reject(Peminjaman $peminjaman)
    {
        if (Auth::user()->role->nama !== 'Admin') {
            abort(403, 'Unauthorized');
        }

        $peminjaman->update([
            'status' => 'ditolak',
            'catatan' => request('catatan', 'Peminjaman ditolak')
        ]);

        return back()->with('success', 'Peminjaman berhasil ditolak!');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        // Hanya user yang membuat peminjaman atau admin yang bisa menghapus
        if (Auth::user()->role->nama !== 'Admin' && $peminjaman->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        // Hanya bisa menghapus jika status masih menunggu konfirmasi
        if ($peminjaman->status !== 'menunggu_konfirmasi') {
            return back()->with('error', 'Peminjaman tidak dapat dibatalkan karena sudah dikonfirmasi.');
        }

        $peminjaman->delete();
        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil dibatalkan!');
    }
}