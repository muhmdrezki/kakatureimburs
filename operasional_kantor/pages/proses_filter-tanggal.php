<?php
	 error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	include "../con_db.php";

	$start = $_POST['start_date'];
	$end = $_POST['end_date'];
	
	$startdate = date("Y-m-d", strtotime($start_date));
	$enddate = date("Y-m-d", strtotime($end_date));


	$sql = "SELECT tb_pembayaran.id_pembayaran, tb_anggota.nama, tb_pembayaran.id_anggota, tb_pembayaran.tanggal, tb_pembayaran.jenis, tb_pembayaran.nominal, tb_pembayaran.keterangan, tb_pembayaran.status FROM tb_pembayaran JOIN tb_anggota ON tb_pembayaran.id_anggota=tb_anggota.id_anggota WHERE tb_pembayaran.tanggal BETWEEN '$startdate' AND '$enddate'";

    $result = mysqli_query($koneksi,$sql);

?>
<script> document.location.href="../index.php?sidebar-menu=list_bayar&action=tampil" </script> 