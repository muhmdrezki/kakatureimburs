<?php
//include "../../../fungsi_kakatu.php";
$connect = createConn();
$columns = array('id', 'CONCAT(d.tanggal," ",d.jam_masuk)', 'id_anggota', 'nama', 'status');
$query = "SELECT d.id AS id,d.tanggal AS tanggal,d.jam_masuk AS jam_masuk,d.jam_keluar AS jam_keluar,d.id_anggota AS id_anggota, a.nama AS nama, b.status AS status FROM tb_detail_absen d JOIN tb_absen b ON d.status_id=b.status_id JOIN tb_anggota a ON d.id_anggota = a.id_anggota";
$isAdmin = strpos($_SESSION['jabatan'], 'Admin') !== false;
if (isset($_POST["search"]["value"])) {
    $searchValue = antiInjection($_POST["search"]["value"]);
    if ($_POST["tgl1"] != '') {
        if ($isAdmin == 1) {
            $tgl1 = antiInjection($_POST["tgl1"]);
            $tgl2 = antiInjection($_POST["tgl2"]);
            $_SESSION['tglFilterDataAbsen1'] = $tgl1;
            $_SESSION['tglFilterDataAbsen2'] = $tgl2;
            $query .= '
            WHERE (d.id = "' . $searchValue . '"
            OR d.tanggal LIKE "%' . $searchValue . '%"
            OR d.jam_masuk LIKE "%' . $searchValue . '%"
            OR d.jam_keluar LIKE "%' . $searchValue . '%"
            OR a.nama LIKE "%' . $searchValue . '%"
            OR b.status = "' . $searchValue . '")
            AND d.tanggal BETWEEN "' . $_SESSION['tglFilterDataAbsen1'] . '" AND "' . $_SESSION['tglFilterDataAbsen2'] = $tgl2 . '"';
        } else {
            $tgl1 = antiInjection($_POST["tgl1"]);
            $tgl2 = antiInjection($_POST["tgl2"]);
            $_SESSION['tglFilterDataAbsen1'] = $tgl1;
            $_SESSION['tglFilterDataAbsen2'] = $tgl2;
            $query .= '
            WHERE (d.id = "' . $searchValue . '"
            OR d.tanggal LIKE "%' . $searchValue . '%"
            OR d.jam_masuk LIKE "%' . $searchValue . '%"
            OR d.jam_keluar LIKE "%' . $searchValue . '%"s
            OR a.nama LIKE "%' . $searchValue . '%"
            OR b.status = "' . $searchValue . '")
            AND (d.tanggal BETWEEN "' . $_SESSION['tglFilterDataAbsen1'] . '" AND "' . $_SESSION['tglFilterDataAbsen2'] = $tgl2 . '")
            AND (d.id_anggota= "' . $_SESSION['id_anggota'] . '")';
        }
    } else {
        if (isset($_SESSION['tglFilterDataAbsen1'])) {
            if ($isAdmin == 1) {
                $query .= '
                WHERE (d.id = "' . $searchValue . '"
                OR d.tanggal LIKE "%' . $searchValue . '%"
                OR d.jam_masuk LIKE "%' . $searchValue . '%"
                OR d.jam_keluar LIKE "%' . $searchValue . '%"
                OR a.nama LIKE "%' . $searchValue . '%"
                OR b.status = "' . $searchValue . '")
                AND d.tanggal BETWEEN "' . $_SESSION['tglFilterDataAbsen1'] . '" AND "' . $_SESSION['tglFilterDataAbsen2'] = $tgl2 . '"';
                unset($_SESSION['tglFilterDataAbsen1']);
            } else {
                $query .= '
                WHERE (d.id = "' . $searchValue . '"
                OR d.tanggal LIKE "%' . $searchValue . '%"
                OR d.jam_masuk LIKE "%' . $searchValue . '%"
                OR d.jam_keluar LIKE "%' . $searchValue . '%"
                OR a.nama LIKE "%' . $searchValue . '%"
                OR b.status = "' . $searchValue . '")
                AND (d.tanggal BETWEEN "' . $_SESSION['tglFilterDataAbsen1'] . '" AND "' . $_SESSION['tglFilterDataAbsen2'] = $tgl2 . '")
                AND (d.id_anggota= "' . $_SESSION['id_anggota'] . '")';
                unset($_SESSION['tglFilterDataAbsen1']);
            }
        } else {
            if ($isAdmin == 1) {
                $query .= '
                WHERE d.id = "' . $searchValue . '"
                OR d.tanggal LIKE "%' . $searchValue . '%"
                OR d.jam_masuk LIKE "%' . $searchValue . '%"
                OR d.jam_keluar LIKE "%' . $searchValue . '%"
                OR a.nama LIKE "%' . $searchValue . '%"
                OR b.status = "' . $searchValue . '"';
            } else {
                $query .= '
                WHERE (d.id = "' . $searchValue . '"
                OR d.tanggal LIKE "%' . $searchValue . '%"
                OR d.jam_masuk LIKE "%' . $searchValue . '%"
                OR d.jam_keluar LIKE "%' . $searchValue . '%"
                OR a.nama LIKE "%' . $searchValue . '%"
                OR b.status = "' . $searchValue . '")
                AND (d.id_anggota= "' . $_SESSION['id_anggota'] . '")';
            }
        }
    }
}

