<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PasienModel extends Model
{
    protected $fillable = [
        'nama',
        'nik',
        'no_hp',
        'alamat',
        'gender_id',
        'kode_unik',
        'saldo',
        'status_id'
    ];

    protected $table = 'pasien';

    public function gender()
    {
        return $this->belongsTo('\App\Model\GenderModel', 'gender_id');
    }
}
