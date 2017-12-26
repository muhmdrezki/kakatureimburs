<?php
//fetch.php
$query = "SELECT COUNT(jam_masuk) AS value,'Ontime' AS label FROM tb_detail_absen WHERE DATE(tanggal)='$today' AND TIME(jam_masuk)<='10:00:00' GROUP BY tanggal";
$result = mysqli_query($koneksi, $query);
$all = array();
while ($row = mysqli_fetch_assoc($result)) {
    $all[] = $row;
}
$query2 = "SELECT COUNT(jam_masuk) AS value,'Late' AS label FROM tb_detail_absen WHERE DATE(tanggal)='$today' AND TIME(jam_masuk)>'10:00:00' GROUP BY tanggal";
$result2 = mysqli_query($koneksi, $query2);
while ($row2 = mysqli_fetch_assoc($result2)) {
    $all[] = $row2;
}
$data = json_encode($all);
echo $data;
