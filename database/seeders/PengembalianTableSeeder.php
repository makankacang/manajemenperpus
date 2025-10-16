<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PengembalianTableSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil data dari tabel lain untuk relasi
        $user = DB::table('users')->where('role_id', 2)->first(); // user biasa
        $petugas = DB::table('users')->where('role_id', 1)->first(); // admin/petugas
        $peminjaman = DB::table('peminjaman')->first();
        $bukuCopy = DB::table('buku_copies')->first();

        // Pastikan data terkait tersedia
        if (!$user || !$peminjaman || !$bukuCopy) {
            $this->command->warn('⚠️ Data terkait belum tersedia, jalankan seeder Users, BukuCopies, dan Peminjaman dulu!');
            return;
        }

        // Isi data pengembalian
        DB::table('pengembalian')->insert([
            [
                'peminjaman_id' => $peminjaman->id,
                'user_id' => $user->id,
                'buku_copy_id' => $bukuCopy->id,
                'tanggal_pengembalian' => Carbon::now()->subDays(1),
                'kondisi_buku' => 'baik',
                'denda' => 0,
                'petugas_id' => $petugas?->id,
                'catatan' => 'Buku dikembalikan dalam kondisi baik dan lengkap.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
