   <?php  
     error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
      $output = '';  
      include "../../con_db.php";

      $id_anggota = $_POST['id_anggota'];

      $query = "SELECT * FROM tb_credits_anggota WHERE id_anggota = '$id_anggota'";  
      $result = mysqli_query($koneksi, $query);  
      $output .= ' 
      <label><h4>   Anda yakin akan menghapus data ini?</h4></label>
      <br>
      <br>
           <table class="table table-hover table-responsive">';  
      while($row = mysqli_fetch_array($result)) 
      {  
         $total_credit = number_format($row[total_credit]);
           $output .= '
                <tbody>
                <tr>  
                     <td width="30%"><label>ID Anggota</label></td>  
                     <td width="30%">'.$row["id_anggota"].'</td> 
                </tr>
				<tr>     
                     <td width="40%"><label>Topup Credit</label></td>  
                     <td width="40%">'.$row["topup_credit"].'</td>  
                </tr>
                <tr>     
                     <td width="40%"><label>Total Credit</label></td>  
                     <td width="40%">'.$row["total_credit"].'</td>  
                </tr>
                </tbody>
           ';  
      }  
      $output .= '  
           </table>   
      ';  
      session_start();
      $_SESSION["idcredit"] = $id_anggota;
      echo $output;   
 ?>