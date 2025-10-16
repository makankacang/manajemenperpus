<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    protected $fillable = [
        'user_id', 'buku_id', 'kode_peminjaman',
        'tanggal_pinjam', 'tanggal_jatuh_tempo',
        'tanggal_kembali', 'status', 'catatan'
    ];

    // TAMBAHKAN CASTING INI
    protected $casts = [
        'tanggal_pinjam' => 'datetime',
        'tanggal_jatuh_tempo' => 'datetime',
        'tanggal_kembali' => 'datetime',
    ];

    // Generate kode peminjaman
    public static function generateKodePeminjaman()
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $code = '';
        
        do {
            $code = 'PJM-' . substr(str_shuffle($characters), 0, 8);
        } while (self::where('kode_peminjaman', $code)->exists());
        
        return $code;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    public function pengembalian()
    {
       return $this->hasOne(Pengembalian::class, 'peminjaman_id');
    }
}