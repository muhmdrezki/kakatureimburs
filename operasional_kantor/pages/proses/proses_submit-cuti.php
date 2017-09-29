<?php
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	session_start();
	$nama = $_SESSION["nama"];
	if($_SESSION["nama"]==''){
		?>
		<script>
		alert('Anda Belum Login, Silahkan Login dulu');
		window.open('pages/forms/form_login.php','_self');
		</script>
		<?php
	} 
	include "../../con_db.php"; //sambung ke database

	//mengambil nilai dari form
	$id = $_POST['id_anggota_absen'];
	//$nama = $_POST['nama'];
	//$password = $_POST['id'];
	$status_absen = $_POST['status_absen'];
	$keterangan = $_POST['keterangan_absen'];
	if($status_absen =="3"){
		$status="sakit";
	} else if($status_absen =="4"){
		$status="izin";
	} else {
		$status = "hadir";
	}

	$latitude = $_POST['latitude'];
	$longitude = $_POST['longitude'];
	//pasang parameter latitude & latitudenya terbalik
	$address = $_POST['adress'];
	//query untuk memasukan ke database
	$query = "INSERT INTO tb_absen (id_anggota, tanggal, jam_masuk, status, keterangan,latitude,longitude,alamat_lokasi)VALUES('$id',CURDATE(),TIME(CURRENT_TIMESTAMP()), '$status', '$keterangan','$latitude','$longitude','$address')";
	$insert = mysqli_query($koneksi, $query);

	if (!$insert) {
       printf("Error: %s\n", mysqli_error($koneksi));
       exit();
    }
	//jika hadir dikantor atau diluar kantor topup credit
	if($status=="hadir"){
		$query2= "UPDATE tb_credits_anggota SET total_credit=total_credit + topup_credit WHERE id_anggota='$id'";
		$insert1 = mysqli_query($koneksi, $query2);
		if (!$insert1) {
			printf("Error: %s\n", mysqli_error($koneksi));
			exit();
		}
	}
?>
<script>alert("Absen berhasil");document.location.href="../../index.php?sidebar-menu=list_data_absensi&action=tampil" </script>