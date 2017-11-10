<?php
   if (!defined('DIDALAM_INDEX_PHP')){ 
    //echo "Dilarang broh!";
        header("Location: ../../tampil/home");
    }
    if ($_SESSION['jabatan']!="Admin") {
      echo '<script>alert("Maaf, Anda bukan Admin"); window.location="../../tampil/home"</script>';
   }
?>
<div class="content-header bounceInRight animated">
  
  <h2> DATA UANG AKOMODASI </h2>

</div>

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
							$sql_query1 = "SELECT id_anggota,nama FROM tb_anggota WHERE id_anggota NOT IN (SELECT id_anggota FROM tb_credits_anggota)";
							$result = mysqli_query($koneksi, $sql_query1);
						?>      
					  <div class="form-group">
						<label>Nama Anggota</label>
						<select class="form-control select2 btn-primary" data-placeholder="Pilih ID Anggota" name="id_anggota1" id="id_anggota1">
								<?php
								while ($row = mysqli_fetch_array($result)) {
								?>
								<option value="<?php echo $row['id_anggota']; ?>"> <?php echo $row["id_anggota"]." - ".$row["nama"]; ?> </option>
								<?php
								}
									?>
						</select>
					  </div>
						<div class="form-group">
						  <label for="Credit">Jumlah Akomodasi</label>
						  <input type="text" class="form-control" id="topup_credit1" name="topup_credit1" placeholder="Isi Jumlah Akomodasi per absen"
						  data-validation="required" data-validation-error-msg="Field Jumlah Akomodasi Tidak Boleh Kosong !">
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
          if (isset($_POST['status_paid'])) {
            $query = "SELECT a.id_anggota AS id_anggota,b.nama AS nama,c.topup_credit AS jumlah,DATE_FORMAT(a.tanggal,'%Y-%m') AS bulan,SUM(a.credit_in) AS total,a.credit_stat AS status FROM tb_detail_absen a JOIN tb_anggota b ON a.id_anggota=b.id_anggota JOIN tb_credits_anggota c ON a.credit_id=c.id WHERE a.credit_stat='paid' GROUP BY bulan,a.id_anggota ORDER BY bulan DESC";
            $query_total = "SELECT SUM(a.credit_in) AS total FROM tb_detail_absen a JOIN tb_credits_anggota b ON a.credit_id=b.id WHERE a.credit_stat='paid'";
          } else {
            $query = "SELECT a.id_anggota AS id_anggota,b.nama AS nama,c.topup_credit AS jumlah,DATE_FORMAT(a.tanggal,'%Y-%m') AS bulan,SUM(a.credit_in) AS total,a.credit_stat AS status FROM tb_detail_absen a JOIN tb_anggota b ON a.id_anggota=b.id_anggota JOIN tb_credits_anggota c ON a.credit_id=c.id WHERE a.credit_stat='unpaid' AND MONTH(a.tanggal)=MONTH(CURRENT_DATE()) AND YEAR(a.tanggal)=YEAR(CURRENT_DATE()) GROUP BY a.id_anggota";
            $query_total = "SELECT SUM(a.credit_in) AS total FROM tb_detail_absen a JOIN tb_credits_anggota b ON a.credit_id=b.id WHERE a.credit_stat='unpaid' AND MONTH(a.tanggal)=MONTH(CURRENT_DATE()) AND YEAR(a.tanggal)=YEAR(CURRENT_DATE())";
          }
          
				  
				   $result = mysqli_query($koneksi, $query);
				?>
				<h3> LIST AKOMODASI </h3>
        <div class="form-group flipInX animated">
            <label> FILTER STATUS </label>
              <form method="POST" action="tampil/data-credits"> 
                 <div class="input-group">
                      <a href="tampil/data-credits" class="btn btn-danger btn-xs">UNPAID</a>
                      <input type="submit" name="status_paid" value="PAID" class="btn btn-success btn-xs" style="margin-left: 3px;">               
                 </div>
            </div>
					<div class="table-responsive">  
					   <table class="table" id="data_credits">
						   <thead>
							  <tr>  
									 <th> ID</th>
									 <th> Nama </th>  
									 <th> Jumlah</th>
                   <th> Bulan</th>
                   <th> Total</th>
                   <th> Status</th>
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
								 <td>Rp. <?php echo number_format($row['jumlah']) ?> </td>

                 <td> <?php echo $row["bulan"] ?></td>
								 <td>Rp. <?php echo number_format($row['total']) ?> </td>
                 <td> <?php
                          if ($row["status"]=="paid") {
                              echo "<span class='label label-success'>".strtoupper($row['status'])."</span>";
                          } else {
                              echo "<span class='label label-danger'>".strtoupper($row['status'])."</span>";
                          }
                      ?>
                 </td>
                 <?php
                    if ($row["status"]=="paid") {
                    ?>
                    <td></td>
                  <?php
                    } else {
                  ?>
                    <td> <a id="<?php echo $row["id_anggota"]; ?>" class="btn btn-danger btn-xs delete_data"> HAPUS </a><a id="<?php echo $row["id_anggota"]; ?>" class="btn btn-warning btn-xs edit_topup_credit">EDIT</a><a id="<?php echo $row["id_anggota"]; ?>" class="btn btn-info btn-xs paid_total_credit" style="float:left;">BAYAR</a></td>
                  <?php
                    }
                 ?>
								 
							  </tr>
							<?php
							$no++;
								}
							?>
						   </tbody>
							<tfoot>
								<tr>
                <?php
								   
								   $result_total = mysqli_query($koneksi, $query_total);
								   $row_total = mysqli_fetch_assoc($result_total);
								  ?>
								  <th>Total</th>
								  <th></th>
								  <th></th>
                  <th></th>

								  <th>Rp.<?php echo number_format($row_total["total"]) ?></th>
                  <th></th>
								  <th><a  class="btn btn-success btn-xs paid_all_total_credit">BAYAR SEMUA BULAN INI</a></th>
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

 <div id="editCreditModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">EDIT DATA AKOMODASI</h4>  
                </div>  
                <div class="modal-body">  
                     <form method="post" action="pages/proses/proses_edit-credit.php">  
                          <label>ID</label>
                          <input type="text" name="id_anggota_credit" id="id_anggota_credit" class="form-control" readonly />   
                          <br />
                          <label>Jumlah</label>  
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

<div id="paidCreditModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Bayar Total Akomodasi</h4>  
                </div>  
                <div class="modal-body" id="credit_detail_paid">  
                </div>  
                <div class="modal-footer">    
                     <a href="pages/proses/proses_reset-credit.php" class="btn btn-info">BAYAR</a>
                     <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>  
                </div>  
           </div>  
      </div>  
 </div>  
 
 <div id="resetTotalModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Bayar Semua Total Akomidasi Bulan ini</h4>  
                </div>  
                <div class="modal-body" id="credit_all_reset">  
                </div>  
                <div class="modal-footer">    
                     <a href="pages/proses/proses_reset-all-credit.php" class="btn btn-info">Bayar</a>
                     <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>  
                </div>  
           </div>  
      </div>  
 </div>  