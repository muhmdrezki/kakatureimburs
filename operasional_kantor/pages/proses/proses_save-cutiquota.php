<?php
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	session_start();
	$nama = $_SESSION["nama"];
	if($_SESSION["nama"]==''){
		?>
		<script>
		alert('Anda Belum Login, Silahkan Login dulu');
		window.open('forms/form_login.php','_self');
		</script>
		<?php
	} 
	if(isset($_POST['submit_cuti'])){
	include "../../con_db.php"; //sambung ke database

	//mengambil nilai dari form
	$id = $_POST['id_anggota1'];
	$quota = $_POST['quota_cuti1'];
	//$total_credit = str_replace(',', '', $nominal2);
	//query untuk memasukan ke database
		$query = "INSERT INTO tb_cuti_anggota (id_anggota, cuti_qty) VALUES ('$id', $quota)";
		$insert = mysqli_query($koneksi, $query);
	if (!$insert) {
        printf("Error: %s\n", mysqli_error($koneksi));
        exit();
    } 


?>
<script> alert("Data Cuti Berhasil Disimpan"); document.location.href="../../index.php?sidebar-menu=list_data_cuti&action=tampil" </script>
<?php
}
?>