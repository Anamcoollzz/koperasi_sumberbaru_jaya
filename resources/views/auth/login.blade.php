<!DOCTYPE html>
<html>
@include('layouts.head')
<style type="text/css">
  .login-page {
    background: url('{{ asset('images/login/bg.jpg') }}');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
  }
  html{
    height: 100% !important;
  }
</style>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <h3><b>Koperasi</b> Sumber Baru Jaya</h3>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Masuk untuk memulai</p>

      <form action="{{ route('login') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group has-feedback @if ($errors->has('username')) has-error @endif">
          <input type="text" class="form-control" placeholder="Username" name="username" required>
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
          @if ($errors->has('username'))
              <span class="help-block">
                  <strong>{{ $errors->first('username') }}</strong>
              </span>
          @endif
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="Password" name="password" required>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-box-body -->
  </div>
<!-- /.login-box -->
@include('layouts.script')
</body>
</html>