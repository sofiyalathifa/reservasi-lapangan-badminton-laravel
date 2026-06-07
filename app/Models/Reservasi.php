<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasi';
    protected $primaryKey = 'id_reservasi';
    public $incrementing = false;
    protected $keyType = 'string';
    
    // Hanya ada created_at di database lama
    const UPDATED_AT = null;

    protected $guarded = [];

    public function user()
    {
        // Menyambung ke tabel users yang baru
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function lapangan()
    {
        return $this->belongsTo(Lapangan::class, 'id_lapangan', 'id_lapangan');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'id_reservasi', 'id_reservasi');
    }

    public function ulasan()
    {
        return $this->hasOne(Ulasan::class, 'id_reservasi', 'id_reservasi');
    }

    public function pelatih()
    {
        return $this->belongsTo(Pelatih::class, 'id_pelatih', 'id_pelatih');
    }
}
