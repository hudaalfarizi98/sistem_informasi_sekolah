<?php
session_start();

if($_SESSION['Level'] != '2'){

  header('location:index.php');
}
require('class/C_profile_guru.php');
$forward = new C_profile;
$id = $_SESSION['IdMember'];

if(isset($_POST['new_'])){
 $mp = $_POST['mp'];
 $judul = $_POST['judul'];
 $content = $_POST['content'];

 $insert = $forward->saveMateri($mp,$judul,$content,$id);
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
      Input Materi
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Materi</li>
      <li class="active">Input Materi</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
    <form method="POST">
      <div class="col-md-8">
        <div id="new" class="panel panel-default panel-info">
          <div class="panel panel-heading"> New POST</div>
          <div class="panel panel-body">
            <select class="form-control" name='mp'>
              <option>---</option>
              <?php $forward->getMapel($id); ?>
            </select><br/>
            <div><input type="text" name="judul" class="form-control" placeholder="JUDUL"> </div><br/>
            <textarea class="form-control" id="new_post" name="content"></textarea>
            <script type="text/javascript">CKEDITOR.replace('new_post');</script><br/>
            <input class="btn btn-primary" type="submit" name="new_" value="Simpan">
          </div>
        </div>
      </div>
    </form>

    <div class="col-md-3 alert alert-warning">
      NOTE : Jika inging Upload materi berupa vidio Silahkan upload ke Youtube terlebih dahulu , setelah itu link nya di embed di sini
    </div>
  </div>
</section>
    <!-- CONTAINER -->
  </body>
  <?php include('template/footer.php');?>
  </html>