<?php

include'.././DBconnection/database_connections.php';
$data = json_decode(file_get_contents("php://input"));

  $cityName = $data->cName;

// exit();

//$sql = "SELECT 
//                          e.`event_id`,
//                          e.`event_web_banner`,
//                          e.`event_title`,
//                          CASE e.event_web_logo 
//	                         WHEN '' THEN 'event_default_web_logo.jpg'
//                            ELSE e.event_web_logo
//                          END AS event_web_logo,
//                          e.`event_status`
//                          FROM events AS e 
//                          WHERE e.`event_id` IN (SELECT venue_event_id FROM `event_venues` WHERE event_venues.city LIKE '%$cityName%' OR event_venues.venue_address LIKE '%$cityName%') AND e.`event_status`='archived' ORDER BY e.`event_created_on` DESC";

  $sql1 = "
       SELECT 

ebl.button_id,
eb.name AS btn_name,

events.`event_id`,
events.city_from,
events.`event_category_id`,
events.`event_title`,
events.`event_type_tag`,
CASE events.event_web_logo 
	WHEN '' THEN 'event_default_web_logo.jpg'
    ELSE events.event_web_logo
END AS event_web_logo,
events.`event_is_featured`,
events.`event_status`,

event_venues.`venue_title`,
DATE_FORMAT(event_venues.`venue_start_date`,'%d %b %y') AS venue_start_date, 
TIME_FORMAT(event_venues.`venue_start_time`, '%h:%i%p') AS venue_start_time,
DATE_FORMAT(event_venues.`venue_end_date`,'%d %b %y') AS venue_end_date, 
TIME_FORMAT(event_venues.`venue_end_time`, '%h:%i%p') AS venue_end_time,

CASE event_venues.`city`
WHEN '' THEN 'Event city not in found'
ELSE event_venues.`city`
END AS city_from,
event_venues.`city` AS city

FROM events  
LEFT JOIN `event_button_list` AS ebl ON  ebl.`event_id`=events.`event_id`
LEFT JOIN `event_button` AS eb ON ebl.`button_id`=eb.id
INNER JOIN event_venues ON events.event_id = event_venues.venue_event_id 

WHERE 
(events.city_from LIKE '%".$cityName."%' 
OR event_venues.city LIKE '%".$cityName."%'
OR event_venues.venue_description LIKE '%".$cityName."%' 
OR event_venues.venue_title LIKE '%".$cityName."%') 
AND events.`event_is_coming`=  'yes' 
AND (events.`event_status` = 'active' OR  events.`event_status` = 'info' OR  events.event_id IN (SELECT `status` FROM event_movie_list WHERE `status`='1'))
GROUP BY events.event_id
ORDER BY events.`event_created_on` DESC"; 
  
 
$result1 = mysqli_query($con, $sql1);

$checkresult1 = mysqli_num_rows($result1);

$dataStore1 = array();

if ($checkresult1 > 0) {

    while ($resultobj = mysqli_fetch_object($result1)) {
        $dataStore1[] = $resultobj;
    }
} else {

    if (true) {
        $err = "resultFeatured error: " . mysqli_error($con);
    } else {
        $err = "resultFeatured query failed.";
    }
}



echo json_encode($dataStore1);



?>

