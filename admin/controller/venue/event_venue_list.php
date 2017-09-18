<?php

include '../../../config/config.php';

header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];
if ($verb == "GET") {
    $event_id = $_GET["event_id"];
    $arr = array();
    $get_sql = "SELECT event_venues.*, `events`.event_title FROM event_venues INNER JOIN events ON event_venues.venue_event_id = `events`.event_id WHERE event_id = '$event_id' AND `event_venues`.venue_status NOT IN ('delete') ORDER BY venue_id DESC";
    $resultVenue = mysqli_query($con, $get_sql);

    if ($resultVenue) {
        while ($obj = mysqli_fetch_object($resultVenue)) {
            $arr[] = $obj;
        }
    } else {
        if (DEBUG) {
            $err = "resultVenue error: " . mysqli_error($con);
        } else {
            $err = "resultVenue query failed";
        }
    }

    echo "{\"data\":" . json_encode($arr) . "}";
}


if ($verb == "POST") {

    extract($_POST);


    $venue_id = mysqli_real_escape_string($con, $venue_id);

    $delete_sql = "UPDATE event_venues SET venue_status = 'delete' WHERE venue_id = '" . $venue_id . "'";

    $resultDelVenue = mysqli_query($con, $delete_sql);

    if ($resultDelVenue) {
        echo json_encode($resultDelVenue);
    } else {
        if (DEBUG) {
            $err = "resultDelVenue error: " . mysqli_error($con);
        } else {
            $err = "resultDelVenue query failed";
        }
    }
}
?>


