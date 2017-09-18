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
    $arrEventListCount = array();
    $getEventUserList = "SELECT events.event_id, events.event_title,"
            . " event_dynamic_forms.form_event_id,"
            . " COUNT( event_dynamic_forms.form_id ) AS total_count "
            . "FROM events LEFT JOIN event_dynamic_forms ON "
            . "events.event_id = event_dynamic_forms.form_event_id WHERE event_is_private = 'yes'";
    if ($adminEventPermission == "created") {
        $getEventUserList .= "WHERE `events`.event_created_by=$adminID ";
    } elseif ($adminEventPermission == "selected") {
        $getEventUserList .= "WHERE `events`.event_id IN ($adminEventID) ";
    }
    $resultEventListCount = mysqli_query($con, $getEventUserList);

    if ($resultEventListCount) {
        while ($objCount = mysqli_fetch_object($resultEventListCount)) {
            $arrEventListCount[] = $objCount;
        }
    }else{
        if (DEBUG) {
            $err = "resultEventListCount error: " . mysqli_error($con);
        } else {
            $err = "resultEventListCount query failed";
        }
    }


    echo "{\"data\":" . json_encode($arrEventListCount) . "}";
}
?>