<?php
include './cms/plugin.php';
$cms = new plugin();
?>



    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="<?php $cms->baseUrl(" assets/img/fav1.png "); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />


        <?php
        echo $cms->pageTitle("Checkout1 | Ticketchai.com...");
        ?>
            <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

            <?php
        echo $cms->headCss(array("checkout1"));
        ?>




                <!--        arnav css
        -->
                <link rel="stylesheet" href="assets/css/mediaQuery.css">





                <!-- CSS Just for demo purpose, don't include it in your project -->
                <!--        <style type="text/css">
                    *,:after,:before{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}html{font-size:10px;-webkit-tap-highlight-color:transparent}body{font-size:14px;line-height:1.42857;color:#333;background-color:#fff;font-family:'Open Sans',sans-serif}body,html{height:100%}
                    </style>-->

                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <style>
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

    <body class="index-page signin" ng-app="frontEnd" ng-controller="checkout1Controller">
        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->
        <?php echo $cms->FbSocialScript(); ?>

            <script src="http://maps.googleapis.com/maps/api/js"></script>
            <!--map-->
            <script>
                function initialize() {
                    var mapProp = {
                        center: new google.maps.LatLng(51.508742, -0.120850),
                        zoom: 5,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    };
                    var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
                }
                google.maps.event.addDomListener(window, 'load', initialize);
            </script>
            <!--./map-->

            <?php include 'include/navbar.php';?>

                <div class="clearfix"></div>
                <div class="wrapper">
                    <!-- main content part starts here -->
                    <div class="main" style="background-color: transparent; margin-top:70px !important;">
                        <!-- Carousel Starts Here -->
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-top-30">
                                    <!-- check still image start here -->
                                    <div class="carousel-inner" role="listbox">
                                        <div class="item active">
                                            <img src="<?php echo $cms->baseUrl(" assets/img/events/Regina-b1469532329.png "); ?>" class="img-fluid img-responsive carousel-img-bd" style="width:100%; height: 100%;">
                                            <div class="carousel-caption">
                                                ...
                                            </div>
                                        </div>
                                    </div>
                                    <!-- check still image end here -->
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- Carousel Ends Here -->

                        <div class="clearfix"></div>
                        <!-- Checkout Panel section starts here -->
                        <div class="section section-simple2">
                            <div class="container">
                                <div class="row section_padd30">
                                    <!--tab bar start here -->

                                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">

                                        <!-- Nav tabs -->
                                        <ul class="tab" id="event_tab">
                                            <li ng-hide="hide"><a href="#Tickets" class="tablinks l1 active"><i class="fa fa-ticket"></i> {{tab_1}}</a></li>
                                            <li><a href="#About" class="tablinks l2"><i class="fa fa-info-circle"></i> {{tab_2}} </a></li>
                                            <li><a href="#Venue" class="tablinks l3"><i class="fa fa-location-arrow"></i> {{tab_3}}</a></li>
                                            <li><a href="#Gallery" class="tablink l4"><i class="fa fa-camera"></i> {{tab_4}}</a></li>
                                            <li><a href="#T_C" class="tablinks l5"><i class="fa fa-user-secret"></i> {{tab_5}}</a></li>
                                            </li>
                                        </ul>

                                        

                                        <!-- Tab panes -->
                                        <div class="tab-content z-depth-1">
                                            <div  class=" terms_con" id="Tickets">
                                                <!--tickets first tab here start -->
                                                <div class="row">
                                                    <!--tab row start-->
                                                    <div class="col-md-12">
                                                        <div class="col-md-12">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <!--tickets details here start -->
                                                                <img src="<?php echo $cms->baseUrl(" assets/img/events/Regina-b1469532329.png "); ?>" class="img-responsive sm-img" alt="happy frindship day">
                                                            </div>

                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <h3 class="checkout1_h3_1 event-name-typ bold text-left">
                                                            {{frindship_text}} &nbsp;
                                                            <button class="btn btn-success heart btn-just-icon">
                                                                <i class="fa fa-heart" aria-hidden="true"></i>
                                                            </button>
                                                        </h3>
                                                                <span class="label label-primary hidden-xs hidden-sm">{{lebel_consert}}</span>
                                                            </div>
                                                            <!--./tickets details here end -->

                                                            <!-- tickets border1 tab here  end -->
                                                            <div class="col-md-12 col-sm-12 col-xs-12 mar hidden-xs hidden-xm"></div>
                                                            <!--./tickets border1 tab here  end -->
                                                        </div>

                                                        <!--Time date div start here-->
                                                        <div class="col-md-12">

                                                            <div class="col-md-6 col-sm-12 col-xs-12 text-center hidden-xm hidden-xs">
                                                                <br>
                                                                <i class="fa fa-clock-o" aria-hidden="true"></i> &nbsp;
                                                                <br>
                                                                <br>
                                                                <a data-toggle="dropdown">
                                                                    <button type="button" class="btn btn-md btn-success-outline waves-effect">
                                                                        <i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;{{btn_calender}}
                                                                    </button>
                                                                </a>

                                                                <!--<a data-toggle="dropdown">
                                                            <button type="button" class="btn btn-success-outline btn-size waves-effect"><i class="fa fa-arrow-circle-o-down" aria-hidden="true">&nbsp;</i> ADD TO CALENDAR
                                                            </button>
                                                        </a>-->

                                                                <ul class="dropdown-menu eve_tic_d_menu_ul" data-toggle="dropdown">
                                                                    <li class="eve_tic_d_menu_ul_li"><a class="eve_tic_d_menu_ul_li_a" href="#">Action</a></li>
                                                                    <li><a class="eve_tic_d_menu_ul_li_a" href="#">{{calender_li1}}</a></li>
                                                                    <li><a class="eve_tic_d_menu_ul_li_a" href="#">{{calender_li2}}</a></li>
                                                                    <li class="divider"></li>
                                                                    <li><a class="eve_tic_d_menu_ul_li_a" href="#">{{calender_li3}}</a></li>
                                                                    <li class="divider"></li>
                                                                    <li>
                                                                        <a class="eve_tic_d_menu_ul_li_a" href="#"></a>{{calender_li4}}</li>
                                                                </ul>
                                                            </div>

                                                            <div class="col-md-6 col-sm-12 col-xs-12 text-center hidden-xm hidden-xs">
                                                                <br>
                                                                <i class="fa fa-map-marker" aria-hidden="true"></i> &nbsp;
                                                                <br>
                                                                <br>
                                                                <button type="button" class="btn btn-md btn-success-outline waves-effect">
                                                                    <i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;&nbsp;{{btn_direction}}</button>
                                                            </div>
                                                            <!--./Time date div start here-->


                                                            <!-- tickets border2 tab here  end -->
                                                            <div class="col-md-12 col-sm-12 col-xs-12 mar margin-top-15 hidden-xm hidden-xs "></div>
                                                            <!--./tickets border2 tab here  end -->
                                                        </div>

                                                        <div class="col-md-12 col-sm-12 col-xs-12 table-responsive margin-top-15">
                                                            <div class="text-uppercase text-center">
                                                                <h3 class="text-center bold pay_hed">
                                                            <i class="fa fa-shopping-cart fa_fan">
                                                            </i> {{cart1}}</h3>
                                                                <table>
                                                                    <thead>
                                                                        <tr class="text-uppercase">

                                                                            <th class="text-center"><strong>{{cart_tblH1}}</strong></th>
                                                                            <th class="text-center"><strong>{{cart_tblH2}}</strong></th>
                                                                            <th class="text-center"><strong>{{cart_tblH3}}</strong></th>
                                                                            <th class="text-center"><strong>{{cart_tblH4}}</strong></th>

                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr class="text-center">
                                                                            <td id="td">
                                                                                <h6 align="center"><strong>Entry</strong></h6>
                                                                            </td>
                                                                            <td class="sprinoff" id="td">
                                                                                <div class="input-group" id="ch1_quan">
                                                                                    <span class="input-group-addon minusprinoff">-</span>
                                                                                    <input value="0" type="text" class="form-control">
                                                                                    <span class="input-group-addon plussprinoff">+</span>
                                                                                </div>

                                                                            </td>


                                                                            <td id="td">
                                                                                <strong>৳350.00</strong>

                                                                            </td>
                                                                            <td id="td">

                                                                                <strong>৳0.00</strong>
                                                                            </td>

                                                                        </tr>
                                                                        <tr class="text-center">
                                                                            <td id="td">
                                                                                <h5 align="center"><strong>Entry-2</strong></h5>
                                                                            </td>
                                                                            <td class="sprinoff" id="td">
                                                                                <div class="input-group" id="ch1_quan">
                                                                                    <span class="input-group-addon minusprinoff">-</span>
                                                                                    <input value="0" type="text" class="form-control">
                                                                                    <span class="input-group-addon plussprinoff">+</span>
                                                                                </div>

                                                                            </td>

                                                                            <td id="td">
                                                                                <strong>৳550.00</strong>
                                                                            </td>
                                                                            <td id="td">
                                                                                <strong>৳0.00</strong>
                                                                            </td>

                                                                        </tr>


                                                                        <tr class="text-center">

                                                                            <td>
                                                                                <strong>Total Quantity = </strong>
                                                                            </td>
                                                                            <td>
                                                                                <strong>0</strong>
                                                                            </td>

                                                                            <td>
                                                                                <strong>Total Amount = </strong>
                                                                            </td>
                                                                            <td>
                                                                                <strong>৳0.00</strong>
                                                                            </td>


                                                                        </tr>


                                                                    </tbody>
                                                                </table>
                                                            </div>




                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="event_table">
                                                                <h3 class="text-center bold pay_hed">
                                                            <i class="fa fa-shopping-cart fa_fan ">
                                                            </i>  {{cart2}}</h3>
                                                                <table>
                                                                    <thead>
                                                                        <tr class="text-uppercase">

                                                                            <th class="text-center"><strong>{{cart_tblH1}}</strong></th>
                                                                            <th class="text-center"><strong>{{cart_tblH2}}</strong></th>
                                                                            <th class="text-center"><strong>{{cart_tblH3}}</strong></th>
                                                                            <th class="text-center"><strong>{{cart_tblH4}}</strong></th>

                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr class="text-center">
                                                                            <td id="td">
                                                                                <h6 align="center"><strong>Entry</strong></h6>
                                                                            </td>
                                                                            <td class="sprinoff" id="td">
                                                                                <div class="input-group" id="ch1_quan">
                                                                                    <span class="input-group-addon minusprinoff">-</span>
                                                                                    <input value="0" type="text" class="form-control">
                                                                                    <span class="input-group-addon plussprinoff">+</span>
                                                                                </div>

                                                                            </td>


                                                                            <td id="td">
                                                                                <strong>৳350.00</strong>

                                                                            </td>
                                                                            <td id="td">

                                                                                <strong>৳0.00</strong>
                                                                            </td>

                                                                        </tr>
                                                                        <tr class="text-center">
                                                                            <td id="td">
                                                                                <h5 align="center"><strong>Entry-2</strong></h5>
                                                                            </td>
                                                                            <td class="sprinoff " id="td">
                                                                                <div class="input-group " id="ch1_quan">
                                                                                    <span class="input-group-addon minusprinoff">-</span>
                                                                                    <input value="0" type="text" class="form-control">
                                                                                    <span class="input-group-addon plussprinoff">+</span>
                                                                                </div>

                                                                            </td>

                                                                            <td id="td">
                                                                                <strong>৳550.00</strong>
                                                                            </td>
                                                                            <td id="td">
                                                                                <strong>৳0.00</strong>
                                                                            </td>

                                                                        </tr>
                                                                        <tr class="text-center">
                                                                            <td>
                                                                                <strong>Total Quantity = </strong>
                                                                            </td>
                                                                            <td>
                                                                                <strong>0</strong>
                                                                            </td>
                                                                            <td>
                                                                                <strong>Total Amount = </strong>
                                                                            </td>
                                                                            <td>
                                                                                <strong>৳0.00</strong>
                                                                            </td>

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
                                                                        <form class="share_detalis">
                                                                            <div class="form-group">
                                                                                <label for="exampleInputEmail1" class="pull-left text-black bold">Full Name</label>
                                                                                <input type="email" class="form-control" id="f_name" placeholder="Full Name">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="exampleInputPassword1" class="pull-left text-black bold">Email Address</label>
                                                                                <input type="password" class="form-control" id="e_add" placeholder="Email Address">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="exampleInputPassword1" class="pull-left text-black bold">Mobile No</label>
                                                                                <input class="form-control" id="mobile" placeholder="Mobile Number After +88" value="" type="text">
                                                                            </div>

                                                                        </form>
                                                                    </div>
                                                                    <br>
                                                                    <br>
                                                                    <!--./shear your contact details end here-->


                                                                </div>
                                                            </div>
                                                            <!--./row  2nd end-->

                                                            <!--Make Payment With start here-->
                                                            <div class="row">
                                                                <div id="div2" class="col-md-12 col-sm-12 col-xs-12 ">

                                                                    <h3 class="text-center bold pay_hed">
                                                                <i class="fa fa-money fa_fan">

                                                                </i> {{payment_text}} 
                                                            </h3>

                                                                    <div class="row text-center">

                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                            <button type="button" value="1" class="btn btn-success btn-raised  payment_btn pament_button1"><i class="fa fa-credit-card pament-icon"></i> {{btn_payment1}}</button>
                                                                        </div>

                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                            <button id="cash_on_del_buton" type="button" value="1" class="btn btn-primary btn-raised  payment_btn pament_button2"><i class="fa fa-exchange  pament-icon"></i> {{btn_payment2}}</button>
                                                                        </div>

                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                            <button type="button" value="1" class="btn btn-info btn-raised  payment_btn pament_button3"><i class="fa fa-mobile  pament-icon"></i> {{btn_payment3}}</button>
                                                                        </div>


                                                                    </div>

                                                                    <img src="<?php echo $cms->baseUrl(" assets/img/pay3.png "); ?>" alt="Payment GateWays" class="img-responsive pay_img text-center" />

                                                                    <!--./Make Payment With end here-->
                                                                </div>
                                                            </div>
                                                            <!--./row  2nd end-->



                                                            <!---->

                                                            <div id="div1" style="display:none" class="col-md-12 col-sm-12 col-xs-12 ">
                                                                <div class="text-center">

                                                                    <div class="panel panel-default">
                                                                        <div class="panel-body">

                                                                            <div class="row">
                                                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                                                                    <form class="share_detalis">
                                                                                        <div class="form-group">
                                                                                            <label for="exampleInputPassword1" class="pull-left text-black bold">City</label>
                                                                                            <select class="form-control" id="sel1" placeholder="Select Your City">
                                                                                                <option>Dhaka</option>
                                                                                                <option>Comilla</option>
                                                                                                <option>Dhaka</option>
                                                                                                <option>Dhaka</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </form>

                                                                                </div>
                                                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                                    <form class="share_detalis">
                                                                                        <div class="form-group">
                                                                                            <label for="exampleInputPassword1" class="pull-left text-black bold">Zip/Postal Code</label>
                                                                                            <input class="form-control" id="mobile" placeholder="Input your shiping zip/postal code here" value="" type="text">
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                                                                    <form class="share_detalis">
                                                                                        <div class="form-group">
                                                                                            <label for="exampleInputPassword1" class="pull-left text-black bold">Address</label>
                                                                                            <textarea class="form-control" id="mobile" rows="4" placeholder="Input your Address here" value="" type="text"></textarea>

                                                                                        </div>
                                                                                    </form>

                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                                    <button id="cashDbut1" type="button" value="1" class="btn btn-info btn-raised  payment_btn pament_button col-lg-12 col-md-12 col-sm-12 col-xs-12"><i class="fa fa-mobile"></i> Back to payment method</button>
                                                                                </div>

                                                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                                    <button id="cashDbut2" type="button" value="1" class="btn btn-success btn-raised  payment_btn pament_button col-lg-12 col-md-12 col-sm-12 col-xs-12 "><i class="fa fa-credit-card"></i> Continue</button>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>
                                                        <!--./tickets first tab here  end -->
                                                    </div>
                                                    <!--./tab content end-->
                                                </div>
                                                <!--./tab bar end here-->
                                            </div>
                                            <!--./tickets first tab end here-->

                                            <!--about event start here-->
                                            <div class="" id="About">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading terms_con">
                                                        <h4 class="text-left bold"> About Event</h4>
                                                    </div>
                                                    <div class="panel-body">
                                                        tickets tickets tickets
                                                    </div>
                                                </div>
                                            </div>
                                            <!--./about event end here-->


                                            <!--venue part start here-->
                                            <div class="" id="Venue">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading terms_con">
                                                        <h4 class="text-left bold"> VENUE</h4>
                                                    </div>
                                                    <div class="panel-body" id="Venue">

                                                        <!--Div for google map-->
                                                        <div id="custom-map" class="col-md-12 col-sm-6 col-xs-12">
                                                            <div id="googleMap" style="width:100%;height:380px;">

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--./venue part end here-->

                                            <!--gallery start here-->
                                            <div  class="" id="Gallery">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading terms_con">
                                                        <h4 class="text-left bold">Photo Gallery</h4>
                                                    </div>
                                                    <div class="panel-body">
                                                        <a href="#" class="gall-item" title="gallery">
                                                    <img class="img-responsive" src="<?php $cms->baseUrl("assets/img/events/Sonu-b-banner14695109771469511113.png"); ?>" alt="image">
                                                </a>
                                                    </div>
                                                    <div class="panel-heading terms_con">
                                                        <h4 class="text-left bold">Video Gallery</h4>
                                                    </div>
                                                    <div class="panel-body">
                                                        <embed src="http://www.youtube.com/v/FtHKu7zW_zQ">
                                                    </div>
                                                </div>
                                            </div>
                                            <!--./gallery end here-->

                                            <!-- T & c start here-->
                                            <div class="" id="T_C">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading terms_con">
                                                        <h4 class="text-left bold">Terms &amp; Conditions</h4>
                                                    </div>
                                                    <div class="panel-body">
                                                        Panel content start
                                                    </div>
                                                </div>
                                            </div>
                                            <!--./T & c-->
                                        </div>
                                        <!--./tab content end here-->
                                    </div>
                                    <!-- ./Checkout Panel section ends here -->

                                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                        <!-- side content right here start -->
                                        <div class="row">
                                            <!--row start here-->


                                            <!--                                    <div id="clock">
                                        
                                                                                <p class="col-sm-2">
                                                                                    <span id="weeks"></span>
                                                                                    Weeks
                                                                                </p>
                                                                                <div class="space">:</div>
                                                                                <p class="col-sm-2">
                                                                                    <span id="daysLeft"></span>
                                                                                    Days
                                                                                </p>
                                                                                <div class="space">:</div>
                                                                                <p class="col-sm-2">
                                                                                    <span id="hours"></span>
                                                                                    Hours
                                                                                </p>
                                                                                <div class="space">:</div>
                                                                                <p class="col-sm-2">
                                                                                    <span id="minutes"></span>
                                                                                    Minutes
                                                                                </p>
                                                                                <div class="space">:</div>
                                                                                <p class="col-sm-2">
                                                                                    <span id="seconds"></span>
                                                                                    Seconds
                                                                                </p>
                                                                            </div>-->
                                        </div>
                                        <!--/.row end here-->


                                        <!--No offers and promotion found start here-->

                                        <div class="sidebar-events">
                                            <h4 class="text-center bold no_found">No offers and promotion found.</h4>
                                        </div>


                                        <div class="mini-cart-1">
                                            <div class="pnp_hd">
                                                <div class="panel panel-default ">
                                                    <!--tickets detail start here-->
                                                    <div class="panel-heading hed_pen">
                                                        <h3 class="panel-title bold"> Ticket Detail</h3>
                                                    </div>
                                                    <div class="panel-body pb_body">
                                                        <table class="table table-responsive">
                                                            <tbody>
                                                                <tr>
                                                                    <td><i class="fa fa-ticket"></i></td>
                                                                    <td>Total Ticket Quantity</td>
                                                                    <td id="s_ticket_quantity">0.00</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <i class="fa fa-ticket"></i>
                                                                    </td>
                                                                    <td>Total Ticket Price</td>
                                                                    <td id="s_ticket_total_amount" class="hahahehe">0.00</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                                                    </td>
                                                                    <td>Total Include Quantity</td>
                                                                    <td id="s_include_quantity">0.00</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>
                                                                        <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                                                    </td>
                                                                    <td>Total Include Price</td>
                                                                    <td id="include_total_amount" class="total_amnt">0.01</td>
                                                                </tr>

                                                                <tr id="s_total_amount_row">
                                                                    <td class="bold" colspan="2">
                                                                        <i class="fa fa-money fa-1x"></i>&nbsp; Total Payable Amount :
                                                                    </td>
                                                                    <td>
                                                                        <span id="total_amount" class="odometer bold">0.01</span>
                                                                    </td>
                                                                </tr>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <!--./tickets detail end here-->
                                            </div>
                                        </div>
                                    </div>
                                    <!--./No offers and promotion found end here-->
                                </div>
                                <!-- side content right here end-->
                            </div>
                            <!--./row section_padd30-->
                        </div>
                        <!--container end here-->


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
                    <?php include 'include/footer.php';?>

                </div>
 <!-- All auto click button  start-->

                <?php 
            // @$f_id=$_GET['id'];
            // @$c_id=$_GET['c_id'];
            // @$up_id=$_GET['up_id'];
            // if ( !empty($f_id)) {
            //    echo  '<span id="autoclick" ng-click="f_eventDetailCall('.$f_id.')"></span>';
            // }
            // elseif( !empty($c_id)) {
            //     echo  '<span id="autoclick" ng-click="c_eventDetailCall('.$c_id.')"></span>';
            // }else{
            //     echo  '<span id="autoclick" ng-click="up_eventDetailCall('.$up_id.')"></span>';
            // }
         ?>
                <?php echo $cms->fotterJs(array('checkout1')); ?>
                    <?php echo $cms->angularJs(array('checkout1_angular')); ?>

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

                        <script>
                            new WOW().init();
                            //$('.selectpicker').selectpicker();

                            $(document).ready(function () {
                                $('#cash_on_del_buton').click(function () {
                                    $('#div2').hide();
                                    $('#div1').toggle(1000);
                                });

                                $('#cashDbut1').click(function () {
                                    $('#div1').hide();
                                    $('#div2').toggle(1000);
                                });
                            });
                        </script>
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
                             <script text="text/javascript">
                                $(document).ready(function () {
                                    $("#autoclick").click();
                                });
                            </script>

    </body>

    </html>