<?php
require_once '../DBconnection/database_connections.php';
require_once('phpmailer/class.phpmailer.php');
include 'mail_helper_functions.php';
$data = json_decode(file_get_contents("php://input"));
$pass=$data->admin_id;

$cur_year = date('Y');

function MakePassword($pass) {
    $bytes = 044;
    $salt = base64_encode($bytes);
    $hash = hash('sha512', $salt . $pass);
    return md5($hash);
}

$password=MakePassword($pass);
$sub ='Change password';
//$msg = $data->msg;

$sql="SELECT * FROM `admins` WHERE `admin_password`='$password'";

$result=  mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($result)) {
    $name=$row['admin_full_name'];
     $email=$row['admin_email'];

}



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
                                        
                                        <br>
                                        <p style="font-weight:bold; font-size:16px; color:#4585F3;line-height:25px" align="center">Your Password successfully changed. </p></br>
                                        <p align="center">Ticketchai will contact with you for further extension.</p>
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
//echo $email;

 echo smtpmailer($email, 'support@ticketchai.com', $name, $sub,"$html");



?>