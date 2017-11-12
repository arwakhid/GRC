<?php
//koneksi database
include "connection.php"; 

echo "{ cards:[";
$sqlx="SELECT * FROM student s, cards c, description d, time t, user u, grade g WHERE c.StudentID = s.StudentID AND c.DescID=d.DescID AND c.TimeID=t.TimeID AND c.UserID=u.UserID AND s.GradeID = g.GradeID " ; 
                $result=mysqli_query($connect, $sqlx) or die(mysql_error()); 
                if(mysqli_num_rows($result)> 0){ 
               while($row = mysqli_fetch_array($result)){ 
               	$kartu = $row['CardID'];
                $siswa = $row['Student'];
                $kelas = $row['GradeID'];
                $desk = $row['Description'];
                $tanggal = $row['Date'];
                $guru = $row['Name'];
               echo "{\"CardID\":\"$kartu\",\"StudentID\":\"$siswa\",\"GradeID\":\"$kelas\",\"DescID\":\"$desk\",\"TimeID\":\"$tanggal\",\"UserID\":\"$guru \"}";
                } }  else  { 
                echo 'no data'; } 
echo "]}";
?>