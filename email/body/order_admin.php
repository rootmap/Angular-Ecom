<?php
include '../../config/config.php';

if (isset($_GET['order_id']) AND $_GET['order_id'] > 0) {
    $orderID = $_GET['order_id'];
    $orderArray = array();
    $orderDetailsSql = "SELECT 
CASE order_payment_type 
WHEN 'Card' THEN' Online Payment' 
WHEN 'eticket' THEN' Online Free E-Ticket' 
WHEN 'COD' THEN 'Cash On Delivery' 
ELSE 'Pick From Office' END AS payment_method, 
order_created,order_number,
order_user_id,
users.user_first_name,
order_status,
order_shipment_charge,
order_discount_amount, 
order_total_amount, 
users.user_default_billing,

CASE 
WHEN (orders.order_billing_first_name='0' || orders.order_billing_first_name='') 
THEN
		CASE 
    		WHEN (ua.UA_first_name='0' || ua.UA_first_name='') THEN users.user_first_name 
            ELSE ua.UA_first_name
        END    
ELSE orders.order_billing_first_name END AS order_billing_first_name,     
    
CASE 
WHEN (orders.order_billing_last_name='0' || orders.order_billing_last_name='') 
THEN
		CASE 
    		WHEN (ua.UA_last_name='0' || ua.UA_last_name='') THEN users.user_last_name 
            ELSE ua.UA_last_name
        END    
ELSE orders.order_billing_last_name END AS order_billing_last_name, 

    
CASE 
WHEN (orders.order_billing_phone='0' || orders.order_billing_phone='') 
THEN
		CASE 
    		WHEN (ua.UA_phone='0' || ua.UA_phone='') THEN users.user_phone 
            ELSE ua.UA_phone
        END    
ELSE orders.order_billing_phone END AS order_billing_phone, 

    
CASE 
WHEN (orders.order_billing_address='0' || orders.order_billing_address='') 
THEN
		CASE 
    		WHEN (ua.UA_address='0' || ua.UA_address='') THEN users.user_street_address 
            ELSE ua.UA_address
        END    
ELSE orders.order_billing_address END AS order_billing_address, 

    
CASE 
WHEN (orders.order_billing_country='0' || orders.order_billing_country='') 
THEN
		CASE 
    		WHEN (ua.UA_country_id='0' || ua.UA_country_id='') THEN countries.country_name 
            ELSE countriess.country_name 
        END    
ELSE orders.order_billing_country END AS order_billing_country, 

CASE 
WHEN (orders.order_billing_city='0' || orders.order_billing_city='') 
THEN
		CASE 
    		WHEN (ua.UA_city_id='0' || ua.UA_city_id='') THEN cities.city_name
            ELSE event_cities.city_name
        END    
ELSE orders.order_billing_city END AS order_billing_city, 

CASE 
WHEN (orders.order_billing_zip='0' || orders.order_billing_zip='') 
THEN
		CASE 
    		WHEN (ua.UA_zip='0' || ua.UA_zip='') THEN users.user_zip 
            ELSE ua.UA_zip
        END    
ELSE 
orders.order_billing_zip END AS order_billing_zip, 
order_shipping_first_name,
order_shipping_last_name,order_shipping_phone,order_shipping_address,order_shipping_country,order_shipping_city,order_shipping_zip,order_promotion_codes,order_promotion_discount_amount FROM orders 
LEFT JOIN users ON orders.order_user_id = users.user_id 
LEFT JOIN cities ON cities.city_id = users.user_city 
LEFT JOIN user_addresses as ua ON users.user_default_billing = ua.UA_id
LEFT JOIN event_cities ON event_cities.city_id = ua.UA_city_id 
LEFT JOIN countries ON countries.country_id = users.user_country 
LEFT JOIN countries as countriess ON countriess.country_id = ua.UA_country_id
 WHERE orders.order_id='".$orderID."'";
    $resultOrderDetails = mysqli_query($con, $orderDetailsSql);
    if ($resultOrderDetails) {
        while ($resultOrderDetailsObj = mysqli_fetch_object($resultOrderDetails)) {
            $orderArray[] = $resultOrderDetailsObj;
            $orderNumber = $resultOrderDetailsObj->order_number;
            $orderUserName = $resultOrderDetailsObj->user_first_name;
            $orderStatus = $resultOrderDetailsObj->order_status;
            $orderTotalAmount = $resultOrderDetailsObj->order_total_amount;
            $orderCouponCode = $resultOrderDetailsObj->order_promotion_codes;
            $orderCouponDiscount = $resultOrderDetailsObj->order_promotion_discount_amount;
            $orderBillingFirstName = $resultOrderDetailsObj->order_billing_first_name;
            $orderBillingLastName = $resultOrderDetailsObj->order_billing_last_name;
            $orderBillingPhone = $resultOrderDetailsObj->order_billing_phone;
            $orderBillingAddress = $resultOrderDetailsObj->order_billing_address;
            $orderBillingCountry = $resultOrderDetailsObj->order_billing_country;
            $orderBillingCity = $resultOrderDetailsObj->order_billing_city;
            $orderBillingZip = $resultOrderDetailsObj->order_billing_zip;
            $orderShippingFirstName = $resultOrderDetailsObj->order_shipping_first_name;
            $orderShippingLastName = $resultOrderDetailsObj->order_shipping_last_name;
            $orderShippingPhone = $resultOrderDetailsObj->order_shipping_phone;
            $orderShippingAddress = $resultOrderDetailsObj->order_shipping_address;
            $orderShippingCountry = $resultOrderDetailsObj->order_shipping_country;
            $orderShippingCity = $resultOrderDetailsObj->order_shipping_city;
            $orderShippingZip = $resultOrderDetailsObj->order_shipping_zip;
            $paymentMethod = $resultOrderDetailsObj->payment_method;
            $deliveryCost = $resultOrderDetailsObj->order_shipment_charge;
            $discountCost = $resultOrderDetailsObj->order_discount_amount;
            $totalCost = $orderTotalAmount + $deliveryCost;
            $orderPlacedDate = date("l dS F, Y h:i:s A", strtotime($resultOrderDetailsObj->order_created));
        }
    } else {
        if (DEBUG) {
            $err = "resultOrderDetails error: " . mysqli_error($con);
        } else {
            $err = "resultOrderDetails query failed";
        }
    }
}

