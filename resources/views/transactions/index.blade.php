@extends('layouts.view')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Penjualan</h1>
      <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Penjualan</li>
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
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="10px">No.</th>
                  <th>Nota</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php $no = 1; ?>
                @foreach($data as $d)
                <tr>
                  <td>{{ $no }}</td>
                  <td>{{ $d->nota }}</td>
                  <td>
                    <a data-toggle="tooltip" title="Cetak Struk" target="_blank" href="{{ route('print.struct', $d->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-print"></i></a>
                    <a data-toggle="tooltip" title="Detail" onclick="transactiondetail(this.id)" id="{{ route('transaction.detail', $d->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
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
  <div class="modal fade" role="dialog" id="transactionModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title">Detail Penjualan</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <table class="table table-striped table-bordered">
                <thead>
                  <th>No</th>
                  <th>Produk</th>
                  <th>Harga Beli (Rp)</th>
                  <th>Harga Jual (Rp)</th>
                  <th>Laba (Rp)</th>
                  <th>Kuantitas</th>
                </thead>
                <tbody class="detail-body">
                  
                </tbody>
              </table>
            </div>
            <!-- /.widget-user -->
          </div>
        </div>
        {{-- <div class="modal-footer">
          <div class="pull-left btn-group">
            <button type="button" class="btn btn-warning dropdown-toggle btn-sm btn-flat" data-toggle="dropdown">
              Aksi
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
              <li><a href="{{ route('profile.edit') }}">Ubah</a></li>
              <li><a href="#" onclick="avatar()">Ubah Avatar</a></li>
              <li><a href="#" onclick="pass()">Ubah Password</a></li>
              <li><a href="#" onclick="reset2()">Reset Password</a></li>
              <form id="reset2" action="{{ route('password.reset') }}" method="post">
                  {{ csrf_field() }}
                  <input type="hidden" name="_method" value="PUT">
              </form>
            </ul>
          </div>
        </div> --}}
      </div>
        <!-- /.modal-content -->
    </div>
      <!-- /.modal-dialog -->
  </div>
<!-- /.content-wrapper -->
@endsection