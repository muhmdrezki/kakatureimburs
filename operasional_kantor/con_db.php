<?php

	$db_host = "localhost";
	$db_user = "kakatuco";
	$db_pass = "kinest01kakatu04";
	$db_name = "kakatuco_absensi";

	$koneksi = mysqli_connect($db_host, $db_user, $db_pass);
	$find_db = mysqli_select_db($koneksi, $db_name);
	
?>