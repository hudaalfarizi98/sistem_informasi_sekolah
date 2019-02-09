<?php
include('db.php');
include('function.php');
date_default_timezone_set('Asia/Jakarta');
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
		$statement = $connection->prepare("
			INSERT INTO member (Id, Username, Password, Level) 
			VALUES (:Id, :Username, :Password, :Level)
		");
		$date = strtotime(date('y-m-d H:i:s'));
		$result = $statement->execute(
			array(
				':Id'	=>	$_POST["Id"].$date,
				':Username'	=>	$_POST["Username"],
				':Password'		=>	sha1($_POST["Password"]),
				':Level' => $_POST['Level']
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
			UPDATE member set Username = :Username, Password = :Password, Level=:Level WHERE Id=:Id
		");
		$result = $statement->execute(
			array(
				':Id'	=>	$_POST["Id"],
				':Username'	=>	$_POST["Username"],
				':Password'		=>	sha1($_POST['Password']),
				':Level' => $_POST['Level']
			)
		);
		if(!empty($result))
		{
			echo 'Data Updated';
		}
	}
}

?>