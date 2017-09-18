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

/*Data convert by jeson start here*/
$data = json_decode(file_get_contents("php://input"));
/*./Data convert by jeson end here*/
$params=$data->status;


 $sql="SELECT
events.event_id,
events.event_title,
c.category_title,
ey.name,

IFNULL((SELECT SUM(o.order_total_amount) as total FROM `orders` as o,order_events as oe
WHERE o.order_id=oe.OE_order_id AND oe.OE_event_id=events.event_id),0) as total_sales,
IFNULL((SELECT SUM(o.order_total_item) as ticket_sold FROM `orders` as o,order_events as oe
WHERE o.order_id=oe.OE_order_id AND oe.OE_event_id=events.event_id),0) as ticket_sold,

events.organized_by,
events.event_status,

DATE_FORMAT(events.`event_created_on`,'%M, %d %Y') as event_created_on,
DATE_FORMAT(events.`event_created_end`,'%M, %d %Y') as event_created_end,
IFNULL((SELECT event_venues.venue_title FROM event_venues WHERE event_venues.venue_event_id=events.event_id),'NOT MENTION') as venue
FROM `events`
INNER JOIN categories as c ON c.category_id=events.`event_category_id`
INNER JOIN event_type as ey ON ey.id=events.`event_type`
WHERE events.`event_created_by`='$login_user_id' AND events.event_status='$params' 
ORDER BY events.event_id DESC";
$result=mysqli_query($con,$sql);


 $e_status=$data->event_status;
 $e_id=$data->event_id;
 if (!empty($e_status) && !empty($e_id)) {
    
     if ($e_status=='active') {
         $sql=  mysqli_query($con,"UPDATE `events` SET `event_status`='inactive' WHERE `event_id`='$e_id'");
     }else{
        $sql=  mysqli_query($con,"UPDATE `events` SET `event_status`='active' WHERE `event_id`='$e_id'");
     }
     if ($sql==1) {
        $result=mysqli_query($con,$sql);
     }
} 


$object =array();
while ($row= mysqli_fetch_array($result)) {
    $object[]=$row;
    
}
echo json_encode($object);

