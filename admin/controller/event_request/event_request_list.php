<?php

include '../../../config/config.php';

header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];

if ($verb == "GET") {
    $arrayEventRequest = array();
    $sqlEventRequest = "SELECT MI_id,MI_email_address,MI_number,MI_event_title,MI_event_date_time,MI_venue_name,"
            . " CONCAT(MI_first_name,' ',MI_last_name) AS name FROM merchant_info ORDER BY MI_id DESC";
    $resultEventRequest = mysqli_query($con, $sqlEventRequest);
    if ($resultEventRequest) {
        while ($resultEventRequestObj = mysqli_fetch_object($resultEventRequest)) {
            $arrayEventRequest[] = $resultEventRequestObj;
        }
    } else {
        if (DEBUG) {
            $err = "resultEventRequest error: " . mysqli_error($con);
        } else {
            $err = "resultEventRequest query failed";
        }
    }
    echo "{\"data\":" . json_encode($arrayEventRequest) . "}";
}

if ($verb == "POST") {

    extract($_POST);
    $MI_id = mysqli_real_escape_string($con, $MI_id);
    $delete_sql = "DELETE FROM merchant_info WHERE MI_id = '" . $MI_id . "'";
    $resultDeleteEventRequest = mysqli_query($con, $delete_sql);
    if ($resultDeleteEventRequest) {
        echo json_encode($resultDeleteEventRequest);
    } else {
        if (DEBUG) {
            $err = "resultDeleteEventRequest error: " . mysqli_error($con);
        } else {
            $err = "resultDeleteEventRequest query failed";
        }
    }
}
?>