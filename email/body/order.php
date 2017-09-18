<?php
require_once '../../DBconnection/database_connections.php';
//require_once('phpmailer/class.phpmailer.php');
$status = $_GET['order_status'];
$orderID = $_GET['oid'];
$o_s_id = $_GET['order_session'];

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



<html>
    <body>
        <table width="100%" cellspacing="0" cellpadding="0" border="0">

            <tbody>
                <tr>
                    <td valign="top" align="center">
                        <span class="HOEnZb">
                            <font color="#888888"></font>
                        </span>
                        <span class="HOEnZb">
                            <font color="#888888"></font>
                        </span>
                        <table style="border:1px solid #88C659; border-radius: 4px; font-family:arial;" width="650" cellspacing="0" cellpadding="10" border="0" bgcolor="#FFFFFF">
                            <tbody>
                                <tr style="background:#88C659;">
                                    <td class="m_3400397995181562166m_8401342642413116184m_-1842238349812301262ecxfirst" valign="top" style="text-align:center; padding-top: 50px; padding-bottom: 50px;">
                                        <a href="http://www.ticketchai.com/ticketchaiorg/index.php" style="font-size:20px;color:#383838;text-decoration:none" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://www.ticketchai.com/ecf/&amp;source=gmail&amp;ust=1483683976103000&amp;usg=AFQjCNHETqB0NgE6JgwS4kig9BxItYzL0g">
                                            <img alt="" src="http://ticketchai.com/ticketchaiorg/tc-merchant-template/assets/img/white-shadow-logo.png" class="x_CToWUd" border="0"/>
                                        </a>
                                        <br><br>
                                        <span style="font-family:arial; color:#FFF; font-weight: bold; text-decoration: none;">
                                            Hotline : +88 01971-Ticket (842538), +8801942 999666
                                        </span>
                                    </td>
                                </tr>



                            <body>
                                <?php
                                if ($status == 'paid') {


                                    echo '  
                                        
                                                <tr>
                                                    <td valign="top">
                                                        <h1 style="font-size:22px;font-weight:normal;line-height:22px">Hello ' . $userName . ',</h1>
                                                        <p style="font-weight:bold; font-size:12px; color:#202120;line-height:25px">
                                                            <span style="font-weight:bold; font-size:16px; color:#4585F3;line-height:25px">Thank you for order submit</span>
                                                            <br/>
                                                            You can check the status of your order by visiting  your Dashboard.
                                                            If you have any questions about your order please contact us at <a style="color:#1e7ec8" href="mailto:support@ticketchai.com" target="_blank">support@ticketchai.com</a> or call us at <span class="m_3400397995181562166m_8401342642413116184m_-1842238349812301262nobr"> +88 01971-Ticket (842538), <a href="tel:+880%201942-999666" value="+8801942999666" target="_blank">+8801942 999666</a>  </span> Every Sat To Thurs, <span class="aBn" data-term="goog_5961152" tabindex="0"><span class="aQJ">10am - 6pm</span></span> BDT.
                                                        </p>
                                                        <br>
                                                        <p style="font-weight:bold; font-size:16px; color:#4585F3;line-height:25px">Your Order details are as follows:</p>
                                                    </td>
                                                </tr>    
                                                
                                                <tr>
                                                    <td>
                                                        <h2 style="font-size:18px;font-weight:normal">Your Order ID : ' . "$order_number" . ' </h2>
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td>
                                                        <table style="border:1px solid #eaeaea" width="725" cellspacing="0" cellpadding="0" border="0">
                                                            <thead>
                                                                <tr>
                                                                    <th style="font-size:13px;padding:3px 9px" bgcolor="#EAEAEA" align="left">Ticket Payment method</th>

                                                                    <th style="font-size:13px;padding:3px 9px" bgcolor="#EAEAEA" align="center">Ticket Quantity</th>
                                                                    <th style="font-size:13px;padding:3px 9px" bgcolor="#EAEAEA" align="center">Total Price</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td style="font-size:11px;padding:3px 9px;border-bottom:1px dotted #cccccc" valign="top" align="left">
                                                                        <span> ' . "$order_payment_method" . ' </span>
                                                                    </td>

                                                                    <td style="font-size:11px;padding:3px 9px;border-bottom:1px dotted #cccccc" valign="top" align="center"><span> '."$totalTI".' </span></td>
                                                                    <td style="font-size:11px;padding:3px 9px;border-bottom:1px dotted #cccccc" valign="top" align="center"><span>  '."$ticket_total_price".'  </span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td> </td>

                                                                    <td style="font-size:11px;padding:3px 9px;border-bottom:1px dotted #cccccc" valign="top" align="right"><b>Grand Total =</b></td>
                                                                    <td style="font-size:11px;padding:3px 9px;border-bottom:1px dotted #cccccc" valign="top" align="center"><b><span class="m_3400397995181562166m_8401342642413116184m_-1842238349812301262ecxprice"> '."$totalPrice".' </span></b></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                

                                                <tr>
                                                    <td>
                                                        <table width="725" cellspacing="0" cellpadding="0" border="0">
                                                            <thead>
                                                                <tr>
                                                                    <th style="font-size:13px;padding:5px 9px 6px 9px;line-height:1em" bgcolor="#EAEAEA" align="left">Event Details:</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td style="font-size:12px;padding:7px 9px 9px 9px;border-left:1px solid #eaeaea;border-bottom:1px solid #eaeaea;border-right:1px solid #eaeaea" valign="top">
                                                                        <span style="font-weight:bold; font-size:16px; color:#4585F3;line-height:30px; padding: 5px;">
                                                                            <img src="http://ticketchai.com/ticketchaiorg/email/icons/event_name.png" alt="" style="height: 16px; width: 16px; margin-right: 15px;" />
                                                                            Event Name:</span> <span style="font-size: 16px; font-weight: bold;">'."$event_title".'</span> <br>
                                                                        <span style="font-weight:bold; font-size:16px; color:#4585F3;line-height:30px; padding: 5px;">
                                                                            <img src="http://ticketchai.com/ticketchaiorg/email/icons/1491217865_map-marker.png" alt="" style="height: 16px; width: 16px; margin-right: 15px" />
                                                                            Event Venue:</span> <span style="font-size: 13px; font-weight: bold;"> '."$venue_title".' </span><br>
                                                                        <span style="font-weight:bold; font-size:16px; color:#4585F3;line-height:30px; padding: 5px;">
                                                                            <img src="http://ticketchai.com/ticketchaiorg/email/icons/1491217836_calendar-clock.png" alt="" style="height: 16px; width: 16px; margin-right: 15px;" />Event Schedule:</span> <span style="font-size: 13px; font-weight: bold;"> From: ' . $event_start_date . ', ' . $event_start_time . ' To: ' . $event_end_date . ', ' . $event_end_time . '</span>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br>

                                                        <table width="725" cellspacing="0" cellpadding="0" border="0">
                                                            <thead>
                                                                <tr>
                                                                    <th style="font-size:13px;padding:5px 9px 6px 9px;line-height:1em" width="325" bgcolor="#EAEAEA" align="left">Your Information:</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td style="font-size:12px;padding:7px 9px 9px 9px;border-left:1px solid #eaeaea;border-bottom:1px solid #eaeaea;border-right:1px solid #eaeaea" valign="top">
                                                                        <span style="font-weight:bold; font-size:16px; color:#4585F3;line-height:30px; padding: 5px;">
                                                                            <img src="http://ticketchai.com/ticketchaiorg/email/icons/1491217822_user.png" alt="" style="height: 16px; width: 16px; margin-right: 15px;" />
                                                                            Name:</span> <span style="font-size: 13px; font-weight: bold;">' . $userName . '</span><br>
                                                                        <span style="font-weight:bold; font-size:16px; color:#4585F3;line-height:30px; padding: 5px;">
                                                                            <img src="http://ticketchai.com/ticketchaiorg/email/icons/1491217667_mail-icon.png" alt="" style="height: 16px; width: 16px; margin-right: 15px;" />
                                                                            Email:</span> <span style="font-size: 13px; font-weight: bold;">' . "$user_email" . '</span><br>
                                                                        <span style="font-weight:bold; font-size:16px; color:#4585F3;line-height:30px; padding: 5px;">
                                                                            <img src="http://ticketchai.com/ticketchaiorg/email/icons/1491217721_phone.png" alt="" style="height: 16px; width: 16px; margin-right: 15px;" />
                                                                            Phone:</span> <span style="font-size: 13px; font-weight: bold;">' . "$user_phone" . '</span>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <th style="font-size:16px;padding:12px 9px;font-weight:bold;color:#4585F3;" align="center">Terms & conditions</th>
                                                                </tr>

                                                                <tr>
                                                                    <th style="font-size:12px;padding:6px 9px; text-align: justify;" align="center"><p>' . $event_terms_conditions . '</p></th>
                                                                </tr>


                                                            </tbody>
                                                        </table>
                                                        <br>



                                                        <p style="font:14px Helvetica Neue,Helvetica,Arial,sans-serif;font-weight:bold; text-align:center; margin:10px 0 10px 0;padding:10px 0 0 0;color:#000000">Thank You For Choosing Ticketchai.com</p>
                                                    </td>
                                                </tr>

                                         ';


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

                            <tr style="background:#88C659;">
                                    <td class="m_3400397995181562166m_8401342642413116184m_-1842238349812301262ecxlast" align="center">
										<center>
											<p style="font-size:14px; color:#FFF; font-weight: bold;">Copyright &copy;  <?php echo date('Y');?> <a style="color:#ffffff" href="http://ticketchai.com" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://ticketchai.com&amp;source=gmail&amp;ust=1483683976103000&amp;usg=AFQjCNEn0Wp8DcP-jBhp1aRqvsQUfU6F5Q">ticketchai.com</a> Ltd. All Rights Reserved</p>
										</center>
                                    </td>
                                </tr>
						</tbody>
					</table>
					<span class="HOEnZb">
						<font color="#888888"></font>
					</span>
				</td>
			</tr>
			</tbody>
			</table>
			</body>


			</html>