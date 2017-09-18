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
    $get_sql = "SELECT event_includes.*, `events`.event_title, event_venues.venue_title FROM event_includes "
            . "LEFT JOIN `events` ON event_includes.EI_event_id = `events`.event_id "
            . "LEFT JOIN event_venues ON event_includes.EI_venue_id = event_venues.venue_id "
            . "WHERE event_includes.EI_status NOT IN ('deleted') ";
    if ($adminEventPermission == "created") {
        $get_sql .= "AND `events`.event_created_by=$adminID ";
    } elseif ($adminEventPermission == "selected") {
        $get_sql .= "AND `events`.event_id IN ($adminEventID) ";
    }
    $get_sql .= "ORDER BY event_includes.EI_id DESC";
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