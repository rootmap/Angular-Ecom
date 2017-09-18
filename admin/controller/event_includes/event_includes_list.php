<?php

include '../../../config/config.php';

header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];
if ($verb == "GET") {
    $event_id = $_GET["event_id"];
    $venue_id = $_GET["venue_id"];
    //echo $event_id . $venue_id;exit();
    $arr = array();
    $get_sql = "SELECT event_includes.*, event_venues.venue_title, `events`.event_title FROM event_includes INNER JOIN event_venues ON event_includes.EI_venue_id = event_venues.venue_id INNER JOIN `events` ON event_includes.EI_event_id = `events`.event_id WHERE event_includes.EI_venue_id = '$venue_id' AND event_includes.EI_event_id = '$event_id' AND `event_includes`.EI_status NOT IN ('deleted') order by event_includes.EI_id DESC";

    $resultIncludes = mysqli_query($con, $get_sql);
    if ($resultIncludes) {

        while ($obj = mysqli_fetch_object($resultIncludes)) {
            $arr[] = $obj;
        }
    } else {
        if (DEBUG) {
            $err = "resultIncludes error: " . mysqli_error($con);
        } else {
            $err = "resultIncludes query failed";
        }
    }
    echo "{\"data\":" . json_encode($arr) . "}";
}


if ($verb == "POST") {

    extract($_POST);


    $EI_id = mysqli_real_escape_string($con, $EI_id);

    $delete_sql = "UPDATE event_includes SET EI_status = 'deleted' WHERE EI_id = '" . $EI_id . "'";

    $resultDelIncludes = mysqli_query($con, $delete_sql);

    if ($resultDelIncludes) {
        echo json_encode($resultDelIncludes);
    } else {
        if (DEBUG) {
            $err = "resultDelIncludes error: " . mysqli_error($con);
        } else {
            $err = "resultDelIncludes query failed";
        }
    }
}
?>