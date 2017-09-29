<!DOCTYPE html>
<html lang='en'>
<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
?>
    <head>
      <!-- Tell the browser to be responsive to screen width -->
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <!-- Google Font -->
          <!-- jQuery 3 -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="dist\js\myjs\form_submit-absensi.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style type="text/css">    
        @media (max-width: 768px) {
        .btn-responsive {
            padding:4px 9px;
            font-size:90%;
            line-height: 1.2;
            
        }
        }

        @media (min-width: 769px) and (max-width: 992px) {
        .btn-responsive {
            padding:4px 9px;
            font-size:90%;
            line-height: 1.2;
        }
        }
    </style>
    </head>

    <?php
            include "../con_db.php";
            
          session_start();
          date_default_timezone_set('Asia/Jakarta');
        $tgl_now = date("d-m-Y");
          $day = date('j', strtotime($tgl_now));
          $month = date('F', strtotime($tgl_now));
          $year = date('Y', strtotime($tgl_now));
          $dayname = date('l', strtotime($tgl_now));
          $timenow = date("h:i:sa");
          $API_KEY='AIzaSyAn0sCC7HGqbJbWhwkgJnvyWFiTa7QGtVI';
    if ($dayname =="Monday") {
        $hari = "Senin";
    } elseif ($dayname == "Tuesday") {
        $hari = "Selasa";
    } elseif ($dayname == "Wednesday") {
        $hari = "Rabu";
    } elseif ($dayname == "Thursday") {
        $hari = "Kamis";
    } elseif ($dayname == "Friday") {
        $hari = "Jumat";
    } elseif ($dayname == "Saturday") {
        $hari = "Sabtu";
    } elseif ($dayname == "Sunday") {
        $hari = "Minggu";
    }
    
    ?>
    <body onLoad="getUserLocation()">
                <div>
                      <h2 align='center' >FORM ABSENSI</h2> 
                      <div class="form-group">
                      <table>
                        <tr>
                        <div class="modal fade" id="myModal_img" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                        <img src='' class="img-responsive" style="width: 100%;" />                              
                                </div>
                              </div>
                        </div>

                      <script>
                        
                            $(document).ready(function(){
                                $('.popupimage').click(function(event){
                                    event.preventDefault();
                                    $('#myModal_img img').attr('src', $(this).attr('href'));
                                    $('#myModal_img').modal('show');
                                });
                            });
                      </script>
                        </tr>
                    </table>    
                    <section class="content-header" >
                        <div class="container fadeInLeft animated" style="width: 80%;">
                            <form action="pages/proses/proses_submit-absensi.php" method="POST" onsubmit="checkStatusHadir()">
                            <div class="form-group">
                                <label for="id">ID Anggota </label>
                                <input type="text" class="form-control" id="id_anggota_absen" placeholder="Id Anggota" name="id_anggota_absen" value="<?php echo $_SESSION['id_anggota']; ?>" readonly>
                              </div>
                              <div class="form-group">
                                <label for="nama"> Nama </label>
                                <input type="text" class="form-control" id="nama_absen" placeholder="Nama" name="nama_absen" value="<?php echo $_SESSION['nama']; ?>" readonly>
                              </div>    
                            <div class="form-group">
                                        <label>Status</label>
                                        <select id="statushadir" class="form-control" data-placeholder="Pilih Status" name="status_absen" onchange="checkStatusHadir()"
                                                style="width: 100%; color: #212121;"
                                                data-validation="length" data-validation-length="min1" data-validation-error-msg="Wajib isi Status"
                                                >
                                                  <option id="hadir1" value="1"> Hadir </option>
                                                  <option value="2"> Hadir (Diluar) </option>
                                                  <option value="3"> Sakit </option>
                                                  <option value="4"> Izin </option>
                                        </select>
                            </div>
                            <div class="btn-group">
                                    <tr>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-lg">Hadir</button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-success btn-lg">Hadir(luar)</button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-lg">Sakit</button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-lg">Izin</button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-lg">Cuti</button>
                                        </td>
                                    </tr>
                            </div>
                              <div class="form-group">
                                <label for="keterangan"> Keterangan </label>
                                <textarea  class="form-control" rows="5" id="keterangan_absen" name="keterangan_absen" placeholder="Isi Keterangan" data-validation="" data-validation-error-msg=""></textarea>  
                                <span class="help-block"></span>
                              </div>
                              
                               <!-- Date dd/mm/yyyy -->
                               <div class="form-group">
                                <label for="tanggal"> Tanggal </label>
                                <div class="input-group">
                                          <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                          </div>
                                <input type="text" class="form-control" id="tanggal_absen" name="tanggal_absen" value="<?php echo $tgl_now; ?>" readonly>
                              </div>
                              <div class="form-group">
                                <label for="latitude"> Latitude </label>
                                <input 
                                type="text" class="form-control" id="latitude" placeholder="Mengharuskan Izin Lokasi" name="latitude"
                                data-validation="required" data-validation-error-msg="Lokasi Harus diizinkan!" value="<?php echo $latitude;?>" readonly
                                >
                              </div>
                              <div class="form-group">
                                <label for="longitude"> Longitude </label>
                                <input type="text" class="form-control" id="longitude" placeholder="Mengharuskan Izin Lokasi" name="longitude" data-validation="required" data-validation-error-msg="Lokasi Harus diizinkan!" value="<?php echo $longitude;?>" readonly>
                              </div>
                              <div class="form-group">  
                                <label for="address"> Lokasi Anda </label>
                                <input type="text" class="form-control" id="adress"  placeholder="Mengharuskan Izin Lokasi" name="adress" data-validation="required" data-validation-error-msg="Lokasi Harus diizinkan!" value="<?php echo $address;?>" readonly>
                              </div>
                              <div class="box-body">
                                <img class="img-responsive" id="img-location"  alt="Photo"/>
                              </div>

                        <!-- Trigger the modal with a button -->
                          <Button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal_pesan" onclick="formatPesan();getUserLocation()">KONFIRMASI</Button>
                    </div>
                    </section>  
                          <br><br>
                          <!-- Modal -->
                        <div class="modal fade" id="myModal_pesan" role="dialog">
                            <div class="modal-dialog">
                            
                              <!-- Modal content-->
                              <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title">Informasi Absensi dari : <?php echo $_SESSION['nama'] ?></h4>
                                    </div>
                                        <div class="modal-body">
                                            <p id="isiPesanWA">
                                                Date: <br><b id="waktuAbsen"><?php echo $hari;
                                                echo ",".$tgl_now." ".$timenow;?></b> <br>ID Anggota: <br><b id="idsaya"></b> <br>Nama: <br><b id="namasaya"></b> <br>Status: <br><b id="statussaya"></b> <br>Keterangan: <br><b id="ketsaya"></b> <br> Location: <br><b id="lokasi"></b>
                                            </p>
                                            <hr>
                                        <p> Wajib share absensi ke <b>Whatsapp</b> sebelum bisa submit</p>
                                        </div>
                                    <div class="modal-footer">
                                        <input type="submit" name="submit" value="Submit Absensi" class="btn btn-danger btn-sm">
                                        <a id="pesanWA" href="" class="btn btn-success btn-sm" data-action="share/whatsapp/share">SEND TO <i class="fa fa-whatsapp"></i></a>
                                      <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">CLOSE</button>
                                    </div>
                              </div>
                             
                            </div>
                        </div>
                        </form>
                        </div>
        </body>
        
        <?php
        
        function getAddress($latitude, $longitude)
        {
            if (!empty($latitude) && !empty($longitude)) {
                //Send request and receive json data by address
                $geocodeFromLatLong = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($latitude).','.trim($longitude).'&sensor=true&key='.trim($API_KEY));
                $output = json_decode($geocodeFromLatLong);
                $status = $output->status;
                //Get address from json data
                $address = ($status=="OK")?$output->results[0]->formatted_address:'';
                //Return address of the given latitude and longitude
                if (!empty($address)) {
                    return $address;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        ?>  
</html>
