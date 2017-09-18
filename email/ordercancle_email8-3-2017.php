<?php

require_once '../DBconnection/database_connections.php';
require_once('phpmailer/class.phpmailer.php');
include 'mail_helper_functions.php';

$data = json_decode(file_get_contents("php://input"));

$o_session_id = $data->osessionId;
//echo $o_id =$data->order_id;
//echo $orderSql = "SELECT 
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
//WHERE  `OE_session_id`='$o_session_id' ORDER BY DESC LIMIT 1
//";

$result = mysqli_query($con, "SELECT 
oe.`OE_order_id`,
oe.`OE_user_id`,
o.`order_number`,
o.`order_total_item`,
o.`order_total_amount`,
o.`order_payment_type`,
o.`order_billing_phone`,
u.`user_email`,
u.`user_first_name`,
o.`order_status`
FROM `order_events` AS oe 
LEFT JOIN `orders` As o ON oe.`OE_order_id`=o.order_id
LEFT JOIN `users` As u ON oe.`OE_user_id`=u.user_id
WHERE  `OE_session_id`='$o_session_id' GROUP BY o.order_id ORDER BY oe.`OE_order_id` DESC");

$row = mysqli_fetch_array($result);
//print_r($row);

$OI_id = $row['OE_order_id'];
$OI_number = $row['order_number'];
$payment_method = $row['order_payment_type'];
$user_email = $row['user_email'];
$total_item = $row['order_total_item'];
$user_name = $row['user_first_name'];
$user_phone = $row['order_billing_phone'];
$order_status = $row['order_status'];
$t_A = $row['order_total_amount'];
$mailodst = false;
if ($order_status == "paid" || $order_status == "free" || $order_status == "free & paid") {
    $odst = "Successful";
    $attachmentpdfcore = file_get_contents('http://ticketchai.org/user_dashboard/download-ticket_in_dir.php?oid=' . $OI_id . "&quantity=1");
    $attachmentpdf = "../pdf/" . $attachmentpdfcore;
    $mailodst = true;
} elseif ($order_status == "pending" || $order_status == "booking") {
    $odst = " Pending.";
} elseif ($order_status == "approved") {
    $odst = " Confirmed.";
} else {
    $odst = "Cancel";
}

$order_subject_email = 'Order ' . $odst;
$cancleHtml = '
<html>
    
    
        <body>
		<table width="100%" cellspacing="0" cellpadding="0" border="0">
		<tbody>
<tr>
        <td valign="top">
            <h1 style="font-size:22px;font-weight:normal;line-height:22px;">Hello <?php echo  ' . "$user_name" . '; ?>,</h1>        
            <p style="font-size:15px;line-height:16px;">
                Thank you for using ticketchai.com, Your ticket has been canceled due to payment.please try again before end-up your event schedule.
            </p>
        </td>
    </tr>
	</tbody>
	</table>
    
    
        </body>
		</html>
';
$html = '<html>
    
    
        <body>
            <table width="100%" cellspacing="0" cellpadding="0" border="0">

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
                                <h1 style="font-size:22px;font-weight:normal;line-height:22px"> ' . "$user_name" . ',your order was ' . $odst . '!</h1>
                                <h1 style="font-size:22px;font-weight:normal;line-height:22px">Hello, ' . "$user_name" . '</h1>
                                <p style="font-size:12px;line-height:16px">
                                    Thank you for your order from <a href="http://ticketchai.com" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://ticketchai.com&amp;source=gmail&amp;ust=1483683976103000&amp;usg=AFQjCNEn0Wp8DcP-jBhp1aRqvsQUfU6F5Q">ticketchai.com</a>.
                                    You can check the status of your order by visiting  your Dashboard.
                                    If you have any questions about your order please contact us at <a style="color:#1e7ec8" href="mailto:support@ticketchai.com" target="_blank">support@ticketchai.com</a> <br>or call us at <span class="m_3400397995181562166m_8401342642413116184m_-1842238349812301262nobr"> +88 01971-Ticket (842538), <a href="tel:+880%201942-999666" value="+8801942999666" target="_blank">+8801942 999666</a>  </span> Every Sat To Thurs, <span class="aBn" data-term="goog_5961152" tabindex="0"><span class="aQJ">10am - 8pm</span></span> BDT.
                                </p><br>
                                <p style="font-size:12px;line-height:16px">Your order confirmation is below. Thank you again for your Order.</p>
                            </td></tr>
                        <tr>
                            <td>
                                <h2 style="font-size:18px;font-weight:normal">Your Order ' . "$OI_number" . '</h2>
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
                                                ' . "$user_name" . '<br>
                                                Phone:' . "$user_phone" . '<br>
                                                City:<br>
                                                Zip:<br>
                                                Address:

                                            </td>
                                            <td>&nbsp;</td>
                                            <td style="font-size:12px;padding:7px 9px 9px 9px;border-left:1px solid #eaeaea;border-bottom:1px solid #eaeaea;border-right:1px solid #eaeaea" valign="top">
                                                <b>' . "$payment_method" . '</b><br>
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
                                               ' . "$user_name" . '<br>
                                                Phone:' . "$user_phone" . '<br>
                                                City:<br>
                                                Zip:<br>
                                                Address:

                                            </td>
                                            
                                            <td>&nbsp;</td>
                                            <td style="font-size:12px;padding:7px 9px 9px 9px;border-left:1px solid #eaeaea;border-bottom:1px solid #eaeaea;border-right:1px solid #eaeaea" valign="top">
                                                <b>' . "$payment_method" . '</b><br>
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
                                                Subtotal                    </td>
                                            <td style="padding:3px 9px" align="right">
                                                <span class="m_3400397995181562166m_8401342642413116184m_-1842238349812301262ecxprice">' . "$t_A" . '</span>                    </td>
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
                                <p style="font-size:12px"></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="m_3400397995181562166m_8401342642413116184m_-1842238349812301262ecxlast" bgcolor="#FFFFFF" align="center"><center><p style="font-size:12px">&copy; 2016 <a href="http://ticketchai.com" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://ticketchai.com&amp;source=gmail&amp;ust=1483683976103000&amp;usg=AFQjCNEn0Wp8DcP-jBhp1aRqvsQUfU6F5Q">ticketchai.com</a> Ltd. All Rights Reserved</p></center></td></tr></tbody></table><span class="HOEnZb"><font color="#888888">
</font></span></td></tr></tbody></table>
        </body>


    </html>';


// smtpmailer('to@gmail.com', 'from@gmail.com', $name, $sub,"$html");

if (!empty($OI_id)) {
    if ($mailodst == true) {
        echo smtpmailer($user_email, 'support@ticketchai.com', "Ticketchai", $order_subject_email, "$html", $attachmentpdf);

        //echo 1;
    } else {
        echo smtpmailer($user_email, 'support@ticketchai.com', "Ticketchai", "Event order cancel", "$cancleHtml");
        //echo 2;
    }

    //  echo $user_email;
    exit();
} else {
    echo 'query fail!';
    exit();
}
?>