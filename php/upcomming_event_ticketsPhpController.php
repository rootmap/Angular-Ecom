<?php

include'../DBconnection/database_connections.php';
//echo $_GET['id'];
$data = json_decode(file_get_contents("php://input"));
@$id = $data->id;
$arrayFeatured = array();
$sql = "SELECT
CASE a.`admin_images`
     WHEN '' THEN 'default-avatar.png'
     ELSE a.`admin_images`
END AS admin_images,



e.`event_id`, 
e.`event_title`,
e.`event_status`,
e.`event_web_banner`,
e.`event_terms_conditions`,
e.`event_description`,
e.`event_organizer_details`,
DATE_FORMAT(ev.`venue_start_date`,'%D,%M %Y') AS venue_start_date, 
TIME_FORMAT(ev.`venue_start_time`, '%h:%i%p') AS venue_start_time,
DATE_FORMAT(ev.`venue_end_date`,'%D,%M %Y') AS venue_end_date, 
TIME_FORMAT(ev.`venue_end_time`, '%h:%i%p') AS venue_end_time,
ebl.button_id,
IFNULL(eb.name,'Buy Ticket') as button_lebel,

ev.`venue_geo_location`,
ev.`venue_address`
from events AS e 
LEFT JOIN event_venues AS ev ON e.`event_id` = ev.`venue_event_id`

LEFT JOIN event_button_list AS ebl
ON ebl.event_id = e.event_id

LEFT JOIN event_button AS eb
ON eb.id = ebl.button_id

LEFT JOIN admins AS a 
ON e.event_created_by = a.admin_id 
WHERE e.`event_id` ='$id' AND e.`event_is_coming`='yes' AND e.`event_status`='upcoming' ORDER BY e.`event_coming_priority` DESC
       ";// AND e.`event_status` = 'info' WHERE e.`event_id` =$id AND e.`event_status` = 'active' GROUP BY e.`event_id`
$result = mysqli_query($con, $sql);
if ($result) {
    while ($resultobj = mysqli_fetch_object($result)) {
        $arrayFeatured[] = $resultobj;
    }
} else {
    if (true) {
        $err = "resultFeatured error: " . mysqli_error($con);
    } else {
        $err = "resultFeatured query failed.";
    }
}




echo json_encode($arrayFeatured);
?>