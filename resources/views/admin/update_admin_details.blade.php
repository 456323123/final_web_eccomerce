@extends('layouts.admin_layout.admin_layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Sittings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Update Admin Details</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update User Detail</h3>
              </div>
              @if(Session::has('error_message'))
 <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top:10px;">
 {{ Session::get('error_message') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
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


@if ($errors->any())
    <div class="alert alert-danger mt-2">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" enctype="multipart/form-data" method="POST" action="{{url('/admin/update-admin-details')}}" name="updateadmindetails" id="updateadminetails">
                                         @csrf
                <div class="card-body">
                   <div class="form-group">
                    <label for="exampleInputEmail1"> Admin email Addess</label>
                    <input type="email"  class="form-control" id="email" readonly="" name="email" value="{{ Auth::guard('admin')->user()->email }}"placeholder="Admin email Address" >
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1"> Admin Type</label>
                    <input type="text" class="form-control" id="exampleInputEmail1"  value="{{ Auth::guard('admin')->user()->type }}" placeholder="Admin type" >
                  </div>


                  <div class="form-group">
                    <label for="exampleInputEmail1"> Name</label>
                    <input type="text" class="form-control" id="admin_name" name="admin_name" placeholder=" Enter admin name" value="{{ Auth::guard('admin')->user()->name }}">
                </div>

                   <div class="form-group">
                    <label for="exampleInputEmail1"> Mobile</label>
                    <input type="text" class="form-control" id="admin_mobile" name="admin_mobile" placeholder="New password" value="{{ Auth::guard('admin')->user()->mobile}}">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Image</label>
                    <input type="file" class="form-control" id="admin_image"  name="admin_image" accept="image/*">
                     @if(!empty(Auth::guard('admin')->user()->image))
             <a target="_blank" href="{{ url('images/admin_image/admin_photos/'.Auth::guard('admin')->user()->image) }}"> view image</a>
<input type="hidden" name="current_admin_image" value="{{ Auth::guard('admin')->user()->image }}">
                    @endif
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->


    </section>


  </div>
@endsection
