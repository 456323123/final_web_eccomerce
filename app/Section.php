<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public static function Get_All_Sections()
    {
        $getallsection=Section::with('categories')->where('status',1)->get();
        $getallsection=json_decode(json_encode($getallsection),true);
        return $getallsection;
       // echo "<pre>"; print_r($getallsection);die;
    }
     public function categories()
   {
        return $this->hasMany('App\Category', 'section_id')->where(['parent_id'=>'Root','status'=> 1])->with('subcategories');
   }
}
