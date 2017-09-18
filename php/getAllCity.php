<?php 
include'../DBconnection/database_connections.php';

// Get All Cities For User Address
$cityArray = array();
$citySql = "SELECT * FROM cities WHERE city_status = 'allow'";
$resultCity = mysqli_query($con, $citySql);
if ($resultCity) {
    while ($rowCity = mysqli_fetch_object($resultCity)) {
        $cityArray[] = $rowCity;
    }
} else {
    if (true) {
        $err = "resultCity error: " . mysqli_error($con);
    } else {
        $err = "resultCity query failed";
    }
}


echo json_encode($cityArray);





?>
