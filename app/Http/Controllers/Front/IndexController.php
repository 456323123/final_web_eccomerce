<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
          $page_name="index";
        $feature_product_count=Product::where('product_is_featured','Yes')->where('status',1)->count();
        $feature_item=Product::where('product_is_featured','Yes')->where('status',1)->get()->toArray();
        $feature_iten_chunk=array_chunk($feature_item,4);
       // echo "<pre>"; print_r($feature_iten_chunk);die;
$latest_products=Product::orderBy('id','desc')->where('status',1)->limit(6)->get()->toArray();
        //dd($latest_products);

         return view('front.index')->with(compact('page_name','feature_iten_chunk','feature_product_count','latest_products','feature_product_count'));
    }
}
