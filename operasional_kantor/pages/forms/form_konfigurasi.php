
<?php 
  if (!defined('DIDALAM_INDEX_PHP')){ 
     //echo "Dilarang broh!";
     header("Location: ../../tampil/home");
  }
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
?>

	<?php 
   		$tgl_now = date("d-m-Y"); 
		  $day = date('j', strtotime($tgl_now));
		  $month = date('F', strtotime($tgl_now));
		  $year = date('Y', strtotime($tgl_now));

		  
		  $id_pembayaran = $_GET['id'];
		  $_SESSION['id_pembayaran'] = $id_pembayaran;

		  $idjenis = $_GET['id_jenis'];

		  $sql = "SELECT email_admin,pass_email,secret_key,secret_iv,api_key_google,latKantor,lngKantor,batas_ukuran_upload FROM tb_konfigurasi_kakatu ORDER BY tanggal_set,jam_set";

		  $result=mysqli_query($koneksi,$sql);

		   if (!$result) {
              printf("Error: %s\n", mysqli_error($koneksi));
              exit();
              } 

	?>
				<div>
					<h2 style="float: right;"> <?php echo $day." - ".$month." - ".$year; ?> </h2>
					<hr>
					  <h2>FORM KONFIGURASI</h2> 
					  <hr style="border-color:#000000;">
					  <br>

					<?php
							while ($row=mysqli_fetch_array($result)) {	
					?>
					<section class="content-header" >
						<div class="container" style="width: 80%;"> 
							<form action="pages/proses/proses_edit-pembayaran.php" method="POST" enctype="multipart/form-data">   
							    <div class="form-group">
							      <label for="emailAdmin">Email Admin</label>
							      <input type="text" class="form-control" id="emailAdmin" placeholder="Email Admin" name="emailAdmin">
							    </div>

									<div class="form-group">
										<label for="passEmail">Pass Email Admin</label>
										<input type="text" class="form-control" id="passEmail" placeholder="Pass Email" name="passEmail">
									</div>

							    <div class="form-group">
										<label for="secretKey">Secret Key (Salt)</label>
										<input type="text" class="form-control" id="secretKey" placeholder="Secret Key" name="secretKey">
									</div>
									<div class="form-group">
										<label for="secretIV">Secret iv</label>
										<input type="text" class="form-control" id="secretIV" placeholder="Secret iv" name="secretIV">
									</div>
									<div class="form-group">
										<label for="apiGoogleKey">API Key Google Map</label>
										<input type="text" class="form-control" id="apiGoogleKey" placeholder="API Key Google Map" name="apiGoogleKey">
									</div>
									<div class="form-group">
										<label for="latKantor">Latitude Kantor</label>
										<input type="text" class="form-control" id="latKantor" placeholder="Latitude Kantor" name="latKantor">
									</div>
									<div class="form-group">
										<label for="lngKantor">Longitude Kantor</label>
										<input type="text" class="form-control" id="lngKantor" placeholder="Longitude Kantor" name="lngKantor">
									</div>
							    <div class="form-group">
							      <label for="ukuranUpload"> Batas Ukuran Upload </label>
							      <input class="form-control" type="text" id="ukuranUpload" name="ukuranUpload" data-validation="required" placeholder="Batas Ukuran upload">
							    </div>
									<input type="submit" name="submit" value="SAVE CHANGES" class="btn btn-success pull-right">
							<?php } ?>
					</div>
					<script>
					     $(document).ready(function(){  
					      $('.delete_data').click(function(){  
		         				var id = $(this).attr("id");
					              $.ajax({  
					                url:"pages/fetchdata/fetch_data_bukti-pembayaran.php",  
					                method:"post",  
					                data:{id:id},  
					                success:function(data){
					               	 $('#bukti').html(data);    
					                 $('#dataModal_hapus').modal("show");  
					         	}
					         }); 
					      });  
					 });  
					             
					</script>
				  
				  </div>			  		
				  </form>
						<!--Close Form Group -->
					    <div class="modal fade" id="myModal_img" role="dialog">
						    <div class="modal-dialog">
						    	<div class="modal-header">
						    		<a class="close" data-dismiss="modal" style="color: #ffffff;">CLOSE</a>
						  	    </div>
						  	    <div class="modal-content">
								     <img src='' class="img-responsive" style="width: 100%;" />							    
								</div>
						     </div>
						</div>
						</div>
					</section>  			 