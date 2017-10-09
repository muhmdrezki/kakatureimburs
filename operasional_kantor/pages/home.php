<html lang="en">
<?php
  session_start();

  include "../con_db.php";
?>
<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>

<body>
 <!-- Content Header (Page header) -->
    <section class="content-header">

    <?php
      date_default_timezone_set('Asia/Jakarta');
      $tgl_now = date("d-m-Y");
      $dayname = date('D', strtotime($tgl_now));
      $day = date('j', strtotime($tgl_now));
      $month = date('F', strtotime($tgl_now));
      $year = date('Y', strtotime($tgl_now));
    ?>
      
      <h3 class="pull-right" style="float: right;"> <?php echo $dayname." , ".$day." - ".$month." - ".$year; ?> </h3>
      
    </section>

    <br>
    <br>
    <br>

    <section class="content-header fadeInRight animated" id="shortcut-box">
      <!-- Main content -->
       <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
            <b><p style="font-size: 27px;">AIR</p></b>

              <p>Shortcut Pembayaran</p>
            </div>
            <div class="icon">
              <i class="ion ion-waterdrop"></i>
            </div>
            <a href="index.php?sidebar-menu=form_bayar&action=tampil&jenis=air" class="small-box-footer">Klik Disini <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
            <b><p style="font-size: 27px;">Listrik</p></b>

              <p>Shortcut Pembayaran</p>
            </div>
            <div class="icon">
              <i class="ion ion-flash"></i>
            </div>
            <a href="index.php?sidebar-menu=form_bayar&action=tampil&jenis=listrik" class="small-box-footer">Klik Disini <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box" style="background-color: #fffc4c;">
            <div class="inner">
            <b><p style="font-size: 27px; color: #35352b;">ART</p></b>

              <p style="color: #35352b;">Shortcut Pembayaran</p>
            </div>
            <div class="icon">
              <i class="ion ion-home"></i>
            </div>
            <a href="index.php?sidebar-menu=form_bayar&action=tampil&jenis=ART" class="small-box-footer" style="color: #35352b;">Klik Disini <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <b><p style="font-size: 27px;">Transport</p></b>

              <p>Shortcut Pembayaran</p>
            </div>
            <div class="icon">
              <i class="ion ion-model-s"></i>
            </div>
            <a href="index.php?sidebar-menu=form_bayar&action=tampil&jenis=transport" class="small-box-footer">Klik Disini <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner">
            <b><p style="font-size: 27px;">Konsumsi</p></b>

              <p>Shortcut Pembayaran</p>
            </div>
            <div class="icon">
              <i class="ion ion-spoon"></i><i class="ion ion-fork"></i>
            </div>
            <a href="index.php?sidebar-menu=form_bayar&action=tampil&jenis=konsumsi" class="small-box-footer">Klik Disini <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
            <b><p style="font-size: 27px;">Sampah</p></b>

              <p>Shortcut Pembayaran</p>
            </div>
            <div class="icon">
              <i class="ion ion-trash-a"></i>
            </div>
            <a href="index.php?sidebar-menu=form_bayar&action=tampil&jenis=sampah" class="small-box-footer">Klik Disini <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      </section>

 <!-- /.info-box-content -->
     <Section class="content fadeInRight animated" id="progressbar">
		 <!-- Apply any bg-* class to to the info-box to color it -->
	 <!-- DONUT CHART -->
   <div class="container">
   <div class="content-header">
        <b><h3> Report Absensi </h3></b>
    </div>

    <br>
	 <div class="col-md-6">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Absensi Hari ini</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <canvas id="pieChart" style="height:250px"></canvas>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

   </div>
	<div class="col-md-6">
      <div class="info-box bg-red">
        <span class="info-box-icon"><i class="ion ion-person-add"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Progress Absensi Hari ini</span>
          <!-- The progress section is optional -->
          <div class="progress progress-lg active">
            <div class="progress-bar" style="width: 70%"></div>
          </div>
          <span class="progress-description">
            70% Increase in 30 Days
          </span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
	</div>
  </div>
	 </Section>
    <section class="content fadeInRight animated" id="grafik">
    
    <div class="container">
    <div class="content-header">
        <b><h3> STATISTIK </h3></b>
    </div>

    <br>
      <div class="row">
         <div class="col-md-6">
               <!-- BAR CHART -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Total Pengeluaran dari Pembayaran Operasional</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="bar-chart" style="height: 300px;"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          </div>

        <div class="col-md-6">
          <!-- DONUT CHART -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h4 class="box-title">Jumlah Pembayaran Operasional (per-kategori) Bulan <?php echo $month.", ".$year?></h4>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="sales-chart" style="height: 300px; position: relative;"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
      </div>  
		</div>
		</div>
	<div class="container">
    
      <div class="row">
         <div class="col-md-12">
              <div id="calendar"></div>
		 </div>
	  </div>

  </div>  
  <!-- /.content-wrapper -->
    </section>

