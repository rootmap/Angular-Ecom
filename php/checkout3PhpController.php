<?php 
include'../DBconnection/database_connections.php';
 session_start();
@$data = json_decode(file_get_contents("php://input"));
@$ua_id=$data->UA_id;
@$ua_user_id=$data->UA_user_id;
@$address=$data->address;
@$city=$data->city;
@$zip=$data->zip;
@$country=$data->country;
@$phone=$data->phone;

$return_array = array();

// for custom event
$sessionID = session_id();

if ($ua_id > 0 ) {

        $sqlDefaultAdd = "SELECT * FROM `users` WHERE `user_id`='2'";
        $resultDefaultAdd = mysqli_query($con, $sqlDefaultAdd);

        if ($resultDefaultAdd) {
              $sqlUpdateDefaultShipping = "UPDATE user_addresses SET UA_address='$address', UA_city_id='$city', UA_country_id='$country', UA_phone='$phone', UA_zip='$zip'  WHERE UA_user_id=$ua_user_id";
              $resultUpdateDefaultShipping = mysqli_query($con, $sqlUpdateDefaultShipping);
            if ($resultUpdateDefaultShipping) {
                $return_array = array("output" => "success", "msg" => "Success!! Selected address is now your default delivery address.");
               print_r($return_array);
            }else {
                    
                    $err = "resultUpdateDefaultBilling query failed";
                    $return_array = array("output" => "success", "msg" => $err);
                    print_r($return_array);
                }

        }else{
                $sqlUpdateDefaultShippingID="UPDATE users SET user_default_shipping='$ua_id' WHERE user_id=$ua_user_id";
                $run=mysqli_query($con,$sqlUpdateDefaultShippingID);
                    if ($run) {
                      $return_array = array("output" => "success", "msg" => "Success!! Shipping id updated.");
                      print_r($return_array);
                    }else{
                        $return_array = array("output" => "error", "msg" => "Error!! Query Fail.");
                        print_r($return_array);
                    }

        }

        
    } 
 
           // if ($ua_id >0) {
           //        $sqlUpdateDefaultShippingID="UPDATE users SET user_default_shipping='$ua_id' WHERE user_id=$ua_user_id";
           //      $run=mysqli_query($con,$sqlUpdateDefaultShippingID);
           //          if ($run) {
           //            $return_array = array("output" => "success", "msg" => "Success!! Shipping id updated.");
           //            print_r($return_array);
           //          }else{
           //              $return_array = array("output" => "error", "msg" => "Error!! Query Fail.");
           //              print_r($return_array);
           //          }

           //      }     


$eventID = 0;
$sqlGetEventID = "SELECT ETC_event_id FROM event_temp_cart WHERE ETC_session_id = '$sessionID' ORDER BY ETC_event_id DESC LIMIT 1";
$resultGetEventID = mysqli_query($con, $sqlGetEventID);
$countRow = mysqli_num_rows($resultGetEventID);
if ($countRow == 1) {
    while ($resultGetEventIDObj = mysqli_fetch_object($resultGetEventID)) {
        $eventID = $resultGetEventIDObj->ETC_event_id;
    }
} //else {
//     $link = baseUrl() . 'home';
//     redirect($link);
// }



// Get All Shipping and billing method
$shipBillMArray = array();
$shipBillMSql = "SELECT 
events.event_id, 
events.event_is_home_delivery, 
events.event_is_pickable_from_office, 
events.event_is_pickable, 
events.event_status, 
event_venues.venue_geo_location 
FROM events 
LEFT JOIN event_venues ON events.event_id=event_venues.venue_event_id 
WHERE events.event_id='".$eventID ."' AND events.event_status='active' order by event_id DESC LIMIT 1 ";
$resultShipBillM = mysqli_query($con, $shipBillMSql);
if ($resultShipBillM) {
    while ($rowShipBillM = mysqli_fetch_object($resultShipBillM)) {
        $shipBillMArray[] = $rowShipBillM;
    }
} else {
    if (true) {
        $err = "resultShipBillM error: " . mysqli_error($con);
    } else {
        $err = "resultShipBillM query failed";
    }
}


