<?php

include'../DBconnection/database_connections.php';
$data = json_decode(file_get_contents("php://input"));

$event_id = $data->id;
//$eventTypeId = 0;
//
//$query = "SELECT `event_type` FROM `events` WHERE `event_type`='5' AND `event_id`='$event_id'";
//
//$result = mysqli_query($con, $query);
//
//while ($resultPaymentLis = mysqli_fetch_array($result)) {
//
//    $eventTypeId = $resultPaymentLis['event_type'];
//}

$payment_method = array();


    $sql = "SELECT * FROM `payment_method` WHERE `status`='3'";

    $resultPaymentList_btn = mysqli_query($con, $sql);

    while ($resultPaymentListObj = mysqli_fetch_object($resultPaymentList_btn)) {
        $payment_method[] = $resultPaymentListObj;
    }
    echo json_encode($payment_method);




?>