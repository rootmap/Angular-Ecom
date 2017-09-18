<?php

include '../../../config/config.php';

$adminEventPermission = '';
$adminID = 0;
$adminEventID = '';
if ((getSession('admin_event_permission')) AND ( getSession('admin_id'))) {
    $adminEventPermission = getSession('admin_event_permission');
    $adminID = getSession('admin_id');
    $adminEventID = getSession('admin_event_id');
}

header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];
if ($verb == "GET") {
    $arr = array();
    $get_sql = "SELECT event_venues.*, `events`.* FROM event_venues "
            . "LEFT JOIN `events` ON event_venues.venue_event_id = `events`.event_id "
            . "WHERE `event_venues`.venue_status NOT IN ('delete') ";
    if ($adminEventPermission == "created") {
        $get_sql .= "AND `events`.event_created_by=$adminID ";
    } elseif ($adminEventPermission == "selected") {
        $get_sql .= "AND `events`.event_id IN ($adminEventID) ";
    }
    $get_sql .= "ORDER BY venue_id DESC";
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


