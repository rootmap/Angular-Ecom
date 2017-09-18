<?php
require_once'../DBconnection/database_connections.php';
$data = json_decode(file_get_contents("php://input"));

session_start();
$userID = 0;


if (isset($_SESSION['USER_DASHBOARD_USER_ID'])) {

    $userID = $_SESSION['USER_DASHBOARD_USER_ID'];
    $sessionID=  session_id();
    $sqlcheck=mysqli_query($con,"SELECT * FROM orders WHERE order_session_id='".$sessionID."'");
    $chksqlcount=mysqli_num_rows($sqlcheck);
    if($chksqlcount==1)
    {
        session_regenerate_id();  
        $sessionID=  session_id();
    }
    else 
    {
        $sessionID=  session_id();
    }
} 

// Get all order according to user id
$orderListArray = array();
$sqlOrderListRow = "SELECT 
c.UA_phone as defphone,
c.UA_address,
c.UA_city_id,
c.UA_country_id,
cities.city_name,
countries.country_name,

CONCAT(order_billing_first_name, ' ', order_billing_last_name) as billingName,
CONCAT(order_shipping_first_name, ' ', order_shipping_last_name) as shippingName,
CONCAT(b.user_first_name, ' ',b.user_last_name) as user_full_name,

CASE order_payment_type 
WHEN 'Card' THEN' Online Payment'
WHEN 'COD' THEN 'Cash On Delivery' 
WHEN 'eticket' THEN 'Online Free E-Ticket' 
WHEN 'movie-eticket-online' THEN 'Online Movie E-Ticket' 
WHEN 'movie-eticket-cod' THEN 'Cash On Delivery' 
ELSE 'Pick From Office' 
END AS payment_method,
orders.*,(SELECT COUNT(OE_event_id) FROM order_events WHERE
orders.order_id = order_events.OE_order_id) AS totalEvent FROM orders
LEFT JOIN users as b on b.user_id='613'
LEFT JOIN user_addresses as c on c.UA_user_id='613'
LEFT JOIN cities on c.UA_city_id=cities.city_id 
LEFT JOIN countries on countries.country_id=c.UA_country_id
WHERE orders.order_user_id='613' GROUP BY orders.order_id ORDER BY orders.order_id DESC";

//echo $sqlOrderListRow;
//exit();
$resultOrderListRow = mysqli_query($con, $sqlOrderListRow);

if ($resultOrderListRow) {
    while ($resultOrderListObj = mysqli_fetch_object($resultOrderListRow)) {
        $orderListArray[] = $resultOrderListObj;
    }
} else {
    if (true) {
        $err = "resultOrderListRow error: " . mysqli_error($con);
    } else {
        $err = "resultOrderListRow query failed";
    }
}
echo json_encode($orderListArray);
?>