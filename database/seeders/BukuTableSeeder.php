<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BukuTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('buku')->insert([
            [
                'judul' => 'Bumi',
                'isbn' => '9786021234567',
                'kategori_id' => 1,
                'penulis_id' => 1,
                'penerbit' => 'Gramedia',
                'tahun_terbit' => 2014,
                'jumlah_halaman' => 400,
                'deskripsi' => 'Novel fantasi karya Tere Liye',
                'stok' => 3,
                'cover' => 'covers/bumi.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Laskar Pelangi',
                'isbn' => '9789793062792',
                'kategori_id' => 3,
                'penulis_id' => 2,
                'penerbit' => 'Bentang Pustaka',
                'tahun_terbit' => 2005,
                'jumlah_halaman' => 529,
                'deskripsi' => 'Kisah inspiratif anak-anak Belitung.',
                'stok' => 5,
                'cover' => 'covers/laskar_pelangi.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
