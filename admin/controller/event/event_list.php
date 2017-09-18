<?php

include '../../../config/config.php';

$adminEventPermission = '';
$adminID = 0;
$adminEventID = '';
$strEventCatIds = "";

if ((getSession('admin_event_permission')) AND ( getSession('admin_id'))) {
    $adminEventPermission = getSession('admin_event_permission');
    $adminID = getSession('admin_id');
    $adminEventID = getSession('admin_event_id');
}

header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];
if ($verb == "GET") {
    $arrayEvent = array();

    $sqlEventList = "SELECT events.event_id,events.event_title,events.event_category_id,"
            . "events.event_is_featured,events.event_is_coming,events.event_web_logo,events.event_status"
            . " FROM events ";
    if ($adminEventPermission == "created") {
        $sqlEventList .= "WHERE event_created_by=$adminID ";
    } elseif ($adminEventPermission == "selected") {
        $sqlEventList .= "WHERE event_id IN ($adminEventID) ";
    }
    $sqlEventList .= "ORDER BY event_id DESC";
    $resultEventList = mysqli_query($con, $sqlEventList);
    if ($resultEventList) {
        while ($obj = mysqli_fetch_object($resultEventList)) {
            $arrayEvent[] = $obj;
            $strEventCatIds = $obj->event_category_id;

            $sqlGetCategory = "SELECT category_title FROM categories WHERE category_id='$strEventCatIds'";
            $resultGetCategory = mysqli_query($con, $sqlGetCategory);

            if ($resultGetCategory) {
                $strCategoryTitle = "";
                while($resultGetCategoryObj = mysqli_fetch_object($resultGetCategory)){
                    $strCategoryTitle .= $resultGetCategoryObj->category_title . ",";
                }
            } else {
                if (DEBUG) {
                    echo "resultGetCategory error: " . mysqli_error($con);
                } else {
                    echo "resultGetCategory query failed";
                }
            }
            $strCategoryTitle = rtrim($strCategoryTitle, ",");
            $arrayEvent[(count($arrayEvent)-1)]->category_title = $strCategoryTitle;
        }
    } else {
        if (DEBUG) {
            echo "resultEventList error: " . mysqli_error($con);
        } else {
            echo "resultEventList query failed";
        }
    }
    echo "{\"data\":" . json_encode($arrayEvent) . "}";
}


if ($verb == "POST") {

    extract($_POST);
    $event_id = mysqli_real_escape_string($con, $event_id);
    $delete_sql = "UPDATE events SET event_status = 'delete' WHERE event_id = '" . $event_id . "'";
    $resultDelete = mysqli_query($con, $delete_sql);

    if ($resultDelete) {
        echo json_encode($resultDelete);
    } else {
        if (DEBUG) {
            $err = "resultDelete error: " . mysqli_error($con);
        } else {
            $err = "resultDelete query failed";
        }
    }
}
?>
