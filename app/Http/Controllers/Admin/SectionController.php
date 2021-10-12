<?php

namespace App\Http\Controllers\Admin;

use App\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;


class SectionController extends Controller
{
    public function sections(){
        Session::put('page', 'sections');
        $sections=Section::get();
        return view('admin.section.sections')->with(compact('sections'));

    }
 public function Editsections(){
return view('admin.section.add_edit_section');
 }
//insert data
 public function index(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required',

        ]);
        $name = $request->input('name');

        $table = new Section(); //modelname
        $table->name = $name;
        $table->status = 0;
        $table->save();
        if (!$table) {
            return redirect('/')->with('success_message', 'Your  Section is not Successfull Create!');
        }

        else
        {
        return redirect('/admin/sections')->with('success_message','Your Section is Successfull Create!');
        }
        //echo $result;

    }



 public function delete($id){
        //update post data
        Section::find($id)->delete();

        //store status message
        Session::flash('success_message', 'Section deleted successfully!');

        return redirect()->route('section.index');
    }

    public function updatesectionstatus(Request $request)
    {
        if($request->ajax()){
        $data = $request->all();
       // echo "<pre>"; print_r($data);die;
       if($data['status']=="Active")
       {
           $status=0;
       }
       else {
                $status = 1;
       }
        Section::where('id',$data['section_id'])->update(['status' => $status]);
       return response()->json(['status' => $status,'section_id'=>$data['section_id']]);

        }
    }




}
