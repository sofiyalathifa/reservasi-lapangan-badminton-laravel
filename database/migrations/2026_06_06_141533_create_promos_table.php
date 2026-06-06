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
        Schema::create('promos', function (Blueprint $table) {
            $table->id();
            $table->string('nama_promo');
            $table->string('kode_promo')->unique();
            $table->string('deskripsi');
            $table->enum('tipe_diskon', ['persen', 'nominal']);
            $table->integer('nilai_diskon');
            $table->string('tag'); // Untuk label seperti "HEMAT", "FAVORIT"
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promos');
    }
};
