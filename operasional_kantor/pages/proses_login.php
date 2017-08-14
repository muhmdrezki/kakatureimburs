<?php
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	session_start();
	include "../con_db.php";

	$id= $_POST['id'];
	$password=$_POST['password'];

	if($id==''){
		?>
		<script type="text/javascript">
			alert('Isi ID untuk Login');
			window.open('login.php','_self');
		</script>
		<?php
	} else if ($password==''){
		?>
		<script type="text/javascript">
			alert('Isi password untuk login !');
			window.open('login.php','_self');
		</script>
		<?php
	} else {

	$query = "SELECT tb_anggota.id_anggota, tb_anggota.password, tb_anggota.nama, GROUP_CONCAT(tb_jabatan.jabatan SEPARATOR ', ') as 'jabatan' FROM `tb_anggota` JOIN jabatan_anggota ON tb_anggota.id_anggota = jabatan_anggota.id_anggota JOIN tb_jabatan ON tb_jabatan.id_jabatan = jabatan_anggota.id_jabatan WHERE tb_anggota.id_anggota = '$id' AND tb_anggota.password = '$password' GROUP BY tb_anggota.id_anggota";

	 $result = mysqli_query($koneksi,$query);

	 $values = mysqli_fetch_assoc($result);
	 $nama = $values['nama'];
	 $jabatan = $values['jabatan'];
	 $id_anggota = $values['id_anggota'];
	
	$_SESSION["nama"] = $nama;
	$_SESSION["jabatan"] = $jabatan;
	$_SESSION["id_anggota"] = $id_anggota;

	 $count = mysqli_num_rows($result);
		if($count>0) {
				?>
				<script type="text/javascript">
					alert('Login Berhasil ! Welcome <?php echo $jabatan; ?>');
					document.location.href="../index.php?sidebar-menu=home&action=tampil"
				</script>
				<?php
		} else {
				?>
				<script type="text/javascript">
					alert('Login Gagal !');
					window.open('login.php','_self');
				</script>
				<?php		
		}
	}
?>