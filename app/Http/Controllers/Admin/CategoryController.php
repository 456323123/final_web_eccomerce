<?php

namespace App\Http\Controllers\Admin;

use App\Section;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function category()
    {

        Session::put('page', 'categories');
        $category = Category::with(['section','parentcategory'])->get();
       // $category=json_decode(json_encode($category));
       // echo "<pre>"; print_r($category);die;
        return view('categories.categories')->with(compact('category'));
    }



    public function updatecategorystatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>"; print_r($data);die;
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Category::where('id', $data['category_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'category_id' => $data['category_id']]);
        }
    }

public function appendcategory(Request $request)
{
        if ($request->ajax()) {
            $data = $request->all();
            $getcategory=Category::with('subcategories')->where(['section_id' => $data['section_id'],'parent_id'=>0,'status'=>1])->get();
            $categorystore=json_decode(json_encode($getcategory),true);
            // echo "<pre>"; print_r($categorystore);die;
            return view('categories.append_category')->with(compact('categorystore'));
        }
}
    public function AddEditCategory(Request $request,$id=null)
    {
             if($id=="")
             {
                   $title="Add Catagory";
                   $category=new Category;
                   $categorydata=array();
            $categorystore=array();
           $message= 'Category Added Successfully';
             }
             else {
            $title = "Edit Catagory";
                  $categorydata=Category::where('id',$id)->first();
            $categorystore = Category::with('subcategories')->where(['parent_id'=>0,'section_id'=>$categorydata['section_id']])->get();
            $categorystore=json_decode(json_encode($categorystore),true);
            $category=Category::find($id);
            $message = 'Category updated Successfully';
       //echo "<pre>"; print_r($getCategories);die;
             }
              if ($request->isMethod('post')) {
            $data = $request->all();
            //thses not required
            if ($request->hasFile('category_image')) {
                $image_tmp = $request->file('category_image');
                if ($image_tmp->isValid()) {
                    // Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    // Generate New Image Name
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $imagePath = 'Images/category_image/' . $imageName;
                    // Upload the Image
                    Image::make($image_tmp)->save($imagePath);
                    //save imgaes category
                    $category->category_image = $imageName;

                }
            }
if (empty($data['category_discount'])) {
                $data['category_discount']=0;
            }

            if (empty($data['category_description'])) {
                $data['category_description']="";
            }

            if (empty($data['meta_title'])) {
                $data['meta_title'] = "";
            }
            if (empty($data['meta_keywords'])) {
                $data['meta_keywords'] = "";
            }
            if (empty($data['meta_description'])) {
                $data['meta_description'] = "";
            }





            $roles = [
                'category_name' => 'required',
                'section_id' => 'required',
                'category_url'=>'required',
                'category_image' => 'image',

            ];

            $customessage = [
                'category_name.required' => 'Category name is required',
                'section_id.required' => 'Section id is required',
                'category_url.required' => 'category URL is required',
                'category.required' => ' image is required',
                'category_image.image' => 'valid image is required',
            ];


            $this->validate($request, $roles, $customessage);
            $category->parent_id=$data['parent_id'];
            $category->section_id=$data['section_id'];
            $category->category_name=$data['category_name'];
            $category->category_discount=$data['category_discount'];
            $category->category_description=$data['category_description'];
            $category->category_url=$data['category_url'];
            $category->meta_title=$data['meta_title'];
            $category->meta_description=$data['meta_description'];
            $category->meta_keywords=$data['meta_keywords'];
            $category->status = 1;
            $category->save();
             Session::flash('success_message', $message);
            return redirect('admin/category');
        }
               $getsection=Section::where('status',1)->get();


             return view("categories.add_edit_catagories")->with(compact('title','getsection', 'categorydata', 'categorystore'));

    }

public function deleteimage($id)
{
//get image
$categoryimage=Category::select('category_image')->where('id',$id)->first();
//get category image path
$category_path='images/category_image/';

if(file_exists($category_path.$categoryimage->category_image))
{
    unlink($category_path.$categoryimage->category_image);
}

 Category::where('id',$id)->update(['category_image'=>'']);
        $message = 'Image has been delete succesfully ';
        Session::flash('success_message', $message);
        return redirect()->back();
}
    public function deletecategory($id)
    {
        Category::where('id', $id)->delete();
        $message = 'Delete category has been delete succesfully ';
        Session::flash('success_message', $message);
        return redirect()->back();
    }

}
