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




/* Data convert by jeson start here */
$data = json_decode(file_get_contents("php://input"));
/* ./Data convert by jeson end here */
$date = '';
$evt = '';
$evparam='';
if (!empty($data)) {
    if (!empty($data->startdate)) {
        $startdate=date('Y-m-d',strtotime($data->startdate));
        $enddate=date('Y-m-d',strtotime($data->enddate));
        if (!empty($data->evt)) {
            $evt = $data->evt;
        }
    } else {
        if(!empty($data->date))
        {
            $date = $data->date;
        }
        
        if (!empty($data->evt)) {
            $evt = $data->evt;
        }
    }
}



//list event ticket sold left ticket for report
$params = '';
if (!empty($date)) {
    if ($date == "month") {
        $params = " AND (DATE_FORMAT(o.order_created,'%Y-%m-%d')>='" . date("Y-m-d", strtotime("-1 month")) . "' AND DATE_FORMAT(o.order_created,'%Y-%m-%d')<='" . date("Y-m-d") . "')";
    } elseif ($date == "week") {
        $params = " AND (DATE_FORMAT(o.order_created,'%Y-%m-%d')>='" . date("Y-m-d", strtotime("-7 day")) . "' AND DATE_FORMAT(o.order_created,'%Y-%m-%d')<='" . date("Y-m-d") . "')";
    } else {
        $params = " AND DATE_FORMAT(o.order_created,'%Y-%m-%d')='$date'";
    }
}

if(!empty($startdate))
{
    $params = " AND (DATE_FORMAT(o.order_created,'%Y-%m-%d')>='" . $startdate . "' AND DATE_FORMAT(o.order_created,'%Y-%m-%d')<='" . $enddate . "')";
}

if (!empty($evt)) {
    $evparam = " AND A.event_id='$evt'";
}

$sql = "SELECT A.event_id,A.event_title,A.ticket_quantity,B.sold as ticket_sold,(A.ticket_quantity-B.sold) AS ticket_left FROM (Select 
e.`event_id`,
e.`event_title`,
IFNULL((SELECT SUM(ett.TT_ticket_quantity) FROM event_ticket_types AS ett WHERE e.event_id=ett.TT_event_id),0) AS ticket_quantity                                              
FROM `events` as e                            
WHERE e.`event_created_by`='$login_user_id') AS A,
(SELECT oe.OE_event_id,SUM(o.`order_total_item`) as sold FROM orders as o,order_events as oe,`events` as e
WHERE o.order_id=oe.OE_order_id AND oe.OE_event_id=e.event_id AND e.event_created_by='$login_user_id' " . $params . "
GROUP BY oe.OE_event_id) AS B 
WHERE A.event_id=B.OE_event_id $evparam ORDER BY A.event_id DESC";

//echo $sql = "Select 
//e.`event_id`,
//e.`event_title`,
//IFNULL((SELECT SUM(ett.TT_ticket_quantity) FROM event_ticket_types AS ett WHERE e.event_id=ett.TT_event_id),0) AS ticket_quantity,
//IFNULL((SELECT SUM(oi.OI_quantity) FROM order_items as oi WHERE e.event_id=oi.OI_OE_id " . $params . "),0) AS sold_quantity,
//(IFNULL((SELECT SUM(ett.TT_ticket_quantity) FROM event_ticket_types AS ett WHERE e.event_id=ett.TT_event_id),0)-IFNULL((SELECT SUM(oi.OI_quantity) FROM order_items as oi WHERE e.event_id=oi.OI_OE_id " . $params . "),0)) AS ticket_left
//FROM `events` as e
//WHERE e.`event_created_by`='$login_user_id'     
//GROUP BY e.event_id  
//ORDER BY e.event_id DESC";
$result = mysqli_query($con, $sql);
$object = array();
while ($row = mysqli_fetch_array($result)) {
    $object[] = $row;
}

//total sales
$params_sales = '';
if (!empty($date)) {
    if ($date == "month") {
        $params_sales = " AND (DATE_FORMAT(orders.order_created,'%Y-%m-%d')>='" . date("Y-m-d", strtotime("-1 month")) . "' AND DATE_FORMAT(orders.order_created,'%Y-%m-%d')<='" . date("Y-m-d") . "')";
    } elseif ($date == "week") {
        $params_sales = " AND (DATE_FORMAT(orders.order_created,'%Y-%m-%d')>='" . date("Y-m-d", strtotime("-7 day")) . "' AND DATE_FORMAT(orders.order_created,'%Y-%m-%d')<='" . date("Y-m-d") . "')";
    } else {
        $params_sales = " AND DATE_FORMAT(orders.order_created,'%Y-%m-%d')='$date'";
    }
}