//echo var_dump($orderArray);
// Get Event ID Order ID
$OrderEventIDItemIDArray = array();
$arrOrderSorted = array();
$orderEventIDItemIDSql = "SELECT order_events.*, order_items.*,events.event_id,events.event_title,"
 . " CASE OI_item_type WHEN 'ticket' THEN ' Ticket'"
 . " ELSE CASE OI_item_type WHEN 'include' THEN 'Include' "
 . "ELSE CASE OI_item_type WHEN 'seat' THEN 'Seat' "
 . "ELSE 'Others' END END END AS item_type,"
 . " CASE OI_item_type WHEN 'ticket' THEN (SELECT TT_type_title FROM event_ticket_types WHERE TT_id=OI_item_id)"
 . " ELSE CASE OI_item_type WHEN 'include' THEN (SELECT EI_name FROM event_includes WHERE EI_id=OI_item_id) "
 . "ELSE CASE OI_item_type WHEN 'seat' THEN (SELECT SPC_title FROM seat_place_coordinate WHERE SPC_id=OI_item_id)"
 . " END END END AS item_title FROM order_items "
 . "LEFT JOIN order_events ON order_events.OE_id = order_items.OI_OE_id "
 . "LEFT JOIN events ON events .event_id = order_events.OE_event_id "
 . "WHERE order_events.OE_order_id =$orderID";
