<?php

include '../../../config/config.php';


$eventId = 0;
$arrAllVenue = array();
extract($_POST);

if ($eventId > 0) {
    $sqlGetVenues = "SELECT venue_id,venue_title,venue_start_date "
            . "FROM event_venues "
            . "WHERE venue_event_id=$eventId "
            . "AND venue_status='active' "
            . "ORDER BY venue_title ASC";
    $resultGetVenues = mysqli_query($con, $sqlGetVenues);

    if ($resultGetVenues) {
        while ($resultGetVenuesObj = mysqli_fetch_object($resultGetVenues)) {
            $arrAllVenue[] = $resultGetVenuesObj;
            $arrAllVenue[(count($arrAllVenue) - 1)]->DateMod = date("jS F Y", strtotime($resultGetVenuesObj->venue_start_date));
        }
        $return_array = array("output" => "success", "resultGetVenuesObj" => $arrAllVenue);
        echo json_encode($return_array);
        exit();
    } else {
        if (DEBUG) {
            $return_array = array("output" => "error", "msg" => "resultGetVenues error: " . mysqli_error($con));
            echo json_encode($return_array);
            exit();
        } else {
            $return_array = array("output" => "error", "msg" => "resultGetVenues query failed.");
            echo json_encode($return_array);
            exit();
        }
    }
}
?>