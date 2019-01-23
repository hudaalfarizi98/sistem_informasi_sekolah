<?php
class C_login
{
	
	function __construct(){
		$this->database = new PDO('mysql:host=localhost;dbname=db_siakad','root','');
	}

	public function aksi_login($username,$password){
		$sql = "SELECT * FROM member WHERE Id='$username' and Password='$password'";
		$query = $this->database->query($sql);
		$result = $query->fetch(PDO::FETCH_ASSOC);
		return $result;
	}
}

?>