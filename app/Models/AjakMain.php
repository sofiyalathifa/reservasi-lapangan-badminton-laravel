<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AjakMain extends Model
{
    use HasFactory;

    protected $table = 'ajak_mains';

    protected $fillable = [
        'id_cari_teman',
        'pengirim_id',
        'penerima_id',
        'status',
    ];

    public function cariTeman()
    {
        return $this->belongsTo(CariTeman::class, 'id_cari_teman');
    }

    public function pengirim()
    {
        return $this->belongsTo(User::class, 'pengirim_id');
    }

    public function penerima()
    {
        return $this->belongsTo(User::class, 'penerima_id');
    }

    public function pesanKomunitas()
    {
        return $this->hasMany(PesanKomunitas::class, 'id_ajak_main');
    }
}
