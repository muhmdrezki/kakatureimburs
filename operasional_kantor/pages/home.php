<html lang="en">
<?php 
  session_start();

  include "../con_db.php";
?>
<body>
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
      </h1>
      <br>
      <!-- Main content -->
       <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>Air</h3>

              <p>Shortcut Pembayaran</p>
            </div>
            <div class="icon">
              <i class="ion ion-waterdrop"></i>
            </div>
            <a href="#" class="small-box-footer">Klik Disini <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>Listrik</h3>

              <p>Shortcut Pembayaran</p>
            </div>
            <div class="icon">
              <i class="ion ion-flash"></i>
            </div>
            <a href="#" class="small-box-footer">Klik Disini <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>ART</h3>

              <p>Shortcut Pembayaran</p>
            </div>
            <div class="icon">
              <i class="ion ion-home"></i>
            </div>
            <a href="#" class="small-box-footer">Klik Disini <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>Transport</h3>

              <p>Shortcut Pembayaran</p>
            </div>
            <div class="icon">
              <i class="ion ion-model-s"></i>
            </div>
            <a href="#" class="small-box-footer">Klik Disini <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner">
              <h3>Konsumsi</h3>

              <p>Shortcut Pembayaran</p>
            </div>
            <div class="icon">
              <i class="ion ion-spoon"></i><i class="ion ion-fork"></i>
            </div>
            <a href="#" class="small-box-footer">Klik Disini <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-default">
            <div class="inner">
              <h3>Sampah</h3>

              <p>Shortcut Pembayaran</p>
            </div>
            <div class="icon">
              <i class="ion ion-trash-a"></i>
            </div>
            <a href="#" class="small-box-footer">Klik Disini <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
    <section class="content" style="padding: 20px;">
      <div class="row">
               <div class="box box-success">
                  <div class="box-header with-border">
                    <h3 class="box-title">Grafik Total Pengeluaran</h3>

                    <div class="box-tools">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="chart">
                      <canvas id="barChart" style="height:250px;"></canvas>
                    </div>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
      </div>     
    </section>
</body>
</html>