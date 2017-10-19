<?php
   if (!defined('DIDALAM_INDEX_PHP')){ 
    //echo "Dilarang broh!";
        header("Location: ../../index.php?sidebar-menu=home&action=tampil");
    }
?>
      <!-- jQuery 3 -->
  <script src="bower_components/jquery/dist/jquery.min.js"></script>
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
                         <td> <a href="#" id="<?php echo $row["id"] ?>" class="btn btn-info btn-xs detail_kehadiran"> DETAIL </a></td>
                         <?php
                              } else {
                         ?>
                          <td> <a href="#" id="<?php echo $row["id"] ?>" class="btn btn-info btn-xs detail_kehadiran"> DETAIL </a><a href="#" id="<?php echo $row["id"]; ?>" class="btn btn-warning btn-xs edit_absen">EDIT</a> </td>    
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
<script>
// Fetch Detail Data Absen
     $(document).ready(function(){  
      $('.detail_kehadiran').click(function(){  
         var id = $(this).attr("id");
          $.ajax({  
                url:"pages/fetchdata/fetch_data_absen.php",  
                method:"post",  
                data:{id:id},  
                success:function(data){
                 $('#detail_kehadiran').html(data);           
                 $('#dataModal').modal("show");
                 $('#dataModal').on('shown.bs.modal', function() {
                    var lat = parseFloat($('#latDetailAbsen').text());
                     var lng = parseFloat($('#lngDetailAbsen').text());
                     //console.log(lat);
                     //console.log(lng);
                     console.log("Center");
                     google.maps.event.addDomListener(window, 'load', initMap(lat,lng));
                     google.maps.event.addDomListener(window, "resize", function() {
                      var waktu = $('#waktuDetailAbsen').text();
                          var nama = $('#namaDetailAbsen').text();
                          var status = $('#statusDetailAbsen').text();
                          //var myLatLng = {lat: lat1,lng: lng1};
                          console.log("Inisiasi Map");
                          var myLatLng = new google.maps.LatLng(lat,lng);
                          var map = new google.maps.Map(document.getElementById('peta'), {
                            zoom: 18,
                            center: myLatLng,
                            mapTypeId: google.maps.MapTypeId.ROADMAP
                          });
                          console.log("Buat marker");
                          var marker = new google.maps.Marker({
                            position: myLatLng,
                            map: map,
                            title: 'Lokasi '+nama+' pada '+waktu+' saat '+status
                          });
                          var center = map.getCenter();
                          google.maps.event.trigger(map, "resize");
                          map.setCenter(center);
                      });
                     //google.maps.event.trigger(map, 'resize');
                     //Foto Di klik
                    $('.pop').on('click', function() {
                        $('.imagepreview').attr('src', $(this).attr('src'));
                        $('#imagemodal').modal('show');   
                    }); 
                })
             }
         });
      });
      
        
    });
    //Edit Absen
    $(document).on('click', '.edit_absen', function(){ 
    var id_absen = $(this).attr("id");   
              $.ajax({  
                  url:"pages/fetchdata/fetch_data_absen-json.php",  
                  method:"POST",  
                  data:{id:id_absen},  
                  dataType:"json",  
                  success:function(data){ 
                      $('#id_absen').val(data.id);
                      $('#id_anggota_absen').val(data.id_anggota);
                      $('#status_id_adminEdit').val(data.status_id); 
                      $('#keterangan_absen').val(data.keterangan);
                      $('#tglRentangAbsenAdmin').val(data.tglawal+" - "+data.tglakhir);  
                      $('#insert').val("Update");  
                      $('#editAbsen_Modal').modal('show');
                      $('#editAbsen_Modal').on('shown.bs.modal', function() {
                        //console.log("status"+data.status_id);
                        var value = parseInt(data.status_id);
                        gantiWarnaStatusAbsenSelect(value);
                      });  
                  }  
            });
        });    
    //Buat Map
    function initMap(lat1,lng1) {
        var waktu = $('#waktuDetailAbsen').text();
        var nama = $('#namaDetailAbsen').text();
        var status = $('#statusDetailAbsen').text();
        //var myLatLng = {lat: lat1,lng: lng1};
        console.log("Inisiasi Map");
        var myLatLng = new google.maps.LatLng(lat1,lng1);
        var map = new google.maps.Map(document.getElementById('peta'), {
          zoom: 18,
          center: myLatLng,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        console.log("Buat marker");
        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: 'Lokasi '+nama+' pada '+waktu+' saat '+status
        });
        //Resize Function
        
        google.maps.event.addDomListener(window, "resize", function() {
            var center = map.getCenter();
            google.maps.event.trigger(map, "resize");
            map.setCenter(center);
        });
          console.log("Responsive Center");
      }
      //Proses Pembuatan Map end
      //Ganti Warna Select Status Absen
      function gantiWarnaStatusAbsenSelect(value){
        switch (value) {
          case 1:
            $("#status_id_adminEdit").attr("class","form-control btn-info");
            $("#keterangan_absen").prop('disabled', true);
            $("#insert").attr("class","btn btn-info");
            $("#keterangan_absen").val("");
            break;
          case 2:
            $("#status_id_adminEdit").attr("class","form-control btn-primary");
            $("#insert").attr("class","btn btn-primary");
            $("#keterangan_absen").prop('disabled', false);
          break;
          case 3:
            $("#status_id_adminEdit").attr("class","form-control btn-danger");
            $("#keterangan_absen").prop('disabled', false);
            $("#insert").attr("class","btn btn-danger");
          break;
          case 4:
            $("#status_id_adminEdit").attr("class","form-control btn-warning");
            $("#keterangan_absen").prop('disabled', false);
            $("#insert").attr("class","btn btn-warning");
          break;
          case 5:
            $("#status_id_adminEdit").attr("class","form-control btn-success");
            $("#keterangan_absen").prop('disabled', false);
            $("#insert").attr("class","btn btn-success");
          break;
          case 6:
            $("#status_id_adminEdit").attr("class","form-control btn-default");
            $("#keterangan_absen").prop('disabled', false);
            $("#insert").attr("class","btn btn-default");
          break;
        }
      }
      $("#status_id_adminEdit").change(function(){
        var value = parseInt($(this).val());
        gantiWarnaStatusAbsenSelect(value);
    }); 
</script>