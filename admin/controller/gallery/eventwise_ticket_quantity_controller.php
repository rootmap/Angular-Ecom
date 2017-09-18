

<?php

include '../../../config/config.php';
header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];
if ($verb == "GET") {

    $arrayContact = array();
    $get_sql = "SELECT
etcq.id,        
e.event_title,
etcq.event_id,
etcq.ticket_quantity,
etcq.date 
FROM
eventwies_tcquantity as etcq 
LEFT JOIN events as e on etcq.event_id=e.event_id";
    
  $resultContactQuery = mysqli_query($con, $get_sql);
    if ($resultContactQuery) {
        while ($objContact = mysqli_fetch_object($resultContactQuery)) {
            $arrayContact[] = $objContact;
        }
    } else {
        if (DEBUG) {
            $err = "resultContactQuery error: " . mysqli_error($con);
        } else {
            $err = "resultContactQuery query failed";
        }
    }
    echo "{\"data\":" . json_encode($arrayContact) . "}";
}


    if ($verb == "POST") {

        extract($_POST);


        $IG_id = mysqli_real_escape_string($con, $IG_id);

        $delete_sql = "DELETE FROM eventwies_tcquantity WHERE id = '" . $IG_id . "'";

        $resultDelImage = mysqli_query($con, $delete_sql);

        if ($resultDelImage) {
            echo json_encode($resultDelImage);
        } else {
            if (DEBUG) {
                $err = "resultDelImage error: " . mysqli_error($con);
            } else {
                $err = "resultDelImage query failed";
            }
        }
    }
    ?>