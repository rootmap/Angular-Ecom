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
rq.id,
ad.admin_full_name,
rq.available_amount,
rq.request_amount,
(CASE rq.status WHEN 0 THEN 'pending' ELSE 'active' END) as `status`
FROM 
refund_request as rq 
INNER JOIN `admins` as ad ON rq.merchant_id=ad.admin_id
WHERE rq.merchant_id ='$login_user_id' ORDER BY rq.id DESC";
$result = mysqli_query($con, $sql);
   $object = array();
   while ($row = mysqli_fetch_array($result)) {
       $object[]=$row;
    
}
echo json_encode($object); 