<?php


//database connection
require_once '../../DBconnection/database_connections.php';
//database connection

//json data decode
@$data = json_decode(file_get_contents("php://input"));
//json data decode

$return_array = array();
$UA_first_name = "";
$UA_last_name = "";
$UA_user_id=$data->user_id;
 $UA_id =$data->id;
 @$UA_title = strtoupper($data->title);
 @$UA_phone = $data->phone;
 @$UA_address =$data->address;
 @$UA_zip = $data->zip;
 @$UA_country_id = $data->country;
 @$UA_city_id = $data->city;
 
if ($UA_address != "") {

    $updateUserAddressArray = '';
    $updateUserAddressArray .=' UA_user_id = "' . $UA_user_id . '"';
    $updateUserAddressArray .=', UA_first_name = "' . $UA_first_name . '"';
    $updateUserAddressArray .=', UA_last_name = "' . $UA_last_name . '"';
    $updateUserAddressArray .=', UA_title = "' . $UA_title . '"';
    $updateUserAddressArray .=', UA_phone = "' . $UA_phone . '"';
    $updateUserAddressArray .=', UA_address = "' . $UA_address . '"';
    $updateUserAddressArray .=', UA_zip = "' . $UA_zip . '"';
    $updateUserAddressArray .=', UA_city_id = "' . $UA_city_id . '"';
    $updateUserAddressArray .=', UA_country_id = "' . $UA_country_id . '"';

    $sqlUpdateUserAddress = "UPDATE user_addresses SET $updateUserAddressArray WHERE UA_id = $UA_id";
    $resultUserAddressUpdate = mysqli_query($con, $sqlUpdateUserAddress);
    if ($resultUserAddressUpdate) {
        $return_array = array("output" => "success", "msg" => "User address updated successfully");
        echo json_encode($return_array);
        exit();
    } else {
        if (true) {
            $err = "resultUserAddressUpdate error: " . mysqli_error($con);
        } else {
            $err = "resultUserAddressUpdate query failed";
        }
    }
} else {
    $return_array = array("output" => "error", "msg" => "User address not updated");
    echo json_encode($return_array);
    exit();
}
?>

