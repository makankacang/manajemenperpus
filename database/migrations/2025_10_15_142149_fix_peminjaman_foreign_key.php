<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            // Hapus foreign key yang salah (berdasarkan error sebelumnya, namanya adalah 'peminjaman_buku_copy_id_foreign')
            $table->dropForeign(['buku_id']); // Ini akan menghapus foreign key yang terkait dengan kolom buku_id
            // Atau jika tidak berhasil, coba dengan nama constraint yang spesifik:
            // $table->dropForeign('peminjaman_buku_copy_id_foreign');
            
            // Tambahkan foreign key yang benar ke tabel buku
            $table->foreign('buku_id')->references('id')->on('buku')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->dropForeign(['buku_id']);
            // Kembalikan ke foreign key lama (ke buku_copies)
            $table->foreign('buku_id')->references('id')->on('buku_copies')->onDelete('cascade');
        });
    }
};