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


//$data = json_decode(file_get_contents("php://input"));
//$etemailall = $data->etemailall;
//$messagesend = $data->messagesend;


//$sql = "INSERT INTO order_email_record SET email= '$etemailall ', massage='$messagesend'";


$sql = "SELECT
o.`order_id`,
u.user_email

FROM `orders` as o
INNER JOIN users as u ON o.`order_user_id`=u.user_id
INNER JOIN order_events as oe ON oe.OE_order_id= o.`order_id`

WHERE (oe.OE_event_id IN (SELECT e.`event_id` FROM `events` as e WHERE e.`event_created_by`='$login_user_id')) AND 
u.user_email REGEXP '^[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$' 
GROUP BY u.user_email 
ORDER BY o.order_id DESC";
$result = mysqli_query($con, $sql);
$object = array();
//$emaillist=array();
while ($row = mysqli_fetch_array($result)) {
    //$object[] = $row;
    array_push($object, $row['user_email']);
}

$dd='';
if (!empty($object)) {
    $dd=implode(',  ',$object);
}
$dat=json_encode($dd);
echo str_replace('"', '', $dat);
//echo $dd;
