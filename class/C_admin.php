<?php

class C_admin{


	function __construct(){
		$this->database = new PDO('mysql:host=localhost;dbname=db_siakad','root','');
		$id_sess = $_SESSION['IdMember'];
	}


	//CRUD MEMBER

	public function createMember(){

	}

	public function readMember(){

	}

	public function updateMember(){

	}

	public function deleteMember(){

	}

	


}