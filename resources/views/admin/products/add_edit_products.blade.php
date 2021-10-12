@extends('layouts.admin_layout.admin_layout')
@section('content')
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Catalouges</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">product</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(Session::has('success_message'))
 <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top:10px;">
 {{ Session::get('success_message') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

        <!-- SELECT2 EXAMPLE -->
     <form name="productForm" id="productForm" @if(empty($productdata['id'])) action="{{ url('admin/add-edit-product') }}" @else action="{{ url('admin/add-edit-product/'.$productdata['id']) }} " @endif method="post" enctype="multipart/form-data">
        @csrf
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                    <div class="form-group">
                  <label>Select section</label>
                  <select name="category_id" id="category_id" class="form-control select2" style="width: 100%;">
                    <option value="">select section</option>
 @foreach($categories as $section )
 <optgroup label="{{ $section['name'] }}"></optgroup>
 @foreach($section['categories'] as $category )
 <option value="{{ $category['id'] }}" @if(!empty(@old('category_id')) && $category['id']== @old('category_id')) selected="" @elseif(!empty($productdata['category_id'] )&& $productdata['category_id']==$category['id'] ) selected="" @endif>
     &nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;{{ $category['category_name']}}</option>
  @foreach($category['subcategories'] as $subcategory )
 <option value="{{ $subcategory['id'] }}"@if(!empty(@old('category_id')) && $subcategory['id']== @old('category_id')) selected="" @elseif(!empty($productdata['category_id'] )&& $productdata['category_id']==$subcategory['id'] ) selected="" @endif>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     ->&nbsp;&nbsp;{{ $subcategory['category_name']}}</option>

 @endforeach
 @endforeach
 @endforeach
                  </select>
                </div>

                 <div class="form-group">
                    <label for="name_product">product name</label>
                    <input type="text" class="form-control" id="product_name"
                    @if(!empty($productdata['product_name'])) value="{{ $productdata['product_name'] }}" @else  value="{{ old('product_name') }}" @endif name="product_name" placeholder="Enter product name">
                  </div>
              </div>

  <div class="col-md-6">
<div class="form-group">
                    <label for="product_code">product code</label>
                    <input type="text" class="form-control" id="product_name"
                    @if(!empty($productdata['product_code'])) value="{{ $productdata['product_code'] }}" @else  value="{{ old('product_code') }}" @endif name="product_code" placeholder="Enter product code">
                  </div>
                  <div class="form-group">
                    <label for="product_color">product Color</label>
                    <input type="text" class="form-control" id="product_name"
                    @if(!empty($productdata['product_color'])) value="{{ $productdata['product_color'] }}" @else  value="{{ old('product_color') }}" @endif name="product_color" placeholder="Enter product color">
                  </div>
  </div>


  <div class="col-md-6">
<div class="form-group">
                    <label for="product_code">product price</label>
                    <input type="text" class="form-control" id="product_name"
                    @if(!empty($productdata['product_price'])) value="{{ $productdata['product_price'] }}" @else  value="{{ old('product_price') }}" @endif name="product_price" placeholder="Enter product price">
                  </div>
                  <div class="form-group">
                    <label for="product_color">product discount (%)</label>
                    <input type="text" class="form-control" id="product_name"
                    @if(!empty($productdata['product_discount'])) value="{{ $productdata['product_discount'] }}" @else  value="{{ old('product_discount') }}" @endif name="product_discount" placeholder="Enter product discount">
                  </div>
  </div>


  <div class="col-md-6">
       <div class="form-group">
                    <label for="product_color">product Weight</label>
                    <input type="text" class="form-control" id="product_name"
                    @if(!empty($productdata['product_weight'])) value="{{ $productdata['product_weight'] }}" @else  value="{{ old('product_weightt') }}" @endif name="product_weight" placeholder="Enter product discount">
                  </div>
               <div class="form-group">
                    <label for="product_main_image">product Main image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="product_main_image" id="product_main_image"  class="custom-file-input" >
                        <label class="custom-file-label" for="product_main_image">Choose file</label>

                      </div>

                      <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                      </div>

                    </div>
                    Recommended Image Size: width:1040px, Height:1200px
                      @if(!empty($productdata['product_main_image']))

                        <div style="height:100px;">

<img style="width:60px;" class="mt-2" src="{{ asset('Images/product_image/small/'.$productdata['product_main_image']) }}">
&nbsp; <a class="confirmproductDelete" recordname="{{$productdata['product_name']}}" href="javacsript:void(0)" record="product-image" recordid="{{$productdata['id']}}" <?php /*href="{{ url('admin/delete-product-image/'.$productdata['id']) }}"*/ ?>>Delete image</a></div>

                        @endif
                </div>

              </div>
            </div>
            <div class="row">
              <div class="col-12 col-sm-6">
                <div class="form-group">
                    <label for="product_video">product Video</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="product_video" id="product_video"  class="custom-file-input" >
                        <label class="custom-file-label" for="product_video">Choose file</label>

                      </div>

                      <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                      </div>

                    </div>
                </div>
                   <div class="form-group">
                    <label for="name_product">product Description</label>
  <textarea class="form-control" name="product_description"  id="product_description"  rows="3" placeholder="Enter ...">@if(!empty($productdata['product_description'])){{$productdata['product_description']}}@else{{old('product_description')}}@endif</textarea>
                  </div>
              </div>
              <div class="col-12 col-sm-6">
            <div class="form-group">
                    <label for="name_product">product washcare</label>
  <textarea class="form-control" name="product_wash_care"  id="product_wash_care"  rows="3" placeholder="Enter ...">@if(!empty($productdata['product_wash_care'])){{$productdata['product_wash_care']}}@else{{old('product_wash_care')}}@endif</textarea>
                  </div>
                    <div class="form-group">
                  <label>Select Fabric</label>
                  <select name="product_fabric" id="product_fabric" class="form-control select2" style="width: 100%;">
                    <option value="">Select Fabric</option>
                  @foreach($fabricArray as $fabric )
                       <option value="{{ $fabric }}" @if(!empty($productdata['product_fabric']) && $productdata['product_fabric']==$fabric)  selected=""  @endif>{{ $fabric }}</option>
                  @endforeach
                  </select>
                </div>
              </div>
               <div class="col-12 col-sm-6">
                    <div class="form-group">
                  <label>Select Sleeve</label>
                  <select name="product_sleeve" id="product_sleeve" class="form-control select2" style="width: 100%;">
                    <option value="">select Sleeve</option>
                  @foreach($SleeveArray as $Sleeve )
                       <option value="{{ $Sleeve }}" @if(!empty($productdata['product_sleeve']) && $productdata['product_sleeve']==$Sleeve)  selected=""  @endif>{{ $Sleeve }}</option>
                  @endforeach
                  </select>
                </div>
                 <div class="form-group">
                  <label>Select Patten</label>
                  <select name="product_pattern" id="product_pattern" class="form-control select2" style="width: 100%;">
                    <option value="">select patten</option>
                  @foreach($PattenArray as $patten )
                       <option value="{{ $patten }}"  @if(!empty($productdata['product_pattern']) && $productdata['product_pattern']==$patten)  selected=""  @endif>{{ $patten }}</option>
                  @endforeach
                  </select>
                </div>
               </div>
                  <div class="col-12 col-sm-6">
                       <div class="form-group">
                  <label>Select Fit</label>
                  <select name="product_fit" id="product_fit" class="form-control select2" style="width: 100%;">
                    <option value="">select fit</option>
                 @foreach($fitArray as $fit )
                       <option value="{{ $fit }}"  @if(!empty($productdata['product_fit']) && $productdata['product_fit']==$fit)  selected=""  @endif>{{ $fit }}</option>
                  @endforeach
                  </select>
                </div>
                 <div class="form-group">
                  <label>Select occassion</label>
                  <select name="product_occassion" id="product_occassion" class="form-control select2" style="width: 100%;">
                    <option value="">Select occassion</option>
                  @foreach($occassionArray as $occassion )
                       <option value="{{ $occassion  }}" @if(!empty($productdata['product_occassion']) && $productdata['product_occassion']==$occassion)  selected=""  @endif>{{ $occassion  }}</option>
                  @endforeach
                  </select>
                </div>
                  </div>

                        <div class="col-12 col-sm-6">
                  <div class="form-group">
                    <label for="name_product">Meta Title</label>
                    <textarea class="form-control" name="product_meta_title"   id="product_meta_title"  rows="3" placeholder="Enter ...">@if(!empty($productdata['product_meta_title'])){{$productdata['product_meta_title'] }} @else{{ old('product_meta_title') }} @endif
                    </textarea>
                  </div>


                  <label>Select Brand</label>
                  <select name="brand_id" id="brand_id" class="form-control select2" style="width: 100%;">
                    <option value="">Select Brand</option>
                  @foreach($brands as $brands )
                       <option value="{{ $brands['id'] }}" @if(!empty($productdata['brand_id']) && $productdata['brand_id']==$brands['id'])  selected=""  @endif>{{ $brands['name'] }}</option>
                  @endforeach
                  </select>

              </div>
               <div class="col-12 col-sm-6">
              <div class="form-group">
                    <label for="name_product">Meta Description</label>
<textarea class="form-control" name="product_meta_description" id="product_meta_description"  rows="3" placeholder="Enter ...">@if(!empty($productdata['product_meta_description'])){{ $productdata['product_meta_description']}} @else{{ old('product_meta_description') }} @endif </textarea>
                  </div>

              </div>
              <div class="col-12 col-sm-6">
                  <div class="form-group">
                    <label for="name_product">Meta keywords</label>
<textarea class="form-control" name="product_meta_keywords"  id="product_meta_keywords"  rows="3" placeholder="Enter ...">@if(!empty($productdata['product_meta_keywords'])){{ $productdata['product_meta_keywords'] }} @else{{ old('product_meta_keywords') }}@endif </textarea>

                </div>
                <div class="form-group">
                    <label for="name_product">Featured Item</label>
 <input type="checkbox" name="product_is_featured" id="product_is_featured" value="Yes" @if(!empty($productdata['product_is_featured']) && $productdata['product_is_featured']=="Yes")  checked=""  @endif>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
           <button type="submit" class="btn btn-primary">save</button>
          </div>
        </div>
        </form>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
