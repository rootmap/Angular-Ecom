<?php

require_once '../DBconnection/database_connections.php';
require_once('phpmailer/class.phpmailer.php');
include 'mail_helper_functions.php';
date_default_timezone_set('Asia/Dhaka');
$data = json_decode(file_get_contents("php://input"));
$cur_year = date("Y");
@$eventId = $data->e_id;

//echo $o_session_id = base64_decode($data->o_id);
 $o_session_id = $data->o_u_id;
echo $order_id=$data->o_id;
//echo $o_session_id = session_id();
//echo $sessionidn = $_GET['o_id'];

 
// SELECT 
//oe.`OE_order_id`,
//oe.`OE_user_id`,
//o.`order_number`,
//o.`order_total_item`,
//o.`order_payment_type`,
//o.`order_billing_phone`,
//u.`user_email`,
//u.`user_id`,
//u.`user_first_name`
//
//FROM `order_events` AS oe 
//LEFT JOIN `orders` As o ON oe.`OE_order_id`=o.order_id
//LEFT JOIN `users` As u ON oe.`OE_user_id`=u.user_id
//
//WHERE OE_user_id='$o_session_id'
 

 $orderSql = "SELECT oe.`OE_order_id`,
oe.`OE_user_id`,
o.`order_number`,
o.`order_total_item`,
o.`order_total_amount`,
o.`order_payment_type`,
o.`order_billing_phone`,
u.`user_email`,
u.`user_name`,
u.`user_phone`,
ad.admin_full_name,
e.event_title,
ev.venue_title,
ev.city, ev.country,
ev.venue_address,
DATE_FORMAT(ev.`venue_start_date`,'%D, %M %Y') AS venue_start_date, 
TIME_FORMAT(ev.`venue_start_time`, '%h:%i%p') AS venue_start_time, 
DATE_FORMAT(ev.`venue_end_date`,'%D, %M %Y') AS venue_end_date, 
TIME_FORMAT(ev.`venue_end_time`, '%h:%i%p') AS venue_end_time

FROM `order_events` AS oe 
LEFT JOIN `orders` As o ON oe.`OE_order_id`=o.order_id 
LEFT JOIN `temp_billing` As u ON oe.`OE_user_id`=u.user_id 
LEFT JOIN events AS e ON e.event_id = oe.`OE_event_id` 
LEFT JOIN event_venues AS ev ON ev.venue_event_id = e.event_id 
LEFT JOIN admins AS ad ON ad.admin_id = e.event_created_by 
WHERE  `OE_user_id`='$o_session_id' AND u.order_id='$order_id'ORDER BY oe.`OE_order_id` DESC LIMIT 1
";

//`OE_event_id`='$eventId'  AND
$result = mysqli_query($con, $orderSql);

$row = mysqli_fetch_array($result);
//print_r($row);
$OI_id = $row['OE_order_id'];
$OI_number = $row['order_number'];
$payment_method = $row['order_payment_type'];
$user_email = $row['user_email'];
$total_item = $row['order_total_item'];
$ticket_price = $row['order_total_amount'];
$user_name = $row['user_name'];
$user_phone = $row['user_phone'];
$organizer = $row['admin_full_name'];
$event_name = $row['event_title'];
$event_venue = $row['venue_title'].', '.$row['city'].', '.$row['country'];

$event_starts = $row['venue_start_date'] .', '. $row['venue_start_time'];
$event_ends =  $row['venue_end_date'] .', '. $row['venue_end_time'];
/*$event_stdttime = $row['event_created_on'];
$event_starts = date('l, jS F, Y, g:i', strtotime($event_stdttime)); //a
$event_endttime = $row['event_created_end'];
$event_ends = date('l, jS F, Y, g:i', strtotime($event_endttime)); //a*/

