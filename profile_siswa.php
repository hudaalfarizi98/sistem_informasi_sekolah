<?php 
session_start();

if($_SESSION['Level'] != '1'){
  header('location:index.php');
}
require('class/C_profile_siswa.php');
$prof = new C_profile;
$id = $_SESSION['IdMember'];
$data = $prof->getProfile($id); 


//Function UPdate

if(isset($_POST['update'])){
  $idmember = $_SESSION['IdMember'];
  $nama     = $_POST['nama'];
  $jurusan  = $_POST['jurusan'];
  $kelas    = $_POST['kelas'];
  $NoTlp    = $_POST['NoTlp'];
  $alamat   = $_POST['alamat'];
  $email    = $_POST['email'];
  $namaayah = $_POST['namaayah'];
  $namaibu  = $_POST['namaibu'];
  $tgl      = $_POST['tgl'];

  $exec_edit = $prof->editProfile($idmember,$nama,$jurusan,$kelas,$NoTlp,$alamat,$email,$namaayah,$namaibu,$tgl);

  if($exec_edit){
    $msg = '<div class="alert alert-success">
  <strong>Success!</strong> Indicates a successful or positive action.
</div>'; header('location:profile_siswa.php');
  } else {
    $msg = '<div class="alert alert-danger">
  <strong>Danger!</strong> Indicates a dangerous or potentially negative action.
</div>';
  }

}


require_once('template/header.php');

if(isset($msg))
{
  echo $msg;
}
?>
<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu" data-widget="tree">
  <li class="header">MAIN NAVIGATION</li>
  <li class="active">
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
      Profile Siswa
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Profile Siswa</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

  <div class="panel panel-default panel-info">

    <div class="panel panel-heading panel-info">
      <span class="glyphicon glyphicon-user"></span> Profile
    </div>

    <div class="panel panel-body">


      <div class="col-md-3">
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-edit"></span> Edit</button>
      </div>

      <div class="col-md-8">
      <table class="table table-striped table-hover">
        <tr>
          <td style="font:bold;"><b>Nama</b></td>
          <td>:</td>
          <td><?php echo $data['NamaSiswa'] ?></td>
        </tr>
        <tr>
          <td style="font:bold;"><b>Kelas</b></td>
          <td>:</td>
          <td><?php echo $data['Kelas'] ?></td>
        </tr>
        <tr>
          <td style="font:bold;"><b>Jurusan</b></td>
          <td>:</td>
          <td><?php echo $data['Jurusan'] ?></td>
        </tr>
        <tr>
          <td style="font:bold;"><b>No Telepon</b></td>
          <td>:</td>
          <td><?php echo $data['NoTlp'] ?></td>
        </tr>
        <tr>
          <td style="font:bold;"><b>Alamat</b></td>
          <td>:</td>
          <td><?php echo $data['Alamat'] ?></td>
        </tr>
        <tr>
          <td style="font:bold;"><b>Nama Ayah</b></td>
          <td>:</td>
          <td><?php echo $data['Nama_ayah'] ?></td>
        </tr>
        <tr>
          <td style="font:bold;"><b>Nama Ibu</b></td>
          <td>:</td>
          <td><?php echo $data['Nama_ibu'] ?></td>
        </tr>
        <tr>
          <td style="font:bold;"><b>E-mail</b></td>
          <td>:</td>
          <td><?php echo $data['Email'] ?></td>
        </tr>
        <tr>
          <td style="font:bold;"><b>Tanggal Lahir</b></td>
          <td>:</td>
          <td><?php echo $data['TanggalLahir'] ?></td>
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
        <table class="table table-hover">
          <tr>
            <td>Nama</td>
            <td>:</td>
            <td><input class="form-control" type="text" name="nama" value="<?php echo $data['NamaSiswa'];?>"></td>
          </tr>
          <tr>
            <td>Kelas</td>
            <td>:</td>
            <td><input disabled="disabled" class="form-control" type="text" name="kelas" value="<?php echo $data['Kelas'];?>"></td>
          </tr>
          <tr>
            <td>Jurusan</td>
            <td>:</td>
            <td><input disabled="disabled" class="form-control" type="text" name="jurusan" value="<?php echo $data['Jurusan'];?>"></td>
          </tr>
          <tr>
            <td>No Telepon</td>
            <td>:</td>
            <td><input class="form-control" type="text" name="NoTlp" value="<?php echo $data['NoTlp'];?>"></td>
          </tr>
          <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><input class="form-control" type="text" name="alamat" value="<?php echo $data['Alamat'];?>"></td>
          </tr>
          <tr>
            <td>Email</td>
            <td>:</td>
            <td><input class="form-control" type="text" name="email" value="<?php echo $data['Email'];?>"></td>
          </tr>
          <tr>
            <td>Nama Ayah</td>
            <td>:</td>
            <td><input class="form-control" type="text" name="namaayah" value="<?php echo $data['Nama_ayah'];?>"></td>
          </tr>
          <tr>
            <td>Nama_ibu</td>
            <td>:</td>
            <td><input class="form-control" type="text" name="namaibu" value="<?php echo $data['Nama_ibu'];?>"></td>
          </tr>
          <tr>
            <td>Tanggal Lahir</td>
            <td>:</td>
            <td><input class="form-control" type="date" name="tgl" value="<?php echo $data['TanggalLahir'];?>"></td>
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
<?php include('template/footer.php') ;?>