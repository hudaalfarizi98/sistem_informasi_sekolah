<?php
include('db.php');
include('function.php');
date_default_timezone_set('Asia/Jakarta');
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
		$statement = $connection->prepare("
			INSERT INTO mapel (Id, IdGuru, Nama, Kelas) 
			VALUES (:Id, :IdGuru, :NamaMapel, :Kelas)
		");
		$date = strtotime(date('y-m-d H:i:s'));
		$result = $statement->execute(
			array(
				':Id'	=>	$_POST["Id"],
				':IdGuru'	=>	$_POST["IdGuru"],
				':NamaMapel' =>	$_POST["NamaMapel"],
				':Kelas' => $_POST['Kelas']
			)
		);
		if(!empty($result))
		{
			echo 'Data Inserted';
		}
	}
	if($_POST["operation"] == "Edit")
	{
$statement = $connection->prepare("
			UPDATE mapel set Id = :Id , IdGuru = :IdGuru, Nama=:NamaMapel , Kelas=:Kelas WHERE Id=:Id
		");
		$result = $statement->execute(
			array(
				':Id'	=>	$_POST["Id"],
				':IdGuru'	=>	$_POST["IdGuru"],
				':NamaMapel' =>	$_POST["NamaMapel"],
				':Kelas' => $_POST['Kelas']
			)
		);
		if(!empty($result))
		{
			echo 'Data Updated';
		}
	}
}

?>