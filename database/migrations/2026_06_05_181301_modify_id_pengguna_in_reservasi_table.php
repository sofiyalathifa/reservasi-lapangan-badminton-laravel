<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Drop foreign key lama
        Schema::table('reservasi', function (Blueprint $table) {
            $table->dropForeign('id_pengguna');
        });

        // Update data lama agar menjadi angka (contoh: id 1 dari tabel users) untuk mencegah error konversi
        DB::table('reservasi')->update(['id_pengguna' => 1]);

        // 2. Ubah tipe data menjadi unsigned BIGINT agar cocok dengan tabel users
        // Menggunakan DB::statement agar aman dari issue doctrine dbal varchar to int
        DB::statement('ALTER TABLE reservasi MODIFY id_pengguna BIGINT UNSIGNED NOT NULL;');

        // 3. Tambahkan foreign key baru
        Schema::table('reservasi', function (Blueprint $table) {
            $table->foreign('id_pengguna')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservasi', function (Blueprint $table) {
            $table->dropForeign(['id_pengguna']);
        });

        DB::statement('ALTER TABLE reservasi MODIFY id_pengguna VARCHAR(255) NOT NULL;');

        Schema::table('reservasi', function (Blueprint $table) {
            // Restore old foreign key if possible
            $table->foreign('id_pengguna')->references('id_pengguna')->on('pengguna');
        });
    }
};
