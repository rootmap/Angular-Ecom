<?php
include './config/config.php';
include './lib/email/mail_helper_functions.php';
$userID = 0;
$sessionID = session_id();
session_regenerate_id();
$orderStatus = '';
$paymentMethod = '';
$orderID = 0;
$statusMsg = '';
$status = 0;
if (isset($_GET['oid'])) {
    unset($_SESSION['SESS_ORDER_ID']);
    $decode_order_id = base64_decode($_GET['oid']);
    $orderID = validateInput($decode_order_id);

    $getacualdetailsql = "SELECT a.*,e.event_id FROM order_movie_event as a 
LEFT JOIN event_movie_list as e on e.movie_id=a.movie_id WHERE a.order_id='" . $orderID . "'";
    $queryacualdetail = mysqli_query($con, $getacualdetailsql);
    $chkactual = mysqli_num_rows($queryacualdetail);
    $useractual = array();
    while ($rowact = mysqli_fetch_object($queryacualdetail)):
        $useractual[] = $rowact;
    endwhile;


    $userID = $useractual[0]->customer_id;
    $phone = $useractual[0]->mobile;
    $movie_id = $useractual[0]->movie_id;
    $seat_quantity = $useractual[0]->seat;
    $seat_unit_amount = $useractual[0]->seat_unit_price;
    $seat_amount = $seat_quantity * $seat_unit_amount;
    $seat_amount_order = base64_decode(validateInput($_GET['amount']));
    $full_name = $useractual[0]->fullname;
    $lid = $useractual[0]->lid;
    $trx_id = $useractual[0]->trx_id;
    $dtmsid = $useractual[0]->dtmsid;
    $email = $useractual[0]->email;
    $mobile = $useractual[0]->mobile;
    $event_id = $useractual[0]->event_id;
    $verified_order_id = $useractual[0]->verified_order_id;



    $payst = "booking";


    //order process
    //echo $payst;
//        include "./admin/event/blockbuster_api_class/GenerateSecretKey.php";
//        $api = new XmlToJson();
//        $api->SecureBookingCancel($dtmsid, $lid, $trx_id);
    //echo $attachmentpdf;

    $EmailSubject = "Your Movie Ticket - details from TicketChai";
    $EmailBody = file_get_contents(baseUrl('email/movieorderEmail.php?order_id=' . $orderID));
    //$sendMailStatus = sendEmailFunction($email, $full_name, 'noreply@ticketchai.com', $EmailSubject, $EmailBody);
    echo smtpmailer($email, 'support@ticketchai.com', $full_name, $EmailSubject, "$EmailBody");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <?php echo $cms->pageTitle("Processing to ssl | Ticket Chai"); ?>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

        <?php echo $cms->headCss(array('unsubscribe_newsletter')); ?>
    </head>
    <body class="home">
        <header>
            <div class="header-wrapper">
                <?php echo $cms->FbSocialScript(); ?>
                <?php include 'include/navbar.php'; ?>
            </div>
        </header>

        <div class="main" style="background-color: transparent;margin-top:80px">
            <!-- Customers LogIn section starts here -->
            <div class="section-simple2">
                <div class="cart-page-head">
                    <h1><i class="fa fa-check"></i> Thank You </h1>
                </div>
                <div class="common-box">
                    <article class="success-content">
                        <?php echo $statusMsg; ?>
                        <?php if ($payst == "booking") { ?>
                            <p>We've sent ticket detail to your email <strong><?php echo $email; ?></strong> with order details.</p>

                            <p>if you Don't see it in Inbox? Please check your Email spam folder.</p>
                            <a href="<?php echo baseUrl(); ?>home" class="btn btn-primary btn-sm margin-top-10 margin-bottom-20">Continue to Shopping</a>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="<?php echo baseUrl(); ?>myorderlist" class="btn btn-primary btn-sm margin-top-10 margin-bottom-20">Go Order History</a>
                        <?php } else { ?>
                            <p>We've are sorry for this inconvenience. But you can book tickets again.</p>
                            <p>Also you can check your order history for the record.</p>
                            <a href="index.php" class="btn btn-primary btn-sm margin-top-10 margin-bottom-20">Continue to Shopping</a>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="<?php echo $cms->LbaseUrl(); ?>user_dashboard/user_order.php" class="btn btn-danger btn-raised glow" name="order">
                                <strong style="font-size:14px; letter-spacing: 1.2px;">
                                <!--<i class="material-icons">launch</i>-->
                                    <i class="fa fa-shopping-bag" aria-hidden="true"></i> Order History
                                </strong>
                            </a> 
                        <?php } ?>
                    </article>
                </div>
                <?php include 'include/footer.php'; ?>

            </div>
        </div>
        <?php echo $cms->fotterJs(array('unsubscribeNewsletter')); ?>
    </body>
</html>