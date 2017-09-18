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
//json data encoding passing start here
$data = json_decode(file_get_contents("php://input"));
//json data encoding passing end here

$id = $data->event;

if ($id == 1) {
    $object = array();
//
//    $sql = "Select * FROM events";
//    $result = mysqli_query($con, $sql);
//    $total=  mysqli_num_rows($result);
//    
    $sql = "Select count(event_id) as total_event FROM events as e WHERE `event_created_by`='$login_user_id'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $total = $row['total_event'];



    echo $total;
}
if ($id == 2) {
    $object = array();

    $sql = "SELECT sum(`order_total_amount`)-(sum(`order_vat_amount`+`order_discount_amount`+`order_promotion_discount_amount`+`order_shipment_charge`)) as onlinecharge FROM `orders` 
    INNER JOIN order_events AS oe ON orders.order_id=oe.OE_order_id
    WHERE oe.OE_event_id IN (SELECT event_id FROM events WHERE event_created_by='$login_user_id')";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $totalSales = $row['onlinecharge'];



    echo $totalSales;
}
if ($id == 3) {
    $object = array();

    $sql = "SELECT count(o.order_user_id) as order_users FROM orders as o
INNER JOIN order_events as oe on o.order_id=oe.OE_order_id
WHERE oe.OE_event_id IN (SELECT e.`event_id` FROM `events` as e WHERE e.`event_created_by`='$login_user_id')";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $totalUsers = $row['order_users'];



    echo $totalUsers;
}
if ($id == 4) {
    $object = array();

    $sql = "SELECT
sum(`order_total_amount`)-(sum(`order_vat_amount`+`order_discount_amount`+`order_promotion_discount_amount`+`order_shipment_charge`)) as onlinecharge FROM `orders`
INNER JOIN order_events as oe ON oe.OE_order_id=orders.`order_id`

WHERE oe.OE_event_id IN (SELECT e.`event_id` FROM `events` as e WHERE e.`event_created_by`='$login_user_id') ";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $totalNetCharge = $row['onlinecharge'];



    echo $totalNetCharge;
}
if ($id == 5) {
    $object = array();

    $sql = "SELECT A.withdraw,B.onlinecharge,(B.onlinecharge-A.withdraw) netbalance FROM (
    (SELECT sum(`request_amount`) as withdraw FROM `refund_request` WHERE `merchant_id`='$login_user_id') AS A,
    ((SELECT sum(`order_total_amount`)-(sum(`order_vat_amount`+`order_discount_amount`+`order_promotion_discount_amount`+`order_shipment_charge`)) as onlinecharge FROM `orders` 
INNER JOIN order_events AS oe ON orders.order_id=oe.OE_order_id
WHERE oe.OE_event_id IN (SELECT event_id FROM events WHERE event_created_by='$login_user_id')) AS B)
    )";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $refundamount = $row['netbalance'];
    if(empty($refundamount))
    {
        $refundamount=0;
    }


    echo $refundamount;
}
if ($id == 6) {
    $object = array();

    $sql = "SELECT count(o.`order_id`) as allorder FROM `orders` as o 
INNER JOIN order_events as oe on o.order_id=oe.OE_order_id
WHERE oe.OE_event_id IN (SELECT e.`event_id` FROM `events` as e WHERE e.`event_created_by`='$login_user_id');";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $registration = $row['allorder'];



    echo $registration;
}

if ($id == 7) {
    $object = array();

    $sql = "SELECT count(`TT_id`)as totalEvent  FROM `event_ticket_types` as a
 WHERE a.TT_event_id IN (SELECT e.`event_id` FROM `events` as e  WHERE e.`event_created_by`='$login_user_id');";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $registration = $row['totalEvent'];



    echo $registration;
}
if ($id == 8) {
    $object = array();

    $sql = "SELECT count(`event_id`) as eventwisePaymentMethod FROM `eventwise_payment_method`as epm

 WHERE epm.event_id IN (SELECT e.`event_id` FROM `events` as e  WHERE e.`event_created_by`='$login_user_id');";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $registration = $row['eventwisePaymentMethod'];



    echo $registration;
}
if ($id == 9) {
    $object = array();

    $sql = "SELECT count(`pattern`) as checkInMgnt FROM `checkininout` as ck

INNER JOIN orders on orders.order_number=ck.pattern
INNER JOIN order_events as oe on oe.OE_id=orders.order_id

WHERE  oe.OE_event_id IN (SELECT e.`event_id` FROM `events` as e WHERE e.`event_created_by`='$login_user_id');";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $registration = $row['checkInMgnt'];



    echo $registration;
}