<?php

namespace App\Http\Controllers;

use App\Models\Penulis;
use Illuminate\Http\Request;

class PenulisController extends Controller
{
    public function index()
    {
        $penulis = Penulis::withCount('buku')->with('buku')->get();
        return view('penulis.penulis', compact('penulis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:penulis,nama',
            'bio' => 'nullable|string',
        ]);

        Penulis::create($request->all());
        return redirect()->route('penulis.index')->with('success', 'Penulis berhasil ditambahkan!');
    }

    public function update(Request $request, Penulis $penulis)
    {
        $request->validate([
            'nama' => 'required|unique:penulis,nama,' . $penulis->id,
            'bio' => 'nullable|string',
        ]);

        $penulis->update($request->all());
        return redirect()->route('penulis.index')->with('success', 'Penulis berhasil diperbarui!');
    }

    public function destroy(Penulis $penulis)
    {
        // Cek apakah penulis digunakan oleh buku
        if ($penulis->buku()->count() > 0) {
            return redirect()->route('penulis.index')
                ->with('error', 'Tidak dapat menghapus penulis karena masih digunakan oleh ' . $penulis->buku()->count() . ' buku.');
        }

        $penulis->delete();
        return redirect()->route('penulis.index')->with('success', 'Penulis berhasil dihapus!');
    }
}