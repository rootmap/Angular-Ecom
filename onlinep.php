<?php
include './config/config.php';
include './cms/plugin.php';
$cms = new plugin();
$pyment_page = $cms->filename();


//$totalAmount = 0;
//$orderID = 357;

if (isset($_GET['trid']) AND isset($_GET['pms'])) {
    $trid = base64_decode($_GET['trid']);
    $_SESSION['order_s_id'] = $trid = $_GET['trid'];
    $oid = $_GET['u'];
    $pms = $_GET['pms'];
    if ($pms == "success") {
        mysqli_query($con, "UPDATE orders SET order_status='paid' WHERE order_session_id='$trid' AND order_id='$oid'");
    } elseif ($pms == "fail") {
        mysqli_query($con, "UPDATE orders SET order_status='cancel' WHERE order_session_id='$trid' AND order_id='$oid'");
    } elseif ($pms == "cancel") {
        mysqli_query($con, "UPDATE orders SET order_status='cancel' WHERE order_session_id='$trid' AND order_id='$oid'");
    }

}
session_start();
@session_regenerate_id();
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
        <span id="triger" ng-init="autoClick('<?php echo $trid; ?>', '<?php echo $oid; ?>')"></span>
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
                            <div class="text-center row">
<?php
if ($pms == "success") {
    ?>
                                    <h3 style="text-transform: uppercase; font-weight: bold;">THANK YOU</h3>
                                    <h5>Your Order is successfully paid, you will have your ticket on your email in few minute.</h5>
                                    <?php
                                } elseif ($pms == "fail") {
                                    ?>
                                    <h3 style="text-transform: uppercase; font-weight: bold;">Sorry, Please Try Again. </h3>
                                    <h5>Your Order was unsuccessful.</h5>
                                    <?php
                                } elseif ($pms == "cancel") {
                                    ?>
                                    <h3 style="text-transform: uppercase; font-weight: bold;">Sorry, You cancel your order. </h3>
                                    <h5>Your Order was unsuccessful due to cancel payment.You can continue purchase your desire event ticket by click continue shopping or you can goto your previous order history.</h5>
                                    <?php
                                }
                                ?>

                            </div>

                            <div class="row text-center">
                                <a href="<?php echo $cms->LbaseUrl(); ?>user_dashboard/user_order.php" class="btn btn-danger btn-raised glow">
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
                            </div>



                        </div>
                    </div>

                </div>



            </div>
            <!-- main content part ends here -->

<?php include 'include/footer.php'; ?>

        </div>




<?php echo $cms->angularJs(array('unsubscribeNewsletter_angular')); ?>
<?php echo $cms->fotterJs(array('unsubscribeNewsletter')); ?>


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
