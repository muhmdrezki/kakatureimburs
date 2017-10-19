<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<?php 
  session_start();
  error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
  $_SESSION["nama"];
  $_SESSION["id_anggota"];
  
  if($_SESSION["nama"]==''){
    ?>
    <script>
    alert('Anda Belum Login, Silahkan Login dulu');
    window.open('pages/forms/form_login.php','_self');
    </script>
    <?php
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
  
    <style>
    canvas {
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
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
<body class="hold-transition skin-blue sidebar-mini">
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
      include "con_db.php";

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
                  <a href="pages/proses/proses_logout.php" class="btn btn-default btn-flat">Sign out</a>
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
<!-- Page specific script -->
<script>
  $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function init_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    init_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()
    $('#calendar').fullCalendar({
      header    : {
        left  : 'prev,next today',
        center: 'title',
        right : 'month,agendaDay,listMonth'
      },
      buttonText: {
        today: 'Hari Ini',
        month: 'Bulan',
        day  : 'Hari',
        list : 'List'
      },
      //Random default events
      events    : "pages/fetchdata/fetch_data_calendar-absen.php",
      eventLimit: true,
      businessHours: true, // display business hours
      navLinks: true, // can click day/week names to navigate views
      editable  : true,
      droppable : true, // this allows things to be dropped onto the calendar !!!
      drop      : function (date, allDay) { // this function is called when something is dropped

        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject')

        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject)

        // assign it the date that was reported
        copiedEventObject.start           = date
        copiedEventObject.allDay          = allDay
        copiedEventObject.backgroundColor = $(this).css('background-color')
        copiedEventObject.borderColor     = $(this).css('border-color')

        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove()
        }

      },
      eventClick: function(calEvent, jsEvent, view) {

        alert('Event: ' + calEvent.title);
        // change the border color just for fun
        $(this).css('border-color', 'red');

    }
    })

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    //Color chooser button
    var colorChooser = $('#color-chooser-btn')
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      //Save color
      currColor = $(this).css('color')
      //Add color effect to button
      $('#add-new-event').css({ 'background-color': currColor, 'border-color': currColor })
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      //Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      //Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event')
      event.html(val)
      $('#external-events').prepend(event)

      //Add draggable funtionality
      init_events(event)

      //Remove event from text input
      $('#new-event').val('')
    })
  })
</script>
<script>
  $.validate({
     modules : 'file'
  });
</script>


