<?php
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));
	session_start();
	include "../../con_db.php";
	include "../../fungsi_kakatu.php";
	$id=antiInjection($_POST['id']);
	$password=antiInjection($_POST['password']);
	$password=encodeData($password);
	$query = "SELECT tb_anggota.id_anggota, tb_anggota.password, tb_anggota.nama, GROUP_CONCAT(tb_jabatan.jabatan SEPARATOR ', ') as 'jabatan', tb_anggota.email FROM `tb_anggota` JOIN jabatan_anggota ON tb_anggota.id_anggota = jabatan_anggota.id_anggota JOIN tb_jabatan ON tb_jabatan.id_jabatan = jabatan_anggota.id_jabatan WHERE tb_anggota.id_anggota = '$id' AND tb_anggota.password = '$password' GROUP BY tb_anggota.id_anggota";

	 $result = mysqli_query($koneksi,$query);

	 $values = mysqli_fetch_assoc($result);

	 $nama = $values['nama'];
	 $jabatan = $values['jabatan'];
	 $id_anggota = $values['id_anggota'];
	 $email = $values['email'];
	$pass_anggota = $values['password'];
	$_SESSION["nama"] = $nama;
	$_SESSION["jabatan"] = $jabatan;
	$_SESSION["id_anggota"] = $id_anggota;
	$_SESSION["email"] = $email;
	$_SESSION["pass"] = decodeData($pass_anggota);

	 $count = mysqli_num_rows($result);
		if($count>0) {
			header("Location: ../../index.php?sidebar-menu=home&action=tampil");
		} else {
		?>
			<script type="text/javascript">
		    	alert('Login Gagal')
			</script>
		<?php
			header("Location: ../form/form_login.php");	
		}
		?>