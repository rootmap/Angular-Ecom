<?php

include'.././DBconnection/database_connections.php';
$data = json_decode(file_get_contents("php://input"));


 $cityName = $data->cName2;


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
events.`event_is_coming`,
events.`event_status`,

event_venues.`venue_title`,
DATE_FORMAT(event_venues.`venue_start_date`,'%d %b %y') AS venue_start_date, 
TIME_FORMAT(event_venues.`venue_start_time`, '%h:%i%p') AS venue_start_time,
DATE_FORMAT(event_venues.`venue_end_date`,'%d %b %y') AS venue_end_date, 
TIME_FORMAT(event_venues.`venue_end_time`, '%h:%i%p') AS venue_end_time

FROM events  
LEFT JOIN `event_button_list` AS ebl ON  ebl.`event_id`=events.`event_id`
LEFT JOIN `event_button` AS eb ON ebl.`button_id`=eb.id
INNER JOIN event_venues ON events.event_id = event_venues.venue_event_id 

WHERE 
(events.city_from LIKE '%".$cityName."%' OR event_venues.city LIKE '%".$cityName."%' OR event_venues.venue_description LIKE '%".$cityName."%' OR event_venues.venue_title LIKE '%".$cityName."%') 
AND events.`event_is_coming`=  'yes' 
AND (events.`event_status` = 'upcoming' OR  events.event_id IN (SELECT `status` FROM event_movie_list WHERE `status`='1'))
GROUP BY events.event_id
ORDER BY rand() DESC";
 


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

