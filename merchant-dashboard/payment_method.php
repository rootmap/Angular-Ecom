<?php
include './DBconnection/auth.php';
include '../cms/merchantPlugin.php';
$cms = new plugin();
?>



<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/fav1.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <!--Title Part start Here-->
        <?php echo $cms->pageTitle("Payment Method| Buy Online Ticket... "); ?>
        <!--./Title Part end Here-->



        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />

        <!--CSS Part start here-->
        <?php echo $cms->headCss(array("paymentMethod")); ?>
        <!--./CSS Part end here-->

    </head>

    <body ng-app="merchantaj" ng-controller="paymentMethodController">
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
                            
                            <?php if(isset($_GET['tid'])){ 
                                $tid=$_GET['tid'];
                                ?>
                            <span id="LoadEditData" ng-click="loadPaymentmethodEdit('<?php echo $_GET['tid']; ?>')"></span>
                                <?php
                            }else{ $tid=0;  } ?>
                            
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <!-- Wizard Sarts Here -->
                                 <?php include ('includes/box_paymentMethod.php'); ?> 
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
    echo $cms->footerJs(array("paymentMethod"));
    ?>
    <?php 
                if(isset($_GET['tid']))
                {
                    ?>
                        <script>
                            $(document).ready(function(){
                                $("#LoadEditData").click();
                            });
                        </script>    
                    <?php
                }
                
                ?>
    <!--Footer Js End Here-->

    <script type="text/javascript">
        $(document).ready(function () {
            // Init Sliders
            //demo.initFormExtendedSliders();
            // Init DatetimePicker
            //demo.initFormExtendedDatetimepickers();

            $('#start-date-box').click(function () {
                $('#start-date').keyup();
            });
            $('#start-time-box').click(function () {
                $('#start-time').keyup();
            });
            $('#end-date-box').click(function () {
                $('#end-date').keyup();
            });
            $('#end-time-box').click(function () {
                $('#end-time').keyup();
            });


        });


    </script>


    <script type="text/javascript">
//        $(document).ready(function () {
//            demo.initOverviewDashboard();
//            demo.initCirclePercentage();
//
//        });
    </script>

    <script type="text/javascript">
        // jQuery
        //$("form#event-cover-photo").dropzone({url: "/file/post"});
        // Dropzone class:
        //var myDropzone = new Dropzone("form#event-cover-photo", { url: "/file/post"});
    </script>



    <script>
        $(document).ready(function () {
            setTimeout(function () {
                $("div.tsf-content").attr("style", "#");
            }, 2000);

        });

        $(function () {
            pageLoadScript();
        });


        function pageLoadScript() {

            _stepEffect = $('#stepEffect').val();
            _style = 'style12';
            _stepTransition = $('#stepTransition').is(':checked');
            _showButtons = $('#showButtons').is(':checked');
            _showStepNum = $('#showStepNum').is(':checked');


            $('.tsf-wizard-1').tsfWizard({
                stepEffect: 'basic',
                stepStyle: 'style3',
                navPosition: 'top',
                stepTransition: true,
                showButtons: true,
                showStepNum: true,
                height: 'auto'
            });
        }
    </script>

<!--  Angular LIBRARY Js
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
    <script src="http://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.6.0.js" type="text/javascript"></script>
    ./Angular LIBRARY Js

    Bootstrap Js start
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/2.1.3/ui-bootstrap-tpls.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/2.1.3/ui-bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    Bootstrap Js End


     custom anular script
    <script src="../angularJs/app.js"></script>
    <script src="../angularJs/scripts/createEventController.js"></script>
    CUSTOM ANGULAR SCRIPT-->
</html>
