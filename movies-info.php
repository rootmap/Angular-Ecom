<?php
session_start();

include './cms/plugin.php';
$cms = new plugin();
?>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/fav1.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <script sr="map.js"></script>
        <script src="http://maps.googleapis.com/maps/api/js?sensor=false&language=en"></script>
        <?php
        echo $cms->pageTitle("event_tickets | Ticket Chai");
        ?>
            <?php
        echo $cms->headCss(array("eventTickets"));
        ?>
  


                <style>
                .lightbox-nav {
                  position: relative;
                  margin-bottom: 12px; /* the font-size of .btn-xs */
                  height: 22px;
                 text-align: center;
                  font-size: 0; /* prevent the otherwise inherited font-size and line-height from adding extra space to the bottom of this div */
                }

.lightbox-nav .btn-group {
  vertical-align: top;
}

.lightbox-nav .close {
  /* absolutely position this in order to center the nav buttons */
  position: absolute;
  top: 0;
  right: 0;
}

.lightbox-image-container {
  position: relative;
  text-align: center; /* center the image */
}

/* the caption overlays the top left corner of the image */
.lightbox-image-caption {
  position: absolute;
  top: 0;
  left: 0;
  margin: 0.5em 0.9em; /* the left and right margins are offset by 0.4em for the span box-shadow */
  color: #000;
  font-size: 1.5em;
  font-weight: bold;
  /*text-align: left;*/
  text-shadow: 0.1em 0.1em 0.2em rgba(255, 255, 255, 0.5);
}

