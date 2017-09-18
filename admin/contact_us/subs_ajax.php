<?php

include '../../config/config.php';
require '../../lib/PHPMailer/PHPMailerAutoload.php';
$mail = new PHPMailer();
if (!checkAdminLogin()) {
    echo 0;
} else {
    //ajax operation start from here 
    extract($_POST);
    if ($st == 1) {
        $sqlintert = mysqli_query($con, "INSERT INTO subscription (head,content,image) VALUES ('$title','$content','$image_name')");
        if ($sqlintert == 1) {
            echo 1;
        } else {
            echo 2;
        }
    } elseif ($st == 2) {
        $sqlintert = mysqli_query($con, "DELETE FROM subscription WHERE id='$id'");
        if ($sqlintert == 1) {
            echo 1;
        } else {
            echo 2;
        }
    } elseif ($st == 3) {
        //http://www.tic/ketchai.com/admin/contact_us/image/
        $ddss = 0;
        $sqs = mysqli_query($con, "SELECT * FROM subscription where id='$id'");
        if (!empty($sqs)) {
            $dd = mysqli_fetch_array($sqs);
            $title = $dd['head'];
            $content = $dd['content'];
            $image = $dd['image'];


            //include('../../lib/email/mail_helper_functions.php');

            $mail->setFrom('support@ticketchai.com', 'Ticket Chai');
            $mail->addReplyTo('support@ticketchai.com', 'Ticket Chai');
            //$mail->addAddress("$customer_email", "$customer_name");

            $mail->Subject = $title;
            //$EmailSubject = $title;
            $EmailBody = "";
            if ($image != '') {
                $EmailBody .="<img src='http://www.ticketchai.com/admin/contact_us/image/" . $image . "' />";
            }
            $EmailBody .=nl2br($content);

            $mail->msgHTML($EmailBody);
            $mail->AltBody = 'This is a plain-text message body';

            $ss = mysqli_query($con, "SELECT email,full_name from subscribe_customer_list");
            while ($dss = mysqli_fetch_array($ss)) {
                //sendEmailFunction($dss['email'], $dss['full_name'], 'noreply@ticketchai.com', $EmailSubject, $EmailBody);
                echo $customer_email = $dss['email'];
                $customer_name = $dss['full_name'];
                $mail->addAddress("$customer_email", "$customer_name");
                if (!$mail->send()) {
                    $ddss+=0;
                } else {
                    $ddss+=1;
                }
            }
        }

        echo $ddss;
    } elseif ($st == 4) {
        $sqlintert = mysqli_query($con, "INSERT INTO subscribe_customer_list (full_name,email,phone,gender) VALUES ('$full_name','$email','$phone','$gender')");
        if ($sqlintert == 1) {
            echo 1;
        } else {
            echo 0;
        }
    } elseif ($st == 5) {
        $sqlintert = mysqli_query($con, "DELETE FROM subscribe_customer_list WHERE id='$id'");
        if ($sqlintert == 1) {
            echo 1;
        } else {
            echo 2;
        }
    } elseif ($st == 6) {
        $sqlintert = mysqli_query($con, "UPDATE subscription SET content='$content',head='$title',image='$image_name',date='".date('Y-m-d')."',status='1' WHERE id='".$id."'");
        if ($sqlintert == 1) {
            echo base64_encode("Successfully Updated.");
        } else {
            echo 2;
        }    
    } else {
        echo 0;
    }
    //ajax operation end from here
}
?>