<?php
   if (!defined('DIDALAM_INDEX_PHP')){ 
    //echo "Dilarang broh!";
        header("Location: ../../home");
    }
    if ($_SESSION['jabatan']!="Admin") {
      echo '<script>alert("Maaf, Anda bukan Admin"); window.location="home"</script>';
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
	<div class="row">
                  <div class="col col-xs-6 flipInX animated">
                  <div class="form-group flipInX animated">
					<label> FILTER TANGGAL </label>
					  <form method="POST" action="tampil/data-absensi-admin">
						  <div class="input-group"> 
							<input type="text" class="form-control" id="start_date" name="start_date" style="width: 100px;" placeholder="Dari"> 
							<input type="text" class="form-control" id="end_date" name="end_date" style="width: 100px; margin-left: 3px;" placeholder="Sampai">
							<input type="submit" name="submit_tanggal" value="Apply" class="btn btn-info" style="margin-left: 3px;">
						
						  </div>
					  </form>
					</div> 
                 </div>
  </div>
  <div class="form-group flipInX animated">
            <label> FILTER STATUS </label>
              <form method="POST" action="tampil/data-absensi-admin"> 
                <div class="input-group"> 
                      <a href="tampil//data-absensi-admin" class="btn btn-default btn-xs">VIEW ALL</a>              
                      <input type="submit" name="status_hadir" value="HADIR" class="btn btn-info btn-xs" style="margin-left: 3px;">
                      <input type="submit" name="status_hadir_diluar" value="HADIR DILUAR" class="btn btn-primary btn-xs" style="margin-left: 3px;">
                      <input type="submit" name="status_sakit" value="SAKIT" class="btn btn-danger btn-xs" style="margin-left: 3px;">
                      <input type="submit" name="status_izin" value="IZIN" class="btn btn-warning btn-xs" style="margin-left: 3px;">
                      <input type="submit" name="status_cuti" value="CUTI" class="btn btn-success btn-xs" style="margin-left: 3px;">
                      <input type="submit" name="status_alpha" value="ALPHA" class="btn btn-default btn-xs" style="margin-left: 3px;">
                </div>
			  </form>  
   </div>
        <?php
                if (isset($_POST["status_hadir"])) {
                  $query = "SELECT d.id, d.id_anggota, a.nama, d.tanggal, d.jam_masuk, b.status, d.keterangan FROM tb_detail_absen d JOIN tb_absen b ON d.status_id=b.status_id JOIN tb_anggota a ON d.id_anggota = a.id_anggota WHERE d.status_id=1 ORDER BY d.tanggal DESC" ;
                } else if (isset($_POST["status_hadir_diluar"])) {
                  $query = "SELECT d.id, d.id_anggota, a.nama, d.tanggal, d.jam_masuk, b.status, d.keterangan FROM tb_detail_absen d JOIN tb_absen b ON d.status_id=b.status_id JOIN tb_anggota a ON d.id_anggota = a.id_anggota WHERE d.status_id=2 ORDER BY d.tanggal DESC" ;
                } else if (isset($_POST["status_sakit"])) {
                  $query = "SELECT d.id, d.id_anggota, a.nama, d.tanggal, d.jam_masuk, b.status, d.keterangan FROM tb_detail_absen d JOIN tb_absen b ON d.status_id=b.status_id JOIN tb_anggota a ON d.id_anggota = a.id_anggota WHERE d.status_id=3 ORDER BY d.tanggal DESC" ;
                } else if (isset($_POST["status_izin"])) {
                  $query = "SELECT d.id, d.id_anggota, a.nama, d.tanggal, d.jam_masuk, b.status, d.keterangan FROM tb_detail_absen d JOIN tb_absen b ON d.status_id=b.status_id JOIN tb_anggota a ON d.id_anggota = a.id_anggota WHERE d.status_id=4 ORDER BY d.tanggal DESC" ;
                } else if (isset($_POST["status_cuti"])) {
                  $query = "SELECT d.id, d.id_anggota, a.nama, d.tanggal, d.jam_masuk, b.status, d.keterangan FROM tb_detail_absen d JOIN tb_absen b ON d.status_id=b.status_id JOIN tb_anggota a ON d.id_anggota = a.id_anggota WHERE d.status_id=5 ORDER BY d.tanggal DESC" ;
                }  else if (isset($_POST["status_alpha"])) {
                  $query = "SELECT d.id, d.id_anggota, a.nama, d.tanggal, d.jam_masuk, b.status, d.keterangan FROM tb_detail_absen d JOIN tb_absen b ON d.status_id=b.status_id JOIN tb_anggota a ON d.id_anggota = a.id_anggota WHERE d.status_id=6 ORDER BY d.tanggal DESC" ;
                } else if(isset($_POST["submit_tanggal"])){
					          //echo "<script>alert('asup')</script>";
                    $startdate = $_POST["start_date"];
					          //echo "<script>alert('$startdate')</script>";
                    $enddate = $_POST["end_date"];
                    $query = "SELECT d.id, d.id_anggota, a.nama, d.tanggal, d.jam_masuk, b.status, d.keterangan FROM tb_detail_absen d JOIN tb_absen b ON d.status_id=b.status_id JOIN tb_anggota a ON d.id_anggota = a.id_anggota WHERE DATE(d.tanggal) BETWEEN STR_TO_DATE('$startdate', '%m/%d/%Y') AND STR_TO_DATE('$enddate', '%m/%d/%Y') ORDER BY d.tanggal DESC" ;
                } else {
                  $query = "SELECT d.id, d.id_anggota, a.nama, d.tanggal, d.jam_masuk, b.status, d.keterangan FROM tb_detail_absen d JOIN tb_absen b ON d.status_id=b.status_id JOIN tb_anggota a ON d.id_anggota = a.id_anggota ORDER BY d.tanggal DESC" ;
                }
            
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
                         $status2 = $row['status'];
                         if($status2 == "Sakit"){
                            $ket = "<span class=\"label label-danger\">SAKIT</span>";
                          } else if($status2 == "Izin"){
                            $ket = "<span class=\"label label-warning\">IZIN</span>";
                          } else if($status2 == "Hadir Diluar"){
                            $ket = "<span class=\"label label-primary\">HADIR DILUAR</span>";
                          } else if($status2 == "Hadir"){
                            $ket = "<span class=\"label label-info\">HADIR</span>";
                          } else if($status2 == "Cuti"){
                            $ket = "<span class=\"label label-success\">CUTI</span>";
                          } else if($status2 == "Alpha"){
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
                         ?>
                         <td> <a id="<?php echo $row["id"] ?>" class="btn btn-info btn-xs detail_kehadiran"> DETAIL </a></td>
                         <?php
                              } else {
                         ?>
                          <td> <a id="<?php echo $row["id"] ?>" class="btn btn-info btn-xs detail_kehadiran"> DETAIL </a><a id="<?php echo $row["id"]; ?>" class="btn btn-warning btn-xs edit_absen">EDIT</a> </td>    
                         <?php } 
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
