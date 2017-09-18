<?php

include '../../config/config.php';
$adminTypeID = 0;
$EventPermission = '';
$arrGetEvent = array();
extract($_POST);

if ($adminTypeID > 0) {
    $sqlGetTypeInfo = "SELECT AT_event_permission FROM admin_types WHERE AT_id=$adminTypeID";
    $resultGetTypeInfo = mysqli_query($con, $sqlGetTypeInfo);

    if ($resultGetTypeInfo) {
        $resultGetTypeInfoObj = mysqli_fetch_object($resultGetTypeInfo);
        if (isset($resultGetTypeInfoObj->AT_event_permission)) {
            $EventPermission = $resultGetTypeInfoObj->AT_event_permission;
        }

        if ($EventPermission == "selected") {
            $sqlGetEvent = "SELECT event_title, event_id FROM events WHERE event_status='active'";
            $resultGetEvent = mysqli_query($con, $sqlGetEvent);

            if ($resultGetEvent) {
                while ($resultGetEventObj = mysqli_fetch_object($resultGetEvent)) {
                    $arrGetEvent[] = $resultGetEventObj;
                }
                $return_array = array("output" => "success", "flag" => 1, "arrEvent" => $arrGetEvent);
                echo json_encode($return_array);
                exit();
            } else {
                if (DEBUG) {
                    $return_array = array("output" => "error", "msg" => "resultGetEvent error: " . mysqli_error($con));
                    echo json_encode($return_array);
                    exit();
                } else {
                    $return_array = array("output" => "error", "msg" => "resultGetEvent query failed.");
                    echo json_encode($return_array);
                    exit();
                }
            }
        } else {
            $return_array = array("output" => "success", "flag" => 0);
            echo json_encode($return_array);
            exit();
        }
    } else {
        if (DEBUG) {
            $return_array = array("output" => "error", "msg" => "resultGetTypeInfo error: " . mysqli_error($con));
            echo json_encode($return_array);
            exit();
        } else {
            $return_array = array("output" => "error", "msg" => "resultGetTypeInfo query failed.");
            echo json_encode($return_array);
            exit();
        }
    }
}


