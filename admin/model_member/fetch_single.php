<?php
include('db.php');
include('function.php');
if(isset($_POST["user_id"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM member 
		WHERE Id = '".$_POST["user_id"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["Id"] = $row["Id"];
		$output["Username"] = $row["Username"];
		$output["Level"] = $row["Level"];
		
	}
	echo json_encode($output);
}
?>