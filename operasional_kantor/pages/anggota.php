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
        <th>Email</th>
        <th>Jenis Kelamin</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
            <?php

           $sql = "SELECT id_anggota, nama, jabatan, email, jenis_kelamin FROM tb_anggota";

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
              <td> <?php echo $r[email] ?> </td>
              <td> <?php echo $r[jenis_kelamin] ?> </td>           
              <td> <center><a href='#'> <span class='glyphicon glyphicon-list-alt'></span> </a></center> </td>
            </tr>

              <?php
                $no++;
              }
            ?>
      </tr>
    </tbody>
  </table>
</div>
</body>
</html>
