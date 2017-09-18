<?php

include '../../../config/config.php';

$adminEventPermission = '';
$adminID = 0;
$adminEventID = '';

header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];
if ($verb == "GET") {
    $arr = array();
    $get_sql = "SELECT * FROM event_movie_theatre";
    $get_sql .= " ORDER BY theatre_id DESC";
    $resultVenue = mysqli_query($con, $get_sql);

    if ($resultVenue) {
        while ($obj = mysqli_fetch_object($resultVenue)) {
            $arr[] = $obj;
        }
    } else {
        if (DEBUG) {
            $err = "resultTheatre error: " . mysqli_error($con);
        } else {
            $err = "resultTheatre query failed";
        }
    }

    echo "{\"data\":" . json_encode($arr) . "}";
}
?>


