<?php


include '../../DBconnection/auth.php';


// Including database connections start here
require_once '../../DBconnection/database_connections.php';

$data = json_decode(file_get_contents("php://input"));
$offlinePaymentMethod = $data->offlinePaymentMethod;
$pick_point = $data->pick_point;

$event_id = $data->e_id;
$today = date('Y-m-d');

    if($event_id != ''){
          foreach ($offlinePaymentMethod as $index => $value) {

            $check_name_ID_off = $value->off_check_name_ID;
            $check_namest_off = $value->off_check_namest;


            $sqlPaymentMethod = "INSERT INTO `eventwise_payment_method` SET event_id='$event_id', payment_method_id='$check_name_ID_off', date='$today', status='$check_namest_off'";

            $resultPaymentMethod = mysqli_query($con, $sqlPaymentMethod);
            if ($resultPaymentMethod == 1) {
                //echo 1;
            } else {
                //echo 2;
            }
        }

        foreach ($pick_point as $index => $value) {
            $point_name = $value->point_name;
            $point_address = $value->point_address;
            $point_contact_detail = $value->point_contact_detail;
            $sql = "INSERT INTO event_pick_point SET created_by='$login_user_id', event_id='$event_id', name='$point_name', date='$today', status='1', address='$point_address', point_details='$point_contact_detail'";
        
            $sqlResultpick_point = mysqli_query($con, $sql);
            if ($sqlResultpick_point == 1) {
                //echo 1;
            } else {
                //echo 2;
            }
        }
         echo 1;
    }else{
        echo 0;
    }
        
        
        
        