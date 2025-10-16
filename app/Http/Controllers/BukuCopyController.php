<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\BukuCopy;
use Illuminate\Http\Request;

class BukuCopyController extends Controller
{
    public function index()
    {
        $copies = BukuCopy::with('buku')->get();
        return view('buku_copies.index', compact('copies'));
    }

    public function create()
    {
        $buku = Buku::all();
        return view('buku_copies.create', compact('buku'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:buku,id',
            'kode_unik' => 'required|unique:buku_copies,kode_unik',
            'lokasi' => 'nullable|string|max:255',
            'status' => 'in:tersedia,dipinjam,hilang,rusak'
        ]);

        BukuCopy::create($request->all());
        return redirect()->route('buku_copies.index')->with('success', 'Copy buku berhasil ditambahkan!');
    }

    public function edit(BukuCopy $bukuCopy)
    {
        $buku = Buku::all();
        return view('buku_copies.edit', compact('bukuCopy', 'buku'));
    }

    public function update(Request $request, BukuCopy $bukuCopy)
    {
        $request->validate([
            'buku_id' => 'required|exists:buku,id',
            'status' => 'in:tersedia,dipinjam,hilang,rusak'
        ]);

        $bukuCopy->update($request->all());
        return redirect()->route('buku_copies.index')->with('success', 'Copy buku berhasil diperbarui!');
    }

    public function destroy(BukuCopy $bukuCopy)
    {
        $bukuCopy->delete();
        return redirect()->route('buku_copies.index')->with('success', 'Copy buku berhasil dihapus!');
    }
}
