<?php
include '../DBconnection/auth.php';
require_once '../DBconnection/database_connections.php';
require_once '../../cms/merchantPlugin.php';
$cms=new plugin();
require_once('phpmailer/class.phpmailer.php');
include 'mail_helper_functions.php';

$cur_year = date('Y');

/* Data convert by jeson start here */
$data = json_decode(file_get_contents("php://input"));
/*./Data convert by jeson end here*/

$event=$data->event_id;
$ticket=$data->TicketName;


//$msg = $data->msg;
//meetourprograammers
//$sql = "SELECT * FROM `events` WHERE `event_url`='$uri' ORDER BY event_id DESC";

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


$sqlevent = "SELECT ett.*,e.event_title FROM `event_ticket_types` as ett 
LEFT JOIN `events` as e on ett.TT_event_id=e.event_id
WHERE ett.`TT_event_id`='$event' AND  ett.`TT_type_title`='$ticket' ORDER BY ett.TT_id DESC";

$resultevent = mysqli_query($con, $sqlevent);
while ($rowevent = mysqli_fetch_array($resultevent)) {
    $EventName = $rowevent['event_title'];
    $ticketName = $rowevent['TT_type_title'];
    $ticketQuantity = $rowevent['TT_ticket_quantity'];
    $ticketType= $rowevent['TT_type_title'];
    $StartDateTime = $rowevent['TT_created_on'];
    $EndDateTime = $rowevent['TT_created_by'];
   
}

$sub = 'your event '.$EventName.' created a new ticket info.';

$html = '';


$html .= '<html>    
    <body>

        <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#f5f5f5">
            <tbody>
                <tr>
                    <td>
                        <table width="500" cellspacing="0" cellpadding="0" border="0" align="center">
                            <tbody>


                                <tr>
                                    <td height="50">
                                        <table width="650" cellspacing="0" cellpadding="10" border="0" bgcolor="#FFFFFF" style="border:1px solid #88C659; border-radius: 4px; font-family:arial; padding:0;margin:0">
                                            <tbody>
                                                <tr style="background:#88C659;">
                                                    <td colspan="3" class="m_3400397995181562166m_8401342642413116184m_-1842238349812301262ecxfirst" valign="top" style="text-align:center; padding-top: 50px; padding-bottom: 50px;">
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
                                                    <td colspan="3"  style="font-weight:bold; font-size:18px; color:#4585F3;line-height:25px; text-align:center"><h3>Ticket Details</h3></td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>
                                                        <p style="font:22px Helvetica Neue,Helvetica,Arial,sans-serif;font-weight:bold;margin:0px 0 0 0;padding:0;color:#000">Hello ' . "$name" . ',</p>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                </tr>

                                                <tr>
                                                    <td height="50">&nbsp;</td>
                                                    <td> 

                                                        <p  style="font-weight:bold; font-size:16px; color:#607D8B;line-height:25px; text-align: justify;">
                                                            We would like to inform you that, the event ticket registered on our portal http://www.ticketchai.com/ has been published.
                                                        </p>

                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <tr><td height="50">&nbsp;</td>
                                                    <td> 
                                                        <h4 style="background:#ccc; padding:5px; border-radius:5px;"> Your event ticket is created using these info. </h4>
                                                        <table>
                                                            <tbody>
                                                                <tr>
                                                                    <td style="font-size:12px;padding:7px 9px 9px 9px;" valign="top">
                                                                        <span style="font-weight:bold; font-size:16px; color:#4585F3;line-height:30px; padding: 5px;">
                                                                            Event Name:</span> '.$EventName.'<br>
                                                                        
                                                                        <span style="font-weight:bold; font-size:16px; color:#4585F3;line-height:30px; padding: 5px;">
                                                                            Ticket Name:</span> '.$ticketName.'<br>
                                                                                
                                                                        <span style="font-weight:bold; font-size:16px; color:#4585F3;line-height:30px; padding: 5px;">
                                                                            Quantity:</span> '.$ticketQuantity.'<br>
                                                                                
                                                                        <span style="font-weight:bold; font-size:16px; color:#4585F3;line-height:30px; padding: 5px;">
                                                                            Start Date & time:</span> '.$StartDateTime.'<br>
                                                                                
                                                                        <span style="font-weight:bold; font-size:16px; color:#4585F3;line-height:30px; padding: 5px;">
                                                                            End Date & time:</span> '.$EndDateTime.'<br>
                                                                        
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        

                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td height="50">&nbsp;</td>
                                                    <td>
                                                        <p style="font:14px Helvetica Neue,Helvetica,Arial,sans-serif;color:#777777;line-height:21px;margin:0;padding:0" align="center">
                                                            <a target="_blank" href="http://ticketchai.com/ticketchaiorg/checkout1.php?id='.$event_id.'">Browse Your Event. <span style="color:#09f;">click here.</span></a>
                                                        </p>

                                                        <p style="font:14px Helvetica Neue,Helvetica,Arial,sans-serif;font-weight:bold; text-align:center; margin:10px 0 10px 0;padding:10px 0 0 0;color:#000000">Thank You For Choosing Ticketchai.com</p></td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td height="8" background="" colspan="3"></td>
                                                </tr>
                                                <tr style="background:#88C659;">
                                                    <td colspan="3" class="m_3400397995181562166m_8401342642413116184m_-1842238349812301262ecxlast" align="center">
                                            <center>
                                                <p style="font-size:14px; color:#FFF; font-weight: bold;">Copyright &copy;  '.$cur_year.' <a style="color:#ffffff" href="http://ticketchai.com" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://ticketchai.com&amp;source=gmail&amp;ust=1483683976103000&amp;usg=AFQjCNEn0Wp8DcP-jBhp1aRqvsQUfU6F5Q">ticketchai.com</a> Ltd. All Rights Reserved</p>
                                            </center>
                                    </td>
                                </tr>
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


//echo $html;X:\ticketchai_aj\merchant-dashboard\email\merchentAccountCreation.php

// smtpmailer('to@gmail.com', 'from@gmail.com', $name, $sub,"$html");

echo smtpmailer($email, 'support@ticketchai.com', $name, $sub,$html);
?>