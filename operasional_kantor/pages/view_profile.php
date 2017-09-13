<html>
  <head>
     <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Profile </title>
  
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

   <style>
  @import url('https://fonts.googleapis.com/css?family=Dosis');
  </style>   
  <!-- jQuery 3 -->
  <script src="bower_components/jquery/dist/jquery.min.js"></script>     
  </head>

    <body>
      <div>

      <h1 style="text-align: center; font-family: 'Mulis' , Sans-serif;"> USER PROFILE </h1>

      <hr>  

      <div class="row">
      <div class="col-md-5  toppad  pull-right col-md-offset-3 ">
      </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
          <div>

            <?php 
                  session_start();
                  date_default_timezone_set("Asia/Jakarta");
                  include "../con_db.php";

                  $sql = "SELECT tb_anggota.id_anggota, tb_anggota.nama, GROUP_CONCAT(tb_jabatan.jabatan SEPARATOR ', ') as 'jabatan', tb_anggota.email, tb_anggota.jenis_kelamin, tb_anggota.alamat,tb_anggota.foto_profile, tb_anggota.tempat_lahir, tb_anggota.tgl_lahir FROM `tb_anggota` JOIN jabatan_anggota ON tb_anggota.id_anggota = jabatan_anggota.id_anggota JOIN tb_jabatan ON tb_jabatan.id_jabatan = jabatan_anggota.id_jabatan WHERE tb_anggota.id_anggota = '$_SESSION[id_anggota]'";
                  $result = mysqli_query($koneksi,$sql);
                  $values = mysqli_fetch_assoc($result);

                ?>


            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> 
                <?php
                if($values['foto_profile']!="-"){ 
                ?>
                  <img alt="User Pic" <?php echo "src='dist/fotoprofile/".$values['foto_profile']."'"; ?> class="img-circle img-responsive"> 
                <?php
                } else if ($values['foto_profile']=="-") {
                ?>  
                  <img alt="User Pic" <?php echo "src='dist/fotoprofile/no-profile.jpg'"; ?> class="img-circle img-responsive">
                <?php
                }
                ?>
                <br>
                <input type="button" name="edit" value="Upload Foto" id="<?php echo $values["id_anggota"]; ?>" class="btn btn-default upload"/>
                <br>

                 <div id="data_Modal" class="modal fade">  
                      <div class="modal-dialog">  
                           <div class="modal-content">  
                                <div class="modal-header">  
                                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                                     <h4 class="modal-title">EDIT PROFILE</h4>  
                                </div>  
                                <div class="modal-body">  
                                <form action="pages/proses/proses_upload-foto.php" method="POST" enctype="multipart/form-data">
                                     <!-- image-preview-filename input [CUT FROM HERE]-->
                                        <div class="input-group image-preview">
                                            <input type="text" class="form-control image-preview-filename" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
                                            <span class="input-group-btn">
                                                <!-- image-preview-clear button -->
                                                <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                                    <span class="glyphicon glyphicon-remove"></span> Clear
                                                </button>
                                                <!-- image-preview-input -->
                                                <div class="btn btn-default image-preview-input">
                                                    <span class="glyphicon glyphicon-folder-open"></span>
                                                    <span class="image-preview-input-title">Browse</span>
                                                    <input type="file" accept="image/png, image/jpeg, image/gif" name="image"/> <!-- rename it -->
                                                </div>
                                            </span>
                                        </div><!-- /input-group image-preview [TO HERE]--> 
                                </div>
                                </div>  
                                <div class="modal-footer"> 
                                      <input type="submit" name="submit" id="upload" value="Upload" class="btn btn-success" /> 
                                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>   
                                     </form>
                                </div>  
                           </div>  
                      </div>  
                </div>  

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
                        <td><?php echo $values['tempat_lahir']?>, <?php echo $values['tgl_lahir']?></td>
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
                            <input type="button" name="edit" value="Edit Profile" id="<?php echo $values["id_anggota"]; ?>" class="btn btn-warning edit_data"/>
                        </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>  

        <div id="add_data_Modal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">EDIT PROFILE</h4>  
                </div>  
                <div class="modal-body">  
                     <form method="post" action="pages/proses/proses_edit-anggota.php">  
                          <label>ID Anggota</label>
                          <input type="text" name="id_anggota" id="id_anggota" class="form-control" readonly />   
                          <br />
                          <label>Nama</label>  
                          <input type="text" name="nama" id="nama" class="form-control" />  
                          <br />  
                          <label>Alamat</label>  
                          <textarea name="alamat" id="alamat" class="form-control"></textarea>  
                          <br />  
                          <label>Tempat Lahir</label>  
                          <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" />  
                          <br />  
                          <label>Tanggal Lahir</label>  
                          <input type="text" name="tgl_lahir" id="tgl_lahir" class="form-control" />  
                          <br />  
                          <label>Email</label>  
                          <input type="email" name="email" id="email" class="form-control" /> 
                          <br /> 
                          <label>Password<i style="color: #f44242;"> (Harus sama dengan password email) </i></label>  
                          <input type="text" name="password" id="password" class="form-control" /> 
                          <br /> 
                      
                </div>  
                <div class="modal-footer"> 
                     <input type="submit" name="submit" id="insert" value="Update" class="btn btn-success" /> 
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </form>      
                </div>  
           </div>  
      </div>  
 </div>  
<script type="text/javascript">
  $(document).on('click', '.edit_data', function(){ 
  var id_anggota = $(this).attr("id");   
             $.ajax({  
                url:"pages/fetchdata/fetch_data_anggota-json.php",  
                method:"POST",  
                data:{id_anggota:id_anggota},  
                dataType:"json",  
                success:function(data){ 
                     $('#id_anggota').val(data.id_anggota); 
                     $('#nama').val(data.nama);  
                     $('#alamat').val(data.alamat);  
                     $('#tempat_lahir').val(data.tempat_lahir);  
                     $('#tgl_lahir').val(data.tgl_lahir);  
                     $('#email').val(data.email);  
                     $('#password').val(data.password);  
                     $('#insert').val("Update");  
                     $('#add_data_Modal').modal('show');  
                }  
           });
      });    
</script>

<script type="text/javascript">
  $(document).on('click', '.upload', function(){ 
  var id_anggota = $(this).attr("id");   
             $.ajax({  
                success:function(data){ 
                     $('#insert').val("Update");  
                     $('#data_Modal').modal('show');  
                }  
           });
      });    
</script>

    </body>

</html>