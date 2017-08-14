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

	$query = "SELECT * FROM `tb_anggota` WHERE `id_anggota`= '$id' AND `password`= '$password'";

	 $result = mysqli_query($koneksi,$query);

	 $count = mysqli_num_rows($result);
		if($count>0) {
			while ($data = mysqli_fetch_array ($result)){
				$jabatan = $data['jabatan'];
				$nama = $data['nama'];
				$id_anggota = $data['id_anggota'];
				
				$_SESSION["nama"] = $nama;
				$_SESSION["jabatan"] = $jabatan;
				$_SESSION["id_anggota"] = $id_anggota;
			}
				?>
				<script type="text/javascript">
					alert('Login Berhasil !');
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