<?php

include '../../../config/config.php';
$category_id = '';

$adminEventPermission = '';
$adminID = 0;
$adminEventID = '';
if ((getSession('admin_event_permission')) AND ( getSession('admin_id'))) {
    $adminEventPermission = getSession('admin_event_permission');
    $adminID = getSession('admin_id');
    $adminEventID = getSession('admin_event_id');
}
$json_arr = array();
$json_arr['output'] = '';
$json_arr['object'] = array();
extract($_POST);
if ($category_id > 0) {
    $get_sql = "SELECT event_id,event_title FROM events WHERE $category_id IN(event_category_id)";
    if ($adminEventPermission == "created") {
        $get_sql .= " AND event_created_by=$adminID ";
    } elseif ($adminEventPermission == "selected") {
        $get_sql .= " AND event_id IN ($adminEventID) ";
    }
    $rs = mysqli_query($con, $get_sql);
    if ($rs) {
        while ($obj = mysqli_fetch_object($rs)) {
            $json_arr['object'][] = $obj;
        }
        $json_arr['output'] = 'success';
    } else {
        $json_arr['output'] = 'error';
    }

    echo json_encode($json_arr);
}