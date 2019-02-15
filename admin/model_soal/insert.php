<?php
include('db.php');
include('function.php');
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
		$statement = $connection->prepare("
			INSERT INTO soal_status (IdMapel, status, Kelas) 
			VALUES (:IdMapel, :status, :Kelas)
		");
		$result = $statement->execute(
			array(
				':IdMapel'	=>	htmlspecialchars($_POST["IdMapel"]),
				':status'	=>	htmlspecialchars($_POST["status"]),
				':Kelas'		=>	htmlspecialchars($_POST["Kelas"]),
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
			UPDATE soal_status set IdMapel = :IdMapel, status = :status, Kelas=:Kelas WHERE Id=:Id
		");
		$result = $statement->execute(
			array(
				':IdMapel'	=>	htmlspecialchars($_POST["IdMapel"]),
				':status'	=>	htmlspecialchars($_POST["status"]),
				':Kelas'		=>	htmlspecialchars($_POST['Kelas']),
			)
		);
		if(!empty($result))
		{
			echo 'Data Updated';
		}
	}
}

?>