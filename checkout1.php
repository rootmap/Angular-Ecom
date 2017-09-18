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
        <!--<script src="map.js"></script>-->
        <script src="http://maps.googleapis.com/maps/api/js?sensor=false&language=en"></script>



        <?php
        echo $cms->pageTitle("Checkout1 | Ticketchai.com...");
        ?>
        <?php
        echo $cms->headCss(array("checkout1"));
        ?>

        <!--<link rel="stylesheet" href="tc-merchant-template/assets/css/mediaQuery.css">-->
        <style>
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
                        }*/
            @media only screen and (max-width: 480px) {

                #table th,#table td,#table h4{
                    font-size:10px;
                }
                td, th {
                    border: 0 none !important;
                    padding: 0px !important;
                    text-align: center;
                }
                #tdp{
                    font-size:10px !important;
                }
            }

            #map_canvas {
                margin: 0;
                padding: 0;
                height: 400px;
                border: 1px solid #ccc;
            }

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
        <?php //echo $cms->FbSocialScript(); ?>
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
                                    <img check-image ng-src="upload/event_web_banner/{{details[0].event_web_banner}}" alt="image loading problem" class="img-fluid img-responsive carousel-img-bd" style="width:100%; max-height: 350px;">
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
                    <div class="container-fluid">
                        <div class="row" style="margin-top:10px !important;">
                            <!--step1 starts here-->
                            <fieldset id="step1">
                                <!--left sidebar panel starts here-->
                                <div class="col-lg-4 col-md-4 col-sm4 col-xs-12">
                                    <div class="panel panel-default ">
                                        <div class="panel-heading text-center" style="background-color:#ffffff;" >
                                            <h4 class="panel-title h4-responsive bold">{{details[0].event_title}} </h4>
                                            <!--<p>{{details[0].venue_end_date}} - {{details[0].venue_end_date}} </p><p> {{details[0].venue_start_time}} ONWARDS</p>-->
                                            <p>{{details[0].venue_start_date}}&nbsp;&nbsp; <span ng-hide="details[0].venue_end_date == null">to</span> &nbsp;&nbsp;{{details[0].venue_end_date}} </p><p> {{details[0].venue_start_time}}&nbsp;&nbsp; <span ng-hide="details[0].venue_end_time == null">to</span> &nbsp;&nbsp;{{details[0].venue_end_time}}</p>
                                            <button ng-hide="none" class="btn btn-raised btn-danger btn-block bold bookticket hidden-xs">{{details[0].button_lebel}}</button>
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
                                                            <var class="atc_organizer_email">support@ticketchai.com</var>
                                                        </var>
                                                    </span> 
                                                </div>
                                                <div class="col-xs-6"> <!--ng-hide="hide"-->
                                                    <a title="Get Direction" href="map1.php?venue={{details[0].venue_geo_location}}" target="_new"> 
                                                        <span class="btn btn-md btn-success-outline waves-effect"><i class="fa fa-map-marker" ></i> Direction<!--GET DIRECTION--></span> </a>
                                                </div>
                                            </div>

                                            <!--[Event share part start]-->
                                            <div class="form-group">
                                                <span class="bold text-right">Share : &nbsp;&nbsp;</span>                                


                                                <div>
                                                    <ul ng-social-buttons data-url="'http://ticketchai.com/'" data-title="details[0].event_title" data-text="fbshare" data-description="fbshare" data-image="details[0].event_web_banner">
                                                        <span class="ng-social-facebook "><i style="padding-top:15px !important" class="fa fa-facebook"></i></span>
                                                        <span class="ng-social-twitter"><i style="padding-top:15px !important" class="fa fa-twitter"></i></span>
                                                    </ul>
                                                </div>

                                                <!--[for google start]-->
                                            </div>
                                            <!--[Event share part start]-->

                                            <div class="form-group">
                                                <a href="" ng-click="addToWishlist(details[0].event_id, 'event')"><span class="btn btn-event_l"><i class="fa fa-heart" style="font-size: 20px; padding: 6px; color:#88C659; border:1px solid #88C659;" title="Add to wishlist" aria-hidden="true"></i></span></a>
                                                <a class="btn btn-info btn-raised" style="margin-right:5px;" ng-hide="tag.length == 0" ng-repeat="tag in tags"href="TagWiseEvent.php?tagName={{tag}}"><i class="fa fa-hashtag" aria-hidden="true"></i>{{tag}}</a>
                                            </div>
                                            <div class="col-xs-12 text-center"  style="border-top:1px solid #ccc;">
                                                <h4 class="event_tickets_h4 h4-responsive bold">ORGANIZER</h4>
                                                <img style="margin: 0 auto; height: 85px; border: 1px solid #ccc; width:100px;" src="./upload/merchent_images/{{details[0].admin_images}}" class="img-circle" alt="1"/>
                                                <h4 class="event_tickets_h4 h4-responsive">{{details[0].organized_by}}</h4>
