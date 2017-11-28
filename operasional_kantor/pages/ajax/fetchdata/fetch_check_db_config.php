<?php
//fetch.php
include "../../../fungsi_kakatu.php";
$conn = createConn();
$query = "SELECT * FROM tb_konfigurasi_kakatu";
$res = $conn->query($query);
$row = $res->num_rows;
if ($row==0) {
   echo 0;
} else {
    $conn = createConn();
    $query2 = "SELECT * FROM tb_anggota";
    $res2 = $conn->query($query2);
    $row2 = $res2->num_rows;
    if ($row2==0) {
        echo 1;
    } else {
        echo 2;
    }
    
}
