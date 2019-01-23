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
		$sql = "SELECT * FROM biodata_guru WHERE Id = '$id'";
		$query = $this->database->query($sql);
		$result = $query->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public function editProfile($idmember,$nama,$NoTlp){
		try {
			$stmt = $this->database->prepare("UPDATE biodata_guru SET Nama=:nama, NoTlp=:NoTlp WHERE Id=:idmember");
			$stmt->bindparam(":idmember",$idmember);
			$stmt->bindparam(":nama",$nama);
			$stmt->bindparam(":NoTlp",$NoTlp);
			$stmt->execute();

			return true;
		} catch(PDOException $e){
			echo $e->getMessage();
			return false;
		}
	}

	public function getMapel($id){
		$sql = "SELECT * FROM mapel WHERE IdGuru = '$id'";
		$query = $this->database->query($sql);
		while($row = $query->fetch(PDO::FETCH_ASSOC)){
			?>
			<option value="<?php echo $row['Id'] ;?>"> <?php echo($row['Nama']) . " KELAS <b>" . $row['Kelas']. "</b>" ;?></option> 
			<?php
		}
	}

	public function saveMateri($mp,$judul,$content,$id){
		date_default_timezone_set('Asia/Jakarta');
		$tanggal = date('Y-m-d');
		try {
			$query = $this->database->query("SELECT Kelas from mapel WHERE Id='$mp'");
			$data = $query->fetch(PDO::FETCH_ASSOC);
			$kls = $data['Kelas'];
			$stmt = $this->database->prepare("INSERT post_materi (Judul,Content,tgl,IdGuru,IdMapel,Kelas) VALUES (:judul,:Content,:tgl,:IdGuru,:IdMapel,:kelas)");
			$stmt->bindparam(":judul",$judul);
			$stmt->bindparam(":Content",$content);
			$stmt->bindparam(":tgl",$tanggal);
			$stmt->bindparam(":IdGuru",$id);
			$stmt->bindparam(":IdMapel",$mp);
			$stmt->bindparam(":kelas",$kls);
			$stmt->execute();
		} catch (PDOException $e) {
			echo "GAGAL" . $e->getMessage();
		}
	}

	public function getPOST($query){
		$stmt = $this->database->prepare($query);
		$stmt->execute();

		if($stmt->rowCount()>0)
		{
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				?>
				<div class="panel panel-body" style="border-bottom: #ddd solid 1px"><b> <?php echo $row['Judul'] . " | " . $row['tgl'] . " | " . $row['Nama'] . " </b><br /> <br/>" . $row['Content'] . " <br/> " . "<td> <a href='readmore.php?id=".$row['IdPost'] . " '> lihat </a> | <a href='edit_materi.php?id=".$row['IdPost'] . " '> sunting</a>" . " | <a href='post_materi.php?delete=".$row['IdPost']." '> hapus </a>";?></b></div>
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

		public function getSoal($query){
			$stmt = $this->database->prepare($query);
			$stmt->execute();

			if($stmt->rowCount()>0)
			{
				while($row=$stmt->fetch(PDO::FETCH_ASSOC))
				{
					?>
					<b> <?php echo $row['Soal'];
					if(!empty($row['gambar_soal'])) {
						echo "<br /> <img src='file_soal/gambar" . $row['gambar_soal'] . "' class='img-rounded' style='width:500px; height :auto ;'>";
					}
					if(!empty($row['suara_soal'])) {
						echo "<br /> <audio src='file_soal/suara" . $row['suara_soal'] . "' controls </audio>";
					}

					if(!empty($row['a'])) {
						echo "<br /> A " . $row['a'];
					}
					if(!empty($row['gambar_a'])) {
						echo "<br />A <img src='file_soal/gambar" . $row['gambar_a'] . "' class='img-rounded' style='width:500px; height :auto ;'>";
					}
					if(!empty($row['suara_a'])) {
						echo "<br />A <audio src='file_soal/suara" . $row['suara_a'] . "' controls </audio>";
					}
					if(!empty($row['b'])) {
						echo "<br /> B " . $row['b'];
					}
					if(!empty($row['gambar_b'])) {
						echo "<br />B <img src='file_soal/gambar" . $row['gambar_b'] . "' class='img-rounded' style='width:500px; height :auto ;'>";
					}
					if(!empty($row['suara_b'])) {
						echo "<br />B <audio src='file_soal/suara" . $row['suara_b'] . "' controls </audio>";
					}
					if(!empty($row['c'])) {
						echo "<br /> C  " . $row['c'];
					}
					if(!empty($row['gambar_c'])) {
						echo "<br />C  <img src='file_soal/gambar" . $row['gambar_c'] . "' class='img-rounded' style='width:500px; height :auto ;'>";
					}
					if(!empty($row['suara_c'])) {
						echo "<br />C <audio src='file_soal/suara" . $row['suara_c'] . "' controls </audio>";
					}
					if(!empty($row['d'])) {
						echo "<br /> D  " . $row['d'];
					}
					if(!empty($row['gambar_d'])) {
						echo "<br />D <img src='file_soal/gambar" . $row['gambar_d'] . "' class='img-rounded' style='width:500px; height :auto ;'>";
					}
					if(!empty($row['suara_d'])) {
						echo "<br />D <audio src='file_soal/suara" . $row['suara_d'] . "' controls </audio>	";
					}

					?>
				</b><br/> <div style='border-top:1px solid black; border-bottom:1px solid black;'> <a href='edit_soal.php?edit=<?=$row['Id'];?>'> EDIT </a> | <a href='bank_soal.php?delete=<?=$row['Id'] ;?>'> Delete </a></div>
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

	public function deleteSoal($del){
		try {

			$stmt = $this->database->prepare("DELETE FROM soal WHERE Id=:del");
			$stmt->bindparam(":del",$del);
			$stmt->execute();
			header('location:input_soal.php');
			
		} catch (PDOException $e) {
			echo "GAGAL" . $e->getMessage();
		}
	}

	public function get_edit_soal($query,$id){
		$stmt = $this->database->prepare($query);
		$stmt->execute();

		if($stmt->rowCount()>0)
		{
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				?>
					Pilih Mata Pelajaran
					<select required="required" class="form-control" name='mp'>
						<option></option>

						<?php $sql = "SELECT * FROM mapel WHERE IdGuru = '$id'";
		$query = $this->database->query($sql);
		while($now = $query->fetch(PDO::FETCH_ASSOC)){
			?>
			<option value="<?php echo $now['Id'] ;?>"> <?php echo($now['Nama']) . " KELAS <b>" . $now['Kelas']. "</b>" ;?></option> 
			<?php
		}
		?>
					</select><br/>
					<div style="color: black;">SOAL :</div>
					<textarea name="soal" class="form-control" required="required"> <?php echo $row['Soal'];?> </textarea>
					<div style="color: black;">Gambar Soal :</div><input type="file" name="gambar_soal" accept="image/*" value="<?php echo $row['gambar_soal'];?>">
					<div style="color: black;">Suara Soal :</div><input type="file" name="suara_soal" accept="audio/*" value="<?php echo $row['suara_soal'];?>"><br/>
					<div style="border-bottom: 1px solid black"></div><br/>
					<div style="color: black; ">Jawaban A.</div>
					<input type="text" name="a" class="form-control" value="<?php echo $row['a'];?>">
					<div style="color: black;">Gambar Jawaban A :</div><input type="file" name="gambar_a" accept="image/*" value="<?php echo $row['gambar_a'];?>">
					<div style="color: black;">Suara Jawaban A :</div><input type="file" name="suara_a" accept="audio/*" value="<?php echo $row['suara_a'];?>"><br/>
					<div style="border-bottom: 1px solid black"></div><br/>
					<div style="color: black;">Jawaban B.</div>
					<input type="text" name="b" class="form-control" value="<?php echo $row['b'];?>">
					<div style="color: black;">Gambar Jawaban B :</div><input type="file" name="gambar_b" accept="image/*" value="<?php echo $row['gambar_b'];?>">
					<div style="color: black;">Suara Jawaban B :</div><input type="file" name="suara_b" accept="audio/*" value="<?php echo $row['suara_b'];?>"><br/>
					<div style="border-bottom: 1px solid black"></div><br/>
					<div style="color: black;">Jawaban C</div>
					<input type="text" name="c" class="form-control" value="<?php echo $row['c'];?>">
					<div style="color: black;">Gambar Jawaban C :</div><input type="file" name="gambar_c" accept="image/*">
					<div style="color: black;">Suara Jawaban C :</div><input type="file" name="suara_c" accept="audio/*" value="<?php echo $row['suara_c'];?>"><br/>
					<div style="border-bottom: 1px solid black"></div><br/>
					<div style="color: black;">Jawaban D.</div>
					<input type="text" name="d" class="form-control" value="<?php echo $row['d'];?>">
					<div style="color: black;">Gambar Jawaban D :</div><input type="file" name="gambar_d" accept="image/*" value="<?php echo $row['gambar_d'];?>">
					<div style="color: black;">Suara Jawaban D :</div><input type="file" name="suara_d" accept="audio/*" value="<?php echo $row['suara_d'];?>"><br/>
					<div style="border-bottom: 1px solid black"></div><br/>
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


	public function updateMateri($file,$mp,$judul,$content,$penulis){
		date_default_timezone_set('Asia/Jakarta');
		$tanggal = date('Y-m-d');
		try {
			$stmt = $this->database->prepare("UPDATE post_materi SET Judul=:judul, content=:content , tgl=:tgl , penulis=:penulis , Mapel=:Mapel WHERE IdPost='$file' ");
			$stmt->bindparam(":judul",$judul);
			$stmt->bindparam(":content",$content);
			$stmt->bindparam(":tgl",$tanggal);
			$stmt->bindparam(":penulis",$penulis);
			$stmt->bindparam(":Mapel",$mp);
			$stmt->execute();
			header('location:input_materi.php');
		} catch (PDOException $e) {
			echo "GAGAL" . $e->getMessage();
		}
	}
	public function deleteMateri($id){
		try {

			$stmt = $this->database->prepare("DELETE FROM post_materi WHERE IdPost=:id");
			$stmt->bindparam(":id",$id);
			$stmt->execute();
			header('location:post_materi.php');
			
		} catch (PDOException $e) {
			echo "GAGAL" . $e->getMessage();
		}
	}

	public function get_edit_POST($query){
		$stmt = $this->database->prepare($query);
		$stmt->execute();

		if($stmt->rowCount()>0)
		{
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				?>
				<div>
					<input type="text" name="judul" class="form-control" placeholder="JUDUL" value=" <?php echo $row['Judul'] ;?>"></div><br/>
					<div class="content">
						<textarea class="form-control" id="new_post" name="content"><?php echo $row['Content'];?></textarea>
						<script type="text/javascript">CKEDITOR.replace('new_post');</script>
					</div>
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

		public function paging($query,$record_per_page){
			$starting_position = 0;
			if(isset($_GET['page_no'])){
				$starting_position=($_GET['page_no']-1)*$record_per_page;
			} $query2 = $query ." limit $starting_position, $record_per_page";
			return $query2;
		}

		public function paginglink($query,$record_per_page)
		{

			$self = $_SERVER['PHP_SELF'];

			$stmt = $this->database->prepare($query);
			$stmt->execute();

			$total_no_of_records = $stmt->rowCount();

			if($total_no_of_records > 0)
			{
				?><ul class="pagination"><?php
				$total_no_of_pages=ceil($total_no_of_records/$record_per_page);
				$current_page=1;
				if(isset($_GET["page_no"]))
				{
					$current_page=$_GET["page_no"];
				}
				if($current_page!=1)
				{
					$previous =$current_page-1;
					echo "<li><a href='".$self."?page_no=1'>First</a></li>";
					echo "<li><a href='".$self."?page_no=".$previous."'>Previous</a></li>";
				}
				for($i=1;$i<=$total_no_of_pages;$i++)
				{
					if($i==$current_page)
					{
						echo "<li><a href='".$self."?page_no=".$i."' style='color:red;'>".$i."</a></li>";
					}
					else
					{
						echo "<li><a href='".$self."?page_no=".$i."'>".$i."</a></li>";
					}
				}
				if($current_page!=$total_no_of_pages)
				{
					$next=$current_page+1;
					echo "<li><a href='".$self."?page_no=".$next."'>Next</a></li>";
					echo "<li><a href='".$self."?page_no=".$total_no_of_pages."'>Last</a></li>";
				}
				?></ul><?php
			}
		}

		public function updateSoal($mp,$id,$soal,$gambar_soal,$suara_soal,$a,$gambar_a,$suara_a,$b,$gambar_b,$suara_b,$c,$gambar_c,$suara_c,$d,$gambar_d,$suara_d,$edit){

			try {
				$stmt = $this->database->prepare("UPDATE soal set IdGuru=:id, IdMapel=:mp, Soal=:soal, gambar_soal=:gambar_soal, suara_soal=:suara_soal, a=:a, gambar_a=:gambar_a, suara_a=:suara_a, b=:b, gambar_b=:gambar_b ,suara_b=:suara_b, c=:c, gambar_c=:gambar_c, suara_c=:suara_c, d=:d, gambar_d=:gambar_d, suara_d=:suara_d WHERE Id=:edit ") ;
				$stmt->bindparam(":id",$id);
				$stmt->bindparam(":mp",$mp);
				$stmt->bindparam(":soal",$soal);
				$stmt->bindparam(":gambar_soal",$gambar_soal);
				$stmt->bindparam(":suara_soal",$suara_soal);
				$stmt->bindparam(":a",$a);
				$stmt->bindparam(":gambar_a",$gambar_a);
				$stmt->bindparam(":suara_a",$suara_a);
				$stmt->bindparam(":b",$b);
				$stmt->bindparam(":gambar_b",$gambar_b);
				$stmt->bindparam(":suara_b",$suara_b);
				$stmt->bindparam(":c",$c);
				$stmt->bindparam(":gambar_c",$gambar_c);
				$stmt->bindparam(":suara_c",$suara_c);
				$stmt->bindparam(":d",$d);
				$stmt->bindparam(":gambar_d",$gambar_d);
				$stmt->bindparam(":suara_d",$suara_d);
				$stmt->bindparam(":edit",$edit);
				$stmt->execute();
				header('location:input_soal.php');
			} catch (PDOException $e){
				echo "GAGAL" .  $e->getMessage();
			}
		}

		public function saveSoal($mp,$id,$soal,$gambar_soal,$suara_soal,$a,$gambar_a,$suara_a,$b,$gambar_b,$suara_b,$c,$gambar_c,$suara_c,$d,$gambar_d,$suara_d,$bnr){

			try {
				$stmt = $this->database->prepare("INSERT soal (IdGuru,IdMapel,Soal,gambar_soal,suara_soal,a,gambar_a,suara_a,b,gambar_b,suara_b,c,gambar_c,suara_c,d,gambar_d,suara_d,jawaban_benar) VALUES (:id,:mp,:soal,:gambar_soal,:suara_soal,:a,:gambar_a,:suara_a,:b,:gambar_b,:suara_b,:c,:gambar_c,:suara_c,:d,:gambar_d,:suara_d,:bnr)");
				$stmt->bindparam(":id",$id);
				$stmt->bindparam(":mp",$mp);
				$stmt->bindparam(":soal",$soal);
				$stmt->bindparam(":gambar_soal",$gambar_soal);
				$stmt->bindparam(":suara_soal",$suara_soal);
				$stmt->bindparam(":a",$a);
				$stmt->bindparam(":gambar_a",$gambar_a);
				$stmt->bindparam(":suara_a",$suara_a);
				$stmt->bindparam(":b",$b);
				$stmt->bindparam(":gambar_b",$gambar_b);
				$stmt->bindparam(":suara_b",$suara_b);
				$stmt->bindparam(":c",$c);
				$stmt->bindparam(":gambar_c",$gambar_c);
				$stmt->bindparam(":suara_c",$suara_c);
				$stmt->bindparam(":d",$d);
				$stmt->bindparam(":gambar_d",$gambar_d);
				$stmt->bindparam(":suara_d",$suara_d);
				$stmt->bindparam(":bnr",$bnr);
				$stmt->execute();
				header('location:input_soal.php');
			} catch (PDOException $e){
				echo "GAGAL" .  $e->getMessage();
			}
		}

		public function getNilai($sql){
	        $stmt = $this->database->prepare($sql);
	        $stmt->execute();
	        $no = 1;

	        if($stmt->rowCount() > 0){

	            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

	                ?>

                    <table class="table table-hover">
                        <thead>
                            <th>No</th>
                            <th>Mata Pelajaran</th>
                            <th>Nama Siswa </th>
                            <th>Nilai</th>
                        </thead>
                        <tbody>
                            <td><?php echo $no++ ;?></td>
                            <td><?php echo $row['Nama'] ;?></td>
                            <td><?php echo $row['NamaSiswa'];?></td>
                            <td><?php echo $row['Nilai'];?></td>
                        </tbody>
                    </table>
	          <?php
                }
            }
        }
	}
	?>