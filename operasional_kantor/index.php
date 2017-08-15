<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->

<style>
@import url('https://fonts.googleapis.com/css?family=Dosis');
</style>
<?php 
  session_start();
  error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
  $_SESSION["nama"];
  $_SESSION["id_pegawai"];
  
  if($_SESSION["nama"]==''){
    ?>
    <script>
    alert('Anda Belum Login, Silahkan Login dulu');
    window.open('pages/login.php','_self');
    </script>
    <?php
  } 
?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Dashboard | Admin </title>
  
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/iCheck/all.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>K</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b> KAKATU </b> Operasional</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <?php 
      include "con_db.php";

      list($one, $two) = explode(",", $_SESSION['jabatan'] , 2);

        $sql1 = "SELECT id_anggota, foto_profile FROM tb_anggota WHERE id_anggota ='$_SESSION[id_anggota]' ";
        $result1=mysqli_query($koneksi, $sql1);
        $values1=mysqli_fetch_assoc($result1);
        $id_anggota = $values1['id_anggota'];  

        if($one == 'Admin'){

        $sql = "SELECT COUNT(id_pembayaran) as jumlah FROM `tb_pembayaran` WHERE `status`= '0'";
        $result=mysqli_query($koneksi, $sql);
        $values=mysqli_fetch_assoc($result);
        $jumlah = $values['jumlah'];

        $notif_string = "Ada ". $jumlah . " yang belum di reimbers";

      } else if($one != 'Admin' ){

        $sql = "SELECT COUNT(id_pembayaran) as jumlah FROM `tb_konfirmasi` WHERE `konfirm_admin`= '2' AND id_anggota = '$_SESSION[id_anggota]'";
        $result=mysqli_query($koneksi, $sql);
        $values=mysqli_fetch_assoc($result);
        $jumlah = $values['jumlah'];    

        $notif_string = "Anda punya ". $jumlah . " konfirmasi reimbers";    

      }
      
      ?>
      

      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Notifications Menu -->
          <li class="dropdown notifications-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-danger" id="notif_label"><?php echo $jumlah ?></span>
            </a>
            <ul class="dropdown-menu">
            <li class="header">Anda Punya <?php echo $jumlah ?> Notifikasi ! </li>
              <li>
                <!-- Inner Menu: contains the notifications -->
                <ul class="menu">
                  <li><!-- start notification -->
                    <a href="index.php?sidebar-menu=list_bayar&action=tampil&status=notif">
                    <?php 
                      if($one=='Admin'){
                    ?>
                      <i class="fa fa-book text-aqua" style="float: center;"></i> <?php echo $notif_string ?>
                    <?php
                    } else if ($one!='Admin'){
                    ?>
                      <i class="fa fa-book text-aqua" style="float: center;"></i> <?php echo $notif_string ?>
                    <?php
                    }
                    ?>
                    </a>
                  </li>
                  <!-- end notification -->
                </ul>
              </li>
            </ul>
          </li>
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <?php
                if($values1['foto_profile']!='-'){ 
                ?>
                  <img alt="User Image" <?php echo "src='dist/fotoprofile/".$values1['foto_profile']."'"; ?> class="user-image img-responsive"> 
                <?php
                } else if($values1['foto_profile']=='-') {
                ?>  
                  <img alt="User Image" <?php echo "src='dist/fotoprofile/no-profile.jpg'"; ?> class="user-image img-responsive">
                <?php
                }
                ?>
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?php echo $_SESSION['nama'];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header"  style="height: 115px;">
                 <?php
                if($values1['foto_profile']!='-'){ 
                ?>
                  <img alt="User Image" align="cen" <?php echo "src='dist/fotoprofile/".$values1['foto_profile']."'"; ?> class="img-circle img-responsive pull-left"> 
                <?php
                } else if($values1['foto_profile']=='-'){
                ?>  
                  <img alt="User Image" <?php echo "src='dist/fotoprofile/no-profile.jpg'"; ?> class="img-circle img-responsive pull-left">
                <?php
                }
                ?>
                <br>
                <p>
                  <?php echo $_SESSION['nama'];?>
                  <br>
                  <?php echo $_SESSION['jabatan'];?>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="index.php?sidebar-menu=profile&action=tampil" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="pages/proses_logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <?php
                if($values1['foto_profile']!='-'){ 
                ?>
                  <img alt="User Pic" <?php echo "<img src='dist/img/".$values1['foto_profile']."'"; ?> class="img-circle img-responsive"> 
                <?php
                } else if($values1['foto_profile']=='-'){
                ?>  
                  <img alt="User Pic" <?php echo "<img src='dist/img/no-profile.jpg'"; ?> class="img-circle img-responsive">
                <?php
                }
                ?>
        </div>
        <div class="pull-left info">
        <br>
          <p><?php echo $_SESSION['nama']; ?></p>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree" id="sidebar-menu">
        <li class="header">MENU</li>
        <!-- Optionally, you can add icons to the links -->
        <li><a href="index.php?sidebar-menu=home&action=tampil"><span class='glyphicon glyphicon-home'></span><span>Home</span></a></li>
        <li id="menu_anggota"><a href="index.php?sidebar-menu=anggota&action=tampil"><span class="glyphicon glyphicon-user"></span><span>Anggota</span></a></li>
        <li><a href="index.php?sidebar-menu=list_bayar&action=tampil"><span class='glyphicon glyphicon-usd'></span><span>Pembayaran</span></a></li>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

   <?php 

          if($one != "Admin"){
            ?>
              <script type="text/javascript">
                  document.getElementById('menu_anggota').style.display="none";
              </script>
            <?php 
          } else {
            ?>
            <script type="text/javascript">
                  document.getElementById('menu_anggota').style.visibility="visible";
            </script>
            <?php
          }

          if($jumlah == "0"){
            ?>
              <script type="text/javascript">
                  document.getElementById('notif_label').style.display="none";
              </script>
            <?php 
          } 
      ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
 <?php
      
        if((isset($_GET['sidebar-menu'])) && ($_GET['sidebar-menu']=="home") && (($_GET['action']=="tampil"))){
          
          include "pages/home.php";

        } else if((isset($_GET['sidebar-menu'])) && ($_GET['sidebar-menu']=="anggota") && (($_GET['action']=="tampil"))){

          include "pages/anggota.php";

        } else if((isset($_GET['sidebar-menu'])) && ($_GET['sidebar-menu']=="form_bayar") && (($_GET['action']=="tampil"))){

          include "pages/form_pembayaran.php";
       
        } else if((isset($_GET['sidebar-menu'])) && ($_GET['sidebar-menu']=="list_bayar") && (($_GET['action']=="tampil"))){
          
          include "pages/Pembayaran.php";
        
        } else if((isset($_GET['sidebar-menu'])) && ($_GET['sidebar-menu']=="form_anggota") && (($_GET['action']=="tampil"))) {
          
          include "pages/form_add-anggota.php";

        } else if((isset($_GET['sidebar-menu'])) && ($_GET['sidebar-menu']=="detail") && (($_GET['action']=="tampil"))) {
          
          include "pages/detail_pembayaran.php";
        } else if((isset($_GET['sidebar-menu'])) && ($_GET['sidebar-menu']=="profile") && (($_GET['action']=="tampil"))) {
          include "pages/view_profile.php";
        }
        
  ?>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- Default to the left -->
    <strong>OPERASIONAL KANTOR <a href="#"> KAKATU </a>.</strong>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="glyphicon glyphicon-book"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="glyphicon glyphicon-question-sign"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="pull-right-container">
                    <span class="label label-danger pull-right">70%</span>
                  </span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>

            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">Penjelasan Simbol</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              <a href="#" class="btn btn-danger"> <span class="glyphicon glyphicon-remove"></span> </a>
            </label>
            <p>
              Pembayaran Operasional belum di Reimbers
            </p>
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <label class="control-sidebar-subheading">
              <a href="#" class="btn btn-success"> <span class="glyphicon glyphicon-ok"></span> </a>
            </label>
            <p>
              Pembayaran Operasional sudah di Reimbers
            </p>
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <label class="control-sidebar-subheading">
              <a href="#" class="btn btn-warning"> <span class="glyphicon glyphicon-hourglass"></span> </a>
            </label>
            <p>
              Menunggu Konfirmasi Reimbers
            </p>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>

 <!-- Page script -->
    <script>
      $(function (){

     $('.select2').select2()    

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd-mm-YYYY', { 'placeholder': 'dd/mm/yyyy' })
        $('[data-mask]').inputmask()

     //Date range picker
    $('#reservation').daterangepicker()   
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'YYYY-M-D' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('YYYY-M-D ') + ' s/d ' + end.format(' YYYY-M-D'))
      }
    )

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })

    //Date picker
    $('#start_date').datepicker({
      autoclose: true
    })

    //Date picker
    $('#end_date').datepicker({
      autoclose: true
    })

    $('#example').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })

    $('#example1').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })

    })
    </script>
</body>
</html>