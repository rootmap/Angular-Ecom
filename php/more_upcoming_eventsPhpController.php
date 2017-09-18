<?php 
include'../DBconnection/database_connections.php';
$data = json_decode(file_get_contents("php://input"));


// This query work for event page banner and other image and for featured events. 
$dataStore1 = array();
$sql1 = "SELECT 
    events.event_id,
    events.event_title,
    events.event_category_id,
    CASE events.event_web_logo 
	WHEN '' THEN 'event_default_web_logo.jpg'
    ELSE events.event_web_logo
END AS event_web_logo,
    events.event_is_coming,
    events.event_status 
    FROM `events` 
    WHERE events.event_is_coming='yes'
    AND events.event_status='upcoming' 
    ORDER BY events.event_created_on DESC";



                          

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