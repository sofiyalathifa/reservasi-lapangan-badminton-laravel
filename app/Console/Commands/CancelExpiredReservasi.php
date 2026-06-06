<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CancelExpiredReservasi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reservasi:cancel-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Membatalkan pesanan yang belum dibayar dalam 24 jam';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiredReservations = \App\Models\Reservasi::where('status_reservasi', 'pending')
            ->whereDoesntHave('pembayaran')
            ->where('created_at', '<', now()->subHours(24))
            ->get();

        $count = 0;
        foreach ($expiredReservations as $reservasi) {
            $reservasi->update(['status_reservasi' => 'dibatalkan']);
            $count++;
        }

        $this->info("Berhasil membatalkan {$count} pesanan yang kedaluwarsa.");
    }
}