<script type="text/javascript">
$(function() {
    $(function(){
    $("#numeric").maskMoney({prefix:'Rp ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false, precision : 0});
  })
    $(function(){
    $("#gaji").maskMoney({prefix:'Rp ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false, precision : 0});
  })
    $(function(){
    $("#gaji1").maskMoney({prefix:'Rp ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false, precision : 0});
  })
  })
</script>
 <!-- Page script -->
<script>
    $(function (){
      

     $('.select2').select2()    

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd-mm-YYYY', { 'placeholder': 'dd/mm/yyyy' })
        $('[data-mask]').inputmask()

     //Date range picker
    $('#tglRentangAbsenAdmin').daterangepicker({drops: 'up'})
    $('#tglRentangAbsenAdmin').on('apply.daterangepicker', function(ev, picker) {
      var start= picker.startDate.format('MM/DD/YYYY');
      var end = picker.endDate.format('MM/DD/YYYY');
      var date1 = new Date(start);
      var date2 = new Date(end);
      var timeDiff = Math.abs(date2.getTime() - date1.getTime());
      var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24))+1; 
      var sisacuti= <?php echo $_SESSION["sisacuti"] ?>;
      var today= new Date();
      var timeDiff2 = date1.getTime() - today.getTime();
      var diffDays2 = Math.ceil(timeDiff2 / (1000 * 3600 * 24));
      //var tglskrg = (today.getMonth()+1) + '/' + today.getDate() + '/' + today.getFullYear();
      var status=$("#status_id_adminEdit").val();
      //console.log(status);
      var validate = diffDays>sisacuti;
      if (diffDays2<0) {
          alert("Tidak boleh memilih tanggal yang telah lewat");
          $('#tglRentangCuti').val('');
      } else {
        if (diffDays>sisacuti && status=="5") {
          alert("Total hari tidak boleh melebihi jatah cuti");
          $('#tglRentangCuti').val('');
        }
      }
    })

    $('#tglRentangLibur').daterangepicker({drops: 'up'}) 
    $('#tglRentangLibur').on('apply.daterangepicker', function(ev, picker) {
      var start= picker.startDate.format('MM/DD/YYYY');
      var end = picker.endDate.format('MM/DD/YYYY');
      var date1 = new Date(start);
      var date2 = new Date(end);
      var today= new Date();
      var timeDiff2 = date1.getTime() - today.getTime();
      var diffDays2 = Math.ceil(timeDiff2 / (1000 * 3600 * 24));
      if (diffDays2<0) {
          alert("Tidak boleh memilih tanggal yang telah lewat");
          $('#tglRentangLibur').val('');
      }
    })
    $('#tglRentangLiburEdit').daterangepicker() 
    $('#tglRentangLiburEdit').on('apply.daterangepicker', function(ev, picker) {
      var start= picker.startDate.format('MM/DD/YYYY');
      var end = picker.endDate.format('MM/DD/YYYY');
      var date1 = new Date(start);
      var date2 = new Date(end);
      var today= new Date();
      var timeDiff2 = date1.getTime() - today.getTime();
      var diffDays2 = Math.ceil(timeDiff2 / (1000 * 3600 * 24));
      if (diffDays2<0) {
          alert("Tidak boleh memilih tanggal yang telah lewat");
          $('#tglRentangLiburEdit').val('');
      }
    })
    $('#tglRentangCuti').daterangepicker() 
    $('#tglRentangCuti').on('apply.daterangepicker', function(ev, picker) {
      var start= picker.startDate.format('MM/DD/YYYY');
      var end = picker.endDate.format('MM/DD/YYYY');
      var date1 = new Date(start);
      var date2 = new Date(end);
      var timeDiff = Math.abs(date2.getTime() - date1.getTime());
      var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24))+1; 
      var sisacuti= <?php echo $_SESSION["sisacuti"] ?>;
      var today= new Date();
      var timeDiff2 = date1.getTime() - today.getTime();
      var diffDays2 = Math.ceil(timeDiff2 / (1000 * 3600 * 24));
      //var tglskrg = (today.getMonth()+1) + '/' + today.getDate() + '/' + today.getFullYear();
      if (diffDays2<0) {
          alert("Tidak boleh memilih tanggal yang telah lewat");
          $('#tglRentangCuti').val('');
      } else {
        if (diffDays>sisacuti) {
          alert("Total hari tidak boleh melebihi jatah cuti");
          $('#tglRentangCuti').val('');
        }
      }
    })
    $('#tglRentangIzin').daterangepicker({drops: 'up'})
    $('#tglRentangIzin').on('apply.daterangepicker', function(ev, picker) {
      var start= picker.startDate.format('MM/DD/YYYY');
      var end = picker.endDate.format('MM/DD/YYYY');
      var date1 = new Date(start);
      var date2 = new Date(end);
      var today= new Date();
      var timeDiff2 = date1.getTime() - today.getTime();
      var diffDays2 = Math.ceil(timeDiff2 / (1000 * 3600 * 24));
      if (diffDays2<0) {
          alert("Tidak boleh memilih tanggal yang telah lewat");
          $('#tglRentangIzin').val('');
      }
    })
    $('#tglRentangSakit').daterangepicker({drops: 'up'}) 
    $('#tglRentangSakit').on('apply.daterangepicker', function(ev, picker) {
      var start= picker.startDate.format('MM/DD/YYYY');
      var end = picker.endDate.format('MM/DD/YYYY');
      var date1 = new Date(start);
      var date2 = new Date(end);
      var today= new Date();
      var timeDiff2 = date1.getTime() - today.getTime();
      var diffDays2 = Math.ceil(timeDiff2 / (1000 * 3600 * 24));
      if (diffDays2<0) {
          alert("Tidak boleh memilih tanggal yang telah lewat");
          $('#tglRentangSakit').val('');
      }
    })
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'Y-m-d H:i:a',drops: 'up' })
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
        $('#daterange-btn span').html(start.format('Y-m-d H:i:a ') + ' s/d ' + end.format('Y-m-d H:i:a'))
      }
    )

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })

    //Date picker
    $('#start_date').datepicker({
      autoclose: true,
    })

    //Date picker
    $('#end_date').datepicker({
      autoclose: true
    })
    //Konfigurasi Tabel
    $('#example').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      "order": [[ 0, "desc" ]]
    })
    $('#data_credits').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      "order": [[ 4, "desc" ]]
    })
    $('#data_absen_admin').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      "order": [[ 0, "desc" ]]
    })
    $('#data_absen').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      "order": [[ 0, "desc" ]]
    })
    $('#example1').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })

    $('#table_jabatan').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
    $('#table_rekap').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      "order": [[ 0, "asc" ]]
    })

    })
    </script>

