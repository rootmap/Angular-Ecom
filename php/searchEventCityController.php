<?php 
include'../DBconnection/database_connections.php';


// Featured Event Start
$arraySearch = array();
$sqlSearch = "
    SELECT `cities`.city_id, 
           `cities`.city_name,
           `cities`.city_status 
           FROM `cities` 
           WHERE `cities`.city_status = 'allow' 
           GROUP BY `cities`.city_id 
           ORDER BY `cities`.city_id DESC 
     ";
$resultSearch = mysqli_query($con, $sqlSearch);
    if ($resultSearch) {
        while ($resultSearchObj = mysqli_fetch_object($resultSearch)) {
            $arraySearch[] = $resultSearchObj;
        }
    } else {
        if (true) {
            $err = "resultFeatured error: " . mysqli_error($con);
        } else {
            $err = "resultFeatured query failed.";
        }
    }

echo json_encode($arraySearch);




//SELECT 
//    events.event_id,
//    event_cities.city_name,
//    event_cities.city_id
//    FROM events INNER JOIN event_cities 
//    ON events.event_id = event_cities.event_id 
//    WHERE (events.event_is_featured='yes' AND events.event_status='active') 
//    OR events.event_status = 'active' OR events.event_status = 'info' OR events.event_id 
//    IN (SELECT event_id FROM event_movie_list WHERE `status`='1' || `status`='2' GROUP BY movie_id) 
//    ORDER BY events.event_featured_priority DESC LIMIT 16


?>