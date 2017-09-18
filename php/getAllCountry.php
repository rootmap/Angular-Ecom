<?php 
include'../DBconnection/database_connections.php';


// Get All Countries For User Address

$countryArray = array();
 $countrySql = "SELECT * FROM countries WHERE country_status='allow'";
$resultCountry = mysqli_query($con, $countrySql);
if ($resultCountry) {
    while ($rowCountry = mysqli_fetch_object($resultCountry)) {
        $countryArray[] = $rowCountry;
    }
} else {
    if (true) {
        $err = "resultCountry error: " . mysqli_error($con);
    } else {
        $err = "resultCountry query failed";
    }
}





echo json_encode($countryArray);





?>
