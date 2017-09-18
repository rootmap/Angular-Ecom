<?php
require_once '../../DBconnection/database_connections.php';
//require_once('phpmailer/class.phpmailer.php');
 $status = $_GET['order_status'];
 $orderID = $_GET['oid'];
 $o_s_id=$_GET['order_session'];

// $orderDetailsSql = "SELECT 
//oe.`OE_order_id`,
//oe.`OE_user_id`,
//o.`order_number`,
//o.`order_total_item`,
//o.`order_total_amount`,
//o.`order_payment_type`,
//o.`order_billing_phone`,
//u.`user_email`,
//u.`user_first_name`
//
//FROM `order_events` AS oe 
//LEFT JOIN `orders` As o ON oe.`OE_order_id`=o.order_id
//LEFT JOIN `users` As u ON oe.`OE_user_id`=u.user_id
//WHERE  oe.`OE_order_id`='$orderID' ORDER BY oe.`OE_order_id` DESC LIMIT 1
//";
//
//   $result = mysqli_query($con, $orderDetailsSql);
//
//       $row = mysqli_fetch_array($result);
//          //  print_r($row);
//            $OI_id = $row['OE_order_id'];
//            $OI_number = $row['order_number'];
//            $payment_method = $row['order_payment_type'];
//            $user_email = $row['user_email'];
//            $total_item = $row['order_total_item'];
//             $user_name = $row['user_first_name'];
//            $user_phone = $row['order_billing_phone'];
//            $t_A=$row['order_total_amount'];




 $sql = " 
SELECT

e.`event_id`,
e.`event_title`,
e.`event_web_logo`,
e.`event_terms_conditions`,
e.`event_description`,
e.`organized_by`,

ev.`venue_id`,
ev.`venue_title`,

o.`order_id`,
o.`order_number`, 
o.`order_status`, 
o.`order_total_item`,
o.`order_shipment_charge`,

CASE o.`order_payment_type`
WHEN 'CARD' THEN 'Online Payment'
WHEN 'COD'  THEN 'Cash On Delivery'
WHEN 'eticket' THEN 'Online Free E-Ticket'
WHEN 'movie-eticket-online' THEN 'Online Movie E-Ticket'
WHEN 'movie-eticket-cod' THEN 'Cash On Delivery'
ELSE 'Pick From Office'
END payment_method,

((o.`order_total_amount` + o.`order_vat_amount`)-o.`order_discount_amount`) AS newtotal_price,
oe.`OE_event_id`,

IFNULL(oit.quantity,0) AS ticket_quantity ,
IFNULL(oit.total_price,0) AS ticket_total_price,
IFNULL(oii.quantity,0) AS include_quantity,
IFNULL(oii.total_price,0) AS include_total_price,

c.`category_title`,

u.`user_name`as userName,
u.`user_phone`,
u.`user_email`,
ua.`UA_address`,

DATE_FORMAT(ev.venue_start_date, '%a %D %b %Y') as start_date,
DATE_FORMAT(ev.venue_end_date, '%a %D %b %Y') as end_date,
TIME_FORMAT(ev.venue_start_time, '%h:%i%p') as start_time,
TIME_FORMAT(ev.venue_end_time, '%h:%i%p') as end_time

from `orders`AS o
LEFT JOIN `order_events` AS oe ON o.order_id = oe.OE_order_id
LEFT JOIN `events`       AS e ON oe.OE_event_id = e.event_id
LEFT JOIN `event_venues` AS ev ON e.event_id = ev.venue_event_id
LEFT JOIN `categories`   AS c  ON e.event_category_id = c.category_id
LEFT JOIN `temp_billing`        AS u  ON o.order_user_id = u.user_id
LEFT JOIN `user_addresses` AS ua ON u.user_id = ua.UA_user_id 
LEFT JOIN (SELECT oi.OI_order_id,SUM(oi.OI_quantity) AS quantity,SUM(oi.OI_quantity*oi.OI_unit_price) AS total_price,oi.OI_item_type FROM order_items as oi 
WHERE oi.OI_order_id='$orderID'
GROUP BY oi.OI_item_type) AS oit ON oit.OI_order_id=o.order_id AND oit.OI_item_type='ticket'
LEFT JOIN (SELECT oi.OI_order_id,SUM(oi.OI_quantity) AS quantity,SUM(oi.OI_quantity*oi.OI_unit_price) AS total_price,oi.OI_item_type FROM order_items as oi 
WHERE oi.OI_order_id='$orderID'
GROUP BY oi.OI_item_type) AS oii ON oii.OI_order_id=o.order_id AND oii.OI_item_type='include'
where o.order_id ='$orderID' AND u.order_id='$o_s_id'
       ";