if(!empty($startdate))
{
    $params = " AND (DATE_FORMAT(orders.order_created,'%Y-%m-%d')>='" . $startdate . "' AND DATE_FORMAT(orders.order_created,'%Y-%m-%d')<='" . $enddate . "')";
}

if (!empty($evt)) {
    $evparam = " AND oe.OE_event_id='$evt'";
}

$sql_total_sales = "SELECT IFNULL(sum(orders.`order_total_amount`-(orders.`order_vat_amount`+orders.`order_discount_amount`+orders.`order_promotion_discount_amount`+orders.`order_shipment_charge`)),0) as onlinecharge FROM `orders` 
    INNER JOIN order_events AS oe ON orders.order_id=oe.OE_order_id
    WHERE oe.OE_event_id IN (SELECT event_id FROM events WHERE event_created_by='$login_user_id') $evparam " . $params_sales;
$result = mysqli_query($con, $sql_total_sales);
$row = mysqli_fetch_array($result);
$totalSales = $row['onlinecharge'];


//net earnings  
$params_earnings = '';
if (!empty($date)) {
    if ($date == "month") {
        $params_earnings = " AND (DATE_FORMAT(o.order_created,'%Y-%m-%d')>='" . date("Y-m-d", strtotime("-1 month")) . "' AND DATE_FORMAT(o.order_created,'%Y-%m-%d')<='" . date("Y-m-d") . "')";
    } elseif ($date == "week") {
        $params_earnings = " AND (DATE_FORMAT(o.order_created,'%Y-%m-%d')>='" . date("Y-m-d", strtotime("-7 day")) . "' AND DATE_FORMAT(o.order_created,'%Y-%m-%d')<='" . date("Y-m-d") . "')";
    } else {
        $params_earnings = " AND DATE_FORMAT(o.order_created,'%Y-%m-%d')='$date'";
    }
}

if(!empty($startdate))
{
    $params = " AND (DATE_FORMAT(o.order_created,'%Y-%m-%d')>='" . $startdate . "' AND DATE_FORMAT(o.order_created,'%Y-%m-%d')<='" . $enddate . "')";
}


if (!empty($evt)) {
    $evparam = " AND A.event_id='$evt'";
}

$sql = "SELECT A.event_id,A.event_title,SUM(B.netearning) as total_sales FROM 
                                (SELECT 
                                 e.event_id,
                                 e.event_title 
                                 FROM `events` as e
                                 WHERE e.event_created_by='$login_user_id') AS A,
                                (SELECT 
                                oe.OE_event_id,
                                IFNULL(SUM(o.`order_total_amount`-(o.`order_vat_amount`+o.`order_discount_amount`+o.`order_shipment_charge`+o.`order_promotion_discount_amount`)),0) as netearning
                                FROM order_events as oe 
                                LEFT JOIN orders as o ON oe.OE_order_id=o.order_id $params_earnings
                                LEFT JOIN `events` as e on oe.OE_event_id=e.event_id 
                                WHERE e.event_created_by='$login_user_id' 
                                GROUP BY oe.OE_event_id) AS B 
                                WHERE A.event_id=B.OE_event_id $evparam";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$totalNetCharge = $row['total_sales'];

//remain refunds sql
$params_refunds_remain = '';
if (!empty($date)) {
    if ($date == "month") {
        $params_refunds_remain = " AND (DATE_FORMAT(orders.order_created,'%Y-%m-%d')>='" . date("Y-m-d", strtotime("-1 month")) . "' AND DATE_FORMAT(orders.order_created,'%Y-%m-%d')<='" . date("Y-m-d") . "')";
    } elseif ($date == "week") {
        $params_refunds_remain = " AND (DATE_FORMAT(orders.order_created,'%Y-%m-%d')>='" . date("Y-m-d", strtotime("-7 day")) . "' AND DATE_FORMAT(orders.order_created,'%Y-%m-%d')<='" . date("Y-m-d") . "')";
    } else {
        $params_refunds_remain = " AND DATE_FORMAT(orders.order_created,'%Y-%m-%d')='$date'";
    }
}

if(!empty($startdate))
{
    $params = " AND (DATE_FORMAT(orders.order_created,'%Y-%m-%d')>='" . $startdate . "' AND DATE_FORMAT(orders.order_created,'%Y-%m-%d')<='" . $enddate . "')";
}

if (!empty($evt)) {
    $evparam = " AND oe.OE_event_id='$evt'";
}

