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




/* Data convert by jeson start here */
$data = json_decode(file_get_contents("php://input"));
/* ./Data convert by jeson end here */
//DATE_FORMAT(ev.`venue_start_date`,'%d-%b-%y') AS venue_start_date, 
//TIME_FORMAT(ev.`venue_start_time`, '%h:%i%p') AS venue_start_time,
 $sql = "
SELECT    
e.event_title,
a.TT_event_id,     
a.TT_id, 
a.TT_type_title,
a.TT_ticket_quantity,
a.TT_price,
a.TT_status,
a.TT_startDate,
a.TT_startTime,
a.TT_endDate,
a.TT_endTime,
mtt.name as TT_type_id
FROM event_ticket_types as a 
INNER JOIN merchant_ticket_types as mtt on a.TT_type_id=mtt.id
LEFT JOIN events AS e ON a.TT_event_id = e.event_id 
WHERE a.TT_event_id IN (SELECT e.`event_id` FROM `events` as e  WHERE e.`event_created_by`='$login_user_id') AND a.TT_status = 'active' GROUP BY a.TT_id ORDER BY a.TT_id DESC
          ";
$result = mysqli_query($con, $sql);
   $object = array();
   while ($row = mysqli_fetch_array($result)) {
       $object[]=$row;
    
}

echo json_encode($object);

//echo json_encode($object); 


//D-BAG
//$chk = mysqli_num_rows($query);
//
//if ($chk != "0") {
//    $data=array();
//    while ($rw=  mysqli_fetch_array($query))
//    {
//        $data[]=$rw;
//    }
//    
//    
//    $ss=json_encode($data);
//
//    echo $ss;
//    
//} else {
//    echo 0;
//}