<!--                                                <a title="Send Message" href="#"> <span class="btn btn-md btn-block btn-primary-outline waves-effect"> Send Message </span> </a>-->
                                                <button class="btn btn-raised btn-info btn-block bold"  data-toggle="modal" data-target="#omsgModal">Send Message</button>
                                                <!--organizer message modal starts here -->
                                                <!-- Modal Core -->
                                                <div class="modal fade" id="omsgModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-success">
                                                                <button type="button" class="close" data-dismiss="modal" id="close_model" aria-hidden="true">&times;</button>
                                                                <h4 class="modal-title text-uppercase" id="myModalLabel">Send Message</h4>
                                                                <br/>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group label-floating success">
                                                                    <label class="control-label">Full Name</label>
                                                                    <input type="text" ng-model="org.name" class="form-control">
                                                                </div>
                                                                <!--                                                                <div class="form-group label-floating success">
                                                                                                                                    <label class="control-label">Email</label>
                                                                                                                                    <input type="email" ng-model="org.email" class="form-control">
                                                                                                                                </div>-->
                                                                <div class="form-group label-floating success">
                                                                    <label class="control-label">Phone No.</label>
                                                                    <input type="text" ng-model="org.phone" class="form-control">
                                                                </div>
                                                                <div class="form-group label-floating success">
                                                                    <label class="control-label">Message</label>
                                                                    <textarea class="form-control" ng-model="org.msg" rows="3"></textarea>
                                                                </div>
                                                                <div class="form-group text-center">
                                                                    <?php //echo $_GET['id'];  ?>
                                                                    <a type="button" ng-click="orgemail(org, details[0].organized_by, '<?php echo $_GET['id']; ?>')" class="btn btn-raised btn-danger btn-login waves-effect">Send Message</a>
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
                                            <!--<h4 class="event_tickets_h4 h4-responsive bold"style="border-top:1px solid #ccc; padding-top: 10px;">PHOTO GALLERY</h4>-->
                                            <!--<h3 class="event_tickets_h4 h4-responsive bold" style="padding-top: 10px;">No data found</h3>-->
                                            <!--                                            <div class="col-xs-6 " ng-repeat="img in details" ng-hide="img.IG_image_name == ''">
                                                                                            <a class="example-image-link" href="#" data-lightbox="example-set"  data-title="{{img.IG_title}}"> 
                                                                                                <img style="height: 100px; border: 1px solid #ccc;" class="img-responsive img-rounded" src="upload/image_file/original/{{img.IG_image_name}}" alt="1" />
                                                                                            </a>
                                                                                        </div>-->
                                            <div class="clearfix">&nbsp;</div>
                                            <!--<h4 class="event_tickets_h4 h4-responsive bold" style="border-top:1px solid #ccc; padding-top: 10px;">VIDEO GALLERY</h4>-->
                                            <!--<h3 class="event_tickets_h4 h4-responsive bold" style="padding-top: 10px;">No data found</h3>-->
                                            <!--                                            <div class="col-xs-12 img-responsive ng-hide" ng-repeat="img in details">
                                                                                            <embed style="width:100%" src="http://www.youtube.com/v/FtHKu7zW_zQ">
                                                                                        </div>-->
                                        </div>


                                    </div>
                                </div>
                                <!--left sidebar panel ends here-->
                                <!--right sidebar panel starts here-->
                                <div class="col-lg-8 col-md-8 col-sm8 col-xs-12">

                                    <ul class="tab" id="event_tab">
                                        <li><a class="tablinks active" du-smooth-scroll="overview" du-scrollspy><i class="fa fa-info-circle"></i> EVENT OVERVIEW</a></li>
                                        <li ng-hide="none" class="hidden-xs"><a class="tablinks" du-smooth-scroll="tickets" du-scrollspy><i class="fa fa-ticket"></i> TICKETS</a></li>
                                        <li><a class="tablinks" du-smooth-scroll="venue" du-scrollspy><i class="fa fa-map-marker"></i> VENUE</a></li>
                                    </ul>
                                    <div class="terms_con">
                                        <!--tickets first tab here start -->
                                        <div id="overview">
                                            <div class="panel panel-default" ng-hide="details[0].event_description.length == 0">
                                                <div class="panel-body">
                                                    <h4 class="text-left bold"> About Event</h4>
                                                    <p ta-bind="text" ng-model="details[0].event_description" ta-readonly='disabled'>{{details[0].event_description}}</p>
