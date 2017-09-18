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


$sql="SELECT * FROM `event_default_image` ORDER BY id DESC";
$result=mysqli_query($con,$sql);
$object =array();
while ($row= mysqli_fetch_array($result)) {
    $object[]=$row;
    
}
echo json_encode($object);

