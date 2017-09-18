<?php

include '../../../config/config.php';

header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];
if ($verb == "GET") {
    $arrayUser = array();
    if(isset($_GET['event_id']))
    {
        $sqlUser = "SELECT users.user_first_name,users.user_last_name,users.user_email,users.user_DOB,users.user_gender,users.user_phone,users.user_last_login,users.user_status,users.user_verification FROM users WHERE users.user_id IN (SELECT OE_user_id FROM order_events WHERE order_events.OE_event_id='".clean($_GET['event_id'])."')";
    }
    else 
    {
        $sqlUser = "SELECT * FROM users ORDER BY user_id DESC";    
    }
    
    $resultUser = mysqli_query($con, $sqlUser);
    if ($resultUser) {
        while ($resultUserObj = mysqli_fetch_object($resultUser)) {
            $arrayUser[] = $resultUserObj;
        }
    } else {
        if (DEBUG) {
            $err = "resultUser error: " . mysqli_error($con);
        } else {
            $err = "resultUser query failed";
        }
    }
    echo "{\"data\":" . json_encode($arrayUser) . "}";
}
?>