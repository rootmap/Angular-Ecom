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


$id = $data->event_id;  // 
$sql = "UPDATE `events` SET event_status='delete' WHERE event_id='$id'"; 
$result=mysqli_query($con, $sql);
if($result==1)
{
    echo 1;
}
else
{
    echo 2;
}