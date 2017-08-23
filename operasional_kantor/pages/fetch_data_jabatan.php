   <?php  
     error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
      $output = '';  
      include "../con_db.php";

      $query = "SELECT * FROM tb_jabatan";  
      $result = mysqli_query($koneksi, $query);  
      $output .= '  
      <div class="table-responsive">  
           <table class="table table-hover" id="example3">
           <thead>
           <tr>  
                     <th width="30%"><label>ID Jabatan</label></td>  
                     <th width="40%"><label>Jabatan</label></td> 
                     <th width="30%"><label>Gaji</label></td> 
           </tr>
           </thead>';  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= ' 
                <tbody>
                <tr>  
                     <td width="30%">'.$row["id_jabatan"].'</td>  
                     <td width="40%">'.$row["jabatan"].'</td>  
                     <td width="30%">Rp. '.$row["gaji"].'</td>
                </tr>
                </tbody>
           ';  
      }  
      $output .= '  
           </table>  
      </div>  
      ';  
      echo $output;   
 ?>