<?php

namespace App\Http\Controllers\Admin;


use Image;
use App\Brand;
use App\Product;
use App\Section;
use App\Category;
use App\ProductsImage;
use App\ProductsAttribute;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Foreach_;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{
    // start with 32 videos
    public function products()
    {
        Session::put('page', 'products');
        $products=Product::with(['category'=>function ($query) {
            $query->select('id', 'category_name');
        },'section'=>function ($query) {
            $query->select('id', 'name');
        }])->get();
        // $category=json_decode(json_encode($products));
        // echo "<pre>"; print_r($category);die;
        return view('admin.products.products')->with(compact('products'));
    }



    public function updateproductstatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>"; print_r($data);die;
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Product::where('id', $data['product_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'product_id' => $data['product_id']]);
        }
    }


    public function deleteproduct($id)
    {
        Product::where('id', $id)->delete();
        $message = 'Delete Product has been delete succesfully ';
        Session::flash('success_message', $message);
        return redirect()->back();
    }

public function deleteproductimage($id)
{
//get image
$categoryimage=Product::select('product_main_image')->where('id',$id)->first();
//get category image path
$category_path='images/product_image/small/';

if(file_exists($category_path.$categoryimage->product_main_image))
{
    unlink($category_path.$categoryimage->product_main_image);
}

 Product::where('id',$id)->update(['product_main_image'=>'']);
        $message = 'Image has been delete succesfully ';
        Session::flash('success_message', $message);
        return redirect()->back();
}
    public function AddEditProduct(Request $request, $id=null)
    {
        if ($id=="") {
            $title="Add Catagory";
            $product= new Product;
             $productdata=array();
             $message="Product Add Successful";
        } else {
            $title = "Edit Catagory";
            $productdata=Product::find($id);
           $productdata=json_decode(json_encode($productdata),true);
          //  echo "<pre>"; print_r($productdata);die;
           $product=Product::find($id);
            $message="Product Update Successful";
        }
   if($request->isMethod('post')){
       $data = $request->all();
   // echo "<pre>"; print_r( $data);die;

                  $roles = [
                'category_id' => 'required',
                'brand_id' => 'required',
                'product_name' => 'required',
                'product_code' => 'required',
                'product_color'=>'required',
                'product_main_image' => 'image',

            ];

            $customessage = [
                'category_id.required' => 'product name is required',
                 'brand_id.required' => 'product brand name is required',
                'product_name.required' => 'name is reiquired',
                'product_code.required' => 'Section id is required',
                'product_main_image.required' => ' image is required',
                'product_color.required' => 'color is required',
            ];



            $this->validate($request, $roles, $customessage);

             if ($request->hasFile('product_main_image')) {
                $image_tmp = $request->file('product_main_image');
                if ($image_tmp->isValid()) {
                    // Get Image Name
                      $imageName = $image_tmp->getClientOriginalName();
                    // Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    // Generate New Image Name
                    $imageName = $imageName.'-'.rand(111, 99999) . '.' . $extension;
                    $large_image_Path = 'Images/product_image/large/' . $imageName;
                    $meidum_image_Path = 'Images/product_image/medium/' . $imageName;
                    $small_image_Path = 'Images/product_image/small/' . $imageName;
                    // Upload the Image small medium and large
                    Image::make($image_tmp)->save($large_image_Path);
                    Image::make($image_tmp)->resize(520,600)->save($meidum_image_Path);
                    Image::make($image_tmp)->resize(260,300)->save($small_image_Path);
                    //save imgaes category
                    $product->product_main_image = $imageName;

                }
            }

             if ($request->hasFile('product_video')) {
                $video_tmp = $request->file('product_video');
                if ($video_tmp->isValid()) {
                    // Get video Name
                      $video_name = $video_tmp->getClientOriginalName();
                    // Get video Extension
                    $extension = $video_tmp->getClientOriginalExtension();
                    // Generate New Video Name
                    $videoName =  $video_name.'-'.rand() . '.' . $extension;
                    $large_video_Path = 'videos/product_videos/' . $videoName;

                    // Upload the Image small medium and large
                    $video_tmp->move($large_video_Path,$videoName);

                    //save imgaes category
                    $product->product_video = $videoName;

                }
            }
            if (empty($data['product_is_featured'])) {
               $product_is_featured="No";
            }
            else{
                 $product_is_featured="Yes";
            }

            $alldetailproduct=Category::find($data['category_id']);
 // echo "<pre>"; print_r($alldetailproduct);die;
            $product->section_id=$alldetailproduct['section_id'];
            $product->category_id=$data['category_id'];
             $product->brand_id=$data['brand_id'];
            $product->product_code=$data['product_code'];
            $product->product_name=$data['product_name'];
            $product->product_color=$data['product_color'];
            $product->product_discount=$data['product_discount'];
            $product->product_weight=$data['product_weight'];
            $product->product_price=$data['product_price'];

            $product->product_description=$data['product_description'];
            $product->product_wash_care=$data['product_wash_care'];
            $product->product_fabric=$data['product_fabric'];
            $product->product_pattern=$data['product_pattern'];
            $product->product_sleeve=$data['product_sleeve'];
            $product->product_fit=$data['product_fit'];
            $product->product_occassion=$data['product_occassion'];
            $product->product_meta_title=$data['product_meta_title'];
            $product->product_meta_description=$data['product_meta_description'];
 $product->product_meta_keywords=$data['product_meta_keywords'];
$product->product_is_featured=$product_is_featured;
            $product->status = 1;
$product->save();
 Session::flash('success_message', $message);
            return redirect('admin/products');

   }
$product_filter=Product::product_filter();
        $fabricArray =$product_filter['fabricArray'];
        $SleeveArray =$product_filter['SleeveArray'];
        $PattenArray =$product_filter['PattenArray'];
        $fitArray =$product_filter['fitArray'];
        $occassionArray =$product_filter['occassionArray'];
        //get section
        $categories=Section::with('categories')->get();
         $categories=json_decode(json_encode( $categories),true);
       // echo "<pre>"; print_r($categories);die;

       //get brand
       $brands =Brand::where('status',1)->get();
        $brands=json_decode(json_encode($brands),true);
         return view("admin.products.add_edit_products")->with(compact('title','fabricArray','SleeveArray','PattenArray','fitArray','occassionArray','categories','productdata','brands'));

    }


    public function AddProductAttribute(Request $request, $id)
    {
        if($request->isMethod('post'))
        {
            $data=$request->all();
           foreach ($data['products_attributes_sku'] as $key => $value) {



               if(!empty($value)){
                   $attributescountSKU=ProductsAttribute::where('products_attributes_sku',$value)->count();
                   if($attributescountSKU>0)
                   {

                    $message='SKU Already Exits Please And Other SKU!';
                    Session::flash('success_message', $message);
                    return redirect()->back();


                }

                 $attributescountSKU=ProductsAttribute::where(['product_id'=>$id,'products_attributes_size'=>$data['products_attributes_size'][$key]])->count();
                   if($attributescountSKU>0)
                   {

                    $message='Size Already Exits Please And Other Size!';
                    Session::flash('success_message', $message);
                    return redirect()->back();


                }
                   $attributes=new ProductsAttribute;
                   $attributes->product_id=$id;
                   $attributes->products_attributes_sku=$value;
                   $attributes->products_attributes_size=$data['products_attributes_size'][$key];
                   $attributes->products_attributes_price=$data['products_attributes_price'][$key];
                   $attributes->products_attributes_stock=$data['products_attributes_stock'][$key];
                   $attributes->products_attributes_status=1;
                   $attributes->save();
               }
           }
            $message='Successfull Add Product Atributes';
                    Session::flash('success_message', $message);
                    return redirect()->back();
           // echo "<pre>"; print_r($data);die;
        }
        $productdata=Product::select('id','product_name','product_code','product_color','product_main_image')->with('Attributes')->find($id);
         $productdata=json_decode(json_encode( $productdata),true);
       //echo "<pre>"; print_r($productdata);die;
      $title="Add Attribute";
       return view('admin.products.add_edit_product_attribute')->with(compact('productdata','title'));
    }

public function EditProductAttribute(Request $request, $id)
{
  if($request->isMethod('post'))
        {
            $data=$request->all();
         //s echo "<pre>"; print_r($data);die;

          foreach ($data['AttrID'] as $key => $value) {
              if(!empty($value))
              {
                  ProductsAttribute::where(['id'=>$data['AttrID'][$key]])->update(['products_attributes_price'=>$data['products_attributes_price'][$key],'products_attributes_stock'=>$data['products_attributes_stock'][$key]]);
              }
              # code...
          }
           $message='Update Succesfully Product Atributes';
                    Session::flash('success_message_atr', $message);
                    return redirect()->back();
        }
}

  public function updateattributestatus(Request $request)
 {
        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>"; print_r($data);die;
            if ($data['products_attributes_status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            ProductsAttribute::where('id', $data['attribute_id'])->update(['products_attributes_status' => $status]);
            return response()->json(['products_attributes_status' => $status, 'attribute_id' => $data['attribute_id']]);
        }
    }

    public function deleteattribute($id)
    {
        ProductsAttribute::where('id', $id)->delete();
        $message = 'Delete Attribute has been delete succesfully ';
        Session::flash('success_message', $message);
        return redirect()->back();
    }

    public function updateimagestatus(Request $request)
 {
        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>"; print_r($data);die;
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            ProductsImage::where('id', $data['image_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'image_id' => $data['image_id']]);
        }
    }

     public function   AddmultiimagesAttribute(Request $request,$id)
    {
        if($request->isMethod('post'))
        {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                 //echo "<pre>"; print_r($image);die;
                 foreach ($image as $key => $value) {
                  $productImage=new ProductsImage;
                 $image_tmp=Image::make($value);
                 // echo $orignalname=$value->getClientOriginalName();die;
                 $extension=$value->getClientOriginalExtension();
                $imageName=rand(1111,999999).time().".".$extension;


                    $large_image_Path = 'Images/product_image/large/' . $imageName;
                    $meidum_image_Path = 'Images/product_image/medium/' . $imageName;
                    $small_image_Path = 'Images/product_image/small/' . $imageName;
                    // Upload the Image small medium and large
                    Image::make($image_tmp)->save($large_image_Path);
                    Image::make($image_tmp)->resize(520,600)->save($meidum_image_Path);
                    Image::make($image_tmp)->resize(260,300)->save($small_image_Path);
                    //save imgaes category
                    $productImage->image = $imageName;
                     $productImage->product_id=$id;
                     $productImage->status=1;
                       $productImage->save();

                 }

     $message = 'Product Images has been added succesfully ';
        Session::flash('success_message', $message);
        return redirect()->back();
                }

        }
        $productdata=Product::with('images')->select('id','product_name','product_code','product_color','product_main_image')->find($id);;
          $productdata=json_decode(json_encode( $productdata),true);
      // echo "<pre>"; print_r($productdata);die;
     return view('admin.products.add_edit_product_images')->with(compact('productdata'));
    }

 public function deleteimages($id)
    {
        ProductsImage::where('id', $id)->delete();
        $message = 'Image has been delete succesfully ';
        Session::flash('success_message', $message);
        return redirect()->back();
    }
}
