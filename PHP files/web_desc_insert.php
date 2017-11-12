<?php include "connection.php"; ?>

<head>
    <title>GREEN RED CARD
    </title>
    <link rel="shortcut icon" href="files/grc-logo.png">
    <script src="files/js/jquery.min.js">
    </script>
    <script src="files/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="files/bootstrap/css/bootstrap.min.css">
</head>

<body style="background-color:#D0E3EE">
    <h1 align=center >                    INSERT NEW DESCRIPTION                 </h1>
    <div class="col-md-8 col-md-offset-2">
        <div id="tambah-data" class="well">
            <form id="form-data">

                <div id="waktu-group" class="form-group">
                    <label>Description :
                    </label>
                    <input type="text" class="form-control" id="desc" name="desc" placeholder="Deskripsi Prestasi/Pelanggaran" />
                    <br/>
                </div>

                <div id="tgl-group" class="form-group">
                    <label>Type
                    </label>
                    <input type="text" class="form-control" id="type" name="type" placeholder="Tipe Prestasi/Pelanggaran" />
                    <br/>
                </div>

                <div id="nama-group" class="form-group">
                    <label>Point :
                    </label>
                    <input type="text" class="form-control" id="point" name="point" placeholder="Point Prestasi/Pelanggaran" />
                    <br/>
                </div>
                <input type="submit" name="Save" value="Save" class="btn btn-primary btn-small" />
                <input type="reset" value="Reset" class="btn btn-success btn-small" />
            </form>
        </div>
    </div>
    <?php 
     $carikode = mysqli_query($connect, "select max(DescID) from description") or die (mysql_error());
// menjadikannya array
    $datakode = mysqli_fetch_array($carikode);
// jika $datakode
  if ($datakode) {
   $nilaikode = substr($datakode[0], 1);
// menjadikan $nilaikode ( int )
   $kode = (int) $nilaikode;
// setiap $kode di tambah 1
   $kode = $kode + 1;
   $kode_otomatis = "D".str_pad($kode, 4, "0", STR_PAD_LEFT);
  } else {
   $kode_otomatis = "D0001x";
  }
  
              
  if(isset($_GET['Save'])){
   $desk = $_GET['desc']; 
   $tipe = $_GET['type']; 
   $poin = $_GET['point'];   

   $sql0 = "insert into description values('$kode_otomatis','$desk','$tipe', '$poin')" ;
    mysqli_query($connect, $sql0);
    if ($sql0) {
      echo 'deskripsi berhasil ditambahkan';
    } else{
    echo 'error input data deskripsi'; 
  }
  
  }
  ?>
</body>                                                              