 <?php  
include "../../con_db.php";
include "../../fungsi_kakatu.php";
      //error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

      $id = antiInjection($_POST["id_anggota"]);
      $nama = antiInjection($_POST["nama"]);  
      $alamat= antiInjection($_POST["alamat"]);  
      $tempat_lahir = antiInjection($_POST["tempat_lahir"]);  
      $tgl_lahir = antiInjection($_POST["tgl_lahir"]);  
      $email = antiInjection($_POST["email"]);
      $pass = antiInjection($_POST["password"]);
      $pass = encodeData($pass);

           $query = "UPDATE tb_anggota SET nama='$nama', alamat='$alamat', tempat_lahir='$tempat_lahir', tgl_lahir = '$tgl_lahir', email = '$email', password = '$pass'   
           WHERE id_anggota='$id'";   
           
           $result =  mysqli_query($koneksi, $query);
           
           if (!$result) {
              printf("Error: %s\n", mysqli_error($koneksi));
              exit();
              } 
      ?>
      <script> alert("Data Anggota Berhasil Di Update <?php echo $id ?>"); document.location.href="../../index.php?sidebar-menu=profile&action=tampil" </script>   
