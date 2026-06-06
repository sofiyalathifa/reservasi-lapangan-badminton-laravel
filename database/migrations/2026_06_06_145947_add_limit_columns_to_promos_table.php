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
            $table->integer('kuota_total')->nullable()->after('status')->comment('Maksimal kuota global. Null = tanpa batas');
            $table->integer('batas_per_user')->nullable()->after('kuota_total')->comment('Maksimal pemakaian per user. Null = tanpa batas');
            $table->date('tanggal_berakhir')->nullable()->after('batas_per_user')->comment('Tgl kedaluwarsa promo. Null = selamanya');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('promos', function (Blueprint $table) {
            $table->dropColumn(['kuota_total', 'batas_per_user', 'tanggal_berakhir']);
        });
    }
};
