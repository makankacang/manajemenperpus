<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuImage extends Model
{
    use HasFactory;

    protected $table = 'buku_images';
    protected $fillable = ['buku_id', 'path', 'alt', 'utama'];

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}
