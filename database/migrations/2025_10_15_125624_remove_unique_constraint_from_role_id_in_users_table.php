<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus unique index jika ada
            $table->dropUnique(['role_id']);
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Kembalikan unique index (jangan dilakukan kecuali memang diperlukan)
            // $table->unique('role_id');
        });
    }
};