if (isset($_POST["order"])) {
    $query .= ' ORDER BY ' . $columns[antiInjection($_POST['order']['0']['column'])] . ' ' . antiInjection($_POST['order']['0']['dir']) . '
 ';
} else {
    $query .= ' ORDER BY d.id DESC ';
}

$query1 = '';

if ($_POST["length"] != -1) {
    $query1 = 'LIMIT ' . antiInjection($_POST['start']) . ', ' . antiInjection($_POST['length']);
}
$resRow = $connect->query($query);
$number_filter_row = $resRow->num_rows;

$result = $connect->query($query . " " . $query1);

$data = array();

while ($row = $result->fetch_array()) {
    $sub_array = array();
    $sub_array[] = $row["id"];
    $sub_array[] = $row["tanggal"];
    $sub_array[] = $row["jam_masuk"];
    if ($row["jam_keluar"]===null) {
        $sub_array[] = " -";
    } else {
        $sub_array[] = $row["jam_keluar"];
    }
    $sub_array[] = $row["id_anggota"];
    $sub_array[] = $row["nama"];
    if ($row['status'] == "Sakit") {
        $sub_array[] = "<span class=\"label label-danger\">SAKIT</span>";
    } elseif ($row['status'] == "Izin") {
        $sub_array[] = "<span class=\"label label-warning\">IZIN</span>";
    } elseif ($row['status'] == "Tugas Kantor") {
        $sub_array[] = "<span class=\"label label-primary\">TUGAS KANTOR</span>";
    } elseif ($row['status'] == "Hadir") {
        $sub_array[] = "<span class=\"label label-info\">HADIR</span>";
    } elseif ($row['status'] == "Cuti") {
        $sub_array[] = "<span class=\"label label-success\">CUTI</span>";
    } elseif ($row['status'] == "Kerja Remote") {
        $sub_array[] = "<span class=\"label label-default\">KERJA REMOTE</span>";
    } elseif ($row['status'] == "Alpha") {
        $sub_array[] = "<span class=\"label label-default\">ALPHA</span>";
    }
    //Cek Bulan Sekarang
    $blnskrg = new DateTime();
    $blnskrg->setTimezone(new DateTimeZone('Asia/Jakarta'));
    $blnskrgformat = $blnskrg->format('Ym');
    $blndata = new DateTime($row["tanggal"]);
    $blndataformat = $blndata->format('Ym');
    $disabled = "";
    //End Cek Bulan Sekarang
    if ((intval($blndataformat) === intval($blnskrgformat)) && $isAdmin == 1) {
        $sub_array[] = '<a id="' . $row["id"] . '" class="btn btn-info btn-xs detail_kehadiran"> DETAIL </a><a id="' . $row["id"] . '" class="btn btn-warning btn-xs edit_absen">EDIT</a>';
    } else {
        $sub_array[] = '<a id="' . $row["id"] . '" class="btn btn-info btn-xs detail_kehadiran"> DETAIL </a>';
    }
    $data[] = $sub_array;
}

function get_all_data($connect)
{
    $query = "SELECT * FROM tb_detail_absen";
    $result = $connect->query($query);
    return $result->num_rows;
}

$output = array(
    "draw" => intval($_POST["draw"]),
    "recordsTotal" => get_all_data($connect),
    "recordsFiltered" => $number_filter_row,
    "data" => $data,
);

echo json_encode($output);
