<?php
if(isset($_POST["submit_csv-pembayaran"]))    
 {  
      include "../../con_db.php";
      $tanggal=date("Y-m-d");
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=Rekap_Data_Pembayaran_Operasional_Kantor_'.$tanggal.'.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('ID Pembayaran', 'Nama', 'Tanggal', 'Jenis Pembayaran', 'Nominal', 'Keterangan'));  
      $query = "SELECT tb_pembayaran.id_pembayaran,tb_anggota.nama, tb_pembayaran.tanggal, tb_jenistransaksi.jenis, tb_pembayaran.nominal, tb_pembayaran.keterangan FROM `tb_pembayaran`JOIN `tb_anggota` ON tb_pembayaran.id_anggota = tb_anggota.id_anggota JOIN tb_jenistransaksi ON tb_pembayaran.id_jenis = tb_jenistransaksi.id_jenis ORDER BY tb_pembayaran.tanggal DESC";  
      $result = mysqli_query($koneksi, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  

 } else if(isset($_POST["submit_csv-anggota"]))    

 {  
      include "../../con_db.php";
      $tanggal=date("Y-m-d");
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=Rekap_Data_Anggota_KAKATU_'.$tanggal.'.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('ID Anggota', 'Nama', 'Jabatan', 'Email', 'Alamat', 'Jenis Kelamin', 'Tempat Lahir', 'Tanggal lahir', 'Password'));  
      $query = "SELECT tb_anggota.id_anggota, tb_anggota.nama, GROUP_CONCAT(tb_jabatan.jabatan SEPARATOR ', ') as 'jabatan', tb_anggota.email, tb_anggota.alamat, tb_anggota.jenis_kelamin, tb_anggota.tempat_lahir, tb_anggota.tgl_lahir, tb_anggota.password FROM `tb_anggota` JOIN jabatan_anggota ON tb_anggota.id_anggota = jabatan_anggota.id_anggota JOIN tb_jabatan ON tb_jabatan.id_jabatan = jabatan_anggota.id_jabatan GROUP BY tb_anggota.id_anggota";  
      $result = mysqli_query($koneksi, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
} else if(isset($_POST["submit_csv-rekapabsen"])){
      include "../../con_db.php";
      $tanggal=date("Y-m-d");
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=Rekap_Data_Absensi_KAKATU_'.$tanggal.'.csv');
      $output = fopen("php://output", "w");
      session_start();
      if ((isset($_SESSION['tglfilterrekapabsen1']) && $_SESSION['tglfilterrekapabsen1'] == 1) && (isset($_SESSION['tglfilterrekapabsen2']) && $_SESSION['tglfilterrekapabsen2'] == 1)) {
            $query = "SELECT a.id_anggota,b.nama,COUNT(CASE WHEN a.status_id = 1 OR a.status_id=2 THEN 1 ELSE NULL END) AS jumhadir,COUNT(CASE WHEN a.status_id = 3 THEN 1 ELSE NULL END) AS jumsakit,COUNT(CASE WHEN a.status_id = 4 THEN 1 ELSE NULL END) AS jumizin,COUNT(CASE WHEN a.status_id = 5 THEN 1 ELSE NULL END) AS jumcuti,COUNT(CASE WHEN a.status_id = 6 THEN 1 ELSE NULL END) AS jumalpha AS totcredit FROM tb_detail_absen a JOIN tb_anggota b ON a.id_anggota=b.id_anggota  WHERE DATE(a.tanggal) BETWEEN STR_TO_DATE('$_SESSION[tglfilterrekapabsen1]', '%m/%d/%Y') AND STR_TO_DATE('$_SESSION[tglfilterrekapabsen2]', '%m/%d/%Y') GROUP BY a.id_anggota";
            unset($_SESSION["tglfilterrekapabsen1"]);
            unset($_SESSION["tglfilterrekapabsen2"]);
      } else {
            $query = "SELECT a.id_anggota,b.nama,COUNT(CASE WHEN a.status_id = 1 OR a.status_id=2 THEN 1 ELSE NULL END) AS jumhadir,COUNT(CASE WHEN a.status_id = 3 THEN 1 ELSE NULL END) AS jumsakit,COUNT(CASE WHEN a.status_id = 4 THEN 1 ELSE NULL END) AS jumizin,COUNT(CASE WHEN a.status_id = 5 THEN 1 ELSE NULL END) AS jumcuti,COUNT(CASE WHEN a.status_id = 6 THEN 1 ELSE NULL END) AS jumalpha FROM tb_detail_absen a JOIN tb_anggota b ON a.id_anggota=b.id_anggota WHERE MONTH(a.tanggal)=MONTH(CURRENT_DATE()) AND YEAR(tanggal)=YEAR(CURRENT_DATE()) GROUP BY a.id_anggota";
      }
      fputcsv($output, array('ID Anggota','Nama', 'Jumlah Hadir', 'Jumlah Sakit', 'Jumlah Izin', 'Jumlah Cuti', 'Jumlah Alpha'));
      $result = mysqli_query($koneksi, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row); 
      }  
      fclose($output);  
}  
 ?> 