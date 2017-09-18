<?php 

include'../DBconnection/auth.php';
include'../DBconnection/database_connections.php';

@$data = json_decode(file_get_contents("php://input"));
@$ua_id=$data->user_id;
@$type=$data->fieldName;
 $userID =$login_user_id;

$userAddress = array();
$userAddressSql = "SELECT 
user_addresses.*, 
countries.country_name, 
cities.city_name,
users.user_default_shipping,
users.user_default_billing
FROM user_addresses 
LEFT JOIN countries ON user_addresses.UA_country_id = countries.country_id 
LEFT JOIN cities ON user_addresses.UA_city_id = cities.city_id 
LEFT JOIN users ON users.user_id = user_addresses.UA_user_id 
WHERE UA_user_id = '$userID' OR user_id='$userID' ORDER BY user_addresses.UA_id DESC
";

$userAddressResult = mysqli_query($con, $userAddressSql);
$countUserAddress = mysqli_num_rows($userAddressResult);
if ($countUserAddress > 0) {
    while ($rowAddress = mysqli_fetch_object($userAddressResult)) {
        $userAddress[] = $rowAddress;
    }
}



//get default address from user table
$default=array();
$sqlDefaultAdd = "SELECT "
        . "user_default_shipping,"
        . "user_default_billing "
        . "FROM users WHERE user_id=$userID";
$resultDefaultAdd = mysqli_query($con, $sqlDefaultAdd);
if ($resultDefaultAdd) {
    while ($resultDefaultAddObj = mysqli_fetch_object($resultDefaultAdd)) {
       $userAdd []= $resultDefaultAddObj;
    }
} else {
    if (true) {
        $err = "getDefaultAdd error: " . mysqli_error($con);
    } else {
        $err = "getDefaultAdd query failed";
    }
}

if ($ua_id > 0 AND !empty($type)) {
    if ($type == "shipping") {
        $sqlUpdateDefaultShipping = "UPDATE users SET user_default_shipping=$ua_id WHERE user_id=$userID";
        $resultUpdateDefaultShipping = mysqli_query($con, $sqlUpdateDefaultShipping);
        if ($resultUpdateDefaultShipping) {
            $return_array = array("output" => "success", "msg" => "Success!! Selected address is now your default delivery address.");
           
        } else {
          		echo "shipping";
                $err = "resultUpdateDefaultShipping query failed";
                $return_array = array("output" => "success", "msg" => $err);
            }
        }
    } 
     if($type == "billing"){
        $sqlUpdateDefaultShipping = "UPDATE users SET user_default_billing=$ua_id WHERE user_id=$userID";
        $resultUpdateDefaultShipping = mysqli_query($con, $sqlUpdateDefaultShipping);
        if ($resultUpdateDefaultShipping) {
            $return_array = array("output" => "success", "msg" => "Success!! Selected address is now your default billing address.");
        } else {
        	echo "billing";
                $err = "resultUpdateDefaultShipping query failed";
                $return_array = array("output" => "success", "msg" => $err);
            }
        }
 @$deleteUserAdd=$data->UA_id;
 if (!empty($deleteUserAdd)) {
 	$delSql="DELETE FROM user_addresses WHERE UA_id=$deleteUserAdd";
 	$delResult=mysqli_query($con,$delSql);
 	if ($delResult) {
 		echo "ok";
 	}else{
 		echo "nope";
 	}
 }

echo json_encode($userAddress);





?>
