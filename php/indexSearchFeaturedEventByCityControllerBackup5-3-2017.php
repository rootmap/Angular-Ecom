<?php
//database connection
require_once '../DBconnection/database_connections.php';
//database connection

//json data decode
$data = json_decode(file_get_contents("php://input"));
//json data decode


$eventCity = $data->fcity;


$sql = "SELECT 

events.`event_id`,
events.`event_web_banner`,
events.`event_category_id`,
events.`event_title`,
CASE events.event_web_logo 
	WHEN '' THEN 'event_default_web_logo.jpg'
    ELSE events.event_web_logo
END AS event_web_logo,
events.`event_is_featured`,
events.`event_status`,
event_venues.`venue_start_time`,
event_venues.`venue_title`,
event_venues.`venue_end_time`,
event_venues.`venue_start_date`,
event_venues.`venue_end_date` FROM `events`

INNER JOIN event_venues
ON events.event_id = event_venues.venue_event_id

WHERE events.event_id IN (SELECT venue_event_id FROM `event_venues` WHERE event_venues.city LIKE '%$eventCity%' OR event_venues.venue_address LIKE '%$eventCity%') AND events.event_status = 'active' OR events.event_status = 'info' AND events.event_is_featured='yes' GROUP BY event_id
ORDER BY events.event_id DESC
       ";

$result = mysqli_query($con, $sql);

$dataObj = array();

while($row = mysqli_fetch_array($result)){
    $dataObj[] = $row; 
}

echo json_encode($dataObj);


?>

