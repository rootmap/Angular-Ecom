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

 $del = $data->pmdel;
$event = $data->event_id;
$payGatewaycharge = $data->payGateway;

if (!empty($event) && !empty($payGatewaycharge) || !empty($del)) {
    $sqlchk = mysqli_num_rows(mysqli_query($con, "SELECT * FROM  payment_gateway_charges_list WHERE event_id='$event'"));
    if (!empty($event) && !empty($payGatewaycharge) && $sqlchk == 0) {
        $sql = "INSERT INTO payment_gateway_charges_list SET event_id='$event',pms_id='$payGatewaycharge'";
        $result = mysqli_query($con, $sql);

        if ($result == 1) {
            echo 1;
        } else {
            echo 0;
        }
    }elseif(!empty($del)) {
   
        $sql = "DELETE FROM payment_gateway_charges_list WHERE id='$del'";
        $result = mysqli_query($con, $sql);
        if ($result == 1) {
            echo 4;
        } else {
            echo 0;
        }
    
    }else
    {
        $sql = "UPDATE payment_gateway_charges_list SET pms_id='$payGatewaycharge' WHERE event_id='$event'";
        $result = mysqli_query($con, $sql);

        if ($result == 1) {
            echo 2;
        } else {
            echo 0;
        }
    }
} else {
    echo 3;
}