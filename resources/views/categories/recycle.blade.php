@extends('layouts.view')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Kategori Dihapus</h1>
      <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Kategori Dihapus</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="10px">No.</th>
                  <th>Nama Kategori</th>
                  <th>Dihapus Pada</th>
                  @if(Auth::user()->level==1)
                    <th width="50px">Aksi</th>
                  @endif
                </tr>
                </thead>
                <tbody>
                <?php $no = 1; ?>
                @foreach($data as $d)
                <tr>
                  <td>{{ $no }}</td>
                  <td>{{ $d->name }}</td>
                  <td>{{ indo_date_time($d->deleted_at) }}</td>
                  @if(Auth::user()->level==1)
                    <td>
                      {{ restore($d->id) }}
                    </td>
                  @endif
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
<!-- /.content-wrapper -->
<form id="restore" action="{{ route('category.restore') }}" method="post">
  {{ csrf_field() }}
  <input type="hidden" name="id" id="restoreid">
</form>
@endsection