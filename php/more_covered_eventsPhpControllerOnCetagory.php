<?php 
include'../DBconnection/database_connections.php';
$data = json_decode(file_get_contents("php://input"));


@$id = $data->cid;

// This query work for event page banner and other image and for featured events. 
$dataStore1 = array();
//$sql1 = "SELECT events.event_id,
//    events.event_title,
//    events.event_category_id,
//    CASE events.event_web_logo 
//	WHEN '' THEN 'event_default_web_logo.jpg'
//    ELSE events.event_web_logo
//    END AS event_web_logo,
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
//    WHERE events.event_category_id = '$id' AND  events.event_status='archived'
//    OR events.event_id IN (SELECT status FROM event_movie_list WHERE `status`='0' 
//    GROUP BY movie_id) 
//    ORDER BY events.event_featured_priority DESC ";

$sql1 = "
SELECT 
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
WHERE (events.`event_category_id` = '$id' OR events.`event_category_id` like '%,$id,%' OR events.`event_category_id` like '$id,%' OR events.`event_category_id` like '%,$id')  
AND  events.`event_is_featured`=  'yes ' AND events.`event_status` = 'active' OR  events.`event_status` = 'info' OR  
events.event_id IN (SELECT `status` FROM event_movie_list WHERE `status`='1') GROUP BY event_id
ORDER BY rand() DESC
    ";

                          

$result1=mysqli_query($con,$sql1);
$checkresult1 = mysqli_num_rows($result1);

if($checkresult1 > 0){
    while($resultobj=mysqli_fetch_object($result1)){
	$dataStore1[] = $resultobj;
}
}else {
    if (true) {
        $err = "resultFeatured error: " . mysqli_error($con);
    } else {
        $err = "resultFeatured query failed.";
    }
}






echo json_encode($dataStore1);

?>

