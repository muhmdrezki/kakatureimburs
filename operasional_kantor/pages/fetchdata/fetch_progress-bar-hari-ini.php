<?php  
 //fetch.php  
    include "../../con_db.php";
    $selectAbsen="SELECT COUNT(id_anggota) AS jumabsen,(SELECT COUNT(id_anggota) FROM tb_anggota) AS jumanggota FROM tb_detail_absen WHERE DATE(tanggal)=CURRENT_DATE()";
    $resAbsen = mysqli_query($koneksi, $selectAbsen);
    $rowAbsen= mysqli_fetch_assoc($resAbsen);
    $persen= ($rowAbsen['jumabsen']/$rowAbsen['jumanggota'])*100;
    $warna="";
    if($persen>=0 && $persen<=20){
        $warna="progress-bar-danger";
    } else if($persen>20 && $persen<=40) {
        $warna="progress-bar-warning";
    } else if($persen>40 && $persen<=60) {
        $warna="progress-bar-primary";
    } else if($persen>60 && $persen<=80) {
        $warna="progress-bar-info";
    } else if($persen>80 && $persen<=100) {
        $warna="progress-bar-success";
    }
    $data_progress = array();
    $data_progress['persen']= $persen;
    $data_progress['warna']= $warna;
    echo $json_progress=json_encode($data_progress);
?>