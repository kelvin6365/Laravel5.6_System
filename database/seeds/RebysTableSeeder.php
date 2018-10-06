<?php

use Illuminate\Database\Seeder;

class RebysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('rebys')->delete();

        \DB::table('rebys')->insert(array (
            0 =>
            array (
                'id' => 1,
                'Type' => 'Website',                
            ),
            1 =>
            array (
                'id' => 2,
                'Type' => 'Facebook',
            ),
        ));
    }
}
