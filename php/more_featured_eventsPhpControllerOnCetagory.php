<?php 
include'../DBconnection/database_connections.php';
$data = json_decode(file_get_contents("php://input"));

@$id = $data->cid;

// This query work for event page banner and other image and for featured events. 
$dataStore1 = array();
//$sql1 = "
//SELECT  
//            ebl.button_id,
//            eb.name AS btn_name,
//            
//            events.`event_id`,
//            events.`event_web_banner`,
//            events.`event_category_id`,
//            events.`event_title`,
//            events.`event_is_featured`,
//            events.`event_status`,
//            
//            CASE events.event_web_logo 
//                    WHEN '' THEN 'event_default_web_logo.jpg'
//                ELSE events.event_web_logo
//            END AS event_web_logo,
//            
//            
//            event_venues.`venue_start_time`,
//            event_venues.`venue_title`,
//            event_venues.`venue_end_time`,
//            event_venues.`venue_start_date`,
//            event_venues.`venue_end_date`
//            FROM events  
//            LEFT JOIN `event_button_list` AS ebl ON  ebl.`event_id`=events.`event_id`
//            LEFT JOIN `event_button` AS eb ON ebl.`button_id`=eb.id
//            INNER JOIN event_venues
//            ON events.event_id = event_venues.venue_event_id
//            
//            WHERE events.`event_category_id` = '$id' AND events.`event_is_featured`=  'yes '
//            AND events.`event_status` = 'active' OR  events.`event_status` = 'info' OR  
//            events.event_id IN (SELECT `status` FROM event_movie_list WHERE `status`='1') GROUP BY event_id
//            ORDER BY events.event_created_on DESC
//";

$sql1 = "
SELECT 

e.`event_id`,
e.`event_created_on`,
e.`event_web_banner`,
e.`event_category_id`,
e.`event_title`,
CASE e.event_web_logo 
  WHEN '' THEN 'event_default_web_logo.jpg'
  ELSE e.event_web_logo
END AS 
event_web_logo,  
e.`event_web_logo`,
e.`event_is_featured`,
e.`event_status`,
e.`event_created_on`,

ev.`venue_id`,
ev.`venue_event_id`,
ev.`venue_title`,
ev.`venue_valid_from`,
ev.`venue_valid_till`,

CASE ev.`city`
WHEN '' THEN 'Event city not in found'
ELSE ev.`city`
END AS city_from,
ev.`city` AS city,

DATE_FORMAT(ev.`venue_start_date`,'%d %b %y') AS venue_start_date, 
TIME_FORMAT(ev.`venue_start_time`, '%h:%i%p') AS venue_start_time,
DATE_FORMAT(ev.`venue_end_date`,'%d %b %y') AS venue_end_date, 
TIME_FORMAT(ev.`venue_end_time`, '%h:%i%p') AS venue_end_time, 

ev.`venue_status`,

ebl.button_id,
IFNULL(eb.name,'Buy Ticket') as btn_name,

ett.`TT_id`,
ett.`TT_venue_id`,
ett.`TT_type_title`
FROM events AS e 
LEFT JOIN event_venues AS ev ON e.`event_id` = ev.`venue_event_id` 
LEFT JOIN event_ticket_types AS ett ON ev.`venue_id` = ett.`TT_venue_id` 

LEFT JOIN `event_button_list` AS ebl ON  ebl.`event_id`=e.`event_id`
LEFT JOIN `event_button` AS eb ON ebl.`button_id`=eb.id

WHERE (e.`event_category_id` = '$id' OR e.`event_category_id` like '%,$id,%' OR e.`event_category_id` like '$id,%' OR e.`event_category_id` like '%,$id') 
AND (e.`event_status` = 'active' OR  e.`event_status` = 'info') GROUP BY e.`event_id`
ORDER BY e.`event_created_on` DESC
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


//SELECT 
//events.`event_id`,
//events.`event_web_banner`,
//events.`event_category_id`,
//events.`event_title`,
//events.`event_web_logo`,
//events.`event_is_featured`,
//events.`event_status`,
//event_venues.`venue_start_time`,
//event_venues.`venue_end_time`,
//event_venues.`venue_title`,
//event_venues.`venue_start_date`,
//event_venues.`venue_end_date`
//FROM events  INNER JOIN event_venues
//ON events.event_id = event_venues.venue_id 
//WHERE  events.`event_is_featured`=  'yes '
//AND events.`event_status` = 'active' OR  events.`event_status` = 'info' OR  
//events.event_id IN (SELECT `status` FROM event_movie_list WHERE `status`='1' GROUP BY movie_id) 
//ORDER BY events.event_featured_priority DESC LIMIT 16




?>





