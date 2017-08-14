<!DOCTYPE html>
<?php
 error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
 include '/../con_db.php';
?>
<html lang="en">
<head>
  <title>List Pembayaran</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body class="hold-transition skin-blue sidebar-mini" style="background-color: #f9f9f9">

<style>
@import url('https://fonts.googleapis.com/css?family=Dosis');
</style>
<div class="container">
  <h2>LIST PEMBAYARAN OPERASIONAL KANTOR</h2>   
  <br>     
  <a href="index.php?sidebar-menu=form_bayar&action=tampil"><span class="glyphicon glyphicon-plus"></span>BAYAR OPERASIONAL</a>
  <br>
  <br>
  <a href="index.php?sidebar-menu=list_bayar&action=tampil" class="btn btn-default">VIEW ALL</a>  
               <div class="form-group pull-right">
                <div class="input-group"> 
            <form method="POST" action="index.php?sidebar-menu=list_bayar&action=tampil" style="margin-top: 10px;">             
                  <input type="submit" name="status_belum" value="BELUM REIMBERS" class="btn btn-danger" style="margin-left: 3px;">
                  <input type="submit" name="status_sudah" value="SUDAH REIMBERS" class="btn btn-success" style="margin-left: 3px;">
                  <input type="submit" name="status_menunggu" value="MENUNGGU KONIRMASI" class="btn btn-warning" style="margin-left: 3px;">
                </div>
               </div>
            </form>

  <hr>
  
           
              <div class="form-group">
                <label> FILTER TANGGAL </label>
                 <form method="POST" action="index.php?sidebar-menu=list_bayar&action=tampil">
                <div class="input-group"> 
                  <input type="text" class="form-control" id="start_date" name="start_date" style="width: 150px;" placeholder="Dari"> 
                  <input type="text" class="form-control" id="end_date" name="end_date" style="width: 150px; margin-left: 10px;" placeholder="Sampai">
                  <input type="submit" name="submit" value="APPLY" class="btn btn-info" style="margin-left: 10px;">
                </div>
                </div>
            </form>

            <?php 

              $start = $_POST['start_date'];
              $end = $_POST['end_date'];
              
              $startdate = date("Y-m-d", strtotime($start));
              $enddate = date("Y-m-d", strtotime($end));

            ?>

  <hr>
  <table class="table" id="example">
    <thead>
      <tr>
        <th style="width: 14%;">Nama Anggota</th>
        <th style="width: 10%;">Tanggal</th>
        <th style="width: 14%;">Jenis Pembayaran</th>
        <th style="width: 10%;">Nominal</th>
        <th style="width: 10%;">Status</th>
      </tr>
    </thead>
    <tbody>
       <?php
       if(isset($_POST['submit'])){
          $sql = "SELECT tb_pembayaran.id_pembayaran, tb_anggota.nama, tb_pembayaran.id_anggota, tb_pembayaran.tanggal, tb_pembayaran.jenis, tb_pembayaran.nominal, tb_pembayaran.keterangan, tb_pembayaran.status FROM tb_pembayaran JOIN tb_anggota ON tb_pembayaran.id_anggota=tb_anggota.id_anggota WHERE tb_pembayaran.tanggal BETWEEN '$startdate' AND '$enddate'";

          $result = mysqli_query($koneksi,$sql);

        } else if(isset($_POST['status_sudah'])){
            $sql = "SELECT tb_pembayaran.id_pembayaran, tb_anggota.nama, tb_pembayaran.id_anggota, tb_pembayaran.tanggal, tb_pembayaran.jenis, tb_pembayaran.nominal, tb_pembayaran.keterangan, tb_pembayaran.status FROM tb_pembayaran JOIN tb_anggota ON tb_pembayaran.id_anggota=tb_anggota.id_anggota WHERE tb_pembayaran.status='sudah'";

          $result = mysqli_query($koneksi,$sql);

        } else if(isset($_POST['status_belum'])){
          $sql = "SELECT tb_pembayaran.id_pembayaran, tb_anggota.nama, tb_pembayaran.id_anggota, tb_pembayaran.tanggal, tb_pembayaran.jenis, tb_pembayaran.nominal, tb_pembayaran.keterangan, tb_pembayaran.status FROM tb_pembayaran JOIN tb_anggota ON tb_pembayaran.id_anggota=tb_anggota.id_anggota WHERE tb_pembayaran.status='belum'";

          $result = mysqli_query($koneksi,$sql);
        } else if(isset($_POST['status_menunggu'])) {
            $sql = "SELECT tb_pembayaran.id_pembayaran, tb_anggota.nama, tb_pembayaran.id_anggota, tb_pembayaran.tanggal, tb_pembayaran.jenis, tb_pembayaran.nominal, tb_pembayaran.keterangan, tb_pembayaran.status FROM tb_pembayaran JOIN tb_anggota ON tb_pembayaran.id_anggota=tb_anggota.id_anggota WHERE tb_pembayaran.status='menunggu'";

          $result = mysqli_query($koneksi,$sql);
        } else {
           $_SESSION['notif'] = $_GET['status'];

           $jabatan = $_SESSION['jabatan'];
           $id = $_SESSION['id_anggota'];

            if ($_SESSION['notif'] == 'notif'){
              
              if($jabatan != 'Admin'){
              $sql = "SELECT tb_pembayaran.id_pembayaran, tb_anggota.nama, tb_pembayaran.id_anggota, tb_pembayaran.tanggal, tb_pembayaran.jenis, tb_pembayaran.nominal, tb_pembayaran.keterangan, tb_pembayaran.status FROM tb_pembayaran JOIN tb_anggota ON tb_pembayaran.id_anggota=tb_anggota.id_anggota  WHERE tb_pembayaran.status = 'menunggu' AND tb_pembayaran.id_anggota='$id' ORDER BY tb_pembayaran.tanggal DESC ";
              } else if($jabatan == 'Admin'){
              $sql = "SELECT tb_pembayaran.id_pembayaran, tb_anggota.nama, tb_pembayaran.id_anggota, tb_pembayaran.tanggal, tb_pembayaran.jenis, tb_pembayaran.nominal, tb_pembayaran.keterangan, tb_pembayaran.status FROM tb_pembayaran JOIN tb_anggota ON tb_pembayaran.id_anggota=tb_anggota.id_anggota  WHERE tb_pembayaran.status = 'belum' ORDER BY tb_pembayaran.tanggal DESC";
             }

            } else {

                if($jabatan != 'Admin'){
              $sql = "SELECT tb_pembayaran.id_pembayaran, tb_anggota.nama, tb_pembayaran.id_anggota, tb_pembayaran.tanggal, tb_pembayaran.jenis, tb_pembayaran.nominal, tb_pembayaran.keterangan, tb_pembayaran.status FROM tb_pembayaran JOIN tb_anggota ON tb_pembayaran.id_anggota=tb_anggota.id_anggota  WHERE tb_pembayaran.id_anggota='$id' ORDER BY tb_pembayaran.tanggal DESC";
              } else if($jabatan == 'Admin'){
              $sql = "SELECT tb_pembayaran.id_pembayaran, tb_anggota.nama, tb_pembayaran.id_anggota, tb_pembayaran.tanggal, tb_pembayaran.jenis, tb_pembayaran.nominal, tb_pembayaran.keterangan, tb_pembayaran.status FROM tb_pembayaran JOIN tb_anggota ON tb_pembayaran.id_anggota=tb_anggota.id_anggota ORDER BY tb_pembayaran.tanggal DESC";
             }
            }
            $result = mysqli_query($koneksi,$sql);
          }
           
           
           if (!$result) {
              printf("Error: %s\n", mysqli_error($koneksi));
              exit();
              } 
           
           $no = 1;
            while($r = mysqli_fetch_array($result))
            {
                $id = $r[id_pembayaran]
            ?>
            <tr>
              <td> <?php echo $r[nama] ?> </td>
              <td> <?php echo $r[tanggal] ?> </td>
              <td> <?php echo $r[jenis] ?> </td>
              <td> <?php echo $r[nominal] ?> </td>         
              <?php 
                if($r[status]=='belum'){
                  ?>
                       <td> <a href="index.php?sidebar-menu=detail&action=tampil&id=<?php echo $id ?>" class="btn btn-danger"> <span> BELUM REIMBERS </span> </a> </td>
                  <?php 
                } else if($r[status]=='sudah'){
                  ?>
                       <td> <a href="index.php?sidebar-menu=detail&action=tampil&id=<?php echo $id ?>" class="btn btn-success"> <span> SUDAH REIMBERS </a>  </td>
                  <?php 
                } else if($r[status]=='menunggu'){
                  ?>
                       <td> <a href="index.php?sidebar-menu=detail&action=tampil&id=<?php echo $id ?>" class="btn btn-warning"> <span> MENUNGGU KONFIRMASI </a>  </td> 
                <?php
                }
              ?>
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