$t_A = $ticket_price*$total_item;
//exit();
$html = '  
         
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

                                <tr>
                                    <td valign="top">
                                        <h1 style="font-size:22px;font-weight:normal;line-height:22px">Hello, ' . "$user_name" . '</h1>
                                        <p style="font-weight:bold; font-size:14px; color:#202120;line-height:25px">
                                            <span style="font-weight:bold; font-size:16px; color:#4585F3;line-height:25px">Thank you for purchasing  '."$total_item".' Ticket(s) for '."$event_name".'.</span>
                                            <br/>
                                            You can check the status of your order by visiting  your Dashboard.
                                            If you have any questions about your order please contact us at <a style="color:#1e7ec8" href="mailto:support@ticketchai.com" target="_blank">support@ticketchai.com</a> or call us at <span class="m_3400397995181562166m_8401342642413116184m_-1842238349812301262nobr"> +88 01971-Ticket (842538), <a href="tel:+880%201942-999666" value="+8801942999666" target="_blank">+8801942 999666</a>  </span> Every Sat To Thurs, <span class="aBn" data-term="goog_5961152" tabindex="0"><span class="aQJ">10am - 6pm</span></span> BDT.
                                        </p>
                                        <br>
                                        <p style="font-weight:bold; font-size:16px; color:#4585F3;line-height:25px">Your Registration details are as follows:</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h2 style="font-size:18px;font-weight:normal">Your Order ID' . "$OI_number" . '</h2>
                                    </td>
                                <tr/>
                                <tr>
                                    <td>
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
                                                        <span>' . "$OI_id" . '</span>
                                                    </td>

                                                    <td style="font-size:11px;padding:3px 9px;border-bottom:1px dotted #cccccc" valign="top" align="left"><span>' . "$total_item" . '</span></td>
                                                    <td style="font-size:11px;padding:3px 9px;border-bottom:1px dotted #cccccc" valign="top" align="right"><span>' . "$t_A" . '</span></td>
                                                </tr>
                                            </tbody>
                                            <tbody>
                                                <tr class="m_3400397995181562166m_8401342642413116184m_-1842238349812301262ecxsubtotal">
                                                    <td> </td>
                                                    <td style="padding:3px 9px" colspan="2" align="right">
                                                        Subtotal                    
                                                    </td>
                                                    <td style="padding:3px 9px" align="right">
                                                        <span class="m_3400397995181562166m_8401342642413116184m_-1842238349812301262ecxprice">' . "$t_A" . '</span>                    
                                                    </td>
                                                </tr>


                                                <tr class="m_3400397995181562166m_8401342642413116184m_-1842238349812301262ecxgrand_total">
                                                    <td> </td>
                                                    <td style="padding:3px 9px" colspan="2" align="right">
                                                        <b>Grand Total</b>
                                                    </td>
                                                    <td style="padding:3px 9px" align="right">
                                                        <b><span class="m_3400397995181562166m_8401342642413116184m_-1842238349812301262ecxprice">' . "$t_A" . '</span></b>
                                                    </td>
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
                                                    <th style="font-size:13px;padding:5px 9px 6px 9px;line-height:1em" width="325" bgcolor="#EAEAEA" align="left">Your Information:</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="font-size:12px;padding:7px 9px 9px 9px;border-left:1px solid #eaeaea;border-bottom:1px solid #eaeaea;border-right:1px solid #eaeaea" valign="top">
                                                        <span style="font-weight:bold; font-size:16px; color:#4585F3;line-height:30px; padding: 5px;">
                                                            <img src="http://ticketchai.com/ticketchaiorg/merchant-dashboard/email/img/1491217822_user.png" alt="" style="height: 16px; width: 16px; margin-right: 15px;" />
                                                            Name:</span> ' . "$user_name" . '<br>
                                                        <span style="font-weight:bold; font-size:16px; color:#4585F3;line-height:30px; padding: 5px;">
                                                            <img src="http://ticketchai.com/ticketchaiorg/merchant-dashboard/email/img/1491217667_mail-icon.png" alt="" style="height: 16px; width: 16px; margin-right: 15px;" />
                                                            Email:</span> ' . "$user_email" . '<br>
                                                        <span style="font-weight:bold; font-size:16px; color:#4585F3;line-height:30px; padding: 5px;">
                                                            <img src="http://ticketchai.com/ticketchaiorg/merchant-dashboard/email/img/1491217721_phone.png" alt="" style="height: 16px; width: 16px; margin-right: 15px;" />
                                                            Phone:</span> ' . "$user_phone" . '
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <br>
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
                                                            <img src="http://ticketchai.com/ticketchaiorg/merchant-dashboard/email/img/boss.png" alt="" style="height: 16px; width: 16px; margin-right: 15px;" />
                                                            Organizer:</span> ' . "$organizer" . '<br>
                                                        <span style="font-weight:bold; font-size:16px; color:#4585F3;line-height:30px; padding: 5px;">
                                                            <img src="http://ticketchai.com/ticketchaiorg/merchant-dashboard/email/img/1491217865_map-marker.png" alt="" style="height: 16px; width: 16px; margin-right: 15px" />
                                                            Venue:</span> ' . "$event_venue" . '<br>
                                                        <span style="font-weight:bold; font-size:16px; color:#4585F3;line-height:30px; padding: 5px;">
                                                            <img src="http://ticketchai.com/ticketchaiorg/merchant-dashboard/email/img/1491217836_calendar-clock.png" alt="" style="height: 16px; width: 16px; margin-right: 15px;" />Event Schedule:</span> ' ."$event_starts".' To ' ."$event_ends".'
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <br>

                                        <p style="font:14px Helvetica Neue,Helvetica,Arial,sans-serif;font-weight:bold; text-align:center; margin:10px 0 10px 0;padding:10px 0 0 0;color:#000000">Thank You For Choosing Ticketchai.com</p>
                                    </td>
                                </tr>
                                <tr style="background:#88C659;">
                                    <td class="m_3400397995181562166m_8401342642413116184m_-1842238349812301262ecxlast" align="center">
                            <center>
                                <p style="font-size:14px; color:#FFF; font-weight: bold;">Copyright &copy;  '.$cur_year.' <a href="http://ticketchai.com" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://ticketchai.com&amp;source=gmail&amp;ust=1483683976103000&amp;usg=AFQjCNEn0Wp8DcP-jBhp1aRqvsQUfU6F5Q">ticketchai.com</a> Ltd. All Rights Reserved</p>
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

            ';

$sub = 'Order submit';
// smtpmailer('to@gmail.com', 'from@gmail.com', $name, $sub,"$html");
echo smtpmailer($user_email, 'support@ticketchai.com', $sub, 'Order Submit', $html);
//echo $user_email;
exit();
//session_right_close();
//support@ticketchai.com
?>