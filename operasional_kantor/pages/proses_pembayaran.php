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
	$jumlah = $_POST['nominal'];
	$decimal = str_replace(',','',$jumlah);
	$nominal = str_replace('.00','',$decimal);
	$keterangan = $_POST['keterangan'];

	//query untuk memasukan ke database
	$query = "INSERT INTO tb_pembayaran VALUES ('$id', '$id_anggota', '$tgl_new_format', '$jenis', '$nominal', '$keterangan', '0' )";
	$insert = mysqli_query($koneksi, $query);

	$query2 = "INSERT INTO tb_konfirmasi (id_pembayaran, id_anggota, konfirm_anggota, konfirm_admin) VALUES ('$id','$id_anggota','0','0')";
	$insert2 = mysqli_query($koneksi, $query2);

	for($i = 0; $i < count($_FILES['bukti']['name']); $i++)
	{
		$filetmp = $_FILES["bukti"]["tmp_name"][$i];
		$filename = $_FILES["bukti"]["name"][$i];
		$filetype = $_FILES["bukti"]["type"][$i];
		$filepath = "../dist/fotobukti/" . basename($filename);

	
	move_uploaded_file($filetmp,$filepath);
	
	$sql = "INSERT INTO tb_buktipembayaran (id_pembayaran, bukti) VALUES ('$id','$filename')";
	$result = mysqli_query($koneksi,$sql);

	 if (!$result) {
              printf("Error: %s\n", mysqli_error($koneksi));
              exit();
              } 
	}


include "../phpmailer/anggota_send.php";

?>
<script> alert("Pembayaran Berhasil"); document.location.href="../index.php?sidebar-menu=list_bayar&action=tampil" </script> 
