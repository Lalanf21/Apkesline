<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DokterModel extends Model
{
    protected $fillable = [
        'nip',
        'user_id',
        'spesialis_id',
        'biaya_charge',
        'durasi',
        'no_hp',
    ];

    protected $table = 'dokter';
}
