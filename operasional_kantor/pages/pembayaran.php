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

  <style>
@import url('https://fonts.googleapis.com/css?family=Dosis');
</style> 

</head>
<body style="background-color: #f9f9f9">
<section class="content-header">
  <h2>LIST PEMBAYARAN OPERASIONAL KANTOR</h2>        
</section>  
<br>
<section>
<a href="index.php?sidebar-menu=form_bayar&action=tampil" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>BAYAR OPERASIONAL</a>
<hr>
      <div class="form-group">
   <label> FILTER STATUS </label>
            <form method="POST" action="index.php?sidebar-menu=list_bayar&action=tampil"> 

             <div class="input-group"> 
              <a href="index.php?sidebar-menu=list_bayar&action=tampil" class="btn btn-default">VIEW ALL</a>              
                  <input type="submit" name="status_belum" value="BELUM" class="btn btn-danger" style="margin-left: 3px;">
                  <input type="submit" name="status_sudah" value="SUDAH" class="btn btn-success" style="margin-left: 3px;">
                  <input type="submit" name="status_menunggu" value="MENUNGGU" class="btn btn-warning" style="margin-left: 3px;">
             </div>
            </div>
             </form>         
              <div class="form-group">
                <label> FILTER TANGGAL </label>
                 <form method="POST" action="index.php?sidebar-menu=list_bayar&action=tampil">
                <div class="input-group"> 
                  <input type="text" class="form-control" id="start_date" name="start_date" style="width: 100px;" placeholder="Dari"> 
                  <input type="text" class="form-control" id="end_date" name="end_date" style="width: 100px; margin-left: 3px;" placeholder="Sampai">
                  <input type="submit" name="submit" value="APPLY" class="btn btn-info" style="margin-left: 3px;">
                </div>
                </div>
            </form>

            <?php 

              $start = $_POST['start_date'];
              $end = $_POST['end_date'];
              
              $startdate = date("Y-m-d", strtotime($start));
              $enddate = date("Y-m-d", strtotime($end));

            ?>

