<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class FavouritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('favourites')->delete();

        \DB::table('favourites')->insert(array (
            0 =>
            array (
                'id' => 1,
                'user_id' => '1',
                'post_id' => '1',              
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            1 =>
            array (
                'id' => 2,
                'user_id' => '1',
                'post_id' => '2',               
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            2 =>
            array (
                'id' => 3,
                'user_id' => '1',
                'post_id' => '3',              
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            3 =>
            array (
                'id' => 4,
                'user_id' => '1',
                'post_id' => '4',               
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            4 =>
            array (
                'id' => 5,
                'user_id' => '1',
                'post_id' => '5',                
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            5 =>
            array (
                'id' => 6,
                'user_id' => '1',
                'post_id' => '6',                
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
        ));
    }
}
