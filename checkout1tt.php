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
        echo $cms->pageTitle("Checkout1 | Ticketchai.com...");
        ?>
        <?php
        echo $cms->headCss(array("checkout1"));
        ?>
        <!--        arnav css
        -->
        <link rel="stylesheet" href="assets/css/mediaQuery.css">
        <style type="text/css">



            label.btn span {
                font-size: 1.5em ;
            }

            label input[type="radio"] ~ i.fa.fa-circle-o{
                color: #c8c8c8;    display: inline;
            }
            label input[type="radio"] ~ i.fa.fa-dot-circle-o{
                display: none;
            }
            label input[type="radio"]:checked ~ i.fa.fa-circle-o{
                display: none;
            }
            label input[type="radio"]:checked ~ i.fa.fa-dot-circle-o{
                color: #4CAF50;    display: inline;
            }
            label:hover input[type="radio"] ~ i.fa {
                color: #4CAF50;
            }

            label input[type="checkbox"] ~ i.fa.fa-square-o{
                color: #c8c8c8;    display: inline;
            }
            label input[type="checkbox"] ~ i.fa.fa-check-square-o{
                display: none;
            }
            label input[type="checkbox"]:checked ~ i.fa.fa-square-o{
                display: none;
            }
            label input[type="checkbox"]:checked ~ i.fa.fa-check-square-o{
                color: #4CAF50;    display: inline;
            }
            label:hover input[type="checkbox"] ~ i.fa {
                color: #4CAF50;
            }

            div[data-toggle="buttons"] label.active{
                color: #4CAF50;
            }

            div[data-toggle="buttons"] label {
                display: inline-block;
                padding: 6px 12px;
                margin-bottom: 0;
                font-size: 14px;
                font-weight: normal;
                line-height: 2em;
                text-align: left;
                white-space: nowrap;
                vertical-align: top;
                cursor: pointer;
                background-color: none;
                border: 0px solid 
                    #c8c8c8;
                border-radius: 3px;
                color: #c8c8c8;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                -o-user-select: none;
                user-select: none;
            }

            div[data-toggle="buttons"] label:hover {
                color: #4CAF50;
            }

            div[data-toggle="buttons"] label:active, div[data-toggle="buttons"] label.active {
                -webkit-box-shadow: none;
                box-shadow: none;
            }


            .payment_btn {
                white-space: normal;
            }

            .sprinoff input {
                text-align: center !important;
            }

            .lightbox-nav {
                position: relative;
                margin-bottom: 12px;
                /* the font-size of .btn-xs */
                height: 22px;
                text-align: center;
                font-size: 0;
                /* prevent the otherwise inherited font-size and line-height from adding extra space to the bottom of this div */
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
                text-align: center;
                /* center the image */
            }
            /* the caption overlays the top left corner of the image */

            .lightbox-image-caption {
                position: absolute;
                top: 0;
                left: 0;
                margin: 0.5em 0.9em;
                /* the left and right margins are offset by 0.4em for the span box-shadow */
                color: #000;
                font-size: 1.5em;
                font-weight: bold;
                text-align: left;
                text-shadow: 0.1em 0.1em 0.2em rgba(255, 255, 255, 0.5);
            }

            .lightbox-image-caption span {
                padding-top: 0.1em;
                padding-bottom: 0.1em;
                background-color: rgba(255, 255, 255, 0.75);
                /* pad the left and right of each line of text */
                box-shadow: 0.4em 0 0 rgba(255, 255, 255, 0.75), -0.4em 0 0 rgba(255, 255, 255, 0.75);
            }
            /* 
Max width before this PARTICULAR table gets nasty
This query will take effect for any screen smaller than 760px
and also iPads specifically.
            */

            /*            @media only screen and (max-width: 760px),
                        (min-device-width: 768px) and (max-device-width: 1024px) {
                             Force table to not be like tables anymore 
                            #table,
                            #thead,
                            #tbody,
                            #th,
                            #td,
                            #tr {
                                display: block;
                            }
                             Hide table headers (but not display: none;, for accessibility) 
                            #thead tr {
                                position: absolute;
                                top: -9999px;
                                left: -9999px;
                            }
                            #tr {
                                border: 1px solid #ccc;
                            }
                            #td {
                                 Behave  like a "row" 
                                border: none;
                                border-bottom: 1px solid #eee;
                                position: relative;
                                padding-left: 43%;
                            }
                            #td:before {
                                 Now like a table header 
                                position: absolute;
                                 Top/left values mimic padding 
                                top: 6px;
                                left: 6px;
                                width: 45%;
                                padding-right: 10px;
                                white-space: nowrap;
                            }
                            
                Label the details
                            
                            #td:nth-of-type(1):before {
                                content: "Ticket Type";
                            }
                            #td:nth-of-type(2):before {
                                content: "Quantity";
                            }
                            #td:nth-of-type(3):before {
                                content: "Price";
                            }
                            #td:nth-of-type(4):before {
                                content: "Action";
                            }
                        }
            
                        #map_canvas {
                            margin: 0;
                            padding: 0;
                            height: 400px;
                            border: 1px solid #ccc;
                        }*/

            .form-control {
                display: block;
                width: 100%;
                height: 34px;
                padding: 6px 12px;
                font-size: 14px;
                line-height: 1.42857143;
                color: #555;
                background-color: #fff;
                background-image: none;
                border: 1px solid #ccc;
                border-radius: 4px;
                -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
                box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
                -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
                -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
                transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
            }

            .form-style input[type=text]:focus,
            .form-style input[type=date]:focus,
            .form-style input[type=datetime]:focus,
            .form-style input[type=number]:focus,
            .form-style input[type=search]:focus,
            .form-style input[type=time]:focus,
            .form-style input[type=url]:focus,
            .form-style input[type=email]:focus,
            .form-style textarea:focus,
            .form-style select:focus {
                -moz-box-shadow: 0 0 8px #88D5E9;
                -webkit-box-shadow: 0 0 8px #88D5E9;
                box-shadow: 0 0 8px #88D5E9;
            }
        </style>
        <!--<![endif]-->
    </head>

    <body class="index-page signin" ng-app="frontEnd" ng-controller="checkout1Controller">
        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->
        <div growl></div>
        <?php echo $cms->FbSocialScript(); ?>
        <?php include 'include/navbar.php'; ?>
        <!-- Navbar -->
        <div class="wrapper">
            <!-- main content part starts here -->
            <div class="main" style="background-color: transparent; margin-top:40px;">
                <!-- Carousel Starts Here -->
                <div class="container-fluid" id="checkout_top_banner">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-top-30">
                            <!-- check still image start here -->
                            <div class="carousel-inner" role="listbox">
                                <div class="item active text-center"> 
                                    <img ng-src="upload/event_web_banner/{{details[0].event_web_banner}}" alt="image loading problem" class="img-fluid img-responsive carousel-img-bd" style="width:100%; max-height: 350px;">
                                </div>
                            </div>
                            <!-- check still image end here -->
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- Carousel Ends Here -->
                <!-- Customers LogIn section starts here -->
                <div class="section-simple2">
                    <!-- Top image field start here -->
                    <div class="container-fluid" style="/*padding-left:0px !important; padding-right: 0px !important;*/">
                        <div class="row" style="margin-top:10px !important;">
                            <!--step1 starts here-->
                            <fieldset id="step1">
                                <!--left sidebar panel starts here-->
                                <div class="col-lg-4 col-md-4 col-sm4 col-xs-12">
                                    <div class="panel panel-default ">
                                        <div class="panel-heading text-center" style="background-color:#ffffff;" ng-hide="none">
                                            <h4 class="panel-title h4-responsive bold">{{details[0].event_title}} </h4>
                                            <p>{{details[0].venue_end_date}} - {{details[0].venue_end_date}} </p><p> {{details[0].venue_start_time}} ONWARDS</p>
                                            <button class="btn btn-raised btn-danger btn-block bold bookticket hidden-xs">Book Now</button>
                                        </div>
                                        <div class="panel-body text-center">
                                            <div class="form-group">
                                                <div class="dropdown addToCalender text-center col-xs-6"> 
                                                    <span class="addtocalendar atc-style-blue" details-calendars="iCalendar,Google Calendar,Outlook,Outlook Online,Yahoo! Calendar" details-secure="auto">
                                                        <a title="Add To Calendar" details-toggle="dropdown" class="atcb-link">
                                                            <button type="button" class="btn btn-md btn-success-outline waves-effect"><i class="fa fa-calendar" aria-hidden="true">&nbsp;</i> Calendar<!--{{btn_calender}}-->
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
                                                    </span> 
                                                </div>
                                                <div class="col-xs-6" ng-hide="hide">
                                                    <a title="Get Direction" href="map1.php?venue={{details[0].venue_geo_location}}" target="_new"> <span class="btn btn-md btn-success-outline waves-effect"><i class="fa fa-map-marker" ></i> Direction<!--GET DIRECTION--></span> </a>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <span class="bold text-right">Share : &nbsp;&nbsp;</span>
                                                <button class="btn btn-default btn-raised btn-fab btn-fab-mini btn-round"><i class="fa fa-facebook"></i></button>
                                                <button class="btn btn-default btn-raised btn-fab btn-fab-mini btn-round"><i class="fa fa-twitter"></i></button>
                                                <button class="btn btn-default btn-raised btn-fab btn-fab-mini btn-round"><i class="fa fa-google"></i></button>
                                            </div>
                                            <div class="form-group">
                                                <a href="" ng-click="addToWishlist(details[0].event_id, 'event')"><span class="btn btn-event_l"><i class="fa fa-heart" style="font-size: 20px; padding: 6px; color:#88C659; border:1px solid #88C659;" title="Add to wishlist" aria-hidden="true"></i></span></a>
                                                <a class="btn btn-info btn-raised" style="margin-right:5px;" ng-repeat="tag in tags"href="TagWiseEvent.php?tagName={{tag}}"><i class="fa fa-hashtag" aria-hidden="true"></i>{{tag}}</a>
                                            </div>
                                            <div class="col-xs-12 text-center"  style="border-top:1px solid #ccc;">
                                                <h4 class="event_tickets_h4 h4-responsive bold">ORGANIZER</h4>
                                                <img style="margin: 0 auto; height: 85px; border: 1px solid #ccc;" src="./tc-merchant-template/assets/img/default-avatar.png" class="img-circle" alt="1"/>
                                                <h4 class="event_tickets_h4 h4-responsive">{{details[0].organized_by}}</h4>
