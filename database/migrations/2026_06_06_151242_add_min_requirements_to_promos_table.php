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
        Schema::table('promos', function (Blueprint $table) {
            $table->integer('min_durasi')->nullable()->after('tanggal_berakhir')->comment('Minimal durasi pemesanan (jam)');
            $table->integer('min_total_harga')->nullable()->after('min_durasi')->comment('Minimal total harga pesanan (Rp)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('promos', function (Blueprint $table) {
            $table->dropColumn(['min_durasi', 'min_total_harga']);
        });
    }
};
