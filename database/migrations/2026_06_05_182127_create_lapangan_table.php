<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Uncomment ini jika ingin menjalankan migrate fresh di masa depan
        /*
        Schema::create('lapangan', function (Blueprint $table) {
            $table->string('id_lapangan')->primary();
            $table->string('nama_lapangan', 100);
            $table->string('jenis_lantai', 50);
            $table->integer('harga_per_jam');
            $table->time('jam_buka');
            $table->time('jam_tutup');
            $table->enum('status', ['tersedia', 'perbaikan']);
        });
        */
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lapangan');
    }
};
