 <?php  
      include "../../fungsi_kakatu.php";
      error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
      //$nominal1 = str_replace(',', '', $nominal);
      //$topup = str_replace('Rp ', '', $nominal1);
      prosesEditCredit($_POST["id_anggota_credit"],$_POST["topup_credit"]);
      echo '<script>alert("Data Jumlah Akomodasi dengan ID '.$id.', Berhasil Di Update"); document.location.href="../../tampil/data-credits"</script>';
?>   
