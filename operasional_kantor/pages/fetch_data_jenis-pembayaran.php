   <?php  
     error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
      $output = '';  
      include "../con_db.php";

      $query = "SELECT * FROM tb_jenistransaksi";  
      $result = mysqli_query($koneksi, $query);  
      $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">
           <tr>  
                     <th width="30%"><label>ID Jenis</label></td>  
                     <th width="70%"><label>Jenis Pembayaran</label></td>  
           </tr>';  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= ' 
                <tr>  
                     <td width="30%">'.$row["id_jenis"].'</td>  
                     <td width="70%">'.$row["jenis"].'</td>  
                </tr>
           ';  
      }  
      $output .= '  
           </table>  
      </div>  
      ';  
      echo $output;   
 ?>