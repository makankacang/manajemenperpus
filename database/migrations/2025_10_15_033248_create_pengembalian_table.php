<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pengembalian', function (Blueprint $table) {
            $table->id();

            // Relasi ke peminjaman
            $table->foreignId('peminjaman_id')
                ->constrained('peminjaman')
                ->onDelete('cascade');

            // Relasi ke user (yang meminjam)
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            // Relasi ke buku fisik yang dikembalikan
            $table->foreignId('buku_copy_id')
                ->constrained('buku_copies')
                ->onDelete('cascade');

            // Data waktu & kondisi
            $table->date('tanggal_pengembalian');
            $table->enum('kondisi_buku', ['baik', 'rusak ringan', 'rusak berat', 'hilang'])
                ->default('baik');

            // Denda (jika ada)
            $table->decimal('denda', 10, 2)->default(0);

            // Petugas yang menerima
            $table->foreignId('petugas_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null');

            // Catatan tambahan
            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('pengembalian');
    }
};
