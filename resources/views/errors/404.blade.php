<!DOCTYPE html>
<html>
@include('layouts.head')
<body class="hold-transition skin-blue sidebar-mini">
  {{-- <div class="wrapper"> --}}
    {{-- @include('layouts.leftbars') --}}
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      404 Error Page
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('/') }}"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">404 error</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="error-page">
      <h2 class="headline text-yellow"> 404</h2>

      <div class="error-content">
        <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>

        <p>
          We could not find the page you were looking for.
          Meanwhile, you may <a href="{{ route('/') }}">return to home</a> or try using the search form.
        </p>
      </div>
      <!-- /.error-content -->
    </div>
    <!-- /.error-page -->
  </section>
  <!-- /.content -->
{{-- </div> --}}
<!-- /.content-wrapper -->
</body>
</html>