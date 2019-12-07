@extends('layouts.view')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Kategori</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Kategori</li>
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
          <div class="box">
            <div class="box-header">
              {{ add_btn(route('category.add')) }}
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="10px">No.</th>
                  <th>Nama Kategori</th>
                  <th width="120px">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php $no = 1; ?>
                @foreach($data as $d)
                <tr>
                  <td>{{ $no }}</td>
                  <td>{{ $d->name }}</td>
                  <td>
                    {{ edit_btn(route('category.edit', $d->id)) }}
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
  <form id="delete" action="{{ route('category.delete') }}" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="id" id="id">
  </form>
<!-- /.content-wrapper -->
@endsection