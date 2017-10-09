<html lang="en">
<head>
  <title>List Pembayaran</title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

<?php
 error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
?>

  <style>
    @import url('https://fonts.googleapis.com/css?family=Dosis');
  </style> 

</head>

<?php 

  include "../../con_db.php";

  $sql_data = "SELECT id_anggota, password, email FROM tb_anggota WHERE id_anggota = '$_SESSION[id_anggota]'";
  $query = mysqli_query($koneksi, $sql_data);

  $val_data = mysqli_fetch_assoc($query);

  $data_id = $val_data[id_anggota];
  $data_pass = $val_data[password];
  $data_email = $val_data[email];
?>

<div class="login-page" id="overlay">
<div class="login-box fadeInDown animated">
  <div class="login-logo" style="color: #ffffff; margin-top:100px;">
   <b><p> Anda harus mengganti password anda </p></b>
   <b><p> dan </p></b> 
   <b><p >Mengisi email anda terlebih dahulu ! </p></b>
      <a href="index.php?sidebar-menu=profile&action=tampil" class="btn btn-primary btn-lg" style="color: #ffffff;">Ganti Sekarang</a>
  </div>
  </div>
</div>

<script>
<?php
if($data_id == $data_pass && $_SESSION['jabatan'] != 'Admin' || $data_email == '-'){
?>
    document.getElementById("overlay").style.display = "block";
<?php
} else {
?>
    document.getElementById("overlay").style.display = "none";
<?php
}
?>
</script>


<body style="background-color: #f9f9f9">
 <div class="container">
<section class="content-header bounceInDown animated">
  <h2>LIST PEMBAYARAN OPERASIONAL KANTOR</h2>        
</section>  
<hr>
<section>
<a href="index.php?sidebar-menu=form_bayar&action=tampil" id="btntambah" class="btn btn-primary bounceInRight animated"><span class="glyphicon glyphicon-plus"></span>BAYAR OPERASIONAL</a>

<?php

if($_SESSION['jabatan'] == 'Admin'){
?>
    <script type="text/javascript">
          document.getElementById('btntambah').style.display="none";
    </script>
<?php
} else {
?>
     <script type="text/javascript">
          document.getElementById('btntambah').style.visibility="visible";
    </script>
<?php
}
?>

<br>
<br>
            <div class="form-group flipInX animated">
            <label> FILTER STATUS </label>
              <form method="POST" action="index.php?sidebar-menu=list_bayar&action=tampil"> 
                 <div class="input-group"> 
                  <a href="index.php?sidebar-menu=list_bayar&action=tampil" class="btn btn-default btn-xs">VIEW ALL</a>              
                      <input type="submit" name="status_belum" value="BELUM" class="btn btn-danger btn-xs" style="margin-left: 3px;">
                      <input type="submit" name="status_sudah" value="SUDAH" class="btn btn-success btn-xs" style="margin-left: 3px;">
                      <input type="submit" name="status_menunggu" value="MENUNGGU" class="btn btn-warning btn-xs" style="margin-left: 3px;">
                 </div>
            </div>
            </form>         
            <div class="form-group flipInX animated">
            <label> FILTER TANGGAL </label>
              <form method="POST" action="index.php?sidebar-menu=list_bayar&action=tampil">
                  <div class="input-group"> 
                    <input type="text" class="form-control" id="start_date" name="start_date" style="width: 100px;" placeholder="Dari"> 
                    <input type="text" class="form-control" id="end_date" name="end_date" style="width: 100px; margin-left: 3px;" placeholder="Sampai">
                    <input type="submit" name="submit" value="APPLY" class="btn btn-info" style="margin-left: 3px;">
                  </div>
            </div>
            </form>
            

