<?php

include '../../../config/config.php';

$adminEventPermission = '';
$adminID = 0;
$adminEventID = '';

header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];
if ($verb == "GET") {
    $arr = array();
    $get_sql = "SELECT * FROM event_movie_show_time";
    $get_sql .= " ORDER BY id DESC";
    $resultVenue = mysqli_query($con, $get_sql);

    if ($resultVenue) {
        while ($obj = mysqli_fetch_object($resultVenue)) {
            $arr[] = $obj;
        }
    } else {
        if (DEBUG) {
            $err = "resultshowtime error: " . mysqli_error($con);
        } else {
            $err = "resultshowtime query failed";
        }
    }

    echo "{\"data\":" . json_encode($arr) . "}";
}
?>


