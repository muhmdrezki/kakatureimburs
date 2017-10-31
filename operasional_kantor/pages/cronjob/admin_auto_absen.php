<?php
	chdir(dirname(__FILE__));
	include "../../con_db.php"; //sambung ke database
	include "../../fungsi_kakatu.php";
	date_default_timezone_set('Asia/Jakarta');
	$tgl_now = date("Y-m-d");
	$dayname = date('D', strtotime($tgl_now));
	$latKantor = -6.8869112;
	$lngKantor = 107.6168524;
	
	if($dayname!="Sat" && $dayname!="Sun"){
		autoAbsen($latKantor,$lngKantor,$koneksi,$tgl_now);
		//Emit Data dengan Socket IO
		emitData();
	}
?>