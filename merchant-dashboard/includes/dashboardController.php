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


// $login_user_id;
 $uid = $login_user_id;


$sql = "SELECT 
        u.user_id,
        IFNULL((SELECT count(`WL_id`) as wishlist FROM `wishlists` WHERE `WL_user_id`=u.`user_id`),0) as totalwishlist,
        
        IFNULL((SELECT COUNT(`order_id`) AS orders FROM `orders` WHERE `order_user_id` = u.`user_id`),0) AS totalOrder,
        
        IFNULL((SELECT COUNT(`order_id`) AS orders FROM `orders` WHERE `order_user_id` = u.`user_id` AND `order_status` = 'paid'),0) AS totalPaid,
        
        IFNULL((SELECT COUNT(`order_id`) AS orders FROM `orders` WHERE `order_user_id` = u.`user_id` AND (`order_status` != ('paid' OR 'cancel'))),0) AS totalPandding
        
        from users AS u 
        WHERE u.user_id = '$uid' AND u.user_status='active' AND u.user_verification='yes'";

$result = mysqli_query($con, $sql);

$object = array();

while ($row = mysqli_fetch_array($result)) {
    $object[] = $row;
}

echo json_encode($object);

//if($id == 1){
//    
//   $sql = "Select count(order_user_id) as total_order FROM orders WHERE order_user_id =632";
//   
//   $result = mysqli_query($con, $sql);
//   $row = mysqli_fetch_array($result);
//   
//   $total = $row['total_order'];
//   
//   echo $total;
//    
//}elseif($id == 2){
//    $sql = "SELECT COUNT(`WL_id`) AS total_wish FROM wishlists WHERE `WL_user_id` = 200";
//    $result = mysqli_query($con, $sql);
//    $row = mysqli_fetch_array($result);
//    
//    $totalwish = $row['total_wish'];
//    
//    echo $totalwish;
//}elseif($id == 3){
//    $sql = "SELECT COUNT(`EITC_ETC_id`) AS total_cart FROM event_item_temp_cart AS eitc LEFT JOIN event_temp_cart AS etc ON etc.ETC_id = eitc.EITC_ETC_id WHERE etc.ETC_id = '2108' ";
//    $result = mysqli_query($con, $sql);
//    $row = mysqli_fetch_array($result);
//    
//    $totalcart = $row['total_cart'];
//    
//    echo $totalcart;
//}
//else{
//    echo 'nodata';
//}
?>