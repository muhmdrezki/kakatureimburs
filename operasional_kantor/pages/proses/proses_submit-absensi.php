<?php
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
	
	$id = $_SESSION["id_anggota"];
	$target_dir = "../../dist/fotolokasi/";
	$ukuran = 2000000;
	//mengambil nilai dari form
	$latKantor = -6.8901604999999995;
	$lngKantor = 107.58020239999999;
	
	$latitude = $_POST['latitude'];
	$longitude = $_POST['longitude'];
	$address = getAddress($latitude, $longitude);
	$address = $address?$address:'Tidak Ketemu';
	$status = getStatusAbsen();
	$keterangan_hadirdiluar = $_POST['keterangan_hadirdiluar'];
	$keterangan_sakit = $_POST['keterangan_sakit'];
	$keterangan_izin = $_POST['keterangan_izin'];
	$keterangan_cuti = $_POST['keterangan_cuti'];
	$keterangan ="";
	
	$tglRentangSakit = $_POST['tglRentangSakit'];
	$tglRentangIzin = $_POST['tglRentangIzin'];
	$tglRentangCuti = $_POST['tglRentangCuti'];
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
	
	//functions
	function getAddress($latitude, $longitude) {
		if (!empty($latitude) && !empty($longitude)) {
			//Send request and receive json data by address
			$API_KEY='AIzaSyAn0sCC7HGqbJbWhwkgJnvyWFiTa7QGtVI';
			$geocodeFromLatLong = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($latitude).','.trim($longitude).'&sensor=true&key='.trim($API_KEY));
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
	function submitAbsensi($conn,$sql,$id,$stat,$tgtdir,$filename,$size){
		//query untuk memasukan ke database
		$insert = mysqli_query($conn, $sql);
		if ($stat!=1) {
			uploadSingleGambar($conn,$tgtdir,$filename,$size);
		}
		if (!$insert) {
			printf("Error: %s\n", mysqli_error($conn));
			exit();
		}
		//update cuti used
		//panggil fungsi tambah credit
		topupCredit($conn,$id,$stat);
	}
	function getStatusAbsen(){
		if (isset($_POST["submit_hadir"])) {
			return 1;
		} else if (isset($_POST["submit_hadirdiluar"])) {
			return 2;
		} else if (isset($_POST["submit_sakit"])) {
			return 3;
		} else if (isset($_POST["submit_izin"])) {
			return 4;
		} else if (isset($_POST["submit_cuti"])) {
			return 5;
		}
	}
	//Function update cuti
	function updateCutiUsed($conn,$id,$stat,$tgl1,$tgl2){
		if ($stat==5) {
			$queryCuti= "UPDATE tb_cuti_anggota SET cuti_used=(cuti_used +DATEDIFF(STR_TO_DATE('$tgl2', '%m/%d/%Y'),STR_TO_DATE('$tgl1', '%m/%d/%Y'))+1) WHERE id_anggota='$id'";
			$updateCuti = mysqli_query($conn, $queryCuti);
			//$printf($updateCuti);
			if (!$updateCuti) {
				printf("Error: %s\n", mysqli_error($conn));
				exit();
			}
		}
	}
	function uploadSingleGambar($conn,$targetdir,$filename,$ukuran){
		$target_file = $targetdir . basename($_FILES[$filename]["name"]);
		$file = basename($_FILES[$filename]["name"]);
		if (!empty($file)) {
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			$check = getimagesize($_FILES[$filename]["tmp_name"]);
			if($check !== false) {
				$uploadOk = 1;
			} else {
				$uploadOk = 0;
			}
			// Check if file already exists
			/*
			if (file_exists($target_file)) {
				?>
				<script> alert("<?php echo "Maaf, file sudah ada."; ?>"); </script>
				<?php 
				$uploadOk = 0;
			}*/
			// Check file size
			if ($_FILES[$filename]["size"] > $ukuran) {
				?>
				<script> alert("<?php echo "Maaf, file anda terlalu besar.";?>"); </script>
				<?php
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				?>
				<script type="text/javascript"> alert("<?php echo "Maaf, hanya file format JPG, JPEG, PNG & GIF yang diizinkan."; ?>");</script> 
				<?php
				$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				?>
				<script type="text/javascript"> alert("<?php echo "Maaf, file anda tidak terupload."; ?>");</script>  
				<?php
			// if everything is ok, try to upload file
			} else {
				$namatgl = new DateTime();
				$namatgl->setTimezone(new DateTimeZone('Asia/Jakarta'));
				$namabaru= $namatgl->format('Y-m-d-H-i-s');
				$sementara = explode(".", $_FILES[$filename]["name"]);
				$newfilename = $namabaru.'.'.end($sementara);
				if (move_uploaded_file($_FILES[$filename]["tmp_name"], $targetdir.$newfilename)) {
					?>
					<script type="text/javascript"> alert(" <?php  echo "File ini ". basename( $_FILES[$filename]["tmp_name"]). " telah diupload."; ?>"); </script>
					<?php
				} else {
					?>
					<script type="text/javascript"> alert("<?php echo "Maaf, terjadi error saat mengupload file anda.";?>");</script>  
					<?php
				}
			
			$sql = "UPDATE tb_detail_absen SET foto_lokasi = '$file' WHERE id_anggota = '$_SESSION[id_anggota]' AND tanggal=CURRENT_DATE()";
			$res = mysqli_query($conn, $sql);    
	
			if (!$res) {
					printf("Error: %s\n", mysqli_error($conn));
					exit();
					echo "tes";
					} 
			}
		}
	}
	function	topupCredit($conn,$id,$stat){
		//jika hadir dikantor atau diluar kantor topup credit
		if($stat==1 || $stat==2 || $stat=5){
			$query2= "UPDATE tb_credits_anggota SET total_credit=total_credit + topup_credit WHERE id_anggota='$id'";
			$update = mysqli_query($conn, $query2);
			if (!$update) {
				printf("Error: %s\n", mysqli_error($koneksi));
				exit();
			}
		}

	}
	//Haversine Formula hitung jarak dari dua lat lng
	function getDistance2($latitude1, $longitude1, $latitude2, $longitude2) {  
        $earth_radius = 6371;  
          
        $dLat = deg2rad($latitude2 - $latitude1);  
        $dLon = deg2rad($longitude2 - $longitude1);  
          
        $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($dLon/2) * sin($dLon/2);  
        $c = 2 * asin(sqrt($a));  
        $d = $earth_radius * $c;  
          
        return $d;  
	}
	//  Vincenty formula to calculate great circle distance between 2 locations
	function getDistance($lat1,$lon1,$lat2,$lon2){ 
		$a = 6378137 - 21 * sin(lat); 
		$b = 6356752.3142; 
		$f = 1/298.257223563; 

		$p1_lat = $lat1/57.29577951; 
		$p2_lat = $lat2/57.29577951; 
		$p1_lon = $lon1/57.29577951; 
		$p2_lon = $lon2/57.29577951; 

		$L = $p2_lon - $p1_lon; 

		$U1 = atan((1-$f) * tan($p1_lat)); 
		$U2 = atan((1-$f) * tan($p2_lat)); 

		$sinU1 = sin($U1); 
		$cosU1 = cos($U1); 
		$sinU2 = sin($U2); 
		$cosU2 = cos($U2); 

		$lambda = $L; 
		$lambdaP = 2*PI; 
		$iterLimit = 20; 

		while(abs($lambda-$lambdaP) > 1e-12 && $iterLimit>0) { 
			$sinLambda = sin($lambda); 
			$cosLambda = cos($lambda); 
			$sinSigma = sqrt(($cosU2*$sinLambda) * ($cosU2*$sinLambda) + ($cosU1*$sinU2-$sinU1*$cosU2*$cosLambda) * ($cosU1*$sinU2-$sinU1*$cosU2*$cosLambda)); 

			//if ($sinSigma==0){return 0;}  // co-incident points 
			$cosSigma = $sinU1*$sinU2 + $cosU1*$cosU2*$cosLambda; 
			$sigma = atan2($sinSigma, $cosSigma); 
			$alpha = asin($cosU1 * $cosU2 * $sinLambda / $sinSigma); 
			$cosSqAlpha = cos($alpha) * cos($alpha); 
			$cos2SigmaM = $cosSigma - 2*$sinU1*$sinU2/$cosSqAlpha; 
			$C = $f/16*$cosSqAlpha*(4+$f*(4-3*$cosSqAlpha)); 
			$lambdaP = $lambda; 
			$lambda = $L + (1-$C) * $f * sin($alpha) * ($sigma + $C*$sinSigma*($cos2SigmaM+$C*$cosSigma*(-1+2*$cos2SigmaM*$cos2SigmaM))); 
		} 

			$uSq = $cosSqAlpha*($a*$a-$b*$b)/($b*$b); 
			$A = 1 + $uSq/16384*(4096+$uSq*(-768+$uSq*(320-175*$uSq))); 
			$B = $uSq/1024 * (256+$uSq*(-128+$uSq*(74-47*$uSq))); 

			$deltaSigma = $B*$sinSigma*($cos2SigmaM+$B/4*($cosSigma*(-1+2*$cos2SigmaM*$cos2SigmaM)- $B/6*$cos2SigmaM*(-3+4*$sinSigma*$sinSigma)*(-3+4*$cos2SigmaM*$cos2SigmaM))); 

			$s = $b*$A*($sigma-$deltaSigma); 
			return $s; 
		} 
?>
<script>alert("Absen berhasil");document.location.href="../../index.php?sidebar-menu=list_data_absensi&action=tampil" </script>