<?php

use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('brands')->delete();

        \DB::table('brands')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Test Co.',         
                'img_path' => 'img/customer-1.png',       
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Test2 Co.',         
                'img_path' => 'img/customer-2.png',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Test3 Co.',         
                'img_path' => 'img/customer-3.png',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'Test4 Co.',         
                'img_path' => 'img/customer-4.png',
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'Test5 Co.',         
                'img_path' => 'img/customer-5.png',
            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'Test6 Co.',         
                'img_path' => 'img/customer-6.png',
            ),
        ));
    }
}
