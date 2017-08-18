<!DOCTYPE html>
<html>
<?php
 error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
 include '/../con_db.php';
?>
<head>
  <title>Bootstrap Example</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body style="background-color: #f9f9f9">

<style>
@import url('https://fonts.googleapis.com/css?family=Dosis');
</style>

<div class="container fadeIn animated">
  <h2>DAFTAR ANGGOTA TIM KAKATU</h2>   
  <br>     
  <a href="index.php?sidebar-menu=form_anggota&action=tampil"><span class="glyphicon glyphicon-plus"></span>TAMBAH DATA ANGGOTA</a>
  <br>
  <br>

  <table class="table" id="example1">
    <thead>
      <tr>
        <th>Id Anggota</th>
        <th>Nama Anggota</th>
        <th>Jabatan</th>
        <th>Jenis Kelamin</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
            <?php

           $sql = "SELECT tb_anggota.id_anggota, tb_anggota.nama, GROUP_CONCAT(tb_jabatan.jabatan SEPARATOR ', ') as 'jabatan', tb_anggota.email, tb_anggota.jenis_kelamin FROM `tb_anggota` JOIN jabatan_anggota ON tb_anggota.id_anggota = jabatan_anggota.id_anggota JOIN tb_jabatan ON tb_jabatan.id_jabatan = jabatan_anggota.id_jabatan GROUP BY tb_anggota.id_anggota";

           $result = mysqli_query($koneksi,$sql);
           
           if (!$result) {
              printf("Error: %s\n", mysqli_error($koneksi));
              exit();
              } 
           
           $no = 1;
            while($r = mysqli_fetch_array($result))
            {
            ?>
            
            <tr>
              <td> <?php echo $r[id_anggota] ?> </td>
              <td> <?php echo $r[nama] ?> </td>
              <td> <?php echo $r[jabatan] ?> </td>
              <td> <?php echo $r[jenis_kelamin] ?> </td>           
              <td> <center><a href='#' class="btn btn-info"> Detail <span class='glyphicon glyphicon-list-alt'></span> </a></center> </td>
            </tr>

              <?php
                $no++;
              }
            ?>
      </tr>
    </tbody>
  </table>
  <br>
   <form action="pages/proses_convert-csv.php" method="POST">
      <input type="submit" class="btn btn-primary pull-right" value="Convert To CSV" name="submit_csv-anggota">  
  </form>
</div>
</body>
</html>
