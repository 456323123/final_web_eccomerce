<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryRecord = [
            ['id' => 1, 'parent_id' => 0, "section_id" => 1,"category_name"=>'T-Shirts', "category_image" => '', "category_discount" => 0, "category_description" => '' ,"category_url" => 't-shirts', "meta_title" => '', "meta_description" => '' , "meta_keywords" => '', "status" => 1
        ],

            [
                'id' => 2, 'parent_id' => 1, "section_id" => 1, "category_name" => 'Causal T-Shirts', "category_image" => '', "category_discount" => 0, "category_description" => '', "category_url" => 'causal-t-shirts', "meta_title" => '',"meta_description" => '', "meta_keywords" => '', "status" => 1
            ],

        ];

        Category::insert($categoryRecord);
    }
}
