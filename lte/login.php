<?php 
session_start();
require '../koneksi.php';

if (isset($_POST['login'])) {
    $username=$_POST['username'];
    $password=$_POST['password'];

    $sql=mysqli_query($koneksi,"SELECT * FROM tb_user WHERE username='$username' AND password='$password'");
    // $num=mysqli_num_rows($sql);

    if (mysqli_num_rows($sql)>0) { 
        $data=mysqli_fetch_assoc($sql);
        if ($data['role']=="admin") {
          header("location:admin/index.php");
        }elseif ($data['role']=="Pencari Kerja") {
          header("location:../home.php");
        }else{
          header("location:perusahaan/index.php");
        }
        $_SESSION['id_user']=$data['id_user'];
        $_SESSION['username']=$username;
        $_SESSION['nama']=$data['nama'];
    }else{
      header("location:login.php");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href=""><b>SELAMAT</b>DATANG</a>
    <a href=""><b>LOKER</b>19</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Silahkan anda melakukan Log in untuk mengakses web ini</p>

      <form method="POST">
        <div class="form-group has-feedback">
          <input type="text" class="form-control" name="username" placeholder="Username">
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <div class="row">
          <!-- <div class="col-8">
            <div class="checkbox icheck">
              <label>
                <input type="checkbox"> Remember Me
              </label>
            </div>
          </div> -->
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="login" class="btn btn-primary">Sign In</button>
          </div>
          <p><a href="register.php">Ayo daftar Sekarang!</a></p>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass   : 'iradio_square-blue',
      increaseArea : '20%' // optional
    })
  })
</script>
</body>
</html>
