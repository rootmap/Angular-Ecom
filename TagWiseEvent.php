<?php
include './cms/plugin.php';
$cms = new plugin();

@$tagName = $_GET['tagName']; 
?>


<!doctype html>
<html lang="en" ng-app="frontEnd">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/fav1.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <?php
        echo $cms->pageTitle("Tag events | Ticket Chai");
        ?>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

        <?php
        echo $cms->headCss(array("moreFeatureEvents"));
        ?>           

        <style type="text/css">

        </style>

    </head>

    <body class="index-page signin"  ng-controller="tagEventsController"><!--style="background-color: #FFF !important;"-->

        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->
        
        <?php echo $cms->FbSocialScript(); ?>
        
        <span id="autoclick" ng-click="dataLoadOnTag('<?php echo $tagName;?>')"></span>

        <?php include 'include/navbar.php'; ?>
        <div class="clearfix"></div>
        <div class="wrapper">
            <!-- main content part starts here -->
            <div class="main" style="background-color: transparent;">

                <!-- featured events section starts here -->
                <div class="section section-featured">
                    <div class="container">
                        <div class="row section_padd60 ">


                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-heading bg-success">
                                <h2><span class="section-topic"><?php echo $tagName;?></span> events</h2>
                            </div>
                            <div class="clearfix"></div>
                            

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-content section_padd30 animated wow fadeIn" data-wow-duration="1s" >
                                <p id="c">{{cEvent}}</p>
                                <div id="a" class="card-box col-md-3 col-sm-6 col-xs-12" ng-repeat="x in tagEvent">
                                    
                                    <div class="card">
                                        <div class="header">
                                            <img class="ch-image" check-image ng-src="./upload/event_web_logo/{{x.event_web_logo}}"  />
                                            <!--<div class="filter"></div>-->
                                            <div class="category">
                                                <a href="checkout1.php?id={{x.event_id}}"><span class="category-label label label-info">{{x.event_type_tag}}</span></a>
                                            </div>

                                            <div class="actions">
                                                <a href="checkout1.php?id={{x.event_id}}" class="btn btn-success btn-raised btn-round">
                                                    <i class="fa fa-cart-plus" aria-hidden="true">&nbsp;</i> {{x.btn_name}}
                                                </a>
                                            </div>

<!--                                            <div class="social-line" data-buttons="3">
                                                <button class="btn btn-social btn-facebook">
                                                    <i class="fa fa-facebook-square">&nbsp;</i>{{btn_fb}}
                                                </button>
                                                <button class="btn btn-social btn-twitter">
                                                    <i class="fa fa-twitter-square">&nbsp;</i>{{btn_tw}}
                                                </button>
                                                <button class="btn btn-social btn-google">
                                                    <i class="fa fa-google-plus-square">&nbsp;</i>{{btn_g}}
                                                </button>
                                            </div>-->
                                        </div>

                                        <div class="content" style="height: 200px !important;">
                                                    <h6 class="title bold" style="font-size:12px !important;"><a class="glow2" href="#">{{x.event_title.length > '25' ? (x.event_title | limitTo:20) + '..' : x.event_title}}</a></h6>
                                                    <hr>
                                                    <p class="description">
                                                        <span class="margin5 text-danger bold" ng-hide="x.venue_title == null"><i class="fa fa-map-marker" aria-hidden="true">&nbsp;</i> {{x.venue_title}} <span ng-if="x.city != '' || NULL" style="background: #88C659;padding: 1px;border-radius: 4px;color: #fff;">&nbsp;{{x.city}}</span></span>
                                                    </p>
                                                    <p class="description">
                                                        <span class="margin5 text-primary bold"><i class="fa fa-calendar" aria-hidden="true">&nbsp;</i> {{x.venue_start_date}} <span ng-hide="x.venue_end_date == null">-&nbsp;</span> {{x.venue_end_date}}</span>
                                                    </p>
                                                    <p class="description">
                                                        <span class="margin5 text-warning bold"><i class="fa fa-clock-o" aria-hidden="true">&nbsp;</i> {{x.venue_start_time}} <span ng-hide="x.venue_end_time == null">-&nbsp;</span> {{x.venue_end_time}}</span>
                                                    </p>
                                        </div>
                                    </div>
                                    <!-- end card -->
                                </div>
                                <!-- single card end -->

                            </div>

                        </div>
                    </div>
                </div>
                <!-- featured events section ends here -->



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
                <!-- ticketchai simple section ends here -->
            </div>
            <!-- main content part ends here -->  


            <?php include 'include/footer.php'; ?>

        </div>

        <?php echo $cms->fotterJs(array('more_featured_events')); ?>
        <?php echo $cms->angularJs(array('tag_events_angular')); ?>



        <script text="text/javascript">
                    $(document).ready(function () {
                        $("#autoclick").click();
                    });
        </script>

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
        
        
        
        <script>
          $(document).ready(function (){ 
            $('#autoclick').click();
           });
        </script>
        
        
    </body>    

</html>
