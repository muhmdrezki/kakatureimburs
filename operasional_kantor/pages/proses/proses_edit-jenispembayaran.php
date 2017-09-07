 <?php  
include "../../con_db.php";
 error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

      $id = $_POST["id_jenis"];
      $jenis = $_POST["jenis"];  

           $query = "UPDATE tb_jenistransaksi SET jenis='$jenis' WHERE id_jenis='$id'";   
           
           $result =  mysqli_query($koneksi, $query);
           
           if (!$result) {
              printf("Error: %s\n", mysqli_error($koneksi));
              exit();
              } 
      ?>
      <script> alert("Data Jenis dengan ID <?php echo $id ?>, Berhasil Di Update"); document.location.href="../../index.php?sidebar-menu=list_jenis-pembayaran&action=tampil" </script>   
