<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TopupModel extends Model
{
    protected $fillable = [
        'nominal',
        'users_id',
        'pasien_id',
    ];

    protected $table = 'topup';

    public function pasien()
    {
        return $this->belongsTo('\App\Model\PasienModel', 'pasien_id');
    }

    public function users()
    {
        return $this->belongsTo('\App\Model\UsersModel', 'users_id');
    }
}
