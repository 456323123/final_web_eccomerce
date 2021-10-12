<?php

namespace App;

use App\Category;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
       public function category()
   {
       return $this->belongsTo('App\Category','category_id');
   }

    public function section()
    {
        return $this->belongsTo('App\Section','section_id');
    }
     public function brand()
    {
        return $this->belongsTo('App\Brand','brand_id');
    }

     public function Attributes()
    {
        return $this->hasMany('App\ProductsAttribute','product_id');
    }
     public function images()
    {
        return $this->hasMany('App\ProductsImage','product_id');
    }

    public static function product_filter()
    {

        $product_filter['fabricArray'] =array('Cotton','Polyster','Wool');
        $product_filter['SleeveArray'] =array('Full Sleeve','Half Sleeve','Short Sleeve','Sleeveless');
        $product_filter['PattenArray'] =array('checked','Plain','Printed','Self','Solid');
        $product_filter['fitArray'] =array('Regular','Slim');
        $product_filter['occassionArray'] =array('Causal','Formal');
        return $product_filter;
    }


     public static function ProductDiscount($product_id)
   {
       $productdiscount=Product::select('product_discount','product_price','category_id')->where('id',$product_id)->first()->toArray();

       $categorydiscount=Category::select('category_discount')->where('id',$productdiscount['category_id'])->first()->toArray();
       if($productdiscount['product_discount']>0)
       {
           //sale price=cost price - discount price
           //   450    = 500       - (500*10/100)
$discount_price=$productdiscount['product_price'] - ($productdiscount['product_price'] * $productdiscount['product_discount']/100);
       }
       else if ($categorydiscount['category_discount']>0)
       {
$discount_price=$productdiscount['product_price'] - ($productdiscount['product_price'] * $categorydiscount['category_discount']/100);

       }
       else {
         $discount_price=0;
       }

       return $discount_price;
        // echo "<pre>"; print_r($productdiscount);die;


   }


        public static function productAttributeDiscount($product_id,$size)
{


    $productAttribute=ProductsAttribute::where(['product_id'=>$product_id,'products_attributes_size'=>$size])->first()->toArray();
       $productdiscount=Product::select('product_discount','category_id')->where('id',$product_id)->first()->toArray();

       $categorydiscount=Category::select('category_discount')->where('id',$productdiscount['category_id'])->first()->toArray();

        if($productdiscount['product_discount']>0)
       {
           //sale price=cost price - discount price
           //   450    = 500       - (500*10/100)
$discount_price=$productAttribute['products_attributes_price'] - ($productAttribute['products_attributes_price'] * $productdiscount['product_discount']/100);
       }
       else if ($categorydiscount['category_discount']>0)
       {
$discount_price=$productAttribute['products_attributes_price'] - ($productAttribute['products_attributes_price'] * $categorydiscount['category_discount']/100);

       }
       else {
         $discount_price=0;
       }

       return array('product_price'=>$productAttribute['products_attributes_price'],'discounted_price'=>$discount_price);
}

}
