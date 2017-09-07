   <?php  
     error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
     $id=$_POST["id"];
     if(isset($_POST['id'])){

      $output = '';  
      include "../../con_db.php";

      $query = "SELECT * FROM tb_absen WHERE id = '$id'";  
      $result = mysqli_query($koneksi, $query);  
      $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= ' 
           <br>
                <tr>
                      <th colspan="2" style="text-align: center;"> <label> Waktu Kehadiran </label> </th>
                </tr>
                <tr>  
                     <td width="30%"><label> Jam Masuk Kantor </label></td>  
                     <td width="70%">'.$row["jam_masuk"].'</td>  
                </tr>   
                <tr>  
                     <td width="30%"><label> Jam Keluar Kantor </label></td>  
                     <td width="70%">'.$row["jam_keluar"].'</td>  
                </tr>  
                <tr>
                    <td colspan="2" style="text-align: center;"> <label> Detail Lokasi </label> </td>
                </tr>
                <tr>
                    <td width="30%"><label> Latitude </label></td>  
                    <td width="70%">'.$row["latitude"].'</td> 
                </tr>
                <tr>
                    <td width="30%"><label> Longitude </label></td>  
                    <td width="70%">'.$row["longitude"].'</td> 
                </tr>
                <tr>
                    <td width="30%"><label> Foto Lokasi </label></td>  
                    <td width="70%">'.$row["foto"].'</td> 
                </tr>

           ';  
                session_start();
                $_SESSION['hapusid'] = $row["id"]; 
      }  
      $output .= '  
           </table>  
      </div>  
      ';  
      echo $output;  
    } 
 ?>