<?php
include "../con_db.php";
	session_start();
	$pembayaranid = $_SESSION['pembayaranid'];

	$sql_bukti = "SELECT GROUP_CONCAT(bukti SEPARATOR ', ') as 'filenames' FROM tb_buktipembayaran WHERE id_pembayaran='$pembayaranid'";
	$res = mysqli_query($koneksi,$sql_bukti);

	while ($r = mysqli_fetch_array($res)) {
		# code...
		$filenames = $r["filenames"];
	}

	$removeSpaces = str_replace(" ", "", $filenames);

	$allfilenames = explode(",", $removeSpaces);

	$countAllnames = count($allfilenames);

	

	for ($i=0; $i < $countAllnames ; $i++) { 
		$path = "../dist/fotobukti/".$allfilenames[$i];
		if(file_exists( "../dist/fotobukti/".$allfilenames[$i])==false){
			exit();
		} 
	}

	for ($i=0; $i < $countAllnames ; $i++) { 
		$path = "../dist/fotobukti/".$allfilenames[$i];
		if(!unlink($path)){
			header("../index.php?error&sidebar-menu=list_bayar&action=tampil");
			exit();
		} 
	}

	 if (!$res) {
              printf("Error: %s\n", mysqli_error($koneksi));
              exit();
              } else {

	$sql = "DELETE FROM tb_pembayaran WHERE id_pembayaran='$pembayaranid'";
	$result = mysqli_query($koneksi,$sql);

?>
  	<script type="text/javascript">
	alert("Data Pembayaran dengan id <?php echo $pembayaranid ?>, Berhasil Dihapus ");
	document.location.href="../index.php?sidebar-menu=list_bayar&action=tampil" 
	</script>
<?php 
}
?>