<!--                                                <a title="Send Message" href="#"> <span class="btn btn-md btn-block btn-primary-outline waves-effect"> Send Message </span> </a>-->
                                                <button class="btn btn-raised btn-info btn-block bold"  data-toggle="modal" data-target="#omsgModal">Send Message</button>
                                                <!--organizer message modal starts here -->
                                                <!-- Modal Core -->
                                                <div class="modal fade" id="omsgModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-success">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                <h4 class="modal-title text-uppercase" id="myModalLabel">Send Message</h4>
                                                                <br/>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group label-floating success">
                                                                    <label class="control-label">Full Name</label>
                                                                    <input type="text" ng-model="org.name" class="form-control">
                                                                </div>
                                                                <div class="form-group label-floating success">
                                                                    <label class="control-label">Email</label>
                                                                    <input type="email" ng-model="org.email" class="form-control">
                                                                </div>
                                                                <div class="form-group label-floating success">
                                                                    <label class="control-label">Phone No.</label>
                                                                    <input type="text" ng-model="org.phone" class="form-control">
                                                                </div>
                                                                <div class="form-group label-floating success">
                                                                    <label class="control-label">Message</label>
                                                                    <textarea class="form-control" ng-model="org.msg" rows="3"></textarea>
                                                                </div>
                                                                <div class="form-group text-center">
                                                                    <a type="button" ng-click="orgemail(org, details[0].organized_by)" class="btn btn-raised btn-danger btn-login waves-effect">Send Message</a>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="clearfix">&nbsp;</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--organizer message modal ends here -->
                                            </div>
                                            <div class="clearfix">&nbsp;</div>
                                            <h4 class="event_tickets_h4 h4-responsive bold" style="border-top:1px solid #ccc; padding-top: 10px;">PHOTO GALLERY</h4>
                                            <div class="col-xs-6" ng-repeat="img in details">
                                                <a class="example-image-link" href="" data-lightbox="example-set" data-title="{{img.IG_title}}"> 
                                                    <img style="height: 100px; border: 1px solid #ccc;" class="img-responsive img-rounded" src="./tc-merchant-template/assets/img/New_folder/landscape.jpg" alt="1" /> 
                                                </a>
                                            </div>
                                            <div class="clearfix">&nbsp;</div>
                                            <h4 class="event_tickets_h4 h4-responsive bold" style="border-top:1px solid #ccc; padding-top: 10px;">VIDEO GALLERY</h4>
                                            <div class="col-xs-12 img-responsive" ng-repeat="img in details">
                                                <embed style="width:100%" src="http://www.youtube.com/v/FtHKu7zW_zQ">
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <!--left sidebar panel ends here-->
                                <!--right sidebar panel starts here-->
                                <div class="col-lg-8 col-md-8 col-sm8 col-xs-12">

                                    <ul class="tab" id="event_tab">
                                        <li ng-hide="none"><a class="tablinks active" du-smooth-scroll="overview" du-scrollspy><i class="fa fa-info-circle"></i> EVENT OVERVIEW</a></li>
                                        <li class="hidden-xs"><a class="tablinks" du-smooth-scroll="tickets" du-scrollspy><i class="fa fa-ticket"></i> TICKETS</a></li>
                                        <li><a class="tablinks" du-smooth-scroll="venue" du-scrollspy><i class="fa fa-map-marker"></i> VENUE</a></li>
                                    </ul>
                                    <div class="terms_con">
                                        <!--tickets first tab here start -->
                                        <div id="overview">
                                            <div class="panel panel-default">
                                                <div class="panel-body">
                                                    <h4 class="text-left bold"> About Event</h4>
                                                    <p>{{details[0].event_description}}</p>
                                                </div>
                                            </div>
                                            <!-- panel end-->
                                            <div class="panel panel-default">
                                                <div class="panel-body">
                                                    <h4 class="text-left bold">Terms &amp; Conditions</h4>
                                                    <p>{{details[0].event_terms_conditions}}</p>
                                                </div>
                                            </div>
                                            <!-- panel end-->
                                        </div>
                                        <!--frist tab content end-->
                                        <!--second tab content start-->
                                        <div id="tickets" class="hidden-xs">
                                            <div class="panel panel-default">
                                                <div class="panel-body">
                                                    <h4 class="text-left bold">Tickets<br/>
                                                        <small>Tickets for "{{details[0].event_title}}" can be purchased here.</small>
                                                    </h4>
                                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                                        <button class="btn btn-raised btn-danger btn-block bold bookticket">Book Now</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--second tab content end-->
                                        <!--third tab content start-->
                                        <div id="venue">
                                            <div class="panel panel-default">
                                                <div class="panel-body">
                                                    <h4 class="text-left bold">Venue<br/><small>{{details[0].venue_address}}</small></h4>
                                                    <map id="map_canvas"></map>
                                                </div>
                                            </div>
                                        </div>

                                        <!--third tab content end-->
                                        <!--./tab bar end here-->
                                    </div>
                                </div>
                                <!--right sidebar panel ends here-->
                            </fieldset>
                            <!--step1 ends here-->
                            <!--step2 starts here-->
                            <fieldset id="step2" style="display: none;">
                                <div class="col-md-12 col-sm-12 col-xs-12 table-responsive margin-top-15" ng-hide="none">
                                    <div class="text-center">
                                        <table id="table">
                                            <thead id="thead">
                                                <tr id="tr" class="hidden-xs">
                                                    <th style="min-width:60px;" class="bdr-1-w">
                                                        <a href="javascript:void(0);" class="text-black bold">
                                                            <h4 class="text-black bold"><i class="fa fa-arrow-left" aria-hidden="true"></i></h4>
                                                        </a>
                                                    </th>
                                                    <th class="bdr-1-w">
                                            <h4 class="text-uppercase text-black bold"> {{details[0].event_title}} </h4>
                                            </th>
                                            <th class="bdr-1-w">
                                            <h4 class="text-center text-uppercase text-black">
                                                <strong>{{total_qnty + 0}}</strong><br/>
                                                <small class="text-white">ATTENDING</small>
                                            </h4>
                                            </th>
                                            <th class="bdr-1-w">
                                            <h4 class="text-center text-uppercase text-black">
                                                <strong>৳ {{total_amount + 0}} <a id="info-arrow" href="javascript:void(0);" style="color:#000000;" class="bold pull-right hidden-xs"><i class="fa fa-chevron-down"></i></a></strong><br/>
                                                <small class="text-white">TICKET(S) PRICE</small>
                                            </h4>
                                            </th>

                                            </tr>
                                            <!--visible only at extra small device -->
                                            <tr id="tr" class="visible-xs">
                                                <th style="min-width:60px;">
                                                    <a href="javascript:void(0);" class="text-black bold">
                                                        <h4 class="text-black bold"><i class="fa fa-arrow-left"></i></h4>
                                                    </a>
                                                </th>
                                                <th colspan="3">
                                                <h4 class="text-black bold"> {{details[0].event_title}} </h4>
                                            </th>
                                            </tr>
                                            <!--end visible row at xs device-->
                                            <!--not visible at extra small device -->
                                            <tr id="infotr" class="hidden-xs" style="display:none;">
                                                <th class="bdr-1-w">
                                                    &nbsp;
                                                </th>
                                                <th class="text-left bdr-1-w">
                                            <p class="text-black"><i class="fa fa-map-marker"></i> {{details[0].venue_title}}</p>
                                            <p class="text-black"><i class="fa fa-calendar"></i> {{details[0].venue_start_date}} {{details[0].venue_start_time}}</p>
                                            </th>
                                            <th class="bdr-1-w">
                                                &nbsp;
                                            </th>
                                            <th class="text-center bdr-1-w" >
                                            <p ng-repeat="x in eventTicketTypeTicket" class="text-black">৳ {{x.price}}x {{tck_qnty+0}} </p>
                                            <p ng-repeat="x in eventTicketTypeInclude" class="text-black">৳ {{x.price}}x {{tck_inc_q+0}} </p>
                                            </th>
                                            </tr>
                                            <!--end not visible row at xs device-->
                                            </thead>
                                            <tbody id="tbody" ng-hide="hideEvent">
                                                <tr id="tr" ng-repeat="x in eventTicketTypeTicket">
                                                    <!--hidden in only xs-->
                                                    <td colspan="2" id="td" id="td" ng-init="tckpass()">
                                                        <p id="cart_Left_Table_p" class="text-left">{{x.TT_type_title}}
                                                            <span ng-model="tck[$index].price = x.price" class="unit-price text-left pull-right hidden-xs">৳ {{x.price}}</span>
                                                        </p>
                                                        <p ng-model="tck[$index].price = x.price" class="unit-price text-left visible-xs">৳ {{x.price}}</p>
                                                    </td>

                                                    <td class="sprinoff" id="td" ng-model="tck[$index].ticket_id = x.TT_id">
                                                        <div class="input-group"> 
                                                            <span ng-click="countf = (countf == 0 ? countf = 0 : countf - 1);totalQPT()" ng-init="countf = 0" class="input-group-addon qty-plus">
                                                                <i class="fa fa-minus"></i>
                                                            </span>

                                                            <input style="border:2px solid #555555;" type="text" value="{{countf}}" ng-model="tck[$index].quantity = countf"  class="form-control tqv qty-input"> 

                                                            <span ng-click="countf = (countf == x.TT_per_user_limit ? countf = x.TT_per_user_limit : countf + 1);totalQPT(countf,$index)" ng-init="countf = 0" class="input-group-addon qty-minus">
                                                                <i class="fa fa-plus"></i>
                                                            </span>
                                                        </div>
                                                    </td>

                                                    <td id="td" width="30%" class="hidden-xs">
														<strong ng-model="tck[$index].total_price" style="font-size: 18px; font-weight: bolder; line-height: 50px;" id="cart_Left_Table_p">৳ {{x.price * countf}}</strong>
													</td>
                                                </tr>
                                            </tbody>