<!--                                                    <p>{{detail}}</p>-->

                                                </div>
                                            </div>
                                            <!-- panel end-->
                                            <div class="panel panel-default" ng-hide="details[0].event_terms_conditions.length == 0">
                                                <div class="panel-body">
                                                    <h4 class="text-left bold">Terms &amp; Conditions</h4>
                                                    <p>{{details[0].event_terms_conditions}}</p>
                                                </div>
                                            </div>
                                            <!-- panel end-->
                                        </div>
                                        <!--frist tab content end-->
                                        <!--second tab content start-->
                                        <div id="tickets" class="hidden-xs" ng-hide="none">
                                            <div class="panel panel-default">
                                                <div class="panel-body">
                                                    <h4 class="text-left bold">Tickets<br/>
                                                        <small>Tickets for "{{details[0].event_title}}" can be purchased here.</small>
                                                    </h4>
                                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                                        <button class="btn btn-raised btn-danger btn-block bold bookticket">{{details[0].button_lebel}}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--second tab content end-->
                                        <!--third tab content start-->
                                        <div id="venue">
                                            <div class="panel panel-default">
                                                <div class="panel-body">
                                                    <h4 class="text-left bold">Venue<br/>
                                                        <small>{{details[0].venue_address}}</small>
                                                    </h4>
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

                                <div class="table-responsive text-uppercase text-center" ng-hide="none">
                                    <table id="table" style="margin-top:30px;">
                                        <thead id="thead" >
                                            <tr id="tr" class="hidden-xs">
                                                <th class="bdr-1-w"  width="17%">
                                                    <a href="javascript:void(0);" class="text-black bold" id="backDefault">
                                                        <h4 class="text-black bold"><i class="fa fa-arrow-left" aria-hidden="true"></i></h4>
                                                    </a>
                                                </th>
                                                <th class="bdr-1-w"  width="35%">
                                        <h4 class="text-uppercase text-black bold"> {{details[0].event_title}} </h4>
                                        </th>
                                        <th class="bdr-1-w">
                                        <h4 class="text-center text-uppercase text-black">
                                            <strong id="qnty">{{total_qnty + 0}}</strong><br/>
                                            <small class="text-white">ATTENDING</small>
                                        </h4>
                                        </th>
                                        <th class="bdr-1-w">
                                        <h4 class="text-center text-uppercase text-black">
                                            <strong>৳ {{total_amount + 0}} <a id="info-arrow" href="javascript:void(0);" style="color:#000000;" class="bold pull-right hidden-xs"><!--<i class="fa fa-chevron-down"></i>--><!--</a></strong><br/>
                                            <small class="text-white">TICKET(S) PRICE</small>
                                        </h4>
                                        </th>

                                        </tr>
                                                    <!--visible only at extra small device -->
                                                    <tr id="tr" class="visible-xs">
                                                        <th style="min-width:60px;">
                                                            <a href="javascript:void(0);" class="text-black bold" id="smbackDefault">
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
                                                    <p ng-repeat="x in eventTicketTypeTicket" class="text-black">৳ {{x.price}}x {{tck_qnty + 0}} </p>
                                                    <p ng-repeat="x in eventTicketTypeInclude" class="text-black">৳ {{x.price}}x {{tck_inc_q + 0}} </p>
                                                    </th>
                                                    </tr>
                                                    <!--end not visible row at xs device-->
                                                    </thead>

                                                    <tbody id="tbody"  ng-hide="hideEvent" ng-hide="eventTicketTypeTicket.length == 0" ng-init="tckpass()">
                                                        <tr id="tr" ng-repeat="x in eventTicketTypeTicket">
                                                            <td id="td" width="17%">
                                                                <p id="cart_Left_Table_p">{{x.TT_type_title}}</p>
                                                            </td>

                                                            <td class="td" id="td" width="35%">
                                                                <p ng-model="tck[$index].price = x.price" style="font-size: 18px; font-weight: bolder; line-height: 50px;" id="tdp">৳ {{x.price}}</p>
                                                            </td>

                                                            <td class="sprinoff" id="td" ng-model="tck[$index].ticket_id = x.TT_id">
                                                                <div class="input-group"> 
                                                                    <span ng-click="count = (count == 0 ? count = 0 : count - 1);
                                                                                    totalQP()" ng-init="count = 0" class="input-group-addon qty-plus"><i class="fa fa-minus"></i></span>
                                                                    <input style="border:2px solid #555555;" type="text" value="{{count}}" ng-model="tck[$index].quantity = count"  class="form-control tqv qty-input"> 
                                                                    <span ng-click="count = (count == x.TT_per_user_limit ? count = x.TT_per_user_limit : count + 1);
                                                                                    totalQP(count, x.TT_per_user_limit)" ng-init="count = 0" class="input-group-addon qty-minus" ><i class="fa fa-plus"></i></span> 
                                                                </div>
                                                            </td>

                                                            <td id="td" width="30%">
                                                                <p id="tdp" ng-model="tck[$index].total_price" style="font-size: 18px; font-weight: bolder; line-height: 50px;" id="cart_Left_Table_p">৳ {{x.price * count}}</p>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                    </table>
                                                    </div>
                                                    <!--</div>-->
                                                    <div class="table-responsive text-uppercase text-center" ng-i="hideEvent">

                                                        <table id="table">

                                                            <tbody id="tbody" ng-init="tckFreepass()">
                                                                <tr id="tr" ng-repeat="x in eventTicketFreeTicket">
                                                                    <td id="td" width="17%">
                                                                        <p id="cart_Left_Table_p">{{x.TT_type_title}}</p>
                                                                    </td>

                                                                    <td class="td" id="td" width="35%">
                                                                        <p id="tdp" ng-model="tckFree[$index].price = x.price" style="font-size: 18px; font-weight: bolder; line-height: 50px;">৳ {{x.price}}</p>
                                                                    </td>
                                                                    <td class="sprinoff" id="td" ng-model="tckFree[$index].ticket_id = x.TT_id">
                                                                        <div class="input-group"> 
                                                                            <!--<span ng-click="count = (count == 0 ? count = 0 : count - 1);totalQP()" ng-init="count = 0" class="input-group-addon" style="font-size: 30px; font-weight: bolder;">-</span>-->
                                                                            <span ng-click="count = (count == 0 ? count = 0 : count - 1);
                                                                                            totalQP()" ng-init="count = 0" class="input-group-addon qty-plus"><i class="fa fa-minus"></i></span>
                                                                            <input style="border:2px solid #555555;" type="text" value="{{count}}" ng-model="tckFree[$index].quantity = count" ng-init="Initqval()" class="form-control tqv qty-input"> 
                                                                            <!--<span ng-click="count = (count == x.TT_per_user_limit ? count = x.TT_per_user_limit : count + 1);totalQP()" ng-init="count = 0" class="input-group-addon " style="font-size: 30px; font-weight: bolder;">+</span> </div>-->
                                                                            <span ng-click="count = (count == x.TT_per_user_limit ? count = x.TT_per_user_limit : count + 1);
                                                                                            totalQP(count, x.TT_per_user_limit)" ng-init="count = 0" class="input-group-addon qty-minus" ><i class="fa fa-plus"></i></span>
                                                                        </div>
                                                                    </td>
                                                                    <td width="30%">
                                                                        <p id="tdp" style="font-size: 18px; font-weight: bolder; line-height: 50px;" >৳ {{x.price * count}}</p>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="table-responsive text-uppercase text-center"  ng-hide="eventTicketTypeInclude.length == 0">
                                                        <table id="table">
                                                            <thead id="thead">
                                                                <tr id="tr">
                                                                    <th colspan="4" style="background-color:#ECEFF1 !important;">
                                                                        <a href="javascript:void(0);" class="text-black bold">
                                                                            <h4 class="text-black bold"><i class="fa fa-ticket" aria-hidden="true"></i> Ticket Includes</h4>
                                                                        </a>
                                                                    </th>
                                                                </tr>
                                                            </thead>

                                                            <tbody id="tbody" ng-init="tckpass_inc()">
                                                                <tr id="tr" ng-repeat="x in eventTicketTypeInclude">
                                                                    <td id="td" width="17%">
                                                                        <p id="cart_Left_Table_p">{{x.TT_type_title}}</p>
                                                                    </td>
                                                                    <td class="td" id="td"  width="35%">
                                                                        <p id="tdp" ng-model="tck_inc[$index].price = x.price" style="font-size: 18px; font-weight: bolder; line-height: 50px;">৳ {{x.price}}</p>
                                                                    </td>
                                                                    <td class="sprinoff" id="td" ng-model="tck_inc[$index].ticket_id = x.TT_id">
                                                                        <div class="input-group"> 
                                                                            <!--<span ng-click="count = (count == 0 ? count = 0 : count - 1);totalQP()" ng-init="count = 0" class="input-group-addon" style="font-size: 30px; font-weight: bolder;">-</span>-->
                                                                            <span ng-click="count = (count == 0 ? count = 0 : count - 1);
                                                                                            totalQP()" ng-init="count = 0" class="input-group-addon qty-plus"><i class="fa fa-minus"></i></span>
                                                                            <input style="border:2px solid #555555;" type="text" value="{{count}}" ng-model="tck_inc[$index].quantity = count" ng-init="Initqval()" class="form-control tqv qty-input"> 
                                                                            <!--<span ng-click="count = (count == x.TT_per_user_limit ? count = x.TT_per_user_limit : count + 1);totalQP()" ng-init="count = 0" class="input-group-addon " style="font-size: 30px; font-weight: bolder;">+</span> </div>-->
                                                                            <span ng-click="count = (count == x.TT_per_user_limit ? count = x.TT_per_user_limit : count + 1);
                                                                                            totalQP(count, x.TT_per_user_limit)" ng-init="count = 0" class="input-group-addon qty-minus" ><i class="fa fa-plus"></i></span>
                                                                        </div>
                                                                    </td>

                                                                    <td id="td" width="30%">
                                                                        <p id="tdp" ng-model="tck_inc[$index].total_price" style="font-size: 18px; font-weight: bolder; line-height: 50px;" id="cart_Left_Table_p">৳ {{x.price * count}}</p>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-lg-offset-5 col-md-offset-5 col-sm-offset-5 col-xs-12">
                                                        <button id="step2confirm" ng-click="dynamicForm('<?php echo $_GET['id']; ?>')" class="ckeckincludeQC btn btn-raised btn-success btn-block bold">PROCEED</button>
                                                        <button id="step2confirmFree" ng-click="dynamicForm('<?php echo $_GET['id']; ?>');
                                                                    freeIncMsg(tck_inc_qnty)" class="ckeckincludeQN btn btn-raised btn-success btn-block bold">PROCEED</button>
                                                    </div>
                    <!--                                <p ng-repeat="x in getNumber(2) track by $index">
                                                        {{total_qnty}}
                                                    </p>-->
                                                    </fieldset>
                                                    <!--step2 ends here-->
                                                    <!--step3 starts here-->
                                                    <fieldset id="step3" ng-init="ipa = 0" style="display: none; margin-top: 30px;">
                                                        <table id="table">
                                                            <thead id="thead" >
                                                                <tr id="tr" class="hidden-xs">
                                                                    <th style="min-width:60px;" class="bdr-1-w">
                                                                        <a href="javascript:void(0);" class="text-black bold" id="backDefault1">
                                                                            <h4 class="text-black bold"><i class="fa fa-arrow-left" aria-hidden="true"></i></h4>
                                                                        </a>
                                                                    </th>
                                                                    <th class="bdr-1-w">
                                                            <h4 class="text-uppercase text-black bold"> {{details[0].event_title}} </h4>
                                                            </th>
                                                            <th class="bdr-1-w">
                                                            <h4 class="text-center text-uppercase text-black">
                                                                <strong id="qnty">{{total_qnty + 0}}</strong><br/>
                                                                <small class="text-white">ATTENDING</small>
                                                            </h4>
                                                            </th>
                                                            <th class="bdr-1-w">
                                                            <h4 class="text-center text-uppercase text-black">
                                                                <strong>৳ {{total_amount + 0}} <a id="info-arrow" href="javascript:void(0);" style="color:#000000;" class="info-arrow2 bold pull-right hidden-xs"><!--<i class="fa fa-chevron-down"></i>--></a></strong><br/>
                                                                <small class="text-white">TICKET(S) PRICE</small>
                                                            </h4>
                                                            </th>

                                                            </tr>
                                                            <!--visible only at extra small device -->
                                                            <tr id="tr" class="visible-xs">
                                                                <th style="min-width:60px;">
                                                                    <a href="javascript:void(0);" class="text-black bold" id="smbackDefault1">
                                                                        <h4 class="text-black bold"><i class="fa fa-arrow-left"></i></h4>
                                                                    </a>
                                                                </th>
                                                                <th colspan="3">
                                                            <h4 class="text-black bold"> {{details[0].event_title}} </h4>
                                                            </th>
                                                            </tr>
                                                            <!--end visible row at xs device-->
                                                            <!--not visible at extra small device -->
                                                            <tr id="infot" class="infotr2 hidden-xs" style="display:none;">
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
                                                            <p ng-repeat="x in eventTicketTypeTicket" class="text-black">? {{x.price}}x {{tck_qnty + 0}} </p>
                                                            <p ng-repeat="x in eventTicketTypeInclude" class="text-black">? {{x.price}}x {{tck_inc_q + 0}} </p>
                                                            </th>
                                                            </tr>
                                                            <!--end not visible row at xs device-->
                                                            </thead>

                                                        </table>
                                                        <div  class="col-md-4 col-sm-4 col-md-offset-4 col-sm-offset-4 col-xs-12 ">
                                                            <div class="text-uppercase text-center" ng-repeat="x in getNumber(total_qnty) track by $index">
                                                                <br><h4 class="text-center bold pay_hed"><i class="fa fa-info-circle fa_fan">
                                                                    </i> {{share_cDetail}}# {{$index + 1}}</h4>
                                                                <code id="error"></code>
                                                                <form action="" ng-init="ipa = $index" >
                                                                    <div class="form-style" ng-repeat="x in formData">
                                                                        <div>
                                                                            <!--                                                    ng-keyup="customfieldpush(x.form_field_name,ipa,x.form_field_name)" id="{{ipa}}custom{{x.form_field_name}}"-->
                                                                            <label ng-init="pushAttenArr(ipa, x.form_field_name, x.form_id)" for="exampleInputEmail1" class="pull-left text-black bold">{{x.form_field_title}}</label>
                                                                            <input  type="{{x.form_field_type}}" ng-model="customfield[ipa][x.form_field_name]"   class="form-control check_d"  ng-keyup="autoRun()"   style="border: 2px solid #4CAF50; border-radius: 4px;" > </div>
                                                                    </div>

                                                                </form>

                                                                <!--./shear your contact details end here-->

                                                            </div>
                                                            <button id="step3confirm"  ng-click="dynamicFormMsg()" class="conditionfree btn btn-raised btn-block btn-success bold">CONTINUE</button>
                                                            <button  ng-show="hideEvent" ng-click="buyFreeTicket(tckFree, tck, tck_inc, '<?php echo $_GET['id']; ?>');
                                                                        dynamicFormMsg()" class="normalfree btn btn-raised btn-block btn-success bold">CONTINUE</button>
                                                        </div>


                                                    </fieldset>

                                                    <fieldset id="step5" ng-init="s_ipa = 0" style="display: none; margin-top: 30px;">

                                                        <table id="table">
                                                            <thead id="thead" >
                                                                <tr id="tr" class="hidden-xs">
                                                                    <th style="min-width:60px;" class="bdr-1-w">
                                                                        <a href="#" class="text-black bold" id="backDefault2">
                                                                            <h4 class="text-black bold"><i class="fa fa-arrow-left" aria-hidden="true"></i></h4>
                                                                        </a>
                                                                    </th>
                                                                    <th class="bdr-1-w">
                                                            <h4 class="text-uppercase text-black bold"> {{details[0].event_title}} </h4>
                                                            </th>
                                                            <th class="bdr-1-w">
                                                            <h4 class="text-center text-uppercase text-black">
                                                                <strong id="qnty">{{total_qnty + 0}}</strong><br/>
                                                                <small class="text-white">ATTENDING</small>
                                                            </h4>
                                                            </th>
                                                            <th class="bdr-1-w">
                                                            <h4 class="text-center text-uppercase text-black">
                                                                <strong>৳ {{total_amount + 0}} <a id="info-arrow" href="javascript:void(0);" style="color:#000000;" class="info-arrow3 bold pull-right hidden-xs"><!--<i class="fa fa-chevron-down">--></i></a></strong><br/>
                                                                <small class="text-white">TICKET(S) PRICE</small>
                                                            </h4>
                                                            </th>

                                                            </tr>
                                                            <!--visible only at extra small device -->
                                                            <tr id="tr" class="visible-xs">
                                                                <th style="min-width:60px;">
                                                                    <a href="javascript:void(0);" class="text-black bold" id="smbackDefault2">
                                                                        <h4 class="text-black bold"><i class="fa fa-arrow-left"></i></h4>
                                                                    </a>
                                                                </th>
                                                                <th colspan="3">
                                                            <h4 class="text-black bold"> {{details[0].event_title}} </h4>
                                                            </th>
                                                            </tr>
                                                            <!--end visible row at xs device-->
                                                            <!--not visible at extra small device -->
                                                            <tr id="infotr" class="infotr3 hidden-xs" style="display:none;">
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
                                                            <p ng-repeat="x in eventTicketTypeTicket" class="text-black">? {{x.price}}x {{tck_qnty + 0}} </p>
                                                            <p ng-repeat="x in eventTicketTypeInclude" class="text-black">? {{x.price}}x {{tck_inc_q + 0}} </p>
                                                            </th>
                                                            </tr>
                                                            <!--end not visible row at xs device-->
                                                            </thead>

                                                        </table>

                                                        <div  class="col-md-4 col-sm-4 col-md-offset-4 col-sm-offset-4 col-xs-12 ">

                                                            <div class="text-uppercase text-center">
                                                                <!--<br><h4 class="text-center bold pay_hed"><i class="fa fa-info-circle fa_fan">
                                                                    </i> {{share_cDetail}}# {{$index + 1}}</h4>-->
                                                                <div class="col-sm-8 text-left" style="padding-left:0px;">
                                                                    <!--<h4 class="text-left bold pay_hed" style="float:left;"><i class="fa fa-info-circle fa_fan"> </i> {{share_cDetail}}# {{$index + 1}}</h4>-->
                                                                    <h4 class="text-left bold pay_hed" style="float:left;"><i class="fa fa-info-circle fa_fan"> </i> BILLING INFO</h4>
                                                                </div>
                                                                <div class="col-sm-4 text-right" style="padding-right:0px;">
                                                                    <div class="dropdown">
                                                                        <a href="#" style="background:#88C659; color: #fff;" class="btn btn-simple btn-info dropdown-toggle text-success" data-toggle="dropdown">
                                                                            Same As
                                                                            <b class="caret"></b>
                                                                        </a>
                                                                        <ul class="dropdown-menu">
                                                                            <li ng-repeat="x in customfield"><a href="#" ng-click="sameAS($index)">{{x.name}}</a></li>

                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <form action="" ng-init="s_ipa = $index">
                                                                    <div class="form-style">
                                                                        <div>
                                                                            <label for="exampleInputEmail1"  class="pull-left text-black bold">Name</label>
                                                                            <input type="text" ng-value="customfield[s_ipa]['name']" id="customname" ng-click="customerData1('name')" ng-keyup="customerData1('name')" name="name" class="check_d1 form-control click "/> </div>
                                                                        <!--<input type="text" ng-click="customerData1(x.form_field_name)">-->
                                                                        <div>
                                                                            <label for="exampleInputEmail1" class="pull-left text-black bold">Email</label>
                                                                            <input type="emai" ng-value="customfield[s_ipa]['email']" id="customemail" ng-click="customerData1('email')" ng-keyup="customerData1('email')" name="email" class="check_d1 form-control click "/> </div>
                                                                        <div>
                                                                            <label for="exampleInputEmail1" class="pull-left text-black bold">Phone</label>
                                                                            <input type="text" ng-value="customfield[s_ipa]['phone']" id="customphone" ng-click="customerData1('phone')" ng-keyup="customerData1('phone')" name="phone" class="check_d1 form-control click "/> </div>
                                                                    </div>
                                                                </form>
                                                                <!--                                        <form action="" ng-init="s_ipa = $index">
                                                                                                            <div class="form-style" ng-repeat="x in formData">
                                                                                                                <div>
                                                                                                                    <label for="exampleInputEmail1" ng-init="pushAttenArr(s_ipa, x.form_field_name, x.form_id)" class="pull-left text-black bold">{{x.form_field_title}}</label>
                                                                                                                    <input type="{{x.form_field_type}}" ng-value="customfield[s_ipa][x.form_field_name]" id="custom{{x.form_field_name}}" ng-click="customerData1(x.form_field_name)" ng-keyup="customerData1(x.form_field_name)" class="check_d1 form-control click "/> </div>
                                                                                                                <input type="text" ng-click="customerData1(x.form_field_name)">
                                                                                                            </div>
                                                                                                        </form>-->
                                                                <!--./shear your contact details end here-->

                                                            </div>
                                                            <code id="error"></code>
                                                            <button id="step5confirm" ng-click="dynamicFormMsg()" class="btn btn-raised btn-block btn-success bold">CONTINUE</button>
                                                        </div>


                                                    </fieldset>
                                                    <!--step3 ends here-->
                                                    <!--step4 starts here-->

                                                    <fieldset id="step4" style="display: none;margin-top:8%;margin-bottom:8%">
                                                        <!--Make Payment With start here-->
                                                        <h3 class="text-uppercase text-center bold pay_hed">
                                                            Select Payment And Delivery Method
                                                        </h3>
                                                        <div id="div2" class="col-md-4 col-sm-4 col-md-offset-4 col-sm-offset-4 col-xs-12 text-center">
                                                            <div class="row text-center" ng-init="selection = {}">

