<?php
include('db.php');
include('function.php');
$output = array();
$query = "SELECT * FROM soal_status ";
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE Id LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR IdMapel LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR Nama LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR status LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR Kelas LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY Id DESC ';
}
if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
	$sub_array = array();
	$sub_array[] = $row["Id"];
	$sub_array[] = $row["IdMapel"];
	$sub_array[] = $row["status"];
	$sub_array[] = $row["Kelas"];
	$sub_array[] = '<button type="button" name="update" id="'.$row["Id"].'" class="btn btn-warning btn-xs update">Update</button>';
	$sub_array[] = '<button type="button" name="delete" id="'.$row["Id"].'" class="btn btn-danger btn-xs delete">Delete</button>';
	$data[] = $sub_array;
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_records(),
	"data"				=>	$data
);
echo json_encode($output);
?>