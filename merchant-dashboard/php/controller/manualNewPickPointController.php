<?php

include '../../DBconnection/auth.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Including database connections start here
require_once '../../DBconnection/database_connections.php';
// Including database connections end here


/* Data convert by jeson start here */
$data = json_decode(file_get_contents("php://input"));
/* ./Data convert by jeson end here */

//$id=$data->id;
$eventID = $data->event_id;
$PickPointName = $data->PickPointName;
$PointAddress = $data->pointAddress;
$pointContactdetailsAddress = $data->pointContactdetailsAddress;


$sql = "INSERT INTO event_pick_point SET created_by='$login_user_id', event_id='$eventID',address='$PointAddress', point_details='$pointContactdetailsAddress',name='$PickPointName'";

$result = mysqli_query($con, $sql);
if ($result == 1) {
    echo 1;
} else {
    echo "2";
}