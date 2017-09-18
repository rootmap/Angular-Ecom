
<?php
include'DBconnection/database_connections.php';
include './cms/plugin.php';
$cms = new plugin();
include "config/config.php";

include "./admin/event/blockbuster_api_class/GenerateSecretKey.php";
$obj = new configtoapi();

$order = $_GET['oid'];
@$order_amount = base64_decode($_GET['total']);
$bkash_vat = 2.50;

$calculate_bkash_vat = ($order_amount * $bkash_vat) / 100;

@$order_amount = ceil(($order_amount + $calculate_bkash_vat));
//Banner Start
if (isset($_POST["submit"])) {
    //extract($_POST);
    $transaction_id1 = $_POST['transaction'];
    $full_name = $_POST['name'];
    $phone_number3 = $_POST['phn'];

    $sqlcheckextrid = $obj->FlyQuery("SELECT * FROM bkash_transaction_module WHERE transaction_id='" . $transaction_id1 . "'", 2);
    //echo $sqlcheckextrid;
    //exit();

    if ($sqlcheckextrid == 0) {
        $insert_eedc_array = '';
        $insert_eedc_array .= 'transaction_id = "' . $transaction_id1 . '"';
        $insert_eedc_array .= ',order_id = "' . base64_decode($order) . '"';
        $insert_eedc_array .= ',order_amount = "' . (int) $order_amount . '"';
        $insert_eedc_array .= ',full_name = "' . $full_name . '"';
        $insert_eedc_array .= ',phone_number = "' . $phone_number3 . '"';
        $insert_eedc_array .= ',date = "' . date('Y-m-d') . '"';
        $insert_eedc_array .= ',status = "pending"';
//$run_eedc_array_sql = "UPDATE bkash_transaction_module SET $insert_eedc_array WHERE id='$id'";
        $run_eedc_array_sql = "INSERT INTO bkash_transaction_module SET $insert_eedc_array";
        $result = $obj->FlyPrepare($run_eedc_array_sql);

        if (!$result) {
            if (DEBUG) {
                $err = "Bkash transaction error: " . mysqli_error($con);
            } else {
                $err = "Bkash transaction failed.";
            }
        } else {

            $msg = "Bkash transactiont saved successfully";
            $link = $cms->LbaseUrl() . "bkash_trancaction_check.php?amount=" . base64_encode($order_amount) . "&oid=" . $order . "&msg=" . base64_encode($msg) . "&trid=" . base64_encode($transaction_id1);
            redirect($link);
        }
    } else {
        $err = "Bkash transactiont ID Already Exists";
        $link = $cms->LbaseUrl() . "bkash-payment.php?oid=" . base64_encode($order_amount) . "&oid=" . $order . "&msg=" . base64_encode($err);
        redirect($link);
    }
}
?>

<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/fav1.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <?php
        echo $cms->pageTitle("Bkash Payment| Ticket Chai");
        ?>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

        <?php
        echo $cms->headCss(array("sitemapSponsor"));
        ?>
<!--        <script>
        var mobUrl = "";
        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            mobUrl = baseUrl + "m.home";
            window.location = mobUrl;
        }

        </script>-->
    </head>

    <body class="index-page signin" ng-app="frontEnd" ng-controller="bkashController">

        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->
