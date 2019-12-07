@extends('layouts.view')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Produk</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
      <li><a href="{{ $back }}">Produk</a></li>
      <li class="active">Ubah</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        @if(session('failed'))
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Gagal!</h4>
            {{ session('failed') }}
          </div>
        @endif
        <form role="form" action="{{ $action }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">
        <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <a href="{{ $back }}"><i class="fa fa-arrow-left"></i></a>
              <h3 class="box-title">Ubah Stok Produk</h3>
              {{ submit_btn() }}
            </div>
            <!-- /.box-header -->
              <div class="box-body">
                <div class="form-group @if(session('failed')) has-error @endif">
                  <label for="stock">Perubahan Stok</label>
                  <input type="number" class="form-control" id="stock" placeholder="Masukkan Perubahan Stok" name="stock" required value="{{ old('stock') }}">
                </div>
              </div>
              <!-- /.box-body -->
          </div>
        <!-- /.box -->
        </form>
      </div>
      <!--/.col (left) -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection