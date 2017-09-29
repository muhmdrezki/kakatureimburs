
<div class="content-header bounceInRight animated">
  
  <h2> DATA CREDITS </h2>

</div>

 <!-- jQuery 3 -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>

<div class="container bounceInUp animated">
	<hr>
		<div class="row">
			<div class="col-md-4">
				<h3> FORM TAMBAH DATA </h3>
				 <!-- form start -->
					<form role="form" action="pages/proses/proses_save-credits.php" method="POST">
					  <div class="box-body" style="margin-right: 20px;">
						<?php
							include "../../con_db.php";
							$sql_query1 = "SELECT tb_anggota.id_anggota,tb_anggota.nama FROM tb_anggota WHERE tb_anggota.id_anggota NOT IN (SELECT tb_credits_anggota.id_anggota FROM tb_credits_anggota)";
							$result = mysqli_query($koneksi, $sql_query1);
						?>      
					  <div class="form-group">
						<label>ID Anggota</label>
						<select class="form-control select2 btn-primary" data-placeholder="Pilih ID Anggota" name="id_anggota1" id="id_anggota1">
								<?php
								while ($row = mysqli_fetch_array($result)) {
								?>
								<option value="<?php echo $row[id_anggota]; ?>"> <?php echo $row["id_anggota"]." - ".$row["nama"]; ?> </option>
								<?php
								}
									?>
						</select>
					  </div>
						<div class="form-group">
						  <label for="Credit">Top Up Credit</label>
						  <input type="text" class="form-control" id="topup_credit1" name="topup_credit1" placeholder="Isi Topup"
						  data-validation="required" data-validation-error-msg="Field Topup Credit Tidak Boleh Kosong !">
						</div>
						<!--
						<div class="form-group">
						  <label for="Gaji">Total Credit</label>
						  <input type="text" class="form-control" id="total_credit" name="total_credit" placeholder="Isi Total Credit"
						  data-validation="required" data-validation-error-msg="Field Total Credit Tidak Boleh Kosong !">
						</div>
						-->
						<button type="submit" name="submit_credit" class="btn btn-primary">Tambah Data</button>
					  </div>
					  <!-- /.box-body -->
					</form>
			</div>       
			
			<!-- left column -->
			<div class="col-md-8">
				<?php
				   $query = "SELECT c.id_anggota,a.nama,topup_credit,total_credit FROM tb_credits_anggota c JOIN tb_anggota a WHERE c.id_anggota=a.id_anggota";
				   $result = mysqli_query($koneksi, $query);
				?>
				<h3> LIST CREDITS </h3>
					<div class="table-responsive">  
					   <table class="table" id="data_credits">
						   <thead>
							  <tr>  
									 <th> ID</th>
									 <th> Nama </th>  
									 <th> Top Up Credit </th>
									 <th> Total Credit </th>                         
									 <th> Action </th>
							  </tr>
						   </thead>
						   <tbody>
								<?php
								$no = 1;
								while ($row = mysqli_fetch_array($result)) {
							?>
							  <tr>   
								 <td> <?php echo $row["id_anggota"] ?> </td>
								 <td> <?php echo $row["nama"] ?> </td>
								 <td> Rp. <?php echo number_format($row[topup_credit]) ?> </td>
								 <td> Rp. <?php echo number_format($row[total_credit]) ?> </td>
								 <td> <a href="#" id="<?php echo $row["id_anggota"]; ?>" class="btn btn-danger btn-xs delete_data"> HAPUS </a><a href="#" id="<?php echo $row["id_anggota"]; ?>" class="btn btn-warning btn-xs topup_credit">EDIT</a><a href="#" id="<?php echo $row["id_anggota"]; ?>" class="btn btn-info btn-xs reset_total">RESET</a></td>
							  </tr>
							<?php
							$no++;
								}
							?>
						   </tbody>
							<tfoot>
								<tr>
								  <th>Total</th>
								  <th></th>
								  <th></th>
								  <?php
								   $query_total = "SELECT SUM(total_credit) AS sum_credit FROM tb_credits_anggota";
								   $result_total = mysqli_query($koneksi, $query_total);
								   $row_total = mysqli_fetch_assoc($result_total);
								  ?>
								  <th>Rp.<?php echo number_format($row_total["sum_credit"]) ?></th>
								  <th><a  href="#" class="btn btn-danger btn-xs reset_all_totalcredit">RESET TOTAL</a></th>
								</tr>
							</tfoot>
					   </table
					</div>
			</div>
		</div>  
</div>      
</div>
<div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Hapus Data</h4>  
                </div>  
                <div class="modal-body" id="credit_detail_hapus">  
                </div>  
                <div class="modal-footer">    
                     <a href="pages/proses/proses_delete-credit.php" class="btn btn-danger">HAPUS</a>
                     <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>  
                </div>  
           </div>  
      </div>  
 </div>  



  <script>
     $(document).ready(function(){  
      $('.delete_data').click(function(){  
         var id_anggota = $(this).attr("id");
          $.ajax({
                url:"pages/fetchdata/fetch_data_credit-fordelete.php",  
                method:"post",  
                data:{id_anggota:id_anggota},  
                success:function(data){
                 $('#credit_detail_hapus').html(data);           
                 $('#dataModal').modal("show");  
             }
         });
      });  
 });  
 </script>

 <div id="credit_Modal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">EDIT DATA CREDIT</h4>  
                </div>  
                <div class="modal-body">  
                     <form method="post" action="pages/proses/proses_edit-credit.php">  
                          <label>ID Anggota</label>
                          <input type="text" name="id_anggota" id="id_anggota" class="form-control" readonly />   
                          <br />
                          <label>TopUp</label>  
                          <input type="text" name="topup_credit" id="topup_credit" class="form-control" />                    
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
  $(document).on('click', '.topup_credit', function(){ 
  var id_anggota = $(this).attr("id");   
             $.ajax({  
                url:"pages/fetchdata/fetch_data_credit-json.php",  
                method:"POST",  
                data:{id_anggota:id_anggota},  
                dataType:"json",  
                success:function(data){ 
                     $('#id_anggota').val(data.id_anggota); 
                     $('#topup_credit').val(data.topup_credit);   
                     $('#insert').val("Update");  
                     $('#credit_Modal').modal('show');  
                }  
           });
      });    
</script>

<div id="resetModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Reset Total Credit</h4>  
                </div>  
                <div class="modal-body" id="credit_detail_reset">  
                </div>  
                <div class="modal-footer">    
                     <a href="pages/proses/proses_reset-credit.php" class="btn btn-info">Reset</a>
                     <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>  
                </div>  
           </div>  
      </div>  
 </div>  



  <script>
     $(document).ready(function(){  
      $('.reset_total').click(function(){  
         var id_anggota = $(this).attr("id");
          $.ajax({
                url:"pages/fetchdata/fetch_data_credit-forreset.php",  
                method:"post",  
                data:{id_anggota:id_anggota},  
                success:function(data){
                 $('#credit_detail_reset').html(data);           
                 $('#resetModal').modal("show");  
             }
         });
      });  
 });  
 </script>
 
 <div id="resetTotalModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Reset All Total Credit</h4>  
                </div>  
                <div class="modal-body" id="credit_all_reset">  
                </div>  
                <div class="modal-footer">    
                     <a href="pages/proses/proses_reset-all-credit.php" class="btn btn-info">Reset All</a>
                     <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>  
                </div>  
           </div>  
      </div>  
 </div>  



  <script>
     $(document).ready(function(){  
      $('.reset_all_totalcredit').click(function(){  
          $.ajax({
                url:"pages/fetchdata/fetch_data_credit-forresetallcredit.php",  
                method:"post",  
                data:{},  
                success:function(data){
                 $('#credit_all_reset').html(data);           
                 $('#resetTotalModal').modal("show");  
             }
         });
      });  
 });  
 </script>
