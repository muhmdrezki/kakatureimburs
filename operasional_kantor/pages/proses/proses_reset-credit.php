<?php
include "../../con_db.php";
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	session_start();
	$id = $_SESSION['idcredit'];

	$sql = "UPDATE tb_credits_anggota SET total_credit=0 WHERE id_anggota='$id'";
	$result = mysqli_query($koneksi,$sql);

	 if (!$result) {
              printf("Error: %s\n", mysqli_error($koneksi));
              exit();
              } else {

?>
  	<script type="text/javascript">
	alert("Total credit dengan ID <?php echo $id ?>, berhasil direset");
	document.location.href="../../index.php?sidebar-menu=list_data_credits&action=tampil" 
	</script>
<?php 
}
?>
