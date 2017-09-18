<?php

include '../../../config/config.php';

$adminEventPermission = '';
$adminID = 0;
$adminEventID = '';
if ((getSession('admin_event_permission')) AND ( getSession('admin_id'))) {
    $adminEventPermission = getSession('admin_event_permission');
    $adminID = getSession('admin_id');
    $adminEventID = getSession('admin_event_id');
}

header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];
if ($verb == "GET") {
    $arrayOrder = array();
    $sqlOrderList = " select alldata.*,(alldata.sold_ticket+alldata.ticket_in_stock) as total_ticket,
				((alldata.sold_ticket+alldata.ticket_in_stock)*alldata.Per_Ticket_price ) as total_ticket_price
FROM (select e.event_id,
             e.event_title as event_name,
             IFNULL(ett.ticket_price,0) as Per_Ticket_price,
             IFNULL(oi.tq,0) as sold_ticket,
             IFNULL((oi.tq*ett.ticket_price),0) as sold_ticket_amount,
             IFNULL(et.ticket_inventory,0) as ticket_in_stock
             from events as e
            LEFT JOIN (SELECT OI_OE_id,IFNULL(SUM(OI_quantity),0) as tq FROM order_items GROUP BY OI_OE_id) as oi on oi.OI_OE_id=e.event_id 
            LEFT JOIN (SELECT TT_event_id,IFNULL(SUM(TT_ticket_quantity),0) as ticket_inventory FROM event_ticket_types GROUP BY TT_event_id) as et on et.TT_event_id=e.event_id
             LEFT JOIN (SELECT TT_event_id,SUM(TT_current_price) as  ticket_price FROM event_ticket_types GROUP BY TT_event_id) as ett on ett.TT_event_id=e.event_id) as alldata ";
    if ($adminEventPermission == "created") {
        $sqlOrderList .= "WHERE event_created_by=$adminID ";
    } elseif ($adminEventPermission == "selected") {
        if ($adminEventID != "") {
            $sqlOrderList .= "WHERE event_id IN ($adminEventID) ";
        } else {
            $sqlOrderList .= "WHERE event_id IN (0) ";
        }
    }
//    $sqlOrderList .= "GROUP BY orders.order_id "
//            . "ORDER BY orders.order_read DESC, orders.order_id DESC";
    $resultOrderList = mysqli_query($con, $sqlOrderList);
    if ($resultOrderList) {
        while ($obj = mysqli_fetch_object($resultOrderList)) {
            $arrayOrder[] = $obj;
        }
    } else {
        if (DEBUG) {
            echo $err = "resultOrderList error: " . mysqli_error($con);
        } else {
            echo $err = "resultOrderList query failed";
        }
    }
    echo "{\"data\":" . json_encode($arrayOrder) . "}";
}