<?php
include '../../../config/config.php';
header("Content-type: application/json");

$adminEventPermission = '';
$adminID = 0;
$adminEventID = '';
if ((getSession('admin_event_permission')) AND ( getSession('admin_id'))) {
    $adminEventPermission = getSession('admin_event_permission');
    $adminID = getSession('admin_id');
    $adminEventID = getSession('admin_event_id');
}
$verb = $_SERVER["REQUEST_METHOD"];
if ($verb == "GET") {
    
    $arrayGuest = array();
    $get_sql = "SELECT event_participants.EP_id, event_participants.EP_participant_name, event_participants.EP_current_position, event_participants.EP_image, event_participants.EP_event_id, `events`.event_title AS event_title, `events`.event_id FROM event_participants "
            . "LEFT JOIN `events` ON event_participants.EP_event_id = EVENTS .event_id ";
    if ($adminEventPermission == "created") {
        $get_sql .= "WHERE `events`.event_created_by=$adminID ";
    } elseif ($adminEventPermission == "selected") {
        $get_sql .= "WHERE `events`.event_id IN ($adminEventID) ";
    }
     $get_sql .= "ORDER BY event_participants.EP_id DESC";
    $resultGuest = mysqli_query($con, $get_sql);

    if ($resultGuest) {
        while ($obj = mysqli_fetch_object($resultGuest)) {
            $arrayGuest[] = $obj;
        }
    } else {
        if (DEBUG) {
            $err = "resultGuest error: " . mysqli_error($con);
        } else {
            $err = "resultGuest query failed";
        }
    }

    echo "{\"data\":" . json_encode($arrayGuest) . "}";
}


if ($verb == "POST") {

    extract($_POST);

    $arr = array();
    $EP_id = mysqli_real_escape_string($con, $EP_id);
    $sql = "select EP_image from event_participants where EP_id = $EP_id";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $arr = mysqli_fetch_array($result);
        unlink($config['IMAGE_UPLOAD_PATH'] . '/guest/' . $arr["EP_image"]);
    }

    $delete_sql = "DELETE FROM event_participants WHERE EP_id = '" . $EP_id . "'";

    $resultDelGuest = mysqli_query($con, $delete_sql);

    if ($resultDelGuest) {
        echo json_encode($resultDelGuest);
    } else {
        if (DEBUG) {
            $err = "resultDelGuest error: " . mysqli_error($con);
        } else {
            $err = "resultDelGuest query failed";
        }
    }
}
?>