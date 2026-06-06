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
            $table->time('jam_mulai_berlaku')->nullable()->after('min_total_harga')->comment('Batas awal jam (contoh: 10:00:00)');
            $table->time('jam_selesai_berlaku')->nullable()->after('jam_mulai_berlaku')->comment('Batas akhir jam (contoh: 15:00:00)');
            $table->string('hari_berlaku')->nullable()->after('jam_selesai_berlaku')->comment('weekend, weekday, atau null (semua hari)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('promos', function (Blueprint $table) {
            $table->dropColumn(['jam_mulai_berlaku', 'jam_selesai_berlaku', 'hari_berlaku']);
        });
    }
};
