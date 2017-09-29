 <?php  
include "../../con_db.php";
 error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

			$id = $_POST["id_libur"];
			$nama_libur = $_POST["nama_libur"];;
			$rangelibur = $_POST["reservationtime"];
			$tgl1 = substr($rangelibur,0,11);
			$tgl2 = substr($rangelibur,13,25);
			$query = "UPDATE tb_tgllibur SET nama_libur='$nama_libur',tglawal=STR_TO_DATE('$tgl1', '%m/%d/%Y'),tglakhir=STR_TO_DATE('$tgl2', '%m/%d/%Y'),jmlhari=DATEDIFF(STR_TO_DATE('$tgl2', '%m/%d/%Y'),STR_TO_DATE('$tgl1', '%m/%d/%Y'))+1 WHERE id='$id'";   
           
           $result =  mysqli_query($koneksi, $query);
           
           if (!$result) {
              printf("Error: %s\n", mysqli_error($koneksi));
              exit();
              } 
      ?>
      <script> alert("Data libur dengan ID <?php echo $id ?>, Berhasil Di Update"); document.location.href="../../index.php?sidebar-menu=list_data_libur&action=tampil" </script>   
