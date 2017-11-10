<html lang="en">
<?php
  if (!defined('DIDALAM_INDEX_PHP')){ 
     //echo "Dilarang broh!";
     header("Location: ../tampil/home");
     exit();
  } else {
  session_start();
?>
<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<style>
    canvas {
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }
    #js-legend ul {
      list-style: none;
    }

    #js-legend ul li{
      display: inline;
      padding-left: 30px;
      position: relative;
      margin-bottom: 4px;
      border-radius: 5px;
      padding: 2px 8px 2px 28px;
      font-size: 14px;
      cursor: default;
      -webkit-transition: background-color 200ms ease-in-out;
      -moz-transition: background-color 200ms ease-in-out;
      -o-transition: background-color 200ms ease-in-out;
      transition: background-color 200ms ease-in-out;
    }

    #js-legend li span {
      display: block;
      position: absolute;
      left: 0;
      top: 0;
      width: 20px;
      height: 100%;
      border-radius: 5px;
	}
	.chartjs-hidden-iframe {
		height: 100% !important;
	}

    </style>
<body onload="loadChartKakatu();zoomLoadEvent();">
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
            <a href="form_bayar/air" class="small-box-footer">Klik Disini <i class="fa fa-arrow-circle-right"></i></a>
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
            <a href="form_bayar/listrik" class="small-box-footer">Klik Disini <i class="fa fa-arrow-circle-right"></i></a>
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
            <a href="form_bayar/transport" class="small-box-footer">Klik Disini <i class="fa fa-arrow-circle-right"></i></a>
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
            <a href="form_bayar/konsumsi" class="small-box-footer">Klik Disini <i class="fa fa-arrow-circle-right"></i></a>
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
            <a href="form_bayar/sampah" class="small-box-footer">Klik Disini <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      </section>
	<Section class="content fadeInRight animated" id="absensi_hari_ini" style="display:none;">
		 <!-- Apply any bg-* class to to the info-box to color it -->
	 <!-- DONUT CHART -->
		<br>
		<div class="row" id="updateAbsensiHariIni">
			<div class="col-md-12">
					   <!-- BAR CHART -->
				  <div class="box box-info">
					<div class="box-header with-border">
					  <h3 class="box-title">Statistik Absensi Hari Ini</h3>
					  <div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            <button id="removeChartAbsensiHariIni" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
						</button>
					  </div>
					</div>
					<div class="box-body">
							  <div class="col-md-4">
								  <div class="row">
									  <div class="">
										  <ul class="chart-legend clearfix list-inline">
											  <li id="listHadir"><span class="list-inline-item label label-info badge" id="jumhadir" ></span>Hadir</li>
											  <li id="listHadirDiluar"><span class="list-inline-item label label-primary badge" id="jumhadirdiluar"></span>Hadir Diluar</li>
											  <li id="listSakit"><span class="list-inline-item label label-danger badge" id="jumsakit"></span>Sakit</li>
											  <li id="listIzin"><span class="list-inline-item label label-warning badge" id="jumizin"></span>Izin</li>
											  <li id="listCuti"><span class="list-inline-item label label-success badge" id="jumcuti"></span>Cuti</li>
											  <li id="listAlpha"><span class="list-inline-item label label-default badge" id="jumalpha"></span>Alpha</li>
										  </ul>
									  </div>
									  <br>
									  <div class="chart-responsive col-md-12 col-md-pull-2">
										<canvas id="chart_absensi-hari-ini"></canvas>
									  </div>
								  </div>
							  </div>
							  <div class="col-md-8">
									<div id="galleryFotoAbsensi"></div>
							  </div>
							  <!-- ./chart-responsive -->
							<!-- /.col -->

							<!-- /.col -->
						  <!-- /.row -->
					</div>
					<!-- /.box-body -->
					  <div class="box-footer with-border">
						<h4 class="box-title">Progress Absensi Hari ini</h4>
						<div class="progress" id="progres-absen-hari-ini2">
							<div class="progress-bar " id="progres-absen-hari-ini" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">0%</div>
						</div>
					  </div>
				</div>
				  <!-- /.box -->
			</div>
        </div>
	 </Section>
    <Section class="content fadeInRight animated" id="statistik_absen">
		 <!-- Apply any bg-* class to to the info-box to color it -->
	 <!-- DONUT CHART -->
		<br>
		<div class="row">
			<div class="col-md-6">
					   <!-- BAR CHART -->
				  <div class="box box-info">
					<div class="box-header with-border">
					  <h3 class="box-title">Statistik Absensi <?php if($_SESSION['jabatan'] != 'Admin'){echo " Anda ";}?> tahun <?php echo $year;?></h3>

					  <div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            <button id="removeChartSatistikAbsensi" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
						</button>
					  </div>
					</div>
					<div class="box-body">
							  <ul class="chart-legend clearfix list-inline col-md-12 col-md-push-3">
								<li><i class="fa fa-square text-aqua list-inline-item"></i>Hadir</li>
								<li><i class="fa fa-square text-red list-inline-item"></i>Sakit</li>
								<li><i class="fa fa-square text-yellow list-inline-item"></i>Izin</li>
								<li><i class="fa fa-square text-green list-inline-item"></i>Cuti</li>
								<li><i class="fa fa-square text-gray list-inline-item"></i>Alpha</li>
							  </ul>
							  <div class="chart-responsive">
								<div class="chart" id="absen-chart" style="height: 300px;position: relative;"></div>
							  </div>
					</div>
				  </div>
			</div>
			<div class="col-md-6">
				   <!-- BAR CHART -->
			  <div class="box box-primary">
				<div class="box-header with-border">
				  <h3 class="box-title">Total Uang Akomodasi <?php if($_SESSION['jabatan'] != 'Admin'){echo " Anda ";}?> tahun <?php echo $year;?></h3>

				  <div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          <button id="removeChartJumlahOperasional" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
					</button>
				  </div>
				</div>
				<div class="box-body chart-responsive">
				  <div class="chart" id="credit-chart" style="height: 317px;position: relative;float:right;"></div>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->
			 </div>
		</div>
	 </Section>
	 
    <section class="content fadeInRight animated" id="grafik">
	   <div class="row">
			 <div class="col-md-6">
				   <!-- BAR CHART -->
			  <div class="box box-warning">
				<div class="box-header with-border">

				  <h3 class="box-title">Total Pengeluaran dari Pembayaran Operasional <?php if ($_SESSION['jabatan'] != 'Admin'){echo "Anda";}?> tahun <?php echo $year;?></h3>
				  <div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          <button id="removeChartTotalOperasional" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
					</button>
				  </div>
				</div>
				<div class="box-body chart-responsive">
				  <div class="chart" id="chart-pembayaran-operasional" style="height: 300px;position: relative;"></div>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->
			  </div>

			<div class="col-md-6">
			  <!-- DONUT CHART -->
			  <div class="box box-danger">
				<div class="box-header with-border">
				  <h4 class="box-title">Jumlah Pembayaran Operasional <?php if($_SESSION['jabatan'] != 'Admin'){echo " Anda ";}?>(per-kategori) <?php echo $month.", ".$year;?></h4>

				  <div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          <button id="removeChartJumlahOperasional" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
					</button>
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
	</section>

