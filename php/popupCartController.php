<?php 
// include'../DBconnection/database_connections.php';
// session_start();
// $data = json_decode(file_get_contents("php://input"));
// $sessionID = session_id();

// $arrTmpCartEvent = array();
// $arrSelectedTicket = array();



// $strTicketID = '';
// $strIncludeID = '';
// $strSeatID = '';
// $totalCartAmount = 0;
// $totalDiscount = 0;

// $EITC_arrya=array();
// $EITC_item_id="SELECT * FROM event_item_temp_cart ";
// $EITC_result = mysqli_query($con, $EITC_item_id);
// while ($EITC_resultObj = mysqli_fetch_object($EITC_result)) {
//      $EITC_arrya[] = $EITC_resultObj->EITC_item_id;
//        $strTicketID .=$EITC_resultObj->EITC_item_id.",";
//      }
//  $strTicketID = trim($strTicketID, ',');


// $arrayTotal=array();
// $totalCartAmount = 0;
// $sqlGetTmpCartItem = "SELECT EITC.*,IFNULL(EITC.EITC_total_price,0) AS etp, 
// E.event_id, 
// E.event_title, 
// E.event_web_banner, 
// ETC.ETC_event_id, 
// ETC.ETC_id 
// from event_item_temp_cart AS EITC 
// left join event_temp_cart AS ETC on EITC.EITC_session_id = ETC.ETC_session_id 
// left join events AS E on ETC.ETC_event_id = e.event_id 
// where ETC.ETC_session_id='$sessionID' AND EITC.EITC_session_id='$sessionID' ";
// $resultGetTmpCartItem = mysqli_query($con, $sqlGetTmpCartItem);
// if ($resultGetTmpCartItem) {
//     while ($resultGetTmpCartItemObj = mysqli_fetch_object($resultGetTmpCartItem)) {
//         $arrTmpCartEvent[] = $resultGetTmpCartItemObj;
//         $arrayTotal = $resultGetTmpCartItemObj->EITC_total_price." ";
//          //echo json_encode($arrTmpCartEvent);
//        // echo $arrayTotal;

//     }
// } else {
//     if (true) {
//         echo "resultGetTmpCartItem error: " . mysqli_error($con);
//     } else {
//         echo "resultGetTmpCartItem query failed.";
//     }
// }





// if ($strTicketID != "") {

//     $sqlGetSelectedTicket = "SELECT TT_type_title FROM event_ticket_types WHERE TT_id IN ($strTicketID)";
//     $resultGetSelectedTicket = mysqli_query($con, $sqlGetSelectedTicket);
//     if ($resultGetSelectedTicket) {
//         while ($resultGetSelectedTicketObj = mysqli_fetch_object($resultGetSelectedTicket)) {
//             $arrSelectedTicket[] = $resultGetSelectedTicketObj;
//             //echo json_encode($arrSelectedTicket);
//         }
//     } else {
//         if (true) {
//             echo "resultGetSelectedTicket error: " . mysqli_error($con);
//         } else {
//             echo "resultGetSelectedTicket query failed.";
//         }
//     }
// }




//     //echo "<pre>";
//    // echo var_dump($arrTmpCartEvent);
//     echo json_encode(array_merge($arrSelectedTicket,$arrTmpCartEvent));

?>

<?php

include'../DBconnection/database_connections.php';
session_start();
$data = json_decode(file_get_contents("php://input"));
$sessionID = session_id();
$totalEventCount = 0;
$arrTmpCartEvent = array();
$sqlGetTmpCartEvent = "SELECT event_id,event_title,event_web_logo,ETC_id FROM event_temp_cart "
        . "LEFT JOIN events ON event_id=ETC_event_id "
        . "WHERE ETC_session_id='$sessionID'";
$resultGetTmpCartEvent = mysqli_query($con, $sqlGetTmpCartEvent);
if ($resultGetTmpCartEvent) {
    while ($resultGetTmpCartEventObj = mysqli_fetch_object($resultGetTmpCartEvent)) {
        $arrTmpCartEvent[] = $resultGetTmpCartEventObj;
       // $totalEventCount = mysqli_num_rows($resultGetTmpCartEvent);
    }
} else {
    if (true) {
        echo "resultGetTmpCartEventObj error: " . mysqli_error($con);
    } else {
        echo "resultGetTmpCartEventObj query failed.";
    }
}




$arrTmpCartItem = array();
$strTicketID = '';
$strIncludeID = '';
$strSeatID = '';
$totalCartAmount = 0;
$totalDiscount = 0;
$sqlGetTmpCartItem = "SELECT * FROM  event_item_temp_cart "
        . "WHERE EITC_session_id='$sessionID'";
$resultGetTmpCartItem = mysqli_query($con, $sqlGetTmpCartItem);
if ($resultGetTmpCartItem) {
    while ($resultGetTmpCartItemObj = mysqli_fetch_object($resultGetTmpCartItem)) {
        $arrTmpCartItem[] = $resultGetTmpCartItemObj;
        
    }
} else {
    if (true) {
        echo "resultGetTmpCartItem error: " . mysqli_error($con);
    } else {
        echo "resultGetTmpCartItem query failed.";
    }
}






echo json_encode($arrTmpCartItem);





?>