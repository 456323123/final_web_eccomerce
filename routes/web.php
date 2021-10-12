<?php

use App\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|

Route::get('/', function () {
    return view('front.index');
});
*/
Route::get('showcal', 'CalculatorController@sections');

Route::post('calculation', 'CalculatorController@index');


Route::view('loginpage', 'loginadmin');
Auth::routes();

  Route::get('contact-us',function(){
echo "khan";die;
    });

Route::get('/home', 'HomeController@index')->name('home');
Route::prefix('/admin')->namespace('Admin')->group(function () {
         Route::match(['get', 'post'], '/', 'AdminController@login');
         Route::group(['middleware' => ['admin']], function () {
              Route::get('dashboard', 'AdminController@dashboard');
              Route::get('sittings', 'AdminController@sittings');
              Route::get('logout', 'AdminController@Logout');
        Route::post('check-current-pwd', 'AdminController@checkcuurentpassword');
        Route::post('update-current-pwd', 'AdminController@updatecuurentpassword');
 Route::get('user', 'AdminController@admin_user');
 Route::post('admin_post', 'AdminController@admin_user_post');
        Route::match(['get', 'post'], 'update-admin-details', 'AdminController@updateAdmindetails');

       //section
        Route::get('sections','SectionController@sections')->name('section.index');
        Route::get('add-edit-section','SectionController@Editsections');
         Route::post('edit-section','SectionController@index');
    Route::get('section/{id}', 'SectionController@delete')->name('section.delete');
        Route::post('update-section-status', 'SectionController@updatesectionstatus');

        //brands
        Route::get('brands','BrandController@brands');
Route::post('update-brand-status', 'BrandController@updatebrandstatus');
     Route::match(['get','post'], 'add-edit-brand/{id?}', 'BrandController@AddEditBrand');
      Route::get('brands/{id}', 'BrandController@deletebrand')->name('brand.delete');
        // catagory
        Route::get('category', 'CategoryController@category');
        Route::post('update-category-status', 'CategoryController@updatecategorystatus');
        Route::match(['get','post'], 'add-edit-category/{id?}', 'CategoryController@AddEditCategory');
        Route::post('append-category-level', 'CategoryController@appendcategory');
        Route::get('delete-category-image/{id}', 'CategoryController@deleteimage');
        Route::get('delete-category/{id}', 'CategoryController@deletecategory');
            // products
            Route::get('products', 'ProductsController@products');
        Route::post('update-product-status', 'ProductsController@updateproductstatus');
        Route::get('delete-product/{id}', 'ProductsController@deleteproduct');
        Route::match(['get','post'], 'add-edit-product/{id?}', 'ProductsController@AddEditProduct');
          Route::get('delete-product-image/{id}', 'ProductsController@deleteproductimage');
          // products attributes
            Route::match(['get','post'], 'add-attributes/{id}', 'ProductsController@AddProductAttribute');
             Route::post('edit-attributes/{id}', 'ProductsController@EditProductAttribute');
               Route::post('update-attribute-status', 'ProductsController@updateattributestatus');
                  Route::get('delete-attribute/{id}', 'ProductsController@deleteattribute');
 // products multi images
                    Route::match(['get','post'], 'add-images/{id}', 'ProductsController@AddmultiimagesAttribute');
                     Route::post('update-image-status', 'ProductsController@updateimagestatus');
                      Route::get('delete-images/{id}', 'ProductsController@deleteimages');


         });


});


Route::namespace('Front')->group(function () {


      Route::get('/', 'IndexController@index');
      $caturl=Category::select('category_url','status')->where('status',1)->get()->pluck('category_url')->toArray();
     // $caturl=json_decode(json_encode($caturl));
        // echo "<pre>"; print_r($caturl);die;
foreach ($caturl as  $url) {
           Route::get('/'.$url, 'ProductsController@listing');
}
 Route::get('product/{id}','ProductsController@Detail');
Route::post('/get-product-price','ProductsController@GetProductPrice');
Route::post('/add-to-cart','ProductsController@addToCart');
Route::get('/cart','ProductsController@Cart');
});

