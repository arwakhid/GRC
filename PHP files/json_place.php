<?php
//koneksi database
include "connection.php"; 

$sql 	= "select * from place";
$q 		= mysqli_query($connect, $sql) or die (mysqli_error());

$rows	= array();
while ($r = mysqli_fetch_assoc($q)) {
	$rows[] = $r;
}
$data = "{ place:".json_encode($rows)."}";
echo $data;
?>
