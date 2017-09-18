<?php 
header("Access-Control-Allow-Origin: *");

session_start();

include'../DBconnection/auth.php';
include'../DBconnection/database_connections.php';
@$data = json_decode(file_get_contents("php://input"));
$return_array = array();
@$UA_title =$data->Addtitle;
@$UA_first_name =$data->name;
@$UA_phone =$data->phone;
@$UA_address =$data->address;
@$UA_zip =$data->zip;
@$UA_city_id =$data->city;
@$UA_country_id =$data->country;

$UA_user_id = $_SESSION['USER_DASHBOARD_USER_ID'];

if ($UA_address != "" || $UA_first_name || $UA_title) {

    @$addUserAddressArray = '';
    @$addUserAddressArray .=' UA_user_id = "' . $UA_user_id . '"';    
    @$addUserAddressArray .=', UA_first_name = "' . $UA_first_name . '"';
    @$addUserAddressArray .=', UA_last_name = "' . $UA_last_name . '"';
    @$addUserAddressArray .=', UA_title = "' . $UA_title . '"';
    @$addUserAddressArray .=', UA_phone = "' . $UA_phone . '"';
    @$addUserAddressArray .=', UA_address = "' . $UA_address . '"';
    @$addUserAddressArray .=', UA_zip = "' . $UA_zip . '"';
    @$addUserAddressArray .=', UA_city_id = "' . $UA_city_id . '"';
    @$addUserAddressArray .=', UA_country_id = "' . $UA_country_id . '"';

    $sqlAddUserAddress = "INSERT INTO user_addresses SET $addUserAddressArray ";
    $resultUserAddress = mysqli_query($con, $sqlAddUserAddress);
   
//        $return_array = array("output" => "success", "msg" => "User address saved successfully");
//        echo json_encode($return_array);
    echo 1;
        exit();

   
} else {
//    $return_array = array("output" => "error", "msg" => "User address not saved");
//    echo json_encode($return_array);
    
    exit();
}


 ?>