<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';
    protected $fillable = [
        'judul', 'isbn', 'kategori_id', 'penulis_id',
        'penerbit', 'tahun_terbit', 'jumlah_halaman',
        'deskripsi', 'stok'
    ];

    // Relasi ke Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    // Relasi ke Penulis
    public function penulis()
    {
        return $this->belongsTo(Penulis::class);
    }

    // Relasi ke Gambar Buku
    public function images()
    {
        return $this->hasMany(BukuImage::class);
    }

        public function copies()
        {
            return $this->hasMany(BukuCopy::class);
        }

        // Tambahkan method untuk cek ketersediaan
        public function getAvailableCopiesAttribute()
        {
            return $this->copies()->where('status', 'tersedia')->count();
        }

    public function getCoverAttribute()
    {
        $coverImage = $this->images()->where('utama', true)->first();
        return $coverImage ? $coverImage->path : null;
    }

    public function getAdditionalImagesAttribute()
    {
        return $this->images()->where('utama', false)->get();
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
}