<!-- FILE KONEKSI KE DATABASE -->

<?php
 try {

 	$conn = new PDO ('mysql:host=localhost;dbname=akademik','root','');

 } catch (PDOException $e) {

 	echo $e->getMessage();
 	
 }

 ?>