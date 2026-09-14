<?php
 
  session_start();
  require_once("dtbase/koneksi.php");

if(isset($_GET['btnlogin'])){
    $username = $_GET['username'];
    $password = md5($_GET['password']);
 
    $sql = mysqli_query($koneksi,"SELECT * FROM admin WHERE username='$username' AND password='$password'") or die(mysqli_error());
    if(mysqli_num_rows($sql) == 0){

            echo '<script language="javascript">alert("Username atau Password tidak ditemukan !, Mungkin anda belum terdaftar."); document.location="?p=login.php";</script>';
    } else {

        if ($row = mysqli_fetch_assoc($sql)){
            $_SESSION['username']       =$username;
            $_SESSION['password']       =$password;
           
            $sql1 = mysqli_query($koneksi,"SELECT * FROM admin WHERE username='$username'") or die(mysqli_error());
            $dta=mysqli_fetch_object($sql1);
            $_SESSION['hak']            =$dta->role;
           
            echo '<script language="javascript">document.location="index.php";</script>';
        } else {

            echo '<script language="javascript">alert("Anda gagal login, kemungkinan username dan password salah !"); document.location="?p=login";</script>';
        }
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="halaman/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="halaman/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="halaman/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
      <b><font size="4px">SISTEM PEMINJAMAN BUKU</font></b>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Silahkan Login</p>

      <form action="" >
        <div class="input-group mb-3">
          <input type="text" class="form-control" id="username" name="username" placeholder="User">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" id="password" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" id="btnlogin" name="btnlogin" class="btn btn-primary">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="halaman/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="halaman/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="halaman/dist/js/adminlte.min.js"></script>
</body>
</html>
