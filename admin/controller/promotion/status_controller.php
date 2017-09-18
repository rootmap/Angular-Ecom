<?php
header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];

if ($verb == "GET") {

    $arr = array();
    $arr[0] = array("status_id" => "active", "PC_code_status" => "active");
    $arr[1] = array("status_id" => "inactive", "PC_code_status" => "inactive");
    $jsonArr = json_encode($arr);
    
    echo "{\"data\":" . $jsonArr . "}";
}
