<?php
    include "../../fungsi_kakatu.php";
    $latitude = isset($_POST['latitude']) ? $_POST['latitude'] : '';
    $longitude = isset($_POST['longitude']) ? $_POST['longitude'] : '';
    $address = getAddress($latitude, $longitude);
    echo $address;
?>