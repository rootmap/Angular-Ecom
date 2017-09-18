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


 $sql = "SELECT 
o.order_id,
ifnull(u.`user_name`,'Not Mentioned') as fullname,
o.`order_session_id`,
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
LEFT JOIN temp_billing as u on o.order_session_id=u.order_id
LEFT JOIN order_events as oe on o.order_id=oe.OE_order_id
WHERE oe.OE_event_id
IN (SELECT e.`event_id` FROM `events` as e WHERE e.`event_created_by`='$login_user_id')ORDER BY order_id DESC";
//         "SELECT 
//concat(users.user_first_name,' ',users.user_last_name) as fullname,
//orders.order_id,
//orders.order_number,
//orders.order_read,
//orders.order_status,
//orders.order_payment_type,
//orders.order_total_amount,
//orders.order_total_item,
//orders.order_method
//
//FROM `orders`
//
//INNER JOIN
//users on  users.user_id=orders.order_user_id ORDER BY order_id DESC";
$result = mysqli_query($con, $sql);
   $object = array();
   while ($row = mysqli_fetch_array($result)) {
       $object[]=$row;
    
}
echo json_encode($object); 