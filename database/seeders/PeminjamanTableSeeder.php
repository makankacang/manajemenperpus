<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PeminjamanTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('peminjaman')->insert([
            [
                'user_id' => 2, // user biasa
                'buku_copy_id' => 2,
                'tanggal_pinjam' => Carbon::now()->subDays(2),
                'tanggal_jatuh_tempo' => Carbon::now()->addDays(5),
                'tanggal_kembali' => null,
                'status' => 'dipinjam',
                'catatan' => 'Dipinjam oleh User',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
