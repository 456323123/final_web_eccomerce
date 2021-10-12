@extends('layouts.admin_layout.admin_layout')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Brand</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Brand</li>
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
        <div class="row">
          <div class="col-12">



            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Brand</h3>
                <a href="{{ url('admin/add-edit-brand') }}" class="btn btn-block btn-success float-right" style="width: 150px; display:inline-block">Add Brand</a>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="sections" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Status</th>
                     <th>Action</th>

                  </tr>
                  </thead>
                  <tbody>
                      @foreach ($brands as $brand)
                  <tr>
                    <td>{{ $brand->id }}</td>
                    <td>{{ $brand->name }}</td>
                    <td>@if($brand->status==1)
                        <a href="javascript:void(0)" class="update-brand-status"  id="brand-{{ $brand->id }}" brand_id="{{ $brand->id }}">Active</a>
                         @else
                          <a href="javascript:void(0)" class="update-brand-status"  id="brand-{{ $brand->id }}" brand_id="{{ $brand->id }}">Inactive</a>
                         @endif
                    </td>
<td>
     <a title="Edit brand" href="{{url('admin/add-edit-brand/'.$brand->id)}}" ><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
<a title="Delete product" class="brandDelete" href="javascript:void(0)" record="brands" recordname="{{ $brand->name }}" recordid="{{ $brand->id }}" <?php /* href="{{url('admin/delete-category/'.$category->id)}}" */ ?>><i class="fas fa-trash"></i></a></td>
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
