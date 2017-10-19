   <?php  
     error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
      $output = '';  
      include "../../con_db.php";

      $id = $_POST['id'];

      $query = "SELECT * FROM tb_credits_anggota WHERE id = '$id'";  
      $result = mysqli_query($koneksi, $query);  
      $output .= ' 

      <br>
           <table class="table table-hover table-responsive">';
      $topupcredit = 0;
      $id_anggota="";
      while($row = mysqli_fetch_array($result)) 
      {  
         $id_anggota=$row['id_anggota'];
         $topupcredit = $row['topup_credit'];
         $total_credit = number_format($row['total_credit']);
           $output .= '
                <tbody>
                <tr>  
                     <td width="30%"><label>ID</label></td>  
                     <td width="30%">'.$row["id"].'</td> 
                </tr>
                <tr>  
                      <td width="30%"><label>ID Anggota</label></td>  
                      <td width="30%">'.$id_anggota.'</td> 
                </tr>
                <tr>  
                  <td width="30%"><label>Status</label></td>  
                  <td width="30%"><span class=\'label label-danger\'>'.strtoupper($row['status']).'</span></td> 
                </tr>
                <tr>  
                  <td width="30%"><label>Tanggal</label></td>  
                  <td width="30%">'.$row["tanggal_set"].'</td> 
                </tr>
                <tr>     
                     <td width="40%"><label>Total Akomodasi</label></td>  
                     <td width="40%">'.$row["total_credit"].'</td>  
                </tr>
                </tbody>
           ';  
      }  
      $output .= '  
           </table>   
      ';  
      session_start();
      $_SESSION["idcredit"] = $id;
      $_SESSION["id_anggota_credit"]= $id_anggota; 
      $_SESSION["topup_credit"]=$topupcredit;
      echo $output;   
 ?>