<?php
include '../DBconnection/auth.php';
include'../DBconnection/database_connections.php';
$data = json_decode(file_get_contents("php://input"));
session_start();
// for custom event
$sessionID = session_id();
// $eventID = 0;
// $sqlGetEventID = "SELECT ETC_event_id FROM event_temp_cart WHERE ETC_session_id = '$sessionID' ORDER BY ETC_event_id DESC LIMIT 1";
// $resultGetEventID = mysqli_query($con, $sqlGetEventID);
// $countRow = mysqli_num_rows($resultGetEventID);
// if ($countRow == 1) {
//     while ($resultGetEventIDObj = mysqli_fetch_object($resultGetEventID)) {
//         $eventID = $resultGetEventIDObj->ETC_event_id;
//     }
//  }else {
//     $link = baseUrl() . 'home';
//     redirect($link);
// }

// for custom event

$userID =$login_user_id;
$shipping = 0;
$billing = 0;

$UA_billing_first_name = "";
$UA_billing_last_name = "";
$UA_billing_phone = "";
$UA_billing_title = "";
$UA_billing_address = "";
$UA_billing_zip = "";
$UA_billing_country_id = "";
$UA_billing_city_id = "";
$UA_billing_user_id = "";
$UA_shipping_first_name = "";
$UA_shipping_last_name = "";
$UA_shipping_phone = "";
//$UA_shipping_title = "";
$UA_shipping_address = "";
$UA_shipping_zip = "";
$UA_shipping_country_id = "";
$UA_shipping_city_id = "";
$UA_shipping_user_id = "";
$deliveryCharge = 0;
$defaultShipping = 0;
$defaultBilling = 0;
$chkFlag = 0;
$sameAsBilling = '';
$UA_city_id_shipping = 0;
$method = "";


// if (checkUserLogin()) {
//     $userID = getSession('user_id');
// } else {
//     $link = baseUrl() . 'checkout';
//     redirect($link);
// }


//get default address from user table
$sqlDefaultAdd = "SELECT user_default_shipping,user_default_billing,UA_city_id 
FROM users 
LEFT JOIN user_addresses ON UA_id=user_default_shipping 
WHERE user_id='$userID'";
$resultDefaultAdd = mysqli_query($con, $sqlDefaultAdd);
if ($resultDefaultAdd) {
    $resultDefaultAddObj = mysqli_fetch_object($resultDefaultAdd);
    if (isset($resultDefaultAddObj->user_default_shipping)) {
        $defaultShipping = $resultDefaultAddObj->user_default_shipping;
        $defaultBilling = $resultDefaultAddObj->user_default_billing;

    }
} else {
        $err = "getDefaultAdd error: " . mysqli_error($con);
        $err = "getDefaultAdd query failed";
}

  $arrUserAddress = array();
if ($defaultShipping > 0 AND $defaultBilling > 0) {
  
    if ($userID > 0) {
        $sqlGetAddress = "SELECT user_addresses.*, cities.city_name,countries.country_name"
                . " FROM user_addresses"
                . " LEFT JOIN cities ON user_addresses.UA_city_id = cities.city_id"
                . " LEFT JOIN countries ON user_addresses.UA_country_id = countries.country_id"
                . " WHERE UA_id IN ($defaultShipping,$defaultBilling)";
        $resultGetAddress = mysqli_query($con, $sqlGetAddress);
        if ($resultGetAddress) {
            while ($resultGetAddressObj = mysqli_fetch_object($resultGetAddress)) {
                $arrUserAddress[] = $resultGetAddressObj;
            }
        } else {
            if (true) {
                echo "resultGetAddress success1: " . mysqli_error($con);
            } else {
                echo "resultGetAddress query failed.";
            }
        }
    }


}else{
    $sqlGetAddress = "SELECT user_addresses.*, cities.city_name,countries.country_name"
                . " FROM user_addresses"
                . " LEFT JOIN cities ON user_addresses.UA_city_id = cities.city_id"
                . " LEFT JOIN countries ON user_addresses.UA_country_id = countries.country_id"
                . " WHERE UA_id IN ($defaultShipping,$defaultBilling)";
        $resultGetAddress = mysqli_query($con, $sqlGetAddress);
        if ($resultGetAddress) {
            while ($resultGetAddressObj = mysqli_fetch_object($resultGetAddress)) {
                $arrUserAddress[] = $resultGetAddressObj;
            }
        } else {
            if (true) {
                echo "resultGetAddress success2: " . mysqli_error($con);
            } else {
                echo "resultGetAddress query failed.";
            }
        }
    }




//echo "<pre>";
//var_dump($arrUserAddress);
echo json_encode($arrUserAddress);
// Get All Countries For User Address

// $countryArray = array();
// $countrySql = "SELECT * FROM countries WHERE country_status = 'allow'";
// $resultCountry = mysqli_query($con, $countrySql);
// if ($resultCountry) {
//     while ($rowCountry = mysqli_fetch_object($resultCountry)) {
//         $countryArray[] = $rowCountry;
//     }
// } else {
//     if (ttrue) {
//         $err = "resultCountry error: " . mysqli_error($con);
//     } else {
//         $err = "resultCountry query failed";
//     }
// }

// // Get All Cities For User Address
// $cityArray = array();
// $citySql = "SELECT * FROM cities WHERE city_status = 'allow'";
// $resultCity = mysqli_query($con, $citySql);
// if ($resultCity) {
//     while ($rowCity = mysqli_fetch_object($resultCity)) {
//         $cityArray[] = $rowCity;
//     }
// } else {
//     if (ttrue) {
//         $err = "resultCity error: " . mysqli_error($con);
//     } else {
//         $err = "resultCity query failed";
//     }
// }


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
//     if (ttrue) {
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
//     if (ttrue) {
//         $err = "resultPickPoint error: " . mysqli_error($con);
//     } else {
//         $err = "resultPickPoint query failed";
//     }
// }

//ttrue($arrUserAddress);



?>
