<?php

//include'../DBconnection/auth.php';
include'../DBconnection/database_connections.php';
session_start();

$data = json_decode(file_get_contents("php://input"));
$type = $data->type;
$itemID = $data->itemID;
$eventID = $data->eventID;

$venueID = $data->venueID;
$quantity = $data->quantity;
$countRecord = 0;
$countItems = 0;
@$userID = $_SESSION['USER_DASHBOARD_USER_ID'];
//$userID =1;
$ETC_id = 0;
$sessionID = session_id();


$error_return = array();
$return_array = array();


$checkStatus = 0;


if (!empty($itemID) AND ! empty($type) AND ! empty($quantity) AND ! empty($eventID)) {
//checking if event already saved in temp cart

    $sqlSearchEvent = "SELECT ETC_id FROM event_temp_cart WHERE ETC_event_id=$eventID AND ETC_session_id='$sessionID'";
    $resultSearchEvent = mysqli_query($con, $sqlSearchEvent);
    if ($resultSearchEvent) {
         $countRecord = mysqli_num_rows($resultSearchEvent);

        if ($countRecord == 0) { //event not saved in temp cart
            $insertEventTmpCart = '';
            $insertEventTmpCart .=' ETC_event_id = "' . $eventID . '"';
            $insertEventTmpCart .=', ETC_session_id = "' . mysqli_real_escape_string($con, $sessionID) . '"';
            $insertEventTmpCart .=', ETC_user_id = "' . $userID . '"';

            $sqlInsertEventTmpCart = "INSERT INTO event_temp_cart SET $insertEventTmpCart";
            $resultInsertEventTmpCart = mysqli_query($con, $sqlInsertEventTmpCart);

            if ($resultInsertEventTmpCart) {
                $ETC_id = mysqli_insert_id($con);
            } else {
                $checkStatus++;
                if (true) {
                    $return_array = array("output" => "error", "msg" => "resultInsertEventTmpCart error: " . mysqli_error($con));
                    echo json_encode($return_array);
                    exit();
                } else {
                    $return_array = array("output" => "error", "msg" => "resultInsertEventTmpCart query failed.");
                    echo json_encode($return_array);
                    exit();
                }
            }
        } else { //event already exist in temp cart
            $resultSearchEventObj = mysqli_fetch_object($resultSearchEvent);
            if (isset($resultSearchEventObj->ETC_id)) {
                $ETC_id = $resultSearchEventObj->ETC_id;
            }
        }

        if ($type == "ticket") {

            //checking if event item already exist in table
            $sqlSearchEventItem = "SELECT EITC_id FROM event_item_temp_cart WHERE EITC_item_id=$itemID AND EITC_session_id='$sessionID' AND EITC_item_type='$type'";
            $resultSearchEventItem = mysqli_query($con, $sqlSearchEventItem);

            if ($resultSearchEventItem) {
                $countItem = mysqli_num_rows($resultSearchEventItem);

                //getting ticket information from database
                $ticketPrice = 0;
                $ticketDiscount = 0;
                $totalTicketPrice = 0;
                $totalTicketDiscount = 0;
                $sqlGetItem = "SELECT * FROM event_ticket_types WHERE TT_id=$itemID";
                $resultGetItem = mysqli_query($con, $sqlGetItem);

                if ($resultGetItem) {
                    $resultGetItemObj = mysqli_fetch_object($resultGetItem);
                    if (isset($resultGetItemObj->TT_venue_id)) {
                        //getting item price and discount from databases
                        $ticketPrice = $resultGetItemObj->TT_price;
                        if ($resultGetItemObj->TT_old_price > 0) {
                            $ticketDiscount = ($resultGetItemObj->TT_old_price - $resultGetItemObj->TT_current_price);
                        }
                        $totalTicketPrice = $ticketPrice * $quantity;
                        $totalTicketDiscount = $ticketDiscount * $quantity;
                    }
                } else {
                    $checkStatus++;
                    if (true) {
                        $return_array = array("output" => "error", "msg" => "resultGetItem error: " . mysqli_error($con));
                        echo json_encode($return_array);
                        exit();
                    } else {
                        $return_array = array("output" => "error", "msg" => "resultGetItem query failed.");
                        echo json_encode($return_array);
                        exit();
                    }
                }

                if ($countItem > 0) {
                    //item already exist in database, need to update
                    $updateItemTmpCart = '';
                    $updateItemTmpCart .=' EITC_quantity = "' . $quantity . '"';
                    $updateItemTmpCart .=', EITC_total_price = "' . $totalTicketPrice . '"';
                    $updateItemTmpCart .=', EITC_total_discount = "' . $totalTicketDiscount . '"';

                    $sqlUpdateItemTmpCart = "UPDATE event_item_temp_cart SET $updateItemTmpCart WHERE EITC_venue_id=$venueID AND EITC_item_id=$itemID AND EITC_session_id='$sessionID' AND EITC_item_type='$type'";
                    $resultUpdateItemTmpCart = mysqli_query($con, $sqlUpdateItemTmpCart);

                    if (!$resultUpdateItemTmpCart) {
                        $checkStatus++;
                        if (true) {
                            $return_array = array("output" => "error", "msg" => "resultUpdateItemTmpCart error: " . mysqli_error($con));
                            echo json_encode($return_array);
                            exit();
                        } else {
                            $return_array = array("output" => "error", "msg" => "resultUpdateItemTmpCart query failed.");
                            echo json_encode($return_array);
                            exit();
                        }
                    }
                } else {
                    //item does not exist in database, need to insert
                    $insertItemTmpCart = '';
                    $insertItemTmpCart .=' EITC_ETC_id = "' . $ETC_id . '"';
                    $insertItemTmpCart .=', EITC_session_id = "' . mysqli_real_escape_string($con, $sessionID) . '"';
                    $insertItemTmpCart .=', EITC_item_type = "' . mysqli_real_escape_string($con, $type) . '"';
                    $insertItemTmpCart .=', EITC_venue_id = "' . $venueID . '"';
                    $insertItemTmpCart .=', EITC_item_id = "' . $itemID . '"';
                    $insertItemTmpCart .=', EITC_quantity = "' . $quantity . '"';
                    $insertItemTmpCart .=', EITC_unit_price = "' . $ticketPrice . '"';
                    $insertItemTmpCart .=', EITC_unit_discount = "' . $ticketDiscount . '"';
                    $insertItemTmpCart .=', EITC_total_price = "' . $totalTicketPrice . '"';
                    $insertItemTmpCart .=', EITC_total_discount = "' . $totalTicketDiscount . '"';

                    $sqlInsertItemTmpCart = "INSERT INTO event_item_temp_cart SET $insertItemTmpCart";
                    $resultInsertItemTmpCart = mysqli_query($con, $sqlInsertItemTmpCart);

                    if (!$resultInsertItemTmpCart) {
                        $checkStatus++;
                        if (true) {
                            $return_array = array("output" => "error", "msg" => "resultInsertItemTmpCart error: " . mysqli_error($con));
                            echo json_encode($return_array);
                            exit();
                        } else {
                            $return_array = array("output" => "error", "msg" => "resultInsertItemTmpCart query failed.");
                            echo json_encode($return_array);
                            exit();
                        }
                    }
                }
            } else {
                $checkStatus++;
                if (true) {
                    $return_array = array("output" => "error", "msg" => "resultSearchEventItem error: " . mysqli_error($con));
                    echo json_encode($return_array);
                    exit();
                } else {
                    $return_array = array("output" => "error", "msg" => "resultSearchEventItem query failed.");
                    echo json_encode($return_array);
                    exit();
                }
            }
        } elseif ($type == "include") {

           $chket = "SELECT EITC_id FROM event_item_temp_cart WHERE EITC_item_id=$itemID AND EITC_session_id='$sessionID' AND EITC_item_type='$type'";
            $chketq = mysqli_query($con, $chket);
           
            
            if ($chketq) {
                $countItems = mysqli_num_rows($chketq);

                //getting ticket information from database
                $includePrice = 0;
                $includeDiscount = 0;
                $totalIncludePrice = 0;
                $totalIncludeDiscount = 0;
                $sqlGetItem = "SELECT * FROM event_ticket_types WHERE TT_type_id='3'";
                $resultGetItem = mysqli_query($con, $sqlGetItem);

                if ($resultGetItem) {

                    $resultGetItemObj = mysqli_fetch_object($resultGetItem);
                    if (isset($resultGetItemObj->TT_venue_id)) {
                        //getting item price and discount from databases
                        $includePrice = $resultGetItemObj->TT_price;
                        if ($resultGetItemObj->TT_old_price > 0) {
                            $includeDiscount = ($resultGetItemObj->TT_old_price - $resultGetItemObj->TT_current_price);
                        }
                        $totalIncludePrice = $includePrice * $quantity;
                        $totalIncludeDiscount = $includeDiscount * $quantity;
                    }
                   
                } else {
                    $checkStatus++;
                    if (true) {
                        $return_array = array("output" => "error", "msg" => "resultGetItem error: " . mysqli_error($con));
                        echo json_encode($return_array);
                        exit();
                    } else {
                        $return_array = array("output" => "error", "msg" => "resultGetItem query failed.");
                        echo json_encode($return_array);
                        exit();
                    }
                }

                if ($countItems > 0) {
                    //item already exist in database, need to update
                    $updateItemTmpCart = '';
                    $updateItemTmpCart .=' EITC_quantity = "' . $quantity . '"';
                    $updateItemTmpCart .=', EITC_total_price = "' . $totalIncludePrice . '"';
                    $updateItemTmpCart .=', EITC_total_discount = "' . $totalIncludeDiscount . '"';

                    $sqlUpdateItemTmpCart = "UPDATE event_item_temp_cart SET $updateItemTmpCart WHERE EITC_item_id=$itemID AND EITC_session_id='$sessionID' AND EITC_item_type='$type'";
                    $resultUpdateItemTmpCart = mysqli_query($con, $sqlUpdateItemTmpCart);

                    if (!$resultUpdateItemTmpCart) {
                        $checkStatus++;
                        if (true) {
                            $return_array = array("output" => "error", "msg" => "resultUpdateItemTmpCart error: " . mysqli_error($con));
                            echo json_encode($return_array);
                            exit();
                        } else {
                            $return_array = array("output" => "error", "msg" => "resultUpdateItemTmpCart query failed.");
                            echo json_encode($return_array);
                            exit();
                        }
                    }
                } else {
                    //item does not exist in database, need to insert
                    $insertItemTmpCart = '';
                    $insertItemTmpCart .=' EITC_ETC_id = "' . $ETC_id . '"';
                    $insertItemTmpCart .=', EITC_session_id = "' . $sessionID . '"';
                    $insertItemTmpCart .=', EITC_item_type = "' . $type . '"';
                    $insertItemTmpCart .=', EITC_venue_id = "' . $venueID . '"';
                    $insertItemTmpCart .=', EITC_item_id = "' . $itemID . '"';
                    $insertItemTmpCart .=', EITC_quantity = "' . $quantity . '"';
                    $insertItemTmpCart .=', EITC_unit_price = "' . $includePrice . '"';
                    $insertItemTmpCart .=', EITC_unit_discount = "' . $includeDiscount . '"';
                    $insertItemTmpCart .=', EITC_total_price = "' . $totalIncludePrice . '"';
                    $insertItemTmpCart .=', EITC_total_discount = "' . $totalIncludeDiscount . '"';

                    $sqlInsertItemTmpCart = "INSERT INTO event_item_temp_cart SET $insertItemTmpCart";
                    $resultInsertItemTmpCart = mysqli_query($con, $sqlInsertItemTmpCart);

                    if (!$resultInsertItemTmpCart) {
                        $checkStatus++;
                        if (true) {
                            $return_array = array("output" => "error", "msg" => "resultInsertItemTmpCart error: " . mysqli_error($con));
                            echo json_encode($return_array);
                            exit();
                        } else {
                            $return_array = array("output" => "error", "msg" => "resultInsertItemTmpCart query failed.");
                            echo json_encode($return_array);
                            exit();
                        }
                    }
                }
            } else {
                $return_array = array("output" => "error", "msg" => "Please add a ticket first then you can add includes.");
                echo json_encode($return_array);
                exit();
            }
        }
    } else {
        $checkStatus++;
        if (true) {
            $return_array = array("output" => "error", "msg" => "resultSearchEvent error: " . mysqli_error($con));
            echo json_encode($return_array);
            exit();
        } else {
            $return_array = array("output" => "error", "msg" => "resultSearchEvent query failed.");
            echo json_encode($return_array);
            exit();
        }
    }
}
//echo "<pre>";
//echo var_dump($resultSearchEvent);
//echo json_encode($resultSearchEvent);
?>