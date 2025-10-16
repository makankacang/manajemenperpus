<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penulis;
use App\Models\BukuImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function index()
    {
        $buku = Buku::with(['kategori', 'penulis', 'images'])->paginate(12);
        $kategories = Kategori::all();
        $penulis = Penulis::all();
        
        return view('buku.buku', compact('buku', 'kategories', 'penulis'));
    }

    public function create()
    {
        // Tidak perlu method terpisah, sudah handle di index
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isbn' => 'nullable|string|max:20',
            'kategori_id' => 'required|exists:kategori,id',
            'penulis_id' => 'required|exists:penulis,id',
            'penerbit' => 'nullable|string|max:255',
            'tahun_terbit' => 'nullable|integer|min:1900|max:' . date('Y'),
            'jumlah_halaman' => 'nullable|integer|min:1',
            'deskripsi' => 'nullable|string',
            'stok' => 'required|integer|min:0',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'additional_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Buat buku
        $buku = Buku::create($validated);

        // Handle upload cover image (gambar utama)
        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')->store('buku-images', 'public');
            
            BukuImage::create([
                'buku_id' => $buku->id,
                'path' => $coverPath,
                'alt' => $validated['judul'],
                'utama' => true
            ]);
        }

        // Handle upload additional images
        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $image) {
                $imagePath = $image->store('buku-images', 'public');
                
                BukuImage::create([
                    'buku_id' => $buku->id,
                    'path' => $imagePath,
                    'alt' => $validated['judul'],
                    'utama' => false
                ]);
            }
        }

        return redirect()->route('buku')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function show(Buku $buku)
    {
        $buku->load(['kategori', 'penulis', 'images']);
        return view('buku.show', compact('buku'));
    }

    public function edit(Buku $buku)
    {
        $buku->load('images');
        $kategories = Kategori::all();
        $penulises = Penulis::all();
        
        return view('buku.edit', compact('buku', 'kategories', 'penulises'));
    }

public function update(Request $request, Buku $buku)
{
    \Log::info('=== UPDATE BUKU START ===');
    \Log::info('Request Data:', $request->all());
    \Log::info('Files:', $request->allFiles());

    try {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isbn' => 'nullable|string|max:20',
            'kategori_id' => 'required|exists:kategori,id',
            'penulis_id' => 'required|exists:penulis,id',
            'penerbit' => 'nullable|string|max:255',
            'tahun_terbit' => 'nullable|integer|min:1900|max:' . date('Y'),
            'jumlah_halaman' => 'nullable|integer|min:1',
            'deskripsi' => 'nullable|string',
            'stok' => 'required|integer|min:0',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'additional_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        \Log::info('Validated Data:', $validated);

        // Update data buku
        $buku->update($validated);
        \Log::info('Buku updated successfully');

        // Handle upload cover image baru
        if ($request->hasFile('cover_image')) {
            \Log::info('Processing cover image');
            // Hapus cover lama jika ada
            $oldCover = $buku->images()->where('utama', true)->first();
            if ($oldCover) {
                Storage::disk('public')->delete($oldCover->path);
                $oldCover->delete();
            }

            // Simpan cover baru
            $coverPath = $request->file('cover_image')->store('buku-images', 'public');
            BukuImage::create([
                'buku_id' => $buku->id,
                'path' => $coverPath,
                'alt' => $validated['judul'],
                'utama' => true
            ]);
        }

        // Handle upload additional images baru
        if ($request->hasFile('additional_images')) {
            \Log::info('Processing additional images');
            foreach ($request->file('additional_images') as $image) {
                $imagePath = $image->store('buku-images', 'public');
                
                BukuImage::create([
                    'buku_id' => $buku->id,
                    'path' => $imagePath,
                    'alt' => $validated['judul'],
                    'utama' => false
                ]);
            }
        }

        \Log::info('=== UPDATE BUKU SUCCESS ===');

        return redirect()->route('buku')
            ->with('success', 'Buku "' . $validated['judul'] . '" berhasil diperbarui!');

    } catch (\Illuminate\Validation\ValidationException $e) {
        \Log::error('Validation Error:', $e->errors());
        throw $e;
    } catch (\Exception $e) {
        \Log::error('Update Error: ' . $e->getMessage());
        \Log::error('Stack Trace: ' . $e->getTraceAsString());
        return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}

    // Method untuk menghapus gambar individual
    public function deleteImage(BukuImage $image)
    {
        // Jangan izinkan hapus jika ini satu-satunya gambar
        $buku = $image->buku;
        if ($buku->images->count() <= 1) {
            return back()->with('error', 'Tidak dapat menghapus gambar. Buku harus memiliki minimal satu gambar.');
        }

        Storage::disk('public')->delete($image->path);
        $image->delete();

        // Jika yang dihapus adalah cover, set gambar lain sebagai cover
        if ($image->utama && $buku->images->count() > 0) {
            $newCover = $buku->images()->first();
            $newCover->update(['utama' => true]);
        }

        return back()->with('success', 'Gambar berhasil dihapus!');
    }

    // Method untuk mengatur gambar sebagai cover
    public function setAsCover(BukuImage $image)
    {
        // Set semua gambar buku ini sebagai non-utama
        BukuImage::where('buku_id', $image->buku_id)->update(['utama' => false]);

        // Set gambar ini sebagai utama
        $image->update(['utama' => true]);

        return back()->with('success', 'Cover berhasil diubah!');
    }

    public function destroy(Buku $buku)
    {
        // Hapus semua gambar buku
        $images = $buku->images;
        foreach ($images as $image) {
            Storage::disk('public')->delete($image->path);
            $image->delete();
        }

        $judulBuku = $buku->judul;
        $buku->delete();

        return redirect()->route('buku')
            ->with('success', 'Buku "' . $judulBuku . '" berhasil dihapus!');
    }
}