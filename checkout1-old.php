<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/fav1.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>Ticket Chai | Buy Online Ticket...</title>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

        <!-- Fonts and icons -->
        <link rel="stylesheet" href="assets/css/icon.css" />
        <link rel="stylesheet" type="text/css" href="assets/css/fonts.css" />
        <link rel="stylesheet" href="plugins/font-awesome-4.6.3/css/font-awesome.min.css" />
        <link rel="stylesheet" href="assets/css/pe-icon-7-stroke.css" />
        <link rel="stylesheet" href="plugins/fontello-2910d963/css/fontello.css" />


        <!-- CSS Files -->
        <link rel="stylesheet" href="assets/css/normalize.css">
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/css/material-kit.css" rel="stylesheet"/>
        <link rel="stylesheet" href="plugins/mdb/css/mdb.min62d0.css">
        <link href="plugins/Simple-Background-Carousel-Plugin-with-jQuery-and-Animate-css-Crosscover/dist/css/crosscover.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/animate.css">
        <link rel="stylesheet" href="assets/css/link-effects.css">
        <link rel="stylesheet" href="plugins/x-hipster-as-f-cards-v1.1/assets/css/hipster_cards.css">
        <link rel="stylesheet" href="plugins/Waves-master/dist/waves.min.css">
        <link rel="stylesheet" href="plugins/odometer-master/odometer-theme-default.css">
        <link rel="stylesheet" href="plugins/bootstrap-social-gh-pages/bootstrap-social.css">
        <link rel="stylesheet" href="plugins/bootstrap-select-1.10.0/dist/css/bootstrap-select.css">
        <!-- For Owl Carousel -->
        <link rel="stylesheet" href="plugins/owl.carousel/owl-carousel/owl.carousel.css">
        <link rel="stylesheet" href="plugins/owl.carousel/owl-carousel/owl.theme.css">
        <!--CSS Files Added By Munira-->
        <link rel="stylesheet" href="assets/css/checkout1.css">





        <!-- CSS Just for demo purpose, don't include it in your project -->
        <!--        <style type="text/css">
                *,:after,:before{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}html{font-size:10px;-webkit-tap-highlight-color:transparent}body{font-size:14px;line-height:1.42857;color:#333;background-color:#fff;font-family:'Open Sans',sans-serif}body,html{height:100%}
                </style>-->




    </head>

    <body class="index-page signin"><!--style="background-color: #FFF !important;"-->
        <div id="fb-root"></div>
        <script>
            (function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>


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
        </script> <!--./map-->

        <!-- Navbar -->
        <nav class="navbar navbar-fixed-top navbar-default" style="margin-bottom:0px;">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-index">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="index.html">
                        <div class="logo-container">
                            <div class="logo">
                                <img src="assets/img/white-shadow-logo.png" alt="Ticketchai Logo" rel="tooltip" title="<b>Ticketchai.com</b>" data-placement="bottom" data-html="true"/>
                            </div>
                            <!--<div class="brand">
                                <img src="assets/img/white-shadow-logo.png" alt="Ticketchai Logo" rel="tooltip" title="<b>Ticketchai.com</b>" data-placement="bottom" data-html="true" style="margin-top:-10px;"/>
                            </div>-->


                        </div>
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="navigation-index">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="text-center hidden-sm">
                            <a href="#!" id="nav-search-btn"><i class="fa fa-search" aria-hidden="true">&nbsp;</i> Search Events</a>
                            <div  id="nav-search-field" class="form-group" style="display: none;">
                                <input type="password" class="form-control" placeholder="Search For An Event">
                                <span class="floating-f-p">
                                    <a href="#!"  id="nav-search-close"><i class="fa fa-times-circle-o" aria-hidden="true"></i></a>
                                </span>
                            </div>
                        </li>
                        <li class="text-center single-nav">
                            <a href="#!">Events</a>
                        </li>
                        <li class="text-center single-nav">
                            <a href="#!">Sports</a>
                        </li>
                        <li class="text-center single-nav">
                            <a href="#!">Theater</a>
                        </li>
                        <li class="text-center single-nav">
                            <a href="#!">Movies</a>
                        </li>
                        <li class="text-center single-nav">
                            <a href="#!">Music</a>
                        </li>
                        <li class="dropdown text-center">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">More <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Buses</a></li>
                                <li><a href="#">Launches</a></li>
                                <li><a href="#">Tourism</a></li>
                            </ul>
                        </li>
                        <li class="text-center hidden-sm">
                            <a href="#"><i class="fa fa-lock" aria-hidden="true"></i> Log In</a>
                        </li>
                        <li class="dropdown text-center bd-ash-1 margin_right10 hidden-sm">
                            <a href="#!" class="dropdown-toggle cart-nav"data-toggle="dropdown"> <!--data-hover="dropdown" -->
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart
                                <b class="total-price"> ৳ <span id="cartAmount">3000</span></b>
                            </a>
                            <ul class="dropdown-menu" id="wholeCart">
                                <li>
                                    <div class="basket-item">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                                <div class="title">
                                                    <a href="http://ticketchai.com/details/406/Social-Business-Youth-Summit-2016" target="_blank" class="cart-product-title">Social Business Youth Summit 2016</a>
                                                    <a href="#!"  id="del-cart-item"><i class="fa fa-times-circle-o" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-2 col-md-4 text-center">
                                                <div class="thumb">
                                                    <img alt="Social Business Youth Summit 2016" src="http://ticketchai.com/upload/event_web_logo/ewl_2016-06-01-19-13-44.jpg">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-10 col-md-8">

                                                <div class="col-xs-12">
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                <td style="width: 60%">Title</td>
                                                                <td style="width: 20%">Qnt.</td>
                                                                <td style="width: 20%">Price</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Student</td>
                                                                <td>1</td>
                                                                <td>৳3000.00</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="basket-item">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                                <div class="title">
                                                    <a href="http://ticketchai.com/details/406/Social-Business-Youth-Summit-2016" target="_blank" class="cart-product-title">Social Business Youth Summit 2016</a>
                                                    <a href="#!"  id="del-cart-item"><i class="fa fa-times-circle-o" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-2 col-md-4 text-center">
                                                <div class="thumb">
                                                    <img alt="Social Business Youth Summit 2016" src="http://ticketchai.com/upload/event_web_logo/ewl_2016-06-01-19-13-44.jpg">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-10 col-md-8">

                                                <div class="col-xs-12">
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                <td style="width: 60%">Title</td>
                                                                <td style="width: 20%">Qnt.</td>
                                                                <td style="width: 20%">Price</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Student</td>
                                                                <td>1</td>
                                                                <td>৳3000.00</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <!--                                        <h4 class="text-center" style="margin: 15px 0px;">Cart is now empty.</h4>-->
                                <li class="checkout hidden-sm">
                                    <div class="col-xs-12">
                                        <div class="col-xs-6">
                                            <a href="#!" class="btn btn-danger btn-raised btn-block">show cart</a>
                                        </div>
                                        <div class="col-xs-6">
                                            <a class="btn btn-info btn-raised btn-block" href="#!">checkout</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
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
                                    <img src="assets/img/events/Regina-b1469532329.png" class="img-fluid img-responsive carousel-img-bd" style="width:100%; height: 100%;">
                                    <div class="carousel-caption">
                                        ...
                                    </div>
                                </div>
                            </div><!-- check still image end here -->
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

                            <div class="col-lg-9 col-md-9 col-sm-6 col-xs-12">

                                <!-- Nav tabs -->
                                <ul id="event-tab-list" class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="">
                                        <a href="#tickets_detalis" aria-controls="tickets_detalis" role="tab" data-toggle="tab">
                                            <i class="fa fa-ticket"></i> Tickets
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#about_event" aria-controls="about_event" role="tab" data-toggle="tab">
                                            <i class="fa fa-info-circle"></i> About Event
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#venue_item" aria-controls="venue_item" role="tab" data-toggle="tab">
                                            <i class="icon-location"></i> Venue
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#gallery" aria-controls="gallery" role="tab" data-toggle="tab">
                                            <i class="fa fa-camera"></i> Gallery
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#tc" aria-controls="tc" role="tab" data-toggle="tab">
                                            <i class="fa fa-user-secret"></i> T & C
                                        </a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content z-depth-1">
                                    <div role="tabpanel" class="tab-pane active" id="tickets_detalis"><!--tickets first tab here start -->
                                        <div class="row"> <!--tab row start-->
                                            <div class="col-md-12">
                                                <div class="col-md-12">
                                                    <div class="col-md-4 col-sm-6 col-xs-12"><!--tickets details here start -->
                                                        <img src="assets/img/events/Regina-b1469532329.png" class="img-responsive sm-img" alt="happy frindship day"> 
                                                    </div>

                                                    <div class="col-md-8 col-sm-6 col-xs-12">
                                                        <h3 class="event-name-typ bold text-left">
                                                            HAPPY FRIENDSHIP DAY &nbsp;
                                                            <button class="btn btn-success heart btn-just-icon">
                                                                <i class="fa fa-heart" aria-hidden="true"></i>
                                                            </button>
                                                        </h3> 
                                                        <span class="label label-primary">concert</span>
                                                    </div><!--./tickets details here end -->

                                                    <!-- tickets border1 tab here  end -->
                                                    <div class="col-md-12 col-sm-6 col-xs-12 mar"></div>
                                                    <!--./tickets border1 tab here  end -->
                                                </div>

                                                <!--Time date div start here-->
                                                <div class="col-md-12">

                                                    <div class="col-md-6 col-sm-4 col-xs-12 text-center"><br>
                                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                                        &nbsp;  mmmmmmmmmmmmmmm<br><br>
                                                        <button type="button" class="btn btn-md btn-success-outline waves-effect"> 
                                                            <i class="fa fa-calendar"  aria-hidden="true"></i>&nbsp;&nbsp;ADD To calender</button>
                                                    </div>

                                                    <div class="col-md-6 col-sm-4 col-xs-12 text-center"><br>
                                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                        &nbsp; ggggggggggg<br><br>
                                                        <button type="button" class="btn btn-md btn-success-outline waves-effect">
                                                            <i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;&nbsp;GET DIRECTION</button>
                                                    </div>
                                                    <!--./Time date div start here-->


                                                    <!-- tickets border2 tab here  end -->
                                                    <div class="col-md-12 col-sm-6 col-xs-12 mar margin-top-15"></div>
                                                    <!--./tickets border2 tab here  end --> 
                                                </div>

                                                <div class="col-md-12 col-sm-6 col-xs-12 table-responsive margin-top-15">
                                                    <div class="text-uppercase text-center">
                                                        <h3 class="text-center bold pay_hed">
                                                            <i class="fa fa-shopping-cart fa_fan">
                                                            </i> Buy Tickets</h3>
                                                        <table class="table table-hover">
                                                            <!-- On cells (`td` or `th`) -->

                                                            <tr class="text-uppercase">

                                                                <th class="text-center"><strong>Ticket</strong></th>
                                                                <th class="text-center"><strong>Quantity</strong></th>
                                                                <th class="text-center"><strong>Unit Price</strong></th>
                                                                <th class="text-center"><strong>Total Price</strong></th>

                                                            </tr>
                                                            <tr class="text-center">
                                                                <td>
                                                                    <h6 align="center"><strong>Entry</strong></h6>
                                                                </td>
                                                                <td class="sprinoff">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon minusprinoff">-</span>
                                                                        <input value="0" type="text" class="form-control">
                                                                        <span class="input-group-addon plussprinoff">+</span>
                                                                    </div>

                                                                </td>                                                                


                                                                <td>
                                                                    <strong>৳350.00</strong>

                                                                </td>
                                                                <td>

                                                                    <strong>৳0.00</strong>
                                                                </td>

                                                            </tr>
                                                            <tr class="text-center">
                                                                <td>
                                                                    <h5 align="center"><strong>Entry-2</strong></h5>
                                                                </td>
                                                                <td class="sprinoff">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon minusprinoff">-</span>
                                                                        <input value="0" type="text" class="form-control">
                                                                        <span class="input-group-addon plussprinoff">+</span>
                                                                    </div>

                                                                </td> 

                                                                <td>
                                                                    <strong>৳550.00</strong>
                                                                </td>
                                                                <td>
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

                                                        </table>
                                                    </div>



                                                    <div class="col-md-12 col-sm-6 col-xs-12 table-responsive">
                                                        <div class="text-uppercase text-center">
                                                            <h3 class="text-center bold pay_hed">
                                                                <i class="fa fa-shopping-cart fa_fan ">
                                                                </i> Buy Includes</h3>
                                                            <table class="table table-hover">
                                                                <!-- On cells (`td` or `th`) -->
                                                                <tr class="text-center text-uppercase">
                                                                    <th class="text-center">TICKETS</th>
                                                                    <th class="text-center">Quantity</th>
                                                                    <th class="text-center">unit price</th>
                                                                    <th class="text-center">total price</th>

                                                                </tr>
                                                                <tr class="text-center">
                                                                    <td>
                                                                        <h5 align="center"><strong>Dinner</strong></h5>
                                                                    </td>

                                                                    <td class="sprinoff">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon minusprinoff">-</span>
                                                                            <input value="0" type="text" class="form-control">
                                                                            <span class="input-group-addon plussprinoff">+</span>
                                                                        </div>

                                                                    </td> 

                                                                    <td>
                                                                        <strong>৳250.00</strong>
                                                                    </td>
                                                                    <td>
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
                                                            </table>
                                                        </div><!--./table end-->

                                                        <!-- tickets border5 tab here  start -->
                                                        <div class="col-md-12 col-sm-6 col-xs-12 mar"></div><br><br>
                                                        <!--./tickets border5 tab here  end --> 

                                                        <!--shear your contact details start here-->
                                                        <div class="col-md-12 col-sm-6 col-xs-12 table-responsive">
                                                            <div class="text-uppercase text-center">
                                                                <h3 class="text-center bold pay_hed" ><i class="fa fa-info-circle fa_fan">
                                                                    </i> Share your Contact Details</h3>
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
                                                            </div><br><br><!--./shear your contact details end here-->

                                                            <!-- tickets border5 tab here  start -->
                                                            <div class="col-md-12 col-sm-6 col-xs-12 mar"></div><br><br>
                                                            <!--./tickets border5 tab here  end --> 
                                                        </div><!--./row  2nd end-->

                                                        <!--Make Payment With start here-->
                                                        <div class="col-md-12 col-sm-6 col-xs-12 table-responsive padding_bottom15">
                                                            <div class="text-center">
                                                                <h3 class="text-center bold pay_hed">
                                                                    <i class="fa fa-money fa_fan">

                                                                    </i> Make Payment With </h3>

                                                                <div class="col-md-4 col-xs-12"> 
                                                                    <button type="button" value="1" class="btn btn-success btn-raised  payment_btn"><i class="fa fa-credit-card"></i> Online Payment</button>
                                                                </div>

                                                                <div class="col-md-4 col-xs-12"> 
                                                                    <button type="button" value="1"  class="btn btn-primary btn-raised  payment_btn"><i class="fa fa-exchange"></i> Cash On Delivery</button>
                                                                </div>

                                                                <div class="col-md-4 col-xs-12"> 
                                                                    <button type="button"  value="1" class="btn btn-info btn-raised  payment_btn"><i class="fa fa-mobile"></i> Bkash Payment</button>
                                                                </div>


                                                                <img src="assets/img/pay2.png" alt="Payment GateWays" class="img-responsive pay_img"/>
                                                            </div><!--./Make Payment With end here-->
                                                        </div><!--./row  2nd end-->
                                                    </div><!--./tab row end-->
                                                </div><!--./tickets first tab here  end -->
                                            </div><!--./tab content end-->
                                        </div>
                                        <!--./tab bar end here-->
                                    </div><!--./tickets first tab end here-->

                                    <!--about event start here-->
                                    <div role="tabpanel" class="tab-pane" id="about_event">
                                        <div class="panel panel-default">
                                            <div class="panel-heading terms_con">
                                                <h4 class="text-left bold"> About Event</h4>
                                            </div>
                                            <div class="panel-body">
                                                tickets tickets tickets
                                            </div>
                                        </div>
                                    </div> <!--./about event end here-->


                                    <!--venue part start here-->
                                    <div role="tabpanel" class="tab-pane" id="venue_item">
                                        <div class="panel panel-default">
                                            <div class="panel-heading terms_con">
                                                <h4 class="text-left bold"> VENUE</h4>
                                            </div>
                                            <div class="panel-body"  id="Venue">

                                                <!--Div for google map-->
                                                <div id="custom-map" class="col-md-12 col-sm-6 col-xs-12">
                                                    <div id="googleMap" style="width:100%;height:380px;">

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div><!--./venue part end here-->

                                    <!--gallery start here-->
                                    <div role="tabpanel" class="tab-pane" id="gallery">
                                        <div class="panel panel-default">
                                            <div class="panel-heading terms_con">
                                                <h4 class="text-left bold">Photo Gallery</h4>
                                            </div>
                                            <div class="panel-body">
                                                <a href="#" class="gall-item" title="gallery">
                                                    <img class="img-responsive" src="assets/img/events/Sonu-b-banner14695109771469511113.png" alt="image">
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
                                    <div role="tabpanel" class="tab-pane" id="tc">
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
                                </div><!--./tab content end here-->
                            </div>
                            <!-- ./Checkout Panel section ends here -->

                            <script src="ct/js/jquery.countdown.js" type="text/javascript" charset="utf-8"></script>
                            <script type="text/javascript" charset="utf-8">
            $(function () {
                var currentDate = new Date(),
                        finished = false,
                        availiableExamples = {
                            set15daysFromNow: 15 * 24 * 60 * 60 * 1000,
                            set5minFromNow: 5 * 60 * 1000,
                            set1minFromNow: 1 * 60 * 1000
                        };

                function callback(event) {
                    $this = $(this);
                    switch (event.type) {
                        case "seconds":
                        case "minutes":
                        case "hours":
                        case "days":
                        case "weeks":
                        case "daysLeft":
                            $this.find('span#' + event.type).html(event.value);
                            if (finished) {
                                $this.fadeTo(0, 1);
                                finished = false;
                            }
                            break;
                        case "finished":
                            $this.fadeTo('slow', .5);
                            finished = true;
                            break;
                    }
                }

                $('div#clock').countdown(availiableExamples.set15daysFromNow + currentDate.valueOf(), callback);


            });
                            </script>


                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"> <!-- side content right here start -->
                                <div class="row"><!--row start here-->


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
                                </div><!--/.row end here-->


                                <!--No offers and promotion found start here-->

                                <div class="sidebar-events">
                                    <h4 class="text-center bold no_found">No offers and promotion found.</h4>
                                </div>


                                <div class="mini-cart-1"> 
                                    <div class="pnp_hd">
                                        <div class="panel panel-default " > <!--tickets detail start here-->
                                            <div class="panel-heading hed_pen" >
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
                                                                <i class="fa fa-money fa-1x"></i>&nbsp;
                                                                Total Payable Amount :
                                                            </td>
                                                            <td>
                                                                <span id="total_amount" class="odometer bold">0.01</span>
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div><!--./tickets detail end here-->
                                    </div>
                                </div>
                            </div>
                            <!--./No offers and promotion found end here-->
                        </div> <!-- side content right here end-->
                    </div> <!--./row section_padd30-->
                </div><!--container end here-->






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
                <!-- main content part ends here -->
                <!-- main footer part starts here -->
                <!--Footer-->
                <footer class="page-footer center-on-small-only" style="margin-top: -10px;">

                    <!--Footer Links-->
                    <div class="container-fluid">
                        <div class="container">
                            <div class="row section_padd30">

                                <!--First column-->
                                <div class="col-md-3">
                                    <h5 class="title bold">Stay In Touch</h5>
                                    <img class="footer_logo" src="assets/img/ticketchai_logo1.png" alt="ticketchai.com" />
                                    <br/>
                                    <ul>
                                        <br/>
                                        <li><a href="#">HOT LINE: (+8801971842538)</a></li>
                                        <li><a href="#">OFFICE HOURS: 10:00 AM TO 06:00 PM</a></li>
                                        <li><a href="#">OFFICE DAY: SATURDAY TO THURSDAY</a></li>
                                    </ul>
                                </div>
                                <!--/.First column-->

                                <!--Second column-->
                                <div class="col-md-2">
                                    <h5 class="title bold">Useful Links</h5>
                                    <ul>
                                        <li><a href="#!">Terms of Service </a></li><br/>
                                        <li><a href="#!">Privacy Policy</a></li><br/>
                                        <li><a href="#!">How to Buy</a></li><br/>
                                        <li><a href="#!">About Us</a></li><br/>
                                        <li><a href="#!">Contact Us</a></li><br/>
                                        <li><a href="#!">Support</a></li><br/>
                                        <li><a href="#!">Create Your Event</a></li>
                                    </ul>
                                </div>
                                <!--/.Second column-->

                                <!--Third column-->
                                <div class="col-md-3">
                                    <h5 class="title bold">Facebook</h5>
                                    <ul>
                                        <li>
                                            <div data-height="210" style="width:255px !important;" class="fb-page" data-href="https://www.facebook.com/ticketchaibd" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/ticketchaibd" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/ticketchaibd">Ticket chai</a></blockquote></div>
                                        </li>
                                    </ul>

                                </div>
                                <!--/.Third column-->

                                <!--Fourth column-->
                                <div class="col-md-3 col-md-offset-1">
                                    <h5 class="title bold">Company Info</h5>
                                    <ul>
                                        <li><i class="fa fa-map-marker"></i>
                                            <span>Razzak Plaza (8th Floor),1 New Eskaton Road,
                                                Moghbazar Circle, Dhaka-1217 
                                            </span>
                                        </li>
                                        <br/>
                                        <li><i class="fa fa-phone"></i> <span>+880-1971-842538</span>,<span>+880-447-8009569</span></li>
                                        <br/>
                                        <li><a href="mailto:support@ticketchai.com" style="font-size: 14px; text-transform: none;"><i class="fa fa-envelope-o"></i> Email: support@ticketchai.com</a></li>
                                        <br/>
                                        <li><a href="www.ticketchai.com"  style="font-size: 14px; text-transform: none;"><i class="fa fa-globe"></i> Website: www.ticketchai.com </a></li>
                                    </ul>
                                </div>
                                <!--/.Fourth column-->

                            </div>
                        </div>
                    </div>
                    <!--/.Footer Links-->

                    <div class="clearfix"></div>
                    <br>
                    <hr>

                    <!--Social buttons-->
                    <div class="col-md-8 col-md-offset-2 social-section">
                        <ul>
                            <li><a class="btn-floating btn-small btn-fb"><i class="fa fa-facebook"> </i></a></li>
                            <li><a class="btn-floating btn-small btn-tw"><i class="fa fa-twitter"> </i></a></li>
                            <li><a class="btn-floating btn-small btn-gplus"><i class="fa fa-google-plus"> </i></a></li>
                            <li><a class="btn-floating btn-small btn-li"><i class="fa fa-linkedin"> </i></a></li>
                            <li><a class="btn-floating btn-small btn-pin"><i class="fa fa-pinterest"> </i></a></li>
                            <li><a class="btn-floating btn-small btn-ins"><i class="fa fa-instagram"> </i></a></li>
                        </ul>
                    </div>
                    <!--/.Social buttons-->
                    <div class="clearfix"></div>
                    <br>
                    <!--Copyright-->
                    <div class="col-md-12 footer-copyright hidden-xs">
                        <div class="container-fluid img-responsive">
                            <img src="assets/img/pay3.png" alt="Pay With SSL-Commerze" />
                        </div>
                    </div>
                    <!--/.Copyright-->

                </footer>
                <!--/.Footer-->

                <footer class="footer" style="border-top: 2px solid #C5E1A5 !important;">
                    <div class="container">
                        <div class="copyright text-center">
                            <br>
                            Copyright &copy; 2016, Ticketchai.com | All Rights Reserved.
                        </div>
                    </div>
                </footer>
                <!-- main footer part ends here -->
                <!-- subscription widget starts here -->
                <div class="clearfix"></div>
                <div id="subscription" class="container-fluid subscribe-widget navbar-fixed-bottom" style="border-radius: 0px;">
                    <button id="btn-sclose" class="btn btn-warning btn-raised btn-fab btn-fab-mini btn-round"><i class="fa fa-chevron-down"></i></button>
                    <div class="row" style="overflow: hidden;">
                        <div class="container">
                            <div class="col-md-6">
                                <h3 class="subscribe-label">Subscribe & Stay Tuned For Exciting Events </h3>
                            </div>
                            <div class="col-md-6">
                                <form>
                                    <div class="input-group">
                                        <input type="text" class="form-control subscription_input" placeholder="Type Your Email For Latest Newsletters">
                                        <span class="input-group-btn">
                                            <button class="btn btn-raised btn-danger btn-subscribe" type="button"><i class="fa fa-envelope">&nbsp;</i> Subscribe</button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <!-- subscription widget starts here -->
            </div>
        </div>
    </div>
</body>
<!--   Core JS Files   -->
<script src="assets/js/jquery.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/js/material.min.js"></script>
<script src="plugins/mdb/js/mdb.min.js"></script>
<script src="plugins/mdb/js/tether.min.js"></script>

<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<!--<script src="assets/js/nouislider.min.js" type="text/javascript"></script>-->

<!--  Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->
<script src="assets/js/bootstrap-datepicker.js" type="text/javascript"></script>

<!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
<script src="assets/js/material-kit.js" type="text/javascript"></script>
<!-- Animations init-->



<script>
            new WOW().init();
            //$('.selectpicker').selectpicker();
</script>
<!--count button start here script-->
<script type="text/javascript">

    $(document).ready(function () {
        $(".minusprinoff").click(function () {
            //alert("sasdfds");
            var mindefine = $(this).html();
            if (mindefine == "-")
            {
                //alert("sasdfds");
                var minactual = '';
                var getexvalue = $(this).parent("div").find("input").val();
                if (getexvalue > 0)
                {
                    minactual = getexvalue - 1;
                    $(this).parent("div").find("input").css("color", "#000");
                }
                else
                {
                    minactual = 0;
                    $(this).parent("div").find("input").css("color", "#f00");
                }

                $(this).parent("div").find("input").val(minactual);
            }
        });

        $(".plussprinoff").click(function () {
            //alert("sasdfds");
            var mindefine = $(this).html();
            if (mindefine == "+")
            {
                //alert("sasdfds");
                var minactual = '';
                var getexvalue = $(this).parent("div").find("input").val();

                minactual = (getexvalue - 0) + (1 - 0);
                $(this).parent("div").find("input").css("color", "#000");

                $(this).parent("div").find("input").val(minactual);
            }
        });


    });


    $(document).ready(function () {
        $("#imageShowCase").mouseenter(function () {
            $('#ts-prev').addClass('active-ps-nav');
            $('#ts-next').addClass('active-ps-nav');
        }).mouseleave(function () {
            $('#ts-prev').removeClass('active-ps-nav');
            $('#ts-next').removeClass('active-ps-nav');
        });
        /*$('.hidden-buttons').hide();
         $(".movie").mouseenter(function () {
         $('.hidden-buttons').show();
         }).mouseleave(function () {
         $('.hidden-buttons').hide();
         });*/
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
<script>
    $(document).ready(function (e) {
        $('a.tplay').on('click', function () {
            player.playVideo();
            $('.navbar-fixed-top').hide();
        });

        $('#myModal').on('click', function () {
            player.stopVideo();
            $('.navbar-fixed-top').show();
            location.reload();
        });

    });
</script>

<script>

    $(document).ready(function (n) {
        $('a.tplay').click(function () {
            var ytvidid = $(this).attr("name");
            //alert(ytvidid);
        });
    });
    // 2. This code loads the IFrame Player API code asynchronously.
    var tag = document.createElement('script');

    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    // 3. This function creates an <iframe> (and YouTube player)
    //    after the API code downloads.
    var player;
    function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
            height: '500',
            width: '100%',
            videoId: 'uvi6WZKHCJ0',
            events: {
                'onClick': onPlayerReady,
                'onStateChange': onPlayerStateChange
            }
        });



    }

    // 4. The API will call this function when the video player is ready.
    function onPlayerReady(event) {
        event.target.playVideo();
    }



    // 5. The API calls this function when the player's state changes.
    //    The function indicates that when playing a video (state=1),
    //    the player should play for six seconds and then stop.
    var done = false;
    function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING && !done) {
            //stopVideo;
            //setTimeout(stopVideo, 6000);
            done = true;
        }
    }
    function stopVideo() {
        player.stopVideo();
    }

