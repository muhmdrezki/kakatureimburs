<?php
	include "../../con_db.php"; //sambung ke database
	include "../../fungsi_kakatu.php";
	date_default_timezone_set('Asia/Jakarta');
	$tgl_now = date("Y-m-d");
	
	$day = date('j', strtotime($tgl_now));
	$month = date('F', strtotime($tgl_now));
	$year = date('Y', strtotime($tgl_now));
	$dayname = date('D', strtotime($tgl_now));
	$timenow = date("h:i:sa");
	$latKantor = -6.8869112;
	$lngKantor = 107.6168524;
	
	if($dayname!="Sat" && $dayname!="Sun"){
		autoAbsenHadir($latKantor,$lngKantor,$koneksi,$tgl_now);
	}
?>