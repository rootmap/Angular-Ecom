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
if ($verb == "GET") {
    $venue_id = $_GET["venue_id"];
    $event_id = $_GET["event_id"];
    $arr = array();
    $get_sql = "SELECT event_venues.*,events.event_title, `event_ticket_types`.* FROM event_ticket_types "
            . "INNER JOIN event_venues ON event_ticket_types.TT_venue_id = event_venues.venue_id "
            . "LEFT JOIN events ON event_ticket_types.TT_event_id = events.event_id "
            . "WHERE venue_id = '$venue_id' "
            . "AND event_id = $event_id "
            . "AND `event_ticket_types`.TT_status NOT IN ('delete') ";
    if ($adminEventPermission == "created") {
        $get_sql .= "AND `events`.event_created_by=$adminID ";
    } elseif ($adminEventPermission == "selected") {
        $get_sql .= "AND `events`.event_id IN ($adminEventID) ";
    }
    $get_sql .= "ORDER BY TT_id DESC";

    $resultVenueTicketType = mysqli_query($con, $get_sql);
    if ($resultVenueTicketType) {
        while ($obj = mysqli_fetch_object($resultVenueTicketType)) {
            $arr[] = $obj;
        }
    }else{
        if (DEBUG) {
            $err = "resultVenueTicketType error: " . mysqli_error($con);
        } else {
            $err = "resultVenueTicketType query failed";
        }
    }

    echo "{\"data\":" . json_encode($arr) . "}";
}


if ($verb == "POST") {

    extract($_POST);


    $TT_id = mysqli_real_escape_string($con, $TT_id);

    $delete_sql = "UPDATE event_ticket_types SET TT_status = 'delete' WHERE TT_id = '" . $TT_id . "'";

    $resultDelVenueTicket = mysqli_query($con, $delete_sql);

    if ($resultDelVenueTicket) {
        echo json_encode($resultDelVenueTicket);
    } else {
        if (DEBUG) {
            $err = "resultDelVenueTicket error: " . mysqli_error($con);
        } else {
            $err = "resultDelVenueTicket query failed";
        }
    }
}
?>