<!--                                        </table>-->
										
										
										<!-- for free tickets -->
<!--									<table id="table">-->
                                        
                                        <tbody id="tbody" ng-show="hideEvent">
                                            <tr id="tr" ng-repeat="x in eventTicketTypeTicket">
                                                
												<!--hidden in only xs-->
													<td colspan="2" id="td" id="td" ng-init="tck()">
														<p id="cart_Left_Table_p" class="text-left">{{x.TT_type_title}}
															<span ng-model="tck_inc[$index].price = x.price" class="unit-price text-left pull-right hidden-xs">৳ {{x.price}}</span>
														</p>
														<p ng-model="tck_inc[$index].price = x.price" class="unit-price text-left visible-xs">৳ {{x.price}}</p>
													</td>
													
                                                <td class="sprinoff" id="td" ng-model="tck[$index].ticket_id = x.TT_id">
                                                    <div class="input-group"> 
														<span ng-click="countt = (countt == 0 ? countt = 0 : countt - 1);totalQPF()" ng-init="countt = 0" class="input-group-addon qty-plus">
															<i class="fa fa-minus"></i>
														</span>
														
                                                        <input style="border:2px solid #555555;" type="text" value="{{countt}}" ng-model="tck[$index].quantity = countt"   class="form-control tqv qty-input"> 
														
														<span ng-click="countt = (countt == x.TT_per_user_limit ? countt = x.TT_per_user_limit : countt + 1);totalQPF(countt,$index)" ng-init="countt = 0" class="input-group-addon qty-minus">
																<i class="fa fa-plus"></i>
														</span> 
														
													</div>
                                                </td>
                                              
                                            </tr>
                                        </tbody>
