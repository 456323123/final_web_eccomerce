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
                <h3 class="card-title">ADD Section</h3>
              </div>
            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST"  action="edit-section">
                                         @csrf
                <div class="card-body">
                  <?php /*<div class="form-group">
                    <label for="exampleInputEmail1">Admin Name</label>
                    <input type="text" class="form-control" name="admin_name" id="admin_name"  value="{{ $admindetail->name }}" placeholder="Enter email" >
                  </div>
                   */?>
                   <div class="form-group">
                    <label for="exampleInputEmail1"> Section Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter section name">
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