// Get All Event Ticket Pick-point Lists data
$pickPointArray = array();
$pickPointSql = "SELECT
                ev.event_id,
                ev.event_is_pickable,
                ev.event_is_pickable_type,
                ev.event_pick_details AS single_pick_point,
                epp.id AS pick_point_id,
                IFNULL(epp.name,'none') AS multiple_pick_points
                FROM events AS ev
                LEFT JOIN event_pick_point AS epp ON ev.event_id = epp.event_id
                WHERE ev.event_id='" . $eventID . "'
                AND ev.event_status='active'";
$resultPickPoint = mysqli_query($con, $pickPointSql);
if ($resultPickPoint) {
    while ($rowPickPoint = mysqli_fetch_object($resultPickPoint)) {
        $pickPointArray[] = $rowPickPoint;
    }
} else {
    if (DEBUG) {
        $err = "resultPickPoint error: " . mysqli_error($con);
    } else {
        $err = "resultPickPoint query failed";
    }
}

// echo "<pre>";
// var_dump($shipBillMArray);

echo json_encode($shipBillMArray);


?>
<?php 
// include'../DBconnection/database_connections.php';
//  session_start();
// @$data = json_decode(file_get_contents("php://input"));
// @$ua_id=$data->UA_id;
// @$ua_user_id=$data->UA_user_id;

// // for custom event
// $sessionID = session_id();
// $eventID = 0;
// $sqlGetEventID = "SELECT ETC_event_id FROM event_temp_cart WHERE ETC_session_id = '$sessionID' ORDER BY ETC_event_id DESC LIMIT 1";
// $resultGetEventID = mysqli_query($con, $sqlGetEventID);
// $countRow = mysqli_num_rows($resultGetEventID);
// if ($countRow == 1) {
//     while ($resultGetEventIDObj = mysqli_fetch_object($resultGetEventID)) {
//         $eventID = $resultGetEventIDObj->ETC_event_id;
//     }
// } //else {
// //     $link = baseUrl() . 'home';
// //     redirect($link);
// // }



// // Get All Shipping and billing method
// $shipBillMArray = array();
// $shipBillMSql = "SELECT
//                 event_id,
//                 event_is_home_delivery,
//                 event_is_pickable_from_office,
//                 event_is_pickable,
//                 event_status
//                 FROM events
//                 WHERE event_id='" . $eventID . "'
//                 AND event_status='active'";
// $resultShipBillM = mysqli_query($con, $shipBillMSql);
// if ($resultShipBillM) {
//     while ($rowShipBillM = mysqli_fetch_object($resultShipBillM)) {
//         $shipBillMArray[] = $rowShipBillM;
//     }
// } else {
//     if (true) {
//         $err = "resultShipBillM error: " . mysqli_error($con);
//     } else {
//         $err = "resultShipBillM query failed";
//     }
// }


// // Get All Event Ticket Pick-point Lists data
// $pickPointArray = array();
// $pickPointSql = "SELECT
//                 ev.event_id,
//                 ev.event_is_pickable,
//                 ev.event_is_pickable_type,
//                 ev.event_pick_details AS single_pick_point,
//                 epp.id AS pick_point_id,
//                 IFNULL(epp.name,'none') AS multiple_pick_points
//                 FROM events AS ev
//                 LEFT JOIN event_pick_point AS epp ON ev.event_id = epp.event_id
//                 WHERE ev.event_id='" . $eventID . "'
//                 AND ev.event_status='active'";
// $resultPickPoint = mysqli_query($con, $pickPointSql);
// if ($resultPickPoint) {
//     while ($rowPickPoint = mysqli_fetch_object($resultPickPoint)) {
//         $pickPointArray[] = $rowPickPoint;
//     }
// } else {
//     if (DEBUG) {
//         $err = "resultPickPoint error: " . mysqli_error($con);
//     } else {
//         $err = "resultPickPoint query failed";
//     }
// }

// // echo "<pre>";
// // var_dump($shipBillMArray);



?>