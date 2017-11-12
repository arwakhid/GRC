<?php
 
$host_name = "localhost"; 
$user_name = "root";
$password = "";
$database = "grc"; //here my database

$connect = mysqli_connect($host_name, $user_name, $password);
mysqli_select_db($connect, $database);
 
?> 