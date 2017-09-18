<?php
include './cms/plugin.php';
$cms = new plugin();
?>
<!doctype html>
<html lang="en" ng-app="frontEnd">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/fav1.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <?php 
        echo $cms->pageTitle("More Upcoming Events | Ticket Chai");
        ?>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

        <?php
        echo $cms->headCss(array("moreUpcomingEvents"));
        ?>           
 
    </head>

    <body class="index-page signin"  ng-controller="moreUpcomingEventsController">
        
        <!--[page loader starts]-->
           <div class="se-pre-con"></div>
        <!--[page loader ends]-->
        
        <!--[navbar starts]-->
            <?php include 'include/navbar.php';?>
        <!--[navbar ends]-->

        <div class="clearfix"></div>
        
        <!--[facebook like starts]-->
            <?php echo $cms->FbSocialScript(); ?>
        <!--[facebook like ends]-->
        
        <!--[warpper starts]-->
            <div class="wrapper">
                
                <!--[main content part starts]-->
                    <div class="main" style="background-color: transparent; ">

                        <!--[Action part starts]-->
                            <div class="section section-featured">
                                <div class="container">
                                    <div class="row section_padd30 ">
                                        <!--[title starts]-->
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-heading animated wow fadeIn" data-wow-duration="1s" data-wow-delay="0.02s">
                                                <!--<h2><span class="section-topic">More Upcoming</span> Events</h2>-->
                                                <h2><span class="section-topic">More Upcoming</span> Events</h2>
                                            </div>
                                        <!--[title ends]-->

                                        <div class="clearfix"></div>

                                        <!--[Navbar starts]-->
                                            <nav id="filter-nav" class="navbar navbar-success text-center hidden-xs hidden-sm" role="navigation">
                                                <ul id="filter-tab" class="nav nav-tabs nav-justified text-center" style="margin:0 auto !important; text-align: center !important; box-shadow: none !important;">
                                                    <li class="text-center">
                                                        <a id="allEvent" class="bold" href="javascript:void(0)" ng-click="all(x.category_id,'0')"><i class="icon-pitch icon-2x nav-icon"></i> All</a>
                                                    </li>
                                                    <li class="text-center" ng-repeat="x in element| limitTo:4" ng-if="x.category_title!='Movies'">
                                                        <a href="javascript:void(0)" ng-click="all(x.category_id,'1')"><i class="{{x.category_icon}} icon-2x nav-icon"></i> {{x.category_title}}</a>
                                                    </li>
                                                    <li role="presentation" class="dropdown">
                                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                                            More <span class="caret"></span>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li class="text-center">
                                                                <li ng-repeat="x in element.slice(4)" ng-if="x.category_title!='Movies'">
                                                                    <a href="javascript:void(0)" ng-click="all(x.category_id,'1')">{{x.category_title}}</a>
                                                                </li>  
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </nav>
                                        <!--[Navbar ends]-->
                                        
                                        <div class="clearfix"></div>
                                        
                                        <!--[show content starts]-->
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-content section_padd30 animated wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.02s" id="social-reveal">
                                                <div class="card-box col-md-3 col-sm-6 col-xs-12" ng-repeat="x in moreupcomingEvents">
                                                    <div class="card collection-card" >
                                                        <div class="view  hm-zoom" >
                                                            <img check-image ng-src="./upload/event_web_logo/{{x.event_web_logo}}" class="img-fluid mdbpc-img" alt=""/>
                                                            <div class="stripe dark" >
                                                                <h6 class="title bold"><a href="checkout1.php?id={{x.event_id}}" class="glow txt_sdw2">{{x.event_title}}</a></h6>
                                                                <a class="btn btn-success btn-raised btn-round waves-effect txt-white" href="checkout1.php?id={{x.event_id}}">More Info <i class="fa fa-chevron-right"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
