<!DOCTYPE html>
<html lang="en">
<head>
  <title>Form Pembayaran</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
   <link rel="stylesheet" href="css/animate.css">
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">

<style>
@import url('https://fonts.googleapis.com/css?family=Dosis');
</style>
<?php 
session_start();
  
  $_SESSION['jenis'] = $_GET['jenis'];
  $id_anggota = $_SESSION['id_anggota'];

  $tgl_now = date("d-m-Y"); 
  $dayname = date('D', strtotime($tgl_now));
  $day = date('j', strtotime($tgl_now));
  $month = date('F', strtotime($tgl_now));
  $year = date('Y', strtotime($tgl_now));
 
  $id = mt_rand(10000,99999);
  
  ?>
<div class="container fadeInLeft animated" style="width: 70%;">
<h3 style="float: right;"> <?php echo $dayname." , ".$day." - ".$month." - ".$year; ?> </h3>
<hr>
<br>
<br>
  <h2>FORM PEMBAYARAN</h2> 
  <br>
  <form action="pages/proses_pembayaran.php" method="POST" enctype="multipart/form-data">
    
    <div class="form-group">
      <label for="id_pembayaran">ID</label>
      <input type="text" class="form-control" id="id_pembayaran" placeholder="Id Pembayaran" name="id_pembayaran" value="<?php echo $id; ?>">
    </div>

    <div class="form-group">
      <label for="Id_anggota">ID Anggota</label>
      <input type="text" class="form-control" id="id_anggota" name="id_anggota" value="<?php echo $id_anggota; ?>">
    </div>

    <?php 
      if( $_SESSION['jenis']=='listrik'){
    ?>
        <div class="form-group">
      <label for="jenis"> Jenis Pembayaran </label>
      <select class="form-control" id="jenis" name="jenis">
        <option value="Bayar Listrik"> Bayar Listrik </option>
      </select>
    </div>
    <?php
      } else if( $_SESSION['jenis']=='airminum'){
    ?> 
      <label for="jenis"> Jenis Pembayaran </label>
      <select class="form-control" id="jenis" name="jenis">
        <option value="Bayar Air Minum"> Bayar Air Minum </option>
      </select>
    <?php
      } else if( $_SESSION['jenis']=='ART'){
        ?>
      <label for="jenis"> Jenis Pembayaran </label>
      <select class="form-control" id="jenis" name="jenis">
        <option value="Bayar ART"> Bayar ART </option>
      </select>
        <?php
      } else if( $_SESSION['jenis']=='sampah'){
        ?>
      <label for="jenis"> Jenis Pembayaran </label>
      <select class="form-control" id="jenis" name="jenis">
        <option value="Bayar Sampah"> Bayar Sampah </option>
      </select>
    <?php
      } else if( $_SESSION['jenis']=='konsumsi'){
        ?>
      <label for="jenis"> Jenis Pembayaran </label>
      <select class="form-control" id="jenis" name="jenis">
        <option value="Bayar Konsumsi"> Bayar Konsumsi </option>
      </select>
    <?php
      } else if( $_SESSION['jenis']=='transport'){
        ?>
      <label for="jenis"> Jenis Pembayaran </label>
      <select class="form-control" id="jenis" name="jenis">
        <option value="Bayar Transport"> Bayar Transport </option>
      </select>
    <?php
      } else {

        $sql = "SELECT * FROM tb_jenistransaksi";
        $result = mysqli_query($koneksi, $sql);

    ?>
    <div class="form-group">
      <label for="jenis"> Jenis Pembayaran </label>
      <select class="form-control" id="jenis" name="jenis">
        <?php  while ($r = mysqli_fetch_array($result)) {
          ?>
          <option value="<?php echo $r[id_jenis]?>"> <?php echo $r[jenis]; ?> </option>
        <?php
        } ?>
        
      </select>
    </div>
    <?php } ?>

    <div class="form-group">
      <label for="nominal"> Nominal </label>
      <input class="form-control" type="number" id="nominal" name="nominal">
    </div>

    <div class="form-group">
      <label for="keterangan"> Keterangan </label>
      <textarea class="form-control" rows="5" id="keterangan" name="keterangan" placeholder="Keterangan Pembayaran"></textarea>
    </div>

    <div class="form-group">
      <label for="pass"> Bukti Pembayaran </label>
      <input class="form-control" type="file" name="bukti[]" multiple/>
    </div>

    <br>
    <input name="submit" type="submit" class="btn btn-primary" value="SUBMIT" data-toggle="modal" data-target="#myModal"> 
    <br>
    <br>
  </form>

</div>
</body>
</html>
