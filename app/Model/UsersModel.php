<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UsersModel extends Model
{
    protected $fillable = [
        'username',
        'password',
        'gender_id',
        'level_user_id',
        'nama',
    ];

    protected $table = 'users';

    // relasi
    public function gender()
    {
        return $this->belongsTo('\App\Model\GenderModel', 'gender_id');
    }

    public function level_user()
    {
        return $this->belongsTo('\App\Model\LevelUsersModel', 'level_user_id');
    }

    public function dokter()
    {
        return $this->hasMany('\App\Model\DokterModel', 'users_id');
    }
}
