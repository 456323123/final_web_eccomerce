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
              <li class="breadcrumb-item active">category</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

@if(Session::has('success_message'))
 <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top:10px;">
 {{ Session::get('success_message') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <!-- SELECT2 EXAMPLE -->
     <form name="categoryForm" id="categoryForm" @if(empty($categorydata['id'])) action="{{ url('admin/add-edit-category') }}" @else action="{{ url('admin/add-edit-category/'.$categorydata['id']) }} " @endif method="POST" enctype="multipart/form-data">
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
                    <label for="name_category">category name</label>
                    <input type="text" class="form-control" id="category_name"
                    @if(!empty($categorydata['category_name'])) value="{{ $categorydata['category_name'] }}" @else  value="{{ old('category_name') }}" @endif name="category_name" placeholder="Enter category name">
                  </div>
              <div id="appendCategoryLevel">@include('categories.append_category')</div>
              </div>
              <div class="col-md-6">
              <div class="form-group">
                  <label>Select section</label>
                  <select name="section_id" id="section_id" class="form-control select2" style="width: 100%;">
                    <option value="">select section</option>
                    @foreach($getsection as $section)
                            <option value="{{ $section->id }}" @if(!empty($categorydata['section_id']) && $categorydata['section_id']==$section->id) selected @endif>{{ $section->name }}</option>
                    @endforeach
                  </select>
                </div>


               <div class="form-group">
                    <label for="category_image">category image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="category_image" id="category_image"  class="custom-file-input" >
                        <label class="custom-file-label" for="category_image">Choose file</label>

                      </div>

                      <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                      </div>

                    </div>
                      @if(!empty($categorydata['category_image']))

                        <div style="height:100px;">

<img style="width:60px;" class="mt-2" src="{{ asset('images/category_image/'.$categorydata['category_image']) }}">
&nbsp; <a class="imagecategory" recordname="{{$categorydata['category_name']}}" href="javacsript:void(0)" record="category-image" recordid="{{$categorydata['id']}}" <?php /*href="{{ url('admin/delete-category-image/'.$categorydata['id']) }}"*/ ?>>Delete image</a></div>

                        @endif
                </div>

              </div>
            </div>
            <div class="row">
              <div class="col-12 col-sm-6">
                <div class="form-group">
                    <label for="category_discount">category Discount</label>
                    <input @if(!empty($categorydata['category_discount'])) value="{{ $categorydata['category_discount'] }}" @else  value="{{ old('category_discount') }}" @endif type="text" class="form-control" id="category_discount" name="category_discount" placeholder="Enter category name">
                  </div>

                   <div class="form-group">
                    <label for="name_category">category Description</label>
  <textarea class="form-control" name="category_description"  id="category_description"  rows="3" placeholder="Enter ...">@if(!empty($categorydata['category_description'])){{$categorydata['category_description']}}@else{{old('category_description')}}@endif</textarea>
                  </div>
              </div>
              <div class="col-12 col-sm-6">
              <div class="form-group">
                    <label for="name_category">category URL</label>
                    <input @if(!empty($categorydata['category_url'])) value="{{ $categorydata['category_url'] }}" @else  value="{{ old('category_url') }}" @endif type="text" class="form-control" id="category_url" name="category_url" placeholder="Enter category name">
                  </div>
                  <div class="form-group">
                    <label for="name_category">Meta Title</label>
                    <textarea class="form-control" name="meta_title"   id="meta_title"  rows="3" placeholder="Enter ...">@if(!empty($categorydata['meta_title'])){{$categorydata['meta_title'] }} @else{{ old('meta_title') }} @endif
                    </textarea>
                  </div>
              </div>
               <div class="col-12 col-sm-6">
              <div class="form-group">
                    <label for="name_category">Meta Description</label>
<textarea class="form-control" name="meta_description" id="meta_description"  rows="3" placeholder="Enter ...">@if(!empty($categorydata['meta_description'])){{ $categorydata['meta_description']}} @else{{ old('meta_description') }} @endif </textarea>
                  </div>

              </div>
              <div class="col-12 col-sm-6">
                  <div class="form-group">
                    <label for="name_category">Meta keywords</label>
<textarea class="form-control" name="meta_keywords"  id="meta_keywords"  rows="3" placeholder="Enter ...">@if(!empty($categorydata['meta_keywords'])){{ $categorydata['meta_keywords'] }} @else{{ old('meta_keywords') }}@endif </textarea>

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

