<?php

include '../../DBconnection/auth.php';
//START HERE 
//session_start();
$sessionId = session_id();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Including database connections start here
require_once '../../DBconnection/database_connections.php';
// Including database connections end here



$data = json_decode(file_get_contents("php://input"));
//function MakePassword($pass) {
//       $bytes=044;
//       $salt=base64_encode($bytes);
//       $hash=hash('sha512', $salt . $pass);
//       return md5($hash);
//   }

//$password = MakePassword('TC123456');
$eventTitle = $data->eventTitle;
$vanueTitle = $data->vanueTitle;
$TCT = $data->TCT;
$ticketQuantity = $data->ticketQuantity;
$totlaAmount = ($TCT * $ticketQuantity);
$customerFirstName = $data->customerFirstName;
$customerLastName = $data->customerLastName;
$customerPhone = $data->customerPhone;
$customerEmail = $data->customerEmail;
$hmDelivery = $data->hmDelivery;


 $orderschk = "SELECT order_id,order_session_id FROM orders WHERE order_session_id='$sessionId'";
   $orderschkresult = mysqli_query($con, $orderschk);
                    $row = mysqli_fetch_array($orderschkresult);
                    $orderEx= $row['order_session_id'];
                    if(!empty($orderEx)){
                         $array_return = array("status" => 8);
                         echo json_encode($array_return);
                         
                         exit();
                    }
                    
//order
//print_r($_POST); //(all data show of console)
//echo $TicketName$;(single data show of console)

//$sqluser = mysqli_query($con, "SELECT user_id FROM `users` WHERE user_email='$customerEmail'");
//$chkuser = mysqli_num_rows($sqluser);
//if ($chkuser == 0) {
//
//    $sql = "INSERT INTO users SET  user_first_name='$customerFirstName',user_last_name='$customerLastName', user_email='$customerEmail',user_password='$password',user_phone='$customerPhone',user_delivery_address='$hmDelivery'";
//
//    $result = mysqli_query($con, $sql);
////INSERT FUNCTION END HERE
//    $sqluser = mysqli_query($con, "SELECT user_id FROM `users` WHERE user_email='$customerEmail' ORDER BY user_id DESC LIMIT 1");
//    //USER ID SHOW HERE
//    $row = mysqli_fetch_array($sqluser);
//    $user_id = $row['user_id'];
//    $sql = "INSERT INTO  temp_billing SET user_name='$customerFirstName', user_email='$customerEmail',user_phone='$customerPhone', user_id='$user_id',order_id='$sessionId'";
//    $result = mysqli_query($con, $sql);
////USER ID SHOW END  HERE
//} else {
    $sql = "INSERT INTO  temp_billing SET user_name='$customerFirstName', user_email='$customerEmail', user_phone='$customerPhone', user_id='10',order_id='$sessionId'";
    $result = mysqli_query($con, $sql);
//USER ID SHOW HERE
    //$row = mysqli_fetch_array($sqluser);
    $user_id =10;
//USER ID SHOW END  HERE
//}
$orderAll = "SELECT count(`order_total_item`) as total_order FROM `orders`";
$ordercount = mysqli_query($con, $orderAll);
$row = mysqli_fetch_array($ordercount);
$totalOrder = $row['total_order'];
$ordercreated = date('Y-m-d H:i:s');
//ORDER SELECT FUNCTION START HERE
$loid = 0;
$sqllastorderid = mysqli_query($con, "SELECT MAX(`order_id`) as lastoid FROM `orders`");
$chklastoid = mysqli_num_rows($sqllastorderid);
if ($chklastoid == 0) {
    $loid = 1;
} else {
    $foid = mysqli_fetch_array($sqllastorderid);
    $loid = $foid['lastoid'] + 1;
}

$ordersId = mysqli_query($con, "SELECT `order_id` FROM `orders` WHERE `order_session_id`='$sessionId'");
$ordersIdresult = mysqli_num_rows($ordersId);
if ($ordersIdresult == 0) {

//ORDER INSERT FUNCTION START  HERE
    $orderSql = "INSERT INTO  orders SET order_user_id='$user_id',order_created='$ordercreated',order_read='no',order_number='[" . date('dmy') . "]-" . $loid . "',order_status='booking',order_payment_type='Card',order_method='delivery',order_total_item='$ticketQuantity',order_total_amount='$totlaAmount',order_session_id='$sessionId'";
    $orderSqlresult = mysqli_query($con, $orderSql);

    $ordersId = "SELECT `order_id` FROM `orders` WHERE `order_session_id`='$sessionId'";
    $ordersIdresult = mysqli_query($con, $ordersId);
    $row = mysqli_fetch_array($ordersIdresult);
    $order_id = $row['order_id'];

//ORDER INSERT FUNCTION END HERE
} else {

    session_regenerate_id();
    $sessionId = session_id();
    //ORDER INSERT FUNCTION START  HERE
    $orderSql = "INSERT INTO  orders SET order_user_id='$user_id',order_created='$ordercreated',order_read='no',order_number='[" . date('dmy') . "]-" . $loid . "',order_status='booking',order_payment_type='Card',order_method='delivery',order_total_item='$ticketQuantity',order_total_amount='$totlaAmount',order_session_id='$sessionId'";
    $orderSqlresult = mysqli_query($con, $orderSql);

//ORDER INSERT FUNCTION END HERE
    $ordersId = "SELECT `order_id` FROM `orders` WHERE `order_session_id`='$sessionId'";
    $ordersIdresult = mysqli_query($con, $ordersId);
    $row = mysqli_fetch_array($ordersIdresult);
    $order_id = $row['order_id'];
}
//ORDER SELECT FUNCTION END HERE
//ORDER INSERT FUNCTION START  HERE

$sqlQuerry = "INSERT INTO  order_events SET OE_order_id='$order_id ',OE_event_id='$eventTitle',OE_session_id='$sessionId',OE_user_id='$user_id'";
$orderSqlQuerry = mysqli_query($con, $sqlQuerry);
//ORDER INSERT FUNCTION END HERE

$array_return = array("order_id" =>$sessionId, "order_user_id" => $user_id);

echo json_encode($array_return);
exit();
//$orderquery="INSERT INTO `ticketchai-ori`.`orders` (`order_id`, `order_user_id`, `order_created`, `order_number`, `order_read`, `order_status`, `order_payment_type`, `order_method`, `order_delivery_start_datetime`, `order_delivery_end_datetime`, `order_is_express`, `order_total_item`, `order_total_amount`, `order_vat_amount`, `order_discount_amount`, `order_promotion_codes`, `order_promotion_discount_amount`, `order_shipment_charge`, `order_session_id`, `order_note`, `order_billing_first_name`, `order_billing_middle_name`, `order_billing_last_name`, `order_billing_phone`, `order_billing_best_call_time`, `order_billing_address`, `order_billing_country`, `order_billing_city`, `order_billing_area`, `order_billing_zip`, `order_shipping_first_name`, `order_shipping_middle_name`, `order_shipping_last_name`, `order_shipping_phone`, `order_shipping_best_call_time`, `order_shipping_address`, `order_shipping_country`, `order_shipping_city`, `order_shipping_area`, `order_shipping_zip`, `order_updated_on`, `order_updated_by`) VALUES (NULL, '12', '2016-11-22 00:00:00', '', 'no', 'booking', 'Card', 'pickup', '2016-11-22 00:00:00', '2016-11-22 00:00:00', 'no', '1', '100', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', CURRENT_TIMESTAMP, '');";
////$sqlorder=  mysqli_query($con, $orderquery);