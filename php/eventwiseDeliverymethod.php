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

//if ($eventTypeId == 5) {
//    $sql = "SELECT * FROM `payment_method` WHERE `status`='3'";
//
//    $resultPaymentList_btn = mysqli_query($con, $sql);
//
//    while ($resultPaymentListObj = mysqli_fetch_object($resultPaymentList_btn)) {
//        $payment_method[] = $resultPaymentListObj;
//    }
//    echo json_encode($payment_method);
//} else {
//    $sql = "SELECT  pm.*
//FROM `eventwise_payment_method` AS ep
//LEFT JOIN payment_method AS pm ON 
//pm.id=ep.payment_method_id
//WHERE ep.event_id='$event_id' AND ep.status='1' ";
//
//    $resultPaymentList_btn = mysqli_query($con, $sql);
//
//    while ($resultPaymentListObj = mysqli_fetch_object($resultPaymentList_btn)) {
//        $payment_method[] = $resultPaymentListObj;
//    }
//    //echo 'fd';
//    echo json_encode($payment_method);
//}

$sql = "SELECT  pm.*
FROM `eventwise_payment_method` AS ep
LEFT JOIN payment_method AS pm ON 
pm.id=ep.payment_method_id
WHERE ep.event_id='$event_id' AND pm.status='2' AND ep.status='1'";

    $resultPaymentList_btn = mysqli_query($con, $sql);

    while ($resultPaymentListObj = mysqli_fetch_object($resultPaymentList_btn)) {
        $payment_method[] = $resultPaymentListObj;
    }
    //echo 'fd';
    echo json_encode($payment_method);

?>