<?php

include'../DBconnection/database_connections.php';
session_start();

$data = json_decode(file_get_contents("php://input"));
$cost = 0;
//$sessionId = session_id();
$e_id=$data->event;
$city=$data->city;
$ordercreated = date('Y-m-d H:i:s');

$sql="SELECT  `country_id`, `city_name`, `event_id`, `city_delivery_charge`FROM `event_cities` WHERE `event_id`='$e_id' AND `city_name`='$city'";
$result=  mysqli_query($con, $sql);
$result_del_cost=  mysqli_fetch_array($result);
echo $cost=$result_del_cost['city_delivery_charge'];


//echo json_encode($array_return);
?>