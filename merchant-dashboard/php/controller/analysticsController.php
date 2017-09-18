<?php

include '../../DBconnection/auth.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


// Including database connections start here
require_once '../../dbConnection/database_connections.php';
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
    $today=  date('Y-m-d');
    $sql = "SELECT count(order_id) as total_order_quantity FROM orders 
INNER JOIN order_events as oe ON orders.order_id=oe.OE_order_id 
WHERE oe.OE_event_id IN (SELECT event_id FROM `events` WHERE event_created_by='32') AND DATE_FORMAT(`order_created`,'%Y-%m-%d')='$today'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $total = $row['total_order_quantity'];



    echo $total;
}
if ($id == 2) {
    $object = array();
    $today=  date('Y-m-d');
     $sql = "SELECT 
IFNULL(sum(`order_total_amount`)
-
(sum(`order_vat_amount`+`order_discount_amount`+`order_promotion_discount_amount`+`order_shipment_charge`)),0) as onlinecharge FROM `orders` 
    INNER JOIN order_events AS oe ON orders.order_id=oe.OE_order_id
    WHERE oe.OE_event_id IN (SELECT event_id FROM `events` WHERE event_created_by='$login_user_id') AND DATE_FORMAT
(`order_created`,'%Y-%m-%d')='$today'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $totalSales = $row['onlinecharge'];



    echo $totalSales;
}
if ($id == 3) {
    $object = array();
    $today=  date('Y-m-d');
    $sql = "SELECT IFNULL(sum(`request_amount`),0) as withdraw FROM `refund_request` WHERE `merchant_id`='32' AND date='$today'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $totalUsers = $row['withdraw'];



    echo $totalUsers;
}
if ($id == 4) {
    $object = array();
    $today=  date('Y-m-d');
    $sql = "SELECT count(`event_id`) as total_event FROM `events` WHERE
`event_created_by`='32' AND DATE_FORMAT(`event_updated_on`,'%Y-%m-%d')='2016-12-05' ";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $totalNetCharge = $row['total_event'];



    echo $totalNetCharge;
}
//ALL COUSTOMER & PAID COUSTOMER ANALYSTICS
if ($id == 5) {
    $object = array();
//    $today=  date('Y-m-d');
    $sql = "SELECT alld.alluser,((alld.alluser*alld.merchant_user)/100) as perchant FROM (SELECT 
IFNULL((SELECT count(o.order_user_id) as alluser FROM orders as o),0) AS alluser,
IFNULL((SELECT count(o.order_user_id) as order_users FROM orders as o
INNER JOIN order_events as oe on o.order_id=oe.OE_order_id
WHERE oe.OE_event_id IN (SELECT e.`event_id` FROM `events` as e WHERE e.`event_created_by`='$login_user_id')
),0) AS merchant_user) AS alld";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $totalNetCharge = $row['perchant'];



    echo $totalNetCharge;
}
//ALL VISIT EVENTS ANALYSTICS
if ($id == 6) {
    $object = array();
    //$today=  date('Y-m-d');
    $sql = "SELECT 
count(evp.id) as visit 
FROM `event_visit_page` as evp
WHERE evp.event_id IN (SELECT e.`event_id` FROM `events` as e WHERE e.`event_created_by`='$login_user_id')";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $totalNetCharge = $row['visit'];



    echo $totalNetCharge;
}

//ALL PAID ORDERS ANALYSTICS
if ($id == 7) {
    $object = array();
    //$today=  date('Y-m-d');
    $sql = "SELECT count(`order_user_id`) as paidorders FROM `orders` as o 

INNER JOIN `events` as e ON e.event_id=o.order_id
WHERE e.event_id IN (SELECT e.`event_id` FROM `events` as e WHERE e.`event_created_by`='$login_user_id')
AND o.`order_status`='paid'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $totalNetCharge = $row['paidorders'];



    echo $totalNetCharge;
}
//ALL PUBLISHED ALL EVENTS ANALYSTICS
if ($id == 8) {
    $object = array();
    //$today=  date('Y-m-d');
    $sql = "SELECT count(`event_id`)AS active  FROM `events`as e
WHERE e.`event_created_by`='32' AND e.`event_status`='active'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $totalNetCharge = $row['active'];



    echo $totalNetCharge;
}