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

            @media only screen and (max-width: 760px),
            (min-device-width: 768px) and (max-device-width: 1024px) {
                /* Force table to not be like tables anymore */
                #table,
                #thead,
                #tbody,
                #th,
                #td,
                #tr {
                    display: block;
                }
                /* Hide table headers (but not display: none;, for accessibility) */
                #thead tr {
                    position: absolute;
                    top: -9999px;
                    left: -9999px;
                }
                #tr {
                    border: 1px solid #ccc;
                }
                #td {
                    /* Behave  like a "row" */
                    border: none;
                    border-bottom: 1px solid #eee;
                    position: relative;
                    padding-left: 43%;
                }
                #td:before {
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
        <?php echo $cms->FbSocialScript(); ?>
        <?php include 'include/navbar.php'; ?>
        <!-- Navbar -->
        <div class="wrapper">
            <!-- main content part starts here -->
            <div class="main" style="background-color: transparent; margin-top:80px;">
                <!-- Carousel Starts Here -->
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-top-30">
                            <!-- check still image start here -->
                            <div class="carousel-inner" role="listbox">
                                <div class="item active text-center"> <img ng-src="upload/event_web_banner/{{details[0].event_web_banner}}" alt="image loading problem" class="img-fluid img-responsive carousel-img-bd" style="width:100%; max-height: 400px;">
                                    <!--                                    <div class="carousel-caption">
                                                                    ...
                                                                </div>--></div>
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
                    <div class="container">
                        <div class="row padd_btm_30">
                            <div class="col-lg-12 col-md-12 col-xs-12"> <img style="width:100% !important; max-height:400px;" src="assets/img/bg2.jpeg" alt="" class="img-rounded img-responsive"> </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12" id="event_tickets">
                                <ul class="tab" id="event_tab">
                                    <li ng-hide="none"><a href="#Tickets" class="tablinks l1 active"><i class="fa fa-ticket"></i> {{tab_one}}</a></li>
                                    <li><a href="#About" class="tablinks l2"><i class="fa fa-info-circle"></i> {{tab_two}} </a></li>
                                    <li><a href="#Venue" class="tablinks l3"><i class="fa fa-location-arrow"></i> {{tab_three}}</a></li>
                                    <li><a href="#Gallery" class="tablink l4"><i class="fa fa-camera"></i> {{tab_four}}</a></li>
                                    <li><a href="#T_C" class="tablinks l5"><i class="fa fa-user-secret"></i> {{tab_fives}}</a></li>
                                </ul>
                                <div class=" terms_con" id="Tickets">
                                    <!--tickets first tab here start -->
                                    <div class="row">
                                        <!--tab row start-->
                                        <div class="col-md-12">
                                            <div class="col-md-12">
                                                <div class="col-lg-8 col-md-8 col-sm-8 col-lg-12" ng-hide="none">
                                                    <h3 class="text-left event_tickets_h3 h3-responsive">{{details[0].event_title}} 
                                                        <a href="" ng-click="addToWishlist(details[0].event_id, 'event')"><span class="btn btn-event_l"><i class="fa fa-heart" style="font-size: 20px; padding: 6px; color:#88C659; border:1px solid #88C659;" title="Add to wishlist" aria-hidden="true"></i></span></a>

                                                    </h3>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hidden-xs" ng-hide="none">
                                                        <a ng-repeat="tag in tags"href="javascript:void(0)"><span class="label label-info"><i class="fa fa-cubes" aria-hidden="true"></i>
                                                                {{tag}}</span>
                                                        </a>

                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-lg-12 hidden-xs" ng-hide="none"> <img class="img-rounded img-responsive" src="upload/event_web_logo/{{details[0].event_web_logo}}" alt="img" style="width: 100%; max-height: 150px; margin-top: 15px;"> </div>
                                                <!--./tickets details here end -->
                                                <!-- tickets border1 tab here  end -->
                                                <div class="col-md-12 col-sm-12 col-xs-12 mar hidden-xs hidden-xm"></div>
                                                <!--./tickets border1 tab here  end -->
                                            </div>
                                            <!--Time date div start here-->
                                            <div class="col-md-12">
                                                <div class="col-md-6 col-sm-12 col-xs-12 dropdown hidden-xs addToCalender text-center hidden-xm hidden-xs"> <span class="addtocalendar atc-style-blue" details-calendars="iCalendar,
                                                                                                                                                                  Google Calendar,
                                                                                                                                                                  Outlook,
                                                                                                                                                                  Outlook Online,
                                                                                                                                                                  Yahoo! Calendar" details-secure="auto">
                                                        <a details-toggle="dropdown" class="atcb-link">
                                                            <button type="button" class="btn btn-md btn-success-outline waves-effect"><i class="fa fa-arrow-circle-o-down" aria-hidden="true">&nbsp;</i> {{btn_calender}}
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
                                                <div class="col-md-5 dropdown hidden-xs addToCalender" ng-hide="hide">
                                                    <a href="map1.php?venue={{details[0].venue_geo_location}}" target="_new"> <span class="btn btn-md btn-success-outline waves-effect"><i class="fa fa-map-marker" ></i> GET DIRECTION</span> </a>
                                                </div>
                                                <!--./Time date div start here-->
                                                <!-- tickets border2 tab here  end -->
                                                <div class="col-md-12 col-sm-12 col-xs-12 mar margin-top-15 hidden-xm hidden-xs "></div>
                                                <!--./tickets border2 tab here  end -->
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12 table-responsive margin-top-15" ng-hide="none">
                                                <div class="text-uppercase text-center" ng-hide="hideEvent" ng-hide="eventTicketTypeTicket.length == 0">
                                                    <h3 class="text-center bold pay_hed">
                                                        <i class="fa fa-shopping-cart fa_fan">
                                                        </i> {{panel_h1}}</h3>
                                                    <table id="table">
                                                        <thead id="thead">
                                                            <tr id="tr">
                                                                <th>{{tbl_h1}}</th>
                                                                <th>{{tbl_h2}}</th>
                                                                <th>Price</th>
                                                                <th>Total Price</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="tbody">
                                                            <tr id="tr" ng-repeat="x in eventTicketTypeTicket">
                                                                <td id="td" ng-init="tckpass()">
                                                                    <p id="cart_Left_Table_p">{{x.TT_type_title}}</p>
                                                                </td>
                                                                <td class="sprinoff" id="td" ng-model="tck[$index].ticket_id = x.TT_id">
                                                                    <div class="input-group"> <span ng-click="count = (count == 0 ? count = 0 : count - 1)" ng-init="count = 0" class="input-group-addon" style="font-size: 30px; font-weight: bolder;">-</span>
                                                                        <input style="height: 50px; margin-top: -1px; font-size: 18px; font-weight: bolder;" type="text" value="{{count}}" ng-model="tck[$index].quantity = count" ng-init="Initqval()" class="form-control tqv"> <span ng-click="count = (count == x.TT_per_user_limit ? count = x.TT_per_user_limit : count + 1)" ng-init="count = 0" class="input-group-addon " style="font-size: 30px; font-weight: bolder;">+</span> </div>
                                                                </td>
                                                                <td class="td" id="td">
                                                                    <p ng-model="tck[$index].price = x.price" style="font-size: 18px; font-weight: bolder; line-height: 50px;">{{x.price}}</p>
                                                                </td>
                                                                <td id="td" width="30%">
                                                                    <p ng-model="tck[$index].total_price" style="font-size: 18px; font-weight: bolder; line-height: 50px;" id="cart_Left_Table_p">{{x.price * count}}</p>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!--<button type="button" ng-click="buyTicket(tck)">Check</button>-->
                                                <div class="text-uppercase text-center" ng-if="hideEvent">
                                                    <h3 class="text-center bold pay_hed">
                                                        <i class="fa fa-shopping-cart fa_fan">
                                                        </i>FREE {{panel_h1}}</h3>
                                                    <table id="table">
                                                        <thead id="thead">
                                                            <tr id="tr">
                                                                <th>{{tbl_h1}}</th>
                                                                <th>{{tbl_h2}}</th>
                                                                <!--                                                                <th>Price</th>
                                                        <th>Total Price</th>-->
                                                            </tr>
                                                        </thead>
                                                        <tbody id="tbody">
                                                            <tr id="tr" ng-repeat="x in eventTicketTypeTicket">
                                                                <td id="td" ng-init="tck()">
                                                                    <p id="cart_Left_Table_p">{{x.TT_type_title}}</p>
                                                                </td>
                                                                <td class="sprinoff" id="td" ng-model="tck[$index].ticket_id = x.TT_id">
                                                                    <div class="input-group"> <span ng-click="count = (count == 0 ? count = 0 : count - 1)" ng-init="count = 0" class="input-group-addon" style="font-size: 30px; font-weight: bolder;">-</span>
                                                                        <input style="height: 50px; margin-top: -1px; font-size: 18px; font-weight: bolder;" type="text" value="{{count}}" ng-model="tck[$index].quantity = count" ng-init="Initqval()" class="form-control tqv"> <span ng-click="count = (count == x.TT_per_user_limit ? count = x.TT_per_user_limit : count + 1)" ng-init="count = 0" class="input-group-addon " style="font-size: 30px; font-weight: bolder;">+</span> </div>
                                                                </td>
                                                                <!--                                                                <td class="td"  id="td">
                                                            <p ng-model="tck[$index].price = x.price" style="font-size: 18px; font-weight: bolder; line-height: 50px;">{{x.price}}</p>
                                                        </td>
                                                        <td  id="td" width="30%">
                                                            <p ng-model="tck[$index].total_price" style="font-size: 18px; font-weight: bolder; line-height: 50px;" id="cart_Left_Table_p">{{x.price * count}}</p>
                                                        </td>-->
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="event_table" ng-hide="eventTicketTypeInclude.length == 0">
                                                    <h3 class="text-center bold pay_hed">
                                                        <i class="fa fa-shopping-cart fa_fan ">
                                                        </i>  {{panel_h2}}</h3>
                                                    <table id="table">
                                                        <thead id="thead">
                                                            <tr id="tr">
                                                                <th>{{tbl_h1}}</th>
                                                                <th>{{tbl_h2}}</th>
                                                                <th>Price</th>
                                                                <th>Total Price</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="tbody">
                                                            <tr id="tr" ng-repeat="x in eventTicketTypeInclude">
                                                                <td id="td" ng-init="tckpass_inc()">
                                                                    <p id="cart_Left_Table_p">{{x.TT_type_title}}</p>
                                                                </td>
                                                                <td class="sprinoff" id="td" ng-model="tck_inc[$index].ticket_id = x.TT_id">
                                                                    <div class="input-group"> <span ng-click="count = (count == 0 ? count = 0 : count - 1)" ng-init="count = 0" class="input-group-addon" style="font-size: 30px; font-weight: bolder;">-</span>
                                                                        <input style="height: 50px; margin-top: -1px; font-size: 18px; font-weight: bolder;" type="text" value="{{count}}" ng-model="tck_inc[$index].quantity = count" ng-init="Initqval()" class="form-control tqv"> <span ng-click="count = (count == x.TT_per_user_limit ? count = x.TT_per_user_limit : count + 1)" ng-init="count = 0" class="input-group-addon " style="font-size: 30px; font-weight: bolder;">+</span> </div>
                                                                </td>
                                                                <td class="td" id="td">
                                                                    <p ng-model="tck_inc[$index].price = x.price" style="font-size: 18px; font-weight: bolder; line-height: 50px;">{{x.price}}</p>
                                                                </td>
                                                                <td id="td" width="30%">
                                                                    <p ng-model="tck_inc[$index].total_price" style="font-size: 18px; font-weight: bolder; line-height: 50px;" id="cart_Left_Table_p">{{x.price * count}}</p>
                                                                </td>
                                                                <!--                                                                <td class="td"  id="td">
                                                             type, eventID, venueID, itemID 
                                                            <button id="by_ticket" class="btn btn-success-outline" ng-click="addTocart('include', <?php echo $_GET['id']; ?>, x.TT_venue_id, x.TT_id, count)"> <i class="fa fa-cart-plus" aria-hidden="true">&nbsp;</i>By Tickets </button>
                                                        </td>-->
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!--./table end-->
                                                <!-- tickets border5 tab here  start -->
                                                <div class="col-md-12 col-sm-12 col-xs-12 mar"></div>
                                                <br>
                                                <br>
                                                <!--./tickets border5 tab here  end -->
                                                <!--shear your contact details start here-->
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-xs-12 ">
                                                        <div class="text-uppercase text-center">
                                                            <h3 class="text-center bold pay_hed"><i class="fa fa-info-circle fa_fan">
                                                                </i> {{share_cDetail}}</h3>
                                                            <form action="" ng-model="dd">
                                                                <div class="form-style" ng-repeat="x in formData">
                                                                    <div>
                                                                        <label for="exampleInputEmail1" class="pull-left text-black bold">{{x.form_field_title}}</label>
                                                                        <input type="{{x.form_field_type}}" id="custom{{x.form_field_name}}" ng-keyup="customfieldpush(x.form_field_name)" class="form-control" /> </div>
                                                                </div>
                                                            </form>
                                                            <!--                                                            
                                               
                                                            <!--./shear your contact details end here-->
                                                        </div>
                                                    </div>
                                                    <!--./row  2nd end-->
                                                    <!---->
                                                    <!--Make Payment With start here-->

                                                    <div id="div2" class="col-md-12 col-sm-12 col-xs-12 ">
                                                        <h3 class="text-center bold pay_hed">
                                                            <i class="fa fa-money fa_fan">

                                                            </i> {{payment_text}} 
                                                        </h3>
                                                        <div class="row text-center">
                                                            <!--<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                        <a href="javascript:void(0)" ng-click="addAddress(UA);
                                                                    verifyPayment(1)" class="btn btn-success btn-raised  payment_btn pament_button1" ><i class="fa fa-credit-card pament-icon"></i> {{btn_payment1}}</a>
                                                    </div>

                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                        <a id="cash_on_del_buton" href="javascript:void(0)"  class="btn btn-primary btn-raised  payment_btn pament_button2"><i class="fa fa-exchange  pament-icon"></i> {{btn_payment2}}</a>
                                                    </div>

                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                        <a href="javascript:void(0)" ng-click="addAddress(UA);
                                                                    verifyPayment(3)" class="btn btn-info btn-raised  payment_btn pament_button3"><i class="fa fa-mobile  pament-icon"></i> {{btn_payment3}}</a>
                                                    </div>-->
                                                            <div id="condition">
                                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" ng-repeat="x in payment_method"> <a href="javascript:void(0)" ng-click="buyInclude(x.name)" class="{{x.pm_btn}} btn-raised  payment_btn pament_button3"><i class="{{x.pm_icon}}"></i> {{x.name}}</a> </div>
                                                            </div>
                                                            <di id="normal" ng-show="hideEvent" class="col-lg-4 col-md-4 col-md-offset-4 col-sm-4 col-xs-12" ng-repeat="x in freeEventpayment_method"> <a href="javascript:void(0)" ng-click="buyFreeTicket(x.name)" class="{{x.pm_btn}} btn-raised  payment_btn pament_button3"><i class="{{x.pm_icon}}"></i> {{x.name}}</a> </div> 

                                                           <div class="col-md-12 panel panel-default" ng-show="point.length>0">
                                                            <h3 class="text-center bold pay_hed">
                                                                <i class="fa fa-map" style="color:#689f38"></i> Event Pick Point List
                                                            </h3>
                                                            <div ng-repeat="m in point" >
                                                                
                                                                <hpp><b>Point Name: {{m.name}}</b></p>
                                                                <p><b>Point Address: {{m.address}}</b></p>
                                                                <p><b>Point Details: {{m.point_details}}</b></p>
                                                            </div>
                                                        </div>

                                                        <img src="<?php echo $cms->baseUrl(" assets/img/pay3.png "); ?>" alt="Payment GateWays" class="img-responsive pay_img text-center" /> </div>
                                                    <!--./Make Payment With end here-->

                                                </div>
                                                <!--./row  2nd end-->
                                            </div>
                                            <!--./tickets first tab here  end -->



                                        </div>
                                        <!--./tab content end-->

                                    </div>
                                    <!--frist tab content end-->
                                    <div id="About">
                                        <div class="panel panel-default">
                                            <div class="panel-heading terms_con">
                                                <h4 class="text-left bold"> About Event</h4> </div>
                                            <div class="panel-body">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center" id="">
                                                    <p>{{details[0].event_description}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- row end-->
                                    </div>
                                    <!--secound tab content end-->
                                    <div id="Venue">
                                        <div class="panel panel-default">
                                            <div class="panel-heading terms_con">
                                                <h3>{{details[0].venue_address}}</h3> </div>
                                            <div class="panel-body" id="Venue">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="">
                                                    <map id="map_canvas"></map>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--third tab content end-->
                                    <div id="Gallery">
                                        <div class="panel panel-default">
                                            <div class="panel-heading terms_con">
                                                <h4 class="text-left bold">Photo Gallery</h4> </div>
                                            <div class="panel-body">
                                                <section>
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" ng-repeat="img in details">
                                                        <a class="example-image-link" href="http://lokeshdhakar.com/projects/lightbox2/images/image-3.jpg" data-lightbox="example-set" data-title="{{img.IG_title}}"> <img class="img-responsive img-thumbnail" src="http://lokeshdhakar.com/projects/lightbox2/images/thumb-3.jpg" alt="" /> </a>
                                                    </div>
                                                </section>
                                            </div>
                                            <div class="panel-heading terms_con">
                                                <h4 class="text-left bold">Video Gallery</h4> </div>
                                            <div class="panel-body">
                                                <embed src="http://www.youtube.com/v/FtHKu7zW_zQ"> </div>
                                        </div>
                                    </div>
                                    <!-- fourth  tab content end-->
                                    <div id="T_C">
                                        <div class="panel panel-default">
                                            <div class="panel-heading terms_con">
                                                <h4 class="text-left bold">Terms &amp; Conditions</h4> </div>
                                            <div class="panel-body">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                                    <p>{{details[0].event_terms_conditions}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- row end-->
                                    </div>
                                    <!-- fifth  tab content end-->
                                    <!--./tab bar end here-->

                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="">
                                <div class="panel panel-default ">
                                    <div class="panel-body ">
                                        <h4>{{promotion}}</h4> </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 mini-cart-1">
                                <div class="pnp_hd">
                                    <div class="panel panel-default ">
                                        <!--tickets detail start here-->
                                        <div class="panel-heading hed_pen">
                                            <h3 class="panel-title bold"> Ticket Detail</h3> </div>
                                        <div class="panel-body pb_body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tr>
                                                        <td>Total Ticket Quantity</td>
                                                        <td class="text-right">{{totalQuantity + 0}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total Ticket Price</td>
                                                        <td class="text-right">TK. {{totalPrice() | currency}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total Discount</td>
                                                        <td class="text-right">TK. {{totalDiscount| currency}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total Payable Amount</td>
                                                        <td class="text-right">TK. {{totalPrice() - totalDiscount | currency}}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!--./tickets detail end here-->
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
        < script> new WOW().init();</script>
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
</body>

</html>