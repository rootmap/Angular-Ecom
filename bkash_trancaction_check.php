<?php
//include'DBconnection/database_connections.php';
include "config/config.php";
include './cms/plugin.php';
$cms = new plugin();

$strFeaturedID = '';
$strUpcomingID = '';
$order_id = base64_decode($_GET['oid']);
$order_amount = base64_decode($_GET['amount']);
$trid = base64_decode($_GET['trid']);

$sqlquery_string = "SELECT OE_order_id,OE_event_id,OE_user_id FROM order_events WHERE OE_session_id='$order_id' ORDER BY OE_id DESC LIMIT 1";
$booking_event = mysqli_query($con, $sqlquery_string);

$eventfetch = mysqli_fetch_array($booking_event);
if (!empty($eventfetch)) {
    $order_id = $eventfetch['OE_order_id'];
    $user_id = $eventfetch['OE_user_id'];
} else {
    $order_id = $_GET['oid'];
}





//bkash payment data send end.
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
        <div growl></div>
        <?php echo $cms->FbSocialScript(); ?>
        <?php include 'include/navbar.php'; ?>
        <!-- Navbar -->

        <div class="clearfix"></div>
        <div class="wrapper">
            <!-- main content part starts here -->
            <div class="main" style="background-color: transparent;margin-top:80px">
                <!-- Customers LogIn section starts here -->
                <div class="section-simple2">
                    <div class="container">
                        <div class="row padd_btm_30">

                            <div class="col-md-12" style="padding-left: 34px;">

                                <div class="col-md-6 well">

                                    <?php
                                    include basePath('include/message.php');
                                    ?>

                                    <label for="ourmerchanet"><h4><strong> Please Verify Your Transaction ID Here.</strong></h4></label>&nbsp;<br>
                                    <h5><span class="pull-Left">Your Order ID : <?php echo $order_id; ?></span> <span class="pull-right text-danger">Order Amount = <?php echo (int) $order_amount; ?> Taka.</span></h5>
                                    <h5><span class="pull-right text-danger" id="paid_amount_label" style="display: none;">Paid Amount : <?php echo (int) $order_amount; ?> Taka.</span></h5>





                                    <div class="form-group">

                                        <label for="ourmerchanet">Our Bkash/Merchent Number: 01733-557757</label>
                    <!--                    <input type="text" class="form-control" id="ourmerchanet" placeholder="Our Merchent Number">-->

                                    </div>


                                    <div class="form-group" style="padding-top:20px;">
                                        <label class="sr-only" for="exampleInputAmount">Your Transaction ID</label>

                                        <div style="padding:5px 5px;border:1px solid #79C267; display: none; " id="processing_data" class="col-md-12 bg-warning">
                                            <b style="color:#fc0202; padding: 5px;">Processing : </b>  Transaction ID is Processing, Please Wait until finish...
                                        </div>
                                        <div style="padding:5px 5px;border:1px solid #79C267; display: none;" id="successfully" class="col-md-12 bg-success">
                                            <b style="color:#fc0202; padding: 5px;">Note:</b> Your Transaction ID Successfully Verify.
                                        </div>
                                        <div style="padding:5px 5px;border:1px solid #79C267; display: none; " id="invalid_data" class="col-md-12 bg-danger">
                                            <b style="color:#fc0202; padding: 5px;">Note:</b>  Your Transaction ID Invalid Data.
                                        </div>
                                        <div style="padding:5px 5px;border:1px solid #79C267; display: none;" id="pending_data" class="col-md-12 bg-info">
                                            <b style="color:#fc0202; padding: 5px;">Note:</b>  Your Transaction ID Pending.
                                        </div>

                                        <div class="input-group">
                                            <div class="form-group label-floating success">
                                                <input type="text" class="form-control" value="<?php echo $trid; ?>" id="transaction_verify" id="transaction_verify" name="transaction_verify" placeholder="Please Type Your Transaction ID"/>

                                            </div>

                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-raised btn-success btn-block btn-login waves-effect" style="border:2px solid#4CAF50;color:#000; margin-top: 30px !important; padding: 8px 20px !important;" id="btn_verify_bkash" name="btnverify">Verify</button>
                                                <!--<a href="javascript:void(0)" ng-click="check_payment('<?php //echo $trid;    ?>','<?php //echo $order;    ?>')" class="btn btn-raised btn-success btn-block btn-login waves-effect" style="border:2px solid#4CAF50;color:#000; margin-top: 30px !important; padding: 8px 20px !important;"><strong>Verify</strong>-->
                                                <!--</a>-->
                                            </span>


                                        </div><!-- /input-group -->




                                    </div>



                                    <div style="padding:5px 5px;border:1px solid #79C267; " class="col-md-12 bg-warning">
                                        <b style="color:#fc0202; padding: 5px;">Note:</b> Please make sure to complete your payment transaction within <b>15</b> minutes.
                                    </div>



                                </div>
                                <div class="col-md-6 well" style="padding-top:8px; padding-bottom:28px;">
                                    <label for="ourmerchanet"><h4><strong>How To Pay Us Via Bkash/Bkash Payment</strong></h4></label>

                                    <div> 
                                        You can make payments from your bKash Account to any<strong> Merchant</strong> who accepts <strong> bKash Payment</strong>.<br>
                                        For example, if you want to pay after shopping:<br>
                                        01. Go to your bKash Mobile Menu by dialing <b>*247#</b><br>
                                        02. Choose <b>Payment</b><br>
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
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <?php include 'include/footer.php'; ?>

    </div>
    <!--/.main-container-->




    <!--   Core JS Files   -->
    <?php echo $cms->fotterJs(array('signin')); ?>
    <?php echo $cms->angularJs(array('bkash_angular')); ?>

    <script>
        $(document).ready(function () {

            $('#btn_verify_bkash').click(function () {
                //alert('click');
                $("#processing_data").show('slow');
                var varifyval = $('#transaction_verify').val();
               // alert(varifyval)
                $.post("<?php echo$cms->LbaseUrl(); ?>ajax/bkash_payment_method_ajax.php", {'st': 1, 'verifydata': varifyval}, function (data) {

                    var datacl = jQuery.parseJSON(data);

                    var dd = datacl.transaction.trxStatus;

                    if (dd == "0000")

                    {

                        var trans_amount = datacl.transaction.amount;
                        //alert(trans_amount)
                        var trans_id = datacl.transaction.trxId;
                        var message_alert = "<b style='color:#fc0202; padding: 5px;'>Tranaction Completed Successfully :</b> Trid : " + trans_id + ", Payment Amount : " + trans_amount + " Taka.";
                        $("#successfully").show('slow').fadeOut(5500);
                        ;
                        $("#successfully").html(message_alert);
                        $("#invalid_data").hide('slow');
                        $("#pending_data").hide('slow');
                        $("#processing_data").hide('slow');

                        $.post('<?php echo$cms->LbaseUrl(); ?>ajax/bkash_payment_method_ajax.php', {'st': 2, 'amount': trans_amount, 'exam': '<?php echo (int) $order_amount; ?>', 'verifydata': varifyval, 'oid': '<?php echo $_GET['oid']; ?>'}, function (dataam) {
                            var confirm = jQuery.parseJSON(dataam);
                            var status = confirm.status;
                            var order_id = confirm.order_id;
                            var order_total_paid = confirm.amount;
                            
                            if (status == 1)
                            {
                                if ('<?php echo(int) $order_amount; ?>' <= order_total_paid)
                                {
                                    var c = window.confirm("Your Payable Amount " + order_total_paid + " is paid successfully. \n Please Confirm us by agreeing with us?.");
                                    if (c == true)
                                    {
                                        window.location.replace("<?php echo$cms->LbaseUrl(); ?>bkash_trancaction.php?oid=<?php echo $order_id; ?>&status=<?php echo base64_encode("success"); ?>&amount=<?php echo base64_encode((int) $order_amount); ?>");
                                                                            $("#paid_amount_label").html("Paid Amount = " + order_total_paid + " Taka.");
                                                                        } else
                                                                        {
                                                                            $("#paid_amount_label").html("Paid Amount = " + order_total_paid + " Taka.");
                                                                        }

                                                                    } else
                                                                    {
                                                                        var c = window.confirm("Do You Want Add New Bkash Payment Regarding This Order Amount.");
                                                                        if (c == true)
                                                                        {

                                                                            window.location.replace('<?php echo $cms->LbaseUrl(); ?>bkash-payment.php?oid=<?php echo $order_id; ?>&amount=<?php echo (int) $order_amount; ?>/');
                                                                        } else
                                                                        {
                                                                            var d = window.confirm("Do You Want Proeced To Finish Order as it is.");
                                                                            if (d == true)
                                                                            {
                                                                                window.location.replace("<?php echo$cms->LbaseUrl(); ?>bkash_trancaction.php?oid=<?php echo$order_id; ?>&status=<?php echo base64_encode("success"); ?>&amount=<?php echo base64_encode((int) $order_amount); ?>");
                                                                                                                    } else
                                                                                                                    {
                                                                                                                        $("#paid_amount_label").show('slow');
                                                                                                                        $("#paid_amount_label").html("Paid Amount = " + order_total_paid + " Taka.");
                                                                                                                    }
                                                                                                                }
                                                                                                            }
                                                                                                        } else
                                                                                                        {
                                                                                                            error('Fail To Verify, Please Try Again');
                                                                                                        }
                                                                                                    });
                                                                                                } else
                                                                                                {

                                                                                                    $("#invalid_data").show('slow');
                                                                                                    $("#processing_data").hide('slow');
                                                                                                    $("#successfully").hide('slow');
                                                                                                    $("#pending_data").hide('slow');
                                                                                                }

                                                                                                //                                        $("#transactiondata").show('slow');
                                                                                                //                                        $("#transactiondata").html(data);
                                                                                            });

                                                                                        });
                                                                                    });</script>



</body>
</html>