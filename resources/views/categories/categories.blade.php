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
                <h3 class="card-title">Categories</h3>
<a href="{{ url('admin/add-edit-category') }}" class="btn btn-block btn-success float-right" style="width: 150px; display:inline-block">Add category</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="category" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Category</th>
                     <th>Parent category</th>
                      <th>Section</th>

<th>URL</th>
 <th>Status</th>
 <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                      @foreach ($category as $category)
                      @if(!isset($category->parentcategory->category_name))
                          <?php $parent_category="Root";?>
                      @else
                       <?php $parent_category=$category->parentcategory->category_name;?>
                       @endif
                  <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->category_name }}</td>
                     <td>{{ $parent_category }}</td>
                     <td>{{ $category->section->name }}</td>
                     <td>{{ $category->category_url }}</td>
                    <td>@if($category->status==1)
                        <a href="javascript:void(0)" class="update-category-status"  id="category-{{ $category->id }}" category_id="{{ $category->id }}">Active</a>
                         @else
                          <a href="javascript:void(0)" class="update-category-status"  id="category-{{ $category->id }}" category_id="{{ $category->id }}">Inactive</a>
                         @endif
 <td><a href="{{url('admin/add-edit-category/'.$category->id)}}" >Edit</a>&nbsp;&nbsp;
<a  class="confirmDelete" href="javascript:void(0)" record="category" recordname="{{ $category->category_name }}" recordid="{{ $category->id }}" <?php /* href="{{url('admin/delete-category/'.$category->id)}}" */ ?>>Delete</a></td>

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
