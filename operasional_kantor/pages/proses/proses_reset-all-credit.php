<?php
include "../../con_db.php";
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	$sql = "UPDATE tb_credits_anggota SET status='paid' WHERE status='unpaid' AND MONTH(tanggal_set)=(MONTH(CURRENT_DATE())-1) AND YEAR(tanggal_set)=YEAR(CURRENT_DATE())";
	$result = mysqli_query($koneksi,$sql);
	 if (!$result) {
              printf("Error: %s\n", mysqli_error($koneksi));
              exit();
    } else {
		$select="SELECT id_anggota,topup_credit FROM tb_credits_anggota WHERE status='paid' AND MONTH(tanggal_set)=(MONTH(CURRENT_DATE())-1) AND YEAR(tanggal_set)=YEAR(CURRENT_DATE())";
		$result=mysqli_query($koneksi,$select);
		if (!$result) {
			printf("Error: %s\n", mysqli_error($koneksi));
			exit();
		} else {
			while ($row = mysqli_fetch_array($result)){
				$query = "INSERT INTO tb_credits_anggota (id_anggota, topup_credit,status,tanggal_set) VALUES ('$row[id_anggota]','$row[topup_credit]','unpaid',CURRENT_DATE())";
				$insert = mysqli_query($koneksi, $query);
				if (!$insert) {
					printf("Error: %s\n", mysqli_error($koneksi));
					exit();
				}
			}
		}

?>
  	<script type="text/javascript">
	alert("Semua AKOMODASI anggota telah dibayar");
	document.location.href="../../index.php?sidebar-menu=list_data_credits&action=tampil" 
	</script>
<?php 
}
?>
