<?php
/**
 * Created by PhpStorm.
 * User: huda
 * Date: 23/01/2019
 * Time: 03.05
 */

session_start();

if($_SESSION['Level'] != '1'){
    header('location:index.php');
}
require('class/C_profile_siswa.php');
$prof = new C_profile;
$id = $_SESSION['IdMember'];

$data = $prof->getProfile($id);

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
    <li>
        <a href="materi_siswa.php">
            <i class="fa fa-book"></i> <span>Materi</span>
        </a>
    </li>
    <li>
        <a href="pilih_ujian.php">
            <i class="fa fa-pencil"></i> <span>Ujian</span>
        </a>
    </li>
    <li class="active">
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
            Rekap Nilaiku
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
                        <?php
                        $sql = "SELECT * FROM ((nilai JOIN mapel ON nilai.IdMapel = mapel.Id) JOIN biodata_siswa ON nilai.IdSiswa = biodata_siswa.Id  ) WHERE IdSiswa = '$id'";
                        $prof->getNilai($sql);

                         ;?>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include('template/footer.php') ;?>