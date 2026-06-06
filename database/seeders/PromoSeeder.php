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
            'tag' => 'HEMAT',
            'jam_mulai_berlaku' => '10:00:00',
            'jam_selesai_berlaku' => '15:00:00',
            'hari_berlaku' => 'weekday'
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
            'deskripsi' => 'Ajak teman untuk bergabung dan dapatkan voucher booking senilai Rp50.000 (Khusus 1x pemakaian per akun).',
            'tipe_diskon' => 'nominal',
            'nilai_diskon' => 50000,
            'tag' => 'BARU',
            'batas_per_user' => 1
        ]);

        \App\Models\Promo::create([
            'nama_promo' => 'Diskon Mahasiswa',
            'kode_promo' => 'MHS20',
            'deskripsi' => 'Tunjukkan kartu tanda mahasiswa (KTM) aktif Anda untuk mendapat diskon 20% (Terbatas untuk 50 pemesan pertama).',
            'tipe_diskon' => 'persen',
            'nilai_diskon' => 20,
            'tag' => 'PELAJAR',
            'kuota_total' => 50
        ]);

        \App\Models\Promo::create([
            'nama_promo' => 'Weekend Seru',
            'kode_promo' => 'WEEKENDFUN',
            'deskripsi' => 'Potongan harga Rp25.000 khusus untuk pemesanan hari Sabtu dan Minggu pagi (Promo telah berakhir).',
            'tipe_diskon' => 'nominal',
            'nilai_diskon' => 25000,
            'tag' => 'WEEKEND',
            'tanggal_berakhir' => \Carbon\Carbon::yesterday()->toDateString(),
            'hari_berlaku' => 'weekend'
        ]);

        \App\Models\Promo::create([
            'nama_promo' => 'Ganda Campuran',
            'kode_promo' => 'MIXMATCH',
            'deskripsi' => 'Ajak pasangan bermain ganda campuran dan nikmati potongan diskon 15%.',
            'tipe_diskon' => 'persen',
            'nilai_diskon' => 15,
            'tag' => 'SPESIAL'
        ]);

        \App\Models\Promo::create([
            'nama_promo' => 'Pagi Bugar',
            'kode_promo' => 'MORNINGFIT',
            'deskripsi' => 'Diskon Rp40.000 untuk sesi bermain di bawah jam 09.00 WIB setiap harinya.',
            'tipe_diskon' => 'nominal',
            'nilai_diskon' => 40000,
            'tag' => 'PAGI',
            'jam_selesai_berlaku' => '09:00:00'
        ]);

        \App\Models\Promo::create([
            'nama_promo' => 'Main Puas',
            'kode_promo' => 'LONGPLAY',
            'deskripsi' => 'Dapatkan potongan harga Rp35.000 khusus untuk pemesanan lebih dari 2 Jam.',
            'tipe_diskon' => 'nominal',
            'nilai_diskon' => 35000,
            'tag' => 'LOYAL',
            'min_durasi' => 3 // lebih dari 2 jam = minimal 3 jam
        ]);

        \App\Models\Promo::create([
            'nama_promo' => 'Pesta Olahraga',
            'kode_promo' => 'BIGMATCH',
            'deskripsi' => 'Diskon 10% untuk transaksi besar dengan total pemesanan di atas Rp 300.000.',
            'tipe_diskon' => 'persen',
            'nilai_diskon' => 10,
            'tag' => 'BIG SALE',
            'min_total_harga' => 300001 // di atas 300rb
        ]);
    }
}
