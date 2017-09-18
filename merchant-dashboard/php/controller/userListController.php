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



//WHERE oe.OE_event_id IN(SELECT e.`event_id` FROM `events` as e WHERE e.`event_created_by`='$login_user_id')
/* Data convert by jeson start here */
$data = json_decode(file_get_contents("php://input"));
/* ./Data convert by jeson end here */
//$id=$data->id;

 $sql = "SELECT u.user_id,
        concat(u.user_first_name,u.user_middle_name)as fullname,
        u.user_email,
        u.user_phone,
        u.user_gender
     FROM orders as o
    INNER JOIN order_events as oe on o.order_id=oe.OE_order_id
    INNER JOIN users as u ON u.user_id=oe.OE_user_id
    WHERE oe.OE_event_id IN (SELECT e.`event_id` FROM `events` as e WHERE e.`event_created_by`='$login_user_id')";
$result = mysqli_query($con, $sql);
   $object = array();
   while ($row = mysqli_fetch_array($result)) {
       $object[]=$row;
    
}
echo json_encode($object); 

