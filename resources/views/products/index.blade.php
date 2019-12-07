@extends('layouts.view')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Produk</h1>
      <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Produk</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          @if(session('success'))
            <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-check"></i> Sukses!</h4>
              {{ session('success') }}
            </div>
          @endif
          @if(session('failed'))
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-check"></i> Gagal!</h4>
              @foreach(session('failed')->all() as $fail)
                {{ $fail }}<br>
              @endforeach
            </div>
          @endif
          <div class="box">
            <div class="box-header">
              {{ add_btn($add) }}
              Filter berdasarkan kategori
              <select class="select2 col-xs-2" onchange="products(this.value)">
                <option @if('all'==$category) selected @endif value="{{ route('products', 'all') }}">Semua</option>
                @foreach($categories as $c)
                  <option @if($c->id==$category) selected @endif value="{{ route('products', $c->id) }}">{{ $c->name }}</option>
                @endforeach
              </select>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Barcode</th>
                  <th>Nama</th>
                  <th>HB (Rp)</th>
                  <th>HJ (Rp)</th>
                  <th>Laba (Rp)</th>
                  <th>S</th>
                  <th>Kategori</th>
                  <th width="100px">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php $no = 1; ?>
                @foreach($data as $d)
                <tr>
                  <td>{{ $no }}</td>
                  <td>{{ $d->barcode }}</td>
                  <td>{{ $d->name }}</td>
                  <td>{{ number_format($d->price, 0, ',', '.') }}</td>
                  <td>{{ number_format($d->sell_price, 0, ',', '.') }}</td>
                  <td>{{ number_format($d->sell_price-$d->price, 0, ',', '.') }}</td>
                  <td>{{ $d->stock }}</td>
                  <td>{{ $d->category_name }}</td>
                  <td>
                    {{ edit_btn(route('product.edit', [$category, $d->id])) }}
                    {{ edit_btn(route('product.edit.stock', [$category, $d->id]), 'Ubah Stok') }}
                    {{ delete_btn($d->id) }}
                  </td>
                </tr>
                <?php $no++ ?>
                @endforeach
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <form id="delete" action="{{ $delete }}" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="id" id="id">
    <input type="hidden" name="_method" value="DELETE">
  </form>
<!-- /.content-wrapper -->
@endsection