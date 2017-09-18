<?php
require_once './DBconnection/database_connections.php';
include './config/config.php';
include './cms/plugin.php';
$cms = new plugin();
include './email/mail_helper_functions.php';
$userID = 0;
$sessionID = session_id();
$orderStatus = '';
$paymentMethod = '';
$orderID = 0;
$statusMsg = '';
$status = 0;
if (isset($_GET['status']) AND isset($_GET['amount']) AND isset($_GET['oid'])) {
    unset($_SESSION['SESS_ORDER_ID']);
    $orderStatus = validateInput($_GET['status']);
    $paymentMethod = validateInput(json_decode($_GET['amount']));
    //$decode_order_id=  base64_decode($_GET['oid']);
    $orderID = validateInput($_GET['oid']);
    //echo base64_decode($orderID);
    $getacualdetailsql = "SELECT a.*,e.event_id FROM order_movie_event as a 
LEFT JOIN event_movie_list as e on e.movie_id=a.movie_id WHERE a.order_id='" . $orderID . "'";
    $queryacualdetail = mysqli_query($con, $getacualdetailsql);
    $chkactual = mysqli_num_rows($queryacualdetail);
    $useractual = array();
    while ($rowact = mysqli_fetch_object($queryacualdetail)):
        $useractual[] = $rowact;
    endwhile;
    //echo var_dump($useractual);
    //    echo base64_decode($_GET['amount']);
    //exit();




    if ($orderStatus == "success") {
        $payst = "paid";
    } elseif ($orderStatus == "booking") {
        $payst = "process";
    } else {
        $payst = "cancel";
    }



    $userID = $useractual[0]->customer_id;
    $phone = $useractual[0]->mobile;
    $movie_id = $useractual[0]->movie_id;
    $seat_quantity = $useractual[0]->seat;
    $seat_unit_amount = $useractual[0]->seat_unit_price;
    $seat_amount = $seat_quantity * $seat_unit_amount;
    $total_order_amount = base64_decode($_GET['amount']);
    $full_name = $useractual[0]->fullname;
    $lid = $useractual[0]->lid;
    $trx_id = $useractual[0]->trx_id;
    $dtmsid = $useractual[0]->dtmsid;
    $email = $useractual[0]->email;
    $email_for_movie = $useractual[0]->email;
    $full_name_for_movie = $useractual[0]->fullname;
    $mobile = $useractual[0]->mobile;
    $event_id = $useractual[0]->event_id;
    $orderDBID = $useractual[0]->verified_order_id;

    $asd = array("OI_id" => 0);
    $ssqqq = "SELECT * FROM order_items WHERE OI_order_id='" . $orderDBID . "' ORDER BY OI_id ASC LIMIT 1";
    $ss = mysqli_query($con, $ssqqq);
    if ($ss) {
        while ($sss = mysqli_fetch_object($ss)) {
            $asd[] = $sss;
        }
    } else {
        if (DEBUG) {
            $err = "resultOrderDetails error: " . mysqli_error($con);
        } else {
            $err = "resultOrderDetails query failed";
        }
    }

    $pdf_order_id = @$asd[0]->OI_id;

    //order process
    if ($payst == "paid") {
        //echo $payst;
        include "./admin/event/blockbuster_api_class/GenerateSecretKey.php";
        $api = new XmlToJson();
        $api->SecureBookingConfirm($dtmsid, $lid, $trx_id);
        //$api->SecureBookingCancel($dtmsid, $lid, $trx_id);


        $getacualdetailsql = "UPDATE order_movie_event SET verified_order_id='" . $orderDBID . "' WHERE order_id='" . $orderID . "'";
        $queryacualdetail = mysqli_query($con, $getacualdetailsql);
        $updateorder_status = "UPDATE orders SET order_status='" . $payst . "',order_total_amount='" . $total_order_amount . "' WHERE order_id='" . $orderDBID . "'";
        $updateorderstquery = mysqli_query($con, $updateorder_status);
         $attachmentpdfcore = file_get_contents('http://ticketchai.org/user_dashboard/download-ticket_in_dirMovie.php?order_id='. $orderID . "&order_status=$payst");
        $attachmentpdf = "./pdf/" . $attachmentpdfcore;
    
//        @$attachmentpdfcore = file_get_contents($cms->LbaseUrl('orders/admin/generate_admin_pdf.php?order_id=' . $pdf_order_id . "&quantity=1"));
//        @$attachmentpdf = "pdfticket/email_pdf/" . $attachmentpdfcore;
        //echo $attachmentpdf;
        $EmailSubject = "Your Movie Ticket - details from TicketChai";
        @$EmailBody = file_get_contents($cms->LbaseUrl('email/body/order_movie_ticket.php?order_id=' . $orderID));
        $sendMailStatus = sendEmailFunctionWithAttchment($email_for_movie, $full_name_for_movie, 'support@ticketchai.com', $EmailSubject, $EmailBody, $attachmentpdf);
    } else {
        include "./admin/event/blockbuster_api_class/GenerateSecretKey.php";
        $api = new XmlToJson();
        $api->SecureBookingCancel($dtmsid, $lid, $trx_id);
        $getacualdetailsql = "UPDATE order_movie_event SET verified_order_id='" . $orderDBID . "' WHERE order_id='" . $orderID . "'";
        $queryacualdetail = mysqli_query($con, $getacualdetailsql);
        $updateorder_status = "UPDATE orders SET order_status='" . $payst . "' WHERE order_id='" . $orderDBID . "'";
        $updateorderstquery = mysqli_query($con, $updateorder_status);
        $EmailSubject = "Your Movie Ticket - details from TicketChai";
        $EmailBody = file_get_contents($cms->LbaseUrl('email/body/order_movie_ticket.php?order_id=' . $orderID));
        $sendMailStatus = sendEmailFunction($email_for_movie, $full_name_for_movie, 'support@ticketchai.com', $EmailSubject, $EmailBody);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/fav1.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <?php echo $cms->pageTitle("Processing to ssl | Ticket Chai"); ?>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

        <?php echo $cms->headCss(array('unsubscribe_newsletter')); ?>
    </head>

    <body class="index-page signin" ng-app="frontEnd" ng-controller="unsubscribe_newsletterController">

        <?php echo $cms->FbSocialScript(); ?>
        <?php // include 'include/navbar.php'; ?>
        <div growl></div>
        <div class="clearfix"></div>
        <div class="wrapper">
            <!-- main content part starts here -->
            <div class="signup" style="background-color: transparent;margin-top:80px">
                <!-- Customers LogIn section starts here -->
                <div class="section-simple2">
                    <center><div class="common-box">
                        <article class="success-content">
                            <?php echo $statusMsg; ?>
                            <?php if ($payst == "paid") { ?>
                                <h2 class="text-success">Thank You, Your Ticket is successfully Confirmed.</h2>
                                <p>We've sent ticket to your email <strong><?php echo $email; ?></strong> with order details.</p>
                                <p>if you Don't see it in Inbox? Please check your Email spam folder.</p>
                                <a href="<?php echo $cms->LbaseUrl(); ?>movies.php" class="btn btn-md btn-success-outline waves-effect margin-top-10 margin-bottom-20">Continue to Shopping</a>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo $cms->LbaseUrl(); ?>user_dashboard/user_order.php" class="btn btn-md btn-success-outline waves-effect margin-top-10 margin-bottom-20">Go Order History</a>
                            <?php } else { ?>
                                <h2 class="text-success">Sorry, Your Ticket purchase is not completed successfully.</h2>
                                <p>We've are sorry for this inconvenience. But you can book tickets again.</p>
                                <p>Also you can check your order history for the record.</p>
                                <a href="<?php echo $cms->LbaseUrl(); ?>movies.php" class="btn btn-md btn-success-outline waves-effect margin-top-10 margin-bottom-20" >Continue to Shopping</a>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo $cms->LbaseUrl(); ?>user_dashboard/user_order.php" class="btn btn-md btn-success-outline waves-effect margin-top-10 margin-bottom-20">Go Order History</a>
                            <?php } ?>
                        </article>
                    </div>

                   
                </div>
                 <?php //include 'include/footer.php'; ?>
            </div>
            <?php echo $cms->fotterJs(array('unsubscribeNewsletter')); ?>
           <?php //echo $cms->angularJs(array('unsubscribeNewsletter_angular')); ?>
        
    </body>
</html>