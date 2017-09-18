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

$event_id=$data->event_id;

/* @var $event type */

//$eventStatus = $data->eventStatus;


$sql = "SELECT `event_status` FROM `events` WHERE event_id='$event_id'";
$result=mysqli_query($con,$sql);
$object =array();
while ($row= mysqli_fetch_array($result)) {
    $object[]=$row;
    
}
echo json_encode($object);
