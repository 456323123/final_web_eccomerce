<?php

namespace App;

use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    public static function cartitems()
    {
        if(Auth::check())
        {
               $usercartitems=Cart::with(['products'=>function($query){
                   $query->select('id','product_name','product_code','product_color','product_main_image');
               }])->where('user_id',Auth::user()->id)->orderby('id','desc')->get()->toArray();
        }
        else {
             $usercartitems=Cart::with(['products'=>function($query){
                   $query->select('id','product_name','product_code','product_color','product_main_image');
               }])->where('session_id',Session::get('session_id'))->orderby('id','desc')->get()->toArray();
        }
        return $usercartitems;
    }
   public static function GetProductAttributePrice($PRODUCT_ID, $PRODUCT_SIZE)
   {
       $AttributePrice=ProductsAttribute::select('products_attributes_price')->where(['product_id'=>$PRODUCT_ID,'products_attributes_size'=>$PRODUCT_SIZE])
       ->first()->toArray();
       return $AttributePrice['products_attributes_price'];
   }

      public function products()
   {
       return $this->belongsTo('App\Product','product_id');
   }





}
