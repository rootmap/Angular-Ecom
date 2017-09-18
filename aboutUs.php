<?php
include './cms/plugin.php';
$cms = new plugin();
?>
    <!doctype php>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/fav1.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <?php
        echo $cms->pageTitle("About Us | Ticket Chai");
        ?>

            <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

            <?php echo $cms->headCss(array('sitemapTerms')); ?>
    </head>

    <body class="index-page signin" ng-app="frontEnd" ng-controller="sitemap-termsController">
        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->
        <div id="fb-root"></div>
        <?php echo $cms->FbSocialScript(); ?>
            <?php include 'include/navbar.php';?>

                <div class="clearfix"></div>
                <div class="wrapper">
                    <!-- main content part starts here -->
                    <div class="main" style="background-color: transparent; margin-top:70px;">
                        <div class="clearfix"></div>
                        <!-- sitemap section starts here -->
                        <div class="section-simple2">
                            <div class="container-fluid" style="">
                                <div class="row ">
                                    <!-- sitemap header  Starts Here section_padd30-->
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hidden-xs ">
                                        <div class="section-heading container">
                                            <h1 class="text-fluid"><strong>SOMETHING MORE TO KNOW ABOUT US</strong></h1><br>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                 <div class="container">



                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="visibility: visible; animation-duration: 1s; animation-delay: 0.15s; animation-name: fadeInUp;">

                                <div class="panel panel-default">
                                    <div class="panel-heading text-center">ABOUT US</div>
                                    <div class="panel-body">
                                        Ticket Chai - which means "I want ticket" in Bengali. Ticketchai.com is a service of Ticket Chai Limited (TCL) is created based on a simple idea - to allow the consumer's book their tickets at a click from the convenience of their homes or offices and make them free from the journey of traffic dense streets & long queues for booking tickets.<br/><br/>
                                        Ticketchai.com offers consumers easy access to all forms of ticketed entertainment, sports, movies, and transport with multiple payment options. Ticketchai.com is committed to enhancing the purchase experience while democratizing access for consumers.
                                    </div>
                                </div>


                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="visibility: visible; animation-duration: 1s; animation-delay: 0.15s; animation-name: fadeInUp;">
                                <div class="panel panel-default">
                                    <div class="panel-heading text-center">MISSION</div>
                                    <div class="panel-body">
                                        Remain reliable, efficient and at the forefront of technology in all kind of ticketing service to provide customer services of high quality, to approach actively to resolution of any customer needs, to face any challenges automated ticketing in Bangladesh and abroad, as well as to increase efficiency and effectiveness of all activities performed in favor of fulfillment of common goals set by our shareholders, management and employees.
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="visibility: visible; animation-duration: 1s; animation-delay: 0.15s; animation-name: fadeInUp;">
                                <div class="panel panel-default">
                                    <div class="panel-heading text-center">VISION</div>
                                    <div class="panel-body">
                                        We want to be a dynamic, modern and reputable ticketing service provider of any kind of event or transport with an increasing share in the tech industry, ensuring constant customer satisfaction and performance improvement with respect to our environment and safety while delivering our services. Our corporate vision is to become the best company providing ticketing services.
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
        echo $cms->fotterJs(array('sitemap_terms'));
        echo $cms->angularJs(array('sitemapTerms_angular'));
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