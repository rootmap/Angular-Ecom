<?php 
include'../DBconnection/database_connections.php';

$data = json_decode(file_get_contents("php://input"));
@$eventID = $data->id;
//echo $eventID;



//    $arrEventVenues=array();
//    $arrEventVenuesID=array();
//
    $arrayEventTickets=array();
//
//
//
////getting event venunes from database
//    $sqlEventVenues = "SELECT * FROM event_venues WHERE venue_event_id='$eventID' ";
//    $resultEventVenues = mysqli_query($con, $sqlEventVenues);
//    if ($resultEventVenues) {
//        while ($resultEventVenuesObj = mysqli_fetch_object($resultEventVenues)) {
//            $arrEventVenues[] = $resultEventVenuesObj;
//            $arrEventVenuesID[] = $resultEventVenuesObj->venue_id;
//        }
//    } else {
//        if (true) {
//            echo "resultEventVenues error: " . mysqli_error($con);
//        } else {
//            echo "resultEventVenues query failed.";
//        }
//    }
//
//
//
    //getting event tickets from database
    //$strEventVenue = implode(',', $arrEventVenuesID);
    if (!empty($eventID)) {
        $sqlEventTickets = "SELECT *,
                            CASE `TT_old_price` WHEN 0.00 THEN 
                                                            CASE TT_current_price WHEN 0.00 THEN TT_price 
                                                            ELSE TT_current_price
                                                            END
                            ELSE `TT_price` END AS `price`,
                            CASE `TT_old_price` WHEN `TT_old_price`!=0.00 THEN TT_old_price
                            ELSE 0.00 END AS old_price
                            FROM `event_ticket_types`"
                . "WHERE TT_event_id='$eventID' "
                . " AND TT_type_id IN (2) "
                . "AND TT_status='active'";
        $resultEventTickets = mysqli_query($con, $sqlEventTickets);
        if ($resultEventTickets) {
            while ($resultEventTicketsObj = mysqli_fetch_object($resultEventTickets)) {
                $arrayEventTickets[] = $resultEventTicketsObj;
            }
        } else {
            if (true) {
                echo "resultEventTickets error: " . mysqli_error($con);
            } else {
                echo "resultEventTickets query failed.";
            }
        }
    }




  // echo "<pre>";
    //var_dump($arrayEventTickets );
    //echo var_dump(array_merge($arrEventIncludes,$arrayEventTickets));
  echo json_encode($arrayEventTickets);

?>