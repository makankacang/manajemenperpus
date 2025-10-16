<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuCopy extends Model
{
    use HasFactory;

    protected $table = 'buku_copies';
    protected $fillable = [
        'buku_id', 'kode_unik', 'lokasi', 'status'
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
}