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



$uId = $login_user_id;

$sql = " SELECT
orders.order_id AS oid,
orders.order_number AS onum,
orders.order_total_item AS oiteam,
orders.order_status AS os,
orders.order_billing_address AS oba,
orders.order_billing_phone AS obp,
orders.order_shipping_phone AS osp,
orders.order_shipping_address AS osa,
((orders.`order_total_amount` + orders.`order_vat_amount`)-orders.`order_discount_amount`) AS total_price,
CONCAT(order_billing_first_name, ' ', order_billing_last_name) as billingName,
CONCAT(order_shipping_first_name, ' ', order_shipping_last_name) as shippingName,
CONCAT(b.user_first_name, ' ',b.user_last_name) as defname,
c.UA_phone as defphone,
CASE order_payment_type
WHEN 'Card' THEN' Online Payment'
WHEN 'COD' THEN 'Cash On Delivery'
WHEN 'eticket' THEN 'Online Free E-Ticket' 
WHEN 'movie-eticket-online' THEN 'Online Movie E-Ticket'
WHEN 'movie-eticket-cod' THEN 'Cash On Delivery'
ELSE 'Pick From Office'
END AS payment_method,
e.event_title
FROM orders LEFT JOIN users as b on b.user_id='$uId'
LEFT JOIN order_events AS oe ON oe.OE_order_id=orders.order_id
LEFT JOIN events AS e ON e.event_id=oe.OE_event_id
LEFT JOIN user_addresses as c on c.UA_user_id='$uId'
WHERE orders.order_user_id='$uId' GROUP BY orders.order_id 
ORDER BY orders.order_id DESC
       ";

$result = mysqli_query($con, $sql);

$object = array();

while ($row = mysqli_fetch_array($result)) {
    
    $object[] = $row;
    
}

echo json_encode($object);


?>