<?php 
include "connection.php"; 

// ngadamel kode otomatis untuk TimeID
 $carikode = mysqli_query($connect, "select max(TimeID) from time") or die (mysql_error());
    $datakode = mysqli_fetch_array($carikode);
  if ($datakode) {
   $nilaikode = substr($datakode[0], 1);
   $kode = (int) $nilaikode;
   $kode = $kode + 1;
   $kode_otomatis = "T".str_pad($kode, 4, "0", STR_PAD_LEFT);
  } else {
   $kode_otomatis = "T0001x";
  }
 
 // ngadamel kode otomatis untuk CardID
  $carikode2 = mysqli_query($connect, "select max(CardID) from cards") or die (mysql_error());
    $datakode2 = mysqli_fetch_array($carikode2);
  if ($datakode2) {
   $nilaikode2 = substr($datakode2[0], 1);
   $kode2 = (int) $nilaikode2;
   $kode2 = $kode2 + 1;
   $kode_otomatis2 = "C".str_pad($kode2, 4, "0", STR_PAD_LEFT);
  } else {
   $kode_otomatis2 = "C0001x";
  }

// array JSON dimulai
$respon =array();

// cek nilai nu atos dikirim ti Android
  if(isset($_GET['Save'])){
   $wkt = $_GET['waktu']; 
   $tgl = $_GET['tgl']; 
   $desc = $_GET['desc'];   
   $plc = $_GET['place'];
   $siswa = $_GET['nama'];
  
  // ngubah Nama Siswa nu dipilih janten StudentID
  $sql4 = "select * from student where Student like '%$siswa%'";
	$result4 = mysqli_query($connect, $sql4) or die(mysql_error());
	if(mysqli_num_rows($result4) > 0){
     while($row = mysqli_fetch_array($result4)){         
		$siswanya = $row['StudentID']  ;
        }
	}else{
	  echo  "error baca siswa";
	}
  
  // ngubah Description nu dipilih janten DescID
  $sql5 = "select * from description where Description like '%$desc%'";
	$result5 = mysqli_query($connect, $sql5) or die(mysql_error());
	if(mysqli_num_rows($result5) > 0){
     while($row = mysqli_fetch_array($result5)){         
		$desknya = $row['DescID']  ;
        }
	}else{
	  echo  "error baca deskripsi";
	}
  
  // ngubah Place nu dipilih janten PlaceID
  $sql6 = "select * from place where Place like '%$plc%'";
	$result6 = mysqli_query($connect, $sql6) or die(mysql_error());
	if(mysqli_num_rows($result6) > 0){
     while($row = mysqli_fetch_array($result6)){         
		$tmptnya = $row['PlaceID']  ;
        }
	}else{
	  echo  "error baca tempat";
	}
  
  // mun waktu aya nu sami, insert data cards anyar wungkul
   $sql = "select * from time where Time like '%$wkt%' and '%$tgl%'";
	$result = mysqli_query($connect, $sql) or die(mysql_error());
	if(mysqli_num_rows($result) > 0){
      while($row0 = mysqli_fetch_array($result)){         
		$wktnya = $row0['TimeID']  ;
        }
		$sql0 = "insert into cards values('$kode_otomatis2','$siswanya','$desknya', '$wktnya', '$tmptnya', 'ayubrokhman')" ;
		$result7 = mysqli_query($connect, $sql0);
		if ($result7) {
			$respon1 ["sukses"] = 1;
			$respon1 ["pesan"] = "waktu ada yang sama dan data kartu berhasil ditambahkan";
			// cetak JSON mun berhasil
			echo json_encode($respon1);
		} else {
			$respon1 ["sukses"] = 0;
			$respon1 ["pesan"] = "waktu ada yang sama, tapi data kartu tidak ditambahkan";
			// cetak JSON mun gagal
			echo json_encode($respon1);
		}
    
	}else{
	// mun teu aya waktu nu sami, insert data time sareng cards nu anyar
	$sql2 = "insert into time values('$kode_otomatis','$wkt','$tgl')" ;
    $result8 = mysqli_query($connect, $sql2);
    $sql0 = "insert into cards values('$kode_otomatis2','$siswanya','$desknya', '$kode_otomatis', '$tmptnya', 'ayubrokhman')" ;
    $result9 = mysqli_query($connect, $sql0);
    if ($result8) {
			$respon2 ["sukses"] = 1;
			$respon2 ["pesan"] = "waktu tidak ada yang sama dan data kartu berhasil ditambahkan";
			// cetak JSON mun berhasil
			echo json_encode($respon2);
		} else {
			$respon2 ["sukses"] = 0;
			$respon2 ["pesan"] = "waktu tidak ada yang sama, tapi data kartu tidak ditambahkan";
			// cetak JSON mun gagal
			echo json_encode($respon2);
		} 
	}
  
  } else {
  	$respon3 ["sukses"] = 0;
	$respon3 ["pesan"] = "aksi dari android gagal dilakukan!";
	// cetak JSON mun gagal dari isset
	echo json_encode($respon3);
  }
?>