      <?php 
        $id_jabatan = mt_rand(100,999);
        date_default_timezone_set("Asia/Jakarta");
      ?>

<section id="form_jabatan-jenis" style="margin: 0 auto;">

<div class="content-header bounceInRight animated">
  
  <h2> DATA JABATAN </h2>

</div>

 <!-- jQuery 3 -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>

<div class="container bounceInUp animated">
<hr>
  <div class="row">
        <div class="col-md-6">
        <h3> FORM TAMBAH DATA </h3>
         <!-- form start -->
            <form role="form" action="pages/proses/proses_save-jabatan.php" method="POST">
              <div class="box-body" style="margin-right: 20px;">
                <div class="form-group">
                  <label for="ID">ID</label>
                  <input type="text" class="form-control" id="id_jabatan" name="id_jabatan" readonly value="<?php echo $id_jabatan ?>">
                </div>
                <div class="form-group">
                  <label for="Jabatan">Jabatan</label>
                  <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Isi Jabatan"
                  data-validation="required" data-validation-error-msg="Field Jabatan Tidak Boleh Kosong !">
                </div>
                <div class="form-group">
                  <label for="Gaji">Gaji</label>
                  <input type="text" class="form-control" id="gaji" name="gaji" placeholder="Isi Gaji"
                  data-validation="required" data-validation-error-msg="Field Gaji Tidak Boleh Kosong !">
                </div>
                <button type="submit" name="submit_jabatan" class="btn btn-primary">Tambah Data</button>
              </div>
              <!-- /.box-body -->
            </form>
          </div>       
        
        <!-- left column -->
        <div class="col-md-6">
        <?php 
           $query = "SELECT * FROM tb_jabatan";  
           $result = mysqli_query($koneksi, $query);  
        ?>
        <h3> LIST JABATAN </h3>
            <div>  
               <table class="table" id="example">
               <thead>
                  <tr>  
                         <th> Jabatan </th> 
                         <th> Gaji </th> 
                         <th> Action </th>
                  </tr>
               </thead>
               <tbody>
                 <?php  
                  $no = 1;
                      while($row = mysqli_fetch_array($result)) {  
               ?>
                    <tr>   
                         <td> <?php echo $row[jabatan] ?> </td>  
                         <td> Rp. <?php echo number_format($row[gaji]) ?> </td>
                         <td> <a href="#" id="<?php echo $row["id_jabatan"]; ?>" class="btn btn-danger btn-xs delete_data"> HAPUS </a><a href="#" id="<?php echo $row["id_jabatan"]; ?>" class="btn btn-warning btn-xs edit_jabatan">EDIT</a> </td>
                    </tr>
              <?php 
                  $no++;
                  } 
               ?>
               </tbody>
               </table>
            </div>
        </div>
        </div> 
</div>

       
</section>

<div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Hapus Data</h4>  
                </div>  
                <div class="modal-body" id="jabatan_detail">  
                </div>  
                <div class="modal-footer">    
                     <a href="pages/proses/proses_delete-jabatan.php" class="btn btn-danger">HAPUS</a>
                     <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>  
                </div>  
           </div>  
      </div>  
 </div>  



  <script>
     $(document).ready(function(){  
      $('.delete_data').click(function(){  
         var id_jabatan = $(this).attr("id");
          $.ajax({  
                url:"pages/fetchdata/fetch_data_jabatan.php",  
                method:"post",  
                data:{id_jabatan:id_jabatan},  
                success:function(data){
                 $('#jabatan_detail').html(data);           
                 $('#dataModal').modal("show");  
             }
         });
      });  
 });  
 </script>

 <div id="jabatan_Modal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">EDIT DATA JABATAN</h4>  
                </div>  
                <div class="modal-body">  
                     <form method="post" action="pages/proses/proses_edit-jabatan.php">  
                          <label>ID Jabatan</label>
                          <input type="text" name="id_jabatan" id="id_jabatan1" class="form-control" readonly />   
                          <br />
                          <label>Jabatan</label>  
                          <input type="text" name="jabatan" id="jabatan1" class="form-control" />  
                          <br />  
                          <label>Gaji</label>  
                          <input type="text" name="gaji" id="gaji1" class="form-control" />                        
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
  $(document).on('click', '.edit_jabatan', function(){ 
  var id_jabatan = $(this).attr("id");   
             $.ajax({  
                url:"pages/fetchdata/fetch_data_jabatan-json.php",  
                method:"POST",  
                data:{id_jabatan:id_jabatan},  
                dataType:"json",  
                success:function(data){ 
                     $('#id_jabatan1').val(data.id_jabatan); 
                     $('#jabatan1').val(data.jabatan);  
                     $('#gaji1').val(data.gaji);  
                     $('#insert').val("Update");  
                     $('#jabatan_Modal').modal('show');  
                }  
           });
      });    
</script>