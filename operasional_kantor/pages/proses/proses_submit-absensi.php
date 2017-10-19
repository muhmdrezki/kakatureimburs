<html>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" type="text/css" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
</html>
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- bootbox code -->
    <script src="../../bootbox.min.js"></script>
<?php
	//Composer penggunaan library ElephantIO untuk SOCKET IO
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	session_start();
	
	$nama = $_SESSION["nama"];
	if($_SESSION["nama"]==''){
		?>
		<script>
		alert('Anda Belum Login, Silahkan Login dulu');
		window.open('pages/forms/form_login.php','_self');
		</script>
		<?php
	} 
	include "../../con_db.php"; //sambung ke database
	include "../../fungsi_kakatu.php"; //panggil fungsi
	$id = $_SESSION["id_anggota"];
	$target_dir = "../../dist/fotolokasi/";
	$ukuran = 2000000;
	//mengambil nilai dari form
	$latKantor = -6.8869112;
	$lngKantor = 107.6168524;
	
	$latitude = antiInjection($_POST['latitude']);
	$longitude = antiInjection($_POST['longitude']);
	$address = getAddress($latitude, $longitude);
	$address = $address?$address:'Tidak Ketemu';
	$url_location="https://maps.google.com/?q=".trim($latitude).",".trim($longitude);
	$status = getStatusAbsen();
	$keterangan_hadirdiluar = antiInjection($_POST['keterangan_hadirdiluar']);
	$keterangan_sakit = antiInjection($_POST['keterangan_sakit']);
	$keterangan_izin = antiInjection($_POST['keterangan_izin']);
	$keterangan_cuti = antiInjection($_POST['keterangan_cuti']);
	$keterangan ="";
	
	$tglRentangSakit = antiInjection($_POST['tglRentangSakit']);
	$tglRentangIzin = antiInjection($_POST['tglRentangIzin']);
	$tglRentangCuti = antiInjection($_POST['tglRentangCuti']);
	$tgl_awal_sakit = substr($tglRentangSakit,0,11);
	$tgl_akhir_sakit = substr($tglRentangSakit,13,25);
	$tgl_awal_izin = substr($tglRentangIzin,0,11);
	$tgl_akhir_izin = substr($tglRentangIzin,13,25);
	$tgl_awal_cuti = substr($tglRentangCuti,0,11);
	$tgl_akhir_cuti = substr($tglRentangCuti,13,25);
	switch ($status) {
		case 1:
			$query = "INSERT INTO tb_detail_absen (id_anggota, tanggal, jam_masuk,status_id,keterangan,latitude,longitude,alamat_lokasi,tgl_awal,tgl_akhir) VALUES ('$id', CURRENT_DATE(),CURRENT_TIME(),'$status','$keterangan','$latitude','$longitude','$address',CURRENT_DATE(),CURRENT_DATE())";
			break;
		case 2:
			//$status = "hadir";
			$filename = "image_hadirdiluar";
			$keterangan = $keterangan_hadirdiluar;
			$query = "INSERT INTO tb_detail_absen (id_anggota, tanggal, jam_masuk,status_id,keterangan,latitude,longitude,alamat_lokasi,tgl_awal,tgl_akhir) VALUES ('$id', CURRENT_DATE(),CURRENT_TIME(),'$status','$keterangan','$latitude','$longitude','$address',CURRENT_DATE(),CURRENT_DATE())";
		break;
		case 3:
			$keterangan = $keterangan_sakit;
			$filename = "image_sakit";
			$query = "INSERT INTO tb_detail_absen (id_anggota, tanggal, jam_masuk,status_id,keterangan,latitude,longitude,alamat_lokasi,tgl_awal,tgl_akhir) VALUES ('$id', CURRENT_DATE(),CURRENT_TIME(),'$status','$keterangan','$latitude','$longitude','$address',STR_TO_DATE('$tgl_awal_sakit', '%m/%d/%Y'),STR_TO_DATE('$tgl_akhir_sakit', '%m/%d/%Y'))";
		break;
		case 4:
			$keterangan = $keterangan_izin;
			$filename = "image_izin";
			$query = "INSERT INTO tb_detail_absen (id_anggota, tanggal, jam_masuk,status_id,keterangan,latitude,longitude,alamat_lokasi,tgl_awal,tgl_akhir) VALUES ('$id', CURRENT_DATE(),CURRENT_TIME(),'$status','$keterangan','$latitude','$longitude','$address',STR_TO_DATE('$tgl_awal_izin', '%m/%d/%Y'),STR_TO_DATE('$tgl_akhir_izin', '%m/%d/%Y'))";
		break;
		case 5:
			$keterangan = $keterangan_cuti;
			$filename = "image_cuti";
			$query = "INSERT INTO tb_detail_absen (id_anggota, tanggal, jam_masuk,status_id,keterangan,latitude,longitude,alamat_lokasi,tgl_awal,tgl_akhir) VALUES ('$id', CURRENT_DATE(),CURRENT_TIME(),'$status','$keterangan','$latitude','$longitude','$address',STR_TO_DATE('$tgl_awal_cuti', '%m/%d/%Y'),STR_TO_DATE('$tgl_akhir_cuti', '%m/%d/%Y'))";
		break;
	}
	
	$distance = getDistance($latitude, $longitude,$latKantor, $lngKantor);
	if ($status==1) {
		if (empty($latitude)) {
		?>
			<script>alert("Lokasi anda belum terbaca!");document.location.href="../../index.php?sidebar-menu=form_absensi&action=tampil" </script>
	<?php		
		} else {
			if( $distance < 100 ) {
				submitAbsensi($koneksi,$query,$id,$status,$target_dir,$filename,$ukuran);
			} else {
			?>
					<script>alert("Jarak anda dari kantor: <?php echo round($distance,3);?> Meter");document.location.href="../../index.php?sidebar-menu=form_absensi&action=tampil" </script>
			<?php		
			}
		}
	} else {
		submitAbsensi($koneksi,$query,$id,$status,$target_dir,$filename,$ukuran);
		//call fungsi update cuti
		updateCutiUsed($koneksi,$id,$status,$tgl_awal_cuti,$tgl_akhir_cuti);
	}
	

