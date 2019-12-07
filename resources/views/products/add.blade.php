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
      <li class="active">Tambah</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <form role="form" action="{{ $action }}" method="post">
        {{ csrf_field() }}
        <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <a href="{{ $back }}"><i class="fa fa-arrow-left"></i></a>
              <h3 class="box-title">Tambah Produk</h3>
              {{ submit_btn() }}
            </div>
            <!-- /.box-header -->
              <div class="box-body">
                <div class="form-group @if ($errors->has('barcode')) has-error @endif">
                  <label for="barcode">Barcode</label>
                  <input type="number" min="1000000000" class="form-control" id="barcode" placeholder="Masukkan Barcode" name="barcode" required>
                  @if ($errors->has('barcode'))
                    <span class="help-block">
                        <strong>{{ $errors->first('barcode') }}</strong>
                    </span>
                  @endif
                </div>
                <div class="form-group @if ($errors->has('name')) has-error @endif">
                  <label for="name">Nama Produk</label>
                  <input type="text" class="form-control" id="name" placeholder="Masukkan Nama Produk" name="name" required>
                  @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="price">Harga Beli (Rp)</label>
                  <input type="number" min="100" class="form-control" id="price" placeholder="Masukkan Harga Beli" name="price" required>
                </div>
                <div class="form-group">
                  <label for="sell_price">Harga Jual (Rp)</label>
                  <input type="number" min="100" class="form-control" id="sell_price" placeholder="Masukkan Harga Jual" name="sell_price" required>
                </div>
                <div class="form-group">
                  <label for="stock">Stok</label>
                  <input type="number" min="1" class="form-control" id="stock" placeholder="Masukkan Stok" name="stock" required>
                </div>
                <div class="form-group">
                  <label for="category">Kategori</label>
                  <select class="form-control select2" id="category" name="category">
                    @foreach($categories as $c)
                      <option value="{{ $c->id }}">{{ $c->name }}</option>
                    @endforeach
                  </select>
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