<?php 
session_start();

if($_SESSION['Level'] != '2'){
  header('location:index.php');
}
require('class/C_profile_guru.php');
$prof = new C_profile;
$id = $_SESSION['IdMember'];
$data = $prof->getProfile($id); 


//Function UPdate

if(isset($_POST['update'])){
  $idmember = $_SESSION['IdMember'];
  $nama     = htmlspecialchars($_POST['nama']);
  $NoTlp    = htmlspecialchars($_POST['NoTlp']);

  $exec_edit = $prof->editProfile($idmember,$nama,$NoTlp);

  if($exec_edit){
    $msg = '<div class="alert alert-success">
    <strong>Success!</strong> Indicates a successful or positive action.
    </div>'; header('location:profile_guru.php');
  } else {
    $msg = '<div class="alert alert-danger">
    <strong>Danger!</strong> Indicates a dangerous or potentially negative action.
    </div>';
  }

}


?>
<?php  require_once('template/header.php') ;?>
<?php
if(isset($msg))
{
  echo $msg;
}
?>
<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu" data-widget="tree">
  <li class="header">MAIN NAVIGATION</li>
  <li class="active">
    <a href="profile_guru.php">
      <i class="fa fa-user"></i> <span>Profile</span>
    </a>
  </li>
  <li class="treeview">
    <a href="#">
      <i class="fa fa-book"></i> <span>Materi</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="input_materi.php"><i class="fa fa-circle-o"></i> Input Materi</a></li>
      <li><a href="post_materi.php"><i class="fa fa-circle-o"></i> ALL POST</a></li>
    </ul>
  </li>
  <li class="treeview">
    <a href="#">
      <i class="fa fa-file"></i> <span> BANK SOAL</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="input_soal.php"><i class="fa fa-circle-o"></i> Input Soal</a></li>
      <li><a href="bank_soal.php"><i class="fa fa-circle-o"></i> ALL Soal</a></li>
    </ul>
  </li>
    <li>
        <a href="nilai_siswaku.php">
            <i class="fa fa-table"></i> <span>Nilai Siswa</span>
        </a>
    </li>
  <li class="header">SETTING</li>
  <li>
    <a href="logout.php">
      <i class="fa fa-lock"></i> <span>LOGOUT</span>
    </a>
  </li>
</ul>
</section>
<!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Profile Guru
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Profile Guru</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">


    <div class="panel panel-default panel-info">

      <div class="panel panel-heading panel-info">
        <span class="glyphicon glyphicon-user"></span> Profile
      </div>

      <div class="panel panel-body">


        <div class="col-md-4">
          <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-edit"></span> Edit</button>
        </div>

        <div class="col-md-6">
          <table class="table">
            <tr>
              <td>Nama</td>
              <td>:</td>
              <td><?php echo $data['Nama'] ?></td>
            </tr>
            <tr>
              <td>No Telepon</td>
              <td>:</td>
              <td><?php echo $data['NoTlp'] ?></td>
            </tr>
          </table>
        </div>



      </div>

    </div>
    <!-- /PANEL -->

  </div>
  <!-- / CONTAINER -->

  <!-- Modal -->
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit</h4>
        </div>
        <div class="modal-body">
          <form method="POST">
            <table class="table">
              <tr>
                <td>Nama</td>
                <td>:</td>
                <td><input class="form-control" type="text" name="nama" value="<?php echo $data['Nama'];?>"></td>
              </tr>
              <td>No Telepon</td>
              <td>:</td>
              <td><input class="form-control" type="text" name="NoTlp" value="<?php echo $data['NoTlp'];?>"></td>
            </tr>
            <tr>
              <td colspan="3">
                <button class="btn" type="submit" name="update"><span class="glyphicon glyphicon-send"></span> Update</button>
              </td>
            </tr>
          </table>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

</body>
<?php require_once('template/footer.php') ;?>
<script src="dist/jquery/jquery-1.11.2.min.js"></script>
<script src="dist/bootstrap/js/bootstrap.js"></script>