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
        Schema::create('pesan_komunitas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_ajak_main');
            $table->unsignedBigInteger('pengirim_id');
            $table->text('pesan');
            $table->boolean('is_read')->default(false);
            $table->timestamps();

            $table->foreign('id_ajak_main')->references('id')->on('ajak_mains')->onDelete('cascade');
            $table->foreign('pengirim_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesan_komunitas');
    }
};
