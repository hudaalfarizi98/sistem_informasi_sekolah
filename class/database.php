<?php
 /**
  * 
  */
 class db
 {
 	
 	// variable db
 	private $conn;

 	public function connection(){
 		try {

 			$this->conn = new PDO('mysql:host=localhost;dbname=db_siakad','root','');
 			
 		} catch (PDOException $e) {
 			echo $e->getMessage() . "Terjadi Kesalahan";
 		}

 		return $this->conn;
 	}
 }

 ?>