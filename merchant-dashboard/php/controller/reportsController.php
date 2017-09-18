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


$sql = "Select 
e.`event_id`,
e.`event_title`,
count(o.order_id) as `ordersAmount`

FROM `events` as e
INNER JOIN `order_events` as oe ON oe.OE_event_id=e.event_id
INNER JOIN `orders` as o ON o.order_id=oe.OE_order_id

WHERE e.`event_created_by`='83'

GROUP BY e.event_id DESC";

$result = mysqli_query($con, $sql);
$object = array();
while ($row = mysqli_fetch_array($result)) {
    $object[] = $row;
}
echo json_encode($object);
