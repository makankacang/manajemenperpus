<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            // Nonaktifkan foreign key checks sementara
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            
            // Coba hapus foreign key yang mungkin ada
            $foreignKeys = DB::select("
                SELECT CONSTRAINT_NAME 
                FROM information_schema.KEY_COLUMN_USAGE 
                WHERE TABLE_NAME = 'peminjaman' 
                AND COLUMN_NAME = 'buku_id' 
                AND REFERENCED_TABLE_NAME IS NOT NULL
            ");
            
            foreach ($foreignKeys as $fk) {
                $table->dropForeign($fk->CONSTRAINT_NAME);
            }
            
            // Aktifkan kembali foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            
            // Tambahkan foreign key yang benar ke tabel buku
            $table->foreign('buku_id')->references('id')->on('buku')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            // Nonaktifkan foreign key checks sementara
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            
            // Hapus foreign key yang kita buat
            $table->dropForeign(['buku_id']);
            
            // Aktifkan kembali foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        });
    }
};