<?php  
 //fetch.php  
 include "../con_db.php";
 if(isset($_POST["id_anggota"]))  
 {  
      $query = "SELECT * FROM tb_anggota WHERE id_anggota = '".$_POST["id_anggota"]."'";  
      $result = mysqli_query($koneksi, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>