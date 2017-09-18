<?php
include '../../DBconnection/auth.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of projectController
 *
 * @author Sirajum Munira <Sirajum Munira at skeletonit.com>
 */
//class projectController {
//    //put your code here
//}
// Including database connections start here
require_once '../../DBconnection/database_connections.php';
// Including database connections end here
//json data encoding passing start here
$data = json_decode(file_get_contents("php://input"));
//json data encoding passing end here


$event_id = $data->event_id;
$param = $data->param;
//echo print_r($data->param);
//
//echo "<pre>";
//print_r($data);
//exit();
$data_is_updated = FALSE;

$i = 0;
foreach ($param as $par):
    //echo $par->check_namest;
    $chk = mysqli_num_rows(mysqli_query($con, "SELECT * FROM eventwise_payment_method WHERE event_id='$event_id' AND payment_method_id='$par->check_name_ID'"));
    if ($chk == 0) {
        $sql = "INSERT INTO eventwise_payment_method SET event_id='$event_id',payment_method_id='$par->check_name_ID',status='$par->check_namest',date='" . date('Y-m-d') . "',	offline_status='2'";
        $result = mysqli_query($con, $sql);
        if ($result == 2) {
            $i+=1;
        } else {
            $i+=0;
        }
    } else {
        $sql = "UPDATE eventwise_payment_method SET status='$par->check_namest',date='" . date('Y-m-d') . "',offline_status='2' WHERE event_id='$event_id' AND payment_method_id='$par->check_name_ID'";
        $result = mysqli_query($con, $sql);
        if ($result == 2) {
            $i+=1;
            $data_is_updated = TRUE;
        } else {
            $i+=0;
        }
    }
endforeach;



//Data inseart data Database
//data succefully submit and so console.log 1 or failed show 2
if ($data_is_updated == TRUE) {
    echo 3;
} else {
    if ($i != 0) {
        echo 2;
    } else {
        echo 0;
    }
}