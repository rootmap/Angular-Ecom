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
e.`event_description`,
e.`event_organizer_details`,
e.`event_terms_conditions`,
e.`event_type_tag`,
e.`event_is_featured`,
ev.`venue_title`, 
DATE_FORMAT(ev.`venue_start_date`,'%D, %M %Y') AS venue_start_date, 
TIME_FORMAT(ev.`venue_start_time`, '%h:%i%p') AS venue_start_time,
DATE_FORMAT(ev.`venue_end_date`,'%D, %M %Y') AS venue_end_date, 
TIME_FORMAT(ev.`venue_end_time`, '%h:%i%p') AS venue_end_time,
ev.`venue_geo_location`,
ev.`venue_address`,
IG.`IG_title`,
IG.`IG_image_name`,
VG.`VG_title`,
VG.`VG_video_link`
from events AS e 
INNER JOIN event_venues AS ev ON e.`event_id` = ev.`venue_event_id`

LEFT JOIN event_image_gallery AS IG
ON e.`event_id` = IG.`IG_event_id`

LEFT JOIN event_video_gallery AS VG
ON e.`event_id` = VG.`Vg_event_id`

LEFT JOIN admins AS a 
ON e.event_created_by = a.admin_id 

WHERE e.`event_id` =$id AND e.`event_status` = 'archived'  OR e.`event_id`
 IN (SELECT status FROM event_movie_list WHERE `status`='0' GROUP BY movie_id)
  ORDER BY e.`event_featured_priority` DESC LIMIT 16
       ";

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