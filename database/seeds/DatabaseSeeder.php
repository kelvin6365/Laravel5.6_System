<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	$this->call('RebysTableSeeder');
        $this->call('UsersTableSeeder');
        $this->call('PostsTableSeeder');
        $this->call('FavouritesTableSeeder');
        $this->call('BrandsTableSeeder');
        
    }
}
