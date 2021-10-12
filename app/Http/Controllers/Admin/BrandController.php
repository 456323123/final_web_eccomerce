<?php

namespace App\Http\Controllers\admin;

use App\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class BrandController extends Controller
{
   public function brands()
    {
 Session::put('page','brands');
       $brands= Brand::get();

    //    $category=json_decode(json_encode($category));
    //    echo "<pre>"; print_r($category);die;

        return view('admin.brands.band')->with(compact('brands'));

    }

     public function updatebrandstatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>"; print_r($data);die;
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Brand::where('id', $data['brand_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'brand_id' => $data['brand_id']]);
        }
    }
  public function deletebrand($id)
    {
      Brand::where('id', $id)->delete();
        $message = 'Delete Brand has been delete succesfully ';
        Session::flash('success_message', $message);
        return redirect()->back();
    }
    public function AddEditBrand(Request $request,$id=null)
    {
        Session::put('page','brands');
        if($id=="")
        {
            $title="Add Brand";
            $brand=new Brand();
            $message="Brand added successfully";

        }
        else {
             $title="Edit Brand";
             $brand=Brand::find($id);
             $message="Brand added successfully";
             $message="Brand update successfully";
        }

// all data for both case post and update use *post method*
 if ($request->isMethod('post')) {
     $data = $request->all();
       // echo "<pre>"; print_r($data);die;


        $roles = [

                'name' => 'required',


            ];

            $customessage = [

                '.required' => 'Brand name is reiquired',

           #
            ];



            $this->validate($request, $roles, $customessage);
            $brand->name=$data['name'];
            $brand->status=0;
            $brand->save();
             Session::flash('success_message', $message);
            return redirect('admin/brands');
 }

 return view('admin.brands.add_edit_brand')->with(compact('brand','title'));
    }


}
