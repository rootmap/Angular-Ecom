<?php 
include'../DBconnection/database_connections.php';


@$data = json_decode(file_get_contents("php://input"));
 $event_id=$data->id;

$return_array = array();


//@$UA_title =$data->Addtitle;
//@$UA_first_name =$data->name;;
//@$UA_last_name='';
//@$UA_phone =$data->phone;
//@$UA_address =$data->address;
//@$UA_zip =$data->zip;
//@$UA_city_id =$data->city;
//@$UA_country_id =$data->country;
//@$UA_email=$data->email;
//
//$UA_user_id = $login_user_id;
//
//
//
//
//$array = array();
//
//
//if ($UA_address != "" || $UA_first_name || $UA_email) {
//
//	$query = "SELECT * FROM `users` WHERE `user_id`='2'";
//
//	$result = mysqli_query($con,$query);
//	$count=mysqli_num_rows($result );
//
//	if ($count >0) {
//		$sqlUpdateUserEmail="UPDATE users SET user_email='$UA_email' WHERE `user_id`='2' ";
//		$resultUpdateUserEmail = mysqli_query($con,$sqlUpdateUserEmail);
//
//		if ($resultUpdateUserEmail) {
//			@$addUserAddressArray = '';
//		    @$addUserAddressArray .=' UA_user_id = "' . $UA_user_id . '"';    
//		    @$addUserAddressArray .=', UA_first_name = "' . $UA_first_name . '"';
//		    @$addUserAddressArray .=', UA_last_name = "' . $UA_last_name . '"';
//		    @$addUserAddressArray .=', UA_title = "' . $UA_title . '"';
//		    @$addUserAddressArray .=', UA_phone = "' . $UA_phone . '"';
//		    @$addUserAddressArray .=', UA_address = "' . $UA_address . '"';
//		    @$addUserAddressArray .=', UA_zip = "' . $UA_zip . '"';
//		    @$addUserAddressArray .=', UA_city_id = "' . $UA_city_id . '"';
//		    @$addUserAddressArray .=', UA_country_id = "' . $UA_country_id . '"';
//
//		    $sqlAddUserAddress = "INSERT INTO user_addresses SET $addUserAddressArray";
//		    $resultUserAddress = mysqli_query($con, $sqlAddUserAddress);
//		    if ($resultUserAddress) {
//		        $return_array = array("output" => "success", "msg" => "User address saved successfully");
//		        echo json_encode($return_array);
//		        exit();
//		    } else {
//		        if (true) {
//		            $err = "resultUserAddress error: " . mysqli_error($con);
//		        } else {
//		            $err = "resultUserAddress query failed";
//		        }
//		}
//		}
//	}else{
//		$return_array = array("output" => "error", "msg" => "please signup frist");
//		        echo json_encode($return_array);
//	}  
//} else {
//    $return_array = array("output" => "error", "msg" => "User address not saved");
//    echo json_encode($return_array);
//    exit();
//}
    
    $sql="SELECT `event_id`,`event_type`,`event_title` FROM `events` WHERE `event_id`=$event_id AND `event_type` IN(3,5,7)";
    $result = mysqli_query($con,$sql);
    if ($result) {
            while ($resultEventTicketsObj = mysqli_fetch_object($result)) {
                $return_array[] = $resultEventTicketsObj;
            }
        } else {
            
                echo 0;
            
        }
    
echo json_encode($return_array);

?>