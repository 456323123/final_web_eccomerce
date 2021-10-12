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
        <div class="row">
          <div class="col-12">



            <div class="card">
              <div class="card-header">

@if(Session::has('success_message'))
 <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top:10px;">
 {{ Session::get('success_message') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
                <h3 class="card-title">Products</h3>
<a href="{{ url('admin/add-edit-product') }}" class="btn btn-block btn-success float-right" style="width: 150px; display:inline-block">Add product</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="products" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                     <th>Product Code</th>
                     <th>product Image</th>
                      <th>product Color</th>
                      <th>Catagory</th>
 <th>Section</th>
 <th>Status</th>
 <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                      @foreach ($products as $product)

                  <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->product_name }}</td>
                     <td>{{ $product->product_code }}</td>
                       <td>
                           <?php $image_path="images/product_image/small/".$product->product_main_image?>
                    @if (!empty($product->product_main_image) && file_exists($image_path))
                          <img style="width: 100px;" src="{{ asset('images/product_image/small/'.$product->product_main_image) }}">
                          @else
                           <img style="width: 100px;" src="{{ asset('images/product_image/small/small_no_image.png') }}">
                    @endif
                    </td>
                     <td>{{ $product->product_color}}</td>
                       <td>{{ $product->category->category_name}}</td>
                          <td>{{ $product->section->name}}</td>

                    <td>@if($product->status==1)
                        <a href="javascript:void(0)" class="update-product-status"  id="product-{{ $product->id }}" product_id="{{ $product->id }}" ><i class="fas fa-toggle-on" aria-hidden="true" status="Active"></i></a>
                         @else
                          <a href="javascript:void(0)" class="update-product-status"  id="product-{{ $product->id }}" product_id="{{ $product->id }}" ><i class="fas fa-toggle-off" aria-hidden="true" status="Inactive"></i></a>
                         @endif

 <td><a title="Add/Edit product-attribute" href="{{url('admin/add-attributes/'.$product->id)}}" ><i class="fas fa-plus"></i></a>&nbsp;&nbsp;
    <a title="Add/Edit product-Images" href="{{url('admin/add-images/'.$product->id)}}" ><i class="fas fa-images"></i>&nbsp;&nbsp;
     <a title="Edit product" href="{{url('admin/add-edit-product/'.$product->id)}}" ><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
<a title="Delete product" class="confirmproductDelete" href="javascript:void(0)" record="product" recordname="{{ $product->product_name }}" recordid="{{ $product->id }}" <?php /* href="{{url('admin/delete-category/'.$category->id)}}" */ ?>><i class="fas fa-trash"></i></a></td>

                    </td>

                  </tr>
  @endforeach
                  </tbody>

                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection
