<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>KAKATU Operasional | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link href="../bower_components/bootstrap/dist/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.css">
  <!-- Animate CSS -->
  <link rel="stylesheet" href="../dist/css/Animate.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="login-page" style="background: url('../dist/img/background_login.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center; background-size: fill; height: 500px;">
<div class="login-box">
  <div class="login-logo fadeInDown animated">
    <b>KAKATU</b> Operasional</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body fadeInRight animated">
    <p class="login-box-msg" style="color: #fff;">Silahkan Login </p>

    <form action="proses_login.php" method="post" id="formlogin">
      <div class="form-group has-feedback">
        <input 
              type="text" class="form-control" id="id" placeholder="Enter ID" name="id" 
              data-validation="length" data-validation-length="min5"
        >
      </div>
      <div class="form-group has-feedback">
        <input 
        type="password" class="form-control" id="password" placeholder="Enter password" name="password"
        data-validation="length" data-validation-length="min5"
        >
      </div>
        <div class="social-auth-links">
        <Button type="submit" name="submit" form="formlogin" class="btn btn-block btn-primary btn-flat" style="text-align: center;">LOGIN</Button>
        </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
</body>
</html>
<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../plugins/iCheck/icheck.min.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>

<script>
  $.validate({
  });
</script>