<?php

session_start();
if (isset($_SESSION['USER_DASHBOARD_USER_ID']) || trim($_SESSION['USER_DASHBOARD_USER_ID'])) {
    $login_user_id = $_SESSION['USER_DASHBOARD_USER_ID'];
}



include'../DBconnection/database_connections.php';


$data = json_decode(file_get_contents("php://input"));

$sessionId = session_id();



$orderschk = "SELECT order_id,order_session_id FROM orders WHERE order_session_id='$sessionId'";
$orderschkresult = mysqli_query($con, $orderschk);
$row = mysqli_fetch_array($orderschkresult);
$orderEx = $row['order_session_id'];
if (!empty($orderEx)) {
    $array_return = array("status" => 8);
    echo json_encode($array_return);

    exit();
}


$ticketdata = $data->ticket;
//print_r($ticketdata);
$includedata = $data->include;
//print_r($includedata);
$freetdata = $data->free;
//print_r($freetdata);
$payment_type ='Free';


$eventId = $data->e_id;
//@$ticketType = $data->ticketIncludeId;




$customerEmail ;
$customerFirstName;
$customerPhone ;

$customerInfo = $data->customerInfo;


   $customerFirstName= $customerInfo[0]->name;
   $customerEmail= $customerInfo[0]->email;
   $customerPhone= $customerInfo[0]->phone;

//exit();

$ordercreated = date('Y-m-d H:i:s');

/* $tck_total_p=$data->tck_total_p;
  $tck_qnty =$data->tck_qnty;
  $tck_q =$data->tck_q;
  $tck_inc_qnty=$data->tck_inc_qnty; */

//$ticketQuantity_tic = $data->tck_q;
$ticketQuantity_tic = 0;
$ticketTotalAmount_tic = 0;
//$ticketQuantity_inc = $data->tck_inc_qnty;
$ticketQuantity_inc = 0;
$ticketTotalAmount_inc = 0;
//$totalquantity =$data->tck_qnty;
//$totalAmount =$data->tck_total_p;
$totalquantity = 0;
$totalAmount = 0;
$o_user_id = '';

