<?php
	include "../../fungsi_kakatu.php";
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	session_start();
	prosesPaidCredit($_SESSION["id_anggota_credit"]);
?>
  	<script type="text/javascript">
	alert("Status dengan ID <?php echo $id_anggota ?>, berhasil diubah");
	document.location.href="../../tampil/data-credits" 
	</script>