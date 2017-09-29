      <?php 
        $id_jabatan = mt_rand(100,999);
      ?>

      <!-- jQuery 3 -->
  <script src="bower_components/jquery/dist/jquery.min.js"></script>

<section id="form_jabatan-jenis" style="margin: 0 auto;">

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
           $query = "SELECT d.id, d.id_anggota, a.nama, CONCAT(d.tanggal,' ',d.jam_masuk) AS waktu, b.status, d.keterangan FROM tb_detail_absen d JOIN tb_absen b ON d.status_id=b.status_id JOIN tb_anggota a ON d.id_anggota = a.id_anggota WHERE d.id_anggota='".$_SESSION["id_anggota"]."' ORDER BY waktu DESC"; 
           $result = mysqli_query($koneksi, $query);  
        ?>
        <div class="table-responsive">  
        <table class="table" id="data_absen">
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
                  <td id="waktuDetailAbsen"> <?php echo $row['waktu']?> </td>    
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
                    if ($no!=1) {
                  ?>
                  <td> <a href="#" id="<?php echo $row["id"] ?>" class="btn btn-info btn-xs detail_kehadiran"> DETAIL </a></td>
                  <?php
                    } else {
                  ?>
                  <td> <a href="#" id="<?php echo $row["id"] ?>" class="btn btn-info btn-xs detail_kehadiran"> DETAIL </a><a href="#" id="<?php echo $row["id"]; ?>" class="btn btn-warning btn-xs edit_jabatan">EDIT</a></td>
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

<script>
//Proses Pembuatan Map

//Image Preview Aja

 

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
             $('.pop').on('click', function() {
                 $('.imagepreview').attr('src', $(this).attr('src'));
                 $('#imagemodal').modal('show');   
             }); 
         })
      }
  });
});
//Foto Di klik
 
});

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
</script>