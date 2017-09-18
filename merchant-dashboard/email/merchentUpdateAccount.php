<?php
include '../DBconnection/auth.php';
require_once '../DBconnection/database_connections.php';
require_once '../../cms/merchantPlugin.php';
$cms=new plugin();
require_once('phpmailer/class.phpmailer.php');
include 'mail_helper_functions.php';

$cur_year = date('Y');

$sub = 'Profile Modfication Notice';
//$msg = $data->msg;

$sql = "SELECT * FROM `admins` WHERE `admin_id`='$login_user_id'";

$result = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($result)) {
    $name = $row['admin_full_name'];
    $phone = $row['admin_phone'];
    $email = $row['admin_email'];
}

if(empty($name))
{
    $name="Not Mention";
}

if(empty($phone))
{
    $phone="Not Mention";
}

if(empty($email))
{
    $email="Not Mention";
}


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
                                        <h1 style="font-size:22px;font-weight:normal;line-height:22px">Hello ' . $name . ',</h1>
                                        <p style="font-weight:bold; font-size:12px; color:#202120;line-height:25px">
                                            Your profile info has been modified in '.date('H:i:s a d D, M Y').'. 
                                            Please login to your portal too see the changes <a style="color:#1e7ec8" href="http://ticketchai.com/ticketchaiorg/merchant-dashboard/user_edit_profile.php?uid='.$login_user_id.'" target="_blank">click here</a>
                                            </br>
                                            If you have any problem Please contact with ticketchai support if you are not modified these information.<a target="_blank" href="mailto:support@ticketchai.com"><span style="color:#09f;">Contact With Support Team</span></a>
                                        </p>
                                        
                                    </td>
                                </tr> 
                                

                                <tr>
                                   <td>
                                   
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



//echo $html;X:\ticketchai_aj\merchant-dashboard\email\merchentAccountCreation.php

// smtpmailer('to@gmail.com', 'from@gmail.com', $name, $sub,"$html");

echo smtpmailer($email, 'support@ticketchai.com', $name, $sub,$html);
?>