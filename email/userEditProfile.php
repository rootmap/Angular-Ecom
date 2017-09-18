<?php
require_once '../DBconnection/database_connections.php';
require_once('phpmailer/class.phpmailer.php');
include 'mail_helper_functions.php';

$data = json_decode(file_get_contents("php://input"));

$email = '';
$fname = '';
$lname = '';
$addr = '';
$zip = '';
$city = '';
$country = '';


 $id=$data->id;
$email .=$data->email;
 $fname.=$data->fname;
$lname .=$data->lname;
 $addr.=$data->addr;
 $zip.=$data->zip;
$cur_year = date('Y');

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
                                        <h1 style="font-size:22px;font-weight:normal;line-height:22px">Hello ' . $fname .' '. $lname . ',</h1>
                                        <p style="font-weight:bold; font-size:12px; color:#202120;line-height:25px">
                                            If you have any questions please contact us at <a style="color:#1e7ec8" href="mailto:support@ticketchai.com" target="_blank">support@ticketchai.com</a> or call us at <span class="m_3400397995181562166m_8401342642413116184m_-1842238349812301262nobr"> +88 01971-Ticket (842538), <a href="tel:+880%201942-999666" value="+8801942999666" target="_blank">+8801942 999666</a>  </span> Every Sat To Thurs, <span class="aBn" data-term="goog_5961152" tabindex="0"><span class="aQJ">10am - 6pm</span></span> BDT.
                                        </p>
                                        
                                    </td>
                                </tr>
                                


                              <tr>
                                    <td>
                                         
                                        <table width="725" cellspacing="0" cellpadding="0" border="0">
                                            <thead>
                                                <tr>
                                                    <th style="font-size:13px;padding:5px 9px 6px 9px;line-height:1em" width="325" bgcolor="#EAEAEA" align="left">Your Updated Informations:</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="font-size:12px;padding:7px 9px 9px 9px;border-left:1px solid #eaeaea;border-bottom:1px solid #eaeaea;border-right:1px solid #eaeaea" valign="top">
                                                        <span style="font-weight:bold; font-size:16px; color:#4585F3;line-height:30px; padding: 5px;">
                                                           
                                                            First Name:</span> <span style="font-size: 13px; font-weight: bold;">' . $fname . '</span><br>
                                                        <span style="font-weight:bold; font-size:16px; color:#4585F3;line-height:30px; padding: 5px;">
                                                            
                                                            Last Name:</span> <span style="font-size: 13px; font-weight: bold;">' . "$lname" . '</span><br>
                                                        <span style="font-weight:bold; font-size:16px; color:#4585F3;line-height:30px; padding: 5px;">
                                                           
                                                            Your Email Address:</span> <span style="font-size: 13px; font-weight: bold;">' . "$email" . '</span><br/>
                                                        <span style="font-weight:bold; font-size:16px; color:#4585F3;line-height:30px; padding: 5px;">
                                                           
                                                            Address:</span> <span style="font-size: 13px; font-weight: bold;">' . $addr . '</span><br>
                                                        <span style="font-weight:bold; font-size:16px; color:#4585F3;line-height:30px; padding: 5px;">
                                                           
                                                            Zip code:</span> <span style="font-size: 13px; font-weight: bold;">' . $zip . '</span><br>     
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


  $html .= '  
         
   <html>
    
    
    <body>
        
        <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#f5f5f5">
            <tbody>
                <tr>
                    <td>
                        <table width="500" cellspacing="0" cellpadding="0" border="0" align="center">
                            <tbody>

                             
                                <tr>
                                    <td height="50">
                                        <table width="500" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" style="border:1px solid #e3e3e3;padding:0;margin:0">
                                            <tbody>
                                                <tr>
                                                <td width="60" height="50"><img width="60" height="50" border="0" alt="" src="https://ci4.googleusercontent.com/proxy/Qe2uM_zJqchcwTlSmPb8F2nhsXkA5eD0lk8IOyrxbmkOSiHjC-kxXxWwQtdsEUA17dyZRtkP095VYXO2JJ0NHrwgw56AGxWOrVKDQkkXb_1ewA=s0-d-e1-ft#http://www.ticketchai.com/storage/newsletter/images/dot.gif" class="CToWUd"></td>
                                                <td width="380"><img width="380" height="1" border="0" align="top" alt="" src="https://ci4.googleusercontent.com/proxy/Qe2uM_zJqchcwTlSmPb8F2nhsXkA5eD0lk8IOyrxbmkOSiHjC-kxXxWwQtdsEUA17dyZRtkP095VYXO2JJ0NHrwgw56AGxWOrVKDQkkXb_1ewA=s0-d-e1-ft#http://www.ticketchai.com/storage/newsletter/images/dot.gif" class="CToWUd"></td>
                                                <td width="60"><img width="60" height="1" border="0" alt="" src="https://ci4.googleusercontent.com/proxy/Qe2uM_zJqchcwTlSmPb8F2nhsXkA5eD0lk8IOyrxbmkOSiHjC-kxXxWwQtdsEUA17dyZRtkP095VYXO2JJ0NHrwgw56AGxWOrVKDQkkXb_1ewA=s0-d-e1-ft#http://www.ticketchai.com/storage/newsletter/images/dot.gif" class="CToWUd"></td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>
                                                    <!-- content -->

                                                    <p style="font:22px Helvetica Neue,Helvetica,Arial,sans-serif;font-weight:bold;margin:0px 0 0 0;padding:0;color:#000">Welcome to ticketchai</p>
                                                    <p style="text-align:justify;font:14px Helvetica Neue,Helvetica,Arial,sans-serif;color:#777777;line-height:21px;margin:15px 0 0 0;padding:0">Your profile updated successfully in our website. Here is some important information about your new account.</p>
                                                </td>
                                                <td>&nbsp;</td>
                                            </tr>

                                            <tr>
                                                <td height="50">&nbsp;</td>
                                                <td> 
                                                    <p style="font:14px Helvetica Neue,Helvetica,Arial,sans-serif;color:#777777;margin:20px 0 5px 0;padding:0">Your Name:</p>
                                                          <p style="font:14px Helvetica Neue,Helvetica,Arial,sans-serif;color:#1a1a1a;text-decoration:none"> '.$fname.'</p>
                                                     <p style="font:14px Helvetica Neue,Helvetica,Arial,sans-serif;color:#777777;margin:20px 0 5px 0;padding:0">Last Name:</p>
                                                    <p style="font:14px Helvetica Neue,Helvetica,Arial,sans-serif;color:#1a1a1a;text-decoration:none"><?php echo $lname; ?></p>
                                                    <p style="font:14px Helvetica Neue,Helvetica,Arial,sans-serif;color:#1a1a1a;text-decoration:none"> '.$lname.'</p>
                                                    <p style="font:14px Helvetica Neue,Helvetica,Arial,sans-serif;color:#777777;margin:20px 0 5px 0;padding:0">Your Email Address:</p>
                                                    <p style="font:14px Helvetica Neue,Helvetica,Arial,sans-serif;color:#1a1a1a;text-decoration:none"> '.$email.'</p>
                                                    <p style="font:14px Helvetica Neue,Helvetica,Arial,sans-serif;color:#777777;margin:20px 0 5px 0;padding:0">Address:</p>
                                                    <p style="font:14px Helvetica Neue,Helvetica,Arial,sans-serif;color:#1a1a1a;text-decoration:none"> '.$addr.'</p>
                                                    <p style="font:14px Helvetica Neue,Helvetica,Arial,sans-serif;color:#777777;margin:20px 0 5px 0;padding:0">Zip code:</p>
                                                    <p style="font:14px Helvetica Neue,Helvetica,Arial,sans-serif;color:#1a1a1a;text-decoration:none"> '.$zip.'</p>
                                                   
                                                </td>
                                                <td>&nbsp;</td>
                                            </tr>
                                                <tr>
                                                    <td height="50">&nbsp;</td>
                                                    <td><p style="font:14px Helvetica Neue,Helvetica,Arial,sans-serif;font-weight:bold;margin:10px 0 10px 0;padding:10px 0 0 0;color:#000000">Thanks Again</p><p style="font:14px Helvetica Neue,Helvetica,Arial,sans-serif;color:#777777;line-height:21px;margin:0;padding:0">ticketchai.com Team</p></td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td height="8" background="" colspan="3"></td>
                                                </tr>
                                                 <tr>
                                                    <td colspan="3" align="center"><p style="font:12px Helvetica Neue,Helvetica,Arial,sans-serif;margin:0;padding:0;color:#777777">  &copy; 2015 Ticket Chai. All rights Reserved.</p></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                              <tr>
                             
                            </tbody>
                        </table>
                        
                    </td>
                </tr>
            </tbody>
        </table>
        
    </body>


    </html>

            ';
// smtpmailer('to@gmail.com', 'from@gmail.com', $name, $sub,"$html");
echo smtpmailer($email, 'support@ticketchai.com', $fname, 'User Profile Update',"$html");

?>

