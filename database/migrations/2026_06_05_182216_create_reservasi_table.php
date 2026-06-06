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
        /*
        Schema::create('reservasi', function (Blueprint $table) {
            $table->string('id_reservasi')->primary();
            $table->unsignedBigInteger('id_pengguna');
            $table->string('id_lapangan');
            $table->date('tanggal_booking');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->integer('durasi');
            $table->decimal('total_biaya', 10, 2);
            $table->enum('status_reservasi', ['pending', 'dikonfirmasi', 'dibatalkan']);
            $table->timestamp('created_at')->useCurrent();
            
            $table->foreign('id_pengguna')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_lapangan')->references('id_lapangan')->on('lapangan')->onDelete('cascade');
        });
        */
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasi');
    }
};
