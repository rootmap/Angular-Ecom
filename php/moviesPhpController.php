<?php

include'../DBconnection/database_connections.php';


// Movie Event Start
$arrayMovie = array();
$sqlMovie = "SELECT a.*,
CASE IFNULL(b.event_web_logo,'') 
	WHEN '' THEN 'default_movie_web_logo.jpg'
    ELSE b.event_web_logo
END AS logo,
b.event_type_tag,
b.event_organizer_details
FROM event_movie_list as a 
LEFT JOIN `events` as b
on b.event_id=a.event_id 
WHERE a.status='1'
GROUP BY a.movie_id  DESC";

$resultMovie = mysqli_query($con, $sqlMovie);
$chkresultMovie = mysqli_num_rows($resultMovie);

if ($chkresultMovie > 0) {
    if ($resultMovie) {
        while ($resultMoviedObj = mysqli_fetch_object($resultMovie)) {
            $arrayMovie[] = $resultMoviedObj;
        }
    } else {
        if (true) {
            $err = "resultMovie error: " . mysqli_error($con);
        } else {
            $err = "resultMovie query failed.";
        }
    }
}

//coming soon movie list
$sqlmov_upcoming = array();
$sqlupcoming = "SELECT a.*,
CASE IFNULL(b.event_web_logo,'') 
	WHEN '' THEN 'default_movie_web_logo.jpg'
    ELSE b.event_web_logo
END AS logo
FROM event_movie_list as a 
LEFT JOIN `events` as b 
on b.event_id=a.event_id 
WHERE a.status='2' GROUP BY a.movie_id ORDER BY RAND() LIMIT 16
";

$sqlmovies_upcoming = mysqli_query($con, $sqlupcoming);
$chkupncome = mysqli_num_rows($sqlmovies_upcoming);
if ($chkupncome != 0) {
    while ($row = mysqli_fetch_object($sqlmovies_upcoming)) {
        $sqlmov_upcoming[] = $row;
    }
}


// echo "<pre>";
// echo var_dump($arrayFeatured);
//echo json_encode(utf8_encode_all($arrayMovie));

echo json_encode(array_merge($arrayMovie, $sqlmov_upcoming));
//echo json_encode(utf8_encode_all($arrayUpcoming));
?>