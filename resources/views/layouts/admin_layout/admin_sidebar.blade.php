<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('Images/admin_image/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('Images/admin_image/admin_photos/'.Auth::guard('admin')->user()->image)}}"  class="img-circle elevation-2" >
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ ucwords(Auth::guard('admin')->user()->name) }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
@if (Session::get('page')=="dashboard")
<?php $active ="active"; ?>
@else
<?php $active =""; ?>

@endif
                  <li class="nav-item">
            <a href="{{ url('admin/dashboard') }}" class="nav-link {{ $active }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard

              </p>
            </a>
          </li>

<!--sitting link-->
          <li class="nav-item has-treeview menu-open">
                @if (Session::get('page')=="sittings" || Session::get('page')=="update-admin-details" || Session::get('page')=="user")
<?php $active ="active"; ?>
@else
<?php $active =""; ?>

@endif
            <a href="#" class="nav-link  {{ $active }}" >
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Sittings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
                 @if (Session::get('page')=="user")
                            <?php $active ="active"; ?>
                               @else
                             <?php $active =""; ?>
                             @endif
              <li class="nav-item">

                <a href="{{ url('admin/user') }}" class="nav-link {{ $active }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add users</p>
                </a>
              </li>
                          @if (Session::get('page')=="sittings" )
                            <?php $active ="active"; ?>
                               @else
                             <?php $active =""; ?>
                             @endif

              <li class="nav-item">
                <a href="{{ url('admin/sittings') }}" class="nav-link {{ $active }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Admin update password</p>
                </a>
              </li>
               @if (Session::get('page')=="update-admin-details")
                            <?php $active ="active"; ?>
                               @else
                             <?php $active =""; ?>
                             @endif
              <li class="nav-item">

                <a href="{{ url('admin/update-admin-details') }}" class="nav-link {{ $active }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Admin update Details</p>
                </a>
              </li>

            </ul>
          </li>


<!--catagory link-->
           <li class="nav-item has-treeview menu-open">
                @if (Session::get('page')=="sections" || Session::get('page')=="categories" || Session::get('page')=="brands"
                || Session::get('page')=="products")
<?php $active ="active"; ?>
@else
<?php $active =""; ?>

@endif
            <a href="#" class="nav-link  {{ $active }}" >
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Catagory
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
                          @if (Session::get('page')=="sections" )
                            <?php $active ="active"; ?>
                               @else
                             <?php $active =""; ?>
                             @endif
              <li class="nav-item">
                <a href="{{ url('admin/sections') }}" class="nav-link {{ $active }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sections</p>
                </a>
              </li>

               @if (Session::get('page')=="brands" )
                            <?php $active ="active"; ?>
                               @else
                             <?php $active =""; ?>
                             @endif
              <li class="nav-item">
                <a href="{{ url('admin/brands') }}" class="nav-link {{ $active }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Brands</p>
                </a>
              </li>
               @if (Session::get('page')=="categories")
                            <?php $active ="active"; ?>
                               @else
                             <?php $active =""; ?>
                             @endif
              <li class="nav-item">

                <a href="{{ url('admin/category') }}" class="nav-link {{ $active }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>catagories</p>
                </a>
              </li>


                @if (Session::get('page')=="products")
                            <?php $active ="active"; ?>
                               @else
                             <?php $active =""; ?>
                             @endif
              <li class="nav-item">

                <a href="{{ url('admin/products') }}" class="nav-link {{ $active }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>products</p>
                </a>
              </li>
            </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