</body>

        <?php
          list($one, $two) = explode(",", $_SESSION['jabatan'], 2);

        if ($_SESSION['jabatan'] == "Admin") {
            ?>
            <script type="text/javascript">
                document.getElementById('shortcut-box').style.display="none";
            </script>
            <?php
        } elseif ($_SESSION['jabatan'] != 'Admin') {
            ?>
            <script type="text/javascript">
                document.getElementById('shortcut-box').style.visibility="visible";
            </script>
            <?php
        }

        if ($jumlah == "0") {
            ?>
            <script type="text/javascript">
                document.getElementById('notif_label').style.display="none";
            </script>
            <?php
        }
        ?>


<?php

  include "../../con_db.php";

  $sql_data = "SELECT id_anggota, password, email FROM tb_anggota WHERE id_anggota = '$_SESSION[id_anggota]'";
  $query = mysqli_query($koneksi, $sql_data);

  $val_data = mysqli_fetch_assoc($query);

  $data_id = $val_data[id_anggota];
  $data_pass = $val_data[password];
  $data_email = $val_data[email];
?>


<?php
if ($_SESSION['jabatan'] == 'Admin') {
    ?>
    <script type="text/javascript">
          document.getElementById('shortcut-box').style.display="none";
    </script>
<?php
} elseif ($data_id == $data_pass && $_SESSION['jabatan'] != 'Admin' || $data_email == '-') {
?>
    <script type="text/javascript">
          document.getElementById('shortcut-box').style.display="none";
    </script>
<?php
} else {
?>
     <script type="text/javascript">
          document.getElementById('shortcut-box').style.display="block";
    </script>
<?php
}
?>

</html>

<div id="sakitModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Sakit</h4>  
                </div>  
                <div class="modal-body" id="detail_Sakit">  
                </div>  
                <div class="modal-footer">    
                     <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>  
                </div>  
           </div>  
      </div>  
 </div>  


<script>
     $(document).ready(function(){  
      $('.detail_sakit').click(function(){  
         var id = $(this).attr("id");
          $.ajax({  
                url:"pages/fetchdata/fetch_data_sakit.php",  
                method:"post",  
                data:{id:id},  
                success:function(data){
                 $('#detail_Sakit').html(data);           
                 $('#sakitModal').modal("show");  
             }
         });
      });  
 });  
</script>

<div id="izinModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Izin</h4>  
                </div>  
                <div class="modal-body" id="detail_Izin">  
                </div>  
                <div class="modal-footer">    
                     <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>  
                </div>  
           </div>  
      </div>  
 </div>  


<script>
     $(document).ready(function(){  
      $('.detail_izin').click(function(){  
         var id = $(this).attr("id");
          $.ajax({  
                url:"pages/fetchdata/fetch_data_izin.php",  
                method:"post",  
                data:{id:id},  
                success:function(data){
                 $('#detail_Izin').html(data);           
                 $('#izinModal').modal("show");  
             }
         });
      });  
 });  
</script>