<script type="text/javascript">

      <?php
	     date_default_timezone_set('Asia/Jakarta');
      $tgl_now = date("d-m-Y"); 
      $year = date('Y', strtotime($tgl_now));

      $sql = sprintf("SELECT tb_jenistransaksi.jenis, COUNT(tb_pembayaran.id_jenis) as 'jumlah transaksi' FROM tb_pembayaran JOIN tb_jenistransaksi ON tb_pembayaran.id_jenis=tb_jenistransaksi.id_jenis WHERE YEAR(tb_pembayaran.tanggal) = '$year' GROUP BY tb_pembayaran.id_jenis");
      $res = $koneksi -> query($sql);

      $sql_grafik = sprintf("SELECT MONTHNAME(`tanggal`) as Bulan, SUM(`nominal`) as Total FROM `tb_pembayaran` WHERE `status` = '2' AND YEAR(`tanggal`) = '$year' GROUP BY Bulan, MONTH(`tanggal`), YEAR(`tanggal`) ORDER BY Year(`tanggal`),month(`tanggal`)");
      $hasil = $koneksi->query($sql_grafik);

              if (!$hasil) {
              printf("Error: %s\n", mysqli_error($koneksi));
              exit();
              }

              $total = 0;

         foreach ($hasil as $row_hasil) {
          $total += 1;
          $data[] = $row_hasil;
         }
      ?>

      $(document).ready(function () {
       var areaChartData = {
      labels  : [
                <?php
                foreach ($data as $key => $row_hasil):
                ?>
                  '<?php echo $row_hasil["Bulan"] ?>'<?= ($key == ($total - 1)) ? '' : ','?>
                <?php
                endforeach;
                ?>
                ],
      datasets: [
        {
          label               : 'Total',
          fillColor           : 'rgba(60,141,188,0.9)',
          strokeColor         : 'rgba(60,141,188,0.8)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [
               100000, 200000
          ]
        }
      ]

    }
    
      //-------------
    //- BAR CHART -
    //---------------
    var element = $('#barChart').get(0);
    if(element == null){
       return false;
    } 
    var barChartCanvas                   = element.getContext('2d');
    var barChart                         = new Chart(barChartCanvas);
    var barChartData                     = areaChartData
    var barChartOptions                  = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - If there is a stroke on each bar
      barShowStroke           : true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth          : 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing         : 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
    }

    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)

 });

 <?php 
