<?php

include'../DBconnection/database_connections.php';

$data = json_decode(file_get_contents("php://input"));
$eventID = $data->event_id;

$data = array();



//getting event includes from database
//$strEventVenue = implode(',', $arrEventVenuesID);
$sqlEventpickPoint = "SELECT `name`,`address`,`point_details` FROM `event_pick_point` WHERE `event_id`='$eventID' AND `status`='1'";
$resultEventpickPoint = mysqli_query($con, $sqlEventpickPoint);


if ($resultEventpickPoint) {
    while ($resulSqlObj = mysqli_fetch_object($resultEventpickPoint)) {
        $data[] = $resulSqlObj;
    }
} else {
    echo 0;
}


echo json_encode($data);

?>