<!--        <script type="text/javascript">
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
        </script>-->
        <!--sdk for facebook and google login-->

        <div growl></div>
        <?php
        include 'include/navbar.php';
        ?>

        <div class="clearfix"></div>
        <div class="wrapper">
            <!-- main content part starts here -->
            <div class="main" style="background-color: transparent;margin-top:100px">
                <!-- Customers LogIn section starts here -->
                <div class="section-simple2">
                    <div class="container">
                        <div class="row padd_btm_30">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 well">
                                    <div class="form-group text-center">
                                        <?php
                                        include basePath('include/message.php');
                                        ?>
                                        <h3>Total Amount Payable: <span id="display_total_payable">৳. <?php echo (int) $order_amount; ?></span></h3>
                                        <label for="ourmerchanet">Our Bkash/Merchent Number: 01733-557757</label><?php
                                        echo $err;
                                        echo $msg;
                                        ?>
                                    </div>
                                    <form class="form-group" action="" method="post"> 
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-content section_padd30 animated wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.02s">
                                            <div class="form-group label-floating success">
                                                <label class="control-label">Your Transaction ID</label>
                                                <input type="text"  class="form-control" name="transaction">
                                            </div>
                                            <div class="form-group label-floating success">
                                                <label class="control-label">Full Name</label>
                                                <input type="text" id="customname" class="form-control" name="name">
                                            </div>
                                            <div class="form-group label-floating success">
                                                <label class="control-label">Your Phone Number</label>
                                                <input type="text" id="customphone" class="form-control" name="phn">
                                            </div>
                                            <div class="form-group text-center">
                                                <input type="submit" name="submit" id="btn" value="CONTINUE" class="btn btn-raised btn-success btn-block bold bookticket hidden-xs waves-effect waves-light ng-binding" style="border:2px solid#4CAF50;background:#4CAF50 !important; margin-top: 30px !important; padding: 8px 20px !important;">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 well" style="padding-top:20px;">
                                    <label for="ourmerchanet"><h4><strong>How To Pay Us Via Bkash/Bkash Payment</strong></h4></label>

                                    <div> 
                                        You can make payments from your bKash Account to any<strong> Merchant</strong> who accepts <strong> bKash Payment</strong>.<br>
                                        For example, if you want to pay after shopping:<br>
                                        01. Go to your bKash Mobile Menu by dialing *247#<br>
                                        02. Choose Payment<br>
                                        03. Enter the Merchant bKash Account Number you want to pay to<br>
                                        04. Enter the amount you want to pay<br>
                                        05. Enter a reference* against your payment (you can mention the purpose of the transaction in one word. e.g. Bill)<br>
                                        06. Enter the Counter Number* (the salesperson at the counter will tell you the number)<br>
                                        07. Now enter your bKash Mobile Menu PIN to confirm<br>

                                        Done! You will receive a confirmation message from bKash.
                                    </div>
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


            <!--   Core JS Files   -->
            <?php echo $cms->fotterJs(array('signin')); ?>
            <?php echo $cms->angularJs(array('bkash_angular')); ?>

            <script type="text/javascript">
//                        function validatePhone(txtPhone) {
//                            var a = txtPhone;
//                            var getlength = a.length;
//                            if (getlength > 10)
//                            {
//                                var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
//
//                                if (filter.test(a)) {
//                                    return "1";
//                                }
//                                else {
//                                    return "2";
//                                }
//                            }
//                            else
//                            {
//                                return "3";
//                            }
//                        }
//                        $(document).ready(function () {
//
//                            $("#btn").click(function () {
//                                var name = 0;
//                                var cname = $('#customname').val();
//                                if (cname == "") {
//                                    alert('Name is empty')
//                                    //growl.error("Empty phone number", {title: ' '});
//
//                                }else{
//                                    name = 1;
//                                } 
//                                var phone = 0;
//                                var cmobile = $('#customphone').val();
//                                if (cmobile == "") {
//                                    alert('Empty phone number')
//                                    //growl.error("Empty phone number", {title: ' '});
//
//                                } else if (validatePhone(cmobile) != 1) {
//                                    //growl.error("Invaild phone number", {title: ' '});
//                                    alert('Invaild phone number')
//
//                                } else {
//                                     phone = 1;
//                                }
//                                if (phone >0 && cname>0) {
//                                    // $("#divId").attr("name", hj);
//                                    $('#btn').attr('name', 'btnsubmit')
//                                   // alert($("#btn").attr("name"));
//                                }
//                            });
//                        });

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