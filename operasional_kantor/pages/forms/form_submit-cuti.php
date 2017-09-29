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
	  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
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
			if($dayname =="Monday"){
				$hari = "Senin";
				} else if($dayname == "Tuesday"){
				$hari = "Selasa";
				} else if ($dayname == "Wednesday"){
			      	$hari = "Rabu";
				} else if ($dayname == "Thursday"){
					$hari = "Kamis";
				} else if ($dayname == "Friday"){
					$hari = "Jumat";
				} else if($dayname == "Saturday"){
					$hari = "Sabtu";
				} else if($dayname == "Sunday"){
					$hari = "Minggu";
				}
	?>
	<body onLoad="getUserLocation()">
				<div>
					  <h2 align='center' >FORM CUTI</h2> 
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
								<label for="keterangan"> Keterangan </label>
								<textarea  class="form-control" rows="5" id="keterangan_absen" name="keterangan_absen" placeholder="Isi Keterangan" data-validation="" data-validation-error-msg=""></textarea>  
								<span class="help-block"></span>
							  </div>
							  
							   <!-- Date dd/mm/yyyy -->
							   <!-- Date range -->
								 <div class="form-group">
								 <label>Tanggal Cuti:</label>
 
								 <div class="input-group">
									 <div class="input-group-addon">
										 <i class="fa fa-calendar"></i>
									 </div>
									 <input type="text" class="form-control pull-right" id="reservation">
								 </div>
								 <!-- /.input group -->
							 </div>
							 <!-- /.form group -->
					    <!-- Trigger the modal with a button -->
						  <Button type="button" class="btn btn-primary " data-toggle="modal" data-target="#myModal_pesan" onclick="formatPesan();getUserLocation()">KONFIRMASI</Button>
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
							          <h4 class="modal-title">Informasi Cuti dari : <?php echo $_SESSION['nama'] ?></h4>
							        </div>
								        <div class="modal-body">
											<p id="isiPesanWA">
												Date: <br><b id="waktuAbsen"><?php echo $hari;echo ",".$tgl_now." ".$timenow;?></b> <br>ID Anggota: <br><b id="idsaya"></b> <br>Nama: <br><b id="namasaya"></b> <br>Status: <br><b id="statussaya"></b> <br>Keterangan: <br><b id="ketsaya"></b> <br> Location: <br><b id="lokasi"></b>
											</p>
											<hr>
								        <p>	Wajib share absensi ke <b>Whatsapp</b> sebelum bisa submit</p>
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
		<script>
			<!-- Validasi isi keterangan jika tidak hadir dikantor -->
			var x = document.getElementById("statushadir");
			var statussaya = document.getElementById("statussaya");
			var ketsaya = document.getElementById("statussaya")
			function formatPesan(){
				var waktuAbsen = document.getElementById("waktuAbsen").innerHTML;
				var idAbsen = document.getElementById("id_anggota_absen").value;
				document.getElementById("idsaya").innerHTML = idAbsen;
				var namaAbsen = document.getElementById("nama_absen").value;
				document.getElementById("namasaya").innerHTML = namaAbsen;
				var stat = x.options[x.selectedIndex].text;
				var ket1;
				switch (stat) {
					case "Hadir":
						ket1 = "Hadir";
						break;
					case "Hadir (Diluar)":
						ket1 = "Hadir diluar";
						break;
					case "Sakit":
						ket1 = "Sakit";
						break;
					case "Izin":
						ket1 = "Izin";
						break;
				}
				statussaya.innerHTML= ket1;
				var ket2 = document.getElementById("keterangan_absen").value;
				document.getElementById("ketsaya").innerHTML = ket2;
				var lokasi = document.getElementById("adress").value;
				document.getElementById("lokasi").innerHTML = lokasi;
				var waMsg1= "Waktu Absen: "+"\n"+waktuAbsen+"\n\n"+"ID Anggota: "+"\n"+idAbsen+"\n\n"+"Nama: "+"\n"+namaAbsen+"\n\n"+"Status: "+"\n"+ket1+"\n\n"+"Keterangan: "+"\n"+ket2+"\n\n"+"Lokasi: "+"\n"+lokasi;
				var waMsg1= window.encodeURIComponent(waMsg1);
				var waMsg2= document.getElementById("isiPesanWA").innerText;
				var isiPesanWA = "whatsapp://send?text="+waMsg1;
				//alert(isiPesanWA);
				document.getElementById("pesanWA").setAttribute("href",isiPesanWA);
			}
		<!-- End Proses Ambil Latitude & Longitude -->
		</script>
</html>