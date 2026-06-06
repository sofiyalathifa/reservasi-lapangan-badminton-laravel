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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->string('id_pembayaran')->primary();
            $table->string('id_reservasi');
            $table->enum('metode_pembayaran', ['QRIS', 'Transfer', 'Cash']);
            $table->decimal('jumlah_bayar', 10, 2);
            $table->dateTime('tanggal_bayar');
            $table->enum('status_pembayaran', ['pending', 'lunas', 'DP']);
            $table->string('bukti_pembayaran');
            $table->unsignedBigInteger('id_admin_verifikasi')->nullable();
            $table->dateTime('verified_at')->nullable();
            $table->text('verification_note')->nullable();

            $table->foreign('id_reservasi')->references('id_reservasi')->on('reservasi')->onDelete('cascade');
            $table->foreign('id_admin_verifikasi')->references('id')->on('users')->onDelete('set null');
        });
        */
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
