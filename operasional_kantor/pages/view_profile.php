<html>
  <head>
     <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Profile </title>
  
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="../dist/css/skins/skin-blue.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <link href="https://fonts.googleapis.com/css?family=Mulis" rel="stylesheet">

  <link rel="stylesheet" href="../dist/css/profile.min.css">
        
  </head>

    <body>
      <div class="container">
      <br>
      <br>

      <h3 style="text-align: center; font-family: 'Mulis' , Sans-serif;"> USER PROFILE </h3>

      <hr>  

      <div class="row">
      <div class="col-md-5  toppad  pull-right col-md-offset-3 ">
       <br>
      </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
          <div>

            <?php 
                  session_start();

                  include "../con_db.php";

                  $sql = "SELECT * FROM tb_anggota WHERE id_anggota = '$_SESSION[id_anggota]'";
                  $result = mysqli_query($koneksi,$sql);
                  $values = mysqli_fetch_assoc($result);

                ?>


            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> 
                <?php
                if(!is_null($values['foto_profile'])){ 
                ?>
                  <img alt="User Pic" <?php echo "src='dist/img/".$values['foto_profile']."'"; ?> class="img-circle img-responsive"> 
                <?php
                } else {
                ?>  
                  <img alt="User Pic" <?php echo "src='dist/img/no-profile.jpg'"; ?> class="img-circle img-responsive">
                <?php
                }
                ?>
                <br>
                <form action="pages/proses_upload-foto.php" method="POST" enctype="multipart/form-data">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                  <span class="btn btn-default btn-file"><span>Choose file</span><input type="file" name="image"></span>
                  <span class="fileinput-filename"></span><span class="fileinput-new">No file chosen</span>
                </div>
                <br>
                <input type="submit" name="submit" class="btn btn-info" value="Upload">
                </div>
                </form>
                <br>

                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>ID : </td>
                        <td><?php echo $values['id_anggota']; ?></td>
                      </tr>
                      <tr>
                        <td>Nama : </td>
                        <td><?php echo $values['nama']; ?></td>
                      </tr>
                      <tr>
                        <td>Jabatan : </td>
                        <td><?php echo $values['jabatan']; ?></td>
                      </tr>
                      <tr>
                        <td>Tempat, Tanggal Lahir : </td>
                        <td>Ciamis, 21 Februari 1996</td>
                      </tr>

                      <?php 

                        if($values['jenis_kelamin']=="L"){
                          $gender = "Laki - laki";
                        } else if ($values['jenis_kelamin']=="P"){
                          $gender = "Perempuan";
                        }

                      ?>

                      <tr>
                      
                        <tr>
                          <td>Jenis Kelamin : </td>
                          <td><?php echo $gender; ?></td>
                        </tr>
                          <tr>
                          <td>Alamat</td>
                          <td><?php echo $values['alamat']; ?></td>
                        </tr>
                        <tr>
                          <td>Email</td>
                          <td><a href="#"><?php echo $values['email']; ?></a></td>
                        </tr>
                             
                      </tr>
                     
                    </tbody>
                  </table>
                     <span class="pull-right">
                            <a href="edit.html" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i> Edit Profile </a>
                        </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>      
    </body>

<script src="../dist/profile.js"></script>
</html>