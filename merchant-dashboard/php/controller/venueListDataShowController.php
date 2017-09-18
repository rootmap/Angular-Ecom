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
$id=$data->venue_id;

$sql = "SELECT 
ev.venue_id,
e.event_title,

ev.venue_title,
ev.city,
ev.country
FROM 
`event_venues` as ev
INNER JOIN events as e on e.event_id=ev.`venue_event_id`

WHERE e.event_id

IN (SELECT e.`event_id` FROM `events` as e WHERE e.`event_created_by`='$login_user_id')

ORDER BY venue_id DESC";
$result = mysqli_query($con, $sql);
   $object = array();
   while ($row = mysqli_fetch_array($result)) {
       $object[]=$row;
    
}
echo json_encode($object); 

