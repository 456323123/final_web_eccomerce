@extends('layouts.admin_layout.admin_layout')
@section('content')
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Brands</h1>
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
     <form name="categoryForm" id="categoryForm" @if(empty($brand['id'])) action="{{ url('admin/add-edit-brand') }}" @else action="{{ url('admin/add-edit-brand/'.$brand['id']) }} " @endif method="POST" enctype="multipart/form-data">
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
                    <label for="name">Brand name</label>
                    <input type="text" class="form-control" id="name"
                    @if(!empty($brand['name'])) value="{{ $brand['name'] }}" @else  value="{{ old('name') }}" @endif name="name" placeholder="Enter brand name">
                  </div>

              </div>
            </div>

              </div>
                <div class="card-footer">
           <button type="submit" class="btn btn-primary">save</button>
          </div>
            </div>

          </div>

        </div>
        </form>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection

