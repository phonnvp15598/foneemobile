<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log in Admin FoneeMobile</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('public/backend/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('public/backend/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('public/backend/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('public/backend/dist/css/AdminLTE.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('public/backend/plugins/iCheck/square/blue.css')}}">
  <link rel="icon" href="{{asset('/public/frontend/images/logofm.png')}}">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="{{route('admin.login')}}"><b>Admin</b>FoneeMobile</a>
    <img src="{{asset('/public/frontend/images/foneemobilelogo_final.png')}}" alt="">
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="" method="post" role="form" enctype="multipart/form-data">
      @csrf
    <div class="form-group has-feedback">
      <input name="name" type="text" class="form-control" placeholder="Username" value="{{old('name')}}">
      <span class="glyphicon glyphicon-user form-control-feedback"></span>
      @error('name')
          <p class="badge badge-danger" style="background: red; color:white">{{ $message }}</p>
      @enderror
    </div>
    <div class="form-group has-feedback">
      <input name="email" type="text" class="form-control" placeholder="Email" value="{{old('email')}}" >
      <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      @error('email')
          <p class="badge badge-danger" style="background: red; color:white">{{ $message }}</p>
      @enderror
    </div>
    <div class="form-group has-feedback">
      <input name="password" type="password" class="form-control" placeholder="Password" value="{{old('password')}}">
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      @error('password')
      <p class="badge badge-danger" style="background: red; color:white">{{ $message }}</p>
      @enderror
    </div>
    <div class="form-group has-feedback">
      <label for="">Avatar</label>
      <input name="avatar" type="file" class="form-control" >
    </div>
    <div class="row">
      <div class="col-xs-4">
        <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
      </div>
      <div class="col-xs-4">
          <a href="{{route('admin.login')}}">Bạn đã có tài khoản?</a>
        </div>
      
      <!-- /.col -->
    </div>
      @php
          $message = Session::get('message');
          if($message){
              echo '<span style="color: red">'.$message.'</span>';
              Session::put('message', null);
          }
      @endphp
  </form>


    <!-- /.social-auth-links -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{asset('public/backend/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('public/backend/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- iCheck -->
<script src="{{asset('public/backend/plugins/iCheck/icheck.min.js')}}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>