<!DOCTYPE html>
<html lang='en'>
<?php
if (!defined('DIDALAM_INDEX_PHP')){ 
   //echo "Dilarang broh!";
   header("Location: ../../index.php?sidebar-menu=home&action=tampil");
}
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
?>
    <head>
      <!-- Tell the browser to be responsive to screen width -->
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <!-- Google Font -->
          <!-- jQuery 3 -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style type="text/css">    
        @media (max-width: 640px) {
			.btn-xl {
				padding: 40px 40px;
				font-size: 14px;
				line-height: 1;
			}
			#hadirluar {
				padding: 29px 40px;
			}
        }

        @media (min-width: 769px) {
			.btn-xl {
				padding: 45px 45px;
				font-size: 15px;
				line-height: 1;
			}
			#hadirluar {
				padding: 33px 45px;
			}
        }
		@media (min-width: 992px) {
			.btn-xl {
				padding: 45px 45px;
				font-size: 15px;
				line-height: 1;
			}
			#hadirluar {
				padding: 33px 45px;
			}
        }
		@media (min-width: 1200px)  {
			.btn-xl {
				padding: 50px 50px;
				font-size: 20px;
				border-radius: 0px;
			
			}#hadirluar {
				padding: 36px 50px;
			}
		}
		td.spasi {
			padding-right: 20px;
			padding-bottom: 20px;
		}
		.btn-wrap-text {
			white-space: normal !important;
			word-wrap: break-word;
			display: block;
			border-radius: 0px;
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
        $dayname = date('D', strtotime($tgl_now));
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
    <body onload="getUserLocation()">
            <div class="container fadeInLeft animated" style="width: 80%;">
				<h3  class="pull-right" style="float: right;"> <?php echo $dayname." , ".$day." - ".$month." - ".$year; ?> </h3>
                <hr>
				<br>
				<h1>Halo <?php echo $_SESSION["nama"]?>, Yuk isi Absen dulu!</h1>
                      
            </div>      
                <div class="container fadeInLeft animated" style="width: 80%;">
					<h2>FORM ABSENSI</h2>
					<br> 
					<form action="pages/proses/proses_submit-absensi.php" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label for="id">ID Anggota: <?php echo $_SESSION['id_anggota']; ?> </label>
							</div>
							<div class="form-group">
								 <input 
									type="text" class="form-control" id="latitude" name="latitude" value="<?php echo $latitude;?>"  style="display: none;" readonly
								>
							</div>
							 <div class="form-group">
								<input type="text" class="form-control" id="longitude" name="longitude" value="<?php echo $longitude;?>" style="display: none;" readonly>
							 </div>
									  
							 <table>    
								<tr>
									<td class="spasi">
										<button type="submit" name="submit_hadir" class="btn btn-info btn-xl btn-block btn-wrap-text">Hadir</button>
									</td>
									<td class="spasi">
										<button id="hadirluar" name="submit_hadirdiluar" type="button" class="btn btn-primary btn-xl btn-block btn-wrap-text" data-toggle="modal" data-target="#myModal_hadirdiluar">Hadir <p>Diluar</p></button>
									</td>
								</tr>
								<tr>	
									<td class="spasi"> 
										<button type="button" name="submit_sakit" class="btn btn-danger btn-xl btn-block btn-wrap-text" data-toggle="modal" data-target="#myModal_sakit">Sakit</button>
									</td>
									<td class="spasi">
										<button type="button" name="submit_izin" class="btn btn-warning btn-xl btn-block btn-wrap-text" data-toggle="modal" data-target="#myModal_izin">Izin</button>
									</td>
								</tr>
								<tr>	
									<td class="spasi">
										<button type="button" name="submit_cuti" class="btn btn-success btn-xl btn-block btn-wrap-text" data-toggle="modal" data-target="#myModal_cuti">Cuti</button>
									</td>
								</tr>
							</table>
							
							<!-- Trigger the modal with a button -->
							 <!-- <Button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal_pesan" onclick="formatPesan();getUserLocation()">KONFIRMASI</Button>-->
				</div>
						<br><br>
                          <!-- Modal -->
						<div class="modal fade" id="myModal_hadirdiluar" role="dialog">
							<div class="modal-dialog">
							  <!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title" style="float: right;"> <?php echo $dayname." , ".$day." - ".$month." - ".$year."  ".$timenow; ?></h4>
										<h4 class="modal-title" style="font-weight: bold"><?php echo $_SESSION['nama'] ?></h4>
									</div>
									<div class="modal-body">
										<div class="form-group">  
											<label for="address"> Alamat Lokasi </label>
											<input type="text" class="form-control" id="address_hadirdiluar"  placeholder="Mengharuskan Izin Lokasi" name="adress_hadirdiluar" readonly>
										</div>
										<div class="form-group">
											<label for="keterangan"> Keterangan </label>
											<textarea  class="form-control" rows="3" id="keterangan_hadirdiluar" name="keterangan_hadirdiluar" placeholder="Isi Keterangan"></textarea>  
											<span class="help-block"></span>
                                        </div>
										<!-- image-preview-filename input [CUT FROM HERE]-->
                                        <label for="foto_hadirdiluar"> Foto Lokasi <span class="glyphicon glyphicon-upload"></span> (Optional)</label>
										<div class="form-group input-group image-preview">				
                                            <input type="text" class="form-control image-preview-filename" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
                                            <span class="input-group-btn">
                                                <!-- image-preview-clear button -->
                                                <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                                    <span class="glyphicon glyphicon-remove"></span> Clear
                                                </button>
                                                <!-- image-preview-input -->
                                                <div class="btn btn-default image-preview-input">
                                                    <span class="glyphicon glyphicon-folder-open"></span>
                                                    <span class="image-preview-input-title">Browse</span>
                                                    <input type="file" accept="image/png, image/jpeg, image/gif" name="image_hadirdiluar"/> <!-- rename it -->
                                                </div>
                                            </span>
                                        </div><!-- /input-group image-preview [TO HERE]--> 
										
										<div class="modal-footer">
											<input type="submit" name="submit_hadirdiluar" value="Submit Hadir" class="btn btn-danger btn-sm">
											<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">CLOSE</button>
										</div>
									</div>
								</div>
							</div>
                    
						</div>
						<div class="modal fade" id="myModal_sakit" role="dialog">
							<div class="modal-dialog">
							  <!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
									  <button type="button" class="close" data-dismiss="modal">&times;</button>
									  <h4 class="modal-title" style="float: right;"> <?php echo $dayname." , ".$day." - ".$month." - ".$year."  ".$timenow; ?></h4>
									  <h4 class="modal-title" style="font-weight: bold"><?php echo $_SESSION['nama'] ?></h4>
									</div>
									<div class="modal-body">
										<div class="form-group">  
											<label for="address"> Alamat Lokasi </label>
											<input type="text" class="form-control" id="address_sakit"  placeholder="Mengharuskan Izin Lokasi" name="adress_sakit" readonly>
										</div>
										<div class="form-group">
											<label for="keterangan"> Alasan </label>
											<textarea  class="form-control" rows="3" id="keterangan_sakit" name="keterangan_sakit" placeholder="Isi Alasan" ></textarea>  
											<span class="help-block"></span>
                                        </div>
										<div class="form-group">
											<label>Tanggal Sakit:</label>
											<div class="input-group">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="tglRentangSakit" name="tglRentangSakit">
											</div>
											<!-- /.input group -->
										</div>
										<!-- /.form group -->
                                        <!-- image-preview-filename input [CUT FROM HERE]-->
                                        <!-- image-preview-filename input [CUT FROM HERE]-->
                                        <label for="foto_sakit"> Foto Lokasi <span class="glyphicon glyphicon-upload"></span> (Optional)</label>
										<div class="form-group input-group image-preview">				
                                            <input type="text" class="form-control image-preview-filename" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
                                            <span class="input-group-btn">
                                                <!-- image-preview-clear button -->
                                                <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                                    <span class="glyphicon glyphicon-remove"></span> Clear
                                                </button>
                                                <!-- image-preview-input -->
                                                <div class="btn btn-default image-preview-input">
                                                    <span class="glyphicon glyphicon-folder-open"></span>
                                                    <span class="image-preview-input-title">Browse</span>
                                                    <input type="file" accept="image/png, image/jpeg, image/gif" name="image_sakit"/> <!-- rename it -->
                                                </div>
                                            </span>
                                        </div><!-- /input-group image-preview [TO HERE]--> 
										<div class="modal-footer">
											<input type="submit" name="submit_sakit" value="Submit Sakit" class="btn btn-danger btn-sm">
											<button type="button" class="btn btn-default btn-sm submit_sakit" data-dismiss="modal">CLOSE</button>
										</div>
									</div>
								</div>
							</div>
                    
						</div>
						<div class="modal fade" id="myModal_izin" role="dialog">
							<div class="modal-dialog">
							  <!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
									  <button type="button" class="close" data-dismiss="modal">&times;</button>
									  <h4 class="modal-title" style="float: right;"> <?php echo $dayname." , ".$day." - ".$month." - ".$year."  ".$timenow; ?></h4>
									  <h4 class="modal-title" style="font-weight: bold"><?php echo $_SESSION['nama'] ?></h4>
									</div>
									<div class="modal-body">
										<div class="form-group">  
											<label for="address"> Alamat Lokasi </label>
											<input type="text" class="form-control" id="address_izin"  placeholder="Mengharuskan Izin Lokasi" name="adress_izin" readonly>
										</div>
										<div class="form-group">
											<label for="keterangan"> Alasan </label>
											<textarea  class="form-control" rows="3" id="keterangan_izin" name="keterangan_izin" placeholder="Isi Alasan"></textarea>  
											<span class="help-block"></span>
                                        </div>
										<div class="form-group">
											<label>Tanggal Izin:</label>
											<div class="input-group">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="tglRentangIzin" name="tglRentangIzin">
											</div>
											<!-- /.input group -->
										</div>
										<!-- /.form group -->
                                        <!-- image-preview-filename input [CUT FROM HERE]-->
                                        <label for="foto_izin"> Foto Lokasi <span class="glyphicon glyphicon-upload"></span> (Optional)</label>
										<div class="form-group input-group image-preview">				
                                            <input type="text" class="form-control image-preview-filename" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
                                            <span class="input-group-btn">
                                                <!-- image-preview-clear button -->
                                                <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                                    <span class="glyphicon glyphicon-remove"></span> Clear
                                                </button>
                                                <!-- image-preview-input -->
                                                <div class="btn btn-default image-preview-input">
                                                    <span class="glyphicon glyphicon-folder-open"></span>
                                                    <span class="image-preview-input-title">Browse</span>
                                                    <input type="file" accept="image/png, image/jpeg, image/gif" name="image_izin"/> <!-- rename it -->
                                                </div>
                                            </span>
                                        </div><!-- /input-group image-preview [TO HERE]--> 
										<div class="modal-footer">
											<input type="submit" name="submit_izin" value="Submit Izin" class="btn btn-danger btn-sm">
											<button type="button" class="btn btn-default btn-sm submit_izin" data-dismiss="modal">CLOSE</button>
										</div>
									</div>
								</div>
							</div>
                    
						</div>
						<div class="modal fade" id="myModal_cuti" role="dialog">
							<div class="modal-dialog">
							  <!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
									  <button type="button" class="close" data-dismiss="modal">&times;</button>
									  <h4 class="modal-title" style="float: right;"> <?php echo $dayname." , ".$day." - ".$month." - ".$year."  ".$timenow; ?></h4>
									  <h4 class="modal-title" style="font-weight: bold"><?php echo $_SESSION['nama'] ?></h4>
									</div>
									<div class="modal-body">
										<div class="form-group">  
											<label for="address"> Alamat Lokasi </label>
											<input type="text" class="form-control" id="address_cuti"  placeholder="Mengharuskan Izin Lokasi" name="adress_cuti" readonly>
										</div>
										<!-- Date dd/mm/yyyy -->
										<!-- Date range -->
										<?php 
											$sql4 = "SELECT cuti_used,cuti_qty FROM tb_cuti_anggota WHERE id_anggota ='$_SESSION[id_anggota]' ";
											$result4=mysqli_query($koneksi, $sql4);
											$values4=mysqli_fetch_assoc($result4);
											$sisacuti= $values4['cuti_qty'] - $values4['cuti_used'];
										?>
										<label>Sisa Cuti: <span id="sisacuti"><?php echo $sisacuti?></span> hari</label>
										<div class="form-group">
											<label>Tanggal Cuti:</label>
											<div class="input-group">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="tglRentangCuti" name="tglRentangCuti">
											</div>
											<!-- /.input group -->
										</div>
										<!-- /.form group -->
										<div class="form-group">
											<label for="keterangan"> Alasan </label>
											<textarea  class="form-control" rows="3" id="keterangan_cuti" name="keterangan_cuti" placeholder="Isi Alasan"></textarea>  
											<span class="help-block"></span>
                                        </div>
                                        <!-- image-preview-filename input [CUT FROM HERE]-->
                                        <label for="foto_cuti"> Foto Lokasi <span class="glyphicon glyphicon-upload"></span> (Optional)</label>
										<div class="form-group input-group image-preview">				
                                            <input type="text" class="form-control image-preview-filename" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
                                            <span class="input-group-btn">
                                                <!-- image-preview-clear button -->
                                                <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                                    <span class="glyphicon glyphicon-remove"></span> Clear
                                                </button>
                                                <!-- image-preview-input -->
                                                <div class="btn btn-default image-preview-input">
                                                    <span class="glyphicon glyphicon-folder-open"></span>
                                                    <span class="image-preview-input-title">Browse</span>
                                                    <input type="file" accept="image/png, image/jpeg, image/gif" name="image_cuti"/> <!-- rename it -->
                                                </div>
                                            </span>
                                        </div><!-- /input-group image-preview [TO HERE]--> 
										<div class="modal-footer">
											<input type="submit" name="submit_cuti" value="Submit Cuti" class="btn btn-danger btn-sm">
											<button type="button" class="btn btn-default btn-sm submit_cuti" data-dismiss="modal">CLOSE</button>
										</div>
									</div>
								</div>
							</div>
                    
						</div>
					</form>	
    </body>
</html>
