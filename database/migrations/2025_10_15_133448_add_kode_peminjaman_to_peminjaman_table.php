<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->string('kode_peminjaman')->unique()->after('id');
            $table->enum('status', ['menunggu_konfirmasi', 'dipinjam', 'dikembalikan', 'ditolak'])->default('menunggu_konfirmasi')->change();
        });
    }

    public function down()
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->dropColumn('kode_peminjaman');
        });
    }
};