<!--                                    </table>-->
									
									
										<!-- include tickets -->
<!--										<table id="table" >-->
											<tbody id="tbody">
												<tr id="tr" ng-repeat="x in eventTicketTypeInclude">
													<!--hidden in only xs-->
													<td colspan="2" id="td" id="td" ng-init="tckpass_inc()">
														<p id="cart_Left_Table_p" class="text-left">{{x.TT_type_title}}
															<span ng-model="tck_inc[$index].price = x.price" class="unit-price text-left pull-right hidden-xs">৳ {{x.price}}</span>
														</p>
														<p ng-model="tck_inc[$index].price = x.price" class="unit-price text-left visible-xs">৳ {{x.price}}</p>
													</td>
														
													<td class="sprinoff" id="td" ng-model="tck_inc[$index].ticket_id = x.TT_id">
														<div class="input-group"> 
															<span ng-click="counti = (counti == 0 ? counti = 0 : counti - 1);totalQPI()" ng-init="counti = 0" class="input-group-addon qty-plus">
																	<i class="fa fa-minus"></i>
															</span>
															
															<input style="border:2px solid #555555;" type="text" value="{{counti}}" ng-model="tck_inc[$index].quantity = counti" class="form-control tqv qty-input"> 
															
															<span ng-click="counti = (counti == x.TT_per_user_limit ? counti = x.TT_per_user_limit : counti + 1);totalQPI(counti,$index)" ng-init="counti = 0" class="input-group-addon qty-minus">
																<i class="fa fa-plus"></i>
															</span> 
															
														</div>
													</td>
													
													<td id="td" width="30%">
														<p ng-model="tck_inc[$index].total_price" style="font-size: 18px; font-weight: bolder; line-height: 50px;" id="cart_Left_Table_p">৳ {{x.price * counti}}</p>
													</td>
												   
												</tr>
											</tbody>
										</table>
									
                                    </div>
                                </div>
								
								
                                <div class="col-lg-2 col-md-2 col-sm-2 col-lg-offset-5 col-md-offset-5 col-sm-offset-5 col-xs-12">
                                    <button id="step2confirm" class="btn btn-raised btn-danger btn-block bold">PROCEED</button>
                                </div>
                            </fieldset>
                            <!--step2 ends here-->
                            <!--step3 starts here-->
                            <fieldset id="step3" style="display: none;">
                                <div class="col-md-4 col-sm-4 col-md-offset-4 col-sm-offset-4 col-xs-12 text-center">
                                    <div class="text-uppercase text-center">
                                        <h3 class="text-center bold pay_hed"> Lets Add Attendee</h3>
                                        <form action="" ng-model="dd"  name="myform" novalidate">
                                            <div class="form-style" ng-repeat="x in formData">
                                                <div>
                                                    <label for="exampleInputEmail1" class="pull-left text-black bold">{{x.form_field_title}}</label>
                                                    <input type="{{x.form_field_type}}" ng-required="true" id="custom{{x.form_field_name}}" ng-keyup="customfieldpush(x.form_field_name)" ng-model="name" class="form-control" /> </div>
                                            </div>
                                        </form>
                                        <!--./shear your contact details end here-->
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-lg-offset-5 col-md-offset-5 col-sm-offset-5 col-xs-12">
                                    <button  id="step3confirm" class="btn btn-raised btn-block btn-danger bold">CONTINUE</button>
                                </div>

                            </fieldset>
                            <!--step3 ends here-->
                            <!--step4 starts here-->
                            <fieldset id="step4" style="display: none;">
                                <!--Make Payment With start here-->
                                <h3 class="text-uppercase text-center bold pay_hed">
                                    Select Payment And Delivery Method
                                </h3>
                                <div id="div2" class="col-md-4 col-sm-4 col-md-offset-4 col-sm-offset-4 col-xs-12 text-center">
                                    <div class="row text-center" ng-init="selection={}">
                                        
                                        <select class="form-control" ng-model="p_name" id="condition" style="border: 2px solid #4CAF50; border-radius: 4px;">
                                            <option value="" class="text-center">------Please select payment method------</option> 
                                            <option ng-repeat="x in payment_method" value="{{x.name}}" >{{x.name}}</option>
                                        </select>
										<select ng-show="hideEvent"  class="form-control" ng-model="p_name" id="normal" style="border: 2px solid #4CAF50; border-radius: 4px;">
                                            <option value="" class="text-center">------Please select free payment method------</option> 
                                            <option ng-repeat="x in freeEventpayment_method" value="{{x.name}}" >{{x.name}}</option>
                                        </select>
										
										
                                        <div class="col-md-12 panel panel-default" ng-if="p_name == 'Pick UP Point'" >
                                            <h3 class="text-center bold pay_hed text-uppercase">
                                                Event Pick Point List
                                            </h3>
											
												<div ng-repeat="m in point">
													<p>
														<input ng-model="selection.modelSelected" type="radio" name="patient" value="{{ m}}" required>
														{{ m.name }}
													</p>
												</div> 
										 
                                        </div>
										<div class="col-md-12 panel panel-default" ng-if="p_name == 'Home Delivery'">
                                                    <h3 class="text-center bold pay_hed">
                                                        <i class="fa fa-map" style="color:#689f38"></i> Home Delivery Details
                                                    </h3>
                                                    <div>
                                                        <div class="form-group label-floating success">
                                                            <label class="control-label">Full Name</label>
                                                            <input type="text" ng-model="org.name" class="form-control">
                                                        </div>
                                                        <div class="form-group label-floating success">
                                                            <label class="control-label">Email</label>
                                                            <input type="email" ng-model="org.email" class="form-control">
                                                        </div>
                                                        <div class="form-group label-floating success">
                                                            <label class="control-label">Phone No.</label>
                                                            <input type="text" ng-model="org.phone" class="form-control">
                                                        </div>
                                                        <div class="form-group label-floating success">
                                                            <label class="control-label">Message</label>
                                                            <textarea class="form-control" ng-model="org.msg" rows="3"></textarea>
                                                        </div><br>
                                                    </div>
                                                </div>
										<!--./Make Payment With end here-->
                                            <button id="step4confirm" ng-click="buyInclude(p_name,selection.modelSelected)"  class="condition btn btn-raised btn-success bold payment_btn">CONTINUE</button>
											
											<button id="step4confirm" ng-show="hideEvent" ng-click="buyFreeTicket(p_name,selection.modelSelected)"  class="normal btn btn-raised btn-success bold payment_btn">CONTINUE</button>
											
											
                                        </fieldset>
                                        <!--step4 ends here-->
										
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
                        <?php
                        if (isset($_GET['id'])) {
                            ?>
                            <div ng-init="dynamicForm('<?php echo $_GET['id']; ?>')"></div>
                            <div ng-init="eventwisepaymentmethod('<?php echo $_GET['id']; ?>')"></div>
                            <div ng-init="freeEventpaymentmethod('<?php echo $_GET['id']; ?>')"></div>
                            <div ng-init="eventTags('<?php echo $_GET['id']; ?>')"></div>
                            <div ng-init="eventPickPoint('<?php echo $_GET['id']; ?>')"></div>

                            <?php
                        }
                        ?>
                        <!-- main content part ends here -->
                        <!-- main footer part starts here -->
                        <!--Footer-->
                        <?php include 'include/footer.php'; ?>
                        <!-- book ticket floating widget starts here -->
                        <div class="clearfix"></div>
                        <div id="bookticket-float" class="container-fluid bookticket-widget navbar-fixed-bottom visible-xs" style="border-radius: 0px;">
                            <div class="row" style="overflow: hidden;">
                                <div class="col-xs-12">
                                    <button class="btn btn-raised btn-danger btn-block bold bookticket">Book Now</button>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <!-- book ticket floating widget starts here -->
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <!-- subscription widget starts here -->
            <!-- Sart Modal -->
            <!-- All auto click button  start-->
            <?php
            @$f_id = $_GET['id'];
            @$c_id = $_GET['c_id'];
            @$up_id = $_GET['up_id'];
            if (!empty($f_id)) {
                echo '<span id="autoclick" ng-click="f_eventDetailCall(' . $f_id . ')"></span>';
                echo '<span id="autoclick1" ng-click="checkFreeEvent(' . $f_id . ')"></span>';
            } elseif (!empty($c_id)) {
                echo '<span id="autoclick" ng-click="c_eventDetailCall(' . $c_id . ')"></span>';
            } else {
                echo '<span id="autoclick" ng-click="up_eventDetailCall(' . $up_id . ')"></span>';
            }
            ?>
            <?php echo $cms->fotterJs(array('checkout1'));
            ?>
            <?php echo $cms->angularJs(array('checkout1_angular')); ?>

            <!--bootstrap tab javascript -->
            <script text="text/javascript">
                $(document).ready(function () {
                    $("#autoclick").click();
                    $("#autoclick1").click();
                    $(".tqv").keyup(function () {
                        console.log($(this).val());
                    });
                });
            </script>

            <script src="tc-merchant-template/assets/js/angular-scroll.js"></script>
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
            <script>
                $(document).ready(function () {
                    $('#cash_on_del_buton').click(function () {
                        $('#share_detalis').toggle(1000);
                    });
                    $('#cashDbut1').click(function () {
                        $('#share_detalis').hide(1000);
                    });
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
                    //            setTimeout(function (a) {
                    //                $('#subscription').slideDown(1000);
                    //            }, 15000);
                    //            setTimeout(function (b) {
                    //                $('#subscription').slideUp(3000);
                    //            }, 30000);
                    //            $('#btn-sclose').click(function () {
                    //                $('#subscription').slideUp(1000);
                    //            });

                    $('#nav-search-btn').click(function () {
                        $('#nav-search-field').show();
                        $('#nav-search-btn').hide();
                    });
                    $('#nav-search-close').click(function () {
                        $('#nav-search-field').hide();
                        $('#rslt-div').hide();
                        $('#nav-search-btn').show();
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
        <!--    <script>
                $(function () {
                    $(".l1").on("click", function (e) {
                        e.PreventDefault();
                        $("body, html").animate({
                            scrollTop: $($(this).attr('href')).offset('70').top
                        }, 1000);
                        $(".l2,.l3").removeClass("active");
                        $(".l1").addClass("active");
                    });
                    $(".l2").on("click", function (e) {
                        e.PreventDefault();
                        $("body, html").animate({
                            scrollTop: $($(this).attr('href')).offset('70').top
                        }, 1000);
                        $(".l1,.l3").removeClass("active");
                        $(".l2").addClass("active");
                    });
                    $(".l3").on("click", function (e) {
                        e.PreventDefault();
                        $("body, html").animate({
                            scrollTop: $($(this).attr('href')).offset('70').top
                        }, 1000);
                        $(".l1,.l2").removeClass("active");
                        $(".l3").addClass("active");
                    });
                    
                });
            </script>-->
            <?php
            if (isset($_GET['id'])) {
                ?>
                <script>
                    $(document).ready(function () {
                        $("#dynamite").click();
                    });
                </script>
                <?php
            }
            ?>
            <!--Add to calendar script-->
            <script type="text/javascript">
                (function () {
                    if (window.addtocalendar)
                        if (typeof window.addtocalendar.start == "function")
                            return;
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

            <script type="text/javascript">
                $(document).ready(function () {
                    $('.bookticket').click(function () {
                        //$('#checkout_top_banner').hide();
                        $('#bookticket-float').addClass("invisible");
                        $('#step1').hide();
                        $('#step3').hide();
                        $('#step4').hide();
                        $('#step2').show();
                    });
                    $('#step2confirm').click(function () {
                        //$('#checkout_top_banner').hide();
                        $('#step1').hide();
                        $('#step2').hide();
                        $('#step4').hide();
                        $('#step3').show();
                    });
                    $('#step3confirm').click(function () {
                        //$('#checkout_top_banner').hide();
                        $('#step1').hide();
                        $('#step2').hide();
                        $('#step3').hide();
                        $('#step4').show();
                    });
                    $('#info-arrow').click(function () {
                        $('#infotr').slideToggle();
                    });

                });
            </script>
    </body>

</html>