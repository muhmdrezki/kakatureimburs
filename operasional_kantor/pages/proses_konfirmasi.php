<?php 
include "../con_db.php";
session_start();

	$id = $_SESSION['id_pembayaran'];
	$jabatan = $_SESSION['jabatan'];
	
if($jabatan == 'Admin'){
	$sql = "UPDATE tb_konfirmasi SET konfirm_admin='OK' WHERE id_pembayaran='$id'";
	$insert = mysqli_query($koneksi, $sql);

	$update_query1 = "UPDATE tb_pembayaran SET status='menunggu' WHERE id_pembayaran='$id'";
	$insert_query1 = mysqli_query($koneksi,$update_query1);

} else if($jabatan != 'Admin'){
	$sql = "UPDATE tb_konfirmasi SET konfirm_anggota='OK' WHERE id_pembayaran='$id'";
	$insert = mysqli_query($koneksi, $sql);
}

if (!$insert) {
    printf("Error: %s\n", mysqli_error($koneksi));
    exit();
    } 

$query = "SELECT * FROM tb_konfirmasi WHERE id_pembayaran='$id'";
$result = mysqli_query($koneksi, $query);

$row = mysqli_fetch_assoc($result);

if($row['konfirm_admin']=="OK" && $row['konfirm_anggota']=="OK"){
	$update_query = "UPDATE tb_pembayaran SET status='sudah' WHERE id_pembayaran='$id'";
	$insert_query = mysqli_query($koneksi,$update_query);
	$delete_query = "DELETE FROM tb_konfirmasi WHERE id_pembayaran='$id'";
	$remove_query = mysqli_query($koneksi,$delete_query);
}

?>
<script> alert("Konifmasi Terkirim"); document.location.href="../index.php?sidebar-menu=detail&action=tampil&id=<?php echo $id; ?>" </script>