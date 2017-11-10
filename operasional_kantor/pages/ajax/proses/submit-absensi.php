
<?php
	//Composer penggunaan library ElephantIO untuk SOCKET IO
	//error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	//session_start();
	//include "../../con_db.php"; //sambung ke database
	//include "../../fungsi_kakatu.php"; //panggil fungsi
	$id = $_SESSION["id_anggota"];
	$target_dir = "dist/fotolokasi/";
	$ukuran = 2000000;
	//mengambil nilai dari form
	$latKantor = -6.8869112;
	$lngKantor = 107.6168524;
	$status = null;
	$keterangan = null;
	$tgl_awal = null;
	$tgl_akhir = null;
	$filename = null;
	$url_location=null;
	$errmsg=null;
	$scsmsg=null;
	$latitude=null;
	$longitude=null;
	if (isset($_POST['latitude']) && !empty($_POST['latitude'])) {
		$latitude = antiInjection($_POST['latitude']);
		$longitude = antiInjection($_POST['longitude']);
		$url_location="https://maps.google.com/?q=".trim($latitude).",".trim($longitude);
		if (isset($_POST["status"])) {
			$status =$_POST["status"];
			switch ($status) {
				case '1':
					date_default_timezone_set('Asia/Jakarta');
					$tgl_awal = date("Y-m-d");
					$tgl_akhir= date("Y-m-d");
					break;
				case '2':
					if (isset($_POST['keterangan_hadirdiluar']) && !empty($_POST['keterangan_hadirdiluar'])) {
						date_default_timezone_set('Asia/Jakarta');
						$tgl_awal = date("Y-m-d");
						$tgl_akhir= date("Y-m-d");
						$keterangan = antiInjection($_POST['keterangan_hadirdiluar']);
						$filename = "image_hadirdiluar";
					} else {
						$errmsg="Keterangan Hadir Diluar tidak boleh kosong!";
					}
					break;
				case '3':
					if (isset($_POST['keterangan_sakit']) && !empty($_POST['keterangan_sakit'])) {
						if (isset($_POST['tglRentangSakit']) && !empty($_POST['tglRentangSakit'])) {
							$keterangan =antiInjection($_POST['keterangan_sakit']);
							$tgl = antiInjection($_POST['tglRentangSakit']);
							$tgl_awal = formatDateSql(substr($tglRentangSakit,0,11));
							$tgl_akhir= formatDateSql(substr($tglRentangSakit,13,25));
							$filename = "image_sakit";
						} else {
							$errmsg="Tanggal Sakit tidak boleh kosong!";
						}
					} else {
						$errmsg="Keterangan Sakit tidak boleh kosong";
					}
					break;
				case '4':
					if (isset($_POST['keterangan_izin']) && !empty($_POST['keterangan_izin'])) {
						if (isset($_POST['tglRentangIzin']) && !empty($_POST['tglRentangIzin'])) {
							$keterangan =antiInjection($_POST['keterangan_izin']);
							$tgl = antiInjection($_POST['tgl']);
							$tgl_awal = formatDateSql(substr($tglRentangIzinl,0,11));
							$tgl_akhir= formatDateSql(substr($tglRentangIzin,13,25));
							$filename = "image_izin";
						} else {
							$errmsg="Tanggal Izin tidak boleh kosong!";
						}
					} else {
						$errmsg="Keterangan Izin tidak boleh kosong";
					}
					break;
				case '5':
					if (isset($_POST['keterangan_cuti']) && !empty($_POST['keterangan_cuti'])) {
						if (isset($_POST['tglRentangCuti']) && !empty($_POST['tglRentangCuti'])) {
							$keterangan =antiInjection($_POST['keterangan_cuti']);
							$tgl = antiInjection($_POST['tgl']);
							$tgl_awal = formatDateSql(substr($tglRentangCuti,0,11));
							$tgl_akhir= formatDateSql(substr($tglRentangCuti,13,25));
							$filename = "image_cuti";
						} else {
							$errmsg="Tanggal Cuti tidak boleh kosong!";
						}
					} else {
						$errmsg="Keterangan Cuti tidak boleh kosong";
					}
					break;
			}
		} 
	} else {
		$errmsg="Anda harus mengizinkan Permintaan Lokasi untuk bisa absen";
	}
	//Ambil Jarak
	//$filename = $_FILES[$filename2]["name"];
	$distance = getDistance($latitude, $longitude,$latKantor, $lngKantor);
	if ($status=='1') {
		if( $distance < 100 ) {
			//call fungsi submit absensi
			submitAbsensi($id,$status,$keterangan,$latitude,$longitude,$tgl_awal,$tgl_akhir,$target_dir,$filename,$ukuran,$errmsg,$scsmsg);
		} else {
			$errmsg='Absen Hadir Gagal karena Anda berada '.round($distance/1000,3).'km dari kantor';
		}
	} else {
			if ($tgl_awal==$tgl_akhir) {
				//call fungsi submit absensi
				submitAbsensi($id,$status,$keterangan,$latitude,$longitude,$tgl_awal,$tgl_akhir,$target_dir,$filename,$ukuran,$errmsg,$scsmsg);
			} else {
				if ($status=='5') {
					$cutiUsed=countCuti($tgl_awal,$tgl_akhir,$koneksi);
					//echo $cutiUsed;
					if($cutiUsed<=$_SESSION['sisacuti']){
						submitAbsensi($id,$status,$keterangan,$latitude,$longitude,$tgl_awal,$tgl_akhir,$target_dir,$filename,$ukuran,$errmsg,$scsmsg);
					} else {
						$errmsg='Cuti yang digunakan '. $cutiUsed.' melebihi SISA CUTI anda!';
					}
				} else {
					submitAbsensi($id,$status,$keterangan,$latitude,$longitude,$tgl_awal,$tgl_akhir,$target_dir,$filename,$ukuran,$errmsg,$scsmsg);
				}
			}
	}
	//Pesan WA
	$pesan = array(
		'errmsg' => $errmsg,
		'scsmsg' => $scsmsg,
		'nama'	=> $_SESSION['nama'],
		'status'  => $status,
		'keterangan'  => $keterangan,
		'tgl1'  => $tgl_awal,
		'tgl2'  => $tgl_akhir,
		'sisacuti'  => $_SESSION['sisacuti']
	);
	echo json_encode($pesan);
?>
 