$resultOrderEventIDItemID = mysqli_query($con, $orderEventIDItemIDSql);
if ($resultOrderEventIDItemID) {
    while ($resultOrderEventIDItemIDObj = mysqli_fetch_object($resultOrderEventIDItemID)) {
        $OrderEventIDItemIDArray[] = $resultOrderEventIDItemIDObj;
        $arrOrderSorted[$resultOrderEventIDItemIDObj->OI_item_type][$resultOrderEventIDItemIDObj->OI_item_id][] = $resultOrderEventIDItemIDObj;
    }
} else {
    if (DEBUG) {
        $err = "resultOrderEventIDItemID error: " . mysqli_error($con);
    } else {
        $err = "resultOrderEventIDItemID query failed";
    }
}


$newArrTickets = array();
$newarrSeats = array();
foreach ($arrOrderSorted AS $key => $val) {
    if ($key == "ticket") {
        foreach ($val AS $Kkey => $Vval) {
            $itemId = $Kkey;
            $totalQuantity = 0;
            $unitPrice = 0;
            $totalPrice = 0;
            $eventTitle = "";
            $itemType = "";
            $itemTitle = "";
            foreach ($Vval AS $Kkkey => $Vvval) {
                $unitPrice = $Vvval->OI_unit_price;
                $totalPrice += $Vvval->OI_unit_price;
                $totalQuantity += 1;
                $eventTitle = $Vvval->event_title;
                $itemType = $Vvval->item_type;
                $itemTitle = $Vvval->item_title;
            }
            $newArrTickets[$itemId]['unitPrice'] = $unitPrice;
            $newArrTickets[$itemId]['totalPrice'] = $totalPrice;
            $newArrTickets[$itemId]['totalQuantity'] = $totalQuantity;
            $newArrTickets[$itemId]['eventTitle'] = $eventTitle;
            $newArrTickets[$itemId]['itemType'] = $itemType;
            $newArrTickets[$itemId]['itemTitle'] = $itemTitle;
        }
    } elseif ($key == "seat") {
        foreach ($val AS $Kkey => $Vval) {
            $itemId = $Kkey;
            $totalQuantity = 0;
            $unitPrice = 0;
            $totalPrice = 0;
            $eventTitle = "";
            $itemType = "";
            $itemTitle = "";
            foreach ($Vval AS $Kkkey => $Vvval) {
                $unitPrice = $Vvval->OI_unit_price;
                $totalQuantity = $Vvval->OI_quantity;
                $totalPrice = $unitPrice * $totalQuantity;
                $eventTitle = $Vvval->event_title;
                $itemType = $Vvval->item_type;
                $itemTitle = $Vvval->item_title;
            }
            $newarrSeats[$itemId]['unitPrice'] = $unitPrice;
            $newarrSeats[$itemId]['totalPrice'] = $totalPrice;
            $newarrSeats[$itemId]['totalQuantity'] = $totalQuantity;
            $newarrSeats[$itemId]['eventTitle'] = $eventTitle;
            $newarrSeats[$itemId]['itemType'] = $itemType;
            $newarrSeats[$itemId]['itemTitle'] = $itemTitle;
        }
    }
}
?>

