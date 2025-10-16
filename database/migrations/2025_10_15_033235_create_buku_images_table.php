<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('buku_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buku_id')->constrained('buku')->onDelete('cascade');
            $table->string('path'); // lokasi file gambar
            $table->string('alt')->nullable();
            $table->boolean('utama')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('buku_images');
    }
};
