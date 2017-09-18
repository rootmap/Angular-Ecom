<?php

include'../DBconnection/database_connections.php';
//echo $_GET['id'];
$data = json_decode(file_get_contents("php://input"));
@$id = $data->id;
$arrayFeatured = array();
// $sql = "SELECT
// e.`event_id`, 
// e.`event_title`,
// e.`event_status`,
// e.`event_web_banner`,
// e.`event_description`,
// e.`event_organizer_details`,
// ev.`venue_start_date`, 
// ev.`venue_start_time`,
// ev.`venue_end_date`,
// ev.`venue_end_time`,
// ev.`venue_geo_location`,
// ev.`venue_address`
// from events AS e LEFT JOIN event_venues AS ev ON e.`event_id` = ev.`venue_event_id`
// WHERE e.`event_id` =$id  GROUP BY e.`event_id`   
// ";// AND e.`event_status` = 'info'
$sql="SELECT

CASE a.`admin_images`
     WHEN '' THEN 'default-avatar.png'
     ELSE a.`admin_images`
END AS admin_images,
e.`event_id`, 
e.`event_title`,
e.`event_status`,
CASE e.`event_web_banner` 
	WHEN '' THEN 'event_default_web_banner.jpg'
    ELSE e.`event_web_banner`
END AS event_web_banner,
ebl.button_id,

IFNULL(eb.name,'Buy Ticket') as button_lebel,


CASE e.event_web_logo 
	WHEN '' THEN 'event_default_web_logo.jpg'
    ELSE e.event_web_logo
END AS event_web_logo,
e.`event_description`,
e.organized_by,
e.`event_organizer_details`,
e.`event_terms_conditions`,
ev.`venue_id`, 
ev.`venue_title`,
DATE_FORMAT(ev.`venue_start_date`,'%D,%M %Y') AS venue_start_date, 
TIME_FORMAT(ev.`venue_start_time`, '%h:%i%p') AS venue_start_time,
DATE_FORMAT(ev.`venue_end_date`,'%D,%M %Y') AS venue_end_date, 
TIME_FORMAT(ev.`venue_end_time`, '%h:%i%p') AS venue_end_time,
ev.`venue_geo_location`,
ev.`venue_address`,
IG.`IG_title`,
IG.`IG_image_name`,
VG.`VG_title`,
VG.`VG_video_link`,
op.`SO_image`
from events AS e 
LEFT JOIN event_venues AS ev 
ON e.`event_id` = ev.`venue_event_id`

LEFT JOIN event_image_gallery AS IG
ON e.`event_id` = IG.`IG_event_id`

LEFT JOIN event_video_gallery AS VG
ON e.`event_id` = VG.`Vg_event_id`

LEFT JOIN event_special_offer AS op
ON e.`event_id` = op.`SO_on_event_id` 

LEFT JOIN event_button_list AS ebl
ON ebl.event_id = e.event_id

LEFT JOIN event_button AS eb
ON eb.id = ebl.button_id

LEFT JOIN admins AS a 
ON e.event_created_by = a.admin_id 
WHERE e.`event_id`='$id' GROUP BY e.event_id
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