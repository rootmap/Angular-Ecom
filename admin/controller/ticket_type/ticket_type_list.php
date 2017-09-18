<?php

include '../../../config/config.php';

header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];
$adminEventPermission = '';
$adminID = 0;
$adminEventID = '';
if ((getSession('admin_event_permission')) AND ( getSession('admin_id'))) {
    $adminEventPermission = getSession('admin_event_permission');
    $adminID = getSession('admin_id');
    $adminEventID = getSession('admin_event_id');
}
if ($verb == "GET") 
{
    $arr = array();
    $get_sql = "SELECT event_venues.*, `event_ticket_types`.* FROM event_ticket_types "
            . "LEFT JOIN `event_venues` ON event_ticket_types.TT_venue_id = `event_venues`.venue_id "
            . "WHERE `event_ticket_types`.TT_status NOT IN ('delete') ";
    if ($adminEventPermission == "created") {
        $get_sql .= "AND `events`.event_created_by=$adminID ";
    } elseif ($adminEventPermission == "selected") {
        $get_sql .= "AND `events`.event_id IN ($adminEventID) ";
    }
    $get_sql .= "ORDER BY TT_id DESC";
    $resultTicketType = mysqli_query($con, $get_sql);

    if ($resultTicketType) {
        while ($obj = mysqli_fetch_object($resultTicketType)) {
            $arr[] = $obj;
        }
    } else {
        if (DEBUG) {
            $err = "resultTicketType error: " . mysqli_error($con);
        } else {
            $err = "resultTicketType query failed";
        }
    }

    echo "{\"data\":" . json_encode($arr) . "}";
}


if ($verb == "POST") {

    extract($_POST);

    $TT_id = mysqli_real_escape_string($con, $TT_id);

    $delete_sql = "UPDATE event_ticket_types SET TT_status = 'delete' WHERE TT_id = '" . $TT_id . "'";

    $resultDelTicketType = mysqli_query($con, $delete_sql);

    if ($resultDelTicketType) {
        echo json_encode($resultDelTicketType);
    } else {
        if (DEBUG) {
            $err = "resultDelTicketType error: " . mysqli_error($con);
        } else {
            $err = "resultDelTicketType query failed";
        }
    }
}
?>


