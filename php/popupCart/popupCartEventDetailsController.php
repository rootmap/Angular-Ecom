<?php 
include'../../DBconnection/database_connections.php';
session_start();
$data = json_decode(file_get_contents("php://input"));
$sessionID = session_id();


$arrTmpCartEvent = array();
$sqlGetTmpCartEvent ="
SELECT 
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
 a.`ETC_created_on` FROM event_temp_cart as a 
 LEFT JOIN `events` as e ON e.`event_id`=a.`ETC_event_id` 
 LEFT JOIN event_item_temp_cart as eitc on eitc.`EITC_session_id`=a.`ETC_session_id` 
 WHERE a.`ETC_session_id`='$sessionID ' GROUP BY eitc.`EITC_item_id` ";

$resultGetTmpCartEvent = mysqli_query($con, $sqlGetTmpCartEvent);
if ($resultGetTmpCartEvent) {
    while ($resultGetTmpCartEventObj = mysqli_fetch_object($resultGetTmpCartEvent)) {
        $arrTmpCartEvent[] = $resultGetTmpCartEventObj;
    }
} else {
    if (true) {
        echo "resultGetTmpCartEventObj error: " . mysqli_error($con);
    } else {
        echo "resultGetTmpCartEventObj query failed.";
    }
}





//echo "<pre>";
//var_dump($arrTmpCartEvent);
     echo json_encode($arrTmpCartEvent);

?>


