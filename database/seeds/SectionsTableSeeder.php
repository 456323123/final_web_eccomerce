<?php

use App\Section;
use Illuminate\Database\Seeder;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sectionRecord=[
             ['id'=>1,'name'=>"Men", "status"=>1],
            ['id' => 2,'name'=>"Women", "status" => 1],
            ['id' => 3, 'name' => "Kids", "status" => 1],
    ];
    Section::insert($sectionRecord);
    }
}
