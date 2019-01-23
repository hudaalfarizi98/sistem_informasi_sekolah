<?php
/**
 * 
 */
class C_profile
{
	function __construct()
	{
		$this->database = new PDO('mysql:host=localhost;dbname=db_siakad','root','');
		$id = $_SESSION['IdMember'];
	}

	public function getProfile($id){
		$sql = "SELECT * FROM biodata_siswa WHERE Id = '$id'";
		$query = $this->database->query($sql);
		$result = $query->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public function editProfile($idmember,$nama,$jurusan,$kelas,$NoTlp,$alamat,$email,$namaayah,$namaibu,$tgl){
		try {
			$stmt = $this->database->prepare("UPDATE biodata_siswa SET NamaSiswa=:nama, Jurusan=:jurusan, Kelas=:kelas, NoTlp=:NoTlp, Alamat=:alamat, Email=:email, Nama_ayah=:namaayah, Nama_ibu=:namaibu, TanggalLahir=:tgl WHERE Id=:idmember");
			$stmt->bindparam(":idmember",$idmember);
			$stmt->bindparam(":nama",$nama);
			$stmt->bindparam(":jurusan",$jurusan);
			$stmt->bindparam(":kelas",$kelas);
			$stmt->bindparam(":NoTlp",$NoTlp);
			$stmt->bindparam(":alamat",$alamat);
			$stmt->bindparam(":email",$email);
			$stmt->bindparam(":namaayah",$namaayah);
			$stmt->bindparam(":namaibu",$namaibu);
			$stmt->bindparam(":tgl",$tgl);
			$stmt->execute();

			return true;
		} catch(PDOException $e){
			echo $e->getMessage();
			return false;
		}
	}

	public function ambilKelas($id){
		try{

			$stmt = $this->database->prepare("SELECT Kelas FROM biodata_siswa WHERE Id=:id");
			$stmt->bindparam(":id",$id);
			$stmt->execute();

			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			return $result;
		} catch(PDOException $e){
			echo $e->getMessage();

			return false;
		}
	}

	public function ambilMateri($kelas){
		try {

			$stmt = $this->database->prepare("SELECT * FROM post_materi WHERE Kelas=:kelas");
			$stmt->bindparam(":kelas",$kelas);
			$stmt->execute();
			$result = $stmt->fetchAll();
			foreach ($result as $key => $value) {
				echo "<div class='kim' style='font-size:25px;'>". $value['Judul'] . " | " .$value['tgl'] . "</div> <br/>";
				echo $value['Content'];

				echo " <div style='border-bottom:1px solid black'></div> <td> <a href='readmore_siswa.php?id=".$value['IdPost'] . " '> lihat </a> <br/> <div style='border-bottom:1px solid black'></div>  ";
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function readmore($query,$file){
		try {

			$stmt = $this->database->prepare($query);
			$stmt->bindparam(":id",$file);
			$stmt->execute();
			$result = $stmt->fetchAll();
			foreach ($result as $key => $value) {
				echo "<div class='kim' style='font-size:25px;'>". $value['Judul'] . " | " .$value['tgl'] . "</div> <br/>";
				echo $value['Content'];
				echo $value['tgl'] . "<br/> <div style='border-bottom:1px solid black'></div>	 ";
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
	public function getMapel($id){

		//pilih kelas

		$sql1 = "SELECT Kelas FROM biodata_siswa WHERE Id=$id";
		$query1 = $this->database->query($sql1);
		$result = $query1->fetch(PDO::FETCH_ASSOC);
		$kelas = $result['Kelas'];
		$sql = "SELECT * FROM soal_status WHERE Kelas = '$kelas' and status='y'";
		$query = $this->database->query($sql);
		while($row = $query->fetch(PDO::FETCH_ASSOC)){
			?>
			<option value="<?php echo $row['IdMapel'] ;?>"> <?php echo($row['Nama']) . " KELAS <b>" . $row['Kelas']. "</b>" ;?></option>
			<?php
		}
	}

	public function getSoal($query){
		$stmt = $this->database->prepare($query);
			$stmt->execute();
			$jumlah = $stmt->rowCount();

			if($stmt->rowCount()>0)
			{

				$no = 1;
				while($row=$stmt->fetch(PDO::FETCH_ASSOC))
				{
					$id = $row['Id'];
					$idMapel = $row['IdMapel'];

					?>
					<input type="hidden" name="mapel" value="<?php echo $idMapel ;?>">
					<input type="hidden" name="id[]" value="<?php echo $id ;?>">
					<input type="hidden" name="jumlah" value="<?php echo $jumlah ;?>">
					<b> <?php echo $no++ . " ) " . $row['Soal'];
					if(!empty($row['gambar_soal'])) {
						echo "<br /> <img src='file_soal/gambar" . $row['gambar_soal'] . "' class='img-rounded' style='width:500px; height :auto ;'>";
					}
					if(!empty($row['suara_soal'])) {
						echo "<br /> <audio src='file_soal/suara" . $row['suara_soal'] . "' controls </audio>";
					}

					if(!empty($row['a'])) {
						echo "<br />A <input type='radio' name='pilihan[".$id."]' VALUE='A'>  " . $row['a'];
					}
					if(!empty($row['gambar_a'])) {
						echo "<br />A <input type='radio' name='pilihan[".$id."]' VALUE='A'> <img src='file_soal/gambar" . $row['gambar_a'] . "' class='img-rounded' style='width:500px; height :auto ;'>";
					}
					if(!empty($row['suara_a'])) {
						echo "<br />A <input type='radio' name='pilihan[".$id."]' VALUE='A'> <audio src='file_soal/suara" . $row['suara_a'] . "' controls </audio>";
					}
					if(!empty($row['b'])) {
						echo "<br />B <input type='radio' name='pilihan[".$id."]' VALUE='B'> " . $row['b'];
					}
					if(!empty($row['gambar_b'])) {
						echo "<br />B <input type='radio' name='pilihan[".$id."]' VALUE='B'> <img src='file_soal/gambar" . $row['gambar_b'] . "' class='img-rounded' style='width:500px; height :auto ;'>";
					}
					if(!empty($row['suara_b'])) {
						echo "<br />B <input type='radio' name='pilihan[".$id."]' VALUE='B'> <audio src='file_soal/suara" . $row['suara_b'] . "' controls </audio>";
					}
					if(!empty($row['c'])) {
						echo "<br />C <input type='radio' name='pilihan[".$id."]' VALUE='C'> " . $row['c'];
					}
					if(!empty($row['gambar_c'])) {
						echo "<br />C <input type='radio' name='pilihan[".$id."]' VALUE='C'>  <img src='file_soal/gambar" . $row['gambar_c'] . "' class='img-rounded' style='width:500px; height :auto ;'>";
					}
					if(!empty($row['suara_c'])) {
						echo "<br />C <input type='radio' name='pilihan[".$id."]' VALUE='C'> <audio src='file_soal/suara" . $row['suara_c'] . "' controls </audio>";
					}
					if(!empty($row['d'])) {
						echo "<br />D <input type='radio' name='pilihan[".$id."]' VALUE='D'>  " . $row['d'];
					}
					if(!empty($row['gambar_d'])) {
						echo "<br />D <input type='radio' name='pilihan[".$id."]' VALUE='D'> <img src='file_soal/gambar" . $row['gambar_d'] . "' class='img-rounded' style='width:500px; height :auto ;'>";
					}
					if(!empty($row['suara_d'])) {
						echo "<br />D <input type='radio' name='pilihan[".$id."]' VALUE='D'> <audio src='file_soal/suara" . $row['suara_d'] . "' controls </audio>	";
					}

					?>

				</b><div style="border-bottom: 1px solid black"></div><br/>
					<input type='submit' name='jwb' value='Jawab'>
				<?php
			}
		}
		else
		{
			?>
			<tr>
				<td>Data tidak ditemukan...</td>
			</tr>
			<?php
		}
	}

	public function cekNilai($id,$data,$pilihan,$id_soal,$jumlah){


		$nilai = 0 ;
		$benar = 0;
		$salah = 0;
		$kosong = 0;

		for($i=0;$i<$jumlah;$i++){
			//id nomor soal
			$nomor = $id_soal[$i];
			//jika user tidak memilih jawaban
			if(empty($pilihan)){
				$kosong++;
			}else{
				//jawaban dari user
				$jawaban=$pilihan[$nomor];

				//cocokan jawaban user dengan yang ada di database
				$sql = "SELECT count(*) FROM soal WHERE Id='$nomor' and jawaban_benar='$jawaban'";
				$stmt = $this->database->prepare($sql);
				$stmt->execute();
				$cek = $stmt->fetchColumn();
				if($cek){
					$benar++;
				}else {
					$salah++;
				}

				//proses penilaian
				$nilai = ($cek!=0)? ($benar/$jumlah) * 100: 0;
				//proses pengecekan apakah siswa sudah pernah mengisi soal
				$sql2 = "SELECT COUNT(*) FROM nilai WHERE IdSiswa = '$id' and IdMapel = '$data'";
				$query = $this->database->prepare($sql2);
				$query->execute();
				$jmlhRow = $query->fetchColumn();
				if($jmlhRow > 0){

					echo "Tidak bisa melakukan ujian 2 kali";
				} else {
					// proses input nilai otomatis
					$sql3 = "INSERT INTO nilai (IdSiswa,IdMapel,Nilai,Status) VALUES ('$id','$data','$nilai','y')";
					$query2 = $this->database->prepare($sql3);
					$query2->execute();
				echo "Anda telah menyelesaikan ujian dengan nilai => " . $nilai;

				}

			}

		}
	}

	public function getNilai($sql){
		$stmt = $this->database->prepare($sql);
		$stmt->execute();
		$no = 1;
		if($stmt->rowCount() > 0){
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

				?>
                <h3 class="h3">Nilai <?php echo $row['NamaSiswa'] ;?></h3>
<table class="table">
    <thead>
    <th>NO</th>
    <th>Mata Pelajaran</th>
    <th>Nilai</th>
    </thead>
    <tbody>
    <td> <?php echo $no++ ;?></td>
    <td> <?php echo $row['Nama'] ;?></td>
    <td><?php echo $row['Nilai'];?></td>
    </tbody>
</table>
                <?php
			}
		}
	}
}
?>