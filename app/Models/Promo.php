<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    protected $casts = [
        'tanggal_berakhir' => 'date',
    ];

    /**
     * Memeriksa apakah promo ini masih valid untuk user tertentu.
     * Mengembalikan array ['is_valid' => bool, 'message' => string]
     */
    public function isValidForUser($userId)
    {
        if (!$this->status) {
            return ['is_valid' => false, 'message' => 'Promo sudah tidak aktif.'];
        }

        if ($this->tanggal_berakhir && $this->tanggal_berakhir->isPast()) {
            return ['is_valid' => false, 'message' => 'Masa berlaku promo telah habis.'];
        }

        if ($this->kuota_total !== null && $this->kuota_total <= 0) {
            return ['is_valid' => false, 'message' => 'Kuota promo sudah habis.'];
        }

        if ($this->batas_per_user !== null) {
            $penggunaanUser = \App\Models\Reservasi::where('kode_promo', $this->kode_promo)
                ->where('id_pengguna', $userId)
                ->where('status_reservasi', '!=', 'dibatalkan')
                ->count();

            if ($penggunaanUser >= $this->batas_per_user) {
                return ['is_valid' => false, 'message' => 'Anda telah mencapai batas penggunaan untuk promo ini.'];
            }
        }

        return ['is_valid' => true, 'message' => 'Promo dapat digunakan.'];
    }

    /**
     * Memeriksa apakah promo ini valid untuk parameter pemesanan saat ini.
     */
    public function isValidForBooking($durasi, $totalHarga, $tanggal = null, $jamMulai = null)
    {
        if ($this->min_durasi !== null && $durasi < $this->min_durasi) {
            return ['is_valid' => false, 'message' => 'Promo ini membutuhkan minimal pemesanan ' . $this->min_durasi . ' Jam.'];
        }

        if ($this->min_total_harga !== null && $totalHarga < $this->min_total_harga) {
            return ['is_valid' => false, 'message' => 'Promo ini berlaku untuk transaksi minimal Rp ' . number_format($this->min_total_harga, 0, ',', '.') . '.'];
        }

        if ($tanggal) {
            $isWeekend = \Carbon\Carbon::parse($tanggal)->isWeekend();
            if ($this->hari_berlaku === 'weekday' && $isWeekend) {
                return ['is_valid' => false, 'message' => 'Promo ini hanya berlaku untuk pemesanan di hari kerja (Weekday).'];
            }
            if ($this->hari_berlaku === 'weekend' && !$isWeekend) {
                return ['is_valid' => false, 'message' => 'Promo ini hanya berlaku untuk pemesanan di akhir pekan (Weekend).'];
            }
        }

        if ($jamMulai) {
            $jamMulaiFormatted = date('H:i:s', strtotime($jamMulai));
            if ($this->jam_mulai_berlaku !== null && $jamMulaiFormatted < $this->jam_mulai_berlaku) {
                return ['is_valid' => false, 'message' => 'Promo ini baru dapat digunakan mulai pukul ' . date('H:i', strtotime($this->jam_mulai_berlaku)) . ' WIB.'];
            }
            if ($this->jam_selesai_berlaku !== null && $jamMulaiFormatted >= $this->jam_selesai_berlaku) {
                return ['is_valid' => false, 'message' => 'Promo ini hanya berlaku untuk sesi sebelum pukul ' . date('H:i', strtotime($this->jam_selesai_berlaku)) . ' WIB.'];
            }
        }

        return ['is_valid' => true, 'message' => 'Promo valid.'];
    }
}
