<?php
//fetch.php
unset($_SESSION["isAbsenToday"]);
$today1=date("Y-m-d");
if(time() <= strtotime("09:00 AM")){
    $_SESSION["isAbsenToday"]=-1;
} else {
    unset($_SESSION["isAbsenToday"]);
    $conn = createConn();
    $id_anggota = $_SESSION['id_anggota'];
    $query = "SELECT id_anggota FROM tb_anggota WHERE id_anggota IN (SELECT id_anggota FROM tb_detail_absen WHERE id_anggota='$id_anggota' AND tanggal='$today1')";
    $res = $conn->query($query);
    $row = $res->num_rows;
    if($row>0){
        $_SESSION["isAbsenToday"]=1;
    } else {
        $_SESSION["isAbsenToday"]=0;
    }
}
echo $_SESSION["isAbsenToday"];
?>
