<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('posts')->delete();

        \DB::table('posts')->insert(array (
            0 =>
            array (
                'id' => 1,
                'post_type' => '0',
                'post_title' => 'TestOne標題一',
                'post_description' => '雪櫃,碌架床(單人),桌,椅,電視,煮食爐,小書檯,書架雪櫃,碌架床(單人),桌,椅,電視,煮食爐,小書檯,書架雪櫃,碌架床(單人),桌,椅,電視,煮食爐,小書檯,書架雪櫃,碌架床(單人),桌,椅,電視,煮食爐,小書檯,書架',
                'post_proser' => '1',
                'post_photo' => 'img/Item/no_image.png',
                'post_view' => '0',
                'post_comm' => '0',
                'post_active' => '0',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            1 =>
            array (
                'id' => 2,
                'post_type' => '0',
                'post_title' => 'TestOne標題二',
                'post_description' => '碌架床(單人),桌,椅,桌,椅,桌,椅,桌,椅,桌,椅,桌,椅,桌,椅,桌,椅,桌,椅,桌,椅,桌,椅,桌,椅',
                'post_proser' => '1',
                'post_photo' => 'img/Item/no_image.png',
                'post_view' => '0',
                'post_comm' => '0',
                'post_active' => '0',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            2 =>
            array (
                'id' => 3,
                'post_type' => '0',
                'post_title' => 'TestOne標題三',
                'post_description' => '碌架床(單人),桌,椅',
                'post_proser' => '1',
                'post_photo' => 'img/Item/no_image.png',
                'post_view' => '0',
                'post_comm' => '0',
                'post_active' => '0',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            3 =>
            array (
                'id' => 4,
                'post_type' => '0',
                'post_title' => 'TestOne標題四',
                'post_description' => '碌架床(單人),桌,椅',
                'post_proser' => '1',
                'post_photo' => 'img/Item/no_image.png',
                'post_view' => '0',
                'post_comm' => '0',
                'post_active' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            4 =>
            array (
                'id' => 5,
                'post_type' => '1',
                'post_title' => 'AskTestOne標題一',
                'post_description' => '求雪櫃',
                'post_proser' => '1',
                'post_photo' => 'img/Item/no_image.png',
                'post_view' => '0',
                'post_comm' => '0',
                'post_active' => '0',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            5 =>
            array (
                'id' => 6,
                'post_type' => '1',
                'post_title' => 'AskTestOne標題二',
                'post_description' => '求碌架床(單人),桌,椅求碌架床(單人),桌,椅求碌架床(單人),桌,椅求碌架床(單人),桌,椅求碌架床(單人),桌,椅求碌架床(單人),桌,椅求碌架床(單人),桌,椅求碌架床(單人),桌,椅求碌架床(單人),桌,椅求碌架床(單人),桌,椅',
                'post_proser' => '1',
                'post_photo' => 'img/Item/no_image.png',
                'post_view' => '0',
                'post_comm' => '0',
                'post_active' => '0',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            6 =>
            array (
                'id' => 7,
                'post_type' => '1',
                'post_title' => 'AskTestOne標題三',
                'post_description' => '求碌架床(單人),桌,椅',
                'post_proser' => '1',
                'post_photo' => 'img/Item/no_image.png',
                'post_view' => '0',
                'post_comm' => '0',
                'post_active' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
        ));

        \DB::table('post_comms')->insert(array (
            0 =>
            array (
                'user_id' => 1,
                'post_id' => 1,
                'comm_text' => '本人有意申請 聯絡方法為2333 3333',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            1 =>
            array (
                'user_id' => 2,
                'post_id' => 1,
                'comm_text' => '本人有意申請 聯絡方法為2883 3833',              
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            2 =>
            array (
                'user_id' => 1,
                'post_id' => 2,
                'comm_text' => '本人有意申請 聯絡方法為2883 3833',              
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            3 =>
            array (
                'user_id' => 1,
                'post_id' => 5,
                'comm_text' => '本人有意申請 聯絡方法為2333 3333',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            4 =>
            array (
                'user_id' => 2,
                'post_id' => 5,
                'comm_text' => '本人有意申請 聯絡方法為2883 3833',              
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            5 =>
            array (
                'user_id' => 1,
                'post_id' => 6,
                'comm_text' => '本人有意申請 聯絡方法為2883 3833',              
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
        ));

    }
}