//index.php
	  date_default_timezone_set('Asia/Jakarta');	
      $tgl_now = date("d-m-Y");
      $year = date('Y', strtotime($tgl_now));
	  if ($_SESSION['jabatan'] == "Admin") {
		  $sql_grafik = sprintf("SELECT MONTHNAME(`tanggal`) as Bulan, SUM(`nominal`) as Total FROM `tb_pembayaran` WHERE `status` = '2' AND YEAR(`tanggal`) = '$year' GROUP BY Bulan, MONTH(`tanggal`), YEAR(`tanggal`) ORDER BY Year(`tanggal`),month(`tanggal`)");
	  } else {
		  $sql_grafik = sprintf("SELECT MONTHNAME(`tanggal`) as Bulan, SUM(`nominal`) as Total FROM `tb_pembayaran` WHERE `id_anggota`='$_SESSION[id_anggota]' AND `status` = '2' AND YEAR(`tanggal`) = '$year' GROUP BY Bulan, MONTH(`tanggal`), YEAR(`tanggal`) ORDER BY Year(`tanggal`),month(`tanggal`)");  
	  }
      $hasil = $koneksi->query($sql_grafik);

              if (!$hasil) {
              printf("Error: %s\n", mysqli_error($koneksi));
              exit();
              }

      $chart_data = '';
      while($row = mysqli_fetch_array($hasil))
      {
       $chart_data .= "{ bulan:'".$row["Bulan"]."', profit:".$row["Total"]."}, ";
      }
      $chart_data = substr($chart_data, 0, -2);
      ?>
  // Get context with jQuery - using jQuery's .get() method.
  
 $(function () {
//BAR CHART
    var line = new Morris.Line({
      element: 'chart-pembayaran-operasional',
      resize: true,
      parseTime: false,
      data: [ <?php echo $chart_data ?>
      ],
      lineColors: ['#00a65a'],
      xkey: 'bulan',
      ykeys: ['profit'],
      labels: ['Pengeluaran'],
      hideHover: 'auto'
    });
 });   

</script>


<?php
  date_default_timezone_set('Asia/Jakarta');
  $tgl_now = date("d-m-Y"); 
  $month = date('F', strtotime($tgl_now));
  if ($_SESSION['jabatan'] == "Admin") {
	$sql_grafik_jenis = "SELECT tb_jenistransaksi.jenis, COUNT(tb_pembayaran.id_jenis) as 'jumlah' FROM tb_pembayaran JOIN tb_jenistransaksi ON tb_pembayaran.id_jenis=tb_jenistransaksi.id_jenis WHERE MONTHNAME(tb_pembayaran.tanggal) = '$month' GROUP BY tb_pembayaran.id_jenis";
  } else{
	$sql_grafik_jenis = "SELECT tb_jenistransaksi.jenis, COUNT(tb_pembayaran.id_jenis) as 'jumlah' FROM tb_pembayaran JOIN tb_jenistransaksi ON tb_pembayaran.id_jenis=tb_jenistransaksi.id_jenis WHERE id_anggota='$_SESSION[id_anggota]' AND MONTHNAME(tb_pembayaran.tanggal) = '$month' GROUP BY tb_pembayaran.id_jenis";  
  }
        $res_donut = mysqli_query($koneksi, $sql_grafik_jenis);

        $data = array();

          while($row = mysqli_fetch_array($res_donut))
          {
           $data[] = array(
            'value'  => $row['jumlah'],
            'label'  => $row['jenis']
           );
          }
          $data = json_encode($data);
?>
<script type="text/javascript">
  $(function () {
     //DONUT CHART
    var donut = new Morris.Donut({
      element: 'sales-chart',
      resize: true,
      colors: ["#3c8dbc", "#f56954", "#00a65a","#DAA520","#ADEAEA","#3D1D49"],
        data: <?php echo $data; ?>,
      hideHover: 'auto'
    });
 });   
</script>

<script type="text/javascript">
  $(document).on('click', '#close-preview', function(){ 
    $('.image-preview').popover('hide');
    // Hover befor close the preview
    $('.image-preview').hover(
        function () {
           $('.image-preview').popover('show');
        }, 
         function () {
           $('.image-preview').popover('hide');
        }
    );    
});

