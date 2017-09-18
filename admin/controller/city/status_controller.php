<?php
header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];

if ($verb == "GET") {

    $arr = array();
    $arr[0] = array("status_id" => 1, "city_status" => "allow");
    $arr[1] = array("status_id" => 2, "city_status" => "notallow");
    $jsonArr = json_encode($arr);
    
    echo "{\"data\":" . $jsonArr . "}";
}