//DATE_FORMAT(ev.venue_start_date, '%M %d, %Y') as start_date2,
//DATE_FORMAT(ev.venue_end_date, '%M %d, %Y') as end_date2

$result = mysqli_query($con, $sql);

$object = array();

while ($row = mysqli_fetch_array($result)) {

    $object[] = $row;

    $event_id = $row['event_id'];
    $event_title = $row['event_title'];
    $event_logo = $row['event_web_logo'];
    $event_terms_conditions = $row['event_terms_conditions'];
    $event_description = $row['event_description'];
    $event_start_date = $row['start_date'];
    $event_end_date = $row['end_date'];
    $event_start_time = $row['start_time'];
    $event_end_time = $row['end_time'];
    $organized_by = $row['organized_by'];

    $venue_id = $row['venue_id'];
    $venue_title = $row['venue_title'];

    $order_id = $row['order_id'];
    $order_number = $row['order_number'];
    $order_status = $row['order_status'];
    $order_total_item = $row['order_total_item'];
    $order_payment_method = $row['payment_method'];
    $order_newtotal_price = $row['newtotal_price'];

    $ticket_quantity = $row['ticket_quantity'];
    $include_quantity = $row['include_quantity'];
    $totalTI = $row['ticket_quantity'] + $row['include_quantity'];
    $ticket_total_price = $row['ticket_total_price'];
    $include_total_price = $row['include_total_price'];
    $totalPrice = $row['ticket_total_price'] + $row['include_total_price'] + $row['order_shipment_charge'];
    $order_shipment_charge = $row['order_shipment_charge'];

    $category_title = $row['category_title'];

    $userName = $row['userName'];
    $UA_address = $row['UA_address'];
    $user_email = $row['user_email'];
    $user_phone = $row['user_phone'];
}
?>



<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    </head>



    <body>
