<?php
include'DBconnection/database_connections.php';
include './cms/plugin.php';
$cms = new plugin();
include "config/config.php";
$order =base64_decode($_GET['oid']);
$order_amount =base64_decode($_GET['amount']);
//Banner Start


if (isset($_POST["btnsubmit"])) {
    extract($_POST);
    $transaction_id1 = mysqli_real_escape_string($con, $transaction_id1);
    $full_name = mysqli_real_escape_string($con, $full_name);
    $phone_number3 = mysqli_real_escape_string($con, $phone_number3);

    $sqlcheckextrid = mysqli_num_rows(mysqli_query($con, "SELECT * FROM bkash_transaction_module WHERE transaction_id='" . $transaction_id1 . "'"));
    if ($sqlcheckextrid == 0) {
        $insert_eedc_array = '';
        $insert_eedc_array .= 'transaction_id = "' . $transaction_id1 . '"';
        $insert_eedc_array .= ',order_id = "' . $order . '"';
        $insert_eedc_array .= ',order_amount = "0"';
        $insert_eedc_array .= ',full_name = "' . $full_name . '"';
        $insert_eedc_array .= ',phone_number = "' . $phone_number3 . '"';
        $insert_eedc_array .= ',date = "' . date('Y-m-d') . '"';
        $insert_eedc_array .= ',status = "pending"';
//$run_eedc_array_sql = "UPDATE bkash_transaction_module SET $insert_eedc_array WHERE id='$id'";
        $run_eedc_array_sql = "INSERT INTO bkash_transaction_module SET $insert_eedc_array";
        $result = mysqli_query($con, $run_eedc_array_sql);

        if (!$result) {
            if (true) {
                $err = "Bkash transaction error: " . mysqli_error($con);
            } else {
                $err = "Bkash transaction failed.";
            }
        } else {

            $msg = "Bkash transactiont saved successfully";
            $link = baseUrl() . "bkash-payment-check/" . base64_encode($msg) . "/" . base64_encode($order_amount) . "/" . base64_encode($order) . "/" . base64_encode($transaction_id1) . "/";
            redirect($link);
        }
    } else {
        $err = "Bkash transactiont ID Already Exists";
        $link = baseUrl() . "bkash-payment/" . base64_encode($order) . "/" . base64_encode($order_amount) . "/" . base64_encode($err) . "/";
        redirect($link);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?php echo getConfig("HOMEPAGE_META_DESCRIPTION"); ?>" >
        <meta name="keywords" content="<?php echo getConfig("HOMEPAGE_META_KEYWORD"); ?>" >

        <?php include basePath('header_script.php'); ?>

        <script>
            var mobUrl = "";
            if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                mobUrl = baseUrl + "m.home";
                window.location = mobUrl;
            }

        </script>
    </head>
    <body class="home">
        <header>
            <div class="header-wrapper">
                <?php include basePath('menu_top.php'); ?>
                <?php include basePath('navigation.php'); ?>
            </div>
        </header>


        <div class="col-md-12" style="padding-left: 34px; margin-top:20px;">

            <div class="col-md-6 well">


                <form class="form-group" action="" method="post">


                    <label for="ourmerchanet"><h4><strong> Bkash Payment Here.</strong></h4></label>

                    <?php
                    include basePath('admin/message.php');
                    ?>


                    <div class="form-group">
                        <h3 style="text-align: center;">Total Amount Payable: <span id="display_total_payable">à§³. <?php echo $order_amount; ?></span></h3>
                        <!-- <label for="ourmerchanet">Our Bkash/Merchent Number: 01925-140066</label>
                       <input type="text" class="form-control" id="ourmerchanet" placeholder="Our Merchent Number">-->
                    </div>

                    <div class="form-group">
                        <label for="yourtransacation">Your Transaction ID</label><span class="pull-right text-info">Our Bkash/Merchent Number: 01733-557757</span>
                        <input type="text" class="form-control" id="yourtransacation" name="transaction_id1" placeholder="Please Type your Transation ID">
                    </div>
                    <input type="hidden" name="order_amount2" value="<?php echo $order_amount2; ?>">
                    <div class="form-group">
                        <label for="yourorderamount">Full Name</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" placeholder=" Please Type your Full Name">
                    </div>

                    <div class="form-group">
                        <label for="yourorderamount">Your Phone Number</label>
                        <input type="text" class="form-control" id="yourphonenumber" name="phone_number3" placeholder="Please Type your Phone number">
                    </div>
                    <button type="submit"  name="btnsubmit" class="btn btn-raised btn-success btn-block btn-login waves-effect" style="border:2px solid#4CAF50;color:#000;">submit</button>
                </form>

            </div>
            <div class="col-md-6" style="padding-top:20px;">
                <label for="ourmerchanet"><h4><strong>How To Pay Us Via Bkash/Bkash Payment</strong></h4></label>

                <div> 
                    You can make payments from your bKash Account to any<strong> â€œMerchantâ€?</strong> who accepts <strong> â€œbKash Paymentâ€?</strong>.<br>
                    For example, if you want to pay after shopping:<br>
                    01. Go to your bKash Mobile Menu by dialing *247#<br>
                    02. Choose â€œPaymentâ€?<br>
                    03. Enter the Merchant bKash Account Number you want to pay to<br>
                    04. Enter the amount you want to pay<br>
                    05. Enter a reference* against your payment (you can mention the purpose of the transaction in one word. e.g. Bill)<br>
                    06. Enter the Counter Number* (the salesperson at the counter will tell you the number)<br>
                    07. Now enter your bKash Mobile Menu PIN to confirm<br>

                    Done! You will receive a confirmation message from bKash.
                </div>
            </div>
        </div>







        <!--        <div class="main-container page-container section-padd pad-top30" >
                    <div style=" text-align:center; "><h1>Why Media Page</h1></div>
                    <div class="clearfix"></div>
                    <div class="container">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="row" style="margin-top:30px;">
        
        <?php
// foreach ($mediaarray as $media):
        ?>
                                    <div class="col-sm-6 col-md-6" style="height: 250px;">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-3">
                                                <div class="thumbnail">
                                                    <img class=" img-responsive" src="<?php //echo baseUrl();                   ?>upload/image_file/original/<?php //echo $media->media_image;                   ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-9">
        
                                                <h3><?php //echo $media->media_title;                    ?></h3>
                                                <p><?php //echo $media->media_content;                    ?></p>
                                            </div>
                                        </div>
                                    </div>
        <?php
// endforeach;
        ?>
        
        
        
                            </div>
                        </div>
                    </div>
        
        
                    <div class="container">
                        <div class="col-md-10 col-md-offset-1">
                            <div style="text-align: center;padding: 30px;"><h1>Client Showcases</h1></div>
        
                            <div class="row">
                                <div id="myCarousel" class="carousel slide" data-ride="carousel" style="border: 1px solid #C5C5C5;">
                                     Indicators 
                                    <ol class="carousel-indicators">
                                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                        <li data-target="#myCarousel" data-slide-to="1"></li>
                                        <li data-target="#myCarousel" data-slide-to="2"></li>
                                        <li data-target="#myCarousel" data-slide-to="3"></li>
                                    </ol>
        
                                     Wrapper for slides 
                                    <div class="carousel-inner" role="listbox">
        
        <?php
//$a = 1;
// $aa = 1;
//$countclient = count($showcasearray);
//foreach ($showcasearray as $client) :
// if ($aa == 1) {
        ?>
                                                <div class="item active">
                                                    <div class="row">
        <?php
// }
        ?>
                                                    <div class="col-md-3">
                                                        <img class="img-responsive" src="<?php //echo baseUrl();                  ?>upload/clients_image/<?php // echo $client->clients_image;                  ?>">
                                                    </div>
        <?php
// if ($a == 1 && $countclient == 1) {
        ?>
                                                    </div>
        
                                                </div>
        <?php
// $a = 0;
// } elseif ($a == 4 && $countclient != $aa) {
        ?>
                                            </div>
                                        </div>
        
                                        <div class="item">
                                            <div class="row">
        <?php
// $a = 0;
// } elseif ($countclient == $aa && $a == 4) {
        ?>
                                            </div>
                                        </div>
        
        <?php
// } elseif ($a == 4) {
// $a = 0;
        ?>
                                    </div>
                                </div>
        
                                <div class="item">
                                    <div class="row">
        <?php
// }
//$a++;
//$aa++;
// endforeach;
        ?>
        
        
                            </div>
        
                        </div>
        
        
                         Left and right controls 
                        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>-->
    </div>

</div>

<div class="clearfix"></div>
<!--<div class="container">
    <div style="text-align: center; padding: 30px;"><h1> Recent Posts</h1></div>
    <div class="row">

<?php // foreach ($recentarray as $recentmedia) {     ?>





            <div class="col-md-3">
                <a href=""> <img class="img-responsive" src="<?php //echo baseUrl();                    ?>upload/image_file/original/<?php // echo $recentmedia->post_image;                    ?> ">
                    <div><h3><?php //echo $recentmedia->post_title;                   ?></h3></div>
                    <div><h4><?php //echo $recentmedia->post_content;                    ?></h4></div>
                </a>
            </div>
<?php //}     ?>        



    </div>
</div>-->
<!--/.container--> 

</div>
<!--/.main-container-->


<?php // include basePath('testimonial.php');                ?>
<?php include basePath('social_link.php'); ?>
<?php include basePath('footer.php'); ?>
<?php include basePath('login_modal.php'); ?>
<?php include basePath('signup_modal.php'); ?>
<?php include basePath('footer_script.php'); ?>

<!-- Include slider plugins || Only for homepage needed --> 

<script src="<?php echo baseUrl('js/home.js'); ?>"></script> 


<script src="<?php echo baseUrl('js/script.js'); ?>"></script>
<script src="<?php echo baseUrl('js/wow.min.js'); ?>"></script>
<script src="<?php echo baseUrl('js/jquery.easy-ticker.min.js'); ?>"></script>
<script>
            $(document).ready(function () {
                $('.tickerWrapper').easyTicker({
                    visible: 5,
                    //easing: 'easeInOutCubic',
                    speed: 'slow',
                    interval: 3000,
                    direction: 'down',
                    height: 'auto'
                });// list of properties
            });
</script>
<script>
    new WOW().init();


    // imageShowCase  carousel
    var imageShowCase = $("#imageShowCase");

    imageShowCase.owlCarousel({
        autoPlay: 4000,
        stopOnHover: true,
        navigation: false,
        pagination: true,
        paginationSpeed: 1000,
        goToFirstSpeed: 2000,
        singleItem: true,
        autoHeight: true


    });

    // Custom Navigation Events
    $("#ps-next").click(function () {
        imageShowCase.trigger('owl.next');
    })
    $("#ps-prev").click(function () {
        imageShowCase.trigger('owl.prev');
    })






    var owlae = $("#archived-event");

    owlae.owlCarousel({
        navigation: false,
        pagination: false,
        items: 5, //10 items above 1000px browser width
        itemsDesktop: [1000, 3], //5 items between 1000px and 901px
        itemsDesktopSmall: [900, 3], // betweem 900px and 601px
        itemsTablet: [600, 2], //2 items between 600 and 0
        itemsMobile: false // itemsMobile disabled - inherit from itemsTablet option
    });

    // Custom Navigation Events
    $(".featured-navi .next").click(function () {
        owlae.trigger('owl.next');
    })
    $(".featured-navi .prev").click(function () {
        owlae.trigger('owl.prev');
    })




    //        $.jStorage.set("isTrue", "true", {TTL: 60000}) //60 seconds

    //        var myVal = $.jStorage.get("isTrue");
    //
    //        alert(myVal);

</script>


</body>
</html>