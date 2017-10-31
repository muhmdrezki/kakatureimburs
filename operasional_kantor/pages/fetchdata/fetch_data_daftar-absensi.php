   <?php  
      error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
      include "../../con_db.php";
      $query = "SELECT b.nama AS nama,c.status AS status,b.foto_profile AS foto FROM tb_detail_absen a JOIN tb_anggota b ON a.id_anggota=b.id_anggota JOIN tb_absen c ON a.status_id = c.status_id WHERE a.tanggal=CURRENT_DATE()";  
      $result = mysqli_query($koneksi, $query);
      $jumbaris = mysqli_num_rows($result);
      //echo $jumbaris."<br>";
      if ($jumbaris<4) {
            $jumFotoTampil=$jumbaris;
      } else {
            $jumFotoTampil=4;
      }
      
      $jumBagian = ceil($jumbaris/$jumFotoTampil);
      //echo $jumBagian."<br>";
      $output = '<div id="galleryAbsensiHariIni" class="carousel slide" data-ride="carousel">					  
      <div class="carousel-inner">'
      ;
      $inc = 1;
      while($inc<=$jumBagian){
            //echo $inc."<br>";
            //echo $jumBagian."<br>";
            if ($inc==1) {
                  $output .=  '<div class="item active">';
            } else {
                  $output .=  '<div class="item">';
            }
            
            
            $output .='<ul class="users-list clearfix">';
            $inc2 = 1;
            while($inc2 <=$jumFotoTampil){
                  //echo $inc2."<br>";
                  $row = mysqli_fetch_assoc($result);
                  $fotomuka = $row["foto"];
                  if ($fotomuka=='-') {
                        $fotomuka="no-profile.jpg";
                  }
                  $statusFoto = $row["status"];
                  $warnaLabel;
                  switch ($statusFoto) {
                        case 'Hadir':
                              $warnaLabel = 'label-info';
                        break;
                        case 'Hadir Diluar':
                              $warnaLabel = 'label-primary';
                        break;
                        case 'Sakit':
                              $warnaLabel = 'label-danger';
                        break;
                        case 'Izin':
                              $warnaLabel = 'label-warning';
                        break;
                        case 'Cuti':
                              $warnaLabel = 'label-success';
                        break;
                        case 'Alpha':
                              $warnaLabel = 'label-default';
                        break;
                  }
                  $output.='
                  <li>
                        <a class="users-list-name" href="#">'.$row["nama"].'</a>
                        <img class="user-image img-responsive" src="dist/fotoprofile/'.$fotomuka.'" alt="User Image">
                        <span class="label '.$warnaLabel.' users-list-date">'.$statusFoto.'</span>
                  </li>
                  ';
                  $inc2++; 
            }
            $output .='</ul></div>';
            if ($inc==($jumBagian-1)) {
                  $modSisaFoto = $jumbaris % $jumFotoTampil;
                  if ($modSisaFoto!=0) {
                        $jumFotoTampil= $jumbaris % $jumFotoTampil;
                  } 
            }
            $inc++;
      }
      $output .='
      </div>
            <a class="left carousel-control" href="#galleryAbsensiHariIni" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left"></span>
                  <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#galleryAbsensiHariIni" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right"></span>
                  <span class="sr-only">Next</span>
            </a>
      </div>';
      echo $output;   
 ?>