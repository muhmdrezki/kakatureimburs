<?php
	include("../../vendor/autoload.php");
	use ElephantIO\Client;
	use ElephantIO\Engine\SocketIO\Version2X;
	//Fungsi buat filter form dari XSS dan SQL Injection attack
	function antiInjection($post_get){
		include "../../con_db.php";
		$post_get=mysqli_real_escape_string($koneksi,$post_get);
		$post_get=htmlspecialchars($post_get);
		return $post_get;
	}

	//List Fungsi Submit Absensi
		//fungsi ambil alamat dari lattitude
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

		//fungsi submit absensi
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
			
			//Emit Data dengan Socket IO
			emitData();
			
		}

		//fungsi mendapatkan status absen
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
				//$queryCuti= "UPDATE tb_cuti_anggota SET cuti_used=(cuti_used +DATEDIFF(STR_TO_DATE('$tgl2', '%m/%d/%Y'),STR_TO_DATE('$tgl1', '%m/%d/%Y'))+1) WHERE id_anggota='$id'";
				$queryCuti= "UPDATE tb_cuti_anggota SET cuti_used=(cuti_used +1) WHERE id_anggota='$id'";
				$updateCuti = mysqli_query($conn, $queryCuti);
				//$printf($updateCuti);
				if (!$updateCuti) {
					printf("Error: %s\n", mysqli_error($conn));
					exit();
				} else {
					$sql3 = "SELECT cuti_used,cuti_qty FROM tb_cuti_anggota WHERE id_anggota ='$_SESSION[id_anggota]' ";
					$result3=mysqli_query($conn, $sql3);
					$values3=mysqli_fetch_assoc($result3);
					$jumlah3= $values3['cuti_qty'] - $values3['cuti_used'];
					$_SESSION['sisacuti']=$jumlah3;
				}
			}
		}

		//FUngsi Upload satu gambar
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
						} 
				}
			}
		}

		//Fungsi tambah credit atau uang akomodasi
		function	topupCredit($conn,$id,$stat){
			//jika hadir dikantor atau diluar kantor topup credit
			if($stat==1 || $stat==2 || $stat=5){
				$query2= "UPDATE tb_credits_anggota SET total_credit=total_credit + topup_credit WHERE id_anggota='$id' AND status='unpaid' AND MONTH(tanggal_set)=MONTH(CURRENT_DATE()) AND YEAR(tanggal_set)=YEAR(CURRENT_DATE())";
				$update = mysqli_query($conn, $query2);
				if (!$update) {
					printf("Error: %s\n", mysqli_error($koneksi));
					exit();
				}
			}
	
		}


		//Fungsi Haversine Formula hitung jarak dari dua lat lng
		function getDistance2($latitude1, $longitude1, $latitude2, $longitude2) {  
			$earth_radius = 6371;  
			  
			$dLat = deg2rad($latitude2 - $latitude1);  
			$dLon = deg2rad($longitude2 - $longitude1);  
			  
			$a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($dLon/2) * sin($dLon/2);  
			$c = 2 * asin(sqrt($a));  
			$d = $earth_radius * $c;  
			  
			return $d;  
		}

		
		// Fungsi jarak Vincenty formula to calculate great circle distance between 2 locations
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

			//fungsi untuk mengemit data darri SocketIO
			function emitData(){
				//Socket IO mulai
				 $version = new Version2X("https://localhost:3000", ['context' => ['ssl' => ['verify_peer_name' =>false, 'verify_peer' => false]]]);
				 $client = new Client($version);
				 $client->initialize();
				 $masuk=array("Submit");
				 $client->emit("submit_baru",$masuk);
				 $client->close();
			}
	//End List Fungsi Submit Absensi
	//CronJob Fungsi
	function autoAbsenHadir($lat,$lng,$conn,$tgl_skrg){
		$SELECTLIBUR2 = "SELECT tglawal,tglakhir FROM tb_tgllibur WHERE tglawal<='$tgl_skrg' AND tglakhir>='$tgl_skrg'";
		$reslibur2=mysqli_query($conn, $SELECTLIBUR2);
		if (!$reslibur2) {
			printf("Error: %s\n", mysqli_error($conn));
			exit();
		}	
		if(mysqli_num_rows($reslibur2)!=0){
			$address = getAddress($lat, $lng);
			$address = $address?$address:'Tidak Ketemu';
			$select="SELECT id_anggota FROM tb_anggota";
			$result=mysqli_query($conn,$select);
			if (!$result) {
				printf("Error: %s\n", mysqli_error($conn));
				exit();
			} else {
				while ($row = mysqli_fetch_array($result)){
					$query = "INSERT INTO tb_detail_absen (id_anggota, tanggal, jam_masuk,status_id,latitude,longitude,alamat_lokasi,tgl_awal,tgl_akhir) VALUES ('$row[id_anggota]', CURRENT_DATE(),CURRENT_TIME(),1,'$lat','$lng','$address',CURRENT_DATE(),CURRENT_DATE())";
					$insert = mysqli_query($conn, $query);
					if (!$insert) {
						printf("Error: %s\n", mysqli_error($conn));
						exit();
					}
					$query2= "UPDATE tb_credits_anggota SET total_credit=total_credit + topup_credit WHERE id_anggota='$row[id_anggota]'  AND status='unpaid' AND MONTH(tanggal_set)=MONTH(CURRENT_DATE()) AND YEAR(tanggal_set)=YEAR(CURRENT_DATE())";
					$update = mysqli_query($conn, $query2);
					if (!$update) {
						printf("Error: %s\n", mysqli_error($conn));
						exit();
					}
				}
			}	
		}
		
	}
		
	//functions

	//End Cronjob Fungsi
	//Enkripsi dan Dekripsi Data (Encode atau Decode)
	function getSaltKey(){
		//Tidak Boleh Diubah
		$key = "#k@KaTu_1nT3rNEt_$3H@t";
		//$key2 = "#k@KaTu_1nT3rNEt_$3H@t";
		return $key;
	}
	function encodeData($data){
		//echo "MasukEncode<br>";
		$encoded = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5(getSaltKey()), $data, MCRYPT_MODE_CBC, md5(md5(getSaltKey()))));
		return $encoded;
	}
	function decodeData($data){
		//echo "MasukDecode<br>";
		$decoded = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5(getSaltKey()), base64_decode($data), MCRYPT_MODE_CBC, md5(md5(getSaltKey()))), "\0");
		return $decoded;
	}
	//END Enkripsi dan Dekripsi Data (Encode atau Decode)
?>