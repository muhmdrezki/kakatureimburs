<?php  
 //fetch.php  
 include "../../con_db.php";
 if(isset($_POST["id"]))  
 {  
      $query = "SELECT id,topup_credit FROM tb_credits_anggota WHERE id = '".$_POST["id"]."'";  
      $result = mysqli_query($koneksi, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>