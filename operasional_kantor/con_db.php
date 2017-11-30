<?php

	$db_host = "localhost";
	$db_user = "debug";
	$db_pass = "M@kAn@n13";
	$db_name = "kakatuco_absensi2";

	$koneksi = mysqli_connect($db_host, $db_user, $db_pass);
	$find_db = mysqli_select_db($koneksi, $db_name);
	
?>