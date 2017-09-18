<?php
include './config/config.php';
include './cms/plugin.php';
$cms = new plugin();
//session_write_close();
//$totalAmount = 0;
//$orderID = 357;

if (isset($_GET['trid']) AND isset($_GET['pms'])) {
      $trid = $_GET['trid'];
     $pms = $_GET['pms'];
    if ($pms == "success") {
        mysqli_query($con, "UPDATE orders SET order_status='paid' WHERE order_session_id='$trid'");
    } elseif ($pms == "fail") {
        mysqli_query($con, "UPDATE orders SET order_status='cancel' WHERE order_session_id='$trid'");
    } elseif ($pms == "cancel") {
        mysqli_query($con, "UPDATE orders SET order_status='cancel' WHERE order_session_id='$trid'");
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
        <span id="triger" ng-init="autoClick('<?php echo $trid;?>')"></span>
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
    </body>
</html>
