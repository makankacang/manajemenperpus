<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::withCount('buku')->with('buku')->get();
        return view('kategori.kategori', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:kategori,nama',
            'deskripsi' => 'nullable|string'
        ]);

        Kategori::create($request->all());
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama' => 'required|unique:kategori,nama,' . $kategori->id,
            'deskripsi' => 'nullable|string'
        ]);

        $kategori->update($request->all());
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(Kategori $kategori)
    {
        // Cek apakah kategori digunakan oleh buku
        if ($kategori->buku()->count() > 0) {
            return redirect()->route('kategori.index')
                ->with('error', 'Tidak dapat menghapus kategori karena masih digunakan oleh ' . $kategori->buku()->count() . ' buku.');
        }

        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus!');
    }
}