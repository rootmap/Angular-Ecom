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


$u_id = $login_user_id;

$sql="SELECT 
CONCAT(u.user_first_name ,' ', u.user_last_name) AS fullname,
u.user_email,
u.user_phone,
ua.UA_address,

IFNULL((SELECT count(`ETC_id`) as cart FROM `event_temp_cart` WHERE `ETC_user_id`=u.`user_id`),0) as totalcart,

IFNULL((SELECT count(`WL_id`) as wishlist FROM `wishlists` WHERE `WL_user_id`=u.`user_id`),0) as totalwishlist,

IFNULL((SELECT sum(`order_total_amount`) as spent FROM `orders` WHERE `order_user_id`=u.`user_id` AND `order_status`='paid'),0) as totalspent

from users AS u LEFT JOIN user_addresses AS ua ON u.user_id = ua.UA_user_id
WHERE u.user_id = '$u_id'";

$result = mysqli_query($con, $sql);

$object = array();

while ($row = mysqli_fetch_array($result)) {
    $object[] = $row;
}

//
//$sql2 = "SELECT COUNT(`EITC_session_id`) AS total_cart 
//FROM event_item_temp_cart 
//LEFT JOIN event_temp_cart ON `EITC_session_id` = `ETC_session_id` 
//WHERE `EITC_session_id` = '9f9bf237a4432e12e80564ccb54f6acf'";
//$result2 = mysqli_query($con, $sql2);
//
//while ($row2 = mysqli_fetch_array($result2)) {
//    $object[] = $row2;
//}

echo json_encode($object);    

?>
