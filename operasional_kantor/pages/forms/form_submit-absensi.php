<?php
    if (!defined('DIDALAM_INDEX_PHP')) {
        //echo "Dilarang broh!";
        header("Location: ../../tampil/home");
    } else {
        //if ($_SESSION["isAbsenToday"]==-1) {
         //   echo '<script>alert("Absensi hanya bisa dimulai pukul 09:00 AM!");window.location="tampil/home"</script>';
        //} elseif($_SESSION["isAbsenToday"]==1) {
         //   echo '<script>alert("Anda sudah absen hari ini!");window.location="tampil/data-absensi"</script>';
        //} else {
            readfile('pages/views/forms/submit-absensi.html');
        //}
    }
?>