<?php
include '../../DBconnection/auth.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


// Including database connections start here
require_once '../../DBconnection/database_connections.php';
// Including database connections end here
//json data encoding passing start here
$data = json_decode(file_get_contents("php://input"));
//json data encoding passing end here

//event_id,event_title,event_category_id,event_type,organized_by,event_created_on,event_created_end 
$id = $data->event_id;  //   
$sql = "SELECT 
        e.event_title AS event_title,  
        e.event_url AS event_url,  
        e.event_category_id AS event_category_id,  
        e.eventSub_category AS eventSub_category,  
        e.event_type AS event_type,  
        e.organized_by AS organized_by, 
        e.event_web_banner AS banner,
        e.event_web_logo AS logo,
        e.name_of_venue AS name_of_venue,  
        e.streetLine1 AS streetLine1,  
        e.streetLine2 AS streetLine2,  
        e.city_from AS city_from,  
        e.country_filed AS country_filed,  
        e.event_description AS event_description,  
        e.event_tag AS event_tag,  
        e.payment_servicecge AS payment_servicecge,  
        e.change_Label AS change_Label,
        TIME(e.event_created_on) AS startTime,
        TIME(e.event_created_end) AS endTime,
        DATE(e.event_created_on) AS startDate,
        DATE(e.event_created_end) AS endDate
        FROM events AS e  WHERE e.event_id='$id' ORDER BY event_id DESC";
$result = mysqli_query($con, $sql);
$chk = mysqli_num_rows($result);
if ($chk==1) {
    $data=array();
    while($row = mysqli_fetch_array($result))
    {
        $data[]=$row;
    }
    
    echo strip_tags(json_encode($data));
} else {
    echo 0;
}