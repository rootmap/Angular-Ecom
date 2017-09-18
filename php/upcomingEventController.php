<?php 
include'../DBconnection/database_connections.php';
$data = json_decode(file_get_contents("php://input"));



$arrayUpcoming2 = array();

//[upcoming event query starts]
//
//   [fage 1]
//$sqlUpcome2 = "SELECT 
//    events.event_id,
//    events.event_title,
//    events.event_category_id,
//    CASE events.event_web_logo 
//	WHEN '' THEN 'event_default_web_logo.jpg'
//    ELSE events.event_web_logo
//     END AS event_web_logo,
//    events.event_is_coming,
//    events.event_status 
//    FROM `events` 
//    WHERE events.event_is_coming='yes'
//    AND events.event_status='upcoming' 
//    ORDER BY events.event_created_on DESC";
//   [fage 1]

//   [fage 2]
$sqlUpcome2 = "SELECT 

    e.`event_id`,
    e.`event_title`,
    e.`event_category_id`,
    e.`event_is_coming`,
    e.`event_status`,
    e.`event_created_on`,
    
    CASE e.`event_web_logo` 
	WHEN '' THEN 'event_default_web_logo.jpg'
    ELSE e.`event_web_logo`
    END AS event_web_logo
    
    FROM events AS e 
    WHERE e.`event_is_coming` ='yes'
    AND e.`event_status` ='upcoming'
    OR e.`event_id` IN (SELECT `status` FROM event_movie_list WHERE `status`='1')
    GROUP BY e.`event_id`
    ORDER BY e.`event_created_on` DESC";
   //   [fage 2]
//[upcoming event query starts]






$resultUpcome2 = mysqli_query($con, $sqlUpcome2);
$chkresultUpcoming2 = mysqli_num_rows($resultUpcome2);

if ($chkresultUpcoming2 > 0) {
    if ($resultUpcome2) {
        while ($resultFeaturedObj2 = mysqli_fetch_object($resultUpcome2)) {
            $arrayUpcoming2[] = $resultFeaturedObj2;
        }
    } else {
        if (true) {
            $err = "resultFeatured error: " . mysqli_error($con);
        } else {
            $err = "resultFeatured query failed.";
        }
    }
}
echo json_encode($arrayUpcoming2);
//echo json_encode(utf8_encode_all(array_merge($result1, $result2)));



?>





                    