<?php

include '../../DBconnection/auth.php';
//require_once('../../email/phpmailer/class.phpmailer.php');
include '../../email/mail_helper_functions.php';
// Including database connections start here
require_once '../../DBconnection/database_connections.php';
// Including database connections end here
//START HERE 
//session_start();
$sessionId = session_id();
$cur_year = date("Y");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$data = json_decode(file_get_contents("php://input"));
@$etemail = $data->etemail;
@$messagedata = $data->message;
@$emailOrderID = $data->oid;



 $sql = "INSERT INTO order_email_record SET email= '$etemail', massage='$messagedata',order_id='$emailOrderID'";


$insert =  mysqli_query($con, $sql);

//echo $sql;
if ($insert) {
   
   
    //mail script start
    $o_session_id = "";
    //echo $emailOrderID;
    //exit();
    
    $selectSql = "
           SELECT 
    oe.`OE_order_id`,
    oe.`OE_user_id`,
    o.`order_number`,
    o.`order_total_item`,
    o.`order_total_amount`,
    o.`order_payment_type`,
    o.`order_billing_phone`,
    o.`order_session_id`,
    u.`user_email`,
    u.`user_name`,
    u.`user_phone`,
    o.`order_status`
    FROM `order_events` AS oe 
    LEFT JOIN `orders` As o ON oe.`OE_order_id`=o.order_id
    LEFT JOIN `temp_billing` As u ON oe.`OE_user_id`=u.user_id
    WHERE  oe.`OE_order_id`='$emailOrderID' GROUP BY o.order_id ORDER BY oe.`OE_order_id` DESC
                
                 ";
    
      $result = mysqli_query($con, $selectSql);
     
     
     

    $row = mysqli_fetch_array($result);
    
    
//    print_r($row);
//    exit();
    
    $OI_id = $row['OE_order_id'];
    $OI_number = $row['order_number'];
    $payment_method = $row['order_payment_type'];
    $user_email = $row['user_email'];
    $total_item = $row['order_total_item'];
    $user_name = $row['user_name'];
    $user_phone = $row['user_phone'];
    $order_status = $row['order_status'];
    $order_session=$row['order_session_id'];
    $t_A = $row['order_total_amount'];
    $mailodst = false;

    if ($order_status == "paid" || $order_status == "free" || $order_status == "free & paid") {
        $odst = "Success";
        $attachmentpdfcore = file_get_contents('http://ticketchai.com/ticketchaiorg/user_dashboard/download-ticket_in_dir.php?oid='.$OI_id .'&order_session=' . $order_session . "&quantity=1");
       $attachmentpdf = '../../../pdf/' . $attachmentpdfcore;
        $mailodst = true;
    } elseif ($order_status == "pending" || $order_status == "booking") {
        $odst = " Pending.";
    } elseif ($order_status == "approved") {
        $odst = " Confirmed.";
    } else {
        $odst = "Cancel";
    }
    
    
    $order_subject_email = 'Ticketchai Order Info - Review by organizer';
    
    $html = '<html>
    
    
        <body>
            <table width="100%" cellspacing="0" cellpadding="0" border="0">

    <tbody><tr>
            <td valign="top" align="center">
                <span class="HOEnZb"><font color="#888888">
        </font></span><span class="HOEnZb"><font color="#888888">
    </font></span><table style="border:1px solid #e0e0e0" width="650" cellspacing="0" cellpadding="10" border="0" bgcolor="#FFFFFF">
                    <tbody><tr style="background:#C5E1A5;">
                            <td class="m_3400397995181562166m_8401342642413116184m_-1842238349812301262ecxfirst" valign="top" style="text-align:center;">
                                <a href="http://www.ticketchai.com/ticketchaiorg/index.php" style="font-size:20px;color:#383838;text-decoration:none" target="_blank" 
                                data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://www.ticketchai.com/ecf/&amp;source=gmail&amp;ust=1483683976103000&amp;usg=AFQjCNHETqB0NgE6JgwS4kig9BxItYzL0g">
                                <img alt="" src="http://ticketchai.com/ticketchaiorg/tc-merchant-template/assets/img/white-shadow-logo.png" class="x_CToWUd" border="0"></a><br>
                                <span style="font-family:Arial_Rounded_MT_Bold">
                                    Hotline : +88 01971-Ticket (842538), <a href="tel:+880%201942-999666" value="+8801942999666" target="_blank">+8801942 999666</a> 
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td valign="top">
                                <h1 style="font-size:22px;font-weight:normal;line-height:22px">Hello ' . "$user_name" . ',</h1>
                                <p style="font-size:12px;line-height:16px">'.$messagedata.'</p>
                                <p style="font-size:12px;line-height:16px">
                                    Thank you for your order from <a href="http://www.ticketchai.com/ticketchaiorg/index.php" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://ticketchai.com&amp;source=gmail&amp;ust=1483683976103000&amp;usg=AFQjCNEn0Wp8DcP-jBhp1aRqvsQUfU6F5Q">ticketchai.com</a>.
                                    You can check the status of your order by visiting  your Dashboard.
                                    If you have any questions about your order please contact us at <a style="color:#1e7ec8" href="mailto:support@ticketchai.com" target="_blank">support@ticketchai.com</a> <br>or call us at <span class="m_3400397995181562166m_8401342642413116184m_-1842238349812301262nobr"> +88 01971-Ticket (842538), <a href="tel:+880%201942-999666" value="+8801942999666" target="_blank">+8801942 999666</a>  </span> Every Sat To Thurs, <span class="aBn" data-term="goog_5961152" tabindex="0"><span class="aQJ">10am - 6pm</span></span> BDT.
                                </p><br>
                                
                            </td></tr>
                        <tr>
                            <td>
                                <h2 style="font-size:18px;font-weight:normal">Your Order ' . "$OI_number" . '</h2>
                            </td>
                        </tr>
             
                        <tr style="background:#C5E1A5;">
                            <td class="m_3400397995181562166m_8401342642413116184m_-1842238349812301262ecxlast" align="center"><center><p style="font-size:12px">Copyright &copy; '.$cur_year.' <a href="http://ticketchai.com" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://ticketchai.com&amp;source=gmail&amp;ust=1483683976103000&amp;usg=AFQjCNEn0Wp8DcP-jBhp1aRqvsQUfU6F5Q">ticketchai.com</a> Ltd. All Rights Reserved</p></center></td></tr></tbody></table><span class="HOEnZb"><font color="#888888">
</font></span></td></tr></tbody></table>
        </body>


    </html>';
    
    
    if ($mailodst == true) {
    	//echo $attachmentpdf;
    	//exit();
        smtpmailer($etemail, 'support@ticketchai.com', $user_name, $order_subject_email,$html,$attachmentpdf);
    } else {
        smtpmailer($user_email, 'support@ticketchai.com', $user_name, $order_subject_email, "$html");
    }
    
    //mail script end

    echo 1;
} else {

    echo 0;
}


mysqli_close($con);
?>
