<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('buku_copies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buku_id')->constrained('buku')->onDelete('cascade');
            $table->string('kode_unik')->unique(); // bisa jadi barcode atau kode inventaris
            $table->string('lokasi')->nullable(); // rak / lemari
            $table->enum('status', ['tersedia', 'dipinjam', 'hilang', 'rusak'])->default('tersedia');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('buku_copies');
    }
};