</section>
  <hr>
  <div class="table-responsive">
  <table class="table" id="example">
    <thead>
      <tr>
        <th style="width: 14%;">Nama Anggota</th>
        <th style="width: 10%;">Tanggal</th>
        <th style="width: 14%;">Jenis</th>
        <th style="width: 10%;">Status</th>
      </tr>
    </thead>
    <tbody>
       <?php

          $jabatan = $_SESSION['jabatan'];
          $id = $_SESSION['id_anggota'];
          list($one, $two) = explode(",", $_SESSION['jabatan'] , 2);

             if($one != 'Admin'){
              $sql = "SELECT tb_pembayaran.id_pembayaran,tb_anggota.nama, tb_pembayaran.tanggal, tb_jenistransaksi.jenis, tb_pembayaran.nominal, tb_pembayaran.status FROM `tb_pembayaran`JOIN `tb_anggota` ON tb_pembayaran.id_anggota = tb_anggota.id_anggota JOIN tb_jenistransaksi ON tb_pembayaran.id_jenis = tb_jenistransaksi.id_jenis  WHERE tb_pembayaran.id_anggota='$id' ORDER BY tb_pembayaran.tanggal DESC";
              } else if($one == 'Admin'){
              $sql = "SELECT tb_pembayaran.id_pembayaran,tb_anggota.nama, tb_pembayaran.tanggal, tb_jenistransaksi.jenis, tb_pembayaran.nominal, tb_pembayaran.status FROM `tb_pembayaran`JOIN `tb_anggota` ON tb_pembayaran.id_anggota = tb_anggota.id_anggota JOIN tb_jenistransaksi ON tb_pembayaran.id_jenis = tb_jenistransaksi.id_jenis ORDER BY tb_pembayaran.tanggal DESC";
             }
            
            $result = mysqli_query($koneksi,$sql);
              if (!$result) {
              printf("Error: %s\n", mysqli_error($koneksi));
              exit();
              } 


       if($one == 'Admin'){
       if(isset($_POST['submit'])){
        $sql = "SELECT tb_pembayaran.id_pembayaran, tb_anggota.nama, tb_pembayaran.tanggal, tb_jenistransaksi.jenis, tb_pembayaran.nominal, tb_pembayaran.status FROM `tb_pembayaran`JOIN `tb_anggota` ON tb_pembayaran.id_anggota = tb_anggota.id_anggota JOIN tb_jenistransaksi ON tb_pembayaran.id_jenis = tb_jenistransaksi.id_jenis WHERE tb_pembayaran.tanggal BETWEEN '$startdate' AND '$enddate'";

          $result = mysqli_query($koneksi,$sql);

        } else if(isset($_POST['status_sudah'])){
            $sql = "SELECT tb_pembayaran.id_pembayaran, tb_anggota.nama, tb_pembayaran.tanggal, tb_jenistransaksi.jenis, tb_pembayaran.nominal, tb_pembayaran.status FROM `tb_pembayaran`JOIN `tb_anggota` ON tb_pembayaran.id_anggota = tb_anggota.id_anggota JOIN tb_jenistransaksi ON tb_pembayaran.id_jenis = tb_jenistransaksi.id_jenis WHERE tb_pembayaran.status='2'";

          $result = mysqli_query($koneksi,$sql);

        } else if(isset($_POST['status_belum'])){
          $sql = "SELECT tb_pembayaran.id_pembayaran, tb_anggota.nama, tb_pembayaran.tanggal, tb_jenistransaksi.jenis, tb_pembayaran.nominal, tb_pembayaran.status FROM `tb_pembayaran`JOIN `tb_anggota` ON tb_pembayaran.id_anggota = tb_anggota.id_anggota JOIN tb_jenistransaksi ON tb_pembayaran.id_jenis = tb_jenistransaksi.id_jenis WHERE tb_pembayaran.status='0'";

          $result = mysqli_query($koneksi,$sql);
        } else if(isset($_POST['status_menunggu'])) {
            $sql = "SELECT tb_pembayaran.id_pembayaran,tb_anggota.nama, tb_pembayaran.tanggal, tb_jenistransaksi.jenis, tb_pembayaran.nominal, tb_pembayaran.status FROM `tb_pembayaran`JOIN `tb_anggota` ON tb_pembayaran.id_anggota = tb_anggota.id_anggota JOIN tb_jenistransaksi ON tb_pembayaran.id_jenis = tb_jenistransaksi.id_jenis WHERE tb_pembayaran.status='1'";

          $result = mysqli_query($koneksi,$sql);
            if (!$result) {
              printf("Error: %s\n", mysqli_error($koneksi));
              exit();
              } 
        }

        } else if($one != 'Admin'){
          
           if(isset($_POST['submit'])){
        $sql = "SELECT tb_pembayaran.id_pembayaran, tb_anggota.nama, tb_pembayaran.tanggal, tb_jenistransaksi.jenis, tb_pembayaran.nominal, tb_pembayaran.status FROM `tb_pembayaran`JOIN `tb_anggota` ON tb_pembayaran.id_anggota = tb_anggota.id_anggota JOIN tb_jenistransaksi ON tb_pembayaran.id_jenis = tb_jenistransaksi.id_jenis WHERE tb_pembayaran.tanggal BETWEEN '$startdate' AND '$enddate' AND tb_anggota.id_anggota='$id'";

          $result = mysqli_query($koneksi,$sql);
            if (!$result) {
              printf("Error: %s\n", mysqli_error($koneksi));
              exit();
              } 

        } else if(isset($_POST['status_sudah'])){
            $sql = "SELECT tb_pembayaran.id_pembayaran, tb_anggota.nama, tb_pembayaran.tanggal, tb_jenistransaksi.jenis, tb_pembayaran.nominal, tb_pembayaran.status FROM `tb_pembayaran`JOIN `tb_anggota` ON tb_pembayaran.id_anggota = tb_anggota.id_anggota JOIN tb_jenistransaksi ON tb_pembayaran.id_jenis = tb_jenistransaksi.id_jenis WHERE tb_pembayaran.status='2' AND tb_anggota.id_anggota='$id'";

          $result = mysqli_query($koneksi,$sql);
            if (!$result) {
              printf("Error: %s\n", mysqli_error($koneksi));
              exit();
              } 

        } else if(isset($_POST['status_belum'])){
          $sql = "SELECT tb_pembayaran.id_pembayaran, tb_anggota.nama, tb_pembayaran.tanggal, tb_jenistransaksi.jenis, tb_pembayaran.nominal, tb_pembayaran.status FROM `tb_pembayaran`JOIN `tb_anggota` ON tb_pembayaran.id_anggota = tb_anggota.id_anggota JOIN tb_jenistransaksi ON tb_pembayaran.id_jenis = tb_jenistransaksi.id_jenis WHERE tb_pembayaran.status='0' AND tb_anggota.id_anggota='$id'";

          $result = mysqli_query($koneksi,$sql);
            if (!$result) {
              printf("Error: %s\n", mysqli_error($koneksi));
              exit();
              } 

        } else if(isset($_POST['status_menunggu'])) {
            $sql = "SELECT tb_pembayaran.id_pembayaran,tb_anggota.nama, tb_pembayaran.tanggal, tb_jenistransaksi.jenis, tb_pembayaran.nominal, tb_pembayaran.status FROM `tb_pembayaran`JOIN `tb_anggota` ON tb_pembayaran.id_anggota = tb_anggota.id_anggota JOIN tb_jenistransaksi ON tb_pembayaran.id_jenis = tb_jenistransaksi.id_jenis WHERE tb_pembayaran.status='1' AND tb_anggota.id_anggota='$id'";

          $result = mysqli_query($koneksi,$sql);
            if (!$result) {
              printf("Error: %s\n", mysqli_error($koneksi));
              exit();
              } 
        }

        } else {
           $kliknotif = $_GET['status'];

            if ($kliknotif == 'notif'){
              
              if($one != 'Admin'){
              $sql = "SELECT tb_pembayaran.id_pembayaran,tb_anggota.nama, tb_pembayaran.tanggal, tb_jenistransaksi.jenis, tb_pembayaran.nominal, tb_pembayaran.status FROM `tb_pembayaran`JOIN `tb_anggota` ON tb_pembayaran.id_anggota = tb_anggota.id_anggota JOIN tb_jenistransaksi ON tb_pembayaran.id_jenis = tb_jenistransaksi.id_jenis  WHERE tb_pembayaran.status = '1' AND tb_pembayaran.id_anggota='$id' ORDER BY tb_pembayaran.tanggal DESC ";
              } else if($one == 'Admin'){
              $sql = "SELECT tb_pembayaran.id_pembayaran,tb_anggota.nama, tb_pembayaran.tanggal, tb_jenistransaksi.jenis, tb_pembayaran.nominal, tb_pembayaran.status FROM `tb_pembayaran`JOIN `tb_anggota` ON tb_pembayaran.id_anggota = tb_anggota.id_anggota JOIN tb_jenistransaksi ON tb_pembayaran.id_jenis = tb_jenistransaksi.id_jenis  WHERE tb_pembayaran.status = '0' ORDER BY tb_pembayaran.tanggal DESC";
             }
            } 
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
              <?php 
                if($r[status]=='0'){
                  ?>
                       <td><a href="index.php?sidebar-menu=detail&action=tampil&id=<?php echo $id ?>" class="btn btn-danger btn-xs"> <span> BELUM </span></a> <input type="button" name="delete" id="<?php echo $r["id_pembayaran"]; ?>" class="btn btn-default btn-xs delete_data" value="HAPUS"></td>
                  <?php 
                } else if($r[status]=='2'){
                  ?>
                       <td><a href="index.php?sidebar-menu=detail&action=tampil&id=<?php echo $id ?>" class="btn btn-success btn-xs"> <span> SUDAH </span></a> <input type="button" name="delete" id="<?php echo $r["id_pembayaran"]; ?>" class="btn btn-default btn-xs delete_data" value="HAPUS"></td>
                  <?php 
                } else if($r[status]=='1'){
                  ?>
                       <td><a href="index.php?sidebar-menu=detail&action=tampil&id=<?php echo $id ?>" class="btn btn-warning btn-xs"> <span> MENUNGGU </span></a> <input type="button" name="delete" id="<?php echo $r["id_pembayaran"]; ?>" class="btn btn-default btn-xs delete_data" value="HAPUS"></td> 
                <?php
                }
              ?>
            </tr>

              <?php
                $no++;
              }
            ?>
      </tbody>
  </table>
  <br>
  </div>
    <form action="pages/proses_convert-csv.php" method="POST">
      <input type="submit" class="btn btn-primary pull-right" value="Convert To CSV" name="submit_csv-pembayaran">  
  </form>
</body>

<div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Detail Pembayaran</h4>  
                </div>  
                <div class="modal-body" id="pembayaran_detail">  
                </div>  
                <div class="modal-footer">    
                     <a href="pages/proses_delete-pembayaran.php" class="btn btn-danger">HAPUS DATA</a> 
                     <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>  
                </div>  
           </div>  
      </div>  
 </div>

  <!-- jQuery 3 -->
  <script src="bower_components/jquery/dist/jquery.min.js"></script>

  <script type="text/javascript">
  $(document).ready(function(){  
          $(".delete_data").click(function(){    
    var id_pembayaran = $(this).attr("id");
   
                $.ajax({  
                url:"pages/fetch_data_pembayaran.php",  
                method:"post",  
                data:{id_pembayaran:id_pembayaran},  
                success:function(data){
                 $('#pembayaran_detail').html(data);           
                 $('#dataModal').modal("show");  
             }
          });  
       });     
    });

</script>
  
</html>