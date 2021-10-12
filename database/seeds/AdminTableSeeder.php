<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        $adminRecords =[
            ['id'=>1,'name'=>'admin' , 'mobile' =>'12123121', 'type' => 'admin', 'email' => 'admin@gmail.com', 'image' => 'default.png',
                'password' => '$2y$10$RDJRJHvKus7BXOMiEpxS4OylTjt.Pssvl1ppPfeXCbfW9HnnKFG.W', 'status' => 1],

            [
                'id' => 2, 'name' => 'tanveer', 'mobile' => '1212388121', 'type' => 'admin', 'email' => 'tanveer@gmail.com', 'image' => '',
                'password' => '$2y$10$RDJRJHvKus7BXOMiEpxS4OylTjt.Pssvl1ppPfeXCbfW9HnnKFG.W', 'status' => 1
            ],

            [
                'id' => 3, 'name' => 'john', 'mobile' => '12123121', 'type' => 'admin', 'email' => 'khan@gmail.com', 'image' => '',
                'password' => '$2y$10$RDJRJHvKus7BXOMiEpxS4OylTjt.Pssvl1ppPfeXCbfW9HnnKFG.W', 'status' => 1
            ],

            [
                'id' => 4, 'name' => 'adnan', 'mobile' => '12123121', 'type' => 'admin', 'email' => 'aadnan@gmail.com', 'image' => '',
                'password' => '$2y$10$RDJRJHvKus7BXOMiEpxS4OylTjt.Pssvl1ppPfeXCbfW9HnnKFG.W', 'status' => 1
            ],
        ];


        DB::table('admins')->insert($adminRecords);

//foreach ($adminRecords as $key => $record) {
   //         \App\Admin::create($record);
     //   }

    }
}
