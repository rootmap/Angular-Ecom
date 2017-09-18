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

$data=json_decode(file_get_contents("php://input"));

$eventId=$data->event;
$startDate=$data->startdate;
$startDate = date("Y-m-d", strtotime($startDate));

$endDate=$data->enddate;
$endDate = date("Y-m-d", strtotime($endDate));

$sql = "SELECT 
concat(u.user_first_name,u.user_last_name) as fullname,
u.user_phone,
e.event_title,
ck.`ticket_id`,
ck.`datetime`,
ck.`status`

FROM `checkininout`as ck
INNER JOIN `orders` as o on o.order_number=ck.`pattern`
INNER JOIN `users` as u on u.user_id=o.order_user_id
INNER JOIN `order_events` as oe on oe.OE_order_id=o.order_id
INNER JOIN `events` as e on e.event_id=oe.OE_event_id WHERE e.`event_id`='$eventId' AND e.event_created_on='$startDate' AND e.event_created_end='$endDate'
ORDER BY `id` DESC"; 
$result=mysqli_query($con, $sql);
$object=array();
while ($row=  mysqli_fetch_array($result)){
 
    $object[]= $row;
}

echo json_encode($object);