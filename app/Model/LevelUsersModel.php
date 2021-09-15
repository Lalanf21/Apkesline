<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LevelUsersModel extends Model
{
    protected $fillable = [
        'level_name',
    ];

    protected $table = 'level_user';

    // relasi
    public function users()
    {
        return $this->hasMany('\App\Model\UsersModel', 'level_user_id');
    }
}
