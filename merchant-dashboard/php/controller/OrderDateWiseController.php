<?php

include '../../DBconnection/auth.php';
//START HERE 
//session_start();
$sessionId = session_id();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Including database connections start here
require_once '../../DBconnection/database_connections.php';
// Including database connections end here



$data = json_decode(file_get_contents("php://input"));



$eventid = $data->event;
$modelDateStart = $data->startdate;
$modelDateEnd = $data->enddate;

$sql = "SELECT 
o.order_id,
concat(u.`user_first_name`,' ',u.`user_middle_name`,' ',u.`user_last_name`) as fullname,

o.`order_number`,
o.`order_status`,
DATE_FORMAT(o.order_created,'%m/%d/%Y') as order_date,
o.`order_total_amount`,
o.`order_total_item`,
o.`order_read`,
o.`order_payment_type`,
oe.OE_event_id 
FROM 
`orders` as o 
INNER JOIN users as u on o.order_user_id=u.user_id
INNER JOIN order_events as oe on o.order_id=oe.OE_order_id
WHERE DATE_FORMAT(o.order_created,'%m/%d/%Y') >= '$modelDateStart' AND DATE_FORMAT(o.order_created,'%m/%d/%Y') <= '$modelDateEnd' AND oe.OE_event_id
IN (SELECT e.`event_id` FROM `events` as e WHERE e.`event_created_by`='$login_user_id' AND e.`event_id`='$eventid')";


$result = mysqli_query($con, $sql);
$object = array();
while ($row = mysqli_fetch_array($result)) {
    $object[] = $row;
}
echo json_encode($object);
