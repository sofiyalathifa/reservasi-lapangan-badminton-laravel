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
        Schema::create('ajak_mains', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_cari_teman');
            $table->unsignedBigInteger('pengirim_id');
            $table->unsignedBigInteger('penerima_id');
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();

            $table->foreign('id_cari_teman')->references('id')->on('cari_temans')->onDelete('cascade');
            $table->foreign('pengirim_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('penerima_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ajak_mains');
    }
};
