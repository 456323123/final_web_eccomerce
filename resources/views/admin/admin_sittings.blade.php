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
              <li class="breadcrumb-item active">Admin Sittings</li>
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
                <h3 class="card-title">Update password</h3>
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

              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" action="{{url('/admin/update-current-pwd')}}" name="updatePassworForm" id="updatePasswordForm">
                                         @csrf
                <div class="card-body">
                  <?php /*<div class="form-group">
                    <label for="exampleInputEmail1">Admin Name</label>
                    <input type="text" class="form-control" name="admin_name" id="admin_name"  value="{{ $admindetail->name }}" placeholder="Enter email" >
                  </div>
                   */?>
                   <div class="form-group">
                    <label for="exampleInputEmail1"> Admin email Addess</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" readonly="" value="{{ $admindetail->email }}"placeholder="Admin email Address" readonly="">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1"> Admin Type</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" readonly="" value="{{ $admindetail->type }}"placeholder="Admin type" readonly="">
                  </div>


                  <div class="form-group">
                    <label for="exampleInputEmail1"> Current Password</label>
                    <input type="password" class="form-control" id="current_pwd" name="current_pwd" placeholder="Current password">
                     <span id="checkpwd"></span>
                </div>

                   <div class="form-group">
                    <label for="exampleInputEmail1"> New password</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New password">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Confirm password</label>
                    <input type="password" class="form-control" id="confirm_password"  name="confirm_password" placeholder="Confirm password">
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
