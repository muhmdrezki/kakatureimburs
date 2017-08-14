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

	 $tgl_now = date("d-m-Y"); 
	 $tgl_new_format = date("Y-m-d", strtotime($tgl_now));

	//mengambil nilai dari form
	$id = $_POST['id_pembayaran'];
	$id_anggota = $_POST['id_anggota'];
	$jenis = $_POST['jenis'];
	$nominal = $_POST['nominal'];
	$keterangan = $_POST['keterangan'];

	//query untuk memasukan ke database
	$query = "INSERT INTO tb_pembayaran VALUES ('$id', '$id_anggota', '$tgl_new_format', '$jenis', '$nominal', '$keterangan', '-', '-' , '-', 'belum' )";
	$insert = mysqli_query($koneksi, $query);

	$query2 = "INSERT INTO tb_konfirmasi (id_pembayaran, id_anggota) VALUES ('$id','$id_anggota')";
	$insert2 = mysqli_query($koneksi, $query2);

?>
<script> alert("Data Berhasil Disimpan"); document.location.href="../index.php?sidebar-menu=list_bayar&action=tampil" </script> 
