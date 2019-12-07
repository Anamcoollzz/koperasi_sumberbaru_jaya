@extends('layouts.view')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Kategori</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('categories') }}">Kategori</a></li>
      <li class="active">Ubah</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <form role="form" action="{{ route('category.update', $data->id) }}" method="post">
        {{ csrf_field() }}
          <div class="box box-primary">
            <div class="box-header with-border">
              <a href="{{ route('categories') }}"><i class="fa fa-arrow-left"></i></a>
              <h3 class="box-title">Ubah Kategori</h3>
              {{ submit_btn() }}
            </div>
            <!-- /.box-header -->
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Nama Kategori</label>
                  <input type="text" class="form-control" id="name" placeholder="Masukkan Nama Kategori" name="name" required value="{{ $data->name }}">
                </div>
              </div>
              <!-- /.box-body -->
          </div>
        </form>
        <!-- /.box -->
      </div>
      <!--/.col (left) -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection