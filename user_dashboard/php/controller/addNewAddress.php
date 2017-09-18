<?php


//database connection
require_once '../../DBconnection/database_connections.php';
//database connection

//authority page connection
require_once '../../../DBconnection/auth.php';
//authority page connection

//json data decode
@$data = json_decode(file_get_contents("php://input"));
//json data decode

//session user id
//$login_user_id=$_SESSION['USER_DASHBOARD_USER_ID'];
//session user id

//user id
@$UA_user_id = $login_user_id;
//user id

@$return_array = array();
@$UA_title =$data->Addtitle;
@$UA_first_name = "";
@$UA_last_name = "";
@$UA_phone =$data->phone;
@$UA_address =$data->address;
@$UA_zip =$data->zip;
@$UA_city_id =$data->city;
@$UA_country_id =$data->country;


if ($UA_address != "") {

    $addUserAddressArray = '';
    $addUserAddressArray .=' UA_user_id = "' . $UA_user_id . '"';    
    $addUserAddressArray .=', UA_first_name = "' . $UA_first_name . '"';
    $addUserAddressArray .=', UA_last_name = "' . $UA_last_name . '"';
    $addUserAddressArray .=', UA_title = "' . $UA_title . '"';
    $addUserAddressArray .=', UA_phone = "' . $UA_phone . '"';
    $addUserAddressArray .=', UA_address = "' . $UA_address . '"';
    $addUserAddressArray .=', UA_zip = "' . $UA_zip . '"';
    print_r($addUserAddressArray .=', UA_country_id = "' . $UA_country_id . '"');
    $addUserAddressArray .=', UA_city_id = "' . $UA_city_id . '"';
    

   $sqlAddUserAddress = "INSERT INTO user_addresses SET $addUserAddressArray";
    $resultUserAddress = mysqli_query($con, $sqlAddUserAddress);
    if ($resultUserAddress) {
        $return_array = array("output" => "success", "msg" => "User address saved successfully");
        echo json_encode($return_array);
        exit();
    } else {
        if (true) {
            $err = "resultUserAddress error: " . mysqli_error($con);
        } else {
            $err = "resultUserAddress query failed";
        }
    }
} else {
    $return_array = array("output" => "error", "msg" => "User address not saved");
    echo json_encode($return_array);
    exit();
}



?>
