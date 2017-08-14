<?php

	$db_host = "localhost";
	$db_user = "root";
	$db_pass = "";
	$db_name = "db_operasional-kantor";

	$koneksi = mysqli_connect($db_host, $db_user, $db_pass);
	$find_db = mysqli_select_db($koneksi, $db_name);
	
?>