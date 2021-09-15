<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SpesialisModel extends Model
{
    protected $fillable = [
        'nama_spesialis',
    ];

    protected $table = 'spesialis';

    public function dokter()
    {
        return $this->hasMany('\App\Model\DokterModel','spesialis_id');
    }
}
