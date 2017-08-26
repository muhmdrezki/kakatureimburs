<!DOCTYPE html>
<html lang="en">
<head>
  <title>Form Pembayaran</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
   <link rel="stylesheet" href="css/animate.css">

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
  <form action="pages/proses_pembayaran.php" method="POST" enctype="multipart/form-data" id="form_pembayaran">
    
    <div class="form-group">
      <label for="id_pembayaran">ID</label>
      <input type="text" class="form-control" id="id_pembayaran" placeholder="Id Pembayaran" name="id_pembayaran" value="<?php echo $id; ?>" readonly>
    </div>

    <div class="form-group">
      <label for="Id_anggota">ID Anggota</label>
      <input type="text" class="form-control" id="id_anggota" name="id_anggota" value="<?php echo $id_anggota; ?>" readonly>
    </div>

    <?php 

      if( $_SESSION['jenis']=='listrik'){

        $sql = "SELECT * FROM tb_jenistransaksi WHERE jenis = 'Bayar Listrik'";
        $result = mysqli_query($koneksi, $sql);
        $value = mysqli_fetch_assoc($result);

    ?>
        <div class="form-group">
      <label for="jenis"> Jenis Pembayaran </label>
      <select class="form-control btn-success" id="jenis" name="jenis">
        <option value="<?php echo $value['id_jenis']?>"> <?php echo $value['jenis']?> </option>
      </select>
    </div>
    <?php
      } else if( $_SESSION['jenis']=='air'){

        $sql = "SELECT * FROM tb_jenistransaksi WHERE jenis = 'Bayar Air Minum'";
        $result = mysqli_query($koneksi, $sql);
        $value = mysqli_fetch_assoc($result);

    ?> 
        <div class="form-group">
      <label for="jenis"> Jenis Pembayaran </label>
      <select class="form-control btn-info" id="jenis" name="jenis">
        <option value="<?php echo $value['id_jenis']?>"> <?php echo $value['jenis']?> </option>
      </select>
      </div>
    <?php
      } else if( $_SESSION['jenis']=='ART'){

        $sql = "SELECT * FROM tb_jenistransaksi WHERE jenis = 'Bayar ART'";
        $result = mysqli_query($koneksi, $sql);
        $value = mysqli_fetch_assoc($result);

        ?>
          <div class="form-group">
      <label for="jenis"> Jenis Pembayaran </label>
      <select class="form-control btn-warning" id="jenis" name="jenis">
        <option value="<?php echo $value['id_jenis']?>"> <?php echo $value['jenis']?> </option>
      </select>
      </div>
        <?php
      } else if( $_SESSION['jenis']=='sampah'){

        $sql = "SELECT * FROM tb_jenistransaksi WHERE jenis = 'Bayar ART'";
        $result = mysqli_query($koneksi, $sql);
        $value = mysqli_fetch_assoc($result);

        ?>
          <div class="form-group">
      <label for="jenis"> Jenis Pembayaran </label>
      <select class="form-control btn-default" id="jenis" name="jenis">
        <option value="<?php echo $value['id_jenis']?>"> <?php echo $value['jenis']?> </option>
      </select>
      </div>
    <?php
      } else if( $_SESSION['jenis']=='konsumsi'){

        $sql = "SELECT * FROM tb_jenistransaksi WHERE jenis = 'Bayar Konsumsi'";
        $result = mysqli_query($koneksi, $sql);
        $value = mysqli_fetch_assoc($result);

        ?>
          <div class="form-group">
      <label for="jenis"> Jenis Pembayaran </label>
      <select class="form-control btn-primary" id="jenis" name="jenis">
        <option value="<?php echo $value['id_jenis']?>"> <?php echo $value['jenis']?> </option>
      </select>
      </div>
    <?php
      } else if( $_SESSION['jenis']=='transport'){

        $sql = "SELECT * FROM tb_jenistransaksi WHERE jenis = 'Bayar transport'";
        $result = mysqli_query($koneksi, $sql);
        $value = mysqli_fetch_assoc($result);

        ?>
          <div class="form-group">
      <label for="jenis"> Jenis Pembayaran </label>
      <select class="form-control btn-danger" id="jenis" name="jenis" >
        <option value="<?php echo $value['id_jenis']?>"> <?php echo $value['jenis']?> </option>
      </select>
      </div>
    <?php
      } else {

        $sql = "SELECT * FROM tb_jenistransaksi";
        $result = mysqli_query($koneksi, $sql);

    ?>
    <div class="form-group">
      <label for="jenis"> Jenis Pembayaran </label>
      <select 
      class="form-control" id="jenis" name="jenis"
      data-validation="required" data-validation-error-msg="Pilih Jenis Pembayaran !"
      >
      <option value=""> Pilih Pembayaran </option>
        <?php  while ($r = mysqli_fetch_array($result)) {
          ?>
          <option value="<?php echo $r[id_jenis]?>"> <?php echo $r[jenis]; ?> </option>
        <?php
        } ?>
        
      </select>
    </div>

    <?php } ?>
    <!-- jQuery 3 -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../inputmask/jquery.number.js"></script>
    <script type="text/javascript">
      
      $(function(){
        // Set up the number formatting.
        
        $('#nominal').on('change',function(){
          console.log('Change event.');
          var val = $('#nominal').val();
          $('#the_number').text( val !== '' ? val : '(empty)' );
        });
        
        $('#nominal').change(function(){
          console.log('Second change event...');
        });
        
        $('#nominal').number( true, 2);
      });
    </script>


    <div class="form-group">
      <label for="nominal"> Nominal </label>
      <input 
      class="form-control" type="text" id="nominal" name="nominal"
      data-validation="required" data-validation-error-msg="Field Nominal Harus Diisi !"
      >
    </div>

    <div class="form-group">
      <label for="keterangan"> Keterangan </label>
      <textarea 
      class="form-control" rows="5" id="keterangan" name="keterangan" placeholder="Keterangan Pembayaran"
      data-validation="required" data-validation-error-msg="Beri Keterangan Pada Pembayaran Anda !"
      >
        
      </textarea>
    </div>

    <div class="form-group">
      <label for="pass"> Bukti Pembayaran (Optional) </label>
      <input class="form-control" type="file" name="bukti[]" multiple acceptedFiles="image/*;capture=camera" />
    </div>

    <br>
    <input name="submit" type="submit" id="get_number" class="btn btn-primary" value="SUBMIT"> 
    <br>
    <br>
  </form>

</div>
</body>
</html>

