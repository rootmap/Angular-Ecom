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

                    /* 
            Max width before this PARTICULAR table gets nasty
            This query will take effect for any screen smaller than 760px
            and also iPads specifically.
            */
                    
                    @media only screen and (max-width: 760px),
                    (min-device-width: 768px) and (max-device-width: 1024px) {
                        /* Force table to not be like tables anymore */
                        table,
                        thead,
                        tbody,
                        th,
                        td,
                        tr {
                            display: block;
                        }
                        /* Hide table headers (but not display: none;, for accessibility) */
                        thead tr {
                            position: absolute;
                            top: -9999px;
                            left: -9999px;
                        }
                        tr {
                            border: 1px solid #ccc;
                        }
                        td {
                            /* Behave  like a "row" */
                            border: none;
                            border-bottom: 1px solid #eee;
                            position: relative;
                            padding-left: 43%;
                        }
                        td:before {
                            /* Now like a table header */
                            position: absolute;
                            /* Top/left values mimic padding */
                            top: 6px;
                            left: 6px;
                            width: 45%;
                            padding-right: 10px;
                            white-space: nowrap;
                        }
                        /*
                    Label the details
                */
                        td:nth-of-type(1):before {
                            content: "Ticket Type";
                        }
                        td:nth-of-type(2):before {
                            content: "Quantity";
                        }
                        td:nth-of-type(3):before {
                            content: "Price";
                        }
                        td:nth-of-type(4):before {
                            content: "Action";
                        }
                    }
                    .sprinoff input{
                        text-align: center !important;
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

    <body class="index-page signin" ng-app="frontEnd" ng-controller="event_ticketsController">
        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->
     <div growl></div>
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
                                            <li ng-hide="hide"><a href="#Tickets" class="tablinks l1 active"><i class="fa fa-ticket"></i> {{tab_one}}</a></li>
                                            <li><a href="#About" class="tablinks l2"><i class="fa fa-info-circle"></i> {{tab_two}} </a></li>
                                            <li><a href="#Venue" class="tablinks l3"><i class="fa fa-location-arrow"></i> {{tab_three}}</a></li>
                                            <li><a href="#Gallery" class="tablink l4"><i class="fa fa-camera"></i> {{tab_four}}</a></li>
                                            <li><a href="#T_C" class="tablinks l5"><i class="fa fa-user-secret"></i> {{tab_fives}}</a></li>
                                        </ul>
                                        <div id="Tickets">
                                            <div id="" class="row">
                                                <div class="col-lg-8 col-md-8 col-sm-8 col-lg-12" ng-hide="hide">
                                                    <h3 class="text-left event_tickets_h3 h3-responsive">{{details[0].event_title}} 
                                                <a href="" ng-click="addToWishlist(details[0].event_id, 'event')"><span class="btn btn-event_l"><i class="fa fa-heart" style="font-size: 20px; padding: 6px; color:#88C659; border:1px solid #88C659;" title="Add to wishlist" aria-hidden="true"></i></span></a>
                                            
                                            </h3>
                                                    <div class="col-md-5 dropdown hidden-xs addToCalender"> <span class="addtocalendar atc-style-blue" details-calendars="iCalendar,
                                                                             Google Calendar,
							                     Outlook,
							                     Outlook Online,
							                     Yahoo! Calendar" details-secure="auto">
                                                <a details-toggle="dropdown" class="atcb-link">
                                                    <button type="button" class="btn btn-success-outline btn-size waves-effect"><i class="fa fa-arrow-circle-o-down" aria-hidden="true">&nbsp;</i> {{btn_calender}}
                                                    </button>
                                                </a>
                                                    <var class="atc_event">
                                                        <var class="atc_date_start">{{details[0].venue_start_date}} {{details[0].venue_start_time}}</var>
                                                        <var class="atc_date_end">{{details[0].venue_end_date}} {{details[0].venue_end_time}}</var>
                                                        <var class="atc_timezone">Europe/London</var>
                                                        <var class="atc_title">{{details[0].event_title}}</var>
                                                        <var class="atc_description">{{details[0].event_description}}</var>
                                                        <var class="atc_location">{{details[0].venue_address}}</var>
                                                        <var class="atc_organizer">{{details[0].event_organizer_details}}</var>
                                                        <var class="atc_organizer_email">demo@gmail.com</var>
                                                    </var>
                                                </span> </div>
                                                    <div class="col-md-5 dropdown hidden-xs addToCalender" ng-hide="hide"> <a href="map1.php?venue={{details[0].venue_geo_location}}" target="_new"><span class="btn btn-event_l"><i class="fa fa-map-marker" aria-hidden="true" style="font-size: 20px; padding: 6px; color:#ED2655; border:1px solid #88C659;" title="Get Direction" aria-hidden="true"></i></span></a> </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-lg-12 hidden-xs" ng-hide="hide"> <img class="img-rounded img-responsive" src="upload/slider/{{details[0].event_web_banner}}" alt="img"> </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hidden-xs" ng-hide="hide">
                                                    <h4 class="event_tickets_h4_Rom"><i class="fa fa-calendar-check-o" id='txtDate' aria-hidden="true" style="font-size: 20px; padding: 6px; color:#88C659; border:1px solid #88C659;"></i>
                                                From {{details[0].venue_start_date | date: "EEEE, MMMM d, y"}} {{details[0].venue_start_time | date : "shortTime"}} - {{details[0].venue_end_date | date: "EEEE, MMMM d, y"}} {{details[0].venue_end_time | date : 'shortTime'}}</h4> </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hidden-xs" ng-hide="hide"> <a href="#"><span class="label label-info"><i class="fa fa-cubes" aria-hidden="true"></i>
                                                    {{lebel_consert}}</span>
                                            </a>
                                                    <a href="#"> <span class="label label-primary">
                                                    <i class="fa fa-music" aria-hidden="true">&nbsp;</i> {{lebel_music}}
                                                </span> </a>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" ng-hide="hide">
                                                    <div class="panel my_panel">
                                                        <div class="panel_heading_set">
                                                            <h4 class="panel_heading h4-responsive">{{details[0].venue_start_date}} -{{details[0].venue_start_time}}@ {{details[0].event_description}}</h4> </div>
                                                        <div class="panel-body">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <h4> {{panel_h1}}</h4> </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="event_table">
                                                                <table>
                                                                    <thead>
                                                                        <tr>
                                                                            <th>{{tbl_h1}}</th>
                                                                            <th>{{tbl_h2}}</th>
                                                                            <th>{{tbl_h3}}</th>
                                                                            <th>{{tbl_h4}}</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr ng-repeat="x in eventTicketTypeTicket">
                                                                            <td>
                                                                                <p id="cart_Left_Table_p">{{x.TT_type_title}}</p>
                                                                            </td>
                                                                            <td class="sprinoff">
                                                                                <div class="input-group"> <span ng-click="count=(count==1 ? count=1 : count-1)" ng-init="count=1" class="input-group-addon">-</span>
                                                                                    <input type="text" value="{{count}}" ng-model="count" class="form-control"> <span ng-click="count = (count==x.TT_per_user_limit ? count=x.TT_per_user_limit : count+1 )" ng-init="count=1" class="input-group-addon ">+</span> </div>
                                                                            </td>
                                                                            <td>
                                                                                <p id="cart_Left_Table_p">{{x.price*count}}</p>
                                                                            </td>
                                                                            <td class="td">
                                                                                <!-- type, eventID, venueID, itemID -->
                                                                                <button id="by_ticket" class="btn btn-success-outline" ng-click="addTocart('ticket',<?php echo $_GET['id']; ?>,x.TT_venue_id,x.TT_id,count)"> <i class="fa fa-cart-plus" aria-hidden="true">&nbsp;</i>By Tickets </button>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <h4>{{panel_h2}}</h4> </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="event_table">
                                                                <table>
                                                                    <thead>
                                                                        <tr>
                                                                            <th>{{tbl_h1}}</th>
                                                                            <th>{{tbl_h2}}</th>
                                                                            <th>{{tbl_h3}}</th>
                                                                            <th>{{tbl_h4}}</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr ng-repeat="x in eventTicketTypeInclude">
                                                                            <td>
                                                                                <p id="cart_Left_Table_p">{{x.TT_type_title}}</p>
                                                                            </td>
                                                                            <td class="sprinoff">
                                                                                <div class="input-group"> <span ng-click="count=(count==1 ? count=1 : count-1)" ng-init="count=1" class="input-group-addon">-</span>
                                                                                    <input type="text" value="{{count}}" ng-model="count" class="form-control"> <span ng-click="count = (count==x.TT_per_user_limit ? count=x.TT_limit : count+1 )" ng-init="count=1" class="input-group-addon ">+</span> </div>
                                                                            </td>
                                                                            <td>
                                                                                <p id="cart_Left_Table_p">{{x.price*count}}</p>
                                                                            </td>
                                                                            <td class="td">
                                                                                <button id="by_ticket" class="btn btn-success-outline" ng-click="addTocart('include','<?php echo $_GET['id']; ?>',x.TT_venue_id,x.TT_id,count)"> <i class="fa fa-cart-plus" aria-hidden="true">&nbsp;</i>By Tickets </button>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <!--panel end-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- row end-->
                                        </div>
                                        <!--frist tab content end-->
                                        <div id="About">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center" id="">
                                                    <p>{{details[0].event_description}}</p>
                                                </div>
                                            </div>
                                            <!-- row end-->
                                        </div>
                                        <!--secound tab content end-->
                                        <div id="Venue">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="">
                                                    <h3>{{details[0].venue_address}}</h3>
                                                    <map id="map_canvas"></map>
                                                </div>
                                            </div>
                                            <!-- row end-->
                                        </div>
                                        <!--third tab content end-->
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
                                                        <p>{{details[0].event_terms_conditions}}</p>
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
       
            <?php 
                @$f_id=$_GET['id'];
                @$c_id=$_GET['c_id'];
                @$up_id=$_GET['up_id'];
               // $page=$cms->filename();
                if ( !empty($f_id)) {
                   echo  '<span id="autoclick" ng-click="f_eventDetailCall('.$f_id.')"></span>';
                   echo  '<span id="autoclick1" ng-click="eventVisit('.$f_id.')"></span>';
                }
                elseif( !empty($c_id)) {
                    echo  '<span id="autoclick" ng-click="c_eventDetailCall('.$c_id.')"></span>';
                    echo  '<span id="autoclick1" ng-click="eventVisit('.$c_id.')"></span>';
                }else{
                    echo  '<span id="autoclick" ng-click="up_eventDetailCall('.$up_id.')"></span>';
                    echo  '<span id="autoclick1" ng-click="eventVisit('.$up_id.')"></span>';
                }
            ?>
                    <?php echo $cms->fotterJs(array('event_tickets')); ?>
                        <?php echo $cms->angularJs(array('eTickets_angular')); ?>
                            <script>
                                new WOW().init();
                            </script>
                            <!--bootstrap tab javascript -->
                            <script text="text/javascript">
                                $(document).ready(function () {
                                    $("#autoclick").click();
                                     $("#autoclick1").click();
                                });
                            </script>
							<script>
								$(document).ready(function () {        
									var action = 1;

									$(".dropdown").on("click", viewSomething);

									function viewSomething() {
										if (action == 1) {
											$(".atcb-list").css("visibility", "visible");
											action = 2;
										} else {
											 $(".atcb-list").css("visibility", "hidden");
											action = 1;
										}
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