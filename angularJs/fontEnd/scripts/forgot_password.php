<?php

include '../config/config.php';
include '../lib/email/mail_helper_functions.php';


require_once '../DBconnection/database_connections.php';
$data = json_decode(file_get_contents("php://input"));

echo $user_id=$data->user_id;
//$name = $data->name;
//@$email = $data->email;
$sub ='New password create';
//$msg = $data->msg;

$sql="SELECT * FROM `users` WHERE `user_id`=$user_id";
$result=  mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($result)) {
    $email=$row['user_email'];
    $name=$row['user_first_name'];

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
                                                    <td colspan="3" style="text-align:center"><img width="161" border="0" alt="ticketchai" src="http://ticketchai.com/images/ticketchai_logo.png" class="ticketchai_logo"></td>
                                                </tr>
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
                                                        <p style="text-align:justify;font:14px Helvetica Neue,Helvetica,Arial,sans-serif;color:#777777;line-height:21px;margin:15px 0 0 0;padding:0">Hello '."$name".'</p>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                </tr>

                                                <tr>
                                                    <td height="50">&nbsp;</td>
                                                    <td> 
                                                        <p style="font:14px Helvetica Neue,Helvetica,Arial,sans-serif;color:#777777;margin:20px 0 5px 0;padding:0">Thank you for sending your query through ticketchai. </p>
                                                        <p style="font:14px Helvetica Neue,Helvetica,Arial,sans-serif;color:#777777;margin:20px 0 5px 0;padding:0">Your requesting contact subject is <strong>'."$sub".'</strong> and details is - <strong>'."$email".'</strong> </p>
                                                        <a href="../reset-password.php?user_id="'.$user_id.'"><p>Pleae click this link to reset your forgot password...</p></a>
                                                        <p style="font:14px Helvetica Neue,Helvetica,Arial,sans-serif;color:#777777;margin:20px 0 5px 0;padding:0">Ticketchai will contact with you for further extension.</p>
                                                        
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


//echo $mail = sendEmailFunctionWithAttchment($UserEmail = "ticketChai Email", $UserName = "ticketChai", $ReplyToEmail = "dfname", $EmailSubject = "Order Details", $EmailBody = "$html", $attchmentlinkandname = 'ty');

 sendEmailFunction($UserEmail = '$email', $UserName = '$name', $ReplyToEmail = 'info@ticketchai.com', $EmailSubject = '$sub', $EmailBody = '$html');
//if ($mail == true) {
//    echo 'ok';
//} else {
//    echo 'not ok';
//}
?>