$sql_remain = "SELECT A.withdraw,B.onlinecharge,(B.onlinecharge-A.withdraw) netbalance FROM (
    (SELECT sum(`request_amount`) as withdraw FROM `refund_request` WHERE `merchant_id`='$login_user_id') AS A,
    ((SELECT sum(`order_total_amount`)-(sum(`order_vat_amount`+`order_discount_amount`+`order_promotion_discount_amount`+`order_shipment_charge`)) as onlinecharge FROM `orders` 
INNER JOIN order_events AS oe ON orders.order_id=oe.OE_order_id
WHERE oe.OE_event_id IN (SELECT event_id FROM events WHERE event_created_by='$login_user_id') $evparam " . $params_refunds_remain . ") AS B)
    )";
$result_remain = mysqli_query($con, $sql_remain);
$row_remain = mysqli_fetch_array($result_remain);
$refundamount_remain = $row_remain['netbalance'];
if (empty($refundamount_remain)) {
    $refundamount_remain = 0;
}

//refunds sql
$params_refunds = '';
if (!empty($date)) {
    if ($date == "month") {
        $params_refunds = " AND (DATE_FORMAT(orders.order_created,'%Y-%m-%d')>='" . date("Y-m-d", strtotime("-1 month")) . "' AND DATE_FORMAT(orders.order_created,'%Y-%m-%d')<='" . date("Y-m-d") . "')";
    } elseif ($date == "week") {
        $params_refunds = " AND (DATE_FORMAT(orders.order_created,'%Y-%m-%d')>='" . date("Y-m-d", strtotime("-7 day")) . "' AND DATE_FORMAT(orders.order_created,'%Y-%m-%d')<='" . date("Y-m-d") . "')";
    } else {
        $params_refunds = " AND DATE_FORMAT(orders.order_created,'%Y-%m-%d')='$date'";
    }
}


if(!empty($startdate))
{
    $params = " AND (DATE_FORMAT(orders.order_created,'%Y-%m-%d')>='" . $startdate . "' AND DATE_FORMAT(orders.order_created,'%Y-%m-%d')<='" . $enddate . "')";
}


if (!empty($evt)) {
    $evparam = " AND oe.OE_event_id='$evt'";
}

$sql = "SELECT A.withdraw,B.onlinecharge,(A.withdraw) netbalance FROM (
    (SELECT sum(`request_amount`) as withdraw FROM `refund_request` WHERE `merchant_id`='$login_user_id') AS A,
    ((SELECT sum(`order_total_amount`)-(sum(`order_vat_amount`+`order_discount_amount`+`order_promotion_discount_amount`+`order_shipment_charge`)) as onlinecharge FROM `orders` 
INNER JOIN order_events AS oe ON orders.order_id=oe.OE_order_id
WHERE oe.OE_event_id IN (SELECT event_id FROM events WHERE event_created_by='$login_user_id') $evparam " . $params_refunds . ") AS B)
    )";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$refundamount = $row['netbalance'];
if (empty($refundamount)) {
    $refundamount = 0;
}



//userdata
$params_userdata = '';
if (!empty($date)) {
    if ($date == "month") {
        $params_userdata = " AND (DATE_FORMAT(o.order_created,'%Y-%m-%d')>='" . date("Y-m-d", strtotime("-1 month")) . "' AND DATE_FORMAT(o.order_created,'%Y-%m-%d')<='" . date("Y-m-d") . "')";
    } elseif ($date == "week") {
        $params_userdata = " AND (DATE_FORMAT(o.order_created,'%Y-%m-%d')>='" . date("Y-m-d", strtotime("-7 day")) . "' AND DATE_FORMAT(o.order_created,'%Y-%m-%d')<='" . date("Y-m-d") . "')";
    } else {
        $params_userdata = " AND DATE_FORMAT(o.order_created,'%Y-%m-%d')='$date'";
    }
}


if(!empty($startdate))
{
    $params = " AND (DATE_FORMAT(o.order_created,'%Y-%m-%d')>='" . $startdate . "' AND DATE_FORMAT(o.order_created,'%Y-%m-%d')<='" . $enddate . "')";
}


if (!empty($evt)) {
    $evparam = " AND oe.OE_event_id='$evt'";
}

$sql = "SELECT count(o.order_user_id) as order_users FROM orders as o
INNER JOIN order_events as oe on o.order_id=oe.OE_order_id
WHERE oe.OE_event_id IN (SELECT e.`event_id` FROM `events` as e WHERE e.`event_created_by`='$login_user_id') $evparam " . $params_userdata;
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$totalUsers = $row['order_users'];







$retarr = array("lstevt" => $object, "salesdata" => $totalSales, "netearningsdata" => $totalNetCharge, "refundsdata" => $refundamount, "refundsremaindata" => $refundamount_remain, "userdata" => $totalUsers);

echo json_encode($retarr);









