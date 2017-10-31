<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<?php 

  session_start();
  define("DIDALAM_INDEX_PHP",true);
  error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));
  include "con_db.php";
  include "fungsi_kakatu.php";
  $_SESSION["nama"];
  $_SESSION["id_anggota"];
  if($_SESSION["id_anggota"]==''){
    header("Location: login/form/form_login.php");
  } 
?>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,initial-scale=1.0, user-scalable=no">
  <title> Kinest Kreatif Ideata </title>
  
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" href="dist/img/favicon.ico" type="image/x-icon">
  <link rel="icon" href="dist/img/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.css">
  <!-- Overlay CSS -->
  <link rel="stylesheet" href="dist/css/overlay.css">
  <!-- Animate CSS -->
  <link rel="stylesheet" href="dist/css/animate.css">
  <!-- Image Prev CSS -->
  <link rel="stylesheet" href="dist/css/img-prev.css">
  <!-- Morris charts -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
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
  <link rel="stylesheet" href="dist/css/profile.css">
<!-- fullCalendar -->
  <link rel="stylesheet" href="bower_components/fullcalendar/dist/fullcalendar.min.css">
  <link rel="stylesheet" href="bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
  *{
    /**border:1px dotted red;**/
  }
  </style>
  
    
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
<body class="hold-transition skin-blue sidebar-mini" id="updateSemua">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>K</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-sm"> Kinest Kreatif Ideata  </span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <?php 
      list($one, $two) = explode(",", $_SESSION['jabatan'] , 2);

        $sql1 = "SELECT id_anggota, foto_profile FROM tb_anggota WHERE id_anggota ='$_SESSION[id_anggota]' ";
        $result1=mysqli_query($koneksi, $sql1);
        $values1=mysqli_fetch_assoc($result1);
        $id_anggota = $values1['id_anggota'];  
		    $sql2 = "SELECT total_credit FROM tb_credits_anggota WHERE id_anggota ='$_SESSION[id_anggota]' AND status='unpaid' AND MONTH(tanggal_set)=(MONTH(CURRENT_DATE())) AND YEAR(tanggal_set)=YEAR(CURRENT_DATE())";
        $result2=mysqli_query($koneksi, $sql2);
        $values2=mysqli_fetch_assoc($result2);
        $jumlah2= $values2['total_credit'];
        $sql3 = "SELECT cuti_used,cuti_qty FROM tb_cuti_anggota WHERE id_anggota ='$_SESSION[id_anggota]' ";
        $result3=mysqli_query($koneksi, $sql3);
        $values3=mysqli_fetch_assoc($result3);
        $jumlah3= $values3['cuti_qty'] - $values3['cuti_used'];
        $_SESSION['sisacuti']=$jumlah3;
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
          <li ><a  style="padding-top: 0px;padding-bottom: 0px;margin-top:0px;margin-bottom:0px;display:block;" href="#"><p style="padding-top: 0px;padding-bottom: 0px;margin-top:0px;margin-bottom:0px;font-size:10px;">Sisa Cuti</p><p style="padding-top: 0px;padding-bottom: 0px;text-align: center;font-size:15px;"><span class="label label-default"><?php echo $jumlah3?> hari</span></p></a></li>
		      <li ><a  style="padding-top: 0px;padding-bottom: 0px;margin-top:0px;margin-bottom:0px;display:block;" href="#"><p style="padding-top: 0px;padding-bottom: 0px;margin-top:0px;margin-bottom:0px;font-size:10px;">Total AKomodasi</p><p style="padding-top: 0px;padding-bottom: 0px;font-size:15px;"><span class="label label-default"><?php echo "Rp".number_format($jumlah2)?></span></p></a></li>
          <li class="dropdown notifications-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-danger" id="notif_label"><?php echo $jumlah ?></span>
            </a>
            <ul class="dropdown-menu fadeIn animated">
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
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?php echo $_SESSION['nama'];?></span>
                <?php
                } else if($values1['foto_profile']=='-') {
                ?>  
                  <img alt="User Image" <?php echo "src='dist/fotoprofile/no-profile.jpg'"; ?> class="user-image img-responsive">
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?php echo $_SESSION['nama'];?></span>
                <?php
                }
                ?>
            </a>
            <ul class="dropdown-menu fadeIn animated">
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
                  <a href="login/proses/proses_logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
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
                  <img alt="User Pic" <?php echo "<img src='dist/fotoprofile/".$values1['foto_profile']."'"; ?> class="img-circle img-responsive"> 
                <?php
                } else if($values1['foto_profile']=='-'){
                ?>  
                  <img alt="User Pic" <?php echo "<img src='dist/fotoprofile/no-profile.jpg'"; ?> class="img-circle img-responsive">
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
        <li><a href="index.php?sidebar-menu=home&action=tampil"><i class='fa fa-dashboard'></i><span>Dashboard</span></a>
        </li>
        <li><a href="index.php?sidebar-menu=list_bayar&action=tampil"><i class='glyphicon glyphicon-usd'></i><span>Pembayaran</span></a></li>
        </li>
		<li id="menu_absen" class="treeview">
          <a href="#">
            <i class="fa fa-book"></i> <span>Absensi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="index.php?sidebar-menu=form_absensi&action=tampil"><i class="glyphicon glyphicon-user"></i><span> Form Absensi</span></a>
            <li><a href="index.php?sidebar-menu=list_data_absensi&action=tampil"><i class="fa fa-black-tie"></i> Data Absensi </a></li>
          </ul>
        </li>
        <li id="menu_master" class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Data Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="index.php?sidebar-menu=anggota&action=tampil"><i class="glyphicon glyphicon-user"></i><span> Data Anggota</span></a>
            <li><a href="index.php?sidebar-menu=list_jabatan&action=tampil"><i class="fa fa-black-tie"></i> Data Jabatan </a></li>
            <li><a href="index.php?sidebar-menu=list_jenis-pembayaran&action=tampil"><i class="fa fa-cc-visa"></i> Jenis Pembayaran </a></li>
			      <li><a href="index.php?sidebar-menu=list_data_absensi_admin&action=tampil"><i class="fa fa-book"></i> Data Absensi </a></li>
			      <li><a href="index.php?sidebar-menu=list_data_credits&action=tampil"><i class="fa fa-money"></i> Data Uang Akomodasi </a></li>
            <li><a href="index.php?sidebar-menu=list_data_libur&action=tampil"><i class="fa fa-calendar"></i> Data Tanggal Libur</a></li>
            <li><a href="index.php?sidebar-menu=list_data_cuti&action=tampil"><i class="fa fa-files-o"></i> Data Quota Cuti </a></li>
            <li><a href="index.php?sidebar-menu=list_data_rekap&action=tampil"><i class="fa fa-table"></i> Data Rekap Absen </a></li>
          </ul>
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
                  //document.getElementById('menu_absen').style.display="none";
                  document.getElementById('menu_master').style.display="none";
              </script>
            <?php 
          } else {
            ?>
            <script type="text/javascript">
                  document.getElementById('menu_master').style.visibility="visible";
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

          include "pages/datalist/anggota.php";

        } else if((isset($_GET['sidebar-menu'])) && ($_GET['sidebar-menu']=="form_bayar") && (($_GET['action']=="tampil"))){

          include "pages/forms/form_pembayaran.php";
       
        } else if((isset($_GET['sidebar-menu'])) && ($_GET['sidebar-menu']=="list_bayar") && (($_GET['action']=="tampil"))){
          
          include "pages/datalist/Pembayaran.php";
        
        } else if((isset($_GET['sidebar-menu'])) && ($_GET['sidebar-menu']=="form_anggota") && (($_GET['action']=="tampil"))) {
          
          include "pages/forms/form_add-anggota.php";

        } else if((isset($_GET['sidebar-menu'])) && ($_GET['sidebar-menu']=="detail") && (($_GET['action']=="tampil"))) {
          
          include "pages/detail_pembayaran.php";
        
        } else if((isset($_GET['sidebar-menu'])) && ($_GET['sidebar-menu']=="profile") && (($_GET['action']=="tampil"))) {
        
          include "pages/view_profile.php";
        
        } else if((isset($_GET['sidebar-menu'])) && ($_GET['sidebar-menu']=="form_edit-pembayaran") && (($_GET['action']=="tampil"))) {
        
          include "pages/forms/form_edit-pembayaran.php";
        
        } else if((isset($_GET['sidebar-menu'])) && ($_GET['sidebar-menu']=="list_jabatan") && (($_GET['action']=="tampil"))) {
        
          include "pages/datalist/jabatan.php";

        }  else if((isset($_GET['sidebar-menu'])) && ($_GET['sidebar-menu']=="list_jenis-pembayaran") && (($_GET['action']=="tampil"))) {
        
          include "pages/datalist/jenis_pembayaran.php";

        } else if((isset($_GET['sidebar-menu'])) && ($_GET['sidebar-menu']=="list_data_absensi_admin") && (($_GET['action']=="tampil"))) {
        
          include "pages/datalist/data_absen_admin.php";
		  
		} else if((isset($_GET['sidebar-menu'])) && ($_GET['sidebar-menu']=="list_data_absensi") && (($_GET['action']=="tampil"))) {
        
          include "pages/datalist/data_absen.php"; 
		  
        } else if((isset($_GET['sidebar-menu'])) && ($_GET['sidebar-menu']=="form_absensi") && (($_GET['action']=="tampil"))) {
          
          include "pages/forms/form_submit-absensi.php";
		  
		}  else if((isset($_GET['sidebar-menu'])) && ($_GET['sidebar-menu']=="list_data_credits") && (($_GET['action']=="tampil"))) {
          
          include "pages/datalist/credits.php";
		} else if((isset($_GET['sidebar-menu'])) && ($_GET['sidebar-menu']=="list_data_cuti") && (($_GET['action']=="tampil"))) {
      
      include "pages/datalist/cuti.php";
    } else if((isset($_GET['sidebar-menu'])) && ($_GET['sidebar-menu']=="list_data_libur") && (($_GET['action']=="tampil"))) {
      
      include "pages/datalist/tgllibur.php";
    } else if((isset($_GET['sidebar-menu'])) && ($_GET['sidebar-menu']=="list_data_rekap") && (($_GET['action']=="tampil"))) {
      
      include "pages/datalist/rekap_absensi.php";
    } 
  ?>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- Default to the left -->
    <strong> OPERASIONAL KANTOR <a href="#"> KAKATU </a></strong>
  </footer>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>  
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- ChartJS -->
<script src="bower_components/chart.js/Chart.js"></script>

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
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js'></script>
<script src="inputmask/jquery.number.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script src="inputmask-jquery/dist/jquery.maskMoney.js" type="text/javascript"></script>
<!-- Google Maps API With API KEY -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAn0sCC7HGqbJbWhwkgJnvyWFiTa7QGtVI"></script> 
<!-- fullCalendar -->
<script src="bower_components/moment/moment.js"></script>
<script src="bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
<!-- Socket IO -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.7.3/socket.io.min.js'></script>
<!-- Page specific script -->

<script type="text/javascript" src='fungsi_kakatu.js'></script>
</body>
</html>