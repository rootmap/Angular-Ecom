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

/*Data convert by jeson start here*/
$data = json_decode(file_get_contents("php://input"));
/*./Data convert by jeson end here*/

$modelDateStart = $data->startdate;
$modelDateEnd = $data->enddate;


$sql="SELECT
event_id,
event_title,
c.category_title,
ey.name,
organized_by,
event_status,
DATE_FORMAT(`event_created_on`,'%m/%d/%Y') as event_created_on,
DATE_FORMAT(`event_created_end`,'%m/%d/%Y') as event_created_end

FROM `events`
INNER JOIN categories as c ON c.category_id=events.`event_category_id`
INNER JOIN event_type as ey ON ey.id=events.`event_type`
WHERE 
(DATE_FORMAT(`event_created_on`,'%m/%d/%Y') BETWEEN '$modelDateStart' AND '$modelDateEnd') OR (DATE_FORMAT(`event_created_end`,'%m/%d/%Y') BETWEEN '$modelDateStart' AND '$modelDateEnd') AND `event_created_by`='$login_user_id' OR event_status='active'
ORDER BY event_id DESC";
$result=mysqli_query($con,$sql);
$object =array();
while ($row= mysqli_fetch_array($result)) {
    $object[]=$row;
    
}
echo json_encode($object);

//DATE_FORMAT(`event_created_on`,'%m/%d/%Y') >= '$modelDateStart' AND DATE_FORMAT(`event_created_end`,'%m/%d/%Y') <= '$modelDateEnd' AND `event_created_by`='$login_user_id' AND event_status='active'