<?php 
include'../DBconnection/database_connections.php';

$data = json_decode(file_get_contents("php://input"));
$eventID = $data->eventID;

$arrEventTags=array();



  //getting event includes from database
    //$strEventVenue = implode(',', $arrEventVenuesID);
    $sqlEventTags = "SELECT `event_tag` FROM `events` WHERE `event_id`='$eventID' AND `event_status`='active'";
    $resultEventTags = mysqli_query($con, $sqlEventTags);
    if ($resultEventTags) {
        while ($resultEventTagsludesObj = mysqli_fetch_object($resultEventTags)) {
            $arrEventTags[]= $resultEventTagsludesObj;
			 $t=$resultEventTagsludesObj->event_tag;
        }
    } else {
        if (true) {
            echo "resultEventIncludes error: " . mysqli_error($con);
        } else {
            echo "resultEventIncludes query failed.";
        }
    }



 //echo var_dump( explode( ',', $t ) );
  echo json_encode(explode( ',', $t ));

?>