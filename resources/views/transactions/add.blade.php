@extends('layouts.view')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Penjualan</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
      <li><a href="{{ $back }}">Penjualan</a></li>
      <li class="active">Tambah</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-6">
        @if(session('failed'))
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Gagal!</h4>
            {{-- @foreach(session('failed')->all() as $fail) --}}
              {{ session('failed') }}<br>
            {{-- @endforeach --}}
          </div>
        @endif
        <form role="form" action="{{ $action }}" method="post" id="transaction">
        {{ csrf_field() }}
        <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <a href="{{ $back }}"><i class="fa fa-arrow-left"></i></a>
              <h3 class="box-title">Tambah Penjualan</h3>
              {{ submit_btn() }}
            </div>
            <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12" id="barcodeDiv">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-5">
                          <label for="barcode">Barcode</label>
                          <input type="number" min="1000000000" class="form-control" id="barcode" placeholder="Masukkan Barcode" name="barcode[]" required>
                        </div>
                        <div class="col-md-5">
                          <label for="quantity">Kuantitas</label>
                          <input type="number" min="1" class="form-control" id="quantity" placeholder="Masukkan Kuantitas" name="quantity[]" required>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="payin">Pembayaran (Rp)</label>
                  <input type="number" min="1" class="form-control" id="payin" placeholder="Masukkan Pembayaran" name="payin" required>
                </div>
                <br>
                  <p>
                    <a data-toggle="tooltip" title="Tambah" onclick="barcodeadd()" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                    <a data-toggle="tooltip" title="Cek" onclick="checkprice('{{ route('check.price') }}')" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                  </p>
              </div>
              <!-- /.box-body -->
          </div>
        <!-- /.box -->
        </form>
      </div>
      <div class="col-md-6">
        <form role="form" action="{{ $action }}" method="post">
        {{ csrf_field() }}
        <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Detail Penjualan</h3>
            </div>
            <!-- /.box-header -->
              <div class="box-body" id="struct">
              </div>
              <!-- /.box-body -->
          </div>
        <!-- /.box -->
        </form>
      </div>
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-md-6">
        <form role="form" action="{{ $action }}" method="post">
        {{ csrf_field() }}
        <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Status Produk</h3>
            </div>
            <!-- /.box-header -->
              <div class="box-body" id="productstatus">
              </div>
              <!-- /.box-body -->
          </div>
        <!-- /.box -->
        </form>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection