<?php  
 //fetch.php  
  include "../../con_db.php";
  session_start();
  date_default_timezone_set('Asia/Jakarta');	
  $tgl_now6 = date("d-m-Y");
  $year6 = date('Y', strtotime($tgl_now6));
  if ($_SESSION['jabatan'] == "Admin") {
  $sql_grafik6 = sprintf("SELECT MONTHNAME(`tanggal_set`) AS Bulan, SUM(`total_credit`) AS Total FROM `tb_credits_anggota` WHERE YEAR(`tanggal_set`) = '$year6' GROUP BY Bulan, MONTH(`tanggal_set`), YEAR(`tanggal_set`) ORDER BY Year(`tanggal_set`),MONTH(`tanggal_set`)");
  } else {
  $sql_grafik6 = sprintf("SELECT MONTHNAME(`tanggal_set`) AS Bulan, SUM(`total_credit`) AS Total FROM `tb_credits_anggota` WHERE YEAR(`tanggal_set`) = '$year6' AND id_anggota='$_SESSION[id_anggota]' GROUP BY Bulan, MONTH(`tanggal_set`), YEAR(`tanggal_set`) ORDER BY Year(`tanggal_set`),MONTH(`tanggal_set`)");  
  }
  $hasil6 = $koneksi->query($sql_grafik6);
  $error9='';
  if (!$hasil6) {
    $error9="Error: %s\n".mysqli_error($koneksi);
    exit();
  }

  $all3 = array();
  while($row6 = mysqli_fetch_array($hasil6))
  {
    $all3[]=$row6;
  }
  $data3 = json_encode($all3);
  echo  $data3;
 ?>