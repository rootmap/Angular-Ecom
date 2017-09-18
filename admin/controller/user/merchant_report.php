<?php
session_start();
include '../../../config/config.php';
$admin_type = getSession('admin_type');
$admin_ID = getSession('admin_id');

header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];
if ($verb == "GET") {
    $arr = array();
    
    
    if($admin_type!=1)
   {
      $get_sql = "SELECT 
A.admin_id,
A.admin_full_name,
A.total_amount,
B.requested_amount, 
(IFNULL(A.total_amount,0)-IFNULL(B.requested_amount,0)) as available_amount
FROM (SELECT
a.`admin_id`,
a.`admin_full_name`,
sum(o.order_total_amount) as total_amount
FROM `admins` as a

LEFT JOIN `events` as e ON a.`admin_id`=e.event_created_by
LEFT JOIN `order_events` as oe ON e.event_id=oe.OE_event_id
LEFT JOIN `orders` AS o ON oe.OE_order_id=o.order_id
GROUP BY a.`admin_id`) AS A,

(SELECT
a.`admin_id`,
a.`admin_full_name`,
sum(rr.request_amount) as requested_amount
FROM `admins` as a
LEFT JOIN refund_request as rr ON a.admin_id=rr.merchant_id
GROUP BY a.`admin_id`) AS B 
WHERE A.admin_id=b.admin_id
";
    }
    else 
    {
        $get_sql = "SELECT 
A.admin_id,
A.admin_full_name,
A.total_amount,
B.requested_amount, 
(IFNULL(A.total_amount,0)-IFNULL(B.requested_amount,0)) as available_amount
FROM (SELECT
a.`admin_id`,
a.`admin_full_name`,
sum(o.order_total_amount) as total_amount
FROM `admins` as a

LEFT JOIN `events` as e ON a.`admin_id`=e.event_created_by
LEFT JOIN `order_events` as oe ON e.event_id=oe.OE_event_id
LEFT JOIN `orders` AS o ON oe.OE_order_id=o.order_id
GROUP BY a.`admin_id`) AS A,

(SELECT
a.`admin_id`,
a.`admin_full_name`,
sum(rr.request_amount) as requested_amount
FROM `admins` as a
LEFT JOIN refund_request as rr ON a.admin_id=rr.merchant_id
GROUP BY a.`admin_id`) AS B 
WHERE A.admin_id=b.admin_id
";
    }
    
    $resultAdmin = mysqli_query($con, $get_sql);

    if ($resultAdmin) {
        while ($obj = mysqli_fetch_object($resultAdmin)) {
            $arr[] = $obj;
        }
    } else {
        if (DEBUG) {
            $err = "resultAdmin error: " . mysqli_error($con);
        } else {
            $err = "resultAdmin query failed";
        }
    }
    echo "{\"data\":" . json_encode($arr) . "}";
}



?>