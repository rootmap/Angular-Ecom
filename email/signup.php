<?php

require_once '../DBconnection/database_connections.php';
require_once('phpmailer/class.phpmailer.php');
include 'mail_helper_functions.php';

$data = json_decode(file_get_contents("php://input"));
$id = $data->id;
$user_email = "";
$user_hash = "";
$user_first_name = "";
$user_middle_name = "";
$user_last_name = "";
$social_type = "";

if (!empty($id)) {
    $sqlUserInfo = "SELECT * FROM users WHERE user_id=$id";
    $executeUserInfo = mysqli_query($con, $sqlUserInfo);
    if ($executeUserInfo) {
        $getUserInfo = mysqli_fetch_object($executeUserInfo);
        if (isset($getUserInfo->user_id)) {
            $firstName = $getUserInfo->user_first_name;
            $lastName = $getUserInfo->user_last_name;
            $user_email = $getUserInfo->user_email;
            $user_phone = $getUserInfo->user_phone;
            $userHash = $getUserInfo->user_hash;
            $social_type = $getUserInfo->user_social_type;


            $socialst = 0;

            if (!empty($social_type)) {
                $socialst = 1;
            }


            if ($socialst == 1) {
                $sub = 'User login using ' . $social_type;
            } else {
                $sub = 'User Account Creation Complete';
            }


            if (empty($firstName)) {
                $firstName = "Not Mention";
            }

            if (empty($lastName)) {
                $lastName = "Not Mention";
            }

            if (empty($user_phone)) {
                $user_phone = "Not Mention";
            }

            if (empty($user_email)) {
                $user_email = "Not Mention";
            }
        }
    }
}
$m = base64_encode($user_email);
$t = base64_encode($userHash);
$ac = base64_encode('Verify');

$cur_year = date("Y");

$html = '';



$html .= ' 
    
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
                                                <h1 style="font-size:22px;font-weight:normal;line-height:22px">Hello ' . $firstName . ',</h1>
                                                <p style="font-weight:bold; font-size:12px; color:#202120;line-height:25px">
                                                    <span style="font-weight:bold; font-size:16px; color:#4585F3;line-height:25px">Welcome to ticketchai</span>
                                                    <br/>
                                                    If you have any questions about your signup please contact us at <a style="color:#1e7ec8" href="mailto:support@ticketchai.com" target="_blank">support@ticketchai.com</a> or call us at <span class="m_3400397995181562166m_8401342642413116184m_-1842238349812301262nobr"> +88 01971-Ticket (842538), <a href="tel:+880%201942-999666" value="+8801942999666" target="_blank">+8801942 999666</a>  </span> Every Sat To Thurs, <span class="aBn" data-term="goog_5961152" tabindex="0"><span class="aQJ">10am - 6pm</span></span> BDT.
                                                </p>
                                                <br>
                                                <p style="font-weight:bold; font-size:16px; color:#4585F3;line-height:25px">Your user account created successfully. </p>
                                            </td>
                                        </tr> 
 
         ';


if ($socialst == 1) {
    $html .= '<h4 style="background:#ccc; padding:5px; border-radius:5px;" align="center">' . str_replace('.com', ' ', $type) . ' used to login ticketchai.com</h4>';
} else {
    $html .= '<h4 style="background:#ccc; padding:5px; border-radius:5px;" align="center">Informations used to create your account.</h4>';
}





$html .= ' 
 
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
                                                            <img src="http://ticketchai.com/ticketchaiorg/email/icons/1491217822_user.png" alt="" style="height: 16px; width: 16px; margin-right: 15px;" />
                                                            Name:</span> <span style="font-size: 13px; font-weight: bold;">' . $firstName . ' </span><br>
                                                        <span style="font-weight:bold; font-size:16px; color:#4585F3;line-height:30px; padding: 5px;">
                                                            <img src="http://ticketchai.com/ticketchaiorg/email/icons/1491217667_mail-icon.png" alt="" style="height: 16px; width: 16px; margin-right: 15px;" />
                                                            Email:</span> <span style="font-size: 13px; font-weight: bold;">' . "$user_email" . '</span><br>
                                                        <span style="font-weight:bold; font-size:16px; color:#4585F3;line-height:30px; padding: 5px;">
                                                            <img src="http://ticketchai.com/ticketchaiorg/email/icons/1491217721_phone.png" alt="" style="height: 16px; width: 16px; margin-right: 15px;" />
                                                            Phone:</span> <span style="font-size: 13px; font-weight: bold;">' . "$user_phone" . '</span><br>
                                                        <span style="font-weight:bold; font-size:16px; color:#4585F3;line-height:30px; padding: 5px;">
                                                            <img src="http://ticketchai.com/ticketchaiorg/email/icons/broken-link.png" alt="" style="height: 16px; width: 16px; margin-right: 15px;" />
                                                            Password:</span> <span style="font-size: 13px; font-weight: bold;"> ************* </span>        
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



// smtpmailer('to@gmail.com', 'from@gmail.com', $name, $sub,"$html");
echo smtpmailer($user_email, 'support@ticketchai.com', $firstName, $sub, "$html");
//<p style="font:14px Helvetica Neue,Helvetica,Arial,sans-serif;color:#777777;margin:20px 0 5px 0;padding:0">It is recommended to activate your account. Please <b><a href="ticketchai.org/verify_account.php?m=echo base64_encode($user_email)&t=echo base64_encode($userHash)&ac=echo base64_encode(Verify)" target="blank">click here</a></b> to activate your account.</p>
?>