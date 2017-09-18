<?php
include './config/config.php';
include './cms/plugin.php';
$cms = new plugin();

//$totalAmount = 0;
//$orderID = 357;

if (isset($_GET['total']) AND isset($_GET['oid'])) {
    $orderID = base64_decode($_GET['oid']);
     $sqlquery_string = "SELECT OE_order_id,OE_event_id,OE_user_id FROM order_events WHERE OE_session_id='$orderID' ORDER BY OE_id DESC LIMIT 1";
    $booking_event = mysqli_query($con, $sqlquery_string);
    //if(!empty($booking_event))
    $eventfetch = mysqli_fetch_array($booking_event);
    $event_id = $eventfetch['OE_event_id'];
    $user_id = $eventfetch['OE_order_id'];
    
        $extraforpaymentmethod = 3.5;
        $totalamount_withoutgateway=base64_decode($_GET['total']);
        //$totalamount_withoutgateway = base64_decode(500);
        $getextarapaymentamount = ($totalamount_withoutgateway * 3.5) / 100;
        $total_fees = $totalamount_withoutgateway + $getextarapaymentamount;
        $totalAmount = $total_fees;
    
}
//exit();
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
        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->
        <div growl></div>
        <?php echo $cms->FbSocialScript(); ?>
        <?php include 'include/navbar.php'; ?>
        <div growl></div>
        <div class="clearfix"></div>
        <div class="wrapper">
            <!-- main content part starts here -->
            <div class="main" style="background-color: transparent;margin-top:80px">
                <!-- Customers LogIn section starts here -->
                <div class="section-simple2">
              
                        <div class="row padd_btm_30">

                            <div class="container section-heading animated wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.02s">
                                <div class="text-center">
                                    <h4 style="text-transform: uppercase; font-weight: bold;">Please wait while we redirect you to payment gateway.</h4>
                                    <h1 class="title-404"><img src="<?php echo $cms->baseUrl(" assets/img/redirect.gif "); ?>"></h1>
                                </div>
                                <!--                        <form action="https://www.sslcommerz.com.bd/process/index.php" method="post" name="form1" id="sslform">-->
                                <form action="https://securepay.sslcommerz.com/gwprocess/v3/process.php" method="post" name="form1" id="sslform">    
                                    <input type="hidden" name="store_id" value="ticketchailive001"> 
                                    <input type="hidden" id="total_amount_ssl" name="total_amount" value="<?php echo $totalAmount; ?>">
                                    <input type="hidden" id="trans_id_ssl" name="tran_id" value="<?php echo $orderID; ?>">
                                    <input type="hidden" id="notify_url" name="success_url" value="<?php echo $cms->LbaseUrl(); ?>onlinep.php?u=<?php echo $user_id; ?>&trid=<?php echo $orderID; ?>&pms=success">
                                    <input type="hidden" id="fail_url" name="fail_url" value = "<?php echo $cms->LbaseUrl(); ?>onlinep.php?u=<?php echo $user_id; ?>&trid=<?php echo $orderID; ?>&pms=fail">
                                    <input type="hidden" id="cancle_url" name="cancel_url" value = "<?php echo $cms->LbaseUrl(); ?>onlinep.php?u=<?php echo $user_id; ?>&trid=<?php echo $orderID; ?>&pms=cancel">
                                </form>
                            </div>
                        </div>
                    
                </div>



            </div>
            <!-- main content part ends here -->

            <?php include 'include/footer.php'; ?>

        </div>




        <?php echo $cms->angularJs(array('unsubscribeNewsletter_angular')); ?>
        <?php echo $cms->fotterJs(array('unsubscribeNewsletter')); ?>


        <script>
                    $(document).ready(function () {
                        $('#sslform').submit();
                    });
        </script>
        
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
