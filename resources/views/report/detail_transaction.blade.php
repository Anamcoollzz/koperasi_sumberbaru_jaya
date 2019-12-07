@extends('layouts.view')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Laporan Penjualan</h1>
      <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Laporan Penjualan</li>
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
              <div class="row">
                <div class="col-md-2">
                  Filter berdasarkan waktu
                </div>
                <div class="col-md-2">
                  <select class="select2 col-lg-12" onchange="to(this.value)">
                    <option @if('today'==$time) selected @endif value="{{ route('report.products', 'today') }}">Hari ini</option>
                    <option @if('yesterday'==$time) selected @endif value="{{ route('report.products', 'yesterday') }}">Kemarin</option>
                    <option @if('thisweek'==$time) selected @endif value="{{ route('report.products', 'thisweek') }}">Minggu ini</option>
                    <option @if('thismonth'==$time) selected @endif value="{{ route('report.products', 'thismonth') }}">Bulan ini</option>
                    <option @if('all'==$time) selected @endif value="{{ route('report.products', 'all') }}">Semua</option>
                    <option @if(strpos($time, '-') !==false || strpos($time, 'month')!==false || $time=='Lainnya' || $time=='bebas') selected @endif>Lainnya</option>
                  </select>
                </div>
                <div class="col-md-2">
                  <input type="text" onchange="to(this.value)" class="form-control" id="birthdate" placeholder="Tanggal" @if(strpos($time, '-') !==false) value="{{ str_replace('-', '/', $time) }}" @endif>
                </div>
                <div class="col-md-2">
                  <select class="select2 col-lg-12" id="month">
                    @for($i=1;$i<=12;$i++)
                      <option @if($month==$i) selected @endif value="{{ $i }}">{{ month_name($i) }}</option>
                    @endfor
                    <option value="allmonth">Semua</option>
                    <?php $filter1 = ['all', 'today', 'yesterday', 'thisweek', 'thismonth', 'Lainnya'] ?>
                    <option @if(strpos($time, '-') !==false || in_array($time, $filter1)) selected @endif>Lainnya</option>
                  </select>
                </div>
                <div class="col-md-2">
                  <select class="select2 col-lg-12" id="year">
                    @for($i=2017;$i<=date('Y');$i++)
                      <option @if($year==$i) selected @endif value="{{ $i }}">{{ $i }}</option>
                    @endfor
                    <option @if(strpos($time, '-') !==false  || in_array($time, $filter1)) selected @endif>Lainnya</option>
                  </select>
                </div>
                <div class="col-md-1">
                  <a data-toggle="tooltip" title="Cek" id="{{ route('rp')}}" class="btn btn-sm btn-primary" onclick="filter(this.id)"><i class="fa fa-check"></i></a>
                </div>
                <div class="col-md-1">
                  <a data-toggle="tooltip" title="Cetak" href="@if($month==''){{ route('print.products', $time) }}@else {{ route('print.products.detail', [$month, $year]) }}@endif" class="btn btn-primary btn-sm pull-right" target="_blank"><i class="fa fa-print"></i></a>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="10px">No.</th>
                  <th>Produk</th>
                  <th>Harga Beli (Rp)</th>
                  <th>Harga Jual (Rp)</th>
                  <th>Laba (Rp)</th>
                  <th>Kuantitas</th>
                  {{-- <th>Aksi</th> --}}
                </tr>
                </thead>
                <tbody>
                <?php 
                  $no = 1;
                  $modal = 0;
                  $omset = 0;
                  $income = 0;
                ?>
                @foreach($data as $d)
                <tr>
                  <td>{{ $no }}</td>
                  <td>{{ $d->name }}</td>
                  <td>{{ rupiah($d->price) }}</td>
                  <td>{{ rupiah($d->sell_price) }}</td>
                  <td>{{ rupiah($d->sell_price-$d->price) }}</td>
                  <td>{{ $d->quantity }}</td>
                </tr>
                <?php 
                  $no++; 
                  $modal += $d->price;
                  $omset += $d->sell_price;
                  $income += $d->sell_price-$d->price;
                ?>
                @endforeach
              </table>
              <strong>Kesimpulan : </strong><br>
              Total Modal : {{ rupiah($modal) }} <br>Total Omset : {{ rupiah($omset) }} <br>Total Laba : {{ rupiah($income) }}
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
                  <th>Harga</th>
                  <th>Kuantitas</th>
                </thead>
                <tbody class="detail-body">
                  
                </tbody>
              </table>
            </div>
            <!-- /.widget-user -->
          </div>
        </div>
      </div>
        <!-- /.modal-content -->
    </div>
      <!-- /.modal-dialog -->
  </div>
<!-- /.content-wrapper -->
@endsection