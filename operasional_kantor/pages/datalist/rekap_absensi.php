<!DOCTYPE html>
<html>
<?php
 error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
 date_default_timezone_set("Asia/Jakarta");
 session_start();
 include '/../con_db.php';
?>
<head>
  <title>Rekap Absensi</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body style="background-color: #f9f9f9">

<style>
@import url('https://fonts.googleapis.com/css?family=Dosis');
</style>

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<div class="container">
  <h2 class="bounceInLeft animated">REKAP ABSENSI</h2>   
<div>
<hr class="bounceInLeft animated" style="  
    border: 0;
    height: 1px;
    background: #333;
    background-image: linear-gradient(to right, #ccc, #333, #ccc);"
    >
    <div class="row">
                  <div class="col col-xs-6 flipInX animated">
                  <div class="form-group flipInX animated">
					  <form method="POST" action="index.php?sidebar-menu=list_data_rekap&action=tampil">
						  <div class="input-group"> 
							<input type="text" class="form-control" id="start_date" name="start_date" style="width: 100px;" placeholder="Dari"> 
							<input type="text" class="form-control" id="end_date" name="end_date" style="width: 100px; margin-left: 3px;" placeholder="Sampai">
							<input type="submit" name="submit" value="Filter Tanggal" class="btn btn-info" style="margin-left: 3px;">
						
						  </div>
					  </form>
					</div> 
                </div>
  </div>
<hr class="bounceInLeft animated" style="  
    border: 0;
    height: 1px;
    background: #333;
    background-image: linear-gradient(to right, #ccc, #333, #ccc);"
    >
</div>
</div>

<?php
   if (!defined('DIDALAM_INDEX_PHP')){ 
    //echo "Dilarang broh!";
        header("Location: ../../index.php?sidebar-menu=home&action=tampil");
    }
?>        
<div class="bounceInUp animated table-responsive">
  <table class="table table-bordered" id="table_rekap">
    <thead>
      <tr align="center">
        <th>ID Anggota</th>
        <th>Nama</th>
        <th >Jumlah Hadir</th>
        <th>Jumlah Sakit</th>
        <th>Jumlah Izin</th>
        <th>Jumlah Cuti</th>
        <th>Jumlah Alpha</th>
        <th>Akomodasi(Ideal)</th>
      </tr>
    </thead>
    <tbody>
            <?php
            if(isset($_POST["submit"])){
              $startdate = $_POST["start_date"];
              $enddate = $_POST["end_date"];
              //$tgldata1= new DateTime($startdate);
              //$tgldataformat1=$tgldata1->format('Y-m-d');
              //$tgldata2= new DateTime($enddate);
              //$tgldataformat2=$tgldata2->format('Y-m-d');
              session_start();
              $_SESSION["tglfilterrekapabsen1"]=$startdate;
              $_SESSION["tglfilterrekapabsen2"]=$enddate;
              $sql = "SELECT a.id_anggota AS id_ang,b.nama AS nama,COUNT(CASE WHEN a.status_id = 1 OR a.status_id=2 THEN 1 ELSE NULL END) AS jumhadir,COUNT(CASE WHEN a.status_id = 3 THEN 1 ELSE NULL END) AS jumsakit,COUNT(CASE WHEN a.status_id = 4 THEN 1 ELSE NULL END) AS jumizin,COUNT(CASE WHEN a.status_id = 5 THEN 1 ELSE NULL END) AS jumcuti,COUNT(CASE WHEN a.status_id = 6 THEN 1 ELSE NULL END) AS jumalpha FROM tb_detail_absen a JOIN tb_anggota b ON a.id_anggota=b.id_anggota WHERE DATE(a.tanggal) BETWEEN STR_TO_DATE('$startdate', '%m/%d/%Y') AND STR_TO_DATE('$enddate', '%m/%d/%Y') GROUP BY a.id_anggota";
            } else {
              $sql = "SELECT a.id_anggota AS id_ang,b.nama AS nama,COUNT(CASE WHEN a.status_id = 1 OR a.status_id=2 THEN 1 ELSE NULL END) AS jumhadir,COUNT(CASE WHEN a.status_id = 3 THEN 1 ELSE NULL END) AS jumsakit,COUNT(CASE WHEN a.status_id = 4 THEN 1 ELSE NULL END) AS jumizin,COUNT(CASE WHEN a.status_id = 5 THEN 1 ELSE NULL END) AS jumcuti,COUNT(CASE WHEN a.status_id = 6 THEN 1 ELSE NULL END) AS jumalpha FROM tb_detail_absen a JOIN tb_anggota b ON a.id_anggota=b.id_anggota WHERE MONTH(a.tanggal)=MONTH(CURRENT_DATE()) AND YEAR(tanggal)=YEAR(CURRENT_DATE()) GROUP BY a.id_anggota";
            }
           
           $result = mysqli_query($koneksi,$sql);

           if (!$result) {
              printf("Error: %s\n", mysqli_error($koneksi));
              exit();
              }
            
           
            $no = 1;
            $totalhadir=0;
            $totalsakit=0;
            $totalizin=0;
            $totalcuti=0;
            $totalalpha=0;
            $totalakomodasi=0;
            while($r = mysqli_fetch_array($result))
            {
              $totalhadir+=$r["jumhadir"];
              $totalsakit+=$r["jumsakit"];
              $totalizin+=$r["jumizin"];
              $totalcuti+=$r["jumcuti"];
              $totalalpha+=$r["jumalpha"];
              $sql2="SELECT topup_credit FROM tb_credits_anggota WHERE status='unpaid' AND id_anggota='$r[id_ang]'";
              $result2 = mysqli_query($koneksi,$sql2);
              if (!$result2) {
                printf("Error: %s\n", mysqli_error($koneksi));
                exit();
                }
              $r2 = mysqli_fetch_assoc($result2);
              $jumlahakomodasi=$r2["topup_credit"]*$r["jumhadir"]+$r2["topup_credit"]*$r["jumcuti"];
              $totalakomodasi+=$jumlahakomodasi;
            ?>
            
            <tr>
              <td><?php echo $r["id_ang"] ?></td>
              <td> <?php echo $r["nama"] ?> </td>
              <td> <?php echo $r["jumhadir"] ?> </td>
              <td><?php echo $r["jumsakit"] ?></td>
              <td> <?php echo $r["jumizin"] ?> </td>
              <td> <?php echo $r["jumcuti"] ?> </td>
              <td> <?php echo $r["jumalpha"] ?> </td>
              <td> Rp<?php echo number_format($jumlahakomodasi) ?></td> 
            </tr>

              <?php
                $no++;
            }
          ?>          
    </tbody>
    <tfoot>
								<tr>
								  <th>Total</th>
								  <th></th>
								  <th><?php echo $totalhadir?></th>
								<th><?php echo $totalsakit?></th>
								  <th><?php echo $totalizin?></th>
								  <th><?php echo $totalcuti?></th>
									<th><?php echo $totalalpha?></th>
								  <th>Rp<?php echo number_format($totalakomodasi) ?></th>
                </tr>  
    </tfoot>              
  </table>
  </div>
  <br>
   <form action="pages/proses/proses_convert-csv.php" method="POST">
      <input type="submit" id="btn_convert" class="btn btn-primary pull-right" value="Convert To CSV" name="submit_csv-rekapabsen">  
  </form>
</div>

</body>
</html>