<!--                                                                <select class="form-control" ng-model="p_name" id="condition" style="border: 2px solid #4CAF50; border-radius: 4px;">
                                                                    <option value="" class="text-center">------Please select payment method------</option> 
                                                                    <option ng-repeat="x in payment_method| limitTo:3" value="{{x.name}}" >{{x.name}}</option>
                                                                </select>-->
                                                                <select name="City-group" id="condition" style="border: 2px solid #4CAF50; border-radius: 4px;" class="form-control" ng-model="pm"  ng-change="selectedPM(pm.name)"
                                                                        ng-options="pm.name group by pm.group for pm in payment_method | limitTo:3">
                                                                    <option value="">------Please select payment method------</option> 
                                                                </select> 

                                                                <select ng-show="hideEvent" name="Fpm-group" id="normal" style="border: 2px solid #4CAF50; border-radius: 4px;" class="form-control" ng-model="pm"  ng-change="selectedPM(pm.name)"
                                                                        ng-options="Fpm.name group by Fpm.group for Fpm in freeEventpayment_method">
                                                                    <option value="">------Please select  payment method------</option> 
                                                                </select>
<!--                                                                <select ng-show="hideEvent"  class="form-control" ng-model="p_name" id="normal" style="border: 2px solid #4CAF50; border-radius: 4px;">
                                                                    <option value="" class="text-center">------Please select  payment method f------</option> 
                                                                    <option ng-repeat="x in freeEventpayment_method" value="{{x.name}}" >{{x.name}}</option>
                                                                </select>-->

                                                                <!-- delivery method -->

                                                                <select class="form-control" ng-show="(pm.name == 'Cash On Delivery' || pm.name == 'Online Payment' || pm.name == 'Online' || pm.name == 'Bkash Payment' || pm.name == 'Pay Online & Get E-Ticket on Your E-Mail') && d_payment_method.length != 0" ng-model="hname" style="border: 2px solid #4CAF50; border-radius: 4px;">
                                                                    <option value="" class="text-center">------Please select delivery method------</option> 
                                                                    <option ng-repeat="h in d_payment_method" value="{{h.name}}" >{{h.name}}</option>
                                                                </select>

                                                                <div class="col-md-12 panel panel-default" ng-if="hname == 'Pick UP Point'" >
                                                                    <h3 class="text-center bold pay_hed text-uppercase" ng-if="point.length > 0">
                                                                        Event Pick Point List
                                                                    </h3>
                                                                    <h3 class="text-center bold pay_hed text-uppercase" ng-if="point.length == 0">
                                                                        No Event Pick Point Found!
                                                                    </h3>
                                                                    <div ng-repeat="m in point">
                                                                        <p>
                                                                            <input ng-model="selection.modelSelected" ng-click="pickupPoint(selection.modelSelected)" type="radio" name="patient" value="{{m}}" required>{{m.name}}

                                                                        </p>
                                                                    </div> 

                                                                </div>

                                                                <div class="col-md-12 panel panel-default" ng-if="hname == 'Home Delivery'">
                                                                    <h3 class="text-center bold pay_hed">
                                                                        <i class="fa fa-map" style="color:#689f38"></i> Home Delivery Details
                                                                    </h3>
                                                                    <div>
                                                                        <style type="text/css">
                                                                            select option:empty { display:none }
                                                                        </style>
                                                                        <!--<div class="form-group label-floating success">-->
