<?php

include '../../../config/config.php';

header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];
if ($verb == "GET") {
    $EventID = $_GET["id"];
    $arrayOrderList = array();
    $sql = "SELECT order_events.OE_id,order_events.OE_order_id,order_events.OE_event_id,"
            . "order_events.OE_created_on,orders.order_number,orders.order_status,orders.order_shipment_charge,orders.order_billing_phone,"
            . "order_items.OI_item_type,order_items.OI_quantity,order_items.OI_unit_price,"
            . "order_items.OI_unit_discount,((order_items.OI_unit_price * order_items.OI_quantity)-order_items.OI_unit_discount) AS total,"
            . "events.event_title,order_events.OE_user_id,"
            . "CONCAT(users.user_first_name,' ',users.user_last_name) AS name "
            . "FROM order_events "
            . "LEFT JOIN orders ON order_events.OE_order_id = orders.order_id "
            . "LEFT JOIN order_items ON order_events.OE_id = order_items.OI_OE_id "
            . "LEFT JOIN events ON order_events.OE_event_id = events.event_id "
            . "LEFT JOIN users ON order_events.OE_user_id = users.user_id "
            . "WHERE order_events.OE_event_id=$EventID GROUP BY orders.order_id";
    $resultOrderList = mysqli_query($con, $sql);
    if ($resultOrderList) {
        while ($obj = mysqli_fetch_object($resultOrderList)) {
            $arrayOrderList[] = $obj;
        }
    } else {
        if (DEBUG) {
            $err = "resultOrderList error: " . mysqli_error($con);
        } else {
            $err = "resultOrderList query failed";
        }
    }
    echo "{\"data\":" . json_encode($arrayOrderList) . "}";
}
?>