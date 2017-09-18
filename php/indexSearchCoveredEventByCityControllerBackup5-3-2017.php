<?php

//database connection
require_once '../DBconnection/database_connections.php';
//database connection

//json data decode
$data = json_decode(file_get_contents("php://input"));
//json data decode


 $cityName = $data->cName;


$sql = "SELECT 
                          e.`event_id`,
                          e.`event_web_banner`,
                          e.`event_title`,
                          CASE e.event_web_logo 
	                         WHEN '' THEN 'event_default_web_logo.jpg'
                            ELSE e.event_web_logo
                          END AS event_web_logo,
                          e.`event_status`
                          FROM events AS e 
                          WHERE e.`event_id` IN (SELECT venue_event_id FROM `event_venues` WHERE event_venues.city LIKE '%$cityName%' OR event_venues.venue_address LIKE '%$cityName%') AND e.`event_status`='archived' ORDER BY e.`event_id` DESC";

$result = mysqli_query($con, $sql);

$dataObj = array();

while($row = mysqli_fetch_array($result)){
    $dataObj[] = $row; 
}

echo json_encode($dataObj);


?>

