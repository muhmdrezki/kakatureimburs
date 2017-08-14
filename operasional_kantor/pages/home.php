<html lang="ina">
<?php 
  session_start();

  include "../con_db.php";

  $sql = "SELECT COUNT(id_anggota) as jumlah FROM tb_anggota";
  $result = mysqli_query($koneksi, $sql);
  $values = mysqli_fetch_assoc($result);
  $val = $values['jumlah']; 

  $tgl_now = date('d-m-y');
  $month = date('F', strtotime($tgl_now));

  $sql2 = "SELECT COUNT(*) as jumlah_pembayaran FROM `tb_pembayaran` WHERE MONTHNAME(tanggal) = '$month'";
  $result2 = mysqli_query($koneksi, $sql2);
  $values2 = mysqli_fetch_assoc($result2);
  $val2 = $values2['jumlah_pembayaran'];

  $sql3 = "SELECT SUM(nominal) as total_pengeluaran FROM `tb_pembayaran` WHERE MONTHNAME(tanggal) = '$month'";
  $result3 = mysqli_query($koneksi, $sql3);
  $values3 = mysqli_fetch_assoc($result3);
  $val3 = $values3['total_pengeluaran'];

?>
<body>
<div class="container">
<!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $val2 ?></h3>

              <p>Jumlah Transaksi</p>
              <?php echo "Bulan ".$month ?>
            </div>
            <div class="icon">
              <i class="fa fa-money"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo "Rp.".$val3 ?></h3>

              <p>Total Pengeluaran</p>
              <?php echo "Bulan".$month?>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $val ?></h3>

              <p>Jumlah Anggota</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>65</h3>

              <p>Unique Visitors</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
<hr>
<table class="tablemenu">
<tr>
<td style="padding: 25px; width: 35%;">
   <div class="jumbotron btn-success">
    <a href="index.php?sidebar-menu=form_bayar&action=tampil&jenis=listrik" style="color: #f9f9f9; font-family: 'Dosis', sans-serif;"><h2>BAYAR LISTRIK</h2></a>    
  </div>
</td>
<td style="padding: 25px; width: 35%;">      
  <div class="jumbotron fadeInLeft animated btn-warning" >
    <a href="index.php?sidebar-menu=form_bayar&action=tampil&jenis=ART" style="color: #f9f9f9; font-family: 'Dosis', sans-serif;"><h2>BAYAR ART KANTOR</h2></a>      
  </div>
</td>
</tr>
<tr> 
<td style="padding: 25px; width: 35%;">   
  <div class="jumbotron fadeInLeft animated btn-danger">
    <a href="index.php?sidebar-menu=form_bayar&action=tampil&jenis=sampah" style="color: #f9f9f9; font-family: 'Dosis', sans-serif;"><h2>BAYAR SAMPAH</h2></a>      
  </div>
  </td>
  <td style="padding: 25px; width: 35%;">    
  <div class="jumbotron fadeInLeft animated btn-info">
    <a href="index.php?sidebar-menu=form_bayar&action=tampil&jenis=airminum" style="color: #f9f9f9; font-family: 'Dosis', sans-serif;"><h2>BAYAR AIR MINUM</h2></a>      
  </div>
  </td>
</tr>   
<tr> 
<td style="padding: 25px; width: 35%;">   
  <div class="jumbotron fadeInLeft animated btn-primary">
    <a href="index.php?sidebar-menu=form_bayar&action=tampil&jenis=transport" style="color: #f9f9f9; font-family: 'Dosis', sans-serif;"><h2>BAYAR TRANSPORT</h2></a>      
  </div>
  </td>
  <td style="padding: 25px; width: 35%;">    
  <div class="jumbotron fadeInLeft animated btn-primary">
    <a href="index.php?sidebar-menu=form_bayar&action=tampil&jenis=konsumsi" style="color: #f9f9f9; font-family: 'Dosis', sans-serif;"><h2>BAYAR KONSUMSI</h2></a>      
  </div>
  </td>
</tr>    
</table>
</div>
</body>
</html>