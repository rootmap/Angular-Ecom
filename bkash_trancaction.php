<?php
include'DBconnection/database_connections.php';
//include './config/config.php';
include './email/mail_helper_functions.php';
include './cms/plugin.php';
$cms = new plugin();

$userID = 0;
$sessionID = session_id();
$orderStatus = '';
$paymentMethod = '';
$orderID = 0;
$statusMsg = '';
$status = 0;
$payst = '';

if (isset($_GET['oid']) AND isset($_GET['status'])) {
    $orderStatus = base64_decode($_GET['status']);
    //$decode_order_id=$_GET['oid'];
    $orderID = base64_decode($_GET['oid']);
    // echo $orderID;
    $sqlconfirm = "SELECT * FROM orders WHERE order_session_id='" . $orderID . "'";
    $queryconfirm = mysqli_query($con, $sqlconfirm);
    $chkordercheck = mysqli_num_rows($queryconfirm);
    //for movie 
    $sqlconfirm1 = "SELECT * FROM order_movie_event WHERE order_id='" . $orderID . "'";
    $queryconfirm1 = mysqli_query($con, $sqlconfirm1);
    $chkordercheck1 = mysqli_num_rows($queryconfirm1);
    // if ($chkordercheck == 0) {
    if ($chkordercheck > 0 || $chkordercheck1 > 0) {

        //movie detail end
        $getacualdetailsql = "SELECT a.*,e.event_id FROM order_movie_event as a 
LEFT JOIN event_movie_list as e on e.movie_id=a.movie_id WHERE a.order_id='" . $orderID . "' GROUP BY a.order_id";
        $queryacualdetail = mysqli_query($con, $getacualdetailsql);
        $chkactual = mysqli_num_rows($queryacualdetail);
        //echo $chkactual;
        if ($chkactual != 0) {

            $useractual = array();
            while ($rowact = mysqli_fetch_object($queryacualdetail)):
                $useractual[] = $rowact;
            endwhile;

            unset($_SESSION['SESS_ORDER_ID']);
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


            if ($orderStatus == "success") {
                $payst = "paid";
            } elseif ($orderStatus == "cancel") {
                $payst = "cancel";
            } else {
                $payst = "booking";
            }
            $asd = array();

            $ssqqq = "SELECT * FROM order_items WHERE OI_order_id='" . $orderDBID . "' ORDER BY OI_id ASC LIMIT 1";
            $ss = mysqli_query($con, $ssqqq);
            if ($ss) {
                while ($sss = mysqli_fetch_object($ss)) {
                    $asd[] = $sss;
                }
            } else {
                if (true) {
                    $err = "resultOrderDetails error: " . mysqli_error($con);
                } else {
                    $err = "resultOrderDetails query failed";
                }
            }

            @$pdf_order_id = $asd[0]->OI_order_id;
            //echo var_dump($asd);
            //exit();
            //echo $payst;
            //order process
            if ($payst == "paid") {
                //echo $payst;
                // print_r($asd);
                include "./admin/event/blockbuster_api_class/GenerateSecretKey.php";
                // $con= mysqli_connect("localhost", "ticketch_test_se", "@minul@2017", "ticketch_test_server");
                $api = new XmlToJson();
                //$api->SecureBookingCancel($dtmsid, $lid, $trx_id);
                $api->SecureBookingConfirm($dtmsid, $lid, $trx_id);

                $getacualdetailsql = "UPDATE order_movie_event SET verified_order_id='" . $orderDBID . "' WHERE order_id='" . $orderID . "'";
                $queryacualdetail = mysqli_query($con, $getacualdetailsql);
                $updateorder_status = "UPDATE orders SET order_status='" . $payst . "',order_total_amount='" . $total_order_amount . "' WHERE order_id='" . $orderDBID . "'";
                $updateorderstquery = mysqli_query($con, $updateorder_status);

                $EmailSubject = "Your Ticket " . $payst . " Info from TicketChai";
                $EmailBody = file_get_contents($cms->LbaseUrl('email/body/order_movie_ticket.php?order_id=' . $pdf_order_id . "&order_status=$payst"));

                $attachmentpdfcore = file_get_contents($cms->LbaseUrl('user_dashboard/download-ticket_in_dirMovie.php?o_id=' . $pdf_order_id));

                $attachmentpdf = "./pdf/" . $attachmentpdfcore;
                smtpmailer($email_for_movie, "support@ticketchai.com", $full_name_for_movie, $EmailSubject, $EmailBody, $attachmentpdf);
            } else {
                //$con = mysqli_connect("localhost", "ticketch_test_se", "@minul@2017", "ticketch_test_server");
                include "./admin/event/blockbuster_api_class/GenerateSecretKey.php";
                $api = new XmlToJson();
                $api->SecureBookingCancel($dtmsid, $lid, $trx_id);
                $getacualdetailsql = "UPDATE order_movie_event SET verified_order_id='" . $orderDBID . "' WHERE order_id='" . $orderID . "'";
                $queryacualdetail = mysqli_query($con, $getacualdetailsql);
                $updateorder_status = "UPDATE orders SET order_status='" . $payst . "' WHERE order_id='" . $orderDBID . "'";
                $updateorderstquery = mysqli_query($con, $updateorder_status);
                $EmailSubject = "Your Movie Ticket Cancel - Details From TicketChai";
                $EmailBody = file_get_contents($cms->LbaseUrl('email/body/order_movie_ticket.php?order_id=' . $pdf_order_id . "&order_status=$payst"));
                smtpmailer($email_for_movie, "support@ticketchai.com", $full_name_for_movie, $EmailSubject, $EmailBody);
            }
        } else {


            if ($orderStatus == "success") {
                $payst = "paid";
            } elseif ($orderStatus == "cancel") {
                $payst = "cancel";
            } else {
                $payst = "booking";
            }
            //$con = mysqli_connect("localhost", "ticketch_test_se", "@minul@2017", "ticketch_test_server");
            $uarr = array();

            $sqlordersql = "SELECT a.*,u.*
                            FROM orders as a 
                            LEFT JOIN temp_billing as u on u.user_id=a.order_user_id 
                            WHERE a.order_session_id='$orderID' AND u.order_id='$orderID'";

            $sqluserInfo = mysqli_query($con, $sqlordersql);

            $chkorder = mysqli_num_rows($sqluserInfo);
            if ($chkorder != 0) {

                //$con = mysqli_connect("localhost", "ticketch_test_se", "@minul@2017", "ticketch_test_server");

                while ($rowdata = mysqli_fetch_object($sqluserInfo)):
                    $uarr[] = $rowdata;
                endwhile;
//print_r($uarr);

                $user_email = $uarr[0]->user_email;
                $user_fullname = $uarr[0]->user_fullname;
                $user_id = $uarr[0]->user_id;
                $email = $user_email;
                $ssqqq = "SELECT * FROM order_items WHERE OI_session_id='" . $orderID . "' ORDER BY OI_id ASC LIMIT 1";
                $ss = mysqli_query($con, $ssqqq);
                if ($ss) {
                    while ($sss = mysqli_fetch_object($ss)) {
                        $asd[] = $sss;
                    }
                } else {
                    if (true) {
                        $err = "resultOrderDetails error: " . mysqli_error($con);
                    } else {
                        $err = "resultOrderDetails query failed";
                    }
                }





                //order process
                if ($payst == "paid") {

                    $ossqqq = "SELECT order_id FROM orders WHERE order_session_id='" . $orderID . "'";
                    $oss = mysqli_query($con, $ossqqq);
                    if ($oss) {
                        while ($odsss = mysqli_fetch_object($oss)) {
                            $ordersid[] = $odsss;
                        }
                    } else {
                        if (true) {
                            $err = "resultOrderDetails error: " . mysqli_error($con);
                        } else {
                            $err = "resultOrderDetails query failed";
                        }
                    }

                    @$ac_order_id = $ordersid[0]->order_id;

                    $updateorder_status = "UPDATE orders SET order_status='" . $payst . "' WHERE order_id='" . $ac_order_id . "' AND order_session_id='" . $orderID . "'";
                    $updateorderstquery = mysqli_query($con, $updateorder_status);

                    $EmailSubject = "Your Ticket " . $payst . " Info from TicketChai";
                    $EmailBody = file_get_contents($cms->LbaseUrl('email/body/order.php?oid=' . $ac_order_id . '&order_status=' . $payst . "&order_session=$orderID"));

                    $attachmentpdfcore = file_get_contents($cms->LbaseUrl('user_dashboard/download-ticket_in_dir.php?oid=' . $ac_order_id . "&order_session=$orderID"));

                    $attachmentpdf = "pdf/" . $attachmentpdfcore;
                    smtpmailer($user_email, "support@ticketchai.com", $user_fullname, $EmailSubject, $EmailBody, $attachmentpdf);
                } else {

                    $updateorder_status = "UPDATE orders SET order_status='" . $payst . "' WHERE order_id='" . $ac_order_id . "'";
                    $updateorderstquery = mysqli_query($con, $updateorder_status);

                    $EmailSubject = "Your Ticket " . $payst . " Info from TicketChai";
                    // $EmailBody = file_get_contents(baseUrl('email/body/order.php?order_id=' . $orderID));
                    // $sendMailStatus = sendEmailFunction($user_email, $user_fullname, 'f.bhuyian@gmail.com', $EmailSubject, $EmailBody);
                    $EmailBody = file_get_contents($cms->LbaseUrl('email/body/order.php?oid=' . $ac_order_id . '&order_status=' . $payst . "&order_session=$orderID"));
                    smtpmailer($user_email, "support@ticketchai.com", $user_fullname, $EmailSubject, $EmailBody);
                }
            } else {
                $status_confirm = "invalid";
                $email = "";
            }
        }
        //movie detail end    
    } else {


        $status_confirm = "invalid";
        $email = "";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <?php
        echo $cms->pageTitle("Bkash Payment| Ticket Chai");
        ?>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

        <?php
        echo $cms->headCss(array("sitemapSponsor"));
        ?>
    </head>
    <body class="signin" style="background-color: transparent;margin-top:100px" ng-app="frontEnd" ng-controller="bkashController">
        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->
        <script type="text/javascript">
                    window.fbAsyncInit = function () {
                        FB.init({
                            appId: '1866086476938296',
                            xfbml: true,
                            version: 'v2.8'
                        });
                    };

                    (function (d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) {
                            return;
                        }
                        js = d.createElement(s);
                        js.id = id;
                        js.src = "//connect.facebook.net/en_US/sdk.js";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));
        </script>
        <!--sdk for facebook and google login-->

        <div growl></div>
        <?php
        include 'include/navbar.php';
        ?>
        <div class="signin " >
            <!-- Customers LogIn section starts here -->
            <div class="section-simple2">
                <div class="container">
                    <div class="row padd_btm_30">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                            <div class="col-lg-12 col-md-8 col-sm-8 col-sm-offset-0 col-xs-12 well">

                                <article class="success-content text-center">
                                    <?php echo $statusMsg;
                                    ?>
                                    <?php if ($payst == "paid") { ?>
                                        <h3 class="text-success">Successfully Done<br>We've sent ticket in your email <strong><?php echo $email; ?></strong> with order details.</h3>
                                        <p>if you Don't see it in Inbox? Please check your Email spam folder.</p>
                                        <a href="<?php echo $cms->LbaseUrl(); ?>user_dashboard/user_order.php" class="btn btn-danger btn-raised glow" name="order">
                                            <strong style="font-size:14px; letter-spacing: 1.2px;">
                                            <!--<i class="material-icons">launch</i>-->
                                                <i class="fa fa-shopping-bag" aria-hidden="true"></i> Order History
                                            </strong>
                                        </a> 


                                        <a href="index.php" class="btn btn-primary btn-raised glow buy_tickets">
                                            <strong style="font-size:14px; letter-spacing: 1.2px;">
                                            <!--<i class="material-icons">shopping_cart</i>-->
                                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Continue Shopping
                                            </strong>
                                        </a>
                                    <?php } else { ?>
                                        <p>We've are sorry for this inconvenience. But you can book tickets again.</p>
                                        <p>Also you can check your order history for the record.</p>
                                        <a href="<?php echo $cms->LbaseUrl(); ?>user_dashboard/user_order.php" class="btn btn-danger btn-raised glow" name="order">
                                            <strong style="font-size:14px; letter-spacing: 1.2px;">
                                            <!--<i class="material-icons">launch</i>-->
                                                <i class="fa fa-shopping-bag" aria-hidden="true"></i> Order History
                                            </strong>
                                        </a> 


                                        <a href="index.php" class="btn btn-primary btn-raised glow buy_tickets">
                                            <strong style="font-size:14px; letter-spacing: 1.2px;">
                                            <!--<i class="material-icons">shopping_cart</i>-->
                                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Continue Shopping
                                            </strong>
                                        </a>
                                    <?php } ?>
                                </article>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Customers LogIn section ends here -->
                <!-- ticketchai simple section starts here -->
                <div class="section section-simple-close">
                    <div class="container">
                        <div class="row section_padd30">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-heading"></div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-content section_padd30 text-center"></div>
                        </div>
                    </div>
                </div>
                <!-- ticketchai simple section ends here -->
            </div>
            <!-- main content part ends here -->

            <?php include 'include/footer.php'; ?>
        </div>
        <!--        <div class="main" style="background-color: transparent;margin-top:100px">
                    <div class="container">
                        <div class="common-box">
                            
                        </div>
                    </div>
        <?php include 'include/footer.php'; ?>
                </div>-->
        <?php echo $cms->fotterJs(array('signin')); ?>
        <?php echo $cms->angularJs(array('bkash_angular')); ?>

        <script type="text/javascript">
                    $(document).ready(function () {
                        $('#subscription').hide();
                        setTimeout(function (a) {
                            $('#subscription').slideDown(1000);
                        }, 15000);
                        setTimeout(function (b) {
                            $('#subscription').slideUp(3000);
                        }, 30000);
                        $('#btn-sclose').click(function () {
                            $('#subscription').slideUp(1000);
                        });

                        $('#nav-search-btn').click(function () {
                            $('#nav-search-field').show();
                            $('#nav-search-btn').hide();
                        });
                        $('#nav-search-close').click(function () {
                            $('#nav-search-field').hide();
                            $('#rslt-div').hide();
                            $('#nav-search-btn').show();
                            $('#searchInput').val('');
                        });
                    });

                    setTimeout(function () {
                        $('#odometer1').html('50');
                        $('#odometer2').html('100');
                        $('#odometer3').html('200');
                        $('#odometer4').html('10000');
                    }, 1000);

        </script>
        <!--  Select Picker Plugin -->
        <!--searchbar script-->
        <script>
                    $(document).ready(function () {

                        $('.control').keyup(function () {

                            // If value is not empty
                            if ($(this).val().length == 0) {
                                // Hide the element
                                $('.show_hide').hide();
                            } else {
                                // Otherwise show it
                                $('.show_hide').show();
                            }
                        }).keyup();
                    });</script>
        <!--searchbar script-->
    </body>

</html>