<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Kategori;
use App\Models\Penulis;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('q');
        
        if (!$query) {
            return response()->json([]);
        }

        $results = [];

        // Search Buku
        $bukuResults = Buku::with(['kategori', 'penulis', 'images'])
            ->where('judul', 'LIKE', "%{$query}%")
            ->orWhere('isbn', 'LIKE', "%{$query}%")
            ->orWhere('penerbit', 'LIKE', "%{$query}%")
            ->orWhereHas('kategori', function($q) use ($query) {
                $q->where('nama', 'LIKE', "%{$query}%");
            })
            ->orWhereHas('penulis', function($q) use ($query) {
                $q->where('nama', 'LIKE', "%{$query}%");
            })
            ->take(5)
            ->get()
            ->map(function($buku) {
                return [
                    'type' => 'buku',
                    'id' => $buku->id,
                    'title' => $buku->judul,
                    'subtitle' => $buku->penulis->nama ?? 'Penulis tidak diketahui',
                    'info' => $buku->kategori->nama ?? 'Kategori tidak diketahui',
                    'stok' => $buku->stok,
                    'url' => route('buku.show', $buku->id),
                    'image' => $buku->images->where('utama', true)->first() ? 
                              asset('storage/' . $buku->images->where('utama', true)->first()->path) : 
                              null
                ];
            });

        if ($bukuResults->isNotEmpty()) {
            $results[] = [
                'category' => 'Buku',
                'items' => $bukuResults->toArray()
            ];
        }

        // Search Peminjaman (hanya untuk admin)
        if (auth()->user()->role->nama === 'Admin') {
            $peminjamanResults = Peminjaman::with(['user', 'buku'])
                ->where('kode_peminjaman', 'LIKE', "%{$query}%")
                ->orWhereHas('user', function($q) use ($query) {
                    $q->where('name', 'LIKE', "%{$query}%");
                })
                ->orWhereHas('buku', function($q) use ($query) {
                    $q->where('judul', 'LIKE', "%{$query}%");
                })
                ->take(5)
                ->get()
                ->map(function($peminjaman) {
                    return [
                        'type' => 'peminjaman',
                        'id' => $peminjaman->id,
                        'title' => $peminjaman->kode_peminjaman,
                        'subtitle' => $peminjaman->buku->judul,
                        'info' => $peminjaman->user->name,
                        'status' => $peminjaman->status,
                        'url' => route('peminjaman.index') . '?search=' . $peminjaman->kode_peminjaman
                    ];
                });

            if ($peminjamanResults->isNotEmpty()) {
                $results[] = [
                    'category' => 'Peminjaman',
                    'items' => $peminjamanResults->toArray()
                ];
            }
        } else {
            // Untuk user biasa, hanya cari peminjaman mereka sendiri
            $peminjamanResults = Peminjaman::with(['buku'])
                ->where('user_id', auth()->id())
                ->where(function($q) use ($query) {
                    $q->where('kode_peminjaman', 'LIKE', "%{$query}%")
                      ->orWhereHas('buku', function($q2) use ($query) {
                          $q2->where('judul', 'LIKE', "%{$query}%");
                      });
                })
                ->take(5)
                ->get()
                ->map(function($peminjaman) {
                    return [
                        'type' => 'peminjaman',
                        'id' => $peminjaman->id,
                        'title' => $peminjaman->kode_peminjaman,
                        'subtitle' => $peminjaman->buku->judul,
                        'info' => 'Status: ' . $peminjaman->status,
                        'status' => $peminjaman->status,
                        'url' => route('peminjaman.index') . '?search=' . $peminjaman->kode_peminjaman
                    ];
                });

            if ($peminjamanResults->isNotEmpty()) {
                $results[] = [
                    'category' => 'Peminjaman Saya',
                    'items' => $peminjamanResults->toArray()
                ];
            }
        }

        // Search Kategori
        $kategoriResults = Kategori::where('nama', 'LIKE', "%{$query}%")
            ->take(3)
            ->get()
            ->map(function($kategori) {
                return [
                    'type' => 'kategori',
                    'id' => $kategori->id,
                    'title' => $kategori->nama,
                    'subtitle' => $kategori->deskripsi ? Str::limit($kategori->deskripsi, 50) : 'Tidak ada deskripsi',
                    'info' => $kategori->buku->count() . ' buku',
                    'url' => route('buku') . '?kategori=' . $kategori->id
                ];
            });

        if ($kategoriResults->isNotEmpty()) {
            $results[] = [
                'category' => 'Kategori',
                'items' => $kategoriResults->toArray()
            ];
        }

        // Search Penulis
        $penulisResults = Penulis::where('nama', 'LIKE', "%{$query}%")
            ->take(3)
            ->get()
            ->map(function($penulis) {
                return [
                    'type' => 'penulis',
                    'id' => $penulis->id,
                    'title' => $penulis->nama,
                    'subtitle' => $penulis->bio ? Str::limit($penulis->bio, 50) : 'Tidak ada bio',
                    'info' => $penulis->buku->count() . ' buku',
                    'url' => route('buku') . '?penulis=' . $penulis->id
                ];
            });

        if ($penulisResults->isNotEmpty()) {
            $results[] = [
                'category' => 'Penulis',
                'items' => $penulisResults->toArray()
            ];
        }

        return response()->json($results);
    }
}