<?php
include "../../con_db.php";
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	$sql = "UPDATE tb_cuti_anggota SET cuti_used=0";
	$result = mysqli_query($koneksi,$sql);
	 if (!$result) {
              printf("Error: %s\n", mysqli_error($koneksi));
              exit();
              } else {

?>
  	<script type="text/javascript">
	alert("Semua Data cuti used anggota, berhasil direset");
	document.location.href="../../index.php?sidebar-menu=list_data_cuti&action=tampil" 
	</script>
<?php 
}
?>
