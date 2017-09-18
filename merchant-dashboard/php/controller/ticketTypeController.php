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

$sql = "SELECT `id`, `name`, `date`, `status` FROM `merchant_ticket_types` WHERE status='1'";
$result = mysqli_query($con, $sql);
   $object = array();
   while ($row = mysqli_fetch_array($result)) {
       $object[]=$row;
    
}
echo json_encode($object); 


//D-BAG
//$chk = mysqli_num_rows($query);
//
//if ($chk != "0") {
//    $data=array();
//    while ($rw=  mysqli_fetch_array($query))
//    {
//        $data[]=$rw;
//    }
//    
//    
//    $ss=json_encode($data);
//
//    echo $ss;
//    
//} else {
//    echo 0;
//}



