<?php
    if (!defined('DIDALAM_INDEX_PHP')) {
        //echo "Dilarang broh!";
        header("Location: ../../tampil/home");
    } else {
        readfile('pages/views/forms/submit-absensi.html');
    }
?>