.lightbox-image-caption span {
  padding-top: 0.1em;
  padding-bottom: 0.1em;
  background-color: rgba(255, 255, 255, 0.75);
  /* pad the left and right of each line of text */
  box-shadow: 0.4em 0 0 rgba(255, 255, 255, 0.75),
    -0.4em 0 0 rgba(255, 255, 255, 0.75);
}

                    #map_canvas {
                        margin: 0;
                        padding: 0;
                        height: 400px;
                        border: 1px solid #ccc;
                    }
                </style>
                <!--<![endif]-->
    </head>

    <body class="index-page signin" ng-app="frontEnd" ng-controller="moviesInfoController">
        
        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->
        <?php echo $cms->FbSocialScript(); ?>
            <?php include 'include/navbar.php'; ?>
                <!-- Navbar -->
                <div class="wrapper">
                    <!-- main content part starts here -->
                    <div class="main" style="background-color: transparent; margin-top:80px;">
                        <!-- Customers LogIn section starts here -->
                        <div class="section-simple2">
                            <!-- Top image field start here -->
                            <div class="container">
                                <div class="row padd_btm_30">
                                    <div class="col-lg-12 col-md-12 col-xs-12"> <img style="width:100% !important; max-height:400px;" src="assets/img/bg2.jpeg" alt="" class="img-rounded img-responsive"> </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12" id="event_tickets">
                                        <ul class="tab" id="event_tab">
                                            <li><a href="#About" class="tablinks l2"><i class="fa fa-info-circle"></i> {{tab_two}} </a></li>
                                            <li><a href="#Gallery" class="tablink l4"><i class="fa fa-camera"></i> {{tab_four}}</a></li>
                                            <li><a href="#T_C" class="tablinks l5"><i class="fa fa-user-secret"></i> {{tab_fives}}</a></li>
                                        </ul>
                                        
                                        <div id="About">
                                            <div id="" class="row">
                                                <div class="col-lg-8 col-md-8 col-sm-8 col-lg-12">
                                                    <h3 class="text-left event_tickets_h3 h3-responsive">{{name[0].name}} 
                                                
                                            
                                            </h3>
                                                    <div class="col-md-5 dropdown addToCalender"> <span class="addtocalendar atc-style-blue" details-calendars="iCalendar,
                                                                             Google Calendar,
                                                 Outlook,
                                                 Outlook Online,
                                                 Yahoo! Calendar" details-secure="auto">
                                                <a details-toggle="dropdown" class="atcb-link">
                                                    <button type="button" class="btn btn-success-outline btn-size waves-effect"><i class="fa fa-arrow-circle-o-down" aria-hidden="true">&nbsp;</i> {{btn_calender}}
                                                    </button>
                                                </a>
                                                    <var class="atc_event">
                                                        <var class="atc_date_start">{{name[0].moviestartdate}} </var>
                                                        <var class="atc_date_end">{{name[0].movieenddate}}</var>
                                                        <var class="atc_timezone">Asia/Dhaka</var>
                                                        <var class="atc_title">{{name[0].name}}</var>
                                                        <var class="atc_location">bangladesh</var>
                                                        <!-- <var class="atc_description">{{details[0].event_description}}</var>
                                                        
                                                        <var class="atc_organizer">{{details[0].event_organizer_details}}</var>
                                                        <var class="atc_organizer_email">demo@gmail.com</var> -->
                                                    </var>
                                                </span> </div>
                                                    <div class="col-md-5 dropdown addToCalender" > <a href="map1.php?venue={{details[0].venue_geo_location}}" target="_new"></a> </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-lg-12 " > <img class="img-rounded img-responsive" src="upload/slider/{{name[0].logo}}" alt="img can't load in time !!"> </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " >
                                                     </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " > <a href="#"><span class="label label-info"><i class="fa fa-cubes" aria-hidden="true"></i>
                                                    {{lebel_consert}}</span>
                                            </a>
                                                    <a href="#"> <span class="label label-primary">
                                                    <i class="fa fa-music" aria-hidden="true">&nbsp;</i> {{lebel_music}}
                                                </span> </a>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-left">
                                                    <div>
                                                        <h3 class="text-left h3-responsive">DIRECTOR</h3>
                                                        <p>F. Javier Guti</p>
                                                    </div>
                                                    <div>
                                                        <h3 class="text-left h3-responsive">RELEASE DATE</h3>
                                                        <p>{{name[0].releasedate}}</p>
                                                    </div>
                                                    <div>
                                                        <h3 class="text-left h3-responsive">RATING</h3>
                                                        <p>Not-Available</p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-left" >
                                                    <div>
                                                       <h3 class="text-left h3-responsive">CAST</h3>
                                                        <p>Not Mention Yet </p>
                                                    </div>
                                                    <div>
                                                        <h3 class="text-left h3-responsive">RUNTIME</h3>
                                                        <p>2:45 Min </p>
                                                    </div>
                                                    <div>
                                                        <h3 class="text-left h3-responsive">SYNOPSIS</h3>
                                                        <p>None</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- row end-->
                                        </div>
                                        <!--secound tab content end-->
                                       
                                        <div id="Gallery">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center" id="">
                                                    <h3>Photo Gellary</h3>
                                                    <section>
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" ng-repeat="img in details">
                                                            <a class="example-image-link" href="http://lokeshdhakar.com/projects/lightbox2/images/image-3.jpg" data-lightbox="example-set" data-title="{{img.IG_title}}"> <img class="img-responsive img-thumbnail" src="http://lokeshdhakar.com/projects/lightbox2/images/thumb-3.jpg" alt="" /> </a>
                                                        </div>
                                                    </section>
                                                    <hr>
                                                    <h4>Vedio  Gellary</h4> </div>
                                            </div>
                                          
                                            <!-- fourth  tab content end-->
                                            <div id="T_C">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center" id="">
                                                        <p ng-if="name[0].event_terms_conditions != ''">{{name[0].event_terms_conditions}}</p>
                                                        <p else>no trams and condition</p>
                                                    </div>
                                                </div>
                                                <!-- row end-->
                                            </div>
                                            <!-- fifth  tab content end-->
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="event_ticket_mainRight" style="">
                                        <img src="{{details[0].SO_image}}" alt="image load fail" class="img-responsive"> 
                                        <!-- <h4 ng-hide="details[0].SO_image == true" >{{promotion}}</h4> -->
                                        </div>
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
                    <!-- main footer part starts here -->
                    <!--Footer-->
                    <?php include 'include/footer.php'; ?>
                </div>
                <div class="clearfix"></div>
                <!-- subscription widget starts here -->
                <!-- Sart Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" details-dismiss="modal" aria-hidden="true"> <i class="material-icons">clear</i> </button>
                                <h4 class="modal-title">Modal title</h4> </div>
                            <div class="modal-body">
                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar. </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default btn-simple">Nice Button</button>
                                <button type="button" class="btn btn-danger btn-simple" details-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- All auto click button  start-->
            <?php 
                @$umovie_id=$_GET['info_id'];
                if(isset($_GET['info_id'])) {
                   echo  '<span id="autoclick" ng-click="movies_info('.$umovie_id.')"></span>';
                }
                
            
         ?>
                    <?php echo $cms->fotterJs(array('event_tickets')); ?>
                        <?php echo $cms->angularJs(array('movieInfo_angular')); ?>
                            <script>
                                new WOW().init();
                            </script>
                            <!--bootstrap tab javascript -->
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
                                $(function () {
                                    $(".l1").on("click", function (e) {
                                        e.PreventDefault();
                                        $("body, html").animate({
                                            scrollTop: $($(this).attr('href')).offset().top
                                        }, 600);
                                        $(".l2,.l3,.l4,.l5").removeClass("active");
                                        $(".l1").addClass("active");
                                    });
                                    $(".l2").on("click", function (e) {
                                        e.PreventDefault();
                                        $("body, html").animate({
                                            scrollTop: $($(this).attr('href')).offset().top
                                        }, 600);
                                        $(".l1,.l3,.l4,.l5").removeClass("active");
                                        $(".l2").addClass("active");
                                    });
                                    $(".l3").on("click", function (e) {
                                        e.PreventDefault();
                                        $("body, html").animate({
                                            scrollTop: $($(this).attr('href')).offset().top
                                        }, 600);
                                        $(".l1,.l2,.l4,.l5").removeClass("active");
                                        $(".l3").addClass("active");
                                    });
                                    $(".l4").on("click", function (e) {
                                        e.PreventDefault();
                                        $("body, html").animate({
                                            scrollTop: $($(this).attr('href')).offset().top
                                        }, 600);
                                        $(".l2,.l3,.l4,.l1").removeClass("active");
                                        $(".l4").addClass("active");
                                    });
                                    $(".l5").on("click", function (e) {
                                        e.PreventDefault();
                                        $("body, html").animate({
                                            scrollTop: $($(this).attr('href')).offset().top
                                        }, 600);
                                        $(".l2,.l3,.l4,.l1").removeClass("active");
                                        $(".l5").addClass("active");
                                    });
                                });
                            </script>

                            <!--Add to calendar script-->
                            <script type="text/javascript">
                                (function () {
                                    if (window.addtocalendar)
                                        if (typeof window.addtocalendar.start == "function") return;
                                    if (window.ifaddtocalendar == undefined) {
                                        window.ifaddtocalendar = 1;
                                        var d = document
                                            , s = d.createElement('script')
                                            , g = 'getElementsByTagName';
                                        s.type = 'text/javascript';
                                        s.charset = 'UTF-8';
                                        s.async = true;
                                        s.src = 'calender.js ';
                                        var h = d[g]('body')[0];
                                        h.appendChild(s);
                                    }
                                })();
                            </script>
                            <!--Add to calendar script-->
    </body>

    </html>