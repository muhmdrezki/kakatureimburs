 <?php  
include "../con_db.php";
 error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
      $id_pembayaran = $_POST["id_pembayaran"];

      for($i = 0; $i < count($_FILES['bukti']['name']); $i++)
          {
            $filetmp = $_FILES["bukti"]["tmp_name"][$i];
            $filename = $_FILES["bukti"]["name"][$i];
            $filetype = $_FILES["bukti"]["type"][$i];
            $filepath = "../dist/fotobukti/" . basename($filename);
         
          move_uploaded_file($filetmp,$filepath);
          
          $sql = "INSERT INTO `tb_buktipembayaran` (`id`, `id_pembayaran`, `bukti`) VALUES (NULL, '$id_pembayaran', '$filename');";
          $res = mysqli_query($koneksi,$sql);

           if (!$res) {
                      printf("Error: %s\n", mysqli_error($koneksi));
                      exit();
                      } 
          } 

      
      $jenis = $_POST["jenis"];  
      $nominal = $_POST["nominal"];  
      $keterangan = $_POST["keterangan"];

          $query = "UPDATE tb_pembayaran SET id_jenis='$jenis', nominal = '$nominal', keterangan = '$keterangan'   
          WHERE id_pembayaran='$id_pembayaran'";   
           
           $result =  mysqli_query($koneksi, $query);
           
           if (!$result) {
              printf("Error: %s\n", mysqli_error($koneksi));
              exit();
              }
      ?>
      <script> alert("Data Pembayaran dengan ID <?php echo $id_pembayaran ?>, Berhasil Di Update "); document.location.href="../index.php?sidebar-menu=detail&action=tampil&id=<?php echo $id_pembayaran?>" </script>   
