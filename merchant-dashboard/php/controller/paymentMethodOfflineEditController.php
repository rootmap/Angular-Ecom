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
$data = json_decode(file_get_contents("php://input"));
//json data encoding passing end here

//event_id,event_title,event_category_id,event_type,organized_by,event_created_on,event_created_end 
$id = $data->id;  //   
$sql = "SELECT 
pm.id,
'".$id."' as event_id,
pm.name,
(SELECT count(id) FROM eventwise_payment_method WHERE event_id='".$id."' AND payment_method_id=pm.id AND `status`='1') as pmst
from payment_method as pm";
$result = mysqli_query($con, $sql);
$chk = mysqli_num_rows($result);
if ($chk!=0) {
    $data=array();
    while($row = mysqli_fetch_array($result))
    {
        $data[]=$row;
    }
    echo json_encode($data);
} else {
    echo 1;
}