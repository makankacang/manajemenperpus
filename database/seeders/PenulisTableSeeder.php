<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenulisTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('penulis')->insert([
            [
                'nama' => 'Tere Liye',
                'bio' => 'Penulis novel terkenal asal Indonesia.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Andrea Hirata',
                'bio' => 'Penulis "Laskar Pelangi".',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Yuval Noah Harari',
                'bio' => 'Sejarawan dan penulis "Sapiens".',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
