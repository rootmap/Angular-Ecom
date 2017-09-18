<?php

//database connection
require_once '../../DBconnection/database_connections.php';
//database connection

//authority page connection
//require_once '../../../DBconnection/auth.php';
//authority page connection

//json data decode
$data = json_decode(file_get_contents("php://input"));
//json data decode

$oId = $data->oid;

//$sql = " 
//select 
//o.order_id,
//o.order_number, 
//o.order_status, 
//o.order_total_item,
//o.order_shipment_charge,
//oe.OE_event_id,
//e.event_title,
//e.event_description,
//e.organized_by,
//e.event_terms_conditions,
//e.event_web_logo,
//ev.venue_title,
//ev.venue_id,
//c.category_title,
//CONCAT(u.user_first_name,' ',u.user_last_name) as userName,
//u.user_phone,
//u.user_email,
//ua.UA_address,
//
//
//DATE_FORMAT(ev.venue_start_date, '%W, %M %e, %Y') as start_date,
//DATE_FORMAT(ev.venue_end_date, '%W, %M %e, %Y') as end_date,
//TIME_FORMAT(ev.venue_start_time, '%h:%i%p') as start_time,
//TIME_FORMAT(ev.venue_end_time, '%h:%i%p') as end_time,
//
//DATE_FORMAT(ev.venue_start_date, '%M %d, %Y') as start_date2,
//DATE_FORMAT(ev.venue_end_date, '%M %d, %Y') as end_date2,
//
//CASE o.order_payment_type
//WHEN 'CARD' THEN 'Online Payment'
//WHEN 'COD'  THEN 'Cash On Delivery'
//WHEN 'eticket' THEN 'Online Free E-Ticket'
//WHEN 'movie-eticket-online' THEN 'Online Movie E-Ticket'
//WHEN 'movie-eticket-cod' THEN 'Cash On Delivery'
//ELSE 'Pick From Office'
//END payment_method,
//IFNULL(oit.quantity,0) AS ticket_quantity ,
//IFNULL(oit.total_price,0) AS ticket_total_price,
//IFNULL(oii.quantity,0) AS include_quantity,
//IFNULL(oii.Itotal_price,0) AS include_total_price,
//o.order_total_item AS oiteam,
//((o.`order_total_amount` + o.`order_vat_amount`)-o.`order_discount_amount`) AS newtotal_price
//
//from `orders`AS o
//LEFT JOIN `order_events` AS oe ON o.order_id = oe.OE_order_id
//LEFT JOIN `events`       AS e ON oe.OE_event_id = e.event_id
//LEFT JOIN `event_venues` AS ev ON e.event_id = ev.venue_event_id
//LEFT JOIN `categories`   AS c  ON e.event_category_id = c.category_id
//LEFT JOIN `users`        AS u  ON o.order_user_id = u.user_id
//LEFT JOIN `user_addresses` AS ua ON u.user_id = ua.UA_user_id 
//LEFT JOIN (SELECT 
//           oi.OI_order_id,
//           SUM(oi.OI_quantity) AS quantity,
//           SUM(oi.OI_quantity*oi.OI_unit_price) AS total_price,
//           oi.OI_item_type FROM order_items as oi 
//           WHERE oi.OI_order_id='$oId'
//           GROUP BY oi.OI_item_type) AS oit ON oit.OI_order_id=o.order_id AND oit.OI_item_type='ticket'
//           
//LEFT JOIN (SELECT
//           oi.OI_order_id,
//           SUM(oi.OI_quantity) AS quantity,
//           SUM(oi.OI_quantity*oi.OI_unit_price) AS Itotal_price,
//           oi.OI_item_type FROM order_items as oi 
//           WHERE oi.OI_order_id='$oId'
//           GROUP BY oi.OI_item_type) AS oii ON oii.OI_order_id=o.order_id AND oii.OI_item_type='include'
//where o.order_id ='$oId' GROUP BY o.order_id
//       ";


 $sql = " 
SELECT

e.`event_id`,
e.`event_title`,
e.`event_web_logo`,
e.`event_terms_conditions`,
e.`event_description`,
e.`organized_by`,

ev.`venue_id`,
ev.`venue_title`,

o.`order_session_id`,
o.`order_id`,
o.`order_number`, 
o.`order_status`, 
o.`order_total_item`,
o.`order_shipment_charge`,

CASE o.`order_payment_type`
WHEN 'CARD' THEN 'Online Payment'
WHEN 'COD'  THEN 'Cash On Delivery'
WHEN 'eticket' THEN 'Online Free E-Ticket'
WHEN 'movie-eticket-online' THEN 'Online Movie E-Ticket'
WHEN 'movie-eticket-cod' THEN 'Cash On Delivery'
ELSE 'Pick From Office'
END payment_method,

((o.`order_total_amount` + o.`order_vat_amount`)-o.`order_discount_amount`) AS newtotal_price,
oe.`OE_event_id`,

IFNULL(oit.quantity,0) AS ticket_quantity ,
IFNULL(oit.total_price,0) AS ticket_total_price,
IFNULL(oii.quantity,0) AS include_quantity,
IFNULL(oii.total_price,0) AS include_total_price,

c.`category_title`,

u.`user_name` as userName,
u.`user_phone`,
u.`user_email`,
ua.`UA_address`,

DATE_FORMAT(ev.venue_start_date, '%a %D %b %Y') as start_date,
DATE_FORMAT(ev.venue_end_date, '%a %D %b %Y') as end_date,
TIME_FORMAT(ev.venue_start_time, '%h:%i%p') as start_time,
TIME_FORMAT(ev.venue_end_time, '%h:%i%p') as end_time

from `orders`AS o
LEFT JOIN `order_events` AS oe ON o.order_id = oe.OE_order_id
LEFT JOIN `events`       AS e ON oe.OE_event_id = e.event_id
LEFT JOIN `event_venues` AS ev ON e.event_id = ev.venue_event_id
LEFT JOIN `categories`   AS c  ON e.event_category_id = c.category_id
LEFT JOIN `temp_billing` AS u  ON o.order_session_id = u.order_id
LEFT JOIN `user_addresses` AS ua ON u.user_id = ua.UA_user_id 
LEFT JOIN (SELECT oi.OI_order_id,SUM(oi.OI_quantity) AS quantity,SUM(oi.OI_quantity*oi.OI_unit_price) AS total_price,oi.OI_item_type FROM order_items as oi 
WHERE oi.OI_order_id='$oId'
GROUP BY oi.OI_item_type) AS oit ON oit.OI_order_id=o.order_id AND oit.OI_item_type='ticket'
LEFT JOIN (SELECT oi.OI_order_id,SUM(oi.OI_quantity) AS quantity,SUM(oi.OI_quantity*oi.OI_unit_price) AS total_price,oi.OI_item_type FROM order_items as oi 
WHERE oi.OI_order_id='$oId'
GROUP BY oi.OI_item_type) AS oii ON oii.OI_order_id=o.order_id AND oii.OI_item_type='include'
where o.order_id ='$oId'
       ";

$result = mysqli_query($con, $sql);

$object = array();

while ($row = mysqli_fetch_array($result)) {
    
    $object[] = $row;
    
}

echo json_encode($object);



?>

