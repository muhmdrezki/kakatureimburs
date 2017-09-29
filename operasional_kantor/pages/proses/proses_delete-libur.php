<?php
include "../../con_db.php";
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	session_start();
	$id = $_SESSION['idlibur'];

	$sql = "DELETE FROM tb_tgllibur WHERE id='$id'";
	$result = mysqli_query($koneksi,$sql);

	 if (!$result) {
              printf("Error: %s\n", mysqli_error($koneksi));
              exit();
              } else {

?>
  	<script type="text/javascript">
	alert("Data tanggal libur dengan ID <?php echo $id ?>, berhasil dihapus");
	document.location.href="../../index.php?sidebar-menu=list_data_libur&action=tampil" 
	</script>
<?php 
}
?>
