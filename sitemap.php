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
        echo $cms->pageTitle("SiteMap | Ticket Chai");
        ?>

            <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

            <?php echo $cms->headCss(array("sitemap")); ?>
    </head>

    <body class="index-page signin" ng-app="frontEnd" ng-controller="sitemapController">
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
                            <div class="container-fluid" style="background:#E8ECED">
                                <div class="row ">
                                    <!-- sitemap header Starts Here section_padd30-->
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  hidden-xs">
                                        <div class="section-heading container">
                                            <h1 class="text-fluid"><strong>{{title}}</strong></h1>
                                            <p class="text-center col-lg-12 col-sm-12 col-xs-12" style="">{{des1}}</p>
                                        </div>
                                    </div>

                                   

                                </div>
                                <div class="container">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <div class="sidebar-list">
                                            <ul class="list-group">
                                                <li class="list-group-item "><a href="sitemap-terms.php">{{t_i_1}}</a><i class="pull-right fa fa-angle-right"></i> </li>
                                                <li class="list-group-item "><a href="sitemap-buy.php">{{t_i_2}}</a><i class="pull-right fa fa-angle-right"></i> </li>
                                                <li class="list-group-item "><a href="sitemap-customar-support.php">{{t_i_3}}</a><i class="pull-right fa fa-angle-right"></i> </li>
                                                <li class="list-group-item"><a href="sitemap-sponsor.php">{{t_i_4}} </a><i class="pull-right fa fa-angle-right"></i> </li>
                                                <li class="list-group-item active"><a href="#">{{t_i_5}}</a><i class="pull-right fa fa-angle-right"></i> </li>

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 visible-xs">
                                        <div class="section-heading container">
                                            <h1 class="text-fluid"><strong>{{title}}</strong></h1>
                                            <p class="text-center col-lg-12 col-sm-12 col-xs-12" style="">{{des1}}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12 sitemap-right" style="visibility: visible; animation-duration: 1s; animation-delay: 0.15s; animation-name: fadeInUp;">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <h6 class="sitemap-title bold">{{title2}}</h6>
                                                <hr>
                                                <ul class="list-unstyled sitemap-list text-justifi">
                                                    <li><a href="index.php">{{p1}}</a> </li>
                                                    <li><a href="aboutUs.php">{{p2}}</a> </li>
                                                    <li><a href="contact_page.php">{{p3}}</a> </li>
                                                </ul>
                                                <h6 class="sitemap-title bold">{{title3}}</h6>
                                                <hr>
                                                <ul class="list-unstyled sitemap-list">
                                                    <li><a href="sitemap-terms.php">{{t_i_1}}</a> </li>
                                                    <li><a href="sitemap-buy.php">{{t_i_2}}</a> </li>
                                                    <li><a href="sitemap-customar-support.php">{{t_i_3}}</a> </li>
                                                    <li><a href="sitemap-customar-support.php">{{t_i_4}} </a> </li>
                                                    <li><a href="#">{{t_i_5}}</a> </li>

                                                </ul>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <h6 class="sitemap-title bold">{{title4}}</h6>
                                                <hr>
                                                <ul class="list-unstyled sitemap-list sitemap-list-inline">
                                                    <li><a href="events.php?page_id=1">Events</a> </li>
                                                    <li><a href="music.php?page_id=2">Music</a> </li>
                                                    <li><a href="theater.php?page_id=4">Theater</a></li>
                                                    <li><a href="sports.php?page_id=5">Sports</a> </li>

                                                </ul>
                                            </div>
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
 echo $cms->fotterJs(array('sitemap'));
?>
                    <?php 
 echo $cms->angularJs(array('sitemap_angular'));
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