<?php

	$db_host = "localhost";
	$db_user = "admin";
	$db_pass = "toor";
	$db_name = "db_operasional-kantor";

	$koneksi = mysqli_connect($db_host, $db_user, $db_pass);
	$find_db = mysqli_select_db($koneksi, $db_name);
	
?>