<!--                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-content section_padd30 animated wow fadeIn" data-wow-duration="1s" >
                                                        <div class="card-box col-md-3 col-sm-6 col-xs-12" ng-repeat="x in moreupcomingEvents">
                                                            <div class="card" ng-init="InitCrtHpST()">
                                                                <div class="header">
                                                                    <img class="ch-image" src="upload/event_web_logo/{{x.event_web_logo}}" />
                                                                    <div class="filter"></div>
                                                                    <div class="category">
                                                                        <span class="category-label label label-info">{{x.event_type_tag}}</span>
                                                                    </div>

                                                                    <div class="actions">
                                                                        <a href="checkout1.php?id={{x.event_id}}" class="btn btn-success btn-raised btn-round">
                                                                            <i class="fa fa-cart-plus" aria-hidden="true">&nbsp;</i> {{x.btn_name}}
                                                                        </a>
                                                                    </div>

                                                                    <div class="social-line" data-buttons="3">
                                                                        <a ng-href="
                                                                       https://www.facebook.com/sharer/sharer.php?s=100
                                                                       &p[url]=http://ticketchai.com/details/623/Flavors-Of-Love
                                                                       &p[images][0]=http://ticketchai.com/upload/event_web_banner/ewb_2017-01-26-11-51-13.jpg
                                                                       &p[title]=Valentine's night
                                                                       &p[summary]=by ticketchai.com
                                                                       "> 
                                                                        <button class="btn btn-social btn-facebook">
                                                                            <i class="fa fa-facebook-square">&nbsp;</i>{{btn_fb}}
                                                                        </button>
                                                                        </a>
                                                                        <a ng-href="https://twitter.com/share?url=http://ticketchai.com/details/623/Flavors-Of-Love
                                                                       &text=Valentine's night
                                                                       &via=ticketchai.com">
                                                                        <button class="btn btn-social btn-twitter">
                                                                            <i class="fa fa-twitter-square">&nbsp;</i>{{btn_tw}}
                                                                        </button>
                                                                        </a>
                                                                        <a ng-href="https://plus.google.com/share?url=http://ticketchai.com/details/623/Flavors-Of-Love
                                                                       &hl=en-US">
                                                                        <button class="btn btn-social btn-google">
                                                                            <i class="fa fa-google-plus-square">&nbsp;</i>{{btn_g}}
                                                                        </button>     
                                                                        </a>
                                                                    </div>
                                                                </div>

                                                                <div class="content" style="height: 200px !important;">
                                                                    <h6 class="title bold" style="font-size:12px !important;"><a class="glow2" href="checkout1.php?id={{x.event_id}}">{{x.event_title.length > '50' ? (x.event_title | limitTo:30) + ' ...' : x.event_title}}</a></h6>
                                                                    <hr>
                                                                    <p class="description">   
                                                                        <span class="margin5 text-danger bold"><i class="fa fa-map-marker" aria-hidden="true">&nbsp;</i> {{x.venue_title}}</span>
                                                                    </p>
                                                                    <p class="description">
                                                                        <span class="margin5 text-primary bold"><i class="fa fa-calendar" aria-hidden="true">&nbsp;</i> {{x.venue_start_date}} - {{x.venue_end_date}}</span>
                                                                    </p>
                                                                    <p class="description">
                                                                        <span class="margin5 text-warning bold"><i class="fa fa-clock-o" aria-hidden="true">&nbsp;</i> {{x.venue_start_time}} - {{x.venue_end_time}}</span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>-->
                                                
                                                <!--[loader starts]-->
                                                    <div ng-if="floading == true"  class="col-md-12 col-sm-12"   style="">
                                                        <div class="event-content">
                                                            <h4 style="text-align: center;"><img src="./favicon/loading.gif"</h4>
                                                        </div>
                                                    </div>
                                                     <!--ng-if="moreupcomingEvents.length == 0 && loading == false"-->
                                                    <div  class="col-md-12 col-sm-12" ng-if="moreupcomingEvents.length == 0"  style="">
                                                        <div class="event-content">
                                                            <h4 style="text-align: center;">Sorry! No Event Found. </h4>
                                                        </div>
                                                    </div>
                                                <!--[loader ends]-->
                                            </div>
                                        <!--[show content ends]-->
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        <!--[Action part ends]-->
                        
                        <div class="clearfix"></div>
                      
                        <!--[ticketchai simple section starts]-->
                            <div class="section section-simple-close">
                                <div class="container">
                                    <div class="row section_padd60">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-heading"></div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-content section_padd30 text-center"></div>
                                    </div>
                                </div>
                            </div>
                        <!--[ticketchai simple section ends]-->
                    </div>
                <!--[main content part ends]-->

            <!--[footer starts]-->
                <?php include 'include/footer.php';?>
            <!--[footer ends]-->

            </div>
        <!--[warpper ends]-->
    
        <!--[footer starts]-->
            <?php echo $cms->fotterJs(array('more_upcoming_events'));?>
            <?php echo $cms->angularJs(array('more_upcoming_events_angular'));?>
        <!--[footer ends]-->

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
            //$('#allEvent').click();
           });
        </script>
    
</body>    
    
</html>
