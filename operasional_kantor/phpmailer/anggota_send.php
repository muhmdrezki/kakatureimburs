<?php
	$id_pembayaran = $_SESSION['id_pembayaran'];

	$sql = "SELECT jenis FROM tb_jenistransaksi WHERE id_jenis = '$jenis'";

	$result=mysqli_query($koneksi,$sql);

	 if (!$result) {
              printf("Error: %s\n", mysqli_error($koneksi));
              exit();
              } 

	$value=mysqli_fetch_assoc($result);

	$email = $_SESSION['email'];
	$pass = $_SESSION['pass'];

	$nama = $_SESSION['nama'];

	require 'PHPMailerAutoload.php';

	$mail = new PHPMailer;

	//$mail->SMTPDebug = 3;                               // Enable verbose debug output

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = $email;    // SMTP username
	$mail->Password = $pass;                         // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                                    // TCP port to connect to

	$mail->setFrom($email,$nama);



	$mail->addAddress('operasionalkantorkp@gmail.com');     // Add a recipient
	
	//$mail->addReplyTo('info@example.com', 'Information');

	//$mail->addCC('cc@example.com');
	//$mail->addBCC('bcc@example.com');

	//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

	$mail->isHTML(true);                                  // Set email format to HTML

	$mail->Subject = "NEW REIMBURSE (ID Pembayaran: $id, Perihal : $value[jenis])";
	$mail->Body    = "Admin, <br><br>
	Saya baru saja <b> $value[jenis]</b> dengan ID Pembayaran <b>$id</b> , tanggal <b>$tgl_new_format</b>. Sebesar <b>Rp.$nominal</b>. Mohon segera di Reimburse. <br><br>
	Regards, <br>
	$nama
	";
	
	//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if(!$mail->send()) {
			?>
			<script type="text/javascript">
		    alert('Gagal Mengirim Email Konfirmasi.'. $mail->ErrorInfo);
			</script>
			<?php
		} else {
			?>
			<script type="text/javascript">
		    alert('Email Konfirmasi Terkirim');
			</script>
			<?php
		}
?>