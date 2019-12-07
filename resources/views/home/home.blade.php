@extends('layouts.view')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Beranda</h1>
      <ol class="breadcrumb">
        <li class="active"><i class="fa fa-home"></i> Beranda</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#tab_1-1" data-toggle="tab">Bulan ini</a></li>
              <li><a href="#tab_2-2" data-toggle="tab">Per Bulan</a></li>
              <li class="pull-left header"><i class="fa fa-th"></i> Grafik Data Penjualan</li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1-1">
                <div class="chart">
                  <canvas id="barChart" style="height:400px"></canvas>
                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2-2">
                <div class="chart">
                  <canvas id="barChart2" style="height:400px"></canvas>
                </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
<!-- /.content-wrapper -->
@endsection
@include('home.graphich')