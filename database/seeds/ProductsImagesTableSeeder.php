<?php

use App\ProductsImage;
use Illuminate\Database\Seeder;

class ProductsImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $sectionRecord=[
             ['id'=>1,'product_id'=>1, 'image'=>"pakistan.png","status"=>1],
        ['id'=>2,'product_id'=>2, 'image'=>"pakistan.png","status"=>1],
         ['id'=>3,'product_id'=>1, 'image'=>"pakistan.png","status"=>1],
    ];
    ProductsImage::insert($sectionRecord);
    }
    
}
