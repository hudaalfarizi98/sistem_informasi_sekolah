<?php

class C_admin{


	function __construct(){
		$this->database = new PDO('mysql:host=localhost;dbname=db_siakad','root','');
		$id_sess = $_SESSION['IdMember'];
	}


	//CRUD MEMBER

	public function createMember($id,$username,$password,$Level){
        try {
            $stmt = $this->database->prepare("INSERT INTO member (Id,Username,Password,Level) VALUES (:id,:username,:password,:level)");
            $stmt->bindparam(":id", $id);
            $stmt->bindparam(":username", $username);
            $stmt->bindparam(":password", sha1($password));
            $stmt->bindparam(":Level", $Level);
            $stmt->execute();
        } catch (PDOException $e){

            echo "GAGAL" . $e->getMessage();
        }

	}

	public function readMember(){
	    try{
	        $stmt = $this->database->prepare("SELECT * FROM member");
	        $stmt->execute();

	        if($stmt->rowCount() > 0){

	        	?>
	        	<table class="table table-hover table-bordered">
                            <thead>
                                <th>Id</th>
                                <th>Username</th>
                                <th>Level</th>
                                <th>Aksi</th>
                            </thead>
                            <?php 

	            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	                ?>
                            <tbody>
                                <td><?php echo $row['Id'];?></td>
                                <td><?php echo $row['Username'] ;?></td>
                                <td><?php echo $row['Level'] ;?></td>
                                <td><button type="button" data-toggle="modal" data-target="#myModal">Edit</button> | <button>hapus</button></td>
                            </tbody>
                        
<?php
                } echo "</table>";

            } else {
	            echo "Data Tidak ditemukan";
            }
        } catch (PDOException $e){
        	echo "GAGAL" . $e->getMessage();
        }
	}

	public function updateMember($id,$status){

	    try{
	        $stmt = $this->database->prepare("UPDATE member SET status=:status WHERE Id=:id");
	        $stmt->bindParam(":status",$status);
	        $stmt->bindParam(":id",$id);
	        $stmt->execute();
        } catch (PDOException $e){
	        echo "GAGAL" . $e->getMessage();
        }

	}

	public function deleteMember($id){
	    try{
	        $stmt = $this->database->prepare("DELETE FROM member WHERE Id=:id");
	        $stmt->bindParam(":id",$id);
	        $stmt->execute();
        } catch (PDOException $e){
	        echo "GAGAL" . $e->getMessage();
        }

	}

	//CRUD GURU

    public function createGuru($id,$nama,$noltp){
    	try {
    		$stmt = $this->database->prepare('INSERT INTO biodata_guru (Id,Nama,NoTlp) VALUES (:id,:nama,:notlp) ');
    		$stmt->bindParam(":id",$id);
    		$stmt->bindParam(":nama",$nama);
    		$stmt->bindParam(":notlp",$notlp);

    		$stmt->execute();
    	} catch (PDOException $e){
    		echo "GAGAL" . $e->getMessage();

    	}

    }

    public function readGuru(){

    	try { 

    		$stmt = $this->database->prepare("SELECT * FROM biodata_guru");
    		$stmt->execute();

    		if($stmt->rowCount() > 0){

    			$no = 1; 

    			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

    				?>

    				<table class="table teble-hover">
    					<thead>
    						<th>No</th>
    						<th>Id GUru</th>
    						<th>Nama</th>
    						<th>No Telepon</th>
    					</thead>
    					<tbody>
    						<td> <?php echo $no ;?></td>
    						<td> <?php echo $row['Id'] ;?></td>
    						<td> <?php echo $row['Nama'];?></td>
    						<td><?php echo $row['NoTlp'] ;?></td>
    					</tbody>
    				</table>

    				<?php

    			} 

    		} else {
    				echo "Data Tidak Ditemukan";
    			}
    		
    	} catch (PDOException $e) {

    		echo "GAGAL" . $e->getMessage();
    		
    	}

    }

    public function updateGuru($id,$nama,$notlp){

    	try {

    		$stmt = $this->database->prepare("UPDATE biodata_guru set Nama=:nama , NoTlp=:notlp WHERE Id=:id ");
    		$stmt->bindParam(":nama",$nama);
    		$stmt->bindParam(":NoTlp");
    		$stmt->execute();
    		
    	} catch (PDOException $e) {
    		echo "GAGAL" . $e->getMessage();
    	}

    }

    public function deleteGuru($id){

    	try {

    		$stmt = $this->database->prepare("DELETE biodata_guru where Id=:id");
    		$stmt->bindParam(":id",$id);
    		$stmt->execute();
    		
    	} catch (PDOException $e) {
    		
    	}

    }

    //CRUD Siswa

    public function createSiswa($id,$nama,$jurusan,$kelas){

    	try {

    		$stmt = $this->database->prepare("INSERT INTO biodata_siswa (Id,Nama,Jurusan,Kelas) VALUES (:id,:nama,:jurusan,:kelas) ");
    		$stmt->bindParam("");
    		$stmt->bindParam("");
    		$stmt->bindParam("");
    		$stmt->bindParam("");

    		$stmt->execute();
    		
    	} catch (PDOException $e) {
    		
    	}

    }
    public function readSiswa(){

    }
    public function updateSiswa(){

    }
    public function deleteSiswa(){

    }

    //CRUD MAPEL

    public function createMapel(){

    }

    public function readMapel(){

    }

    public function updateMapel(){

    }

    public function deleteMateri(){

    }

    //CRUD Status Soal

    public function createStatusSoal(){

    }
    public function readStatusSoal(){

    }
    public function updateStatusSoal(){

    }
    public function deleteStatusSoal(){

    }

}