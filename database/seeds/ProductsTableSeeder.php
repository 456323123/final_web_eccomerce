<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryRecord = [
            ['id' => 1, 'category_id' => 2, "section_id" => 1,"product_name"=>'Cotton T-Shirt',  "product_discount" => 0, "product_description" => '' ,"product_code" => 'BT001',
            "product_color" => 'blue', "product_price" => '1500' ,"product_weight" => '200', "product_video" =>'',
             "product_wash_care" => '',"product_fabric" => '', "product_main_image" => '', "product_pattern" => '', "product_sleeve" => '', "product_sleeve" => '',
              "product_fit" => '', "product_occassion" => '',  "product_sleeve" => '', "product_is_featured" => 'NO',"product_meta_title" => '', "product_meta_description" => '' , "product_meta_keywords" => '', "status" => 1
        ],
         ['id' => 2, 'category_id' => 2, "section_id" => 1,"product_name"=>'blue T-Shirt',  "product_discount" => 0, "product_description" => '' ,"product_code" => 'BT001',
            "product_color" => 'blue', "product_price" => '1500' ,"product_weight" => '200', "product_video" =>'',
             "product_wash_care" => '',"product_fabric" => '', "product_main_image" => '', "product_pattern" => '', "product_sleeve" => '', "product_sleeve" => '',
              "product_fit" => '', "product_occassion" => '',  "product_sleeve" => '', "product_is_featured" => 'NO',"product_meta_title" => '', "product_meta_description" => '' , "product_meta_keywords" => '', "status" => 1
        ]
        ];
        Product::insert($categoryRecord);
    }
}