</body>

        <?php
          list($one, $two) = explode(",", $_SESSION['jabatan'], 2);

        if ($_SESSION['jabatan'] == "Admin") {
            ?>
            <script type="text/javascript">
                $('#shortcut-box').hide();
                $('#absensi_hari_ini').show();
            </script>
            <?php
        } elseif ($_SESSION['jabatan'] != 'Admin') {
            ?>
            <script type="text/javascript">
                 $('#shortcut-box').show();
            </script>
            <?php
        }

        if ($jumlah == "0") {
            ?>
            <script type="text/javascript">
                $('#notif_label').hide();
            </script>
            <?php
        }
        ?>


<?php
  
  $sql_data = "SELECT id_anggota, password, email FROM tb_anggota WHERE id_anggota = '$_SESSION[id_anggota]'";
  $query = mysqli_query($koneksi, $sql_data);

  $val_data = mysqli_fetch_assoc($query);

  $data_id = $val_data['id_anggota'];
  $data_pass = decodeData($val_data['password']);
  $data_email = $val_data['email'];
?>


<?php
if ($_SESSION['jabatan'] == 'Admin') {
    ?>
    <script type="text/javascript">
          $('#shortcut-box').hide();
          $('#absensi_hari_ini').show();
    </script>
<?php
} elseif ($data_id == $data_pass && $_SESSION['jabatan'] != 'Admin' || $data_email == '-') {
?>
    <script type="text/javascript">
          $('#shortcut-box').hide();
    </script>
<?php
} else {
?>
     <script type="text/javascript">
          $('#shortcut-box').show();
    </script>
<?php
}
}
?>
</html>


