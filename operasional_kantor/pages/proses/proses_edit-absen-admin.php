<?php  
include "../../con_db.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (isset($_POST["submit"])) {
      session_start();
      $statusid_lama=$_SESSION["status_id_absenAdminEdit"];
      $id = $_POST["id_absen"];
      $id_anggota = $_POST["id_anggota_absen"];
      $status_id = $_POST["status_id"];
      $keterangan = $_POST["keterangan_absen"];
      $tglRentang = $_POST["tglRentangAbsenAdmin"];
      $tgl1 = substr($tglRentang,0,11);
      $tgl2 = substr($tglRentang,13,25);
      if ($status_id!=1 && $status_id!=2) {
            if ($statusid_lama==1 || $statusid_lama==2) {
                  //echo "<script>alert( 'Debug Objects: Masuk1' );</script>";
                  $query2= "UPDATE tb_credits_anggota SET total_credit=(total_credit - topup_credit) WHERE id_anggota='$id_anggota'";
                  $update = mysqli_query($koneksi, $query2);
                  if (!$update) {
                        printf("Error: %s\n", mysqli_error($koneksi));
                        exit();
                  }
            }
      } else {
            //$output = ($statusid_lama!=1 && $statusid_lama!=2);
            //echo "<script>alert( 'Debug Objects: " . $output . "' );</script>";
            if ($statusid_lama!=1 && $statusid_lama!=2) {

                  //echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
                  echo "<script>console.log( 'Debug Objects: Masuk2' );</script>";
                  $query2= "UPDATE tb_credits_anggota SET total_credit=(total_credit + topup_credit) WHERE id_anggota='$id_anggota'";
                  $update = mysqli_query($koneksi, $query2);
                  if (!$update) {
                        printf("Error: %s\n", mysqli_error($koneksi));
                        exit();
                  }
            }
      }
      
      if ($status_id!=5) {
            if ($statusid_lama==5) {
                  $queryCuti= "UPDATE tb_cuti_anggota SET cuti_used=(cuti_used - DATEDIFF(STR_TO_DATE('$tgl2', '%m/%d/%Y'),STR_TO_DATE('$tgl1', '%m/%d/%Y'))+1) WHERE id_anggota='$id'";
                  $updateCuti = mysqli_query($koneksi, $queryCuti);
                  //$printf($updateCuti);
                  if (!$updateCuti) {
                        printf("Error: %s\n", mysqli_error($koneksi));
                        exit();
                  }
            }
            
      } else {
            if ($statusid_lama!=5) {
                  $queryCuti= "UPDATE tb_cuti_anggota SET cuti_used=(cuti_used + DATEDIFF(STR_TO_DATE('$tgl2', '%m/%d/%Y'),STR_TO_DATE('$tgl1', '%m/%d/%Y'))+1) WHERE id_anggota='$id'";
                  $updateCuti = mysqli_query($koneksi, $queryCuti);
                  //$printf($updateCuti);
                  if (!$updateCuti) {
                        printf("Error: %s\n", mysqli_error($koneksi));
                        exit();
                  }
            }
      }
      $query = "UPDATE tb_detail_absen SET status_id='$status_id',keterangan='$keterangan',tgl_awal=STR_TO_DATE('$tgl1', '%m/%d/%Y'),tgl_akhir=STR_TO_DATE('$tgl2', '%m/%d/%Y') WHERE id='$id'";        
      $result =  mysqli_query($koneksi, $query);
      if (!$result) {
            printf("Error: %s\n", mysqli_error($koneksi));
            exit();
      }
}
?>
<script> alert("Data Absen dengan ID <?php echo $id ?>, Berhasil Di Update"); document.location.href="../../index.php?sidebar-menu=list_data_absensi_admin&action=tampil" </script>   
