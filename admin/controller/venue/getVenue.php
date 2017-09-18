<?php

include '../../../config/config.php';
$event_id = 0;
$json_arr = array();
$json_arr['output'] = '';
$json_arr['object'] = array();
extract($_POST);
if ($event_id > 0) {
    $get_sql = "SELECT * FROM event_venues WHERE venue_event_id = '$event_id' AND venue_status='active'";
    $rs = mysqli_query($con, $get_sql);
    if($rs){
        while ($obj = mysqli_fetch_object($rs)) {
            $json_arr['object'][] = $obj;
        }
        $json_arr['output'] = 'success';
    } else {
        $json_arr['output'] = 'error';
    }

    echo json_encode($json_arr);
}
