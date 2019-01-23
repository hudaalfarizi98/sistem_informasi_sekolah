<?php
session_start();

if($_SESSION['Level'] != '2'){

  header('location:index,php');
}
require('class/C_profile_guru.php');
$forward = new C_profile;
$id = $_SESSION['IdMember'];
$penulis = $_SESSION['username'];

if(isset($_POST['save_'])){

  //get mata pelajaran
  $mp = $_POST['mp'];

  //get soal 
  $soal =  $_POST['soal'];
  $gambar_soal = $_FILES['gambar_soal']['name'];
  $suara_soal = $_FILES['suara_soal']['name'];

  //get jawaban a
  $a = $_POST['a'];
  $gambar_a = $_FILES['gambar_a']['name'];
  $suara_a = $_FILES['suara_a']['name'];

  //get jawaban b
  $b = $_POST['b'];
  $gambar_b = $_FILES['gambar_b']['name'];
  $suara_b = $_FILES['suara_b']['name'];

  //get jawaban c
  $c = $_POST['c'];
  $gambar_c = $_FILES['gambar_c']['name'];
  $suara_c = $_FILES['suara_c']['name'];

  //get jawaban d
  $d = $_POST['d'];
  $gambar_d = $_FILES['gambar_d']['name'];
  $suara_d = $_FILES['suara_d']['name'];

  //jawaban benar
  $jwbn = $_POST['bnr'];

  //soal file
  if(!empty($gambar_soal)){
    move_uploaded_file($_FILES['gambar_soal']['tmp_name'], 'file_soal/gambar'.$gambar_soal);
  }
  if(!empty($suara_soal)){
    move_uploaded_file($_FILES['suara_soal']['tmp_name'], 'file_soal/suara'.$suara_soal);
  }

  //a file
  if(!empty($gambar_a)){
    move_uploaded_file($_FILES['gambar_a']['tmp_name'], 'file_soal/gambar'.$gambar_a);
  }
  if(!empty($suara_a)){
    move_uploaded_file($_FILES['suara_a']['tmp_name'], 'file_soal/suara'.$suara_a);
  }

  //b file
  if(!empty($gambar_b)){
    move_uploaded_file($_FILES['gambar_b']['tmp_name'], 'file_soal/gambar'.$gambar_b);
  }
  if(!empty($suara_b)){
    move_uploaded_file($_FILES['suara_b']['tmp_name'], 'file_soal/suara'.$suara_b);
  }

  //c file
  if(!empty($gambar_c)){
    move_uploaded_file($_FILES['gambar_c']['tmp_name'], 'file_soal/gambar'.$gambar_c);
  }
  if(!empty($suara_c)){
    move_uploaded_file($_FILES['suara_c']['tmp_name'], 'file_soal/suara'.$suara_c);
  }

  //d file
  if(!empty($gambar_d)){
    move_uploaded_file($_FILES['gambar_d']['tmp_name'], 'file_soal/gambar'.$gambar_d);
  }
  if(!empty($suara_d)){
    move_uploaded_file($_FILES['suara_d']['tmp_name'], 'file_soal/suara'.$suara_d);
  }

  $insert = $forward->saveSoal($mp,$id,$soal,$gambar_soal,$suara_soal,$a,$gambar_a,$suara_a,$b,$gambar_b,$suara_b,$c,$gambar_c,$suara_c,$d,$gambar_d,$suara_d,$jwbn);
}

include('template/header.php');
?>
<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu" data-widget="tree">
  <li class="header">MAIN NAVIGATION</li>
  <li>
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
  <li class="active treeview">
    <a href="#">
      <i class="fa fa-pencil"></i> <span>BANK Soal</span>
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
      Input Soal
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Materi</li>
      <li class="active">Input Soal</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">

    <div class="row">
<form method="POST" enctype="multipart/form-data">
  <div class="col-md-8">
  <div id="new" class="panel panel-default panel-info">
    <div class="panel panel-heading"> New SOAL</div>
    <div class="panel panel-body">
      Pilih Mata Pelajaran
      <select class="form-control" name='mp'>
        <option>---</option>
        <?php $forward->getMapel($id); ?>
      </select><br/>
      <div style="color: black;">SOAL :</div>
      <textarea name="soal" class="form-control"> </textarea>
      <div style="color: black;">Gambar Soal :</div><input type="file" name="gambar_soal" accept="image/*">
      <div style="color: black;">Suara Soal :</div><input type="file" name="suara_soal" accept="audio/*"><br/>
      <div style="border-bottom: 1px solid black"></div><br/>
      <div style="color: black; ">Jawaban A.</div>
      <input type="text" name="a" class="form-control">
      <div style="color: black;">Gambar Jawaban A :</div><input type="file" name="gambar_a" accept="image/*">
      <div style="color: black;">Suara Jawaban A :</div><input type="file" name="suara_a" accept="audio/*"><br/>
      <div style="border-bottom: 1px solid black"></div><br/>
      <div style="color: black;">Jawaban B.</div>
      <input type="text" name="b" class="form-control">
      <div style="color: black;">Gambar Jawaban B :</div><input type="file" name="gambar_b" accept="image/*">
      <div style="color: black;">Suara Jawaban B :</div><input type="file" name="suara_b" accept="audio/*"><br/>
      <div style="border-bottom: 1px solid black"></div><br/>
      <div style="color: black;">Jawaban C</div>.
      <input type="text" name="c" class="form-control">
      <div style="color: black;">Gambar Jawaban C :</div><input type="file" name="gambar_c" accept="image/*">
      <div style="color: black;">Suara Jawaban C :</div><input type="file" name="suara_c" accept="audio/*"><br/>
      <div style="border-bottom: 1px solid black"></div><br/>
      <div style="color: black;">Jawaban D.</div>
      <input type="text" name="d" class="form-control">
      <div style="color: black;">Gambar Jawaban D :</div><input type="file" name="gambar_d" accept="image/*">
      <div style="color: black;">Suara Jawaban D :</div><input type="file" name="suara_d" accept="audio/*"><br/>
      <div style="color: black;">Jawaban benar</div>
      <select name="bnr">
        
        <option>....</option>
        <option>A</option>
        <option>B</option>
        <option>C</option>
        <option>D</option>
      </select>
      <div style="border-bottom: 1px solid black"></div><br/>
    </div>
    <div class="panel panel-footer"> <input class="btn btn-primary" type="submit" name="save_" value="Simpan"></div>
  </div>
</div>
</form>
  <!-- /content -->

<div class="col-md-3 alert alert-warning">
  NOTE : Jika inging Upload materi berupa vidio Silahkan upload ke Youtube terlebih dahulu , setelah itu link nya di embed di sini
</div>
    </div>
  </section>
<!-- CONTAINER -->
</body>
<?php include('template/footer.php') ;?>
</html>