<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::truncate();
        \App\Models\user::create([
            'username' => 'admin',
            'password' => bcrypt('demo1234'),
            'login_type' => 'local',
            'name' => '系統管理員',
            'admin' => '1',
            'code'=>'079999',
            ]);
        \App\Models\user::create([
            'username' => 'wang',
            'password' => bcrypt('demo1234'),
            'login_type' => 'local',
            'name' => '王老師',
            'admin' => '1',
            'code'=>'079999',
            ]);
    }
}