<!--                                                                        <select class="form-control" ng-model="selection.city" ng-click="wisedeliverycost()"  style="border: 2px solid #4CAF50; border-radius: 4px;">
                                                                            <option value="" class="text-center">------Please select city ------</option> 
                                                                            <option ng-repeat="x in getAllCity" value="x.city_id" >{{x.city_name}}</option>
                                                                        </select>-->
                                                                        <div class="form-group label-floating success">
                                                                            <label class="control-label pull-left">Select City</label>
                                                                            <select name="City-group" id="CityGroup" class="form-control" ng-model="City" ng-change="citywisecost(City.city_name, City.city_id, '<?php echo $_GET['id']; ?>')"
                                                                                    ng-options="City.city_name group by City.group for City in getAllCity">
                                                                                <option value=""> Select City </option> <option value=""> Select City </option>
                                                                            </select>
                                                                        </div>
                                                                        <!--                                                </div>
                                                                                                                        <div class="form-group label-floating success">-->
<!--                                                                        <select class="form-control" ng-model="country" ng-init="selection = 16" style="border: 2px solid #4CAF50; border-radius: 4px;">
                                                                            <option value="" class="text-center">------Please select country ------</option> 
                                                                            <option ng-repeat="country in getAllCountry" value="{{country.country_id}}" >{{country.country_name}}</option>
                                                                        </select>-->
                                                                        <div class="form-group label-floating success">
                                                                            <label class="control-label pull-left">Select Country</label>
                                                                            <select name="country-group" id="countryGroup" class="form-control" ng-model="country" ng-change="pickupCountry(country.country_name, country.country_id)" 
                                                                                    ng-options="country.country_name group by country.group for country in getAllCountry">
                                                                                <option value=""> Select Country </option>
                                                                            </select>
                                                                        </div>
                                                                        <!--</div>-->
                                                                        <div class="form-group label-floating success">
                                                                            <label class="control-label pull-left">Address</label>
                                                                            <textarea class="form-control" ng-model="msg" ng-keyup="pickupAdd(msg)"  rows="3"></textarea>

                                                                        </div><br>

                                                                    </div>

                                                                </div>

                                                                <!--./Make Payment With end here-->
                                                                <button id="step4confirm" ng-click="buyInclude(tckFree, tck, tck_inc, city, country, add, '<?php echo $_GET['id']; ?>')"  class="condition btn btn-raised btn-success bold payment_btn">CONTINUE</button>

                                                                <button id="step4confirm" ng-show="hideEvent" ng-click="buyInclude(tckFree, tck, tck_inc, city, country, add, '<?php echo $_GET['id']; ?>')"  class="normal btn btn-raised btn-success bold payment_btn">CONTINUE</button>
                                                                <!--{{tck}}
                                                                {{tck_inc}}-->
                                                                </fieldset>
                                                                <div class="clearfix"></div>
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
                                                                                                                            <!--<div ng-init="dynamicForm('<?php //echo $_GET['id'];                 ?>')"></div>-->
                                                            <div ng-init="eventwisepaymentmethod('<?php echo $_GET['id']; ?>')"></div>
                                                            <div ng-init="eventwiseDeliverymethod('<?php echo $_GET['id']; ?>')"></div>
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
                                                        <div id="bookticket-float" class="container-fluid bookticket-widget navbar-fixed-bottom visible-xs" stylse="border-radius: 0px;">
                                                            <div class="row" style="overflow: hidden;">
                                                                <div class="col-xs-12">
                                                                    <button class="btn btn-raised btn-danger btn-block bold bookticket">{{details[0].button_lebel}}</button>
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

