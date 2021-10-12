<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   public function subcategories()
   {
       return $this->hasMany('App\Category', 'parent_id')->where('status', 1);
   }
    public function section()
   {
       return $this->belongsTo('App\Section','section_id')->select('id','name');
   }

    public function parentcategory()
    {
        return $this->belongsTo('App\Category', 'parent_id')->select('id', 'category_name');
    }

    public static function Detailcategory($url)
    {
        $categoryDetail=Category::select('id','category_name','parent_id','category_url','category_description')->with(['subcategories'=>
        function($query){
            $query->select('id','parent_id','category_name','parent_id','category_description','category_url')->where('status',1);
        }])->where('category_url',$url)->first()->toArray();
        $catID=array();
        if ($categoryDetail['parent_id']==0) {
            //only shoe main category breadcrubs
          $breadcrubs='<a href="'.url($categoryDetail['category_url']).'">'.$categoryDetail['category_name'].'</a>';
        }
        else {
            //main and sub category breadcrubs
            $parentcategory=Category::select('category_name','category_url')->where('id',$categoryDetail['parent_id'])->first()->toArray();
            $breadcrubs='<a href="'.url($parentcategory['category_url']).'">'.$parentcategory['category_name'].'</a>
            &nbsp; <span class="divider">/</span>&nbsp;<a href="'.url($categoryDetail['category_url']).'">'.$categoryDetail['category_name'].'</a>';
        }
        $catID[]=$categoryDetail['id'];
        foreach ($categoryDetail['subcategories'] as $key => $subcat) {
         $catID[]=$subcat['id'];
        }


       return array('catID'=>$catID,'categoryDetail'=>$categoryDetail,'breadcrubs'=>$breadcrubs);
    }
}
