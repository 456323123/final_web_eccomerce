<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Illuminate\Http\Request;

use Image;
use Illuminate\Auth\Events\Logout;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{

    public function dashboard()
    {    Session::put('page','dashboard');
        return view('admin.admin_dashboard');
    }
    public function sittings()
    { //echo "<pre>"; print_r(Auth::guard('admin')->user());die;
        Session::put('page', 'sittings');
        $admindetail=Admin::where('email',Auth::guard('admin')->user()->email)->first();
        return view('admin.admin_sittings')->with(compact('admindetail'));
    }

    public function admin_user()
    {
         Session::put('page', 'user');
        return view('admin.admin_user');
    }

     public function admin_user_post(Request $request)
    {

         $this->validate(request(), [
            'email' => 'required|email|unique:admins,email',
                'name' => 'required|max:255',
                 'mobile' => 'required|max:255',
                'password' => 'required|confirmed|',

        ]);





        $request['password']=bcrypt($request->password);
        Admin::create($request->all());
         Session::flash('error_message','Succesful Add New User ');
                    return redirect()->back();


    }


    public function login(Request $request){
        if ($request->isMethod('post')) {
                    $data= $request->all();
            //echo "<pre>"; print_r($data);die;

            $roles=[
                'email' => 'required|email|max:255',
                'password' => 'required',];

                $customessage=[
                    'email.required' =>'Email is required',
                    'email.email' => 'Email is not vaild',
                'password.required' => 'Password is required',
                ];

        $this->validate($request,$roles,$customessage);

                    if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password']]))

                    {
                        return redirect('admin/dashboard');

                    }

                    else {
                        Session::flash('error_message','You are not Active by Admin');
                    return redirect()->back();
                    }
        }
        return view('admin.admin_login');
    }
   public function checkcuurentpassword(Request $request){
       $data=$request->all();
      // echo "<pre>"; print_r($data);echo "<pre>";
       //print_r(Auth::guard('admin')->user()->password);die;

       if (Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)) {
           echo "true";
       }
       else {
          echo "false";
       }
   }

    public function updatecuurentpassword(Request $request){


        if ($request->isMethod('post')) {
            $data = $request->all();
            //echo "<pre>"; print_r($data);die;
            if (Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)) {
                if ($data['new_password']== $data['confirm_password']) {
                           Admin::where('id',Auth::guard('admin')->user()->id)->update(['password' => bcrypt($data['new_password'])]);
                    Session::flash('success_message', 'Password has been updated Successfully');
                        }
                else {
                    Session::flash('error_message', 'your new password and confirm password is not match');
                    return redirect()->back();
                }
            }
            else {
                Session::flash('error_message', 'your current password incorrect');

            }
            return redirect()->back();
        }
    }


    public function Logout()
    {

        Auth::guard('admin')->Logout();
        return redirect('/admin');


    }


    public function updateAdmindetails(Request $request)
    {
        Session::put('page', 'update-admin-details');

        if ($request->isMethod('post')) {
            $data = $request->all();
            //echo "<pre>"; print_r($data);die;
            $roles = [
                'admin_name' => 'required|regex:/^[\pL\s]+$/u',
                'admin_mobile' => 'required|numeric',
                'admin_image' => 'image',

            ];

            $customessage = [
                'admin_name.required' => 'Name is required',
                'admin_name.alpha' => 'Name is not valid, you Use numeric numbers',
                'admin_mobile.required' => 'Mobile number is required',
                'admin_image.image'=>'valid image is required',
            ];


            $this->validate($request, $roles, $customessage);
            // Upload Image
            if ($request->hasFile('admin_image')) {
                $image_tmp = $request->file('admin_image');
                if ($image_tmp->isValid()) {
                    // Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    // Generate New Image Name
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $imagePath = 'images/admin_image/admin_photos/' . $imageName;
                    // Upload the Image
                    Image::make($image_tmp)->save($imagePath);
                }
            }
             else if (!empty($data['current_admin_image'])) {
                $imageName = $data['current_admin_image'];
            } else {
                $imageName = "";
            }

            Admin::where('email',Auth::guard('admin')->user()->email)->update(['name'=>$data['admin_name'],'mobile'=>$data['admin_mobile'],'email'=>$data['email'],'image'=>$imageName]);
            Session::flash('success_message', 'Admin details has been updated Successfully');
            return redirect()->back();
        }
        return view('admin.update_admin_details');

    }

}
