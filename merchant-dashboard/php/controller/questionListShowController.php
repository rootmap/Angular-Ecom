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
edf.`form_id`,
edf.`form_event_id`,
e.event_title,
edf.`form_field_type`,
edf.`form_field_title`,
edf.`form_field_status`
FROM `event_dynamic_forms` as edf 
INNER JOIN `events` AS e ON edf.form_event_id=e.event_id
WHERE edf.`form_event_id` 
IN (SELECT e.`event_id` FROM `events` as e  WHERE e.`event_created_by`='$login_user_id')";
$result = mysqli_query($con, $sql);
   $object = array();
   while ($row = mysqli_fetch_array($result)) {
       $object[]=$row;
    
}
echo json_encode($object); 