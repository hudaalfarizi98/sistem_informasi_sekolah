<?php
session_start();

if($_SESSION['Level'] != '1'){

  header('location:index,php');
}
require('class/C_profile_siswa.php');
$forward = new C_profile;
$id = $_SESSION['IdMember'];
$kls = $forward->ambilkelas($id);
$kelas = $kls['Kelas'];
require_once('template/header.php');

if(isset($msg))
{
  echo $msg;
}
?>
<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu" data-widget="tree">
  <li class="header">MAIN NAVIGATION</li>
  <li class="">
    <a href="profile_siswa.php">
      <i class="fa fa-user"></i> <span>Profile</span>
    </a>
  </li>
  <li class="active">
    <a href="materi_siswa.php">
      <i class="fa fa-book"></i> <span>Materi</span>
    </a>
  </li>
  <li>
    <a href="pilih_ujian.php">
      <i class="fa fa-pencil"></i> <span>Ujian</span>
    </a>
  </li>
    <li>
        <a href="nilaiku.php">
            <i class="fa fa-table"></i> <span>Nilaiku</span>
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
      Materi Siswa
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Materi Siswa</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-8">
        <div id="all" class="panel panel-default panel-info">
          <div class="panel panel-heading"> All POST</div>
          <div class="panel panel-body">
          <?php $idmp = $forward->ambilMateri($kelas);?>

        </div>
          <div class="pagination-wrap">

          </div>
        </div>
      </div>

  <!-- /content -->

  <div class="col-md-3 alert alert-warning  ">
    NOTE : Jika inging Upload materi berupa vidio Silahkan upload ke Youtube terlebih dahulu , setelah itu link nya di embed di sini
  </div>
</div>
</section>
<!-- CONTAINER -->
</body>
<?php include('template/footer.php');?>

</html>