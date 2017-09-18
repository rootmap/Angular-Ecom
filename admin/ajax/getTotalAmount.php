<?php

include '../../config/config.php';
$eventID = 0;
$arrGetVenueInfo = array();
extract($_POST);
if (!empty($mid)) {
    $sql = "SELECT A.withdraw,B.onlinecharge,(B.onlinecharge-A.withdraw) netbalance FROM (
    (SELECT sum(`request_amount`) as withdraw FROM `refund_request` WHERE `merchant_id`='$mid') AS A,
    ((SELECT sum(`order_total_amount`)-(sum(`order_vat_amount`+`order_discount_amount`+`order_promotion_discount_amount`+`order_shipment_charge`)) as onlinecharge FROM `orders` 
INNER JOIN order_events AS oe ON orders.order_id=oe.OE_order_id
WHERE oe.OE_event_id IN (SELECT event_id FROM events WHERE event_created_by='$mid')) AS B))";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $refundamount = $row['netbalance'];
    echo json_encode($refundamount);
}    
    
    