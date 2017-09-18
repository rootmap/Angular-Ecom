<?php
include './DBconnection/auth.php';
include '../cms/merchantPlugin.php';
$cms = new plugin();

session_regenerate_id();

?>



<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/fav1.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <!--Title Part start Here-->
        <?php echo $cms->pageTitle("Payment Method List| Buy Online Ticket... "); ?>
        <!--./Title Part end Here-->



        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />

        <!--CSS Part start here-->
        <?php echo $cms->headCss(array("manualorder")); ?>
        <!--./CSS Part end here-->

    </head>

    <body ng-app="merchantaj" ng-controller="manualOrderController">
        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->
          <div growl></div>
        <div class="wrapper">
            <?php include ('includes/sidebar.php'); ?>

            <div class="main-panel">
                <?php include ('includes/top_navigation.php'); ?> 

                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <!-- Wizard Sarts Here -->
                                 <?php include ('includes/box_manual_order.php'); ?> 
                                <!--./ Wizard Ends Here -->
                            </div>
                        </div>
                    </div>
                </div>
                <?php include ('includes/footer.php'); ?> 
            </div>
        </div>
    </body>

    <!--   Core JS Files. Extra: PerfectScrollbar + TouchPunch libraries inside jquery-ui.min.js   -->

    <!-- Footer Js start here--->
    
    
    
    <?php
    echo $cms->footerJs(array("manualOrder"));
    ?>
    
    <!--Footer Js End Here-->

    <script>
        $(document).ready(function () {
            

            
            // Init Sliders
            //demo.initFormExtendedSliders();
            // Init DatetimePicker
            //demo.initFormExtendedDatetimepickers();

        });


    </script>


</html>