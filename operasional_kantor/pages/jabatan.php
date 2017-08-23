      <?php 
        $id_jabatan = mt_rand(100,999);
      ?>

<section id="form_jabatan-jenis" style="margin: 0 auto;">

<div class="content-header">
  
  <h2> DATA JABATAN </h2>

</div>

<div class="container">
<hr>
  <div class="row">
        <div class="col-md-6">
        <h3> FORM TAMBAH DATA </h3>
         <!-- form start -->
            <form role="form" action="pages/proses_save-jabatan.php" method="POST">
              <div class="box-body" style="margin-right: 20px;">
                <div class="form-group">
                  <label for="ID">ID</label>
                  <input type="text" class="form-control" id="id_jabatan" name="id_jabatan" readonly value="<?php echo $id_jabatan ?>">
                </div>
                <div class="form-group">
                  <label for="Jabatan">Jabatan</label>
                  <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Isi Jabatan">
                </div>
                <div class="form-group">
                  <label for="Gaji">Gaji</label>
                  <input type="number" min="0" class="form-control" id="gaji" name="gaji" placeholder="Isi Gaji">
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
            <div class="table-responsive">  
               <table class="table" id="example">
               <thead>
                  <tr>  
                         <th> ID Jabatan </th>  
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
                         <td> <?php echo $row[id_jabatan] ?> </td>  
                         <td> <?php echo $row[jabatan] ?> </td>  
                         <td> Rp. <?php echo $row[gaji] ?> </td>
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