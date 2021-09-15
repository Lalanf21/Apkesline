<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GenderModel extends Model
{
    protected $fillable = [
        'gender',
        
    ];

    protected $table = 'gender';

    public function users()
    {
        return $this->hasMany('\App\Model\UsersModel', 'gender_id');
    }
}
