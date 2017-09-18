<?php
include './cms/plugin.php';
$cms = new plugin();
?>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/fav1.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <?php 
        echo $cms->pageTitle("sitemap-buy | Ticket Chai");
        ?>

            <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

            <?php
        echo $cms->headCss(array("sitemapBuy"));
        ?>
    </head>

    <body class="index-page signin" ng-app="frontEnd" ng-controller="sitemap-buyController">
        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->
        <?php echo $cms->FbSocialScript(); ?>

            <?php include 'include/navbar.php';?>


                <div class="clearfix"></div>
                <div class="wrapper">
                    <!-- main content part starts here -->
                    <div class="main" style="background-color: transparent; margin-top:70px;">


                        <div class="clearfix"></div>
                        <!-- sitemap section starts here -->
                        <div class="section-simple2">
                            <div class="container-fluid" style="background:">
                                <div class="row ">
                                    <!-- sitemap header  Starts Here section_padd30-->
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hidden-xs">
                                        <div class="section-heading container">
                                            <h1 class="text-fluid"><strong>{{title}}</strong></h1>
                                            <p class="text-center col-lg-12 col-sm-12 col-xs-12" style="">{{des1}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ">
                                        <div class="sidebar-list">
                                            <ul class="list-group">
                                                <a href="sitemap-terms.php"><li class="list-group-item active" style="color:black">Terms & Condition<i class="pull-right fa fa-angle-right"></i> </li></a>
                                                <a href="sitemap-privacy&policy.php"><li class="list-group-item " style="color:black">Privacy & Policy<i class="pull-right fa fa-angle-right"></i> </li></a>
                                                <a href="sitemap-buy.php"><li class="list-group-item " style="color:black">How to Buy<i class="pull-right fa fa-angle-right"></i> </li></a>
                                                <a href="sitemap-customar-support.php"><li class="list-group-item" style="color:black">Customer Support<i class="pull-right fa fa-angle-right"></i> </li></a>
                                                <!--<a href="sitemap-sponsor.php"><li class="list-group-item" style="color:black">Our Sponsor<i class="pull-right fa fa-angle-right"></i> </li></a>-->
                                                <a href="sitemap.php"><li class="list-group-item" style="color:black">Sitemap<i class="pull-right fa fa-angle-right"></i> </li></a>

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 visible-xs">
                                        <div class="section-heading container">
                                            <h1 class="text-fluid"><strong>HOW TO BUY</strong></h1>
                                            <p class="text-center col-lg-12 col-sm-12 col-xs-12" style="">Welcome to Ticketchai. Ticketchai enables people all over the world to plan, promote, and sell tickets to any event. And we make it easy for everyone to discover events, and to share the events they are attending with the people they know. The following pages contain our Terms of Service, which govern all use of our Services.</p>
                                        </div>
                                    </div>

                                   

                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 sitemap-right" style="visibility: visible; animation-duration: 1s; animation-delay: 0.15s; animation-name: fadeInUp;">
                                        <div class="row sitemap_buy">
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                <a href="#">
                                                  <img class="media-object" src="<?php echo $cms->baseUrl('assets/img/Sevent.png'); ?>" alt="" style="width:80px;height:80px">
                                                </a>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                <h3 class="media-heading" style="font-weight: 400!important;">Select your Event</h3>
                                                <p>Work start with select an event.</p>
                                            </div>
                                            
                                            <div class="clearfix"></div>
                                            
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="margin-top: 28px;">
                                                <a href="#">
                                                  <img class="media-object" src="<?php echo $cms->baseUrl('assets/img/Sorder.png'); ?>" alt="" style="width:80px;height:80px">
                                                </a>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" style="margin-top: 25px;">
                                                <h3 class="media-heading" style="font-weight: 400!important;">Checkout</h3>
                                                <p>Select Book now button in checkout page
                                                </p>
                                            </div>
                                            <div class="clearfix"></div>
                                            
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="margin-top: 28px;">
                                                <a href="#">
                                                   <img class="media-object" src="<?php echo $cms->baseUrl('assets/img/Spament.png'); ?>" alt="" style="width:80px;height:80px">
                                                </a>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" style="margin-top: 25px;">
                                                <h3 class="media-heading" style="font-weight: 400!important;">Quantity & Payment Method</h3>
                                                <p>Select your ticket quantity and also your payment method.
                                                </p>
                                            </div>
                                            <div class="clearfix"></div>
                                            
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="margin-top: 28px;">
                                                <a href="#">
                                                  <img class="media-object" src="<?php echo $cms->baseUrl('assets/img/Sdelivery.png'); ?>" alt="" style="width:80px;height:80px">
                                                </a>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" style="margin-top: 25px;">
                                                <h3 class="media-heading" style="font-weight: 400!important;">Confirm your ticket</h3>
                                                <p>Fill up the form and get your ticket
                                                </p>
                                            </div>
                                            <div class="clearfix"></div>

                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <!-- ticketchai simple section starts here -->
                        <div class="section section-simple-close">
                            <div class="container">
                                <div class="row section_padd60">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-heading"></div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-content section_padd30 text-center"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php include 'include/footer.php';?>


                </div>

                <!--   Core JS Files   -->
                <?php 
 echo $cms->fotterJs(array('sitemap_buy'));
?>
                    <?php 
 echo $cms->angularJs(array('sitemapBuy_angular'));
?>
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