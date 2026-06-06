<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CariTeman extends Model
{
    use HasFactory;

    protected $table = 'cari_temans';

    protected $fillable = [
        'id_pengguna',
        'level_kemampuan',
        'lokasi',
        'gaya_bermain',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_pengguna');
    }

    public function ajakMains()
    {
        return $this->hasMany(AjakMain::class, 'id_cari_teman');
    }
}
