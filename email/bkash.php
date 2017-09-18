

<?php
include './cms/plugin.php';
$cms = new plugin();

require_once '../DBconnection/database_connections.php';
require_once('phpmailer/class.phpmailer.php');
include 'mail_helper_functions.php';

$data = json_decode(file_get_contents("php://input"));

@$eventId = $data->e_id;
$t_A = base64_decode($data->total);
//echo $o_session_id = base64_decode($data->o_id);
$o_session_id = $_GET['userid'];

$orderSql = " 
SELECT 
oe.`OE_order_id`,
oe.`OE_user_id`,
o.`order_number`,
o.`order_total_item`,
o.`order_total_amount`,
o.`order_payment_type`,
o.`order_billing_phone`,
u.`user_email`,
u.`user_first_name`

FROM `order_events` AS oe 
LEFT JOIN `orders` As o ON oe.`OE_order_id`=o.order_id
LEFT JOIN `users` As u ON oe.`OE_user_id`=u.user_id
WHERE  `OE_user_id`='$o_session_id' ORDER BY oe.`OE_order_id` DESC LIMIT 1
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
$user_name = $row['user_first_name'];
$user_phone = $row['order_billing_phone'];
//exit();

$cur_year = date('Y');

$html =  ' 
     
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
                                        <h1 style="font-size:22px;font-weight:normal;line-height:22px">Hello ' . $user_name . ',</h1>
                                        <p style="font-weight:bold; font-size:12px; color:#202120;line-height:25px">
                                            <span style="font-weight:bold; font-size:16px; color:#4585F3;line-height:25px">Thank you for order submit</span>
                                            <br/>
                                            You can check the status of your order by visiting  your Dashboard.
                                            If you have any questions about your bikash pament please contact us at <a style="color:#1e7ec8" href="mailto:support@ticketchai.com" target="_blank">support@ticketchai.com</a> or call us at <span class="m_3400397995181562166m_8401342642413116184m_-1842238349812301262nobr"> +88 01971-Ticket (842538), <a href="tel:+880%201942-999666" value="+8801942999666" target="_blank">+8801942 999666</a>  </span> Every Sat To Thurs, <span class="aBn" data-term="goog_5961152" tabindex="0"><span class="aQJ">10am - 6pm</span></span> BDT.
                                        </p>
                                        <br>
                                        <p style="font-weight:bold; font-size:16px; color:#4585F3;line-height:25px">Your Order details are as follows:</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h2 style="font-size:18px;font-weight:normal">Your Order ID : ' . "$OI_number" . ' </h2>
                                    </td>
                                <tr/>
                                <tr>
                                    <td>
                                        <table style="border:1px solid #eaeaea" width="725" cellspacing="0" cellpadding="0" border="0">
                                            <thead>
                                                <tr>
                                                    <th style="font-size:13px;padding:3px 9px" bgcolor="#EAEAEA" align="left">E-Ticket No</th>

                                                    <th style="font-size:13px;padding:3px 9px" bgcolor="#EAEAEA" align="center">Ticket Quantity</th>
                                                    <th style="font-size:13px;padding:3px 9px" bgcolor="#EAEAEA" align="center">Total Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="font-size:11px;padding:3px 9px;border-bottom:1px dotted #cccccc" valign="top" align="left">
                                                        <span> ' . "$OI_id" . ' </span>
                                                    </td>

                                                    <td style="font-size:11px;padding:3px 9px;border-bottom:1px dotted #cccccc" valign="top" align="center"><span> '."$total_item".' </span></td>
                                                    <td style="font-size:11px;padding:3px 9px;border-bottom:1px dotted #cccccc" valign="top" align="center"><span>  '."$t_A".'  </span></td>
                                                </tr>
                                                <tr>
                                                    <td> </td>

                                                    <td style="font-size:11px;padding:3px 9px;border-bottom:1px dotted #cccccc" valign="top" align="right"><b>Grand Total =</b></td>
                                                    <td style="font-size:11px;padding:3px 9px;border-bottom:1px dotted #cccccc" valign="top" align="center"><b><span class="m_3400397995181562166m_8401342642413116184m_-1842238349812301262ecxprice"> '."$t_A".' </span></b></td>
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
                                                    <th style="font-size:13px;padding:5px 9px 6px 9px;line-height:1em" width="325" bgcolor="#EAEAEA" align="left">Billing Information:</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="font-size:12px;padding:7px 9px 9px 9px;border-left:1px solid #eaeaea;border-bottom:1px solid #eaeaea;border-right:1px solid #eaeaea" valign="top">
                                                        <span style="font-weight:bold; font-size:16px; color:#4585F3;line-height:30px; padding: 5px;">
                                                            
                                                            Name:</span> <span style="font-size: 13px; font-weight: bold;">' . $user_name . '</span><br>
                                                        <span style="font-weight:bold; font-size:16px; color:#4585F3;line-height:30px; padding: 5px;">
                                                            
                                                            Phone:</span> <span style="font-size: 13px; font-weight: bold;">' . "$user_phone" . '</span><br>
                                                        <span style="font-weight:bold; font-size:16px; color:#4585F3;line-height:30px; padding: 5px;">
                                                            
                                                            Payment Method:</span> <span style="font-size: 13px; font-weight: bold;">' . "$payment_method" . '</span><br>
                                                        <span style="font-weight:bold; font-size:16px; color:#4585F3;line-height:30px; padding: 5px;">
                                                            
                                                            City:</span> <span style="font-size: 13px; font-weight: bold;"> Not Mention </span><br>
                                                        <span style="font-weight:bold; font-size:16px; color:#4585F3;line-height:30px; padding: 5px;">
                                                            
                                                            Zip:</span> <span style="font-size: 13px; font-weight: bold;"> Not Mention </span><br>
                                                        <span style="font-weight:bold; font-size:16px; color:#4585F3;line-height:30px; padding: 5px;">
                                                            
                                                            Address:</span> <span style="font-size: 13px; font-weight: bold;"> Not Mention </span>  <br>      
                                                    </td>
                                                </tr>
                                                

                                            </tbody>
                                        </table>
                                        <br>
                                        
                                        <table width="725" cellspacing="0" cellpadding="0" border="0">
                                            <thead>
                                                <tr>
                                                    <th style="font-size:13px;padding:5px 9px 6px 9px;line-height:1em" width="325" bgcolor="#EAEAEA" align="left">Shipping Information:</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="font-size:12px;padding:7px 9px 9px 9px;border-left:1px solid #eaeaea;border-bottom:1px solid #eaeaea;border-right:1px solid #eaeaea" valign="top">
                                                        <span style="font-weight:bold; font-size:16px; color:#4585F3;line-height:30px; padding: 5px;">
                                                            
                                                            Name:</span> <span style="font-size: 13px; font-weight: bold;">' . $user_name . '</span><br>
                                                        <span style="font-weight:bold; font-size:16px; color:#4585F3;line-height:30px; padding: 5px;">
                                                            
                                                            Phone:</span> <span style="font-size: 13px; font-weight: bold;">' . "$user_phone" . '</span><br>
                                                        <span style="font-weight:bold; font-size:16px; color:#4585F3;line-height:30px; padding: 5px;">
                                                            
                                                            Shipping Method:</span> <span style="font-size: 13px; font-weight: bold;">' . "$payment_method" . '</span><br>
                                                        <span style="font-weight:bold; font-size:16px; color:#4585F3;line-height:30px; padding: 5px;">
                                                            
                                                            City:</span> <span style="font-size: 13px; font-weight: bold;"> Not Mention </span><br>
                                                        <span style="font-weight:bold; font-size:16px; color:#4585F3;line-height:30px; padding: 5px;">
                                                            
                                                            Zip:</span> <span style="font-size: 13px; font-weight: bold;"> Not Mention </span><br>
                                                        <span style="font-weight:bold; font-size:16px; color:#4585F3;line-height:30px; padding: 5px;">
                                                            
                                                            Address:</span> <span style="font-size: 13px; font-weight: bold;"> Not Mention </span><br>        
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
                                <p style="font-size:14px; color:#FFF; font-weight: bold;">Copyright &copy;  ' . $cur_year . ' <a style="color:#ffffff" href="http://ticketchai.com" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://ticketchai.com&amp;source=gmail&amp;ust=1483683976103000&amp;usg=AFQjCNEn0Wp8DcP-jBhp1aRqvsQUfU6F5Q">ticketchai.com</a> Ltd. All Rights Reserved</p>
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



