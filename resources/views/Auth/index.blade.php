<!DOCTYPE html>
<html lang="en">
<head>
  <div class="session-success" data-flashsuccess="{{ session('success') }}"></div>
  <div class="session-error" data-flasherror="{{ session('error') }}"></div>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>SIPENGUJI | Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{'assets/vendor/'}}/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{'assets/vendor'}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{'assets/vendor'}}/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>Login</b></a>
    </div>
    <div class="card-body">
      <div class="text-center mb-4">
        <img src="{{'assets/img/logo.png'}}" width="35%"/>
      </div>
      @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>{{ session('success') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif
      
      @if(session()->has('errorLogin'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>{{ session('errorLogin') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif
      <form action="{{ url('/auth/login') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" placeholder="Username">
          @error('username')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password">
          @error('username')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <p class="mb-0">
        <a href="{{'auth/create'}}" class="text-center">Belum punya akun? <u>Registrasi</u></a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{'assets/vendor'}}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{'assets/vendor'}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{'assets/vendor'}}/dist/js/adminlte.min.js"></script>
</body>
</html>