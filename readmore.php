<?php
session_start();

if($_SESSION['Level'] != '2'){

  header('location:index,php');
}
require('class/C_profile_guru.php');
$forward = new C_profile;
$penulis = $_SESSION['username'];

if(isset($_POST['new_'])){
 $mp = $_POST['mp'];
 $judul = $_POST['judul'];
 $content = $_POST['content'];

 $insert = $forward->saveMateri($mp,$judul,$content,$penulis);
}
?>
<?php include('template/header.php') ;?>

<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu" data-widget="tree">
  <li class="header">MAIN NAVIGATION</li>
  <li>
    <a href="profile_guru.php">
      <i class="fa fa-user"></i> <span>Profile</span>
    </a>
  </li>
  <li class="active treeview">
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
      POST Materi
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Materi</li>
      <li class="active">Post Materi</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div id="all" class="panel panel-default panel-info">
          <div class="panel panel-heading"> All POST</div>
          <?php 
          $file = $_GET['id'];

          $query = "SELECT * FROM post_materi JOIN biodata_guru ON post_materi.IdGuru = biodata_guru.Id where IdPost='$file'";        
          $record_per_page=1;
          $newquery = $forward->paging($query,$record_per_page);
          $forward->getPOST($newquery); 

          ?>
        </div>

        <!-- /content -->
      </div>
    </div>
  </section>

  <!-- CONTAINER -->
</body>
<?php include('template/footer.php'); ;?>
</html>