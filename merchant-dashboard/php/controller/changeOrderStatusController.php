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
 $orderNum = $data->orderNum;
 $orderStatus = $data->orderStatus;


 $sql = "UPDATE `orders` SET  order_status='$orderStatus' WHERE order_number='$orderNum'";
$result = mysqli_query($con, $sql);

if ($result == 1) {
    echo "1";
} else {
    echo "2";
}