$html = '  
         
   <html>
    
    
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


    </html>

            ';
//session_right_close();
//support@ticketchai.com




if (isset($_GET['oid']) AND isset($_GET['status'])) {
    $orderStatus = base64_decode($_GET['status']);
    //$decode_order_id=  base64_decode($_GET['oid']);
    $orderID = base64_decode($_GET['oid']);
    $sqlconfirm = "SELECT * FROM orders WHERE order_id='" . $orderID . "'";
    $queryconfirm = mysqli_query($con, $sqlconfirm);
    $chkordercheck = mysqli_num_rows($queryconfirm);

    if ($chkordercheck == 0) {

        //movie detail end
        $getacualdetailsql = "SELECT a.*,e.event_id FROM order_movie_event as a 
LEFT JOIN event_movie_list as e on e.movie_id=a.movie_id WHERE a.order_id='" . $orderID . "' GROUP BY a.order_id";
        $queryacualdetail = mysqli_query($con, $getacualdetailsql);
        $chkactual = mysqli_num_rows($queryacualdetail);
        //echo $chkactual;
        if ($chkactual != 0) {

            if ($orderStatus == "success") {
                $payst = "paid";
            } elseif ($orderStatus == "cancel") {
                $payst = "cancel";
            } else {
                $payst = "booking";
            }
            $asd = array();
            $ssqqq = "SELECT * FROM order_items WHERE OI_order_id='" . $orderDBID . "' ORDER BY OI_id ASC LIMIT 1";
            $ss = mysqli_query($con, $ssqqq);
            if ($ss) {
                while ($sss = mysqli_fetch_object($ss)) {
                    $asd[] = $sss;
                }
            } else {
                if (true) {
                    $err = "resultOrderDetails error: " . mysqli_error($con);
                } else {
                    $err = "resultOrderDetails query failed";
                }
            }
            if ($payst == "paid") {
                 $sub = 'ticketchai';
// smtpmailer('to@gmail.com', 'from@gmail.com', $name, $sub,"$html");
                echo smtpmailer($user_email, 'support@ticketchai.com', $sub, 'Bkash payment', $html);
//echo $user_email;
                
            } else {

                $getacualdetailsql = "UPDATE order_movie_event SET verified_order_id='" . $orderDBID . "' WHERE order_id='" . $orderID . "'";
                $queryacualdetail = mysqli_query($con, $getacualdetailsql);
                $updateorder_status = "UPDATE orders SET order_status='" . $payst . "' WHERE order_id='" . $orderDBID . "'";
                $updateorderstquery = mysqli_query($con, $updateorder_status);
                $sub = 'ticketchai';
// smtpmailer('to@gmail.com', 'from@gmail.com', $name, $sub,"$html");
                echo smtpmailer($user_email, 'support@ticketchai.com', $sub, 'Bkash payment', $html);
//echo $user_email;
                
            }
        } else {


            if ($orderStatus == "success") {
                $payst = "paid";
            } elseif ($orderStatus == "cancel") {
                $payst = "cancel";
            } else {
                $payst = "booking";
            }

            $uarr = array();

            $sqlordersql = "SELECT a.*,u.user_email,concat(u.user_first_name,' ',u.user_middle_name,' ',u.user_last_name) as user_fullname FROM orders as a 
LEFT JOIN users as u on u.user_id=a.order_user_id 
WHERE a.order_id='" . $orderID . "'";

            $sqluserInfo = mysqli_query($con, $sqlordersql);
            $chkorder = mysqli_num_rows($sqluserInfo);
            if ($chkorder != 0) {



                while ($rowdata = mysqli_fetch_object($sqluserInfo)):
                    $uarr[] = $rowdata;
                endwhile;

                $user_email = $uarr[0]->user_email;
                $user_fullname = $uarr[0]->user_fullname;
                $email = $user_email;
                $ssqqq = "SELECT * FROM order_items WHERE OI_order_id='" . $orderID . "' ORDER BY OI_id ASC LIMIT 1";
                $ss = mysqli_query($con, $ssqqq);
                if ($ss) {
                    while ($sss = mysqli_fetch_object($ss)) {
                        $asd[] = $sss;
                    }
                } else {
                    if (DEBUG) {
                        $err = "resultOrderDetails error: " . mysqli_error($con);
                    } else {
                        $err = "resultOrderDetails query failed";
                    }
                }

                //order process
                if ($payst == "paid") {
                    $updateorder_status = "UPDATE orders SET order_status='" . $payst . "' WHERE order_id='" . $orderID . "'";
                    $updateorderstquery = mysqli_query($con, $updateorder_status);
                    $sub = 'ticketchai';
// smtpmailer('to@gmail.com', 'from@gmail.com', $name, $sub,"$html");
                    echo smtpmailer($user_email, 'support@ticketchai.com', $sub, 'Bkash payment', $html);
//echo $user_email;
                   
                } else {
                    $updateorder_status = "UPDATE orders SET order_status='" . $payst . "' WHERE order_id='" . $orderID . "'";
                    $updateorderstquery = mysqli_query($con, $updateorder_status);
                    $sub = 'ticketchai';
// smtpmailer('to@gmail.com', 'from@gmail.com', $name, $sub,"$html");
                    echo smtpmailer($user_email, 'support@ticketchai.com', $sub, 'Bkash payment', $html);
//echo $user_email;
                    
                }
            } else {
                $status_confirm = "invalid";
                $email = "";
            }
        }
        //movie detail end    
    } else {


        echo $status_confirm = "invalid";
        $email = "";
    }
}
?>
<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/fav1.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <?php
        echo $cms->pageTitle("Confirmation| Ticket Chai");
        ?>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

        <?php
        echo $cms->headCss(array("sitemapSponsor"));
        ?>
    </head>

    <body class="index-page signin" ng-app="frontEnd" ng-controller="signinController">
        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->

        <?php echo $cms->FbSocialScript(); ?>
        <?php include 'include/navbar.php'; ?>

        <div class="clearfix"></div>
        <div class="wrapper">
            <!-- main content part starts here -->
            <div class="main" style="background-color: transparent;margin-top:100px">
                <!-- Customers LogIn section starts here -->
                <div class="section-simple2">
                    <div class="container">
                        <div class="row padd_btm_30">
                            <div class="col-lg-8 col-lg-offset-2 col-md-8 col-sm-8 col-xs-12  well">
                                <p>We've sent a message to your email with order details.</p>
                                <p>Don't see it? Please check your spam folder.</p>
                                <a href="#" class="btn btn-raised btn-success waves-effect">Continue to Shopping</a>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="#" class="btn btn-raised btn-success waves-effect">Go Order History</a>

                            </div>
                        </div>
                    </div>
                    <!-- Customers LogIn section ends here -->
                    <!-- ticketchai simple section starts here -->
                    <div class="section section-simple-close">
                        <div class="container">
                            <div class="row section_padd30">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-heading"></div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-content section_padd30 text-center"></div>
                            </div>
                        </div>
                    </div>
                    <!-- ticketchai simple section ends here -->
                </div>
                <!-- main content part ends here -->

                <?php include 'include/footer.php'; ?>
            </div>


            <!--   Core JS Files   -->
            <?php echo $cms->fotterJs(array('signin')); ?>
            <?php echo $cms->angularJs(array('signin_angular')); ?>




            
            <script type="text/javascript">
                        $(document).ready(function () {
                            $('#subscription').hide();
                            setTimeout(function (a) {
                                $('#subscription').slideDown(1000);
                            }, 15000);
                            setTimeout(function (b) {
                                $('#subscription').slideUp(3000);
                            }, 30000);
                            $('#btn-sclose').click(function () {
                                $('#subscription').slideUp(1000);
                            });

                            $('#nav-search-btn').click(function () {
                                $('#nav-search-field').show();
                                $('#nav-search-btn').hide();
                            });
                            $('#nav-search-close').click(function () {
                                $('#nav-search-field').hide();
                                $('#rslt-div').hide();
                                $('#nav-search-btn').show();
                                $('#searchInput').val('');
                            });
                        });

                        setTimeout(function () {
                            $('#odometer1').html('50');
                            $('#odometer2').html('100');
                            $('#odometer3').html('200');
                            $('#odometer4').html('10000');
                        }, 1000);

            </script>
            <!--  Select Picker Plugin -->
            <!--searchbar script-->
            <script>
                        $(document).ready(function () {

                            $('.control').keyup(function () {

                                // If value is not empty
                                if ($(this).val().length == 0) {
                                    // Hide the element
                                    $('.show_hide').hide();
                                } else {
                                    // Otherwise show it
                                    $('.show_hide').show();
                                }
                            }).keyup();
                        });</script>
            <!--searchbar script-->

    </body>

</html>