$(function() {
    // Create the close button
    var closebtn = $('<button/>', {
        type:"button",
        text: 'x',
        id: 'close-preview',
        style: 'font-size: initial;',
    });
    closebtn.attr("class","close pull-right");
    // Set the popover default content
    $('.image-preview').popover({
        trigger:'manual',
        html:true,
        title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
        content: "There's no image",
        placement:'bottom'
    });
    // Clear event
    $('.image-preview-clear').click(function(){
        $('.image-preview').attr("data-content","").popover('hide');
        $('.image-preview-filename').val("");
        $('.image-preview-clear').hide();
        $('.image-preview-input input:file').val("");
        $(".image-preview-input-title").text("Browse"); 
    }); 
    // Create the preview image
    $(".image-preview-input input:file").change(function (){     
        var img = $('<img/>', {
            id: 'dynamic',
            width:250,
            height:200
        });      
        var file = this.files[0];
        var reader = new FileReader();
        // Set preview image into the popover data-content
        reader.onload = function (e) {
            $(".image-preview-input-title").text("Change");
            $(".image-preview-clear").show();
            $(".image-preview-filename").val(file.name);            
            img.attr('src', e.target.result);
            $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
        }        
        reader.readAsDataURL(file);
    });
    
    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieChart       = new Chart(pieChartCanvas)
 <?php
      $query = "SELECT COUNT(d.status_id) AS value,a.warna AS color,a.warna AS highlight,a.status AS label FROM tb_detail_absen d JOIN tb_absen a ON d.status_id = a.status_id WHERE DATE(d.tanggal)=CURRENT_DATE() GROUP BY d.status_id;";
      $result = mysqli_query($koneksi, $query);  
      $all = array();
	   while($row = mysqli_fetch_assoc($result)) {
		    $all[] = $row;
    }
      $data =  json_encode($all);
 ?>
    console.log('<?php echo $data?>');
    var PieData        = <?php echo $data?>;
    var pieOptions     = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke    : true,
      //String - The colour of each segment stroke
      segmentStrokeColor   : '#fff',
      //Number - The width of each segment stroke
      segmentStrokeWidth   : 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps       : 100,
      //String - Animation easing effect
      animationEasing      : 'easeOutBounce',
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate        : true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale         : true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive           : true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio  : true,
      //String - A legend template
      legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions)
    
});
</script>
	<?php 
//index.php
	  date_default_timezone_set('Asia/Jakarta');	
      $tgl_now6 = date("d-m-Y");
      $year6 = date('Y', strtotime($tgl_now6));
	  if ($_SESSION['jabatan'] == "Admin") {
		$sql_grafik6 = sprintf("SELECT MONTHNAME(`tanggal_set`) AS Bulan, SUM(`total_credit`) AS Total FROM `tb_credits_anggota` WHERE YEAR(`tanggal_set`) = '$year6' GROUP BY Bulan, MONTH(`tanggal_set`), YEAR(`tanggal_set`) ORDER BY Year(`tanggal_set`),MONTH(`tanggal_set`)");
	  } else {
		$sql_grafik6 = sprintf("SELECT MONTHNAME(`tanggal_set`) AS Bulan, SUM(`total_credit`) AS Total FROM `tb_credits_anggota` WHERE YEAR(`tanggal_set`) = '$year6' AND id_anggota='$_SESSION[id_anggota]' GROUP BY Bulan, MONTH(`tanggal_set`), YEAR(`tanggal_set`) ORDER BY Year(`tanggal_set`),MONTH(`tanggal_set`)");  
	  }
      $hasil6 = $koneksi->query($sql_grafik6);
	  $error9='';
              if (!$hasil6) {
              $error9="Error: %s\n".mysqli_error($koneksi);
              exit();
              }

      $chart_data6 = '';
      while($row6 = mysqli_fetch_array($hasil6))
      {
       $chart_data6 .= "{ bulan:'".substr($row6['Bulan'],0,3)."', Uang:".$row6["Total"]."}, ";
      }
      $chart_data6 = substr($chart_data6, 0, -2);
      ?>