</section>
  <hr>
 </div>
  <div class="fadeIn animated">
  <table class="table" style="font-size: 13px;" id="example">
    <thead>
      <tr>
        <th style="width: 4%;  font-size: 12px;"> Tanggal </th>
        <th style="width: 10%; font-size: 12px;">Nama</th>
        <th style="width: 3%; font-size: 12px;"> ID </th>
        <th style="width: 14%; font-size: 12px;">Jenis</th>
        <th style="width: 10%;  font-size: 12px;">Status</th>
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

         $kliknotif = $_GET['status'];

            if ($kliknotif == 'notif'){
              
              if($_SESSION['jabatan'] != 'Admin'){
              $sql = "SELECT tb_pembayaran.id_pembayaran,tb_anggota.nama, tb_pembayaran.tanggal, tb_jenistransaksi.jenis, tb_pembayaran.nominal, tb_pembayaran.status FROM `tb_pembayaran`JOIN `tb_anggota` ON tb_pembayaran.id_anggota = tb_anggota.id_anggota JOIN tb_jenistransaksi ON tb_pembayaran.id_jenis = tb_jenistransaksi.id_jenis  WHERE tb_pembayaran.status = '1' AND tb_pembayaran.id_anggota='$id' ORDER BY tb_pembayaran.tanggal DESC";
                $result = mysqli_query($koneksi,$sql);
              } else if($_SESSION['jabatan'] == 'Admin'){
              $sql = "SELECT tb_pembayaran.id_pembayaran,tb_anggota.nama, tb_pembayaran.tanggal, tb_jenistransaksi.jenis, tb_pembayaran.nominal, tb_pembayaran.status FROM `tb_pembayaran`JOIN `tb_anggota` ON tb_pembayaran.id_anggota = tb_anggota.id_anggota JOIN tb_jenistransaksi ON tb_pembayaran.id_jenis = tb_jenistransaksi.id_jenis  WHERE tb_pembayaran.status = '0' ORDER BY tb_pembayaran.tanggal DESC";
                 $result = mysqli_query($koneksi,$sql);
             }
            }      


       if($one == 'Admin'){
       if(isset($_POST['submit'])){
        $startdate = $_POST['start_date'];
        $enddate = $_POST['end_date'];
        $sql = "SELECT tb_pembayaran.id_pembayaran, tb_anggota.nama, tb_pembayaran.id_anggota, tb_pembayaran.tanggal, tb_pembayaran.nominal, tb_pembayaran.keterangan, tb_pembayaran.status FROM tb_pembayaran JOIN tb_anggota ON tb_pembayaran.id_anggota=tb_anggota.id_anggota WHERE DATE(tb_pembayaran.tanggal) BETWEEN STR_TO_DATE('$startdate', '%m/%d/%Y') AND STR_TO_DATE('$enddate', '%m/%d/%Y')";

          $result = mysqli_query($koneksi,$sql);

        } else if(isset($_POST['status_sudah'])){
            $sql = "SELECT tb_pembayaran.id_pembayaran, tb_anggota.nama, tb_pembayaran.tanggal, tb_jenistransaksi.jenis, tb_pembayaran.nominal, tb_pembayaran.status FROM `tb_pembayaran`JOIN `tb_anggota` ON tb_pembayaran.id_anggota = tb_anggota.id_anggota JOIN tb_jenistransaksi ON tb_pembayaran.id_jenis = tb_jenistransaksi.id_jenis WHERE tb_pembayaran.status='2' ORDER BY tb_pembayaran.tanggal DESC";

          $result = mysqli_query($koneksi,$sql);

        } else if(isset($_POST['status_belum'])){
          $sql = "SELECT tb_pembayaran.id_pembayaran, tb_anggota.nama, tb_pembayaran.tanggal, tb_jenistransaksi.jenis, tb_pembayaran.nominal, tb_pembayaran.status FROM `tb_pembayaran`JOIN `tb_anggota` ON tb_pembayaran.id_anggota = tb_anggota.id_anggota JOIN tb_jenistransaksi ON tb_pembayaran.id_jenis = tb_jenistransaksi.id_jenis WHERE tb_pembayaran.status='0' ORDER BY tb_pembayaran.tanggal DESC";

          $result = mysqli_query($koneksi,$sql);
        } else if(isset($_POST['status_menunggu'])) {
            $sql = "SELECT tb_pembayaran.id_pembayaran,tb_anggota.nama, tb_pembayaran.tanggal, tb_jenistransaksi.jenis, tb_pembayaran.nominal, tb_pembayaran.status FROM `tb_pembayaran`JOIN `tb_anggota` ON tb_pembayaran.id_anggota = tb_anggota.id_anggota JOIN tb_jenistransaksi ON tb_pembayaran.id_jenis = tb_jenistransaksi.id_jenis WHERE tb_pembayaran.status='1' ORDER BY tb_pembayaran.tanggal DESC";

          $result = mysqli_query($koneksi,$sql);
            if (!$result) {
              printf("Error: %s\n", mysqli_error($koneksi));
              exit();
              } 
        }

        } else if($one != 'Admin'){
          
           if(isset($_POST['submit'])){
        $sql = "SELECT tb_pembayaran.id_pembayaran, tb_anggota.nama, tb_jenistransaksi.jenis, tb_pembayaran.id_anggota, tb_pembayaran.tanggal, tb_pembayaran.nominal, tb_pembayaran.keterangan, tb_pembayaran.status FROM tb_pembayaran JOIN tb_anggota ON tb_pembayaran.id_anggota=tb_anggota.id_anggota JOIN tb_jenistransaksi ON tb_pembayaran.id_jenis = tb_jenistransaksi.id_jenis WHERE tb_pembayaran.tanggal >= '$startdate' AND tb_pembayaran.tanggal <= '$enddate' AND tb_anggota.id_anggota='$id' ORDER BY tb_pembayaran.tanggal DESC";

          $result = mysqli_query($koneksi,$sql);
            if (!$result) {
              printf("Error: %s\n", mysqli_error($koneksi));
              exit();
              } 

        } else if(isset($_POST['status_sudah'])){
            $sql = "SELECT tb_pembayaran.id_pembayaran, tb_anggota.nama, tb_pembayaran.tanggal, tb_jenistransaksi.jenis, tb_pembayaran.nominal, tb_pembayaran.status FROM `tb_pembayaran`JOIN `tb_anggota` ON tb_pembayaran.id_anggota = tb_anggota.id_anggota JOIN tb_jenistransaksi ON tb_pembayaran.id_jenis = tb_jenistransaksi.id_jenis WHERE tb_pembayaran.status='2' AND tb_anggota.id_anggota='$id' ORDER BY tb_pembayaran.tanggal DESC";

          $result = mysqli_query($koneksi,$sql);
            if (!$result) {
              printf("Error: %s\n", mysqli_error($koneksi));
              exit();
              } 

        } else if(isset($_POST['status_belum'])){
          $sql = "SELECT tb_pembayaran.id_pembayaran, tb_anggota.nama, tb_pembayaran.tanggal, tb_jenistransaksi.jenis, tb_pembayaran.nominal, tb_pembayaran.status FROM `tb_pembayaran`JOIN `tb_anggota` ON tb_pembayaran.id_anggota = tb_anggota.id_anggota JOIN tb_jenistransaksi ON tb_pembayaran.id_jenis = tb_jenistransaksi.id_jenis WHERE tb_pembayaran.status='0' AND tb_anggota.id_anggota='$id' ORDER BY tb_pembayaran.tanggal DESC";

          $result = mysqli_query($koneksi,$sql);
            if (!$result) {
              printf("Error: %s\n", mysqli_error($koneksi));
              exit();
              } 

        } else if(isset($_POST['status_menunggu'])) {
            $sql = "SELECT tb_pembayaran.id_pembayaran,tb_anggota.nama, tb_pembayaran.tanggal, tb_jenistransaksi.jenis, tb_pembayaran.nominal, tb_pembayaran.status FROM `tb_pembayaran`JOIN `tb_anggota` ON tb_pembayaran.id_anggota = tb_anggota.id_anggota JOIN tb_jenistransaksi ON tb_pembayaran.id_jenis = tb_jenistransaksi.id_jenis WHERE tb_pembayaran.status='1' AND tb_anggota.id_anggota='$id' ORDER BY tb_pembayaran.tanggal DESC";

          $result = mysqli_query($koneksi,$sql);
            if (!$result) {
              printf("Error: %s\n", mysqli_error($koneksi));
              exit();
              } 
        }

        } 
           $no = 1;
            while($r = mysqli_fetch_array($result))
            {
                $id = $r[id_pembayaran];
                $tgl_new_format = date("Y-m-d" , strtotime($r[tanggal]));
            ?>
            <tr>
              <td> <?php echo $tgl_new_format ?> </td>
              <td> <?php echo $r[nama] ?> </td>
              <td> <?php echo $id ?> </td>
              <td> <?php echo $r[jenis] ?> </td>         
              <?php 
                if($r[status]=='0'){
                  ?>
                       <td><a href="index.php?sidebar-menu=detail&action=tampil&id=<?php echo $id ?>" class="btn btn-danger btn-xs"> <span> BELUM </span></a> 
                       <?php if ($one == 'Admin'){?>
                       <input type="button" name="delete" id="<?php echo $r["id_pembayaran"]; ?>" class="btn btn-default btn-xs delete_data" value="HAPUS" disabled>
                       <?php } else { ?>
                       <input type="button" name="delete" id="<?php echo $r["id_pembayaran"]; ?>" class="btn btn-default btn-xs delete_data" value="HAPUS">
                       <?php } ?>
                       </td>
                  <?php 
                } else if($r[status]=='2'){
                  ?>
                       <td><a href="index.php?sidebar-menu=detail&action=tampil&id=<?php echo $id ?>" class="btn btn-success btn-xs"> <span> SUDAH </span></a></td>
                  <?php 
                } else if($r[status]=='1'){
                  ?>
                       <td><a href="index.php?sidebar-menu=detail&action=tampil&id=<?php echo $id ?>" class="btn btn-warning btn-xs"> MENUNGGU </a></td> 
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
  <div>
  <form id='btn_convert' action="pages/proses/proses_convert-csv.php" method="POST">
      <input type="submit" class="btn btn-primary pull-right" value="Convert To CSV" name="submit_csv-pembayaran">  
  </form>
  </div>
</body>

<?php 

                if($one == "Admin"){
                  ?>
                  <script type="text/javascript">
                          document.getElementById('btn_convert').style.display="block";
                      </script>
                  <?php
                } else 

                if($one != "Admin") {
                  ?>
                  <script type="text/javascript">
                          document.getElementById('btn_convert').style.display="none";
                      </script>
                  <?php
                }
              ?>


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
                     <a href="pages/proses/proses_delete-pembayaran.php" class="btn btn-danger">HAPUS DATA</a> 
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
                url:"pages/fetchdata/fetch_data_pembayaran.php",  
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