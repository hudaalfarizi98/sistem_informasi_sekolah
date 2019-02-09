<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Halaman Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="dist/css/bootstrap.css" />
  <style type="text/css">
  .login {
    position: absolute;
    width: 400px;
    height: 200px;
    margin-top: -100px ;
    margin-left: -200px;
    left: 50%;
    top: 50%;
    box-shadow: 2px 6px 9px #ddd;

  }
  </style>
</head>
<body>

  <!-- DIV CLASS CONTAINER  -->

  <div class="container">

    <!-- BODY LOGIN -->
    <div class="login">
      <div class="panel panel-default panel-primary">
        <div class="panel panel-heading">
          Login
        </div>
        <form action="index.php" method="POST">
          <div class="panel panel-body">
            <table class="table">
              <tr>
                <td>Username</td>
                <td>:</td>
                <td><input type="text" name="username" class="form-control"></td>
              </tr>
              <tr>
                <td>Password</td>
                <td>:</td>
                <td><input type="password" name="password" class="form-control"></td>
              </tr>
              <tr>
                <td colspan="3"><button type="submit" class="btn btn-success" name="log"> logIN</button></td>
              </tr>
            </table>
          </div>
        </form>
      </div>
    </div>


    <!-- / DIV CLASS LOGIN -->
  </div>

  <!--/ DIV CLASS CONTAINER -->

</body>
</html>
<?php
require('class/C_login.php');
if(isset($_POST['log'])){
  $username = $_POST['username'];
  $password = sha1($_POST['password']);

  $cek = new C_login;
  $cek_rows = $cek->aksi_login($username,$password);
  if($cek_rows > 0 ){
    session_start();
    $_SESSION['username'] = $cek_rows['Username'];
    $_SESSION['IdMember'] = $cek_rows['Id'];
    $_SESSION['Level']    = $cek_rows['Level'];
    if($cek_rows['Level'] == '1'){
      header('location:profile_siswa.php');
    }
    if($cek_rows['Level'] == '2'){
      header('location:profile_guru.php');
    }
    if($cek_rows['Level'] == '3'){
      header("location:admin/dashboard.php");
    }
  }
  else{
    echo "Username dan Password Salah";
  }
}


?>
