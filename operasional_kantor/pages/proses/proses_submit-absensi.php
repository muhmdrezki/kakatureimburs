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
	$query=null;
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
			$tgl_awal= $tgl_awal_sakit;
			$tgl_akhir=$tgl_akhir_sakit;
			$keterangan = $keterangan_sakit;
			$filename = "image_sakit";
			$query = "INSERT INTO tb_detail_absen (id_anggota, tanggal, jam_masuk,status_id,keterangan,latitude,longitude,alamat_lokasi,tgl_awal,tgl_akhir) VALUES ('$id', CURRENT_DATE(),CURRENT_TIME(),'$status','$keterangan','$latitude','$longitude','$address',STR_TO_DATE('$tgl_awal', '%m/%d/%Y'),STR_TO_DATE('$tgl_akhir', '%m/%d/%Y'))";
		break;
		case 4:
			$tgl_awal= $tgl_awal_izin;
			$tgl_akhir=$tgl_akhir_izin;
			$keterangan = $keterangan_izin;
			$filename = "image_izin";
			$query = "INSERT INTO tb_detail_absen (id_anggota, tanggal, jam_masuk,status_id,keterangan,latitude,longitude,alamat_lokasi,tgl_awal,tgl_akhir) VALUES ('$id', CURRENT_DATE(),CURRENT_TIME(),'$status','$keterangan','$latitude','$longitude','$address',STR_TO_DATE('$tgl_awal', '%m/%d/%Y'),STR_TO_DATE('$tgl_akhir', '%m/%d/%Y'))";
		break;
		case 5:
			$tgl_awal= $tgl_awal_cuti;
			$tgl_akhir=$tgl_akhir_cuti;
			$keterangan = $keterangan_cuti;
			$filename = "image_cuti";
			$query = "INSERT INTO tb_detail_absen (id_anggota, tanggal, jam_masuk,status_id,keterangan,latitude,longitude,alamat_lokasi,tgl_awal,tgl_akhir) VALUES ('$id', CURRENT_DATE(),CURRENT_TIME(),'$status','$keterangan','$latitude','$longitude','$address',STR_TO_DATE('$tgl_awal', '%m/%d/%Y'),STR_TO_DATE('$tgl_akhir', '%m/%d/%Y'))";
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
				//call fungsi submit absensi
				submitAbsensi($koneksi,$query,$id,$status,$target_dir,$filename,$ukuran);
			} else {
			?>
					<script>alert("Jarak anda dari kantor: <?php echo round($distance,3);?> Meter");document.location.href="../../index.php?sidebar-menu=form_absensi&action=tampil" </script>
			<?php		
			}
		}
	} else {
			if ($tgl_awal==$tgl_akhir) {
				//call fungsi submit absensi
				submitAbsensi($koneksi,$query,$id,$status,$target_dir,$filename,$ukuran);
				//call fungsi update cuti
				updateCutiUsed($koneksi,$id,$status,$tgl_awal,$tgl_akhir);
			} else {
				//ambil tanggal awal dan akhir
				$begin = new DateTime($tgl_awal);
				$end = new DateTime($tgl_akhir);
				$end = $end->modify('+1 day');
				//echo $tgl_awal." ".$tgl_akhir;
				//echo "<br>";
				//Query untuk mengambil tgl_libur yang berada diantara range tanggal yg dipilih

				//hitung interval
				$interval = DateInterval::createFromDateString('1 day');
				//dapatkan periode increment per 1 hari
				$period = new DatePeriod($begin, $interval, $end);
				//$tgl_onrange=null;
				//loop ke tanggal range increment satu hari
				foreach ( $period as $dt ){
					$validAbsen=true;
					$tgl_onrange = $dt->format( "Y-m-d" );
					//echo $tgl_onrange;
					//echo "<br>";
					$dayNameOnTglRange = date('D', strtotime($tgl_onrange));
					//Check tanggal apakah tanggal ada di hari sabtu atau tidak
					if ($dayNameOnTglRange=="Sat" || $dayNameOnTglRange=="Sun"){
						$validAbsen=false;
					} else {
						$SELECTLIBUR = "SELECT tglawal,tglakhir FROM tb_tgllibur WHERE (tglawal>=STR_TO_DATE('$tgl_awal', '%m/%d/%Y') AND tglakhir<=STR_TO_DATE('$tgl_akhir', '%m/%d/%Y')) AND tglakhir>=STR_TO_DATE('$tgl_awal', '%m/%d/%Y')";
						$reslibur=mysqli_query($koneksi, $SELECTLIBUR);
						while ($rowlibur=mysqli_fetch_array($reslibur)) {
							$awal = $rowlibur['tglawal'];
							$akhir = $rowlibur['tglakhir'];
							//echo $awal." ".$akhir;
							//echo "<br>";
							if ($tgl_onrange>=$awal && $tgl_onrange<=$akhir) {
								//Dapatkan nama hari dari tanggal
								$validAbsen=false;
							}	
						}
					}
					if ($validAbsen==true) {
						$query2 = "INSERT INTO tb_detail_absen (id_anggota, tanggal, jam_masuk,status_id,keterangan,latitude,longitude,alamat_lokasi,tgl_awal,tgl_akhir) VALUES ('$id', CURRENT_DATE(),CURRENT_TIME(),'$status','$keterangan','$latitude','$longitude','$address','$tgl_onrange',STR_TO_DATE('$tgl_akhir', '%m/%d/%Y'))";
						submitAbsensi($koneksi,$query2,$id,$status,$target_dir,$filename,$ukuran);
						//call fungsi update cuti
						updateCutiUsed($koneksi,$id,$status,$tgl_awal,$tgl_akhir);
					}
				}
			} 
		}	
?>
		