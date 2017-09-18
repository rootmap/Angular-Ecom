<?php 
include'../DBconnection/database_connections.php';

$data = json_decode(file_get_contents("php://input"));
@$eventID = $data->id;
 //$eventID;

    //$arrEventVenues=array();
    //$arrEventVenuesID=array();
    $arrEventIncludes=array();



//getting event venunes from database
//    $sqlEventVenues = "SELECT * FROM event_venues WHERE venue_event_id='$eventID' ";
//    $resultEventVenues = mysqli_query($con, $sqlEventVenues);
//    if ($resultEventVenues) {
//        while ($resultEventVenuesObj = mysqli_fetch_object($resultEventVenues)) {
//            $arrEventVenues[] = $resultEventVenuesObj;
//            $arrEventVenuesID []= $resultEventVenuesObj->venue_id;
//        }
//    } else {
//        if (true) {
//            echo "resultEventVenues error: " . mysqli_error($con);
//        } else {
//            echo "resultEventVenues query failed.";
//        }
//    }



  //getting event includes from database
    //$strEventVenue = implode(',', $arrEventVenuesID);
    $sqlEventIncludes = "SELECT *,
                            CASE `TT_old_price` WHEN 0.00 THEN 
                                                            CASE TT_current_price WHEN 0.00 THEN TT_price 
                                                            ELSE TT_current_price
                                                            END
                            ELSE `TT_price` END AS `price`,
                            CASE `TT_old_price` WHEN `TT_old_price`!=0.00 THEN TT_old_price
                            ELSE 0.00 END AS old_price
                            FROM `event_ticket_types`"
                . "WHERE TT_event_id='$eventID' "
                . " AND TT_type_id='3'"
                . "AND TT_status='active'";
    $resultEventIncludes = mysqli_query($con, $sqlEventIncludes);
    if ($resultEventIncludes) {
        while ($resultEventIncludesObj = mysqli_fetch_object($resultEventIncludes)) {
            $arrEventIncludes[]= $resultEventIncludesObj;
        }
    } else {
        if (true) {
            echo "resultEventIncludes error: " . mysqli_error($con);
        } else {
            echo "resultEventIncludes query failed.";
        }
    }


  // echo "<pre>";
    //var_dump($arrayEventTickets );
    //echo var_dump(array_merge($arrEventIncludes,$arrayEventTickets));
  echo json_encode($arrEventIncludes);

?>