<?php
require_once '../DBconnection/database_connections.php';
require_once('phpmailer/class.phpmailer.php');
include 'mail_helper_functions.php';

$data = json_decode(file_get_contents("php://input"));

$cur_year = date('Y');

$name = $data->name;
@$email = $data->email;
$sub = $data->sub;
$msg = $data->msg;
$html='';


 

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
                                            <span style="font-weight:bold; font-size:16px; color:#4585F3;line-height:25px">Thank you for sending your query through ticketchai.</span>
                                            <br/>
                                            You can check the status of your order by visiting  your Dashboard.
                                            If you have any questions please contact us at <a style="color:#1e7ec8" href="mailto:support@ticketchai.com" target="_blank">support@ticketchai.com</a> or call us at <span class="m_3400397995181562166m_8401342642413116184m_-1842238349812301262nobr"> +88 01971-Ticket (842538), <a href="tel:+880%201942-999666" value="+8801942999666" target="_blank">+8801942 999666</a>  </span> Every Sat To Thurs, <span class="aBn" data-term="goog_5961152" tabindex="0"><span class="aQJ">10am - 6pm</span></span> BDT.
                                        </p>
                                        <br>
                                        <p style="font-weight:bold; font-size:16px; color:#4585F3;line-height:25px">Your requesting contact subject is '."$sub".' and details is - '."$msg".'</p></br>
                                        <p style="font-weight:bold; font-size:16px; color:#4585F3;line-height:25px">Ticketchai will contact with you for further extension.</p></br>
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
// smtpmailer('to@gmail.com', 'from@gmail.com', $name, $sub,"$html");
echo smtpmailer($email, 'support@ticketchai.com', $name, $sub,"$html");
?>