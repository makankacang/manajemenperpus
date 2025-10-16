<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('isbn')->nullable()->unique();
            $table->foreignId('kategori_id')->nullable()->constrained('kategori')->onDelete('set null');
            $table->foreignId('penulis_id')->nullable()->constrained('penulis')->onDelete('set null');
            $table->string('penerbit')->nullable();
            $table->year('tahun_terbit')->nullable();
            $table->integer('jumlah_halaman')->nullable();
            $table->text('deskripsi')->nullable();
            $table->integer('stok')->default(0);
            $table->string('cover')->nullable(); // file path ke cover utama
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('buku');
    }
};
