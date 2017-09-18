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

$tocken = $data->tid;

$sql = "SELECT cio.*,od.order_id,od.order_user_id,e.event_title,u.user_first_name,u.user_phone FROM `checkininout` as cio 
INNER JOIN orders as od ON cio.`pattern`=od.order_number 
INNER JOIN order_events as oe on od.order_id=oe.OE_order_id
INNER JOIN `events` as e on oe.OE_event_id=e.event_id
INNER JOIN users as u on od.order_user_id=u.user_id
WHERE cio.`ticket_id`='" . $tocken . "' ORDER BY cio.id DESC";
$result = mysqli_query($con, $sql);
$object = array();
$chkres = mysqli_num_rows($result);
if ($chkres != 0) {
    
    while ($row = mysqli_fetch_array($result)) {
        $object[] = $row;
    }
}
echo json_encode($object);

