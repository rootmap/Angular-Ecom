<?php

include '../../../config/config.php';


$venueId = 0;
$arrAllTickets = array();
extract($_POST);

if ($venueId > 0) {
    $sqlGetTickets = "SELECT TT_id,TT_type_title,TT_current_price,TT_old_price,TT_per_user_limit,TT_ticket_quantity "
            . "FROM event_ticket_types "
            . "WHERE TT_venue_id=$venueId "
            . "AND TT_status='active' "
            . "ORDER BY TT_type_title ASC";
    $resultGetTickets = mysqli_query($con, $sqlGetTickets);

    if ($resultGetTickets) {
        while ($resultGetTicketsObj = mysqli_fetch_object($resultGetTickets)) {
            $arrAllTickets[] = $resultGetTicketsObj;
        }
        $return_array = array("output" => "success", "resultGetTicketsObj" => $arrAllTickets);
        echo json_encode($return_array);
        exit();
    } else {
        if (DEBUG) {
            $return_array = array("output" => "error", "msg" => "resultGetTickets error: " . mysqli_error($con));
            echo json_encode($return_array);
            exit();
        } else {
            $return_array = array("output" => "error", "msg" => "resultGetTickets query failed.");
            echo json_encode($return_array);
            exit();
        }
    }
}
?>