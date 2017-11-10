<?php  
 //fetch.php  
 include "../../fungsi_kakatu.php";
 if(isset($_POST["id_anggota"])){
     $id = antiInjection($_POST["id_anggota"]);
     fetchCreditsJSON($id);
 }
 ?>