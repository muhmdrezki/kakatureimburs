<?php
$latitude = isset($_POST['latitude']) ? $_POST['latitude'] : '';
$longitude = isset($_POST['longitude']) ? $_POST['longitude'] : '';
$address = '';
$output = null;
$API_KEY='AIzaSyAn0sCC7HGqbJbWhwkgJnvyWFiTa7QGtVI';
if(!empty($latitude) && !empty($longitude)){
    //Send request and receive json data by address
    $geocodeFromLatLong = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($latitude).','.trim($longitude).'&sensor=true&key='.trim($API_KEY)); 
    $output = json_decode($geocodeFromLatLong);
    $status = $output->status;
    //Get address from json data
    $address = ($status=="OK")?$output->results[0]->formatted_address:'';
    //Return address of the given latitude and longitude
}
$response = array(
    'latitude' => $latitude,
    'longitude' => $longitude,
    'address' => $address,
    'output' => $output,
);
echo json_encode($response);
?>