?>
		<script>
			var status = <?php echo $status?>;
			var tglskrg = new Date();
			var wa_msg;
			
			switch (status) {
				case "1":
					var wa_msg = "HADIR"+ "\n"+"---"+ "\n"+"Saya,<?php echo $nama?> sudah hadir dikantor pada hari ini pukul "+tglskrg.getHours()+":"+tglskrg.getMinutes();
					break;
				case "2":
					var wa_msg = "HADIR DILUAR"+ "\n"+"Saya,<?php echo $nama?> sedang bertugas diluar kantor pada hari ini mulai pukul "+tglskrg.getHours()+":"+tglskrg.getMinutes()+" untuk keperluan <?php echo $keterangan?>\n<?php echo $url_location?>";
					break;
				case "3":
					var wa_msg = "SAKIT"+ "\n"+"Saya, <?php echo $nama?> mohon izin pada hari ini tidak bisa masuk kerja karena <?php echo $keterangan?>. Mohon doanya ya agar saya lekas sembuh. Amin\n<?php echo $url_location?>";
					break;
				case "4":
					//var tglcoba="<?php echo $tgl_awal_izin?>";
					//console.log(tglcoba);
					var date1 = new Date("<?php echo $tgl_awal_izin?>");
					var date2 = new Date("<?php echo $tgl_akhir_izin?>");
					var timeDiff = Math.abs(date2.getTime() - date1.getTime());
					var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
					if (diffDays==0) {
						var wa_msg = "IZIN"+ "\n"+"Saya, <?php echo $nama?> mohon izin pada hari ini tidak bisa masuk kerja karena <?php echo $keterangan?>.\n<?php echo $url_location?>";
					} else {
						var wa_msg = "IZIN"+ "\n"+"Saya, <?php echo $nama?> mohon izin pada hari ini sampai <?php echo $tgl_akhir_izin?> tidak bisa masuk kerja karena <?php echo $keterangan?>.\n<?php echo $url_location?>";
					}
					break;
				case "5":
				var wa_msg = "CUTI"+ "\n"+"Saya,<?php echo $nama?> mohon izin cuti dari tanggal <?php echo $tgl_awal_cuti?> sampai <?php echo $tgl_akhir_cuti?> karena <?php echo $keterangan?>.Sisa cuti saya tahun "+tglskrg.getFullYear()+" ini <?php echo $_SESSION['sisacuti']?> hari \n<?php echo $url_location?>";
					break;
				default:
					break;
			}
			var wa_msg = window.encodeURIComponent(wa_msg);
			var wa_absen = "whatsapp://send?text="+wa_msg;
			console.log( wa_absen);
			bootbox.confirm({
					message: "<?php echo '<h4>' ?>Absen Berhasil. <?php echo '<br><br>' ?> Yuk share ke Whatsapp untuk absensi anda hari ini <?php echo '</h4><br><h3>' ?>  Share Sekarang? <?php echo '</h3>'?>",
					buttons: {
						confirm: {
							label: 'SHARE',
							className: 'btn-success btn-sm'

						},
						cancel: {
							label: 'NANTI',
							className: 'btn-danger btn-sm'
						}
					},
			callback: function (result) {
				console.log('This was logged in the callback: ' + result)
				if (result){
					window.location=wa_absen
						bootbox.alert({ 
						size: "small",
						message: "<?php echo '<h4>' ?>Terimakasih telah melakukan absen<?php echo '</h4>'?>", 
						callback: function(){window.location="../../index.php?sidebar-menu=list_data_absensi&action=tampil" }
					})
				} else {
					window.location="../../index.php?sidebar-menu=list_data_absensi&action=tampil"
				}
			}
		});

    </script>