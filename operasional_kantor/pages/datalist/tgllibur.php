
<div class="content-header bounceInRight animated">
  
  <h2> DATA TANGGAL LIBUR </h2>

</div>

 <!-- jQuery 3 -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>

<div class="container bounceInUp animated">
	<hr>
		<div class="row">
			<div class="col-md-4">
				<h3> FORM TAMBAH DATA </h3>
				 <!-- form start -->
					<form role="form" action="pages/proses/proses_save-tgllibur.php" method="POST">
					  <div class="box-body" style="margin-right: 20px;">  
						<div class="form-group">
						  <label for="Credit">Nama Libur</label>
						  <input type="text" class="form-control" id="namalibur1" name="nama_libur1" placeholder="Isi Nama Libur"
						  data-validation="required" data-validation-error-msg="Field Nama Libur Tidak Boleh Kosong !">
						</div>
						<!-- Date -->
						<div class="form-group">
							<label>Date:</label>
							<div class="input-group date">
							  <div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							  </div>
							  <input type="text" class="form-control pull-right" id="tglRentangLibur" name="reservation">
							</div>
							<!-- /.input group -->
						</div>
						<!-- /.form group -->
						<button type="submit" name="submit_libur" class="btn btn-primary">Tambah Data</button>
					  </div>
					  <!-- /.box-body -->
					</form>
			</div>       
			
			<!-- left column -->
			<div class="col-md-8">
				<?php
				   $query = "SELECT * FROM tb_tgllibur";
				   $result = mysqli_query($koneksi, $query);
				?>
				<h3> LIST TANGGAL LIBUR </h3>
					<div class="table-responsive">  
					   <table class="table" id="example">
						   <thead>
							  <tr>  
									 <th> ID</th>
									 <th> Nama Libur </th>  
									 <th> Dari </th>
									 <th> Sampai </th>
									 <th> Jumlah Hari </th>									 
									 <th> Action </th>
							  </tr>
						   </thead>
						   <tbody>
								<?php
								$no = 1;
								while ($row = mysqli_fetch_array($result)) {
							?>
							  <tr>   
								 <td> <?php echo $row["id"] ?> </td>
								 <td> <?php echo $row["nama_libur"] ?> </td>
								 <td> <?php echo $row["tglawal"] ?> </td>
								 <td> <?php echo $row["tglakhir"] ?> </td>
								 <td> <?php echo $row["jmlhari"] ?> </td>
								 <td><a href="#" id="<?php echo $row["id"]; ?>" class="btn btn-danger btn-xs delete_libur">HAPUS</a><a href="#" id="<?php echo $row["id"]; ?>" class="btn btn-warning btn-xs edit_libur">EDIT</a></td>
							  </tr>
							<?php
							$no++;
								}
							?>
						   </tbody>
							<tfoot>
								<tr>
								  <th></th>
								  <th></th>
								  <th></th>
								  <?php
								   $query_total = "SELECT SUM(jmlhari) AS total_libur FROM tb_tgllibur";
								   $result_total = mysqli_query($koneksi, $query_total);
								   $row_total = mysqli_fetch_assoc($result_total);
								  ?>
								  <th>Total Hari Libur</th>
								  <th><?php echo $row_total["total_libur"] ?></th>
								</tr>
							</tfoot>
					   </table
					</div>
			</div>
		</div>  
</div>      
</div>
<div id="liburModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Hapus Data</h4>  
                </div>  
                <div class="modal-body" id="libur_detail_hapus">  
                </div>  
                <div class="modal-footer">    
                     <a href="pages/proses/proses_delete-libur.php" class="btn btn-danger">HAPUS</a>
                     <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>  
                </div>  
           </div>  
      </div>  
 </div>  



  <script>
     $(document).ready(function(){  
      $('.delete_libur').click(function(){  
         var id_libur= $(this).attr("id");
		 			console.log(id_libur);
          $.ajax({
                url:"pages/fetchdata/fetch_data_libur-fordelete.php",  
                method:"POST",  
                data:{id:id_libur},  
                success:function(data){
                 $('#libur_detail_hapus').html(data);           
                 $('#liburModal').modal("show");  
             }
         });
      });  
 });  
 </script>
 <div id="liburEditModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">EDIT TANGGAL LIBUR</h4>  
                </div>  
                <div class="modal-body">  
                     <form method="post" action="pages/proses/proses_edit-libur.php">  
                          <label>ID</label>
                          <input type="text" name="id_libur" id="id_libur" class="form-control" readonly />   
                          <br />
                          <label>Nama Libur</label>  
                          <input type="text" name="nama_libur" id="nama_libur" class="form-control" />
													<!-- Date -->
													<div class="form-group">
														<label>Date:</label>
														<div class="input-group date">
															<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
															</div>
															<input type="text" class="form-control pull-right" id="tglRentangLiburEdit" name="reservationtime">
														</div>
														<!-- /.input group -->
													</div>
												<!-- /.form group -->
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
  $(document).on('click', '.edit_libur', function(){ 
  var id_libu = $(this).attr("id");   
             $.ajax({  
                url:"pages/fetchdata/fetch_data_libur-json.php",  
                method:"POST",  
                data:{id_liburr:id_libu},  
                dataType:"json",  
                success:function(data){
					 						console.log(data.nama_libur);
                     $('#id_libur').val(data.id); 
                     $('#nama_libur').val(data.nama_libur);
					 						$('#tglRentangLiburEdit').val(data.tgl1+" - "+data.tgl2); 	
                     $('#insert').val("Update");  
                     $('#liburEditModal').modal('show');  
                }  
           });
      });    
</script>
