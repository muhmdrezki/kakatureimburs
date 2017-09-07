<?php
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	session_start();
	$nama = $_SESSION["nama"];
	if($_SESSION["nama"]==''){
		?>
		<script>
		alert('Anda Belum Login, Silahkan Login dulu');
		window.open('pages/forms/form_login.php','_self');
		</script>
		<?php
	} 
	include "../../con_db.php"; //sambung ke database


     $tgl_new_format = date("Y-m-d H:i:s");

	//mengambil nilai dari form
	$id = $_POST['id_pembayaran'];
	$id_anggota = $_POST['id_anggota'];
	$jenis = $_POST['jenis'];
	$jumlah = $_POST['nominal'];
	$decimal = str_replace(',','',$jumlah);
	$repRp = str_replace('Rp ','',$decimal);
	$nominal = str_replace('.00','',$repRp);
	$keterangan = $_POST['keterangan'];

	//query untuk memasukan ke database
	$query = "INSERT INTO tb_pembayaran VALUES ('$id', '$id_anggota', '$tgl_new_format', '$jenis', '$nominal', '$keterangan', '0' )";
	$insert = mysqli_query($koneksi, $query);

	$query2 = "INSERT INTO tb_konfirmasi (id_pembayaran, id_anggota, konfirm_anggota, konfirm_admin) VALUES ('$id','$id_anggota','0','0')";
	$insert2 = mysqli_query($koneksi, $query2);

	$target_dir = "../../dist/fotobukti/";
	$target_file = $target_dir . basename($_FILES["bukti"]["name"]);
	$filename = basename($_FILES["bukti"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    $check = getimagesize($_FILES["bukti"]["tmp_name"]);
    if($check !== false) {
        	// Check if file already exists
	if (file_exists($target_file)) {
		?>
	    <script> alert("<?php echo "Sorry, file already exists."; ?>"); </script>
	    <?php 
	    $uploadOk = 0;
	}
	// Check file size
	if ($_FILES["bukti"]["size"] > 2000000) {
	    ?>
	    <script> alert("<?php echo "Sorry, your file is too large.";?>"); </script>
	    <?php
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		?>
	    <script type="text/javascript"> alert("<?php echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed."; ?>");</script> 
	    <?php
	    $uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		?>
	    <script type="text/javascript"> alert("<?php echo "Sorry, your file was not uploaded."; ?>");</script>  
		<?php
	// if everything is ok, try to upload file
	} else {
	    if (move_uploaded_file($_FILES["bukti"]["tmp_name"], $target_file)) {
	    	?>
	         <script type="text/javascript"> alert(" <?php  echo "The file ". basename( $_FILES["bukti"]["name"]). " has been uploaded."; ?>"); </script>
	    	<?php
	    } else {
	    	?>
	        <script type="text/javascript"> alert("<?php echo "Sorry, there was an error uploading your file.";?>");</script>  
	        <?php
	    }

	
	$sql = "INSERT INTO tb_buktipembayaran (id_pembayaran, bukti) VALUES ('$id','$filename')";
	$result = mysqli_query($koneksi,$sql);

	 if (!$result) {
              printf("Error: %s\n", mysqli_error($koneksi));
              exit();
              } 
	}

	include "../../phpmailer/anggota_send.php";

	$sql_c = "DELETE FROM tb_buktipembayaran WHERE bukti = ''";
	mysqli_query($koneksi,$sql_c);

	?>
	<script> alert("Pembayaran Berhasil"); document.location.href="../../index.php?sidebar-menu=list_bayar&action=tampil" </script> 
	<?php

    } else {
        include "../../phpmailer/anggota_send.php";

    $sql_c = "DELETE FROM tb_buktipembayaran WHERE bukti = ''";
	mysqli_query($koneksi,$sql_c);    

	?>
	<script> alert("Pembayaran Berhasil"); document.location.href="../../index.php?sidebar-menu=list_bayar&action=tampil" </script> 
    }
<?php } ?>