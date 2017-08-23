<!DOCTYPE html>
<html>
<?php
 error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
 session_start();
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

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>

<section class="content-header">
  <h2>DAFTAR ANGGOTA TIM KAKATU</h2>   
</section>  
<hr>
<br>
<br>
<div>
<br>
<a href="index.php?sidebar-menu=form_anggota&action=tampil" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>TAMBAH DATA ANGGOTA</a> 
  <table class="table" id="example1">
    <thead>
      <tr align="center">
        <th>Id Anggota</th>
        <th>Nama Anggota</th>
        <th>Jabatan</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
            <?php

           $sql = "SELECT tb_anggota.id_anggota, tb_anggota.nama, GROUP_CONCAT(tb_jabatan.jabatan SEPARATOR ', ') as 'jabatan', tb_anggota.email, tb_anggota.jenis_kelamin FROM `tb_anggota` JOIN jabatan_anggota ON tb_anggota.id_anggota = jabatan_anggota.id_anggota JOIN tb_jabatan ON tb_jabatan.id_jabatan = jabatan_anggota.id_jabatan GROUP BY tb_anggota.id_anggota";

           $result = mysqli_query($koneksi,$sql);
           
           $idanggota = $_SESSION['id_anggota'];

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
              <?php 

                if($idanggota == $r["id_anggota"]){

              ?>        
              <td> <center><input type="button" name="view" value="DETAIL" id="<?php echo $r["id_anggota"]; ?>" class="btn btn-info btn-xs view_data" /><input type="button" name="delete" id="<?php echo $r["id_anggota"]; ?>" class="btn btn-danger btn-xs delete_data" value="HAPUS" disabled><center></td>
              <?php
              } else {
                ?>
                <td> <center><input type="button" name="view" value="DETAIL" id="<?php echo $r["id_anggota"]; ?>" class="btn btn-info btn-xs view_data" /><input type="button" name="delete" id="<?php echo $r["id_anggota"]; ?>" class="btn btn-danger btn-xs delete_data" value="HAPUS"><center></td>
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
   <form action="pages/proses_convert-csv.php" method="POST">
      <input type="submit" class="btn btn-primary pull-right" value="Convert To CSV" name="submit_csv-anggota">  
  </form>
</div>
</body>

         <div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Detail Anggota</h4>  
                </div>  
                <div class="modal-body" id="employee_detail">  
                </div>  
                <div class="modal-footer">    
                     <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>  
                </div>  
           </div>  
      </div>  
 </div>  

  <div id="dataModal_hapus" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Detail Anggota</h4>  
                </div>  
                <div class="modal-body" id="employee">  
                </div>  
                <div class="modal-footer">  
                     <a href="pages/proses_delete-anggota.php" class="btn btn-danger">HAPUS DATA</a>    
                     <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>  
                </div>  
           </div>  
      </div>  
 </div>  


      <script>
     $(document).ready(function(){  
      $('.view_data').click(function(){  
         var id_anggota = $(this).attr("id");
          $.ajax({  
                url:"pages/fetch_data_anggota.php",  
                method:"post",  
                data:{id_anggota:id_anggota},  
                success:function(data){
                 $('#employee_detail').html(data);           
                 $('#dataModal').modal("show");  
             }
         });
      });  

      $('.delete_data').click(function(){  
         var id_anggota = $(this).attr("id");
          $.ajax({  
                url:"pages/fetch_data_anggota-fordelete.php",  
                method:"post",  
                data:{id_anggota:id_anggota},  
                success:function(data){
                 $('#employee').html(data);           
                 $('#dataModal_hapus').modal("show");  
             }
         });
      });  
 });  
             
      </script>
</html>
