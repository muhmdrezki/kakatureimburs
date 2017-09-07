<?php
if(isset($_POST["submit_csv-pembayaran"]))    
 {  
      include "../../con_db.php";
      $tanggal=date("d-m-Y");
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=Rekap Data Pembayaran Operasional Kantor '.$tanggal. '.csv');  
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
      $tanggal=date("d-m-Y");
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=Rekap Data Anggota KAKATU'.$tanggal. '.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('ID Anggota', 'Nama', 'Jabatan', 'Email', 'Alamat', 'Jenis Kelamin', 'Tempat Lahir', 'Tanggal lahir', 'Password'));  
      $query = "SELECT tb_anggota.id_anggota, tb_anggota.nama, GROUP_CONCAT(tb_jabatan.jabatan SEPARATOR ', ') as 'jabatan', tb_anggota.email, tb_anggota.alamat, tb_anggota.jenis_kelamin, tb_anggota.tempat_lahir, tb_anggota.tgl_lahir, tb_anggota.password FROM `tb_anggota` JOIN jabatan_anggota ON tb_anggota.id_anggota = jabatan_anggota.id_anggota JOIN tb_jabatan ON tb_jabatan.id_jabatan = jabatan_anggota.id_jabatan GROUP BY tb_anggota.id_anggota";  
      $result = mysqli_query($koneksi, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
}
 ?>  