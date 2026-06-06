<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesanKomunitas extends Model
{
    use HasFactory;

    protected $table = 'pesan_komunitas';

    protected $fillable = [
        'id_ajak_main',
        'pengirim_id',
        'pesan',
        'is_read',
    ];

    public function ajakMain()
    {
        return $this->belongsTo(AjakMain::class, 'id_ajak_main');
    }

    public function pengirim()
    {
        return $this->belongsTo(User::class, 'pengirim_id');
    }
}