<?php if ($status == 'paid') { ?>
    <!--        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <tbody><tr>
                        <td valign="top" align="center">
                            <span class="HOEnZb"><font color="#888888">
                                </font></span><span class="HOEnZb"><font color="#888888">
                                </font></span><table style="border:1px solid #e0e0e0" width="650" cellspacing="0" cellpadding="10" border="0" bgcolor="#FFFFFF">
                                <tbody><tr>
                                        <td class="m_3400397995181562166m_8401342642413116184m_-1842238349812301262ecxfirst" valign="top">
                                            <a href="http://www.ticketchai.com/ecf/" style="font-size:20px;color:#383838;text-decoration:none" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://www.ticketchai.com/ecf/&amp;source=gmail&amp;ust=1483683976103000&amp;usg=AFQjCNHETqB0NgE6JgwS4kig9BxItYzL0g"><img alt="" src="https://ci4.googleusercontent.com/proxy/absdeSPmXWRg05sP1aUhKio-VPCCUAgfo3sZ7BB4uTWXW0n1ofIKZ_O84FZYEq-1O_9JlYqXA65ozDbqje3foo_XyQ=s0-d-e1-ft#http://www.ticketchai.com/ticketchai_logo.png" class="CToWUd" border="0"></a>
                                            <span style="font-family:Arial_Rounded_MT_Bold">
                                                Hotline : +88 01971-Ticket (842538), <a href="tel:+880%201942-999666" value="+8801942999666" target="_blank">+8801942 999666</a> 
                                            </span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td valign="top">
                                            <h1 style="font-size:22px;font-weight:normal;line-height:22px">Hello, <?php //echo $user_name;  ?></h1>
                                            <p style="font-size:12px;line-height:16px">
                                                Thank you for your order from <a href="http://ticketchai.com" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://ticketchai.com&amp;source=gmail&amp;ust=1483683976103000&amp;usg=AFQjCNEn0Wp8DcP-jBhp1aRqvsQUfU6F5Q">ticketchai.com</a>.
                                                You can check the status of your order by visiting  your Dashboard.
                                                If you have any questions about your order please contact us at <a style="color:#1e7ec8" href="mailto:support@ticketchai.com" target="_blank">support@ticketchai.com</a> <br>or call us at <span class="m_3400397995181562166m_8401342642413116184m_-1842238349812301262nobr"> +88 01971-Ticket (842538), <a href="tel:+880%201942-999666" value="+8801942999666" target="_blank">+8801942 999666</a>  </span> Every Sat To Thurs, <span class="aBn" data-term="goog_5961152" tabindex="0"><span class="aQJ">10am - 8pm</span></span> BDT.
                                            </p><br>
                                            <p style="font-size:12px;line-height:16px">Your order confirmation is below. Thank you again for your Order.</p>
                                        </td></tr>
                                    <tr>
                                        <td>
                                            <h2 style="font-size:18px;font-weight:normal">Your Order <?php //echo $OI_number;  ?></h2>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table width="725" cellspacing="0" cellpadding="0" border="0">
                                                <thead>
                                                    <tr>
                                                        <th style="font-size:13px;padding:5px 9px 6px 9px;line-height:1em" width="325" bgcolor="#EAEAEA" align="left">Billing Information:</th>
                                                        <th width="10"></th>
                                                        <th style="font-size:13px;padding:5px 9px 6px 9px;line-height:1em" width="325" bgcolor="#EAEAEA" align="left">Payment Method:</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td style="font-size:12px;padding:7px 9px 9px 9px;border-left:1px solid #eaeaea;border-bottom:1px solid #eaeaea;border-right:1px solid #eaeaea" valign="top">
    <?php //echo $user_name."<br>";  ?>
                                                            Phone:<?php //echo $user_phone."<br>";  ?>
                                                            City:<br>
                                                            Zip:<br>
                                                            Address:

                                                        </td>
                                                        <td>&nbsp;</td>
                                                        <td style="font-size:12px;padding:7px 9px 9px 9px;border-left:1px solid #eaeaea;border-bottom:1px solid #eaeaea;border-right:1px solid #eaeaea" valign="top">
                                                            <b><?php //echo $payment_method;  ?></b><br>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <br>
                                            <table width="725" cellspacing="0" cellpadding="0" border="0">
                                                <thead>
                                                    <tr>
                                                        <th style="font-size:13px;padding:5px 9px 6px 9px;line-height:1em" width="325" bgcolor="#EAEAEA" align="left">Shipping Information:</th>
                                                        <th width="10"></th>
                                                        <th style="font-size:13px;padding:5px 9px 6px 9px;line-height:1em" width="325" bgcolor="#EAEAEA" align="left">Shipping Method:</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td style="font-size:12px;padding:7px 9px 9px 9px;border-left:1px solid #eaeaea;border-bottom:1px solid #eaeaea;border-right:1px solid #eaeaea" valign="top">
    <?php // echo $user_name."<br>";  ?>
                                                            Phone:<?php //echo $user_phone."<br>";  ?>
                                                            City:<br>
                                                            Zip:<br>
                                                            Address:

                                                        </td>

                                                        <td>&nbsp;</td>
                                                        <td style="font-size:12px;padding:7px 9px 9px 9px;border-left:1px solid #eaeaea;border-bottom:1px solid #eaeaea;border-right:1px solid #eaeaea" valign="top">
                                                            <b><?php //echo $payment_method."<br>";  ?>
                                                            &nbsp;
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <br>
                                            <table style="border:1px solid #eaeaea" width="725" cellspacing="0" cellpadding="0" border="0">
                                                <thead>
                                                    <tr>
                                                        <th style="font-size:13px;padding:3px 9px" bgcolor="#EAEAEA" align="left">E-Ticket No</th>

                                                        <th style="font-size:13px;padding:3px 9px" bgcolor="#EAEAEA" align="left">Ticket Quantity</th>
                                                        <th style="font-size:13px;padding:3px 9px" bgcolor="#EAEAEA" align="right">Total Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td style="font-size:11px;padding:3px 9px;border-bottom:1px dotted #cccccc" valign="top" align="left">
                                                            <span><?php // echo $OI_id;  ?></span>
                                                        </td>

                                                        <td style="font-size:11px;padding:3px 9px;border-bottom:1px dotted #cccccc" valign="top" align="left"><span><?php //echo $total_item;  ?></span></td>
                                                        <td style="font-size:11px;padding:3px 9px;border-bottom:1px dotted #cccccc" valign="top" align="right"><span><?php //echo $t_A;  ?></span></td>
                                                    </tr>
                                                </tbody>
                                                <tbody>
                                                    <tr class="m_3400397995181562166m_8401342642413116184m_-1842238349812301262ecxsubtotal">
                                                        <td> </td>
                                                        <td style="padding:3px 9px" colspan="2" align="right">
                                                            Subtotal                    </td>
                                                        <td style="padding:3px 9px" align="right">
                                                            <span class="m_3400397995181562166m_8401342642413116184m_-1842238349812301262ecxprice"><?php // echo $t_A;  ?></span>                    </td>
                                                    </tr>


                                                    <tr class="m_3400397995181562166m_8401342642413116184m_-1842238349812301262ecxgrand_total">
                                                        <td> </td>
                                                        <td style="padding:3px 9px" colspan="2" align="right">
                                                            <b>Grand Total</b>
                                                        </td>
                                                        <td style="padding:3px 9px" align="right">
                                                            <b><span class="m_3400397995181562166m_8401342642413116184m_-1842238349812301262ecxprice"><?php //echo $t_A;  ?></span></b>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <p style="font-size:12px"></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="m_3400397995181562166m_8401342642413116184m_-1842238349812301262ecxlast" bgcolor="#FFFFFF" align="center"><center><p style="font-size:12px">&copy; 2016 <a href="http://ticketchai.com" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://ticketchai.com&amp;source=gmail&amp;ust=1483683976103000&amp;usg=AFQjCNEn0Wp8DcP-jBhp1aRqvsQUfU6F5Q">ticketchai.com</a> Ltd. All Rights Reserved</p></center></td></tr></tbody></table><span class="HOEnZb"><font color="#888888">
                </font></span></td></tr></tbody></table> -->
    <?php
    echo ' 
            <div>
                <h5 style="background: #A9D95E none repeat scroll 0 0;color: black;font-size: 14px;margin: 26px auto 13px;padding: 3px;
                            text-align: center;width: 92%;">Please print and bring this ticket with you</h5>
            </div>                          

            <table border="1" border-collapse:"collapse" cellspacing="0" width="100%" style="margin:0px auto;border-collapse: collapse;border-spacing: 0px;">
                
                <tbody>
                
                        <tr border="1">
                            <td style="padding-left:1%;">EVENT TITLE</td>
                            <td colspan="2" style="padding-left:1%;">
                                ' . "$event_title" . '
                            </td>
                            <td rowspan="5" style="text-align: center;padding:1%;">
                                <img style="max-height:80px;max-width:100px" src="../../upload/event_web_logo/' . "$event_logo" . '">
                            </td>
                        </tr>
                        
                        <tr border="1">
                           <td style="padding-left:1%;">VENUE</td>
                           <td colspan="2" style="padding-left:1%;">
                               ' . "$venue_title" . ' 
                            </td>
                        </tr>
                        
                        <tr border="1">
                           <td style="padding-left:1%;">DELIVERY METHOD:</td>
                           <td colspan="2" style="padding-left:1%;">
                               ' . "$order_payment_method" . ' 
                            </td>
                        </tr>
                        
                        <tr border="1">
                           <td style="padding-left:1%;">CATAGORY:</td>
                           <td colspan="2" style="padding-left:1%;">
                               ' . "$category_title" . ' 
                            </td>
                        </tr>
                        
                        <tr border="1">
                           <td style="padding-left:1%;">Order Number:</td>
                           <td colspan="2" style="padding-left:1%;">
                               ' . "$order_number" .' 
                            </td>
                        </tr>
                        
                        <tr border="1">
                            <td colspan="2" style="text-align: center;padding-left:1%;line-height: 25px;max-width:100%;">
                                    <div class="barcodecell" style="margin:0 auto;text-align:center;">
                                        <barcode code=" ' . "$base_code" . '" type="c93" text="1" />
                                    </div>
                            </td>
                            <td colspan="2" style="padding-left:1%;line-height: 5px;max-width:100%;">
                                 <h5 style="text-align: center;">Schedule</h5>
                                 <p>' . $event_start_date . ',' . $event_start_time . '-' . $event_end_time . '</p>
                                 <p>' . $event_end_date . ',' . $event_start_time . '-' . $event_end_time . '</p>
                            </td>
                        </tr>
                        
                        <tr border="1">
                               <td colspan="4" style="text-align: center;">
                                 <p>' . $userName . '</p>
                               </td>
                        </tr>
                        
                        <tr border="1">
                            <td colspan="2" style="padding-left:1%;line-height: 5px;max-width:100%;">
                            
                                <h5 style="text-align: center;">CUSTOMER INFO</h5>
                                
                                <div style="width:30%;float:left;height:35px;">
                                    <p>Address:</p>
                                </div>
                                <div style="width:70%;float:right;height:35px;">
                                    <p>
                                        ' . "$UA_address" . '
                                    </p>
                                </div>
                                <div style="width:30%;float:left;height:35px;">
                                    <p>Email:</p>
                                </div>
                                <div style="width:70%;float:right;height:35px;">
                                    <p>
                                        ' . "$user_email" . '
                                    </p>
                                </div>
                                <div style="width:30%;float:left;height:35px;">
                                    <p>Phone:</p>
                                </div>
                                <div style="width:70%;float:right;height:35px;">
                                    <p>
                                        ' . "$user_phone" . '
                                    </p>
                                </div>

                            </td>
                            <td colspan="2" style="padding-left:1%;line-height: 5px;max-width:100%;">
                               <h5 style="text-align: center;">TICKET DETAILS (BDT)</h5>
                                <div style="width:70%;float:left;height:35px;">
                                    <p>Ticket Qty:</p>
                                </div>
                                <div style="width:30%;float:right;height:35px;">
                                    <p>
                                        ' . "$totalTI" . '
                                    </p>
                                </div>
                                <div style="width:70%;float:left;height:35px;">
                                    <p>Ticket Price:</p>
                                </div>
                                <div style="width:30%;float:right;height:35px;">
                                    <p>
                                        ' . "$ticket_total_price" . '
                                    </p>
                                </div>
                                <div style="width:70%;float:left;height:35px;">
                                    <p>Include Price:</p>
                                </div>
                                <div style="width:30%;float:right;height:35px;">
                                    <p>
                                        ' . "$include_total_price" . '
                                    </p>
                                </div>
                                <div style="width:70%;float:left;height:35px;">
                                    <p>Shipment/Delivery Cost:</p>
                                </div>
                                <div style="width:30%;float:right;height:35px;">
                                    <p>
                                        ' . "$order_shipment_charge" . '
                                    </p>
                                </div>
                                <div style="width:70%;float:left;height:35px;">
                                    <p>Total Price:</p>
                                </div>
                                <div style="width:30%;float:right;height:35px;">
                                    <p>
                                        ' . "$totalPrice" . '
                                    </p>
                                </div>
                            </td>
                        </tr>
                        
                        <tr border="1">
                               
                               <td colspan="4" style="padding-left:1%;line-height: 5px;max-width:100%;">
                                  <h5 style="">TERMS & CONDITIONS</h5>
                                  <p>' . $event_terms_conditions . '</p>
                               </td>
                        </tr>
                        
                        <tr border="1">
                               <td colspan="4" style="text-align: center;">
                                 <p>PARTNERS</p>
                                 <img/>
                               </td>
                        </tr>
                    

                </tbody>
            </table>
                           ';
    ?>
            <?php
        } else {
            ?>
        <tr>
            <td valign="top">
                <h1 style="font-size:22px;font-weight:normal;line-height:22px;">Hello<?php echo $user_name; ?>,</h1>        
                <p style="font-size:15px;line-height:16px;">
                    Thank you for using ticketchai.com, Your ticket has been canceled due to payment.please try again before end-up your event schedule.
                </p>
            </td>
        </tr>
    <?php
}
?>

</body>
</html>