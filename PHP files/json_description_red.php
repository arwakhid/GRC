<?php
//koneksi database
include "connection.php"; 

$sql 	= "select * from description where type='RED'";
$q 		= mysqli_query($connect, $sql) or die (mysqli_error());

$rows	= array();
while ($r = mysqli_fetch_assoc($q)) {
	$rows[] = $r;
}
$data = "{ description:".json_encode($rows)."}";
echo $data;
?>
