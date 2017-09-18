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


//$sql = "SELECT 
//epm.id,
//epm.event_id,
//e.event_title,
//pm.name,
//epm.`date`,
//CASE epm.status WHEN 0 THEN 'Inactive'
//ELSE CASE epm.status WHEN 1 THEN 'Active'
//ELSE 'Not Mention' END END AS payment_method_status
//FROM `eventwise_payment_method` as epm
//LEFT JOIN `events` as e ON epm.event_id=e.event_id 
//LEFT JOIN `payment_method` as pm on epm.`payment_method_id`=pm.id
//WHERE epm.offline_status='1' AND epm.event_id IN (SELECT event_id FROM `events` WHERE event_created_by='$login_user_id') ORDER BY epm.id DESC";
$sql="SELECT 
epm.id,
epm.event_id,
e.event_title,
pm.name,
epm.`date`,
CASE epm.status WHEN 0 THEN 'Inactive'
ELSE CASE epm.status WHEN 1 THEN 'Active'
ELSE 'Not Mention' END END AS payment_method_status
FROM `eventwise_payment_method` as epm
LEFT JOIN `events` as e ON epm.event_id=e.event_id 
LEFT JOIN `payment_method` as pm on epm.`payment_method_id`=pm.id
WHERE  epm.event_id IN (SELECT event_id FROM `events` WHERE event_created_by='$login_user_id') ORDER BY epm.id DESC";

$result = mysqli_query($con, $sql);
   $object = array();
   while ($row = mysqli_fetch_array($result)) {
       $object[]=$row;
    
}
echo json_encode($object); 