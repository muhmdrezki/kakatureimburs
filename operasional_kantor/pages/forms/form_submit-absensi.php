<?php
    if (!defined('DIDALAM_INDEX_PHP')) {
        //echo "Dilarang broh!";
        header("Location: ../../tampil/home");
    } else {
        //if ($_SESSION["isAbsenToday"]==-2) {
          //  echo '<script>alert("Absen ga bisa di hari Sabtu atau Minggu cuy!");window.location="tampil/home"</script>';
        //} else
        if ($_SESSION["isAbsenToday"]==-1) {
            echo '<script>alert("Absen cuma bisa setelah jam 04:00 AM cuy!");window.location="tampil/home"</script>';
        } elseif($_SESSION["isAbsenToday"]==1) {
            echo '<script>alert("Kan sudah absen hari ini! Masa lupa?");window.location="tampil/data-absensi"</script>';
        } else {
            readfile('pages/views/forms/submit-absensi.html');
        }
    }
?>