<script>
	//Area Chart Morris

  // Get context with jQuery - using jQuery's .get() method.
  console.log(<?php echo $error9 ?>);
  console.log( <?php echo $chart_data6 ?>);
 $(function () {
//Line CHART
    var line = new Morris.Line({
      element: 'area-chart',
      resize: true,
	  parseTime: false,
      data: [ <?php echo $chart_data6 ?>
      ],
      xkey: 'bulan',
      ykeys: ['Uang'],
      yLabelFormat:function (y) {var formatter = new Intl.NumberFormat('id-ID', {
                                  style: 'currency',
                                  currency: 'IDR',
                                  minimumFractionDigits: 0,
                                });
      return formatter.format(y.toString()); },
      labels: ['Total'],
	  lineColors: ['#3c8dbc'],
      hideHover: 'auto'
    });
 });   

</script>
<script>
	//Area Chart Morris
<?php 
//index.php
	  if ($_SESSION['jabatan'] == "Admin") {
		$sql_grafik12 = sprintf("SELECT MONTHNAME(a.tanggal) AS Bulan,COUNT(CASE WHEN a.status_id = 1 OR a.status_id=2 THEN 1 ELSE NULL END) AS hadir,COUNT(CASE WHEN a.status_id = 3 THEN 1 ELSE NULL END) AS sakit,COUNT(CASE WHEN a.status_id = 4 THEN 1 ELSE NULL END) AS izin,COUNT(CASE WHEN a.status_id = 5 THEN 1 ELSE NULL END) AS cuti,COUNT(CASE WHEN a.status_id = 6 THEN 1 ELSE NULL END) AS alpha FROM tb_detail_absen a WHERE YEAR(a.tanggal) = YEAR(CURRENT_DATE()) GROUP BY MONTH(a.tanggal) ORDER BY YEAR(a.tanggal), MONTH(a.tanggal)");
	  } else {
		$sql_grafik12 = sprintf("SELECT MONTHNAME(a.tanggal) AS Bulan,COUNT(CASE WHEN a.status_id = 1 OR a.status_id=2 THEN 1 ELSE NULL END) AS hadir,COUNT(CASE WHEN a.status_id = 3 THEN 1 ELSE NULL END) AS sakit,COUNT(CASE WHEN a.status_id = 4 THEN 1 ELSE NULL END) AS izin,COUNT(CASE WHEN a.status_id = 5 THEN 1 ELSE NULL END) AS cuti,COUNT(CASE WHEN a.status_id = 6 THEN 1 ELSE NULL END) AS alpha FROM tb_detail_absen a WHERE YEAR(a.tanggal) = YEAR(CURRENT_DATE()) AND a.id_anggota='$_SESSION[id_anggota]' GROUP BY MONTH(a.tanggal) ORDER BY YEAR(a.tanggal), MONTH(a.tanggal)");
	  }
      $hasil12 = $koneksi->query($sql_grafik12);
	  $error12='';
              if (!$hasil12) {
              $error12="Error: %s\n".mysqli_error($koneksi);
              exit();
              }

      $chart_data12 = '';
      while($row12 = mysqli_fetch_array($hasil12))
      {
       $chart_data12 .= "{ bulan:'".substr($row12['Bulan'],0,3)."', hadir:".$row12["hadir"].",sakit:".$row12["sakit"].",izin:".$row12["izin"].",cuti:".$row12["cuti"].",alpha:".$row12["alpha"]."}, ";
      }
      $chart_data12 = substr($chart_data12, 0, -2);
      ?>
  // Get context with jQuery - using jQuery's .get() method.
  //console.log(<?php echo $error12 ?>);
  console.log( <?php echo $chart_data12 ?>);
 $(function () {
//Line CHART
    var line = new Morris.Bar({
      element: 'line-chart',
      resize: true,
	  parseTime: false,
      data: [ <?php echo $chart_data12 ?>
      ],
      xkey: 'bulan',
      ykeys: ['hadir','sakit','izin','cuti','alpha'],
      yLabelFormat: function (y) { return y.toString() + ' hari'; },
      labels: ['Hadir','Sakit','Izin','Cuti','Alpha'],
	    barColors: ['#00c0ef','#f56954','#f39c12','#00a65a','#c0c0c0'],
      hideHover: 'auto'
    });
 });   
</script>
</body>
</html>