<?php

namespace App\Http\Controllers\Front;
use App\Cart;
use App\Brand;
use App\Product;
use App\Category;
use App\ProductsAttribute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{



public function listing(Request $request)
{
Paginator::useBootstrap();
if($request->ajax())
{
 $data=$request->all();
 $url=$data['url'];
  //echo "<pre>"; print_r($data);die;

    $categorycount=Category::where(['category_url'=>$url,'status'=>1])->count();
if ($categorycount>0) {
  // echo "category is exits";die;
  $categoryDetail=Category::Detailcategory($url);
  $productandcategorydetail=Product::with('brand')->whereIn('category_id',$categoryDetail['catID'])->where('status',1);
 //echo "<pre>"; print_r($categoryDetail);die;

//fabric filter is selected

if(isset($data['brand']) && !empty($data['brand']))
{
    $productandcategorydetail->whereIn('products.brand_id',$data['brand']);
}

if(isset($data['fabric']) && !empty($data['fabric']))
{
    $productandcategorydetail->whereIn('products.product_fabric',$data['fabric']);
}

if(isset($data['Sleeve']) && !empty($data['Sleeve']))
{
    $productandcategorydetail->whereIn('products.product_sleeve',$data['Sleeve']);
}

if(isset($data['Patten']) && !empty($data['Patten']))
{
    $productandcategorydetail->whereIn('products.product_pattern',$data['Patten']);
}

if(isset($data['Fit']) && !empty($data['Fit']))
{
    $productandcategorydetail->whereIn('products.product_fit',$data['Fit']);
}

if(isset($data['Occission']) && !empty($data['Occission']))
{
    $productandcategorydetail->whereIn('products.product_occassion',$data['Occission']);
}

//if sort option slected by user
if(isset($data['sort']) && !empty($data['sort']))
{
    if ($data['sort']=="latest_products") {
        $productandcategorydetail->orderBy('id','Desc');
    }
    else if ($data['sort']=="latest_products_a_to_z") {
        $productandcategorydetail->orderBy('product_name','Asc');
    }
   else if ($data['sort']=="latest_products_z_to_a") {
        $productandcategorydetail->orderBy('product_name','Desc');
    }
   else if ($data['sort']=="price_lowest") {
        $productandcategorydetail->orderBy('product_price','Asc');
    }
   else if ($data['sort']=="price_highest") {
        $productandcategorydetail->orderBy('product_price','Desc');
    }
}

$productandcategorydetail=$productandcategorydetail->paginate(6);

   return view('front.products.ajax_product_listing')->with(compact('productandcategorydetail','categoryDetail','url'));
}
else {
   abort(404);
}

}
else {
$url=Route::getFacadeRoot()->current()->uri();
      $categorycount=Category::where(['category_url'=>$url,'status'=>1])->count();
if ($categorycount>0) {
  // echo "category is exits";die;
  $categoryDetail=Category::Detailcategory($url);
  $productandcategorydetail=Product::with('brand')->whereIn('category_id',$categoryDetail['catID'])->where('status',1);
 //echo "<pre>"; print_r($categoryDetail);die;
$productandcategorydetail=$productandcategorydetail->paginate(6);
$brand=Brand::where('status',1)->get()->toArray();
 //echo "<pre>"; print_r($brand);die;
        $product_filter=Product::product_filter();
         //echo "<pre>"; print_r($product_filter);die;
        $fabricArray =$product_filter['fabricArray'];
        $SleeveArray =$product_filter['SleeveArray'];
        $PattenArray =$product_filter['PattenArray'];
        $fitArray =$product_filter['fitArray'];
        $occassionArray =$product_filter['occassionArray'];
$page_name="listing";


   return view('front.products.listing')->with(compact('productandcategorydetail','categoryDetail','url','fabricArray','SleeveArray','PattenArray','fitArray','occassionArray','page_name','brand'));
}
else {
   abort(404);
}


}
}


public function Detail($id)
{

    $product_Detail=Product::with(['category','brand','Attributes'=>function($query){
        $query->where('products_attributes_status',1);
    },'images'])->find($id)->toArray();
    $total_stock=ProductsAttribute::where('product_id',$id)->sum('products_attributes_stock');
   // echo "<pre>"; print_r($stock);die;
   $Related_products=Product::with('brand')->where('category_id',$product_Detail['category']['id'])->where('id','!=',$id)->inRandomOrder()->limit(3)->get()->toArray();
  // echo "<pre>"; print_r($Related_products);die;
 return view('front.products.product_detail')->with(compact('product_Detail','total_stock','Related_products'));
}


public function GetProductPrice(Request $request)
{
    if($request->ajax())
    {
        $data=$request->all();
           //echo "<pre>"; print_r($data);die;

        // $ProductPrice=ProductsAttribute::where(['product_id'=>$data['product_id'],'products_attributes_size'=>$data['size']])->first();
        // return $ProductPrice->products_attributes_price;
        $dicounted_price=Product::productAttributeDiscount($data['product_id'],$data['size']);
       return $dicounted_price;
    }
}
   public function Cart(Request $request)
       {$usercartitems=Cart::cartitems();

    // echo "<pre>"; print_r($usercartitems);die;
    return view('front.products.cart')->with(compact('usercartitems'));
       }



public function addToCart(Request $request)
{
    if($request->isMethod('post'))
    {

        $data=$request->all();
        // echo "<pre>"; print_r($data);die;

        $getProductStock=ProductsAttribute::where(['product_id'=>$data['product_id'],'products_attributes_size'=>$data['size']])->first()->toArray();
//echo $getProductStock['products_attributes_stock'];die;
                   if($getProductStock['products_attributes_stock']<$data['product_quantity'])
                                {
                                $message="Required Quantity are not available!";
                                session::flash('error_message',$message);
                                return redirect()->back();

                                }


                                $session_id=Session::get('session_id');
                                if(empty($session_id))
                                {
                                    $session_id=Session::getId();
                                    Session::put('session_id',$session_id);
                                }

if(Auth::check())
{
                                 $product_count=Cart::where(['product_id'=>$data['product_id'],'size'=>$data['size'],'user_id'=>Auth::Id()])->count();

}
else {

    $product_count=Cart::where(['product_id'=>$data['product_id'],'size'=>$data['size'],'session_id'=>Session::get('session_id')])->count();

}

                               if($product_count>0)
                               {

                                      $message="Product all ready added to cart";
                                session::flash('error_message',$message);
                                return redirect()->back();
                               }


                                //save in cart table session id
      Cart::insert(['session_id'=>$session_id,'product_id'=>$data['product_id'],'size'=>$data['size'],'quantity'=>$data['product_quantity']]);
                               $message="product successfully add to cart";
                               session::flash('success',$message);
                                   return redirect()->back();

                            }

                        }

}