<!--            <script type="text/javascript">
                $(document).ready(function () {
                    $('.bookticket').click(function () {
                        window.scrollTo(0, 0);
                        $('#checkout_top_banner').hide();
                        $('#bookticket-float').addClass("invisible");
                        $('#step1').hide();
                        $('#step3').hide();
                        $('#step4').hide();
                        $('#step5').hide();
                        $('#step2').show();
                    });
                    $('#step2confirm').click(function () {
                        window.scrollTo(0, 0);
                        $('#checkout_top_banner').hide();
                        $('#step1').hide();
                       $('#step5').hide();
                        $('#step4').hide();
                        //$('#step3').show();
                        var q = $("#qnty").html();
                        // alert(q);
                        if (q > 0) {
                            $('#step2').hide();
                            $('#step3').show();

                        } else {
                            $('#step2').show();
                            $('#step3').hide();
                        }
                    });
                    $('#step3confirm').click(function () {
                        window.scrollTo(0, 0);
                        $('#checkout_top_banner').hide();
                        $('#step1').hide();
                        $('#step2').hide();
                        $('#step5').hide();
                        if ($(".check_d").val().length == 0) {
//                            document.getElementById("error").innerHTML = "Please fill-up the form!";
//
//                            setTimeout(function (a) {
//                                $('#error').hide(1000);
//                            }, 10000);
                        } else {
                            $('#step3').hide();
                            $('#step4').show();
                        }

                    });
                    $('#step5confirm').click(function () {
                        window.scrollTo(0, 0);
                        $('#checkout_top_banner').hide();
                        $('#step1').hide();
                        $('#step2').hide();
                        $('#step3').hide();
                        $('#step5').hide();
                        $('#step4').show();

                    });
                    $('#backDefault').click(function () {
                        $('#checkout_top_banner').show();
                        $('#step1').show();
                        $('#step2').hide();
                        $('#step4').hide();
                        $('#step3').hide();

                    });
                    $('#backDefault1').click(function () {
                        $('#checkout_top_banner').show();
                        $('#step1').hide();
                        $('#step2').show();
                        $('#step4').hide();
                        $('#step3').hide();

                    });
            $('#backDefault2').click(function () {
                        $('#checkout_top_banner').show();
                        $('#step1').hide();
                        $('#step2').hide();
                        $('#step4').hide();
                        $('#step3').show();

                    });
                    $('#info-arrow').click(function () {
                        $('#infotr').slideToggle();
                    });

//        

                });
            </script>-->

                                                        <script type="text/javascript">
                                                            $(document).ready(function () {
//                                                                $('.bookticket').click(function () {
//                                                                    window.scrollTo(0, 0);
//                                                                    $('#checkout_top_banner').hide();
//                                                                    $('#bookticket-float').addClass("invisible");
//                                                                    $('#step1').hide();
//                                                                    $('#step3').hide();
//                                                                    $('#step4').hide();
//                                                                    $('#step5').hide();
//                                                                    $('#step2').show();
//                                                                });
//                                                                $('#step2confirm').click(function () {
//                                                                    window.scrollTo(0, 0);
//                                                                    $('#checkout_top_banner').hide();
//                                                                    $('#step1').hide();
//                                                                    $('#step5').hide();
//                                                                    $('#step4').hide();
//                                                                    //$('#step3').show();
//                                                                    var q = $("#qnty").html();
//                                                                    // alert(q);
//                                                                    if (q > 0) {
//                                                                        $('#step2').hide();
//                                                                        $('#step3').show();
//
//                                                                    } else {
//                                                                        $('#step2').show();
//                                                                        $('#step3').hide();
//                                                                    }
//                                                                });
//                                                                $('#step3confirm').click(function () {
//                                                                    window.scrollTo(0, 0);
//                                                                    $('#checkout_top_banner').hide();
//                                                                    $('#step1').hide();
//                                                                    $('#step2').hide();
//
//                                                                    if ($(".check_d").val().length == 0) {
//                                                                        $('#step5').hide();
//                                                                    } else {
//                                                                        $('#step3').hide();
//                                                                        $('#step4').hide();
//                                                                        $('#step5').show();
//                                                                    }
//
//                                                                });
//                                                                $('#step5confirm').click(function () {
//                                                                    window.scrollTo(0, 0);
//                                                                    $('#checkout_top_banner').hide();
//                                                                    $('#step1').hide();
//                                                                    $('#step2').hide();
//                                                                    $('#step3').hide();
//
//                                                                    if ($(".check_d1").val().length == 0) {
//                                                                        //$('#step5').show();
//                                                                    } else {
//                                                                        $('#step4').show();
//                                                                        $('#step5').hide();
//                                                                    }
//
//
//                                                                });
//                                                                $('#backDefault').click(function () {
//                                                                    $('#checkout_top_banner').show();
//                                                                    $('#step1').show();
//                                                                    $('#step2').hide();
//                                                                    $('#step4').hide();
//                                                                    $('#step3').hide();
//                                                                    $('#step5').hide();
//
//                                                                });
//                                                                $('#backDefault1').click(function () {
//                                                                    $('#checkout_top_banner').show();
//                                                                    $('#step1').hide();
//                                                                    $('#step2').show();
//                                                                    $('#step4').hide();
//                                                                    $('#step3').hide();
//                                                                    $('#step5').hide();
//                                                                });
//                                                                $('#backDefault2').click(function () {
//                                                                    $('#checkout_top_banner').show();
//                                                                    $('#step1').hide();
//                                                                    $('#step2').hide();
//                                                                    $('#step4').hide();
//                                                                    $('#step3').show();
//                                                                    $('#step5').hide();
//
//                                                                });
                                                                //                    $('#info-arrow').click(function () {
                                                                //                        $('#infotr').slideToggle();
                                                                //                    });
                                                                //                    $('.info-arrow2').click(function () {
                                                                //                        $('.infotr2').slideToggle();
                                                                //                    });
                                                                //                    $('.info-arrow3').click(function () {
                                                                //                        $('.infotr3').slideToggle();
                                                                //                    });

                                                                //        
                                                                $('#smbackDefault').click(function () {

                                                                    $('#checkout_top_banner').show();
                                                                    $('#step1').show();
                                                                    $('#step2').hide();
                                                                    $('#step4').hide();
                                                                    $('#step3').hide();
                                                                    $('#step5').hide();

                                                                });
                                                                $('#smbackDefault1').click(function () {

                                                                    $('#checkout_top_banner').show();
                                                                    $('#step1').hide();
                                                                    $('#step2').show();
                                                                    $('#step4').hide();
                                                                    $('#step3').hide();
                                                                    $('#step5').hide();
                                                                });
                                                                $('#smbackDefault2').click(function () {

                                                                    $('#checkout_top_banner').show();
                                                                    $('#step1').hide();
                                                                    $('#step2').hide();
                                                                    $('#step4').hide();
                                                                    $('#step3').show();
                                                                    $('#step5').hide();

                                                                });
                                                            });
                                                        </script>
                                                        <script src="angularJs/facebook.js"></script>
                                                        <script src="angularJs/twitter.js"></script>
                                                        <script src="angularJs/sharedirective.js"></script>
                                                        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-sanitize.js"></script>
                                                        <script src='http://cdnjs.cloudflare.com/ajax/libs/textAngular/1.1.2/textAngular.min.js'></script>



                                                        </body>

                                                        </html>