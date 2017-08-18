<!DOCTYPE html>
<html lang='en'>
<?php 
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
?>
	<head>
	  <!-- Tell the browser to be responsive to screen width -->
	  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
	  <!-- Font Awesome -->
	  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
	  <!-- Ionicons -->
	  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
	  <!-- Theme style -->
	  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
	  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
	        page. However, you can choose any other skin. Make sure you
	        apply the skin class to the body tag so the changes take effect. -->
	  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">

	  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	  <!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	  <![endif]-->

	  <!-- Google Font -->
	  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	</head>

	<?php 
		  include "../con_db.php";
		  session_start();

   		  $tgl_now = date("d-m-Y"); 
		  $day = date('j', strtotime($tgl_now));
		  $month = date('F', strtotime($tgl_now));
		  $year = date('Y', strtotime($tgl_now));


		  $id_pembayaran = $_GET['id'];
		  $_SESSION['id_pembayaran'] = $id_pembayaran;

		  $sql = "SELECT tb_pembayaran.id_pembayaran, tb_anggota.id_anggota, tb_anggota.nama, tb_pembayaran.tanggal, tb_jenistransaksi.jenis, tb_pembayaran.nominal, tb_pembayaran.keterangan, tb_pembayaran.status FROM `tb_pembayaran`JOIN `tb_anggota` ON tb_pembayaran.id_anggota = tb_anggota.id_anggota JOIN tb_jenistransaksi ON tb_pembayaran.id_jenis = tb_jenistransaksi.id_jenis WHERE tb_pembayaran.id_pembayaran='$id_pembayaran'";

		  $result=mysqli_query($koneksi,$sql);

		   if (!$result) {
              printf("Error: %s\n", mysqli_error($koneksi));
              exit();
              } 

          $sql_bukti = "SELECT * FROM tb_buktipembayaran WHERE id_pembayaran = '$id_pembayaran'";
          $result_bukti = mysqli_query($koneksi, $sql_bukti);   

	?>
		<body>
				<div>
					<h2 style="float: right;"> <?php echo $day." - ".$month." - ".$year; ?> </h2>
					<hr>
					  <h2>FORM PEMBAYARAN</h2> 
					  <hr style="border-color:#3c8dbc;">
					  <br>
					  <div class="form-group">
					  <label for="nominal"> Bukti Pembayaran </label>
					  <br>
					  <br>
					  <table>
					  	<tr>
					  <?php 
					  	while ($r = mysqli_fetch_array($result_bukti)){
					  		$path = $r[bukti];
					  		?>
					  	 	
					      <td style="padding: 5px;"> 
					      <a class='popupimage' href='<?php echo "dist/fotobukti/".$path; ?>' data-target="#myModal_img">
					      	<img <?php echo "src='dist/fotobukti/".$path."'"; ?> class="img-responsive" width="260" height="60">
					      </a>
					      </td>
					  		
					    </div>
						<!--Close Form Group -->
						   <?php
					  	}
					  ?>

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

					    <?php
							while ($row=mysqli_fetch_array($result)) {	
						?>
						</tr>
					</table>	
					    <hr style="border-color: #3c8dbc;">
					    <div class="form-group">
					      <label for="id_pembayaran">ID</label>
					      <input type="text" class="form-control" id="id_pembayaran" placeholder="Id Pembayaran" name="id_pembayaran" value="<?php echo $row['id_pembayaran']; ?>" disabled>
					    </div>

					    <div class="form-group">
					      <label for="Id_anggota">ID Anggota</label>
					      <input type="text" class="form-control" id="id_anggota" name="id_anggota" value="<?php echo $row['id_anggota'];?>" disabled>
					    </div>

					    <div class="form-group">
					      <label for="Id_anggota">Jenis Pembayaran</label>
					      <input type="text" class="form-control" id="id_anggota" name="id_anggota" value="<?php echo $row['jenis'];?>" disabled>
					    </div>

					    <div class="form-group">
					      <label for="nominal"> Nominal </label>
					      <input class="form-control" type="number" id="nominal" name="nominal" value="<?php echo $row['nominal']?>" disabled>
					    </div>

					    <div class="form-group">
					      <label for="keterangan"> Keterangan </label>
					      <textarea class="form-control" rows="5" id="keterangan" name="keterangan" placeholder="Keterangan Pembayaran" disabled> <?php echo $row['keterangan']; ?> </textarea>
					    </div>

					    <?php  list($one, $two) = explode(",", $_SESSION['jabatan'] , 2); ?>

					    <!-- Trigger the modal with a button -->
						  <Button type="button" class="btn btn-primary " data-toggle="modal" data-target="#myModal_pesan">KONFIRMASI</Button>
						  <br><br>
						  <!-- Modal -->
						  <div class="modal fade" id="myModal_pesan" role="dialog">
						    <div class="modal-dialog">
						    
						      <!-- Modal content-->
						      <div class="modal-content">
							        <div class="modal-header">
							          <button type="button" class="close" ata-dismiss="modal">&times;</button>
							          <h4 class="modal-title">Pesan Konfirmasi</h4>
							        </div>
							        <form method="POST" action="pages/proses_konfirmasi.php">
							        <?php if($one!="Admin"){
							        	?>
								        <div class="modal-body">
								        <p>
								        	Uang Pembayaran <b><?php echo $row['jenis']?></b> dengan ID Pembayaran <b><?php echo $row['id_pembayaran']?></b>, tanggal <b><?php echo $row['tanggal']?></b>. Sebesar <b>Rp.<?php echo $row ['nominal']?></b> sudah di Transfer ke Rekening Bank Anda, silahkan di cek.
								        </p>
								        <hr>
								        <p>
								        	Jika uang belum ada bisa di informasikan kembali langsug lewat <b>WHATSAPP</b>, Jika sudah masuk 
								        	silahkan langsung klik tombol <b>"KIRIM KONFIRMASI"</b>
								        </p>
								        </div>
							        <?php 
									} else if($one == "Admin"){
										?>
										<div class="modal-body">
								        <p>
								        	Saya baru saja <b><?php echo $row['jenis']?></b> dengan ID Pembayaran <b><?php echo $row['id_pembayaran']?></b> , tanggal <b><?php echo $row['tanggal']?></b>. Sebesar <b>Rp.<?php echo $row ['nominal']?></b>. Mohon segera di Reimbers.
								        </p>
								        <hr>
								        <p>	Jika sudah melakukan Reimbers, klik <b>"KIRIM KONFIRMASI"</b> </p>
								        </div>
									<?php
									}
							        ?>
							        <div class="modal-footer">

							          <?php 
										  $sql_konfirm = "SELECT * FROM tb_konfirmasi WHERE id_pembayaran='$id_pembayaran'";
										  $result_konfirm=mysqli_query($koneksi, $sql_konfirm);
								          $values=mysqli_fetch_assoc($result_konfirm);
								          $status_admin = $values['konfirm_admin'];
								          $status_anggota = $values['konfirm_anggota'];

								          $sql_cek = "SELECT * FROM tb_pembayaran WHERE id_pembayaran='$id_pembayaran'";
								          $result_cek = mysqli_query($koneksi, $sql_cek);
								          $values_cek = mysqli_fetch_assoc($result_cek);
								          $status = $values_cek['status'];


							          		if($one != 'Admin'){
								          	
								          		if($status == "2" ){
								          			?>
								          					<input type="submit" name="submit" value="KIRIM KONFIRMASI" class="btn btn-danger" disabled>  
								          			<?php
								          	
								          		} else if($status=="0" || $status == "1") {
								          	
								          		if($status_admin != "2"){
								          			?>
								          				  	<input type="submit" name="submit" value="KIRIM KONFIRMASI" class="btn btn-danger" disabled>  
								          			<?php
								          		} else if($status_admin == "2"){
								          			?>
								          			  		<input type="submit" name="submit" value="KIRIM KONFIRMASI" class="btn btn-danger">  
								          			<?php
								          		} 
								          	}

							          	} else if($one == 'Admin'){
							          		 
							          		 if($status == "2" ){
								          			?>
								          					<input type="submit" name="submit" value="KIRIM KONFIRMASI" class="btn btn-danger" disabled>  
								          			<?php
								          			
								          		} else if($status == "0" || $status=="1") {

								          		if($status_admin == "2"){
									          		?>
									          				<input type="submit" name="submit" value="KIRIM KONFIRMASI" class="btn btn-danger" disabled>  
									          		<?php
									          		} else if($status_admin != "2"){
									          		?>
									          				<input type="submit" name="submit" value="KIRIM KONFIRMASI" class="btn btn-danger">  
									          		<?php
								          		} 
								          	}
							          	}
							          ?>
							          <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>
						        	</div>
						      </div>
						     
						    </div>
						  </div>
					    <?php } ?>
					 
				</div>
		</body>
</html>