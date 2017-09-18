<?php

/**
 * This function used to send emails using PHP Mailer Class<br>
 * @input: $UserEmail, $UserName, $ReplyToEmail, $EmailSubject, $EmailBody; return true/$status(if error)
 * used for signup.php
 */
function sendEmailFunction($UserEmail = '', $UserName = '', $ReplyToEmail = '', $EmailSubject = '', $EmailBody = '') {

    global $config;
    $status = '';

    if ($UserEmail == '' OR $UserName == '' OR $EmailSubject == '' OR $EmailBody == '') {
        $status = "Parameters missing.";
    } else {
        //require_once(basePath("lib/email/class.phpmailer.php"));
        $mail = new PHPMailer();
        $mail->Host = get_option('SMTP_SERVER_ADDRESS');
        $mail->Port = get_option('SMTP_PORT_NO');
        $mail->SMTPSecure = 'ssl';
       // $mail->IsSMTP(); // send via SMTP
        $mail->SMTPDebug = 1;
        //IsSMTP(); // send via SMTP
        $mail->SMTPAuth = true; // turn on SMTP authentication
        $mail->Username = get_option('HOSTING_ID'); // Enter your SMTP username
        $mail->Password = get_option('HOSTING_PASS'); // SMTP password
        $webmaster_email = get_option('EMAIL_ADDRESS_GENERAL'); //Add reply-to email address
        $email = $UserEmail; // Add recipients email address
        $name = $UserName; // Add Your Recipient's name
        $mail->From = get_option('EMAIL_ADDRESS_GENERAL');
        $mail->FromName = get_option('EMAIL_ADDRESS_NAME');
        $mail->AddAddress($email, $name);
        $mail->AddReplyTo("info@ticketchai.com", "TicketChai");
        //$mail->extension=php_openssl.dll;
        $mail->WordWrap = 50; // set word wrap
        // $mail->AddAttachment("/var/tmp/file.tar.gz"); // attachment
        // $mail->AddAttachment("/tmp/image.jpg", "new.jpg"); // attachment
        $mail->IsHTML(true); // send as HTML
        $mail->Subject = $EmailSubject;
        $mail->Body = $EmailBody;
        $mail->AltBody = $mail->Body;

        if (!$mail->Send()) {

            $status = "Email sending failed.";
        } else {
            $status = '';
        }
    }

    if ($status == '') {
        return true;
    } else {
        return $status;
    }
}

function sendEmailFunctionWithArEmail($UserEmail = array(), $ReplyToEmail = '', $EmailSubject = '', $EmailBody = '') {

    global $config;
    $status = '';

    if (count($UserEmail) == 0 OR $EmailSubject == '' OR $EmailBody == '') {
        $status = "Parameters missing.";
    } else {
       // require_once(basePath("lib/email/class.phpmailer.php"));
        $mail = new PHPMailer();
        $mail->Host = get_option('SMTP_SERVER_ADDRESS');
        $mail->Port = get_option('SMTP_PORT_NO');
        $mail->SMTPSecure = 'ssl';
        //$mail->IsSMTP(); // send via SMTP
        $mail->SMTPDebug = 1;
        //IsSMTP(); // send via SMTP
        $mail->SMTPAuth = true; // turn on SMTP authentication
        $mail->Username = get_option('HOSTING_ID'); // Enter your SMTP username
        $mail->Password = get_option('HOSTING_PASS'); // SMTP password
        $webmaster_email = get_option('EMAIL_ADDRESS_GENERAL'); //Add reply-to email address

        //$email = $UserEmail; // Add recipients email address
        //$name = $UserName; // Add Your Recipient's name

        $mail->From = get_option('EMAIL_ADDRESS_GENERAL');
        $mail->FromName = get_option('EMAIL_ADDRESS_NAME');

        if (!empty($UserEmail)) {
            foreach ($UserEmail as $ema):
                $mail->AddAddress($ema);
            endforeach;
        }

        $mail->AddReplyTo("info@ticketchai.com", "TicketChai");
        //$mail->extension=php_openssl.dll;
        $mail->WordWrap = 50; // set word wrap
        // $mail->AddAttachment("/var/tmp/file.tar.gz"); // attachment
        // $mail->AddAttachment("/tmp/image.jpg", "new.jpg"); // attachment
        $mail->IsHTML(true); // send as HTML
        $mail->Subject = $EmailSubject;
        $mail->Body = $EmailBody;
        $mail->AltBody = $mail->Body;

        if (!$mail->Send()) {

            $status = "Email sending failed.";
        } else {
            $status = '';
        }
    }

    if ($status == '') {
        return true;
    } else {
        return $status;
    }
}

