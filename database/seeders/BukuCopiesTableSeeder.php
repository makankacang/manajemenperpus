<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BukuCopiesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('buku_copies')->insert([
            [
                'buku_id' => 1,
                'kode_unik' => 'B001-A',
                'lokasi' => 'Rak A1',
                'status' => 'tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'buku_id' => 1,
                'kode_unik' => 'B001-B',
                'lokasi' => 'Rak A1',
                'status' => 'dipinjam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'buku_id' => 2,
                'kode_unik' => 'B002-A',
                'lokasi' => 'Rak B2',
                'status' => 'tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
