<?php

use App\ProductAttribute;
use App\ProductsAttribute;
use Illuminate\Database\Seeder;

class ProductsAttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productattributes = [

             ['id' => 1, 'product_id' => 1, "products_attributes_size" => 'medium',"products_attributes_price"=>100.0, "products_attributes_stock" => 200, "products_attributes_status" => 1,"products_attributes_sku" =>'BCT01'],
             ['id' => 2, 'product_id' => 1, "products_attributes_size" => 'small',"products_attributes_price"=>100.0, "products_attributes_stock" => 200, "products_attributes_status" => 1,"products_attributes_sku" =>'BCT01'],
             ['id' => 3, 'product_id' => 4, "products_attributes_size" => 'large',"products_attributes_price"=>100.0, "products_attributes_stock" => 200, "products_attributes_status" => 1,"products_attributes_sku" =>'BCT01'],

        ];

        ProductsAttribute::insert( $productattributes);
    }
}
