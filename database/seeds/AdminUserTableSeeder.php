<?php

use App\Model\UsersModel;
use Illuminate\Database\Seeder;

class AdminUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UsersModel::create([
            'nama'=> 'admin',
            'username'=>'admin123',
            'gender_id'=> 1,
            'level_user_id'=> 1,
            'status_id'=> 10,
            'password' => bcrypt('admin')
        ]);
    }
}
