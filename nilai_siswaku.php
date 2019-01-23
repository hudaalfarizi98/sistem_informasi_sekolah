<?php
/**
 * Created by PhpStorm.
 * User: huda
 * Date: 23/01/2019
 * Time: 03.05
 */

session_start();

if($_SESSION['Level'] != '2'){
    header('location:index.php');
}
require('class/C_profile_guru.php');
$forward = new C_profile;
$id = $_SESSION['IdMember'];

$data = $forward->getProfile($id);

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
    <li class="active">
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
</aside><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Rekap Nilai Siswa
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Nilai Siswa</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default panel-info">
                    <div class="panel panel-heading">Rekap Nilai </div>
                    <div class="panel panel-body">
                        <form method="POST">
                        <div class="pencarian">
                            <select class="form-control" name="mp">
                                <option></option>
                                <?php $forward->getMapel($id); ?>
                            </select>
                            <br/>
                            <input type="submit" name="src" value="cari" class="btn">
                        </div>
                        </form>
                        <?php
                            if(isset($_POST['src'])) {
                                $mp = $_POST['mp'];
                                $sql = "SELECT * FROM ((nilai JOIN mapel ON nilai.IdMapel = mapel.Id) JOIN biodata_siswa ON nilai.IdSiswa = biodata_siswa.Id ) WHERE IdMapel = '$mp'";
                                $forward->getNilai($sql);
                            }
                         ;?>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>

<?php include('template/footer.php');?>