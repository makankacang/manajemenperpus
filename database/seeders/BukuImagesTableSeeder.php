<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BukuImagesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('buku_images')->insert([
            [
                'buku_id' => 1,
                'path' => 'images/bumi1.jpg',
                'alt' => 'Cover Buku Bumi',
                'utama' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'buku_id' => 2,
                'path' => 'images/laskar1.jpg',
                'alt' => 'Cover Buku Laskar Pelangi',
                'utama' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
