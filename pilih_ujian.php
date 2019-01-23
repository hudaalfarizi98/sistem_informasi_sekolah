<?php 
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
   <li class="active">
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
      Pilih Mata Pelajaran yang ingin diikuti
      <small>Control panel</small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Ujian Siswa</li>
   </ol>
</section>
<!-- Main content -->
<section class="content">
   <div class="row">
      <div class="col-md-12">
         <div class="panel panel-default panel-info">
            <div class="panel panel-heading panel-info">
               <span class="glyphicon glyphicon-pencil"></span> pilih mapel
            </div>
            <div class="panel panel-body">
               <form method="POST">
                  <select class="form-control" name='mp'>
                     <option>---</option>
                     <?php $prof->getMapel($id); ?>
                  </select>
                  <br/>
                  <button class='btn btn-info' type='submit' name='src'> Cari</button>
               </form>
            </div>
            <!-- /PANEL -->
         </div>
         <!-- / CONTAINER -->
      </div>
   </div>
   <div class="row">
      <div class="col-md-12">
         <div class="panel panel-default panel-info">
            <div class="panel panel-heading panel-info">
               <span class="glyphicon glyphicon-pencil"></span> soal
            </div>
            <div class="panel panel-body">
               <form method="POST">
                  <?php
                     if(isset($_POST['src'])){
                       $mapel = $_POST['mp'];
                     
                       $query = "SELECT * FROM soal WHERE IdMapel='$mapel'";
                       $prof->getSoal($query);
                     
                     }
                     ;?>

               </form>
               <?php
                  if(isset($_POST['jwb'])){
                         $pilihan=$_POST["pilihan"];
                         $id_soal=$_POST["id"];
                         $jumlah=$_POST['jumlah'];
                         $data = $_POST['mapel'];
                         $prof->cekNilai($id,$data,$pilihan,$id_soal,$jumlah);
                  }
                  ;?>
            </div>
            <!-- /PANEL -->
         </div>
         <!-- / CONTAINER -->
      </div>
   </div>
</section>
</body>
<?php include('template/footer.php') ;?>