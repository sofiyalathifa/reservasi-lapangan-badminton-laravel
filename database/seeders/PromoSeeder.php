<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PromoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Promo::truncate();

        \App\Models\Promo::create([
            'nama_promo' => 'Happy Hour Weekday',
            'kode_promo' => 'HAPPY25',
            'deskripsi' => 'Dapatkan diskon 25% untuk booking lapangan pada pukul 10.00–15.00.',
            'tipe_diskon' => 'persen',
            'nilai_diskon' => 25,
            'tag' => 'HEMAT'
        ]);

        \App\Models\Promo::create([
            'nama_promo' => 'Paket Main + Pelatih',
            'kode_promo' => 'COACHPLAY',
            'deskripsi' => 'Potongan harga Rp30.000 untuk pemesanan lapangan sekaligus pelatih dengan durasi minimal dua jam.',
            'tipe_diskon' => 'nominal',
            'nilai_diskon' => 30000,
            'tag' => 'FAVORIT'
        ]);

        \App\Models\Promo::create([
            'nama_promo' => 'Member Referral',
            'kode_promo' => 'REFER50',
            'deskripsi' => 'Ajak teman untuk bergabung dan dapatkan voucher booking senilai Rp50.000.',
            'tipe_diskon' => 'nominal',
            'nilai_diskon' => 50000,
            'tag' => 'BARU'
        ]);
    }
}
