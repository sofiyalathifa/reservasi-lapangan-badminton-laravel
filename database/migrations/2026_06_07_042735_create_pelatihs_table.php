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
        Schema::create('pelatihs', function (Blueprint $table) {
            $table->id('id_pelatih');
            $table->string('nama_pelatih');
            $table->string('spesialisasi');
            $table->enum('target_level', ['Beginner', 'Intermediate', 'Advanced']);
            $table->integer('harga_per_sesi');
            $table->decimal('rating', 3, 1)->default(0);
            $table->string('foto_pelatih')->nullable();
            $table->text('deskripsi')->nullable();
            $table->boolean('status_aktif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelatihs');
    }
};
