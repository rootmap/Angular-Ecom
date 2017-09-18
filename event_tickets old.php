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
        echo $cms->pageTitle("event_tickets | Ticket Chai");
    ?>

            <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

            <?php
        echo $cms->headCss(array("eventTickets"));
    ?>
   <!--<![endif]-->
   <style type="text/css">
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
        Label the data
        */
            #td:nth-of-type(1):before {
                content: "TICKETS";
                color: #000;
                margin-top: 10px;
            }
            #td:nth-of-type(2):before {
                content: "Quantity";
                color: #000;
            }
            #td:nth-of-type(3):before {
                content: "Unit price";
                color: #000;
            }
            #td:nth-of-type(4):before {
                content: "total price";
                color: #000;
            }
        }
   </style>
    </head>

    <body class="index-page signin" ng-app="frontEnd" ng-controller="event_ticketsController">
        
        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->
        
        <?php echo $cms->FbSocialScript(); ?>
            <?php include 'include/navbar.php';?>



                <div class="wrapper">
                    <!-- main content part starts here -->
                    <div class="main" style="background-color: transparent; margin-top:80px;">
                        <!-- Customers LogIn section starts here -->
                        <div class="section-simple2">
                            <!-- Top image field start here -->
                            <div class="container">
                                <div class="row padd_btm_30">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <img style="width:100% !important; max-height:400px;" src="<?php echo $cms->baseUrl('assets/img/bg2.jpeg'); ?>" alt="" class="img-rounded img-responsive">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12" id="event_tickets">
                                        <ul class="tab" id="event_tab">
                                            <li><a href="#" class="tablinks l1 active" onclick="eventTickets(event, 'Tickets')"><i class="fa fa-ticket"></i> {{tab_one}}</a></li>
                                            <li><a href="#" class="tablinks l2" onclick="eventTickets(event, 'About')"><i class="fa fa-info-circle"></i> {{tab_two}}</a></li>
                                            <li><a href="#" class="tablinks l3" onclick="eventTickets(event, 'Venue')"><i class="fa fa-location-arrow"></i> {{tab_three}}</a></li>
                                            <li><a href="#" class="tablinksm l4" onclick="eventTickets(event, 'Gallery')"><i class="fa fa-camera"></i> {{tab_four}}</a></li>
                                            <li><a href="#" class="tablinks l5" onclick="eventTickets(event, 'T&C')"><i class="fa fa-user-secret"></i> {{tab5}}</a></li>

                                        </ul>

                                        <div id="Tickets" class="tabcontent" style="display:block;">
                                            <div id="" class="row">
                                                <div class="col-lg-8 col-md-8 col-sm-8 col-lg-12">
                                                    <h3 class="text-left event_tickets_h3 h3-responsive">{{checkout_heading}} 
                                            <span class="btn btn-event_l"><i class="fa fa-heart" style="font-size: 20px; padding: 6px; color:#88C659; border:1px solid #88C659;" aria-hidden="true"></i></span>
                                        </h3>

                                                    <div class="col-md-5 dropdown hidden-xs">

                                                        <a data-toggle="dropdown">
                                                            <button type="button" class="btn btn-success-outline btn-size waves-effect"><i class="fa fa-arrow-circle-o-down" aria-hidden="true">&nbsp;</i> {{btn_calender}}
                                                            </button>
                                                        </a>

                                                       

                                                        <ul class="dropdown-menu eve_tic_d_menu_ul" data-toggle="dropdown">
                                                            <li class="eve_tic_d_menu_ul_li"><a class="eve_tic_d_menu_ul_li_a" href="#">{{c_li1}}</a></li>
                                                            <li><a class="eve_tic_d_menu_ul_li_a" href="#">{{c_li2}}</a></li>
                                                            <li><a class="eve_tic_d_menu_ul_li_a" href="#">{{c_li3}}</a></li>
                                                            <li class="divider"></li>
                                                            <li><a class="eve_tic_d_menu_ul_li_a" href="#">{{c_li4}}</a></li>
                                                            <li class="divider"></li>
                                                            <li><a class="eve_tic_d_menu_ul_li_a" href="#">{{c_li5}}</a></li>
                                                        </ul>

                                                    </div>
                                                </div>

                                                <div class="col-lg-4 col-md-4 col-sm-4 col-lg-12 hidden-xs">
                                                    <img class="img-rounded img-responsive" src="<?php echo $cms->baseUrl('assets/img/ts_step_01.png'); ?>" alt="img">
                                                </div>

                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hidden-xs">
                                                    <h4 class="event_tickets_h4_Rom"><i class="fa fa-calendar-check-o" id='txtDate' aria-hidden="true" style="font-size: 20px; padding: 6px; color:#88C659; border:1px solid #88C659;"></i>
                                        From Thursday, 3rd September 2015 01:00 PM - Sunday, 2nd October 2016 06:00 AM</h4>
                                                </div>

                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hidden-xs">
                                                    <a href="#"><span class="label label-info"><i class="fa fa-cubes" aria-hidden="true"></i>
                                            {{lebel_consert}}</span>
                                        </a>

                                                    <a href="#">
                                                        <span class="label label-primary">
                                                <i class="fa fa-music" aria-hidden="true">&nbsp;</i> {{lebel_music}}
                                            </span>
                                                    </a>
                                                </div>

                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="panel my_panel">
                                                        <div class="panel_heading_set">
                                                            <h4 class="panel_heading h4-responsive">2nd October 2016 06:00 AM @ djflksadjflksdjflk</h4>
                                                        </div>
                                                        <div class="panel-body">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <h4> {{panel_h1}}</h4>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive" id="event_table">
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
                                                                        <tr>
                                                                            <td>
                                                                                <p id="cart_Left_Table_p">Silver</p>
                                                                            </td>


                                                                            <td class="sprinoff">
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon minus">-</span>
                                                                                    <input type="text" value="0" class="form-control">
                                                                                    <span class="input-group-addon plus">+</span>
                                                                                </div>
                                                                            </td>


                                                                            <td>
                                                                                <p id="cart_Left_Table_p">৳ 100.00 </p>
                                                                            </td>
                                                                            <td class="td">
                                                                                <button id="by_ticket" class="btn btn-success-outline">
                                                                                    <i class="fa fa-cart-plus" aria-hidden="true">&nbsp;</i>By Tickets
                                                                                </button>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <p id="cart_Left_Table_p">Silver</p>
                                                                            </td>


                                                                            <td class="sprinoff">
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon minus">-</span>
                                                                                    <input type="text" value="0" class="form-control">
                                                                                    <span class="input-group-addon plus">+</span>
                                                                                </div>
                                                                            </td>


                                                                            <td>
                                                                                <p id="cart_Left_Table_p">৳ 100.00 </p>
                                                                            </td>
                                                                            <td class="td">
                                                                                <button id="by_ticket" class="btn btn-success-outline">
                                                                                    <i class="fa fa-cart-plus" aria-hidden="true">&nbsp;</i>By Tickets
                                                                                </button>
                                                                            </td>
                                                                        </tr>

                                                                    </tbody>
                                                                </table>
                                                            </div>


                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <h4> {{panel_h2}}</h4>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  table-responsive" id="event_table">
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
                                                                        <tr>
                                                                            <td>
                                                                                <p id="cart_Left_Table_p">Silver</p>
                                                                            </td>


                                                                            <td class="sprinoff">
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon minus">-</span>
                                                                                    <input type="text" value="0" class="form-control">
                                                                                    <span class="input-group-addon plus">+</span>
                                                                                </div>
                                                                            </td>


                                                                            <td>
                                                                                <p id="cart_Left_Table_p">৳ 100.00 </p>
                                                                            </td>
                                                                            <td class="td">
                                                                                <button id="by_ticket" class="btn btn-success-outline">
                                                                                    <i class="fa fa-cart-plus" aria-hidden="true">&nbsp;</i>By Tickets
                                                                                </button>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <p id="cart_Left_Table_p">Silver</p>
                                                                            </td>


                                                                            <td class="sprinoff">
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon minus">-</span>
                                                                                    <input type="text" value="0" class="form-control">
                                                                                    <span class="input-group-addon plus">+</span>
                                                                                </div>
                                                                            </td>


                                                                            <td>
                                                                                <p id="cart_Left_Table_p">৳ 100.00 </p>
                                                                            </td>
                                                                            <td class="td">
                                                                                <button id="by_ticket" class="btn btn-success-outline">
                                                                                    <i class="fa fa-cart-plus" aria-hidden="true">&nbsp;</i>By Tickets
                                                                                </button>
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

                                        <div id="About" class="tabcontent">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="">
                                                    <p>About Event</p>
                                                </div>
                                            </div>
                                            <!-- row end-->
                                        </div>
                                        <!--secound tab content end-->

                                        <div id="Venue" class="tabcontent">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="">
                                                    <h3>Venue</h3>
                                                    <section>
                                                        <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d912.9906364251227!2d90.40331199999999!3d23.748714999999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjPCsDQ0JzU1LjQiTiA5MMKwMjQnMTEuOSJF!5e0!3m2!1sbn!2sbd!4v1413197027945" id="" width="800" height="600" frameborder="0" style="border:0"></iframe>
                                                    </section>
                                                </div>
                                            </div>
                                            <!-- row end-->
                                        </div>
                                        <!--third tab content end-->

                                        <div id="Gallery" class="tabcontent">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center" id="">
                                                    <h3>Photo Gellary</h3>
                                                    <h4>Vedio  Gellary</h4>
                                                </div>
                                            </div>
                                            <!-- row end-->
                                        </div>
                                        <!-- fourth  tab content end-->

                                        <div id="T\&C" class="tabcontent">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center" id="">
                                                    <p>Terms & Conditions</p>
                                                </div>
                                            </div>
                                            <!-- row end-->
                                        </div>
                                        <!-- fifth  tab content end-->
                                    </div>

                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="event_ticket_mainRight" style="">
                                        <h4>{{promotion}}</h4>
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

                    <?php include 'include/footer.php';?>

                </div>

                <!-- Sart Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    <i class="material-icons">clear</i>
                                </button>
                                <h4 class="modal-title">Modal title</h4>
                            </div>
                            <div class="modal-body">
                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default btn-simple">Nice Button</button>
                                <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  End Modal -->
                <!--Please Don't Remove This Part-->
                <!--<div id="checkRadios"  style="display: none !important;">
            <div class="row">
                <div style="display: none;" class="col-sm-3">
                    <div class="title">
                        <h3>Sliders</h3>
                    </div>

                    <div id="sliderRegular" class="slider"></div>
                    <div id="sliderDouble" class="slider slider-info"></div>
                </div>
            </div>
        </div>-->


                <?php echo $cms->fotterJs(array('order'));?>
                    <?php echo $cms->angularJs(array('eTickets_angular'));?>
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
    </body>

    </html>