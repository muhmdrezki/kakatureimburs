<?php
include "../../con_db.php";
	session_start();
	$hapusid = $_SESSION['hapusid'];

	$sql = "SELECT COUNT(*) as jumlah FROM `tb_pembayaran` WHERE status = '0' AND id_anggota = '$hapusid'";
	$result = mysqli_query($koneksi, $sql);
	$values = mysqli_fetch_assoc($result);

	$sql2 = "SELECT COUNT(*) as jumlah2 FROM `tb_pembayaran` WHERE status = '1' AND id_anggota = '$hapusid'";
	$result2 = mysqli_query($koneksi, $sql2);
	$values2 = mysqli_fetch_assoc($result2);

	if($values['jumlah']>0 || $values2['jumlah2']>0) {
		?>
			<script> alert("Anggota yang bersangkutan masih mempunyai pembayaran yang belum di konfirmasi/reimburse"); document.location.href="../../index.php?sidebar-menu=anggota&action=tampil"</script>
		<?php
	}else if($values['jumlah']==0 && $values2['jumlah2']==0){

	mysqli_query($koneksi, "DELETE FROM tb_anggota WHERE id_anggota='$hapusid'");
?>
<script> alert("Data Anggota dengan id <?php echo $hapusid ?>, Berhasil Dihapus "); document.location.href="../../index.php?sidebar-menu=anggota&action=tampil" </script>
<?php
}
?>