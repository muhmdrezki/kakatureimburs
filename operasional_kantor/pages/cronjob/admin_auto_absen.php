<?php
	chdir(dirname(__FILE__));
	include "../../fungsi_kakatu.php";
	date_default_timezone_set('Asia/Jakarta');
	$tgl_now = date("Y-m-d");
	$tgl_now2 = date("m-d");
	$dayname = date('D', strtotime($tgl_now));
	$latKantor = -6.8869112;
	$lngKantor = 107.6168524;
	$errmsg=null;
	if($dayname!="Sat" && $dayname!="Sun"){
		autoAbsen($latKantor,$lngKantor,$tgl_now,$errmsg);
		echo $errmsg;
		//Emit Data dengan Socket IO
		emitData();
	}
	//Reset Cuti jika 31 desember
	if($tgl_now2=="12-31"){
		$qry = "UPDATE tb_cuti_anggota SET cuti_used=0";
		inUpDel($qry,$errmsg);
		if ($errmsg!==null) {
			echo "Error: ".$errmsg;
		}
	}
?>