</script>
<script src="plugins/Simple-Background-Carousel-Plugin-with-jQuery-and-Animate-css-Crosscover/dist/js/crosscover.js" charset="utf-8"></script>
<script>
    $(document).on('ready', function () {
        $('.crosscover').crosscover({
            dotsNav: false
        });
    });
</script>
<script src="plugins/x-hipster-as-f-cards-v1.1/assets/js/hipster-cards.js" type="text/javascript"></script>
<script src="plugins/Waves-master/dist/waves.min.js" type="text/javascript"></script>
<script src="plugins/odometer-master/odometer.min.js" type="text/javascript"></script>
<script src="plugins/WOW-master/dist/wow.min.js" type="text/javascript"></script>
<!-- For Owl Carousel -->
<script src="plugins/owl.carousel/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        var imageShowCase = $("#imageShowCase");

        imageShowCase.owlCarousel({
            autoPlay: 4000,
            stagePadding: 50,
            loop: true,
            margin: 10,
            stopOnHover: true,
            navigation: false,
            pagination: true,
            paginationSpeed: 1000,
            goToFirstSpeed: 2000,
            singleItem: true,
            autoHeight: true
        });

        // Custom Navigation Events
        $("#ts-next").click(function () {
            imageShowCase.trigger('owl.next');
        })
        $("#ts-prev").click(function () {
            imageShowCase.trigger('owl.prev');
        })

        /*$(".play").click(function () {
         owl.trigger('owl.play', 1000);
         })
         $(".stop").click(function () {
         owl.trigger('owl.stop');
         })
         
         $("#imageShowCase").mouseover(function () {
         $("#ps-next").addClass('active-ps-nav-next');
         $("#ps-prev").addClass('active-ps-nav-prev');
         });
         $("#imageShowCase").mouseout(function () {
         $("#ps-next").removeClass('active-ps-nav-next');
         $("#ps-prev").removeClass('active-ps-nav-prev');
         });*/




        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })

        $(".modal-fullscreen").on('show.bs.modal', function () {
            setTimeout(function () {
                $(".modal-backdrop").addClass("modal-backdrop-fullscreen");
            }, 0);
        });
        $(".modal-fullscreen").on('hidden.bs.modal', function () {
            $(".modal-backdrop").addClass("modal-backdrop-fullscreen");
        });
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
<script src="plugins/x_lbd_free_v1.3/assets/js/pro/bootstrap-selectpicker.js"></script>
<script src="plugins/Countdown/CountDownJS.js"></script>
<script type="text/javascript">

</script>


</html>
