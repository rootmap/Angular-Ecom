<?php

include'../DBconnection/database_connections.php';
$data = json_decode(file_get_contents("php://input"));
// @$id3 = $data->idm3;
// This query work for events upcoming event...
$arrayCovered = array();
//   [fage 1]
//$sql3 = "SELECT events.event_id,
//    events.event_title,
//    events.event_category_id,
//    CASE events.event_web_logo 
//	WHEN '' THEN 'event_default_web_logo.jpg'
//    ELSE events.event_web_logo
//END AS event_web_logo,
//    events.event_web_banner,
//    events.event_is_free,
//    events.event_is_chairity,
//    events.event_is_featured,
//    events.event_status,
//    events.event_type_tag,
//    events.event_is_blockbuster,
//    event_venues.venue_start_time,
//    event_venues.venue_end_time,
//    event_venues.venue_start_date,
//    event_venues.venue_end_date
//    FROM events INNER JOIN event_venues
//    ON events.event_id = event_venues.venue_event_id 
//    WHERE   events.event_status='archived' OR events.event_id IN (SELECT status FROM event_movie_list WHERE `status`='0' GROUP BY movie_id) ORDER BY events.event_featured_priority DESC LIMIT 16
//";
//   [fage 1]


//   [fage 2]
//$sql3 = "SELECT 
//
//    e.`event_id`,
//    e.`event_title`,
//    e.`event_category_id`,
//    e.`event_status`,
//    e.`event_created_on`,
//    e.`event_type_tag`,
//    
//    CASE e.`event_web_logo` 
//	WHEN '' THEN 'event_default_web_logo.jpg'
//    ELSE e.`event_web_logo`
//    END AS event_web_logo
//    
//    FROM events AS e 
//    WHERE e.`event_status` ='archived'
//    OR e.`event_id` IN (SELECT `status` FROM event_movie_list WHERE `status`='0')
//    GROUP BY e.`event_id`
//    ORDER BY e.`event_created_on` DESC
//";
//   [fage 2]
//[covered event query starts]

$sql3 = "SELECT 
ebl.button_id,

IFNULL(eb.name,'Buy Ticket') as btn_name,
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
WHERE  events.`event_is_featured`=  'yes ' AND events.`event_status` = 'active' OR  events.`event_status` = 'info' OR  
events.event_id IN (SELECT `status` FROM event_movie_list WHERE `status`='1') GROUP BY event_id
ORDER BY rand() DESC";


$result3 = mysqli_query($con, $sql3);
$checkresult3 = mysqli_num_rows($result3);

if ($checkresult3 > 0) {
    while ($resultobj = mysqli_fetch_object($result3)) {
        $arrayCovered[] = $resultobj;
    }
} else {
    if (true) {
        $err = "resultFeatured error: " . mysqli_error($con);
    } else {
        $err = "resultFeatured query failed.";
    }
}

// echo "<pre>";
// var_dump($dataStore2);

echo json_encode($arrayCovered);
?>