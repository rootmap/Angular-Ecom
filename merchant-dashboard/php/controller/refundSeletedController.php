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


$sql = "SELECT A.withdraw,B.onlinecharge,(B.onlinecharge-A.withdraw) netbalance FROM (
    (SELECT IFNULL(sum(`request_amount`),0) as withdraw FROM `refund_request` WHERE `merchant_id`='$login_user_id') AS A,
    ((SELECT sum(`order_total_amount`)-(sum(`order_vat_amount`+`order_discount_amount`+`order_promotion_discount_amount`+`order_shipment_charge`)) as onlinecharge FROM `orders` 
INNER JOIN order_events AS oe ON orders.order_id=oe.OE_order_id
WHERE oe.OE_event_id IN (SELECT event_id FROM events WHERE event_created_by='$login_user_id')) AS B))";
$result = mysqli_query($con, $sql);
   $object = array();
   while ($row = mysqli_fetch_array($result)) {
       $object[]=$row;
    
}
echo json_encode($object); 

