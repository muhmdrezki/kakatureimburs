 <?php  
include "../../con_db.php";
 error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

      $id = $_POST["id_anggota"];
      $nominal= $_POST["topup_credit"];
      $nominal1 = str_replace(',', '', $nominal);
      $topup = str_replace('Rp ', '', $nominal1);

           $query = "UPDATE tb_credits_anggota SET topup_credit='$topup' WHERE id_anggota='$id'";   
           
           $result =  mysqli_query($koneksi, $query);
           
           if (!$result) {
              printf("Error: %s\n", mysqli_error($koneksi));
              exit();
              } 
      ?>
      <script> alert("Data Credit dengan ID <?php echo $id ?>, Berhasil Di Update"); document.location.href="../../index.php?sidebar-menu=list_data_credits&action=tampil" </script>   
