<?php
   if (!defined('DIDALAM_INDEX_PHP')){ 
    //echo "Dilarang broh!";
        header("Location: ../../tampil/home");
	}
	if ($_SESSION['jabatan']!="Admin") {
		echo '<script>alert("Maaf, Anda bukan Admin"); window.location="../../tampil/home"</script>';
	 } else {
			readfile('pages/views/datalist/tgllibur.html');
	 }
?>


