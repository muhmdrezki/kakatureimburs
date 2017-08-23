      <?php 
        $id_jabatan = mt_rand(100,999);
      ?>

      <!-- jQuery 3 -->
  <script src="bower_components/jquery/dist/jquery.min.js"></script>

<section id="form_jabatan-jenis" style="margin: 0 auto;">

<?php 
    $tgl_now = date("d-m-Y"); 
    $day = date('j', strtotime($tgl_now));
?>

<div class="container">
<div class="content-header">
        <b><h3> DAFTAR HADIR </h3></b>
</div>
  <div class="row">        
        <?php 
           $query = "SELECT tb_absen.id, tb_absen.id_anggota, tb_anggota.nama, tb_absen.tanggal, tb_absen.jam_masuk, tb_absen.jam_keluar, tb_absen.keterangan FROM tb_absen JOIN tb_anggota ON tb_absen.id_anggota = tb_anggota.id_anggota WHERE DAY(tb_absen.tanggal) = '$day' AND tb_absen.keterangan = 'hadir'";  
           $result = mysqli_query($koneksi, $query);  
        ?>
            <div class="table-responsive">  
               <table class="table table-hover" id="example">
               <thead>
                  <tr>  
                         <th> Tanggal </th>  
                         <th> ID Anggota </th> 
                         <th> Nama </th> 
                         <th> Keterangan </th>
                         <th> Action </th>
                  </tr>
               </thead>
               <tbody>
                 <?php  
                  $no = 1;
                      while($row = mysqli_fetch_array($result)) {  
               ?>
                    <tr>  
                         <td> <?php echo $row[tanggal] ?> </td>  
                         <td> <?php echo $row[id_anggota] ?> </td>  
                         <td> <?php echo $row[nama] ?> </td>
                         <?php 
                         $keterangan = $row[keterangan];
                         if($keterangan == "sakit"){
                          $ket = "SAKIT";
                         } else if($keterangan == "hadir"){
                          $ket = "HADIR";
                         } else if($keterangan == "izin"){
                          $ket = "IZIN";
                         }

                         ?>
                         <td> <?php echo $ket ?> </td>
                         <td> <a href="#" id="<?php echo $row[id] ?>" class="btn btn-info btn-xs detail_kehadiran"> DETAIL </a> </td>
                    </tr>
              <?php 
                  $no++;
                  } 
               ?>
               </tbody>
               </table>
            </div>
        </div>
</div> 
</section>

 <div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Detail Kehadiran</h4>  
                </div>  
                <div class="modal-body" id="detail_kehadiran">  
                </div>  
                <div class="modal-footer">    
                     <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>  
                </div>  
           </div>  
      </div>  
 </div>  


<script>
     $(document).ready(function(){  
      $('.detail_kehadiran').click(function(){  
         var id = $(this).attr("id");
          $.ajax({  
                url:"pages/fetch_data_absen.php",  
                method:"post",  
                data:{id:id},  
                success:function(data){
                 $('#detail_kehadiran').html(data);           
                 $('#dataModal').modal("show");  
             }
         });
      });  
 });  
</script>