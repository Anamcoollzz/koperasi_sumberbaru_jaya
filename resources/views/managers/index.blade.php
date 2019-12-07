@extends('layouts.view')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Manajer</h1>
      <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Manajer</li>
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
              {{ add_btn($add) }}
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="10px">No.</th>
                  <th width="150px">Nama</th>
                  <th>Jenis Kelamin</th>
                  <th>TTL</th>
                  <th>Alamat</th>
                  <th>Username</th>
                  <th width="120px">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php $no = 1; ?>
                @foreach($data as $d)
                <tr>
                  <td>{{ $no }}</td>
                  <td>{{ ucwords(strtolower($d->name)) }}</td>
                  <td>{{ $d->gender }}</td>
                  <td>{{ ucwords(strtolower($d->city)).', '.indo_date($d->birthdate) }}</td>
                  <td>{{ $d->address }}</td>
                  <td>{{ $d->username }}</td>
                  <td>
                    {{ edit_btn(route('manager.edit', $d->id)) }}
                    {{ delete_btn($d->id) }}
                    {{ reset_btn($d->login) }}
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
  <form id="reset" action="{{ $reset }}" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="id" id="id2">
    <input type="hidden" name="_method" value="PUT">
  </form>
<!-- /.content-wrapper -->
@endsection