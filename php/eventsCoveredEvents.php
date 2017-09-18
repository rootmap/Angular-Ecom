<?php 
include'../DBconnection/database_connections.php';
$data = json_decode(file_get_contents("php://input"));
@$id3 = $data->idm3;
$f = str_replace(';','',$id3);

// This query work for events upcoming event...
$dataStore3 = array();
if ($id3 !='') {
 $sql3 = "SELECT 

e.`event_id`,
e.`event_created_on`,
e.`event_web_banner`,
e.`event_category_id`,
e.`event_title`,

CASE e.event_web_logo 
  WHEN '' THEN 'event_default_web_logo.jpg'
  ELSE e.event_web_logo
END AS event_web_logo,

e.`event_is_featured`,
e.`event_status`,
e.`event_created_on`,

 
CASE ev.`city`
WHEN '' THEN 'Event city not in found'
ELSE ev.`city`
END AS city_from,
ev.`city` AS city,

ev.`venue_id`,
ev.`venue_event_id`,
ev.`venue_title`,
ev.`venue_valid_from`,
ev.`venue_valid_till`,
ev.`venue_status`,

DATE_FORMAT(ev.`venue_start_date`,'%d %b %y') AS venue_start_date2, 
DATE_FORMAT(ev.`venue_start_date`,'%M %e, %Y') AS venue_start_date, 
TIME_FORMAT(ev.`venue_start_time`, '%h:%i%p') AS venue_start_time,
DATE_FORMAT(ev.`venue_end_date`,'%d %b %y') AS venue_end_date, 
TIME_FORMAT(ev.`venue_end_time`, '%h:%i%p') AS venue_end_time, 


ebl.button_id,

#IFNULL(eb.name,'INFO') as btn_name,

CASE eb.name
      WHEN '' THEN 'INFO'
      ELSE
        'INFO'
    END AS btn_name,


ett.`TT_id`,
ett.`TT_venue_id`,
ett.`TT_type_title`

FROM events AS e 
LEFT JOIN event_venues AS ev ON e.`event_id` = ev.`venue_event_id` 
LEFT JOIN event_ticket_types AS ett ON ev.`venue_id` = ett.`TT_venue_id` 

LEFT JOIN `event_button_list` AS ebl ON  ebl.`event_id`=e.`event_id`
LEFT JOIN `event_button` AS eb ON ebl.`button_id`=eb.id

WHERE (e.`event_category_id` = '$f' OR e.`event_category_id` like '%,$f,%' OR e.`event_category_id` like '$f,%' OR e.`event_category_id` like '%,$f') 
    
AND e.`event_status` = 'archived'  GROUP BY e.`event_id`
ORDER BY e.`event_created_on` DESC";



$result3 = mysqli_query($con,$sql3);
$checkresult3 = mysqli_num_rows($result3);

if($checkresult3 > 0){
    while($resultobj=mysqli_fetch_object($result3)){
  $dataStore3[] = $resultobj;
}
}else {
    if (true) {
        $err = "resultFeatured error: " . mysqli_error($con);
    } else {
        $err = "resultFeatured query failed.";
    }
}
}


// echo "<pre>";
// var_dump($dataStore2);

echo json_encode($dataStore3);

?>