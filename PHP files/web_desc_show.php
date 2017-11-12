<?php include "connection.php"; ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <title>DATA GRC</title>
  <link rel="shortcut icon" href="files/grc-logo.png">
    <script src="files/js/jquery.min.js">
    </script>
    <script src="files/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="files/bootstrap/css/bootstrap.min.css">
  </head>
  <body onload="muatDaftarData();">
       <h1 align=center>                    DATA DESCRIPTION              </h1>
       <div class="col-md-8 col-md-offset-2" ng-controller="listContactCtrl">
       <div id="list-data" class="well">
               <table class="table" border=1>
           <thead><tr>
           <td><b>ID</b></td>
           <td><b>Description</b></td>
           <td><b>Type</b></td>
           <td><b>Point</b></td>
           <td><b>Action</b></td>
           </tr> </thead>
                <tbody>
           <?php 
                $sqlx="SELECT * FROM description " ; 
                $result=mysqli_query($connect, $sqlx) or die(mysql_error()); 
                if(mysqli_num_rows($result)> 0){ 
               while($row = mysqli_fetch_array($result)){ 
               echo "
                  <tr>
                    <td>{$row['DescID']}</td>
                    <td>{$row['Description']}</td>
                    <td>{$row['Type']}</td>
                    <td>{$row['Point']}</td>
                    <td>    </td>
                 </tr> 
               ";
                } }  else  { 
                echo 'no data'; } 
                        ?>
           
           
             </tbody>  
          </table>
            </div>
          
      </div>
  </body>
</html>
