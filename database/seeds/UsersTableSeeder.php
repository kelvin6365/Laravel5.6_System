<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       \DB::table('users')->delete();

        \DB::table('users')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => '李姑娘',
                'email' => 'test@gmail.com',
                'password' => bcrypt('123456'),
                'avatar' => 'img\User\default-user.png',
                'phone' => 35689865,
                'title' => '社區中心',
                'active' => 0,
                'reby' => 1,
                'remember_token' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            1 =>
            array (
                'id' => 2,
                'name' => '陳姑娘',
                'email' => 'test2@gmail.com',
                'password' => bcrypt('123456'),
                'avatar' => 'img\User\default-user.png',
                'phone' => 35896548,
                'title' => '',
                'active' => 1,
                'reby' => 1,
                'remember_token' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
        ));

        
    }
}
