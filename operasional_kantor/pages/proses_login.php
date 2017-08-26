<?php
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	session_start();
	include "../con_db.php";

	$id= $_POST['id'];
	$password=$_POST['password'];

	$query = "SELECT tb_anggota.id_anggota, tb_anggota.password, tb_anggota.nama, GROUP_CONCAT(tb_jabatan.jabatan SEPARATOR ', ') as 'jabatan', tb_anggota.email FROM `tb_anggota` JOIN jabatan_anggota ON tb_anggota.id_anggota = jabatan_anggota.id_anggota JOIN tb_jabatan ON tb_jabatan.id_jabatan = jabatan_anggota.id_jabatan WHERE tb_anggota.id_anggota = '$id' AND tb_anggota.password = '$password' GROUP BY tb_anggota.id_anggota";

	 $result = mysqli_query($koneksi,$query);

	 $values = mysqli_fetch_assoc($result);
	 $nama = $values['nama'];
	 $jabatan = $values['jabatan'];
	 $id_anggota = $values['id_anggota'];
	 $email = $values['email'];

	$_SESSION["nama"] = $nama;
	$_SESSION["jabatan"] = $jabatan;
	$_SESSION["id_anggota"] = $id_anggota;
	$_SESSION["email"] = $email;
	$_SESSION["pass"] = $values['password'];

	 $count = mysqli_num_rows($result);
		if($count>0) {
				?>
				<script type="text/javascript">
					alert('Login Berhasil ! Welcome <?php echo $nama; ?>');
					document.location.href="../index.php?sidebar-menu=home&action=tampil"
				</script>
				<?php
		} else {
				?>
				<script type="text/javascript">
					alert('ID dan Password Anda Tidak Cocok !');
					window.open('form_login.php','_self');
				</script>
				<?php		
		}
?>