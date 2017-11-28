<?php
chdir(dirname(__FILE__));
include "../../con_db.php";
include "../../fungsi_kakatu.php";
//$sql = "SELECT tb_pembayaran.id_pembayaran, tb_anggota.id_anggota, tb_anggota.nama, tb_pembayaran.tanggal, tb_jenistransaksi.id_jenis, tb_jenistransaksi.jenis, tb_pembayaran.nominal, tb_pembayaran.keterangan, tb_pembayaran.status, tb_anggota.email FROM `tb_pembayaran`JOIN `tb_anggota` ON tb_pembayaran.id_anggota = tb_anggota.id_anggota JOIN tb_jenistransaksi ON tb_pembayaran.id_jenis = tb_jenistransaksi.id_jenis WHERE tb_pembayaran.id_pembayaran='$id_pembayaran'";
$sql = "SELECT nama,email,jenis_kelamin FROM tb_anggota WHERE id_anggota NOT IN (SELECT id_anggota FROM tb_detail_absen WHERE tanggal=CURRENT_DATE())";
$result = mysqli_query($koneksi, $sql);

if (!$result) {
    printf("Error: %s\n", mysqli_error($koneksi));
    exit();
}

date_default_timezone_set('Asia/Jakarta');
$tgl_now_absen = date("Y-m-d");
$day = date('j', strtotime($tgl_now_absen));
$month = date('F', strtotime($tgl_now_absen));
$year = date('Y', strtotime($tgl_now_absen));
$dayname = date('D', strtotime($tgl_now_absen));
$timenow = date("h:ia");
if ($dayname == "Mon") {
    $dayname = "Senin";
} elseif ($dayname == "Tue") {
    $dayname = "Selasa";
} elseif ($dayname == "Wed") {
    $dayname = "Rabu";
} elseif ($dayname == "Thu") {
    $dayname = "Kamis";
} elseif ($dayname == "Fri") {
    $dayname = "Jumat";
} elseif ($dayname == "Sat") {
    $dayname = "Sabtu";
} elseif ($dayname == "Sun") {
    $dayname = "Minggu";
}

if ($dayname != "Sat" && $dayname != "Sun") {
    $SELECTLIBUR3 = "SELECT tglawal,tglakhir FROM tb_tgllibur WHERE tglawal<='$tgl_now_absen' AND tglakhir>='$tgl_now_absen'";
    $reslibur3 = mysqli_query($koneksi, $SELECTLIBUR3);
    if (!$reslibur3) {
        printf("Error: %s\n", mysqli_error($koneksi));
        exit();
    }
    if (mysqli_num_rows($reslibur3) == 0) {
        //echo "Masuk";
        require '../../phpmailer/PHPMailerAutoload.php';
        $mail = new PHPMailer;

        //$mail->SMTPDebug = 3;                               // Enable verbose debug output

        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
        $mail->SMTPAuth = true; // Enable SMTP authentication
        //$mail->Username = 'operasionalkantorkp@gmail.com';    // SMTP username
        //$mail->Password = 'kiwikiwi12';
        $mail->Username = getLastConfig("email_admin"); // SMTP username
        $mail->Password = getLastConfig("pass_email"); // SMTP password
        $mail->SMTPSecure = 'ssl'; // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465; // TCP port to connect to

        $mail->setFrom('kakatukantor123@gmail.com', 'Admin');
		//echo "masuk";
        $mail->isHTML(true);
        while ($row = mysqli_fetch_array($result)) {
			//echo "masuk1";
            $mail->ClearAllRecipients();
            $mail->addAddress($row['email'], $row['nama']); // Add a recipient
            $mail->Subject = "Reminder: Yuk isi absen," . $row['nama'];
            if ($row['jenis_kelamin'] = "L") {
				//echo "masuk2";
                $mail->Body = "Bro, " . $row['nama'] . ". <br><br>
						Kamu belum isi absensi hari ini sampai jam <b>" . $timenow . "</b><br><br>
						Kuy, <br>
						Admin
						";
            } else {
				//echo "masuk3";
                $mail->Body = "Sis, " . $row['nama'] . ". <br><br>
						Kamu belum absen hari ini sampai jam <b>" . $timenow . "</b><br><br>
						Kuy, <br>
						Admin
						";
            }

            if (!$mail->send()) {
				echo 'Gagal Mengirim Email Konfirmasi.'. $mail->ErrorInfo;
            }
        }
    }
}
