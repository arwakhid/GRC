<?php include "connection.php"; ?>

<head>
    <title>GREEN RED CARD
    </title>
    <link rel="shortcut icon" href="files/grc-logo.png">
    <script src="files/js/jquery.min.js">
    </script>
    <script src="files/bootstrap/js/bootstrap.min.js"></script>
    <script>
        $(function() {
            $('input[type="time"][value="now"]').each(function() {
                var d = new Date(),
                    h = d.getHours(),
                    m = d.getMinutes();
                if (h < 10) h = '0' + h;
                if (m < 10) m = '0' + m;
                $(this).attr({
                    'value': h + ':' + m
                });
            });
        });
    </script>
    <link rel="stylesheet" href="files/bootstrap/css/bootstrap.min.css">
</head>

<body style="background-color:#D0E3EE">
    <h1 align=center style="background-color:#ff471a">                    RED CARD APP                 </h1>
    <div class="col-md-8 col-md-offset-2">
        <div id="tambah-data" class="well">
            <form id="form-data">

                <div id="waktu-group" class="form-group">
                    <label>Time :
                    </label>
                    <input type="time" class="form-control" id="waktu" name="waktu" value="now" />
                    <br/>
                </div>

                <div id="tgl-group" class="form-group">
                    <label>Date:
                    </label>
                    <input type="date" class="form-control" id="tgl" name="tgl" value="<?php echo date('Y-m-d'); ?>" />
                    <br/>
                </div>

                <div id="nama-group" class="form-group">
                    <label>Name :
                    </label>
                    <input type="text" list="suggestions" class="form-control" id="nama" name="nama" placeholder="nama siswa" />
                    <datalist id="suggestions">
                        <?php 
                        $sql1="select * from student" ; 
                        $result1=mysqli_query($connect, $sql1) or die(mysql_error()); 
                        if(mysqli_num_rows($result1)> 0){ 
                        while($row = mysqli_fetch_array($result1)){ 
                        echo "<option value=\""; 
                        echo "{$row['Student']}"; 
                        echo "\">"; } }  else  { 
                        echo 'option value=NoStudents>'; } 
                        ?>
                    </datalist>
                    <br/>
                </div>
                <div id="nama-group" class="form-group">
                    <label>Place :
                    </label>
                    <input type="text" list="sug" class="form-control" id="place" name="place" placeholder="Place Name" />
                    <datalist id="sug">
                        <?php 
                        $sql2="select * from place" ; 
                        $result2=mysqli_query($connect, $sql2) or die(mysql_error()); 
                        if(mysqli_num_rows($result2)> 0){ 
                        while($row = mysqli_fetch_array($result2)){ 
                        echo "<option value=\""; 
                        echo "{$row['Place']}"; 
                        echo "\">"; } }  else  { 
                        echo 'option value=NoStudents>'; } 
                        ?>
                    </datalist>
                    <br/>
                </div>
                <div id="ket-group" class="form-group">
                    <label>Description:
                    </label>
                    <input type="text" list="suggestion" class="form-control" id="desc" name="desc" placeholder="Achievement / Offense" />
                    <datalist id="suggestion">
                        <?php 
                        $sql3="select * from description where type='RED'" ; 
                        $result3=mysqli_query($connect, $sql3) or die(mysql_error()); 
                        if(mysqli_num_rows($result3)> 0) { 
                        while($row = mysqli_fetch_array($result3)) { 
                        echo "<option value=\""; 
                        echo "{$row['Description']}"; 
                        echo "\">"; } } else { 
                        echo '<option value=NoDescription>'; } ?>
                    </datalist>
                    <br/>
                </div>
                <input type="submit" name="Save" value="Save" class="btn btn-primary btn-small" />
                <input type="reset" value="Reset" class="btn btn-success btn-small" />
            </form>
        </div>
    </div>
    <?php 
     $carikode = mysqli_query($connect, "select max(TimeID) from time") or die (mysql_error());
// menjadikannya array
    $datakode = mysqli_fetch_array($carikode);
// jika $datakode
  if ($datakode) {
   $nilaikode = substr($datakode[0], 1);
// menjadikan $nilaikode ( int )
   $kode = (int) $nilaikode;
// setiap $kode di tambah 1
   $kode = $kode + 1;
   $kode_otomatis = "T".str_pad($kode, 4, "0", STR_PAD_LEFT);
  } else {
   $kode_otomatis = "T0001x";
  }
  
  $carikode2 = mysqli_query($connect, "select max(CardID) from cards") or die (mysql_error());
// menjadikannya array
    $datakode2 = mysqli_fetch_array($carikode2);
// jika $datakode
  if ($datakode2) {
   $nilaikode2 = substr($datakode2[0], 1);
// menjadikan $nilaikode ( int )
   $kode2 = (int) $nilaikode2;
// setiap $kode di tambah 1
   $kode2 = $kode2 + 1;
   $kode_otomatis2 = "C".str_pad($kode2, 4, "0", STR_PAD_LEFT);
  } else {
   $kode_otomatis2 = "C0001x";
  }
              
  if(isset($_GET['Save'])){
   $wkt = $_GET['waktu']; 
   $tgl = $_GET['tgl']; 
   $desc = $_GET['desc'];   
   $plc = $_GET['place'];
   $siswa = $_GET['nama'];
  
  $sql4 = "select * from student where Student like '%$siswa%'";
	$result4 = mysqli_query($connect, $sql4) or die(mysql_error());
	if(mysqli_num_rows($result4) > 0){
     while($row = mysqli_fetch_array($result4)){         
		$siswanya = $row['StudentID']  ;
        }
	}else{
	  echo  "error baca siswa";
	}
  
  $sql5 = "select * from description where Description like '%$desc%'";
	$result5 = mysqli_query($connect, $sql5) or die(mysql_error());
	if(mysqli_num_rows($result5) > 0){
     while($row = mysqli_fetch_array($result5)){         
		$desknya = $row['DescID']  ;
        }
	}else{
	  echo  "error baca deskripsi";
	}
  
  $sql6 = "select * from place where Place like '%$plc%'";
	$result6 = mysqli_query($connect, $sql6) or die(mysql_error());
	if(mysqli_num_rows($result6) > 0){
     while($row = mysqli_fetch_array($result6)){         
		$tmptnya = $row['PlaceID']  ;
        }
	}else{
	  echo  "error baca tempat";
	}
  
   $sql = "select * from time where Time like '%$wkt%' and '%$tgl%'";
	$result = mysqli_query($connect, $sql) or die(mysql_error());
	if(mysqli_num_rows($result) > 0){
      while($row0 = mysqli_fetch_array($result)){         
		$wktnya = $row0['TimeID']  ;
        }
		$sql0 = "insert into cards values('$kode_otomatis2','$siswanya','$desknya', '$wktnya', '$tmptnya', 'ayubrokhman')" ;
    mysqli_query($connect, $sql0);
    echo 'waktu ada yang sama, data kartu berhasil ditambahkan'; 
	}else{
	  $sql2 = "insert into time values('$kode_otomatis','$wkt','$tgl')" ;
    mysqli_query($connect, $sql2);
    		$sql0 = "insert into cards values('$kode_otomatis2','$siswanya','$desknya', '$kode_otomatis', '$tmptnya', 'ayubrokhman')" ;
    mysqli_query($connect, $sql0);
    echo 'waktu tidak ada yang sama, data waktu dan data kartu berhasil ditambahkan'; 
	}
  
  }
  ?>
</body>                                                              