<?php

include '../../DBconnection/auth.php';
//START HERE 
//session_start();
$sessionId = session_id();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Including database connections start here
require_once '../../DBconnection/database_connections.php';
// Including database connections end here



$data = json_decode(file_get_contents("php://input"));


/* @var $event type */
$event = $data->event;
$eventStatus = $data->eventStatus;


$sql = "UPDATE `events` SET  event_status='$eventStatus' WHERE event_id='$event'";
$result = mysqli_query($con, $sql);

if ($result == 1) {
    echo "1";
} else {
    echo "2";
}
