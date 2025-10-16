<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalian = Pengembalian::with(['peminjaman.user', 'peminjaman.buku', 'petugas'])->get();

        return view('pengembalian.index', compact('pengembalian'));
    }

    public function create()
    {
        // Ambil peminjaman yang statusnya 'dipinjam'
        $peminjaman = Peminjaman::where('status', 'dipinjam')
            ->with(['user', 'buku'])
            ->get();

        return view('pengembalian.create', compact('peminjaman'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjaman,id',
            'tanggal_pengembalian' => 'required|date',
            'kondisi_buku' => 'required|in:baik,rusak_ringan,rusak_berat,hilang',
            'catatan' => 'nullable|string|max:500',
        ]);

        $peminjaman = Peminjaman::with('buku')->findOrFail($request->peminjaman_id);

        // Hitung denda
        $tanggalPengembalian = Carbon::parse($request->tanggal_pengembalian);
        $jatuhTempo = Carbon::parse($peminjaman->tanggal_jatuh_tempo);
        $hariTerlambat = $tanggalPengembalian->greaterThan($jatuhTempo)
            ? $tanggalPengembalian->diffInDays($jatuhTempo)
            : 0;

        $denda = $hariTerlambat * 5000; // Denda Rp 5.000 per hari

        // Tambahkan denda untuk kondisi buku rusak atau hilang
        if ($request->kondisi_buku == 'rusak_ringan') {
            $denda += 10000;
        } elseif ($request->kondisi_buku == 'rusak_berat') {
            $denda += 50000;
        } elseif ($request->kondisi_buku == 'hilang') {
            $denda += $peminjaman->buku->harga ?? 100000; // Ganti buku jika hilang
        }

        // Simpan data pengembalian
        $pengembalian = Pengembalian::create([
            'peminjaman_id' => $peminjaman->id,
            'user_id' => $peminjaman->user_id,
            'buku_id' => $peminjaman->buku_id,
            'tanggal_pengembalian' => $tanggalPengembalian,
            'kondisi_buku' => $request->kondisi_buku,
            'denda' => $denda,
            'catatan' => $request->catatan,
            'petugas_id' => Auth::id(),
        ]);

        // Update status peminjaman
        $peminjaman->update([
            'status' => 'dikembalikan',
            'tanggal_kembali' => $tanggalPengembalian,
        ]);

        // Tambah stok buku jika tidak hilang
        if ($request->kondisi_buku != 'hilang') {
            $peminjaman->buku->increment('stok');
        }

        return redirect()->route('pengembalian.index')
            ->with('success', 'Pengembalian berhasil diproses!');
    }

    public function destroy(Pengembalian $pengembalian)
{
    // Kembalikan status peminjaman dan stok buku
    $peminjaman = $pengembalian->peminjaman;
    
    if ($pengembalian->kondisi_buku != 'hilang') {
        $peminjaman->buku->decrement('stok');
    }
    
    $peminjaman->update([
        'status' => 'dipinjam',
        'tanggal_kembali' => null,
    ]);

    $pengembalian->delete();

    return redirect()->route('pengembalian.index')
        ->with('success', 'Data pengembalian berhasil dihapus!');
}
}
