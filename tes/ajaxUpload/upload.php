<?php
//upload.php
			$tai=$_POST['tai'];
			echo "<script>alert('tes: ".$tai.")</scirpt>";
			$targetdir="upload/";
            $filename="file";
            $ukuran = 2000000;
			$target_file = $targetdir . basename($_FILES[$filename]["name"]);
            $file = basename($_FILES[$filename]["name"]);
			$errmsg=null;
			$newfilename = null;
			if (!empty($file)) {
                //$errmsg="ada isi";
				$uploadOk = 1;
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				// Check if image file is a actual image or fake image
				$check = getimagesize($_FILES[$filename]["tmp_name"]);
				if($check !== false) {
					$uploadOk = 1;
				} else {
					$uploadOk = 0;
				}
				// Check if file already exists
				/*
				if (file_exists($target_file)) {
					?>
					<script> alert("<?php echo "Maaf, file sudah ada."; ?>"); </script>
					<?php 
					$uploadOk = 0;
				}*/
				// Check file size
				if ($_FILES[$filename]["size"] > $ukuran) {
					$errmsg="Maaf, file anda terlalu besar!";
					$uploadOk = 0;
				}
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
					$errmsg="Maaf, hanya file format JPG, JPEG, PNG & GIF yang diizinkan!";
					$uploadOk = 0;
				}
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
					$errmsg="Maaf, file anda tidak terupload!";
				// if everything is ok, try to upload file
				} else {
					$namatgl = new DateTime();
					$namatgl->setTimezone(new DateTimeZone('Asia/Jakarta'));
					$namabaru= $namatgl->format('YmdHis');
					$sementara = explode(".", $_FILES[$filename]["name"]);
					$newfilename = $namabaru.'.'.end($sementara);
					if (move_uploaded_file($_FILES[$filename]["tmp_name"], $targetdir.$newfilename)) {
						 echo '<img src="'.$targetdir.$newfilename.'" height="150" width="225" class="img-thumbnail" />';
						$errmsg="File ini ". basename( $_FILES[$filename]["tmp_name"]). " telah diupload!";
					} else {
						$errmsg="Maaf, terjadi error saat mengupload file anda!";
					}
				}
			echo $errmsg;
			}
?>