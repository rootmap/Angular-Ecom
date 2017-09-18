<?php

include '../../../config/config.php';
header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];
if ($verb == "GET") {
    $arrayEventSeatList = array();
    $sqlEventSeatList = "SELECT event_seat_plan.ESP_id,event_seat_plan.ESP_ticket_price,events.event_title,"
            . "event_venues.venue_title,seat_place.SP_title,seat_place_coordinate.SPC_title"
            . " FROM event_seat_plan"
            . " LEFT JOIN events ON event_seat_plan.ESP_event_id = events.event_id"
            . " LEFT JOIN event_venues ON event_seat_plan.ESP_venue_id = event_venues.venue_id"
            . " LEFT JOIN seat_place ON event_seat_plan.ESP_place_id = seat_place.SP_id"
            . " LEFT JOIN seat_place_coordinate ON event_seat_plan.ESP_template_id = seat_place_coordinate.SPC_id"
            . " ORDER BY event_seat_plan.ESP_id DESC";
    $resultEventSeatList = mysqli_query($con, $sqlEventSeatList);
    if ($resultEventSeatList) {
        while ($resultEventSeatListObj = mysqli_fetch_object($resultEventSeatList)) {
            $arrayEventSeatList[] = $resultEventSeatListObj;
        }
    } else {
        if (DEBUG) {
            echo "resultEventSeatList error: " . mysqli_error($con);
        } else {
            echo "resultEventSeatList query failed.";
        }
    }

    echo "{\"data\":" . json_encode($arrayEventSeatList) . "}";
}

if ($verb == "POST") {

    extract($_POST);
    $ESP_id = mysqli_real_escape_string($con, $ESP_id);
    $delete_sql = "DELETE FROM event_seat_plan WHERE ESP_id = '" . $ESP_id . "'";
    $resultDelete = mysqli_query($con, $delete_sql);
    if ($resultDelete) {
        echo json_encode($resultDelete);
    } else {
        if (DEBUG) {
            echo "resultDelete error: " . mysqli_error($con);
        } else {
            echo "resultDelete query failed.";
        }
    }
}
?>