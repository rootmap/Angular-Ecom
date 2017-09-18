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
//json data encoding passing end here

 $sql = "SELECT
event_id,
event_title,
c.category_title,
ey.name,
organized_by,
event_status,
event_url,

event_created_on,
event_created_end 
FROM `events`
INNER JOIN categories as c ON c.category_id=events.`event_category_id`
INNER JOIN event_type as ey ON ey.id=events.`event_type`
WHERE `event_created_by`='$login_user_id'
ORDER BY event_id DESC"; 
$result=mysqli_query($con, $sql);
$object=array();
while ($row=  mysqli_fetch_array($result)){
    /* @var $row type */
    $object[]= $row;
}

echo json_encode($object);