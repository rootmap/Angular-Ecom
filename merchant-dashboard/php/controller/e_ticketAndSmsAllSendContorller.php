<?php

include '../../DBconnection/auth.php';
require_once('../../email/phpmailer/class.phpmailer.php');
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
$email = $data->email;
$message = $data->msg;
//$emailOrderID = $data->oid;


 $sql = "INSERT INTO send_massage_all_email SET email= '$email', message='$message',merchant_id='$login_user_id'";
mysqli_query($con, $sql);
if (true) {

    //mail script start
   
    //echo $emailOrderID;
    //exit();
    
    
//    print_r($row);
//    exit();
    
  
    
    
    $order_subject_email = 'Message from ticketchai.com - Send by organizer';
    
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
                                <h1 style="font-size:22px;font-weight:normal;line-height:22px">Hello, ' . "$login_user_name" . '</h1>
                                <p style="font-size:12px;line-height:16px">'.$message.'</p>
                                <p style="font-size:12px;line-height:16px">
                                    Thank you for your order from <a href="http://ticketchai.com" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://ticketchai.com&amp;source=gmail&amp;ust=1483683976103000&amp;usg=AFQjCNEn0Wp8DcP-jBhp1aRqvsQUfU6F5Q">ticketchai.com</a>.
                                    You can check the status of your order by visiting  your Dashboard.
                                    If you have any questions about your order please contact us at <a style="color:#1e7ec8" href="mailto:support@ticketchai.com" target="_blank">support@ticketchai.com</a> <br>or call us at <span class="m_3400397995181562166m_8401342642413116184m_-1842238349812301262nobr"> +88 01971-Ticket (842538), <a href="tel:+880%201942-999666" value="+8801942999666" target="_blank">+8801942 999666</a>  </span> Every Sat To Thurs, <span class="aBn" data-term="goog_5961152" tabindex="0"><span class="aQJ">10am - 6pm</span></span> BDT.
                                </p><br>
                                
                            </td></tr>
                    
             
                        <tr style="background:#C5E1A5;">
                            <td class="m_3400397995181562166m_8401342642413116184m_-1842238349812301262ecxlast" align="center"><center><p style="font-size:12px">Copyright &copy; '.$cur_year.' <a href="http://ticketchai.com" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://ticketchai.com&amp;source=gmail&amp;ust=1483683976103000&amp;usg=AFQjCNEn0Wp8DcP-jBhp1aRqvsQUfU6F5Q">ticketchai.com</a> Ltd. All Rights Reserved</p></center></td></tr></tbody></table><span class="HOEnZb"><font color="#888888">
</font></span></td></tr></tbody></table>
        </body>


    </html>';
         //echo $email;
         
         $allusser=explode(",",$email);
         
    foreach($allusser as $key => $value) {
        //echo $value;
          smtpmailer($value, 'support@ticketchai.com','Ticketchai', $order_subject_email, "$html");
    }
   
      
   
    
   

    echo 1;
}else {

    echo 0;
}


mysqli_close($con);
?>
