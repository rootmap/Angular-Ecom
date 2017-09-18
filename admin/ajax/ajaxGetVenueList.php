<?php

include '../../config/config.php';
$eventID = 0;
$arrGetVenueInfo = array();
extract($_POST);

if ($eventID > 0) {
    $sqlGetVenueInfo = "SELECT venue_id,venue_title FROM event_venues WHERE venue_event_id=$eventID";
    $resultGetVenueInfo = mysqli_query($con, $sqlGetVenueInfo);

    if ($resultGetVenueInfo) {
        while ($resultGetVenueInfoObj = mysqli_fetch_object($resultGetVenueInfo)) {
            $arrGetVenueInfo[] = $resultGetVenueInfoObj;
        }

        $return_array = array("output" => "success", "arrGetVenueInfo" => $arrGetVenueInfo);
        echo json_encode($return_array);
        exit();
    } else {
        if (DEBUG) {
            $return_array = array("output" => "error", "msg" => "resultGetVenueInfo error: " . mysqli_error($con));
            echo json_encode($return_array);
            exit();
        } else {
            $return_array = array("output" => "error", "msg" => "resultGetVenueInfo query failed.");
            echo json_encode($return_array);
            exit();
        }
    }
}


