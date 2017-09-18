<?php

//database connection
require_once '../DBconnection/database_connections.php';
//database connection

//json data decode
$data = json_decode(file_get_contents("php://input"));
//json data decode


 $cityName = $data->cName2;


$sql = "
       SELECT 
    events.event_id,
    events.event_title,
    events.event_category_id,
    CASE events.event_web_logo 
	WHEN '' THEN 'event_default_web_logo.jpg'
    ELSE events.event_web_logo
END AS event_web_logo,
    events.event_is_coming,
    events.event_status 
    FROM `events` 
    WHERE events.`event_id` IN (SELECT venue_event_id FROM `event_venues` WHERE event_venues.city LIKE '%$cityName%' OR event_venues.venue_address LIKE '%$cityName%') AND events.event_is_coming='yes' AND events.event_status='active' ORDER BY events.event_coming_priority DESC
       ";

$result = mysqli_query($con, $sql);

$dataObj = array();

while($row = mysqli_fetch_array($result)){
    $dataObj[] = $row; 
}

echo json_encode($dataObj);


?>

