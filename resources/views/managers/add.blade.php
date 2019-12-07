@extends('layouts.view')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Manajer</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
      <li><a href="{{ $back }}">Manajer</a></li>
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
              <h3 class="box-title">Tambah Manajer</h3>
              {{ submit_btn() }}
            </div>
            <!-- /.box-header -->
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Nama</label>
                  <input type="text" class="form-control" id="name" placeholder="Masukkan Nama Manajer" name="name" required value="{{ old('name') }}">
                  @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                  @endif
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-xs-4">
                      <label for="category">Jenis Kelamin</label>
                      <select class="form-control select2" id="category" name="gender">
                        <option value="Laki-laki" @if(old('gender')=='Laki-laki') selected @endif>Laki-laki</option>
                        <option value="Perempuan" @if(old('gender')=='Perempuan') selected @endif>Perempuan</option>
                      </select>
                    </div>
                    <div class="col-xs-4">
                        <label for="city">Tempat</label>
                        <input id="city" type="text" class="form-control" placeholder="Masukkan tempat lahir" value="{{ old('city') }}" name="city">
                    </div>
                    <div class="col-xs-4">
                        <label for="birthdate">Tanggal lahir</label>
                        <input id="birthdate" type="text" class="form-control" placeholder="Masukkan tanggal lahir" value="{{ old('birthdate') }}" name="birthdate">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="address">Alamat</label>
                  <textarea name="address" required class="form-control" placeholder="Masukkan alamat">{{ old('address') }}</textarea>
                </div>
                <div class="form-group @if ($errors->has('username')) has-error @endif">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" id="username" placeholder="Masukkan Username" name="username" required value="{{ old('username') }}" min="6">
                  @if ($errors->has('username'))
                    <span class="help-block">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                  @endif
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