<?php
include './config/config.php';
include './cms/plugin.php';

$cms = new plugin();

$totalAmount = 0;
$orderID = 0;

if (isset($_GET['total']) AND isset($_GET['oid'])) {

    $shipping_cost = 0;
    $extra_cost = 0;

    $orderID = base64_decode($_GET['oid']);
    $eventarray = array();
    $event_id = "0";
    $sqlevent_id = "SELECT o.order_id,o.movie_id,e.event_id FROM order_movie_event as o 
LEFT JOIN event_movie_list as e on e.movie_id=o.movie_id
WHERE o.order_id='" . $orderID . "'";
    $sqlquery = mysqli_query($con, $sqlevent_id);
    $sqleventrow = mysqli_num_rows($sqlquery);
    if ($sqleventrow != 0) {
        while ($rowevent = mysqli_fetch_object($sqlquery)):
            $eventarray[0] = $rowevent;
        endwhile;
        $event_id = $eventarray[0]->event_id;
    }

    $sqlgetUnittotal = mysqli_query($con, "SELECT (`seat_unit_price`*`seat`) AS total 
                        FROM `order_movie_event` 
                        WHERE 
                        `order_id`='$orderID' 
                        ORDER BY id DESC LIMIT 1");

    $chkunit = mysqli_num_rows($sqlgetUnittotal);

    $totalUnit = 0;
    if ($chkunit != 0) {
        $rrow = mysqli_fetch_array($sqlgetUnittotal);
        $totalUnit = $rrow['total'];
    }



    $totalmovie_amount = base64_decode($_GET['total']);


    if ($totalmovie_amount >= $totalUnit) {

        if ($event_id == 0) {
            $online_charge_rate = "3.50";
        } else {
            $ratearray = array();
            $sqlrateget = "SELECT * FROM event_online_charge WHERE event_id='" . $event_id . "'";
            $queryrate = mysqli_query($con, $sqlrateget);
            $chekqu = mysqli_num_rows($queryrate);
            if ($chekqu != 0) {
                while ($rg = mysqli_fetch_object($queryrate)):
                    $ratearray[] = $rg;
                endwhile;

                $online_charge_rate = $ratearray[0]->cost;
            }
            else {
                $online_charge_rate = "3.50";
            }
        }


        $charge_amount = $totalmovie_amount * $online_charge_rate / 100;
        $vatamount = $charge_amount;
        echo $totalAmount = number_format($totalmovie_amount + $vatamount + $shipping_cost + $extra_cost);
    } else {
        header('location: /');
        //echo "Wrong Value";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
        <link rel="shortcut icon" href="ico/favicon.png">
        <?php echo $cms->pageTitle("Processing to ssl | Ticket Chai"); ?>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

        <?php echo $cms->headCss(array('unsubscribe_newsletter')); ?>
    </head>

    <body class="index-page signin">
        <?php echo $cms->FbSocialScript(); ?>
        <?php include 'include/navbar.php'; ?>
        <div class="main" style="background-color: transparent;margin-top:80px">
            <!-- Customers LogIn section starts here -->
            <div class="section-simple2">
                <div class="dtable-cell hw100">
                    <div class="container" style="padding: 15px 0 !important;">
                        <div class="text-center">
                            <h4 style="text-transform: uppercase; font-weight: bold;">Please wait while we redirect you to payment gateway.</h4>
                            <h1 class="title-404"><img src="<?php echo $cms->baseUrl(" assets/img/redirect.gif "); ?>"></h1>
                        </div>
                        <!--                        <form action="https://www.sslcommerz.com.bd/process/index.php" method="post" name="form1" id="sslform">-->
                        <form action="https://securepay.sslcommerz.com/gwprocess/v3/process.php" method="post" name="form1" id="sslform"> 
                            <input type="hidden" name="store_id" value="ticketchailive001"> 
                            <input type="hidden" id="total_amount_ssl" name="total_amount" value="<?php echo str_replace(",", "", $totalAmount); ?>">
                            <input type="hidden" id="trans_id_ssl" name="tran_id" value="<?php echo $orderID; ?>">
                            <input type="hidden" id="notify_url" name="success_url" value="<?php echo $cms->LbaseUrl(); ?>confirmation-movie.php?status=success&amount=<?php echo base64_encode($totalAmount); ?>&oid=<?php echo $orderID; ?>">
                            <input type="hidden" id="fail_url" name="fail_url" value = "<?php echo $cms->LbaseUrl(); ?>confirmation-movie.php?status=fail&amount=<?php echo base64_encode($totalAmount); ?>&oid=<?php echo $orderID; ?>">
                            <!--<input type="hidden" id="cancle_url" name="cancel_url" value = "<?php //echo baseUrl();        ?>confirmation/cancel/card/<?php //echo $orderID;        ?>">-->
                            <input type="hidden" id="cancle_url" name="cancel_url" value="<?php echo $cms->LbaseUrl(); ?>confirmation-movie.php?status=cancel&amount=<?php echo base64_encode($totalAmount); ?>&oid=<?php echo $orderID; ?>">
                        </form>
                    </div>
                </div>
                <?php include 'include/footer.php'; ?>
            </div>
        </div>


        <?php echo $cms->fotterJs(array('unsubscribeNewsletter')); ?>
        <script>
            $(document).ready(function () {
                $('#sslform').submit();
            });
        </script>
    </body>
</html>

<!--
//https://www.sslcommerz.com.bd/process/index.php
//ticketchailive001
//systechunimaxtest001
-->