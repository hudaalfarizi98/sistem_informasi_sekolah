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
				':Id'	=>	htmlspecialchars($_POST["Id"]),
				':IdGuru'	=>	htmlspecialchars($_POST["IdGuru"]),
				':NamaMapel' =>	htmlspecialchars($_POST["NamaMapel"]),
				':Kelas' => htmlspecialchars($_POST['Kelas'])
			)
		);
		if(!empty($result))
		{
			$stmt = $connection->prepare("INSERT INTO soal_status (IdMapel,Nama,status,Kelas) VALUES (:IdMapel,:Nama,:status,:Kelas) ");
			$stmt->bindParam(":IdMapel", htmlspecialchars($_POST['Id']));
			$stmt->bindParam(":Nama", htmlspecialchars($_POST['NamaMapel']));
			$stmt->bindParam(":status","t");
			$stmt->bindParam(":Kelas",htmlspecialchars($_POST['Kelas']));
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
				':Id'	=>	htmlspecialchars($_POST["Id"]),
				':IdGuru'	=>	htmlspecialchars($_POST["IdGuru"]),
				':NamaMapel' =>	htmlspecialchars($_POST["NamaMapel"]),
				':Kelas' => htmlspecialchars($_POST['Kelas'])
			)
		);
		if(!empty($result))
		{
			echo 'Data Updated';
		}
	}
}

?>