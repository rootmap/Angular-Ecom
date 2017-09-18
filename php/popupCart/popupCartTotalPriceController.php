<?php

include'../../DBconnection/database_connections.php';
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