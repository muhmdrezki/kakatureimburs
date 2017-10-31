<?php
   if (!defined('DIDALAM_INDEX_PHP')){ 
    //echo "Dilarang broh!";
        header("Location: ../../index.php?sidebar-menu=home&action=tampil");
    }
?>

<section id="form_data-absen-admin" style="margin: 0 auto;">

<div class="container fadeIn animated">
  
  <h2> DATA ABSENSI </h2>
<hr style="  
    border: 0;
    height: 1px;
    background: #333;
    background-image: linear-gradient(to right, #ccc, #333, #ccc);"
    >
</div>
<div class="container bounceInLeft animated">
  <div class="row">  
        <?php 
           $query = "SELECT d.id, d.id_anggota, a.nama, d.tanggal, d.jam_masuk, b.status, d.keterangan FROM tb_detail_absen d JOIN tb_absen b ON d.status_id=b.status_id JOIN tb_anggota a ON d.id_anggota = a.id_anggota ORDER BY d.tanggal DESC" ; 
           $result = mysqli_query($koneksi, $query);  
        ?>
            <div class="table-responsive">  
               <table class="table table-bordered table-hover" id="data_absen_admin">
               <thead>
                  <tr>  
                         <th> Waktu Submit </th>   
                         <th> Nama </th> 
                         <th> Status</th>
                         <th> Action </th>
                  </tr>
               </thead>
               <tbody>
                 <?php  
                  $no = 1;
                      while($row = mysqli_fetch_array($result)) {  
               ?>
                    <tr>  
                         <td id="waktuDetailAbsen"> <?php echo $row['tanggal']." ".$row['jam_masuk'] ?> </td>    
                         <td id="namaDetailAbsen"> <?php echo $row['nama'] ?> </td>
                         <?php 
                         $status = $row['status'];
                         if($status == "Sakit"){
                          $ket = "<span class=\"label label-danger\">SAKIT</span>";
                         } else if($status == "Izin"){
                          $ket = "<span class=\"label label-warning\">IZIN</span>";
                         } else if($status == "Hadir Diluar"){
                          $ket = "<span class=\"label label-primary\">HADIR DILUAR</span>";
                         } else if($status == "Hadir"){
                            $ket = "<span class=\"label label-info\">HADIR</span>";
                          } else if($status == "Cuti"){
                            $ket = "<span class=\"label label-success\">CUTI</span>";
                          } else if($status == "Alpha"){
                            $ket = "<span class=\"label label-default\">Alpha</span>";
                          }

                         ?>
                         <td id="statusDetailAbsen"> <?php echo $ket ?> </td>
                         <?php
                              //Edit Admin hanya bisa untuk current month
                              $blnskrg = new DateTime();
                              $blnskrg->setTimezone(new DateTimeZone('Asia/Jakarta'));
                              $blnskrgformat= $blnskrg->format('Ym');
                              $blndata= new DateTime($row["tanggal"]);
                              $blndataformat=$blndata->format('Ym');
                              $disabled="";
                              if (intval($blndataformat)<intval($blnskrgformat)) {
                                  if ( $status!="Alpha") {
                         ?>
                         <td> <a href="#" id="<?php echo $row["id"] ?>" class="btn btn-info btn-xs detail_kehadiran"> DETAIL </a></td>
                         <?php
                                  }
                              } else {
                                if ( $status!="Alpha") {
                         ?>
                          <td> <a href="#" id="<?php echo $row["id"] ?>" class="btn btn-info btn-xs detail_kehadiran"> DETAIL </a><a href="#" id="<?php echo $row["id"]; ?>" class="btn btn-warning btn-xs edit_absen">EDIT</a> </td>    
                          <?php 
                                } else {
                          ?>
                           <td> <a href="#" id="<?php echo $row["id"] ?>" class="btn btn-info btn-xs detail_kehadiran disabled" disabled > DETAIL </a><a href="#" id="<?php echo $row["id"]; ?>" class="btn btn-warning btn-xs edit_absen">EDIT</a> </td>
                        <?php
                                } 
                         } 
                         ?>
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

 <div id="dataModal" class="modal fade" style="overflow: auto !important;">  
      <div class="modal-dialog modal-lg">  
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
 <!--Modal Preview Gambar -->
 <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="min-height: 100%;height: auto;border-radius: 0;background: transparent;">              
      <div class="modal-body">
      	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <img src="" class="imagepreview" style="width: 100%;" >
      </div>
    </div>
  </div>
</div>  
  <!--Modal Edit Absen -->
  <div id="editAbsen_Modal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">EDIT DATA ABSEN</h4>  
                </div>  
                <div class="modal-body">  
                     <form method="post" action="pages/proses/proses_edit-absen-admin.php">  
                          <label>ID Absen</label>
                          <input type="text" name="id_absen" id="id_absen" class="form-control" readonly />
                          <label>ID Anggota</label>
                          <input type="text" name="id_anggota_absen" id="id_anggota_absen" class="form-control" readonly />   
                          <br />
                          <select class="form-control" id="status_id_adminEdit" name="status_id">
                          <?php 
                              $sql = "SELECT * FROM tb_absen";
                              $result = mysqli_query($koneksi, $sql);
                              while ($row_status_absen = mysqli_fetch_array($result)) {
                          ?>
                            <option style="background-color:<?php echo $row_status_absen['warna']?>;color:white;font-weight:bold" value="<?php echo $row_status_absen['status_id']?>"><?php echo $row_status_absen['status']?></option>
                          <?php
                              }
                          ?> 
                          </select>
                          <label>Alasan/Keterangan</label>
                          <textarea  class="form-control" rows="3" id="keterangan_absen" name="keterangan_absen" placeholder="Isi Keterangan"></textarea>
                          <!-- Date -->
                          <div class="form-group">
                            <label>Date:</label>
                            <div class="input-group date">
                              <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                              </div>
                              <!-- Bukan untuk cuti -->
                              <input type="text" class="form-control pull-right tglRentang" id="tglRentangAbsenAdmin" name="tglRentangAbsenAdmin">
                            </div>
                            <!-- /.input group -->
                          </div>
                        <!-- /.form group -->                    
                </div>  
                <div class="modal-footer"> 
                     <input type="submit" name="submit" id="insert" value="Update" class="btn btn-success" /> 
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </form>      
                </div>  
           </div>  
      </div>  
 </div>    
