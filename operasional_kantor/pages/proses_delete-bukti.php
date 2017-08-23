<?php
include "../con_db.php";

	session_start();
	$id = $_SESSION['hapusid'];
	$id_pembayaran = $_SESSION['id_pembayaran'];

	$sql_bukti = "SELECT * FROM tb_buktipembayaran WHERE id='$id'";
	$res = mysqli_query($koneksi,$sql_bukti);

	while ($r = mysqli_fetch_array($res)) {
		# code...
		$img = $r["bukti"];
	}

	unlink("../dist/fotobukti/$img");


	$sql = "DELETE FROM tb_buktipembayaran WHERE id='$id'";
	$result = mysqli_query($koneksi,$sql);

	 if (!$result) {
              printf("Error: %s\n", mysqli_error($koneksi));
              exit();
              } else {

?>
  	<script type="text/javascript">
	alert("Gambar Berhasil Dihapus ");
	document.location.href="../index.php?sidebar-menu=form_edit-pembayaran&action=tampil&id=<?php echo $id_pembayaran?>" 
	</script>
<?php 
}
?>