function sendEmailFunctionWithAttchment($UserEmail = '', $UserName = '', $ReplyToEmail = '', $EmailSubject = '', $EmailBody = '', $attchmentlinkandname = '') {

    global $config;
    $status = '';

    if ($UserEmail == '' OR $UserName == '' OR $EmailSubject == '' OR $EmailBody == '') {
        $status = "Parameters missing.";
    } else {
       // require_once(basePath("lib/email/class.phpmailer.php"));
        $mail = new PHPMailer();
        $mail->Host = get_option('SMTP_SERVER_ADDRESS');
        $mail->Port = get_option('SMTP_PORT_NO');
        $mail->SMTPSecure = 'ssl';
        //$mail->IsSMTP(); // send via SMTP
        $mail->SMTPDebug = 1;
        //IsSMTP(); // send via SMTP
        $mail->SMTPAuth = true; // turn on SMTP authentication
        $mail->Username = get_option('HOSTING_ID'); // Enter your SMTP username
        $mail->Password = get_option('HOSTING_PASS'); // SMTP password
        $webmaster_email = get_option('EMAIL_ADDRESS_GENERAL'); //Add reply-to email address
        $email = $UserEmail; // Add recipients email address
        $name = $UserName; // Add Your Recipient's name
        $mail->From = get_option('EMAIL_ADDRESS_GENERAL');
        $mail->FromName = get_option('EMAIL_ADDRESS_NAME');
        $mail->AddAddress($email, $name);
        $mail->AddReplyTo("info@ticketchai.com", "TicketChai");
        //$mail->extension=php_openssl.dll;
        $mail->WordWrap = 50; // set word wrap
        if (!empty($attchmentlinkandname)) {
            $mail->AddAttachment($attchmentlinkandname); // attachment
        }
        // $mail->AddAttachment("/tmp/image.jpg", "new.jpg"); // attachment
        $mail->IsHTML(true); // send as HTML
        $mail->Subject = $EmailSubject;
        $mail->Body = $EmailBody;
        $mail->AltBody = $mail->Body;

        if (!$mail->Send()) {

            $status = "Email sending failed.";
        } else {
            $status = '';
        }
    }

    if ($status == '') {
        return true;
    } else {
        return $status;
    }
}






function smtpmailer($to, $from, $from_name, $subject, $body, $attchmentlinkandname = '') { 
        define('GUSER', 'support@ticketchai.com'); // GMail username
        define('GPWD', 'TicketChai@2016'); // GMail password
	global $error;
        require_once('phpmailer/class.phpmailer.php');
	$mail = new PHPMailer();  // create a new object
	//$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug =1;  // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true;  // authentication enabled
        $mail->SMTPSecure = false;
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 465; 
        
	$mail->Username = GUSER;  
	$mail->Password = GPWD;           
	$mail->SetFrom($from, $from_name);
	$mail->Subject = $subject;
        
        if (!empty($attchmentlinkandname)) {
            $mail->AddAttachment($attchmentlinkandname); // attachment
        }
        
        
        $mail->IsHTML(true); // send as HTML
        
        $mail->Body = $body;
        $mail->AltBody = $mail->Body;
	
	$mail->AddAddress($to);
	if(!$mail->Send()) {
		return $error = 'Mail error: '.$mail->ErrorInfo; 
		//return false;
	} else {
		return $error = '1';
		//return true;
	}
}






?>