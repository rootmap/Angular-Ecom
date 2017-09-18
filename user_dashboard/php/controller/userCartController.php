<?php

//database connection
require_once '../../DBconnection/database_connections.php';
//database connection

//authority page connection
require_once '../../../DBconnection/auth.php';
//authority page connection

//json data decode
$data = json_decode(file_get_contents("php://input"));
//json data decode



@$userId = $login_user_id;

$dataArray = array();

$sql = " SELECT 
a.`ETC_id`, 
eitc.`EITC_item_type` as item_type, 
eitc.`EITC_id`, 
eitc.`EITC_item_id`, 
eitc.`EITC_ETC_id`, 
CASE eitc.`EITC_item_type` 
WHEN 'ticket' THEN (SELECT ett.`TT_type_title` FROM event_ticket_types as ett WHERE ett.`TT_id`=eitc.`EITC_item_id`) 
ELSE CASE eitc.`EITC_item_type` WHEN 'include' 
THEN (SELECT ei.`EI_name` FROM event_includes as ei WHERE ei.`EI_id`=eitc.`EITC_item_id`) 
ELSE 0 END END AS tp, eitc.`EITC_quantity` AS `EITC_quantity`, 
eitc.`EITC_unit_price`, a.`ETC_event_id`,
 e.`event_title`, 
 e.`event_web_logo`, 
 a.`ETC_created_on` 
 
 FROM event_temp_cart as a 
INNER JOIN `events` as e ON e.`event_id`=a.`ETC_event_id` 
LEFT JOIN event_item_temp_cart as eitc on eitc.`EITC_ETC_id`=a.`ETC_id` 

WHERE a.`ETC_user_id`='$userId' GROUP BY eitc.`EITC_item_id`,e.`event_title` 
       ";

$result = mysqli_query($con, $sql);

while($row = mysqli_fetch_object($result)){
    $dataArray[] = $row;
}

echo json_encode($dataArray);

?>

