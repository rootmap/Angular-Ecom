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



$paramevt='';
/* Data convert by jeson start here */
$data = json_decode(file_get_contents("php://input"));
/* ./Data convert by jeson end here */
$evt = '';
if (!empty($data)) {
    $evt = $data->evt;
}
//list event ticket sold left ticket for report

if (empty($evt)) {
    $sql = "Select count(event_id) as total_event FROM events as e WHERE `event_created_by`='$login_user_id'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $total_event = $row['total_event'];
} else {
    $sql = "Select event_title as total_event FROM events as e WHERE `event_created_by`='$login_user_id' AND e.event_id='$evt'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $total_event = $row['total_event'];
}

if (!empty($evt)) {
    $paramevt = " AND oe.OE_event_id='$evt'";
}

$sql = "SELECT sum(`order_total_amount`)-(sum(`order_vat_amount`+`order_discount_amount`+`order_promotion_discount_amount`+`order_shipment_charge`)) as onlinecharge FROM `orders` 
    INNER JOIN order_events AS oe ON orders.order_id=oe.OE_order_id
    WHERE oe.OE_event_id IN (SELECT event_id FROM events WHERE event_created_by='$login_user_id') $paramevt ";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$totalSales = $row['onlinecharge'];




if (!empty($evt)) {
    $paramevt = " AND oe.OE_event_id='$evt'";
}
$sql = "SELECT count(o.order_user_id) as order_users FROM orders as o
INNER JOIN order_events as oe on o.order_id=oe.OE_order_id
WHERE oe.OE_event_id IN (SELECT e.`event_id` FROM `events` as e WHERE e.`event_created_by`='$login_user_id') $paramevt";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$totalUsers = $row['order_users'];

if (!empty($evt)) {
    $paramevt = " AND oe.OE_event_id='$evt'";
}

$sql = "SELECT
sum(`order_total_amount`)-(sum(`order_vat_amount`+`order_discount_amount`+`order_promotion_discount_amount`+`order_shipment_charge`)) as onlinecharge FROM `orders`
INNER JOIN order_events as oe ON oe.OE_order_id=orders.`order_id`

WHERE oe.OE_event_id IN (SELECT e.`event_id` FROM `events` as e WHERE e.`event_created_by`='$login_user_id') $paramevt";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$totalNetCharge = $row['onlinecharge'];



if (!empty($evt)) {
    $paramevt = " AND oe.OE_event_id='$evt'";
}
$sql = "SELECT A.withdraw,B.onlinecharge,(B.onlinecharge-A.withdraw) netbalance FROM (
    (SELECT sum(`request_amount`) as withdraw FROM `refund_request` WHERE `merchant_id`='$login_user_id') AS A,
    ((SELECT sum(`order_total_amount`)-(sum(`order_vat_amount`+`order_discount_amount`+`order_promotion_discount_amount`+`order_shipment_charge`)) as onlinecharge FROM `orders` 
INNER JOIN order_events AS oe ON orders.order_id=oe.OE_order_id
WHERE oe.OE_event_id IN (SELECT event_id FROM events WHERE event_created_by='$login_user_id') $paramevt) AS B)
    )";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$refundamount = $row['netbalance'];





if (!empty($evt)) {
    $paramevt = " AND oe.OE_event_id='$evt'";
}

    $sql = "SELECT count(o.`order_id`) as allorder FROM `orders` as o 
INNER JOIN order_events as oe on o.order_id=oe.OE_order_id
WHERE oe.OE_event_id IN (SELECT e.`event_id` FROM `events` as e WHERE e.`event_created_by`='$login_user_id') $paramevt";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $registration = $row['allorder'];




if (!empty($evt)) {
    $paramevt = " AND a.TT_event_id ='$evt'";
}

   $sql = "SELECT count(`TT_id`)as totalEvent  FROM `event_ticket_types` as a
 WHERE a.TT_event_id IN (SELECT e.`event_id` FROM `events` as e  WHERE e.`event_created_by`='$login_user_id') $paramevt";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $orderamount = $row['totalEvent'];


if (!empty($evt)) {
    $paramevt = " AND a.TT_event_id ='$evt'";
}

    $sql = "SELECT count(`TT_id`)as totalEvent  FROM `event_ticket_types` as a
 WHERE a.TT_event_id IN (SELECT e.`event_id` FROM `events` as e  WHERE e.`event_created_by`='$login_user_id') $paramevt ";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $totalticket = $row['totalEvent'];



if (!empty($evt)) {
    $paramevt = " AND epm.event_id ='$evt'";
}

    $sql = "SELECT count(`event_id`) as eventwisePaymentMethod FROM `eventwise_payment_method`as epm

 WHERE epm.event_id IN (SELECT e.`event_id` FROM `events` as e  WHERE e.`event_created_by`='$login_user_id') $paramevt";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $totalpayment = $row['eventwisePaymentMethod'];



    
 if (!empty($evt)) {
    $paramevt = " AND oe.OE_event_id  ='$evt'";
}

    $sql = "SELECT count(`pattern`) as checkInMgnt FROM `checkininout` as ck

INNER JOIN orders on orders.order_number=ck.pattern
INNER JOIN order_events as oe on oe.OE_id=orders.order_id

WHERE  oe.OE_event_id IN (SELECT e.`event_id` FROM `events` as e WHERE e.`event_created_by`='$login_user_id') $paramevt";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $attendees= $row['checkInMgnt'];




    

 


$data_array = array("lstevt" => $total_event,
    "totalsalesdata" => $totalSales,
    "usersdata" => $totalUsers,
    "totalnetdata" => $totalNetCharge, 
    "refundsdata"=>$refundamount,
    "TotalOrderAmount"=>$registration,
    "ticketList"=>$totalticket,
    "paymentmethod"=>$totalpayment,
    "checkInmanagement"=>$attendees
    );

echo json_encode($data_array);
