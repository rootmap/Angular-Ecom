<?php
include './config/config.php';
include './lib/email/mail_helper_functions.php';
$userID = 0;

	$sqlorder=mysqli_query($con,"SELECT a.*,concat(u.user_first_name,' ',u.user_last_name) as user_fullname,o.order_user_id,oi.OI_id,o.order_payment_type,u.user_email 
FROM 
`cronjob` as a
LEFT JOIN orders as o on o.order_id=a.oid 
LEFT JOIN users as u on u.user_id=o.order_user_id 
LEFT JOIN order_items as oi on oi.OI_order_id=a.oid
WHERE a.status='1' LIMIT 5");
	$chkorder=mysqli_num_rows($sqlorder);
	if($chkorder!=0)
	{
	
	$orderarray=array();
	while($row=mysqli_fetch_object($sqlorder)):
		$orderarray[]=$row;	
	endwhile;	
	//curl http://www.ticketchai.com/auto_confirmation.php
	foreach($orderarray as $order):
	
	$orderID=$order->oid;
	$order_payment_type=$order->order_payment_type;
	$OI_id=$order->OI_id;
	
	if($order_payment_type=='eticket')
	{
		$attachmentpdfcore=file_get_contents(baseUrl('admin/orders/generate_admin_pdf.php?order_id=' . $OI_id));
        $attachmentpdf="../pdfticket/email_pdf/" . $attachmentpdfcore;

		//exit();
        $EmailSubject="Your Free Ticket order details from TicketChai | We are extreamly sorry for late.";
        $EmailBody=file_get_contents(baseUrl('email/body/order.php?order_id=' . $orderID));
        $sendMailStatus=sendEmailFunctionWithAttchment($order->user_email,$order->user_fullname, 'info@ticketchai.com', $EmailSubject, $EmailBody, $attachmentpdf);
	}
	else
	{
    $EmailSubject = "Your order details from TicketChai | We are extreamly sorry for late.";
    $EmailBody = file_get_contents(baseUrl('email/body/order.php?order_id=' . $orderID));
    $sendMailStatus = sendEmailFunction($order->user_email,$order->user_fullname, 'info@ticketchai.com', $EmailSubject, $EmailBody);
	}
	

    $statusAdminEmail = 0;
    if (getConfig("NEW_ORDER_NOTIFY_EMAIL_ADDRESS") != ""):
        $arrAdminEmail = explode(',', getConfig("NEW_ORDER_NOTIFY_EMAIL_ADDRESS"));
    
        if (!empty($arrAdminEmail)) {
            $EmailSubject = "New order notification from Ticketchai.com  | We are extreamly sorry for late.";
            $EmailBody = file_get_contents(baseUrl('email/body/order_admin.php?order_id=' . $orderID));
            $sendMailStatusAdmin = sendEmailFunctionWithArEmail($arrAdminEmail, 'Ticketchai.com Admin', 'info@ticketchai.com', $EmailSubject, $EmailBody);
        }
    endif;
	
	
	mysqli_query($con,"UPDATE cronjob SET status='2' WHERE id='".$order->id."'");
	
	endforeach;
	
	
	
	
	}
?>