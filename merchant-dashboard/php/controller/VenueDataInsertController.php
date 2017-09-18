<?php

include '../../DBconnection/auth.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Including database connections start here
require_once '../../DBconnection/database_connections.php';
// Including database connections end here

//
//function Get_LatLng_From_Google_Maps($address) {
//    $address = urlencode($address);
//    $geocode='';
//    $url = "http://maps.googleapis.com/maps/api/geocode/json?address=$address&sensor=false";
//
//    // Make the HTTP request
//    $data = @file_get_contents($url);
//    // Parse the json response
//    $jsondata = json_decode($data,true);
//
//    // If the json data is invalid, return empty array
//    if (!check_status($jsondata)) {
//        return $geocode .='23.8751027,90.39067810000006';
//    }
//
//    $LatLng = array(
//        'lat' => $jsondata["results"][0]["geometry"]["location"]["lat"],
//        'lng' => $jsondata["results"][0]["geometry"]["location"]["lng"],
//    );
//     //$geocode .=implode(",",$LatLng);
//     return $geocode .=implode(",",$LatLng);
//}

function getCoordinates($address){
 $geocode='';
$address = str_replace(" ", "+", $address); // replace all the white space with "+" sign to match with google search pattern
 
$url = "http://maps.googleapis.com/maps/api/geocode/json?address=$address&sensor=false";
 
$response = file_get_contents($url);
 
$json = json_decode($response,TRUE); //generate array object from the response from the web
if (empty($json)) {
    return $geocode .='23.8751027,90.39067810000006';
}else{
        return $geocode .=(
                $json['results'][0]['geometry']['location']['lat'].",".$json['results'][0]['geometry']['location']['lng']);
    }
}

/* Data convert by jeson start here */
$data = json_decode(file_get_contents("php://input"));
/* ./Data convert by jeson end here */

if (isset($data->venue_id)) {
    $updateId = $data->venue_id;
} else {
    $updateId = 0;
}





$VenueEventid = $data->event;
$NameOfVenue = $data->NameOfVenue;
$StreetLine = $data->StreetLine;
$CityFrom = $data->CityFrom;
$Country = $data->Country;

 $geocode=getCoordinates($NameOfVenue);


if ($updateId == 0) {
   $sql = "INSERT INTO event_venues SET  venue_event_id='$VenueEventid',venue_title='$NameOfVenue',
      	venue_description='$StreetLine',city='$CityFrom',country='$Country',venue_geo_location='$geocode',venue_created_by='$login_user_id'";
} else {
    $sql = "UPDATE event_venues SET venue_event_id='$VenueEventid',venue_title='$NameOfVenue',
      	venue_description='$StreetLine',city='$CityFrom',country='$Country',venue_geo_location='$geocode' WHERE venue_id='$updateId' AND venue_created_by='$login_user_id'";
}

$result = mysqli_query($con, $sql);
if ($result == 1) {
    echo true;
} else {
    echo "2";
}