if (!empty($ticketdata)) {

    if (!empty($customerInfo)) {

        foreach ($ticketdata as $index => $ticket) {

            $ticketQuantity_tic +=$ticket->quantity;
            //echo $ticket->quantity;
            $ticketTotalAmount_tic +=$ticketdata[$index]->price * $ticketdata[$index]->quantity; // or try this $ticketTotalAmount_tic += $ticket->price * $ticketQuantity_tic;
        }
        foreach ($includedata as $index => $ticket) {
            // $ticketQuantity_inc += $includedata[$index]->quantity;
            $ticketQuantity_inc += $includedata->quantity;
            //$ticketTotalAmount_inc += $includedata[$index]->price;
            $ticketTotalAmount_inc += $includedata[$index]->price * $includedata[$index]->quantity;
        }
        foreach ($freetdata as $index => $ticket) {
            $ticketQuantity_free += $freetdata[$index]->quantity;

            //$ticketTotalAmount_free += $freetdata[$index]->price * $freetdata[$index]->quantity;
        }


        //$totalquantity = $ticketQuantity_tic+ $ticketQuantity_inc;
        $totalquantity = $ticketQuantity_tic + $ticketQuantity_free;
        $totalAmount = $ticketTotalAmount_tic + $ticketTotalAmount_inc;


        if (!empty($totalquantity)) {
            if (!empty($ticketQuantity_free)) {

                if (!empty($login_user_id)) {

                    $sqluser = mysqli_query($con, "SELECT user_id FROM users WHERE user_email='$customerEmail' ORDER BY user_id DESC LIMIT 1");
                    $row = mysqli_fetch_array($sqluser);
                    //print_r($row);
                    $user_id = $row['user_id'];
                    $sql = "INSERT INTO  temp_billing SET user_name='$customerFirstName', user_email='$customerEmail',user_phone='$customerPhone', user_id='$user_id',order_id='$sessionId'";
                    $result = mysqli_query($con, $sql);
                    //USER ID SHOW END  HERE
                    //  }
                } else {
                    $sql = "INSERT INTO  temp_billing SET user_name='$customerFirstName', user_email='$customerEmail', user_phone='$customerPhone', user_id='10',order_id='$sessionId'";
                    $result = mysqli_query($con, $sql);

                    $user_id = 10;
                }


                if (!empty($customerInfo)) {
                    $count = count($customerInfo);
                    $s = 0;
                    foreach ($customerInfo as $index => $val) {
                        if ($count != $s) {
                            foreach ($val as $index1 => $val1) {

                                //print_r($val);
                                $fid = $index1;
                                $sqlgetfieldid = mysqli_query($con, "SELECT form_id FROM event_dynamic_forms WHERE form_field_name='$fid' AND form_event_id='$eventId'");
                                $fetchgetfieldid = mysqli_fetch_array($sqlgetfieldid);
                                $field_id = $fetchgetfieldid['form_id'];
                                mysqli_query($con, "INSERT INTO event_form_values SET EFV_event_id='$eventId',EFV_session_id='$sessionId',EFV_user_id='$user_id',EFV_field_id='$field_id',EFV_field_value='$val1'");
                            }
                        }
                        $s++;
                        //print_r($val1);
                    }
                }


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
                    //echo 'o-if';
                    if ($payment_type == 'Bkash Payment') {
                        $orderSql = "INSERT INTO  orders SET order_user_id='$user_id',order_created='$ordercreated',order_read='no',order_number='[" . date('dmy') . "]-" . $loid . "',order_status='booking',order_payment_type='Bkash',order_method='delivery',order_total_item='$totalquantity',order_total_amount='$totalAmount',order_session_id='$sessionId',order_shipment_charge='$deliveryCost'";
                        $orderSqlresult = mysqli_query($con, $orderSql);
                    } elseif ($payment_type == 'Online Payment') {
                        $orderSql = "INSERT INTO  orders SET order_user_id='$user_id',order_created='$ordercreated',order_read='no',order_number='[" . date('dmy') . "]-" . $loid . "',order_status='booking',order_payment_type='online',order_method='delivery',order_total_item='$totalquantity',order_total_amount='$totalAmount',order_session_id='$sessionId',order_shipment_charge='$deliveryCost'";
                        $orderSqlresult = mysqli_query($con, $orderSql);
                    } elseif ($payment_type == 'Pay Online & Get E-Ticket on Your E-Mail') {
                        $orderSql = "INSERT INTO  orders SET order_user_id='$user_id',order_created='$ordercreated',order_read='no',order_number='[" . date('dmy') . "]-" . $loid . "',order_status='booking',order_payment_type='eticket',order_method='delivery',order_total_item='$totalquantity',order_total_amount='$totalAmount',order_session_id='$sessionId',order_shipment_charge='$deliveryCost'";
                        $orderSqlresult = mysqli_query($con, $orderSql);
                    } else {
                        $orderSql = "INSERT INTO  orders SET order_user_id='$user_id',order_created='$ordercreated',order_read='no',order_number='[" . date('dmy') . "]-" . $loid . "',order_status='booking',order_payment_type='card',order_method='delivery',order_total_item='$totalquantity',order_total_amount='$totalAmount',order_session_id='$sessionId',order_shipment_charge='$deliveryCost'";
                        $orderSqlresult = mysqli_query($con, $orderSql);
                    }


                    $ordersId = "SELECT order_id,order_user_id FROM orders WHERE order_session_id='$sessionId' ORDER BY `order_created` DESC LIMIT 1";
                    $ordersIdresult = mysqli_query($con, $ordersId);
                    $row = mysqli_fetch_array($ordersIdresult);
                    $order_id = $row['order_id'];
                    $o_user_id.= $row['order_user_id'];
                    //ORDER INSERT FUNCTION END HERE
                } else {

                    // echo 'o-else';
                    session_regenerate_id($sessionId);
                    $sessionId = session_id();
                    //ORDER INSERT FUNCTION START  HERE
//                    $orderSql = "INSERT INTO  orders SET order_user_id='$user_id',order_created='$ordercreated',order_read='no',order_number='[" . date('dmy') . "]-" . $loid . "',order_status='pendding',order_payment_type='$payment_type',order_method='delivery',order_total_item='$totalquantity',order_total_amount='$totalAmount',order_session_id='$sessionId'";
//                    $orderSqlresult = mysqli_query($con, $orderSql);
                    if ($payment_type == 'Bkash Payment') {
                        $orderSql = "INSERT INTO  orders SET order_user_id='$user_id',order_created='$ordercreated',order_read='no',order_number='[" . date('dmy') . "]-" . $loid . "',order_status='booking',order_payment_type='Bkash',order_method='delivery',order_total_item='$totalquantity',order_total_amount='$totalAmount',order_session_id='$sessionId',order_shipment_charge='$deliveryCost'";
                        $orderSqlresult = mysqli_query($con, $orderSql);
                    } elseif ($payment_type == 'Online Payment') {
                        $orderSql = "INSERT INTO  orders SET order_user_id='$user_id',order_created='$ordercreated',order_read='no',order_number='[" . date('dmy') . "]-" . $loid . "',order_status='booking',order_payment_type='online',order_method='delivery',order_total_item='$totalquantity',order_total_amount='$totalAmount',order_session_id='$sessionId',order_shipment_charge='$deliveryCost'";
                        $orderSqlresult = mysqli_query($con, $orderSql);
                    } elseif ($payment_type == 'Pay Online & Get E-Ticket on Your E-Mail') {
                        $orderSql = "INSERT INTO  orders SET order_user_id='$user_id',order_created='$ordercreated',order_read='no',order_number='[" . date('dmy') . "]-" . $loid . "',order_status='booking',order_payment_type='eticket',order_method='delivery',order_total_item='$totalquantity',order_total_amount='$totalAmount',order_session_id='$sessionId',order_shipment_charge='$deliveryCost'";
                        $orderSqlresult = mysqli_query($con, $orderSql);
                    } else {
                        $orderSql = "INSERT INTO  orders SET order_user_id='$user_id',order_created='$ordercreated',order_read='no',order_number='[" . date('dmy') . "]-" . $loid . "',order_status='booking',order_payment_type='card',order_method='delivery',order_total_item='$totalquantity',order_total_amount='$totalAmount',order_session_id='$sessionId',order_shipment_charge='$deliveryCost'";
                        $orderSqlresult = mysqli_query($con, $orderSql);
                    }
                    //ORDER INSERT FUNCTION END HERE
                    $ordersId = "SELECT order_id,order_user_id FROM orders WHERE order_session_id='$sessionId' ORDER BY `order_created` DESC LIMIT 1";

                    $ordersIdresult = mysqli_query($con, $ordersId);
                    $row = mysqli_fetch_array($ordersIdresult);

                    $order_id = $row['order_id'];
                    $o_user_id.= $row['order_user_id'];
                }


                //ORDER SELECT FUNCTION END HERE
                //ORDER INSERT FUNCTION START  HERE
                $sqlQuerry = "INSERT INTO  order_events SET OE_order_id='$order_id ',OE_event_id='$eventId',OE_session_id='$sessionId',OE_user_id='$user_id'";
                $orderSqlQuerry = mysqli_query($con, $sqlQuerry);
                //echo 1;

                $array_return = array("total_amount" => base64_encode($totalAmount), "order_id" => base64_encode($sessionId), "order_user_id" => $o_user_id, "status" => 1);




//ORDER INSERT FUNCTION END HERE 
                $ticketUnitPrice = 0;
                foreach ($ticketdata as $index => $ticket) {

                    $ticketQuantity = $ticket->quantity;
                    //$ticketQuantity = $data->tck_q;
                    $ticketUnitPrice = $ticket->price;
                    $ticket_id = $ticket->ticket_id;

                    $unique_id = $sessionId . "$ordercreated";

                    if ($ticketUnitPrice == 0) {
                        $sql_OI = "INSERT INTO order_items SET OI_OE_id='$eventId', OI_order_id='$order_id', OI_item_id='$ticket_id', OI_session_id='$sessionId', OI_unique_id='$unique_id' ,OI_item_type='free',OI_quantity='$ticketQuantity', OI_unit_price='$ticketUnitPrice',OI_created_on='$ordercreated',OI_is_verified='no' ";
                        $orderItemSqlQuerry = mysqli_query($con, $sql_OI);
                    } else {
                        $sql_OI = "INSERT INTO order_items SET OI_OE_id='$eventId', OI_order_id='$order_id', OI_item_id='$ticket_id', OI_session_id='$sessionId', OI_unique_id='$unique_id' ,OI_item_type='ticket',OI_quantity='$ticketQuantity', OI_unit_price='$ticketUnitPrice',OI_created_on='$ordercreated',OI_is_verified='no' ";
                        $orderItemSqlQuerry = mysqli_query($con, $sql_OI);
                    }
                }
                if ($ticketUnitPrice == 0) {
                    if ($ticketType == '3') {
                        foreach ($includedata as $index => $ticket) {

                            $unique_id = $sessionId . "$ordercreated";

                            $ticketQuantity_inc = $ticket->quantity;
                            //$ticketQuantity_inc = $data->tck_inc_qnty;
                            $ticketUntiPrice_inc = $ticket->price;
                            $ticket_id_inc = $ticket->ticket_id;


                            $sql_OI = $sql_OI = "INSERT INTO order_items SET OI_OE_id='$eventId', OI_order_id='$order_id', OI_item_id='$ticket_id_inc', OI_session_id='$sessionId', OI_unique_id='$unique_id' ,OI_item_type='free & paid',OI_quantity='$ticketQuantity_inc', OI_unit_price='$ticketUntiPrice_inc',OI_created_on='$ordercreated',OI_is_verified='no' ";
                            $orderItemSqlQuerry = mysqli_query($con, $sql_OI);
                        }
                    }
                } else {
                    if ($ticketType == '3') {
                        foreach ($includedata as $index => $ticket) {

                            $unique_id = $sessionId . "$ordercreated";
                            $ticketQuantity_inc = $ticket->quantity;
                            //$ticketQuantity_inc = $data->tck_inc_qnty;
                            $ticketUntiPrice_inc = $ticket->price;
                            $ticket_id_inc = $ticket->ticket_id;


                            $sql_OI = $sql_OI = "INSERT INTO order_items SET OI_OE_id='$eventId', OI_order_id='$order_id', OI_item_id='$ticket_id_inc', OI_session_id='$sessionId', OI_unique_id='$unique_id' ,OI_item_type='include',OI_quantity='$ticketQuantity_inc', OI_unit_price='$ticketUntiPrice_inc',OI_created_on='$ordercreated',OI_is_verified='no' ";
                            $orderItemSqlQuerry = mysqli_query($con, $sql_OI);
                        }
                    }
                }
                if (empty($chkuser)) {
                    // echo 'if ';
                    $result = mysqli_query($con, "SELECT 
					users.user_id,
					users.user_email,
					users.user_first_name,
					users.user_images, 
					users.user_status
					FROM users WHERE `user_id`='$user_id'");

                    $row = mysqli_fetch_array($result);
                    //print_r($row);
                    // exit();
                    $user_id = $row['user_id'];
                    $user_mail = $row['user_email'];
                    $user_name = $row['user_first_name'];
                    $user_img = $row['user_images'];
                    $user_status = $row['user_status'];
                    if ($user_status == 'active' && $chkuser == 0) {
                        session_regenerate_id();
                        $_SESSION['USER_DASHBOARD_USER_ID'] = $user_id;
                        $_SESSION['USER_DASHBOARD_USER_FULLNAME'] = $user_name;
                        $_SESSION['USER_DASHBOARD_USER_IMG'] = $user_img;
                        $_SESSION['USER_DASHBOARD_USER_STATUS'] = $user_status;
                        session_write_close();
                        session_regenerate_id($sessionId);
                    }
                }
            } else {
                $array_return = array("status" => 4);
            }
        } else {
            $array_return = array("status" => 3);
        }
    } else {
        $array_return = array("status" => 2);
    }
} else {
    $array_return = array("status" => 0);
}


echo json_encode($array_return);
?>