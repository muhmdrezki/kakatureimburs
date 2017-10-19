<?php
include "../../con_db.php";
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	session_start();
	$id = $_SESSION['idcredit'];
	$id_anggota = $_SESSION['id_anggota_credit'];
	$topup_credit=$_SESSION['topup_credit'];
	$sql = "UPDATE tb_credits_anggota SET status=\"paid\" WHERE id='$id'";
	$result = mysqli_query($koneksi,$sql);

	 if (!$result) {
              printf("Error: %s\n", mysqli_error($koneksi));
              exit();
			  } 
	else {
		$query = "INSERT INTO tb_credits_anggota (id_anggota, topup_credit,status,tanggal_set) VALUES ('$id_anggota', $topup_credit,'unpaid',CURRENT_DATE())";
		$insert = mysqli_query($koneksi, $query);
		if (!$insert) {
			printf("Error: %s\n", mysqli_error($koneksi));
			exit();
   		} 
?>
  	<script type="text/javascript">
	alert("Status dengan ID <?php echo $id ?>, berhasil diubah");
	document.location.href="../../index.php?sidebar-menu=list_data_credits&action=tampil" 
	</script>
<?php 
}
?>
