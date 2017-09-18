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

    $arr = array();
    $get_sql = "SELECT event_subscription.subscription_id, event_subscription.subscription_event_id, event_subscription.subscription_min_amount, events.event_title FROM event_subscription "
            . "LEFT JOIN events ON event_subscription.subscription_event_id = events.event_id ";
    if ($adminEventPermission == "created") {
        $get_sql .= "AND `events`.event_created_by=$adminID ";
    } elseif ($adminEventPermission == "selected") {
        $get_sql .= "AND `events`.event_id IN ($adminEventID) ";
    }
    $get_sql .= "ORDER BY event_subscription.subscription_id DESC";
    $resultSubscription = mysqli_query($con, $get_sql);
    if ($resultSubscription) {
        while ($obj = mysqli_fetch_object($resultSubscription)) {
            $arr[] = $obj;
        }
    } else {
        if (DEBUG) {
            $err = "resultSubscription error: " . mysqli_error($con);
        } else {
            $err = "resultSubscription query failed";
        }
    }


    echo "{\"data\":" . json_encode($arr) . "}";
}


if ($verb == "POST") {

    extract($_POST);

    $arr = array();
    $subscription_id = mysqli_real_escape_string($con, $subscription_id);

    $delete_sql = "DELETE FROM event_subscription WHERE subscription_id = '" . $subscription_id . "'";

    $resultDelSubscription = mysqli_query($con, $delete_sql);

    if ($resultDelSubscription) {
        echo json_encode($resultDelSubscription);
    } else {
        if (DEBUG) {
            $err = "resultDelSubscription error: " . mysqli_error($con);
        } else {
            $err = "resultDelSubscription query failed";
        }
    }
}
?>