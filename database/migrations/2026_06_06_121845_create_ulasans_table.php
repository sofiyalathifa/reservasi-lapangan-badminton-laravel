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
        Schema::create('ulasans', function (Blueprint $table) {
            $table->id();
            $table->string('id_reservasi');
            $table->string('id_lapangan');
            $table->unsignedBigInteger('id_user');
            $table->integer('rating');
            $table->text('komentar')->nullable();
            $table->timestamps();

            // Referensi foreign key (opsional, sesuaikan dengan database schema)
            // $table->foreign('id_reservasi')->references('id_reservasi')->on('reservasis')->onDelete('cascade');
            // $table->foreign('id_lapangan')->references('id_lapangan')->on('lapangans')->onDelete('cascade');
            // $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ulasans');
    }
};
