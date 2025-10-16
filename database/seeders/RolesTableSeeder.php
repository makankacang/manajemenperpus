<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'nama' => 'Admin',
                'keterangan' => 'Memiliki akses penuh ke sistem',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'User',
                'keterangan' => 'Pengguna umum yang dapat meminjam buku',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
