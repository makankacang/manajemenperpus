<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kategori')->insert([
            [
                'nama' => 'Fiksi',
                'deskripsi' => 'Cerita rekaan atau khayalan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Teknologi',
                'deskripsi' => 'Buku tentang ilmu pengetahuan dan teknologi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Sejarah',
                'deskripsi' => 'Buku yang membahas sejarah dan peradaban',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

