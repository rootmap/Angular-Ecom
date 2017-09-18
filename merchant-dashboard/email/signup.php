<?php
require_once '../DBconnection/database_connections.php';
require_once('phpmailer/class.phpmailer.php');
include 'mail_helper_functions.php';

$data = json_decode(file_get_contents("php://input"));
 $id=$data->id;
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
      $userEmail = $getUserInfo->user_email;
      $userHash = $getUserInfo->user_hash;
      $social_type = $getUserInfo->user_social_type;
    }
  }

}

$html='';

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
                                                    <p style="text-align:justify;font:14px Helvetica Neue,Helvetica,Arial,sans-serif;color:#777777;line-height:21px;margin:15px 0 0 0;padding:0">You signed up successfully in our website. Here is some important information about your new account.</p>
                                                </td>
                                                <td>&nbsp;</td>
                                            </tr>

                                            <tr>
                                                <td height="50">&nbsp;</td>
                                                <td> 
                                                    <p style="font:14px Helvetica Neue,Helvetica,Arial,sans-serif;color:#777777;margin:20px 0 5px 0;padding:0">Your Name:</p>
                                                    <p style="font:14px Helvetica Neue,Helvetica,Arial,sans-serif;color:#1a1a1a;text-decoration:none"><?php echo $firstName; ?></p>
                                                    <p style="font:14px Helvetica Neue,Helvetica,Arial,sans-serif;color:#777777;margin:20px 0 5px 0;padding:0">Your Email Address:</p>
                                                    <p style="font:14px Helvetica Neue,Helvetica,Arial,sans-serif;color:#1a1a1a;text-decoration:none"><?php echo $userEmail; ?></p>
                                                    <?php if($social_type === ""): ?>
                                                    <p style="font:14px Helvetica Neue,Helvetica,Arial,sans-serif;color:#777777;margin:20px 0 5px 0;padding:0">It is recommended to activate your account. Please <b><a href="ticketchai.org/">verify_account.php?m=<?php echo base64_encode($userEmail); ?>&t=<?php echo base64_encode($userHash); ?>&ac=<?php echo base64_encode(Verify); ?>" target="blank">click here</a></b> to activate your account.</p>
                                                   <?php else : ?>
                                                    <p style="font:14px Helvetica Neue,Helvetica,Arial,sans-serif;color:#777777;margin:20px 0 5px 0;padding:0">Your account has been verified by <strong><?php echo $social_type; ?></strong> social site.</p>
                                                   <?php endif; ?>
                                                    
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
echo smtpmailer($userEmail, 'support@ticketchai.com', $firstName, 'Account verificaltion',"$html");

?>