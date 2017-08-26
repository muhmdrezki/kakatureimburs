      <?php 
        $id_jenis = mt_rand(06,999);
      ?>

<section id="form_jenis-pembayaran" style="margin: 0 auto;">

<div class="content-header bounceInRight animated">
  
  <h2> JENIS PEMBAYARAN OPERASIONAL </h2>

</div>

<div class="container bounceInUp animated">
<hr>
  <div class="row">
        <div class="col-md-6">
        <h3> FORM TAMBAH DATA </h3>
         <!-- form start -->
            <form role="form" action="pages/proses_save-jenistransaksi.php" method="POST">
              <div class="box-body">
                <div class="form-group">
                  <label for="ID">ID</label>
                  <input type="text" class="form-control" id="id_jenis" name="id_jenis" value="<?php echo "TR-$id_jenis"?>" readonly>
                </div>
                <div class="form-group">
                  <label for="jenis_pembayaran">Jenis Pembayaran</label>
                  <input type="text" class="form-control" id="jenis" name="jenis" placeholder="Isi Jenis Pembayaran"
                  data-validation="required" data-validation-error-msg="Field Tidak Boleh Kosong !">
                </div>
                <button type="submit" name="submit_jenis" class="btn btn-primary">Tambah Data</button>
             </div>
            </form>
          </div>       
        
        <!-- left column -->
        <div class="col-md-6">
        <?php 
           $query = "SELECT * FROM tb_jenistransaksi";  
           $result = mysqli_query($koneksi, $query);  
        ?>
        <h3> LIST JENIS PEMBAYARAN </h3>
            <div class="table-responsive">  
               <table class="table" id="example">
               <thead>
                  <tr>  
                         <th> ID Jenis </th>  
                         <th> Jenis </th> 
                         <th> Action </th>
                  </tr>
               </thead>
               <tbody>
                 <?php  
                  $no = 1;
                      while($row = mysqli_fetch_array($result)) {  
               ?>
                    <tr>  
                         <td> <?php echo $row[id_jenis] ?> </td>  
                         <td> <?php echo $row[jenis] ?> </td>  
                         <td> <a href="#" class="btn btn-danger btn-xs"> HAPUS </a><a href="#" class="btn btn-warning btn-xs"> EDIT </a> </td>
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