<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    </head>
    <body>
        <table cellspacing="0" cellpadding="0" width="100%" border="0">
            <tbody>
                <tr>
                    <td valign="top" align="center">
                        <table cellspacing="0" cellpadding="10" width="600" border="0" bgcolor="#FFFFFF" style="border:1px solid #689F38;">
                            <tbody>
                                <tr>
                                    <td valign="top" class="ecxfirst" style="text-align: center;">
                                        <a target="_blank" href="http://www.ticketchai.com/" style="font-size:20px;color:#383838;text-decoration:none;" class="">
                                            <img border="0" style="width: 100px !important;" alt="" src="http://ticketchai.com/images/ticketchai_logo.png">
                                        </a>

                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top">
                                        <h1 style="font-size:22px;font-weight:normal;line-height:22px;">Dear Admin,</h1>
                                        <p style="font-size:15px;line-height:16px;">
                                            A new order has been placed by <strong><?php echo $orderUserName; ?></strong> on <strong><?php echo $orderPlacedDate; ?></strong>. Below are the details of this order.
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top">
                                        <h3 style="font-size:16px;font-weight:normal;">Order Number #&nbsp;<?php echo $orderNumber; ?></h3>
                                        <h3 style="font-size:16px;font-weight:normal;">Order Status #&nbsp;<?php echo $orderStatus; ?></h3>
                                        <h3 style="font-size:16px;font-weight:normal;">Payment Method #&nbsp;<?php echo $paymentMethod; ?></h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table cellspacing="0" cellpadding="0" width="725" border="0">
                                            <thead>
                                                <tr>
                                                    <th width="325" bgcolor="#689F38" align="left" style="font-size:15px;padding:5px 9px 6px 9px;line-height:1em;">Delivery Address</th>
                                                    <th width="10"></th>
                                                    <th width="325" bgcolor="#689F38" align="left" style="font-size:15px;padding:5px 9px 6px 9px;line-height:1em;">Billing Address</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td valign="top" style="font-size:15px;padding:7px 9px 9px 9px;border-left:1px solid #EAEAEA;border-bottom:1px solid #EAEAEA;border-right:1px solid #EAEAEA;">
                                                        <?php echo $orderShippingAddress; ?><br/>
                                                        <?php echo $orderShippingZip; ?><?php echo " "; ?><?php echo $orderShippingCity; ?><br/>
                                                        <?php echo $orderShippingCountry; ?><br/>
                                                        <?php echo $orderShippingPhone; ?><br/>
                                                        <?php echo $orderShippingFirstName; ?><?php echo " "; ?><?php echo $orderShippingLastName; ?>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td valign="top" style="font-size:15px;padding:7px 9px 9px 9px;border-left:1px solid #EAEAEA;border-bottom:1px solid #EAEAEA;border-right:1px solid #EAEAEA;">
                                                        <?php echo $orderBillingAddress; ?><br/>
                                                        <?php echo $orderBillingZip; ?><?php echo " "; ?><?php echo $orderBillingCity; ?><br/>
                                                        <?php echo $orderBillingCountry; ?><br/>
                                                        <?php echo $orderBillingPhone; ?><br/>
                                                        <?php echo $orderBillingFirstName; ?><?php echo " "; ?><?php echo $orderBillingLastName; ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <br>

                                        <table cellspacing="0" cellpadding="0" width="100%" border="0" style="border:1px solid #689F38;">
                                            <thead>
                                                <tr>
                                                    <th bgcolor="#689F38" align="left" style="font-size:15px;padding:3px 9px;">Event Title</th>
                                                    <th bgcolor="#689F38" align="center" style="font-size:15px;padding:3px 9px;">Unit Price</th>
                                                    <th bgcolor="#689F38" align="center" style="font-size:15px;padding:3px 9px;">Qty.</th>
                                                    <th bgcolor="#689F38" align="center" style="font-size:15px;padding:3px 9px;">Total Price</th>
                                                </tr>
                                            </thead>
                                            <?php $grandTotal = 0; ?>
                                            <?php $grandDiscount = 0; ?>
                                            <?php if (count($newArrTickets) >= 1) : ?>
                                                <?php foreach ($newArrTickets AS $itemTicket) : ?>
                                                    <?php $grandTotal += $itemTicket['totalPrice']; ?>
                                                    <tbody>
                                                        <tr>
                                                            <td valign="top" align="left" style="font-size:15px;padding:3px 9px;border-bottom:1px dotted #689F38;">
                                                                <h4 style="margin: 0px !important;"><?php echo $itemTicket['eventTitle']; ?></h4>
                                                                <small>
                                                                    Item Title: <span class="label label-default"><?php echo $itemTicket['itemTitle']; ?></span>
                                                                    | Item Type: <span class="label label-default"><?php echo $itemTicket['itemType']; ?></span>
                                                                </small>
                                                            </td>
                                                            <td valign="top" align="center" style="font-size:15px;padding:3px 9px;border-bottom:1px dotted #689F38;"><span><?php echo number_format($itemTicket['unitPrice'], 2); ?> </span></td>
                                                            <td valign="top" align="center" style="font-size:15px;padding:3px 9px;border-bottom:1px dotted #689F38;"><span><?php echo $itemTicket['totalQuantity']; ?></span></td>
                                                            <td valign="top" align="center" style="font-size:15px;padding:3px 9px;border-bottom:1px dotted #689F38;"><span><?php echo number_format($itemTicket['totalPrice'], 2); ?> </span></td>
                                                        </tr>
                                                    </tbody>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                            <?php if (count($newarrSeats) >= 1) : ?>
                                                <?php foreach ($newarrSeats AS $itemSeat) : ?>
                                                    <?php $grandTotal += $itemSeat['totalPrice']; ?>
                                                    <tbody>
                                                        <tr>
                                                            <td valign="top" align="left" style="font-size:15px;padding:3px 9px;border-bottom:1px dotted #689F38;">
                                                                <h4 style="margin: 0px !important;"><?php echo $itemSeat['eventTitle']; ?></h4>
                                                                <small>
                                                                    Item Title: <span class="label label-default"><?php echo $itemSeat['itemTitle']; ?></span>
                                                                    | Item Type: <span class="label label-default"><?php echo $itemSeat['itemType']; ?></span>
                                                                </small>
                                                            </td>
                                                            <td valign="top" align="center" style="font-size:15px;padding:3px 9px;border-bottom:1px dotted #689F38;"><span><?php echo number_format($itemSeat['unitPrice'], 2); ?> </span></td>
                                                            <td valign="top" align="center" style="font-size:15px;padding:3px 9px;border-bottom:1px dotted #689F38;"><span><?php echo $itemSeat['totalQuantity']; ?></span></td>
                                                            <td valign="top" align="center" style="font-size:15px;padding:3px 9px;border-bottom:1px dotted #689F38;"><span><?php echo number_format($itemSeat['totalPrice'], 2); ?> </span></td>
                                                        </tr>
                                                    </tbody>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                            <tbody>

                                                <tr class="ecxsubtotal">
                                                    <td colspan="2"> </td>
                                                    <td align="right">
                                                        Delivery Cost                    
                                                    </td>

                                                    <td align="right">
                                                        <span class="ecxprice"><?php echo $deliveryCost; ?></span>                   
                                                    </td>
                                                </tr>
                                                <tr class="ecxsubtotal">
                                                    <td colspan="2"> </td>
                                                    <td align="right">
                                                        Discount                    
                                                    </td>

                                                    <td align="right">
                                                        <span class="ecxprice"><?php echo $discountCost; ?></span>                   
                                                    </td>
                                                </tr>
                                                <tr class="ecxshipping">
                                                    <td colspan="2"> </td>
                                                    <td align="right">
                                                        Subtotal 
                                                    </td>
                                                    <td align="right"><?php echo number_format($grandTotal + $grandDiscount + $deliveryCost, 2); ?></td>
                                                </tr>
                                                <?php if ($orderCouponDiscount > 0): ?>
                                                <tr class="ecxshipping" style="color: #900;">
                                                        <td colspan="2"> </td>
                                                        <td align="right">
                                                            Coupon Code (<?php echo $orderCouponCode; ?>) 
                                                        </td>
                                                        <td align="right"> - <?php echo number_format($orderCouponDiscount, 2); ?></td>
                                                    </tr>
                                                <?php endif; ?>
                                                <tr class="ecxgrand_total">
                                                    <td colspan="2"> </td>
                                                    <td align="right">
                                                        <strong>Grand Total</strong>
                                                    </td>
                                                    <td align="right">
                                                        <strong><span class="ecxprice"><?php echo number_format($totalCost - $orderCouponDiscount, 2); ?></span></strong>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </td>
                                </tr>
                                <tr><td bgcolor="#FFFFFF" align="center" class="ecxlast"><center><p style="font-size:15px;">&copy; 2014 ticketchai.com Ltd. All Rights Reserved</p></center></td></tr>
            </tbody>
        </table>
    </td>
</tr>

</tbody>
</table>
</body>
</html>