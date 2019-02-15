<?php
include('db.php');
include('function.php');
if(isset($_POST["user_id"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM soal_status 
		WHERE Id = '".$_POST["user_id"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["Id"] = $row["Id"];
		$output["IdMapel"] = $row["IdMapel"];
		$output["status"] = $row["status"];
		$output["Kelas"] = $row["Kelas"];
		
	}
	echo json_encode($output);
}
?>