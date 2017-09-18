<?php

//database connection
require_once '../../DBconnection/database_connections.php';
//database connection

//authority page connection
require_once '../../../DBconnection/auth.php';
//authority page connection

//json data decode
$data = json_decode(file_get_contents("php://input"));
//json data decode

 $o_id = $data->oid;

$sql = " 
SELECT order_total_item FROM `orders` WHERE order_id='$o_id'
       ";

$result = mysqli_query($con, $sql);

$object = array();

while ($row = mysqli_fetch_array($result)) {
    
    $object[] = $row;
    
}

echo json_encode($object);



?>

