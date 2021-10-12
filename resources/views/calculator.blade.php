<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Calculator</title>
         <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- datatable -->
   <link rel="stylesheet" href="{{ url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{url('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- Select2 -->
  <link rel="stylesheet" href="{{url('plugins/select2/css/select2.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{url('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{url('plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('css/Admin_css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{url('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{url('plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{url('plugins/summernote/summernote-bs4.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<style>
    .card-body {

    padding: 0px;

}
</style>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    </head>
    <body style="background-color: #D2691E;">
        <br><br><br>
          <div class="container text-center">
              <div class="row">
                  <div class="col-md-4 m-auto">
                      @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                    <form action="calculation" method="POST">
                        @csrf
                        <div class="card" style="background-color: #2E8B57;">
                          <div class="card-body m-auto">
                              <h1 class="text-center text-light">Mirror Calculator</h1>

                              <div class="form-group row justify-content-center">
                                  <div class="col-md-9">
                                      <input type="number" value ="10" name="width" class="form-control" placeholder="Enterw idth" required="">
                                  </div>
                              </div>

                               <div class="form-group row justify-content-center">
                                  <div class="col-md-9">
                                      <input type="number" value ="10" name="length" class="form-control" placeholder="Enter second number" >
                                  </div>
                               </div>
   <div class="form-group row justify-content-center">
                                  <div class="col-md-9">
                                      <input type="number" hidden value ="10" name="result" class="form-control" placeholder="Enter second number" >
                                  </div>
                               </div>


                              </div>
 <input type="submit" name="btn" class="btn btn-warning btn-lg font-weight-bold" value="Enter">
                          </div>

                      </div>

                    </form>
                  </div>

              </div>
          </div>



<div class="card-body row row-cols-1 "  >
            <ul class="list-group  " style="margin-top:-20px; ">
              @foreach($sections as $section)

                   <li class="list-group-item   " style='font-size:15px; border-radius:0px' >


                 <div  style="margin-left:1px; " class=" col-lg-4 col-md-3  col-sm-12 p-0">  ID  {{ $section->id }}
                 </div>
                 <br>
                 <div style="margin-left:1px;" >   Width   {{ $section->width }}
                 </div>
                 <br>
                 <div style="margin-left:1px;" > Length {{ $section->length }}
                 </div>
                  <br>
                   <div style="margin-left:1px;" > Cinti Meter {{ $section->result_cm }}
                 </div>
                  <br>
                  <div style="margin-left:1px;">
                      <div style="margin-left:1px;" >  Meter  {{ $section->result_m }}</a>
                 </div>
                 <br>




                </li>



              @endforeach
            </ul>
          </div>
<script>
  $(function () {
    $("#sections").DataTable({
      "responsive": true,
      "autoWidth": false,
    });

     $("#category").DataTable({
      "responsive": true,
      "autoWidth": false,
    });

  });
</script>
<script src="{{ url('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    </body>
</html>
