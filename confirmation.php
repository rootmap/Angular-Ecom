<?php
include './cms/plugin.php';
$cms = new plugin();
session_start();
session_regenerate_id();
?>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/fav1.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <?php 
        echo $cms->pageTitle("Confirmation| Ticket Chai");
        ?>

            <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

            <?php
        echo $cms->headCss(array("sitemapSponsor"));
        ?>
    </head>

    <body class="index-page signin" ng-app="frontEnd" ng-controller="signinController">
        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->
        
        <?php echo $cms->FbSocialScript(); ?>
            <?php include 'include/navbar.php';?>

                <div class="clearfix"></div>
                <div class="wrapper">
                    <!-- main content part starts here -->
                    <div class="main" style="background-color: transparent;margin-top:100px">
                        <!-- Customers LogIn section starts here -->
                        <div class="section-simple2">
                            <div class="container">
                                <div class="row padd_btm_30">
                                    <div class="col-lg-8 col-lg-offset-2 col-md-8 col-sm-8 col-xs-12  well">
                                            <p>We've sent a message to your email with order details.</p>
                                            <p>Don't see it? Please check your spam folder.</p>
                                            <a href="#" class="btn btn-raised btn-success waves-effect">Continue to Shopping</a>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <a href="#" class="btn btn-raised btn-success waves-effect">Go Order History</a>

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

                    <?php include 'include/footer.php';?>
                </div>


                <!--   Core JS Files   -->
                <?php echo $cms->fotterJs(array('signin'));?>
                    <?php echo $cms->angularJs(array('signin_angular'));?>




                        <script type="text/javascript">
                            $(document).ready(function () {
                                // the body of this function is in assets/material-kit.js
                                //materialKit.initSliders();
                                $(window).on('scroll', materialKit.checkScrollForTransparentNavbar);

                                window_width = $(window).width();

                                if (window_width >= 768) {
                                    big_image = $('.wrapper > .header');

                                    $(window).on('scroll', materialKitDemo.checkScrollForParallax);
                                }

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