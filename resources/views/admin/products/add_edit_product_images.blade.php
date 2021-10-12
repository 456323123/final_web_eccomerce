@extends('layouts.admin_layout.admin_layout')
@section('content')
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product Attributes</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Product Attributes</li>
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
     <form name="productImageForm" id="productImageForm" method="post" action="{{ url('admin/add-images/'.$productdata['id']) }}" enctype="multipart/form-data">
        @csrf
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Add Images</h3>

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
                    <label for="name_product">product name :</label>&nbsp;{{$productdata['product_name'] }}
                  </div>


<div class="form-group">
                    <label for="product_code">product code :</label>&nbsp;{{$productdata['product_color'] }}
                  </div>
                  <div class="form-group">
                    <label for="product_color">product Color :</label>&nbsp;{{$productdata['product_code'] }}
                  </div>
  </div>



  <div class="col-md-6">
               <div class="form-group">
<img style="width:150px;"  src="{{ asset('images/product_image/small/'.$productdata['product_main_image']) }}">

                </div>

              </div>




              <div class="col-md-6">
               <div class="form-group">
<div class="field_wrapper">
    <div>
        <input multiple="" type="file" style="width:120px" id="image" name="image[]" value="" required=""/>


    </div>
</div>

                </div>

              </div>
            </div>



              </div>
            </div>
          </div>

          <div class="card-footer">
           <button type="submit" class="btn btn-primary">Save Images</button>
          </div>

          </form>

          <form name="EditImageForm" id="EditImageForm" method="post" action="{{ url('admin/edit-Images/'.$productdata['id']) }}" >
            @csrf
            <div class="card">
              <div class="card-header">

@if(Session::has('success_message_atr'))
 <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top:10px;">
 {{ Session::get('success_message_atr') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif



                <h3 class="card-title">Edit Attribute</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="products" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>image</th>
                    <th>Status</th>
                     <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                      @foreach ($productdata['images'] as $image)

                  <tr>
                     <td>{{  $image['id'] }}</td>
                     <td><img style="width:150px;"  src="{{ asset('Images/product_image/small/'.$image['image']) }}">
</td>

                         <td>
                               @if($image['status']==1)
                        <a href="javascript:void(0)" class="update-image-status"  id="image-{{ $image['id'] }}" image_id="{{ $image['id'] }}">Active</a>
                         @else
                          <a href="javascript:void(0)" class="update-image-status"  id="image-{{ $image['id'] }}"  image_id="{{ $image['id'] }}">Inactive</a>
                          @endif

                         </td>
                         <td> &nbsp;&nbsp;
<a title="Delete image" class="productsimage" href="javascript:void(0)" record="delete-images" recordname="{{$image['image'] }}" recordid="{{ $image['id'] }}" <?php /* href="{{url('admin/delete-category/'.$category->id)}}" */ ?>><i class="fas fa-trash"></i></a></td>

                  </tr>
  @endforeach
                  </tbody>

                </table>
              </div>

          <div class="card-footer">
           <button type="submit" class="btn btn-primary">Update Attribute</button>
          </div>


        </form>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>


      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
