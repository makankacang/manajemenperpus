<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'rey',
                'email' => 'rey@gmail.com',
                'password' => Hash::make('12345'),
                'role_id' => 1,
                'email_verified_at' => now(), // TAMBAHKAN INI
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'inay',
                'email' => 'inay@gmail.com',
                'password' => Hash::make('12345'),
                'role_id' => 2,
                'email_verified_at' => now(), // TAMBAHKAN INI
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        $this->call([
            RolesTableSeeder::class,
            KategoriTableSeeder::class,
            PenulisTableSeeder::class,
            BukuTableSeeder::class,
            BukuCopiesTableSeeder::class,
            BukuImagesTableSeeder::class,
            PeminjamanTableSeeder::class,
            PengembalianTableSeeder::class, // aktifin kalau tabelnya udah ada
        ]);


    }
}
