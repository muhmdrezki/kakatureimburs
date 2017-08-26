<?php
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	session_start();
	$nama = $_SESSION["nama"];
	if($_SESSION["nama"]==''){
		?>
		<script>
		alert('Anda Belum Login, Silahkan Login dulu');
		window.open('login.php','_self');
		</script>
		<?php
	} 
	include "../con_db.php"; //sambung ke database

	//mengambil nilai dari form
	$id = $_POST['id'];
	$nama = $_POST['nama'];
	$email = $_POST['email'];
	$alamat = $_POST['alamat'];
	$tempat_lahir = $_POST['tempat_lahir'];
	$tanggal_lahir = $_POST['tanggal_lahir'];
	$jk = $_POST['jenis_kelamin'];
	$tgl_new_format = date("Y-m-d", strtotime($tanggal_lahir));
	$jenis_kelamin = $_POST['jenis_kelamin'];
	$password = $_POST['password'];

	//query untuk memasukan ke database
	$query = "INSERT INTO tb_anggota (id_anggota, nama, email, alamat, tempat_lahir, tgl_lahir, jenis_kelamin, password, foto_profile)VALUES('$id', '$nama', '$email', '$alamat', '$tempat_lahir', '$tgl_new_format' , '$jenis_kelamin',  '$password','-')";
	$insert = mysqli_query($koneksi, $query);



	$jabatan = $_POST['jabatan'];
	if($jabatan){

	foreach ($jabatan as $value_jabatan) {
		mysqli_query($koneksi, "INSERT INTO jabatan_anggota (id_anggota, id_jabatan) VALUES ('$id','".mysqli_real_escape_string($koneksi, $value_jabatan)."')");
	}
}
?>
<script> alert("Data Anggota Berhasil Disimpan"); document.location.href="../index.php?sidebar-menu=anggota&action=tampil" </script>