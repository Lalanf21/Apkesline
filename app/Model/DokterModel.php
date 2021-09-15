<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DokterModel extends Model
{
    protected $fillable = [
        'nip',
        'users_id',
        'spesialis_id',
        'biaya_charge',
        'durasi',
        'no_hp',
    ];

    protected $table = 'dokter';

    // relasi
    public function spesialis()
    {
        return $this->belongsTo('\App\Model\SpesialisModel','spesialis_id');
    }

    public function users()
    {
        return $this->belongsTo('\App\Model\UsersModel', 'users_id');
    }
}
