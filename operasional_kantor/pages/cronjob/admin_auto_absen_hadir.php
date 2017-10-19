<?php
	include "../../con_db.php"; //sambung ke database
	$latKantor = -6.8869112;
	$lngKantor = 107.6168524;
	autoAbsenHadir($latKantor,$lngKantor,$koneksi);
	function autoAbsenHadir($lat,$lng,$conn){
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
	
?>