<?php
//    [plugin connection start]
include './cms/plugin.php';
$cms = new plugin();
//    [plugin connection end]
//    [database connection]        
include '././DBconnection/user_signout.php';
//    [database connection]
//    [session start]        
@$_SESSION['USER_DASHBOARD_USER_ID'];
@$user_name = $_SESSION['USER_DASHBOARD_USER_FULLNAME'];
$pageName = $cms->filename();
//    [session start]        
?>
<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/fav1.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<?php
echo $cms->pageTitle("Ticket Chai | Buy Online Ticket...");
?>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

<?php
echo $cms->headCss(array("home"));
?>

        <style type="text/css">
        </style>
    </head>

    <body class="index-page" ng-app="frontEnd" id="indexController" ng-controller="indexController">

        <!--[page loader starts]-->
        <div class="se-pre-con"></div>
        <!--[page loader ends]-->

        <!--[growl mag starts]-->
        <div growl></div>
        <!--[growl mag ends]-->

        <!--[facebook likes starts]-->
<?php echo $cms->FbSocialScript(); ?>
        <!--[facebook likes starts]-->

        <!--[Navbar starts]-->
        <nav id="main-top-nav" class="navbar navbar-transparent navbar-fixed-top navbar-color-on-scroll">
            <div class="container">
                <div id="logo-nav" class="navbar-header">
                    <button type="button" class="navbar-toggle hidden-xs" data-toggle="collapse" data-target="#navigation-index">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!--[Logo]-->
                    <a href="index.php">
                        <div class="logo-container">
                            <div class="logo">
                                <img class="main-logo" src="<?php echo $cms->baseUrl(" assets/img/white-shadow-logo.png "); ?>" alt="Ticketchai Logo" rel="tooltip" title="<b>Ticketchai.com</b>" data-placement="bottom" data-html="true" />
                            </div>
                            <!--<div class="brand">
                               <img src="assets/img/white-shadow-logo.png" alt="Ticketchai Logo" rel="tooltip" title="<b>Ticketchai.com</b>" data-placement="bottom" data-html="true" style="margin-top:-10px;"/>
                            </div>-->
                        </div>
                    </a>
                    <!--[logo]-->
                </div>

                <!--[Collapse Navbar starts]-->
                <div class="collapse navbar-collapse" id="navigation-index">
                    <ul class="nav navbar-nav navbar-right">
                        <!--[Show dashboard starts]-->
                        <li id="login">
<?php
if (isset($_SESSION['USER_DASHBOARD_USER_ID'])) {
    echo "<a href='user_dashboard/dashboard.php' class='btn bxsdw_none' style='color: #ffffff;'><i class='fa fa-dashcube'></i> User DashBoard </a>";
} else {
    echo "";
}
?>
                        </li>
                        <!--[Show dashboard ends]-->

                        <li id="location">
                            <a href="#!" data-toggle="modal" ng-click="GetAllCityInfo()" data-target="#myModal" class="btn bxsdw_none" style="color: #ffffff;">
                                <i class="icon-location icon-2x"></i> <span>{{name}}</span>
                            </a>

                            <!--[City search modal starts]-->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content text-center">
                                        <div id="city-search" class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="dismiss">&times;</button>
                                            <div class="form-group label-floating success">
                                                <label class="control-label">Write Your City Name</label>
                                                <input type="text" class="form-control" ng-model="searchString">
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <h4 class="modal-title" id="myModalLabel">Cities name</h4>
                                            <hr>
                                            <!--[Select city logic starts]-->
                                            <span ng-if="SearchCityController.length != 0" ng-repeat="s in SearchCityController| filter:searchString ">
                                                <a  type="button"  class=" btn btn-danger btn-sm btn-raised margin5" ng-click="selectCity(s.event_id, s.city_name); ShowHide()" >
                                                    {{s.city_name}}
                                                </a>
                                            </span>
                                            <!--[Select city logic ends]-->
                                            <hr>
                                        </div> 

                                        <div class="modal-footer text-center city" style="text-align: center !important; margin-bottom: 15px;">
                                            <!--<button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Close</button>-->
                                            <a href="#cityFeature" id="showCityButton" du-smooth-scroll="hidden" du-scrollspy><button  ng-show="IsVisibleT" type="button"  class="btn btn-success btn-raised">Search Events in <span style="font-style:bold;"> {{name}}</span> City!</button></a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!--[City search modal ends]-->
                        </li>

                        <!--[login and logout button starts]-->
                        <li id="login">
<?php
if (isset($_SESSION['USER_DASHBOARD_USER_ID'])) {
//                                            echo "<a href='$pageName?signout' class='btn bxsdw_none' style='color: #ffffff;'><i class='fa fa-power-off fa-2x'></i> Log Out </a>";
    echo "";
} else {
    echo " <a href='signin.php' class='btn bxsdw_none' style='color: #ffffff;'><i class='icon-lock icon-2x'></i> Log In </a> ";
}
?>
                        </li>
                        <!--[login and logout button ends]-->
                    </ul>
                </div>
                <!--[Collapse Navbar ends]-->

            </div>
        </nav>
        <!--[Navbar ends]-->

        <!--[wrapper class / main class starts]-->
        <div class="wrapper">

            <!--[header part starts]-->
            <div class="header header-filter">
                <div class="crosscover">
                    <div class="crosscover-overlay">
                        <div class="crosscover-island">
                            <span class="crosscover-title"><a href="javascript:void(0);">Create Events and start selling tickets</a></span>
                            <span class="clearfix"></span>
                            <br/>
                            <h4 class="crosscover-description">in less than a minute with Ticketchai</h4>
                            <span class="clearfix"></span>

                            <!--[Create Event button in slider starts]-->
                            <a href="<?php echo $cms->baseUrl(" ../merchant-dashboard/login.php?ref='ok'"); ?>" class="btn btn-danger btn-raised glow">
                                <strong style="font-size:14px; letter-spacing: 1.2px;">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i> Create event
                                </strong>
                            </a>
                            <!--[Create Event button in slider ends]-->

                            <!--[Buy Tickets button in slider starts]-->
                            <a href="javascript:void(0);" class="btn btn-primary btn-raised glow buy_tickets">
                                <strong style="font-size:14px; letter-spacing: 1.2px;">
                                    <i class="fa fa-ticket" aria-hidden="true"></i> Buy Tickets
                                </strong>
                            </a>
                            <!--[Buy Tickets button in slider ends]-->
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 crosscover-caption hidden-xs">
                            <div class="col-sm-8">
                                <p class="padding_top10">Getting registrations for your Treks and Trips is hassle-free with Ticketchai </p>
                            </div>
                            <div class="col-sm-4">
                                <a href="<?php echo $cms->baseUrl(" ../howItWorks.php"); ?>" class="btn btn-raised btn-shiw btn-block btn-sm glow">See How It Works</a>
                            </div>
                        </div>
                    </div>

                    <!--[crosscover-list slider images starts]-->
                    <div class="crosscover-list" id="galleryImage">
                        <div class="crosscover-item">
                            <img class="cb-slideshow1 img-responsive" ng-src="{{defineGalleryItem[0].item}}"  style="display:block !important;"/>
                        </div>
                        <div class="crosscover-item">
                            <img class="cb-slideshow1 img-responsive" ng-src="{{defineGalleryItem[1].item}}"  style="display:block !important;"/>
                        </div>
                        <div class="crosscover-item">
                            <img class="cb-slideshow1 img-responsive" ng-src="{{defineGalleryItem[3].item}}"  style="display:block !important;"/>
                        </div>
                        <div class="crosscover-item">
                            <img class="cb-slideshow1 img-responsive" ng-src="{{defineGalleryItem[4].item}}"  style="display:block !important;"/>
                        </div>
                        <div class="crosscover-item">
                            <img class="cb-slideshow1 img-responsive" ng-src="{{defineGalleryItem[5].item}}"  style="display:block !important;"/>
                        </div>
                        <div class="crosscover-item">
                            <img class="cb-slideshow1 img-responsive" ng-src="{{defineGalleryItem[6].item}}"  style="display:block !important;"/>
                        </div>
                        <div class="crosscover-item">
                            <img class="cb-slideshow1 img-responsive" ng-src="{{defineGalleryItem[7].item}}"  style="display:block !important;"/>
                        </div>
                        <div class="crosscover-item">
                            <img class="cb-slideshow1 img-responsive" ng-src="{{defineGalleryItem[8].item}}"  style="display:block !important;"/>
                        </div>
                        <div class="crosscover-item">
                            <img class="cb-slideshow1 img-responsive" ng-src="{{defineGalleryItem[9].item}}"  style="display:block !important;"/>
                        </div>
                    </div>
                    <!--[crosscover-list slider images ends]-->
                </div>
            </div>
            <!--[header part ends]-->

            <!--[main body part starts]-->
            <div class="main">

                <!--[LOOKING FOR A NEW EXPERIENCE nav starts]-->
                <nav id="second-top-nav" class="navbar navbar-success margin-bottom-0" role="navigation" style="overflow-y: visible !important;">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#search-nav">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a id="search-label2" class="navbar-brand bold h3-responsive visible-xs text-cente" href="#"><i class="fa fa-ticket" aria-hidden="true">&nbsp;</i> Search Events</a>
                            <a id="site-logo" href="index.php" style="display: none;">
                                <div class="logo-container">
                                    <div class="logo">
                                        <img class="main-logo" src="tc-merchant-template/assets/img/white-shadow-logo.png" alt="Ticketchai Logo" rel="tooltip" title="<b>Ticketchai.com</b>" data-placement="bottom" data-html="true" />
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="collapse navbar-collapse" id="search-nav">
                            <ul id="homepage-nav-2" class="nav navbar-nav navbar-right" style="margin:0 auto;">
                                <li id="search-labelt" class="text-center hidden-sm hidden-xs">
                                    <a href="#!" class="navbar-brand bold h4-responsive">LOOKING FOR A NEW EXPERIENCE ?</a>
                                </li>

                                <!--[Search event starts]-->
                                <li id="home-nav-search" class="text-center hidden-sm">
                                    <div class="home-search-section col-xs-12">
                                        <div class="form-group has-success">
                                            <form id="search">
                                                <input name="control" id="home-search" type="text" placeholder="Search for an Event"  class="form-control form--inverted control"  ng-model="EventHint" ng-change="searchEvent()">
                                                <span class="form-control-feedback" >
                                                    <i class="fa fa-search text-white" style="margin-top:15px !important;"></i>
                                                </span>
                                            </form>
                                        </div>
                                        <div id="rslt-div" class="list-group show_hide" style="box-shadow: none; max-width: 190px !important;">
                                            <ul class="" style="margin-top:50px !important; background:#88C659 !important; width:100%; height:auto; color:black; clear: both; border: 1px solid #ffffff;" id="results">

                                                <li ng-repeat="x in s = (searchResult| filter: EventHint | limitTo:7 |  orderBy: DESC)" ng-if="EventHint.length > 2">
                                                    <a href="checkout1.php?id={{x.event_id}}" class="list-group-item" style="margin-bottom: -5px !important;">
                                                        <span>{{x.event_title.length > '25' ? (x.event_title | limitTo:20) + '..' : x.event_title}}</span>
                                                    </a>
                                                </li>
                                                <li  ng-if="EventHint.length < 3">
                                                    <a href="javascript:void(0);" class="list-group-item" style="max-width: 185px !important;">
                                                        <span>Please Wait</span>
                                                        <img src="<?php echo $cms->baseUrl("assets/img/small.gif "); ?>" alt="Loading ..." />
                                                    </a>
                                                </li>

                                                <li ng-if="s.length === 0">
                                                    <a href="javascript:void(0);" class="list-group-item" style="max-width: 185px !important;">
                                                        <span>No Event Found As {{EventHint}}</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <!--[Search event ends]-->

                                <!--[Navbar categories starts]-->
                                <li class="text-center single-nav" ng-repeat="x in element| limitTo:4">
                                    <a class="text-primary" href="{{x.category_title| lowercase}}.php?page_id={{x.category_id}}" ><i class="icon-calendar icon-2x nav-icon"></i> {{x.category_title}}</a>
                                </li>
                                <li class="dropdown text-center" >
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="more">More <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li ng-repeat="x in element.slice(4)"><a href="{{x.category_title| lowercase}}.php?page_id={{x.category_id}}">{{x.category_title}}</a></li>
                                    </ul>
                                </li>
                                <!--[Navbar categories ends]-->
                                <li id="create-event" class="text-center single-nav hidden-sm" style="display: none;">
                                    <a href="<?php echo $cms->baseUrl(" ../merchant-dashboard/login.php?ref='ok'"); ?>"><i class="fa fa-paper-plane" aria-hidden="true"></i> Create event</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <!--[LOOKING FOR A NEW EXPERIENCE nav ends]-->

                <!--[Core panel starts]-->

                <!--[Hidden Core panel starts / Core panel for city wise search starts]-->
                <div id="hidden"> </div>
                <div style="display:none;" id="hiddenPart" >

                    <!--[Featured events starts]-->
                    <div>
                        <div class="section section-featured" id="cityFeature">
                            <div class="container">
                                <div class="row section_padd60 ">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-heading">
                                        <h2><span class="section-topic">Featured</span> Events</h2>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-content section_padd30 animated wow fadeIn" data-wow-duration="1s" >
                                        <div class="card-box col-md-3 col-sm-6 col-xs-12" ng-repeat="fx in d| limitTo : 8 ">
                                            <div class="card">
                                                <div class="header">
                                                    <img class="ch-image" src="upload/event_web_logo/{{fx.event_web_logo}}" />
                                                    <div class="filter"></div>
                                                    <div class="category">
                                                        <span class="category-label label label-info">{{fx.event_type_tag}}</span>
                                                    </div>

                                                    <div class="actions">
                                                        <a href="event_tickets.php?id={{fx.event_id}}" class="btn btn-success btn-raised btn-round">
                                                            <i class="fa fa-cart-plus" aria-hidden="true">&nbsp;</i> {{btn_buy}}
                                                        </a>
                                                    </div>

                                                    <div class="social-line" data-buttons="3">
                                                        <button class="btn btn-social btn-facebook">
                                                            <i class="fa fa-facebook-square">&nbsp;</i>{{btn_fb}}
                                                        </button>
                                                        <button class="btn btn-social btn-twitter">
                                                            <i class="fa fa-twitter-square">&nbsp;</i>{{btn_tw}}
                                                        </button>
                                                        <button class="btn btn-social btn-google">
                                                            <i class="fa fa-google-plus-square">&nbsp;</i>{{btn_g}}
                                                        </button>
                                                    </div>
                                                </div>   

                                                <div class="content" style="height: 200px !important;">
                                                    <h6 class="title bold" style="font-size:12px !important;"><a class="glow2" href="#">{{fx.event_title.length > '25' ? (fx.event_title | limitTo:20) + '..' : fx.event_title}}</a></h6>
                                                    <hr>
                                                    <p class="description">
                                                        <span class="margin5 text-danger bold"><i class="fa fa-map-marker" aria-hidden="true">&nbsp;</i> {{fx.venue_title}}</span>
                                                    </p>
                                                    <p class="description">
                                                        <span class="margin5 text-primary bold"><i class="fa fa-calendar" aria-hidden="true">&nbsp;</i> {{fx.venue_start_date}} - {{fx.venue_end_date}}</span>
                                                    </p>
                                                    <p class="description">
                                                        <span class="margin5 text-warning bold"><i class="fa fa-clock-o" aria-hidden="true">&nbsp;</i> {{fx.venue_start_time}} - {{fx.venue_end_time}}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 col-lg-offset-5 col-md-offset-5 col-sm-offset-4 section-footer text-center section_padd60">
                                        <a href="more_featured_events.php"><button type="button" class="btn btn-block success-rounded-outline waves-effect"><i class="fa fa-arrow-circle-o-down" aria-hidden="true">&nbsp;</i> {{btn_viewMore}}</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--[Featured events ends]-->

                    <div class="clearfix"></div>

                    <!--[Covered events starts]-->
                    <div>
                        <div class="section section-featured">
                            <div class="container">
                                <div class="row section_padd60 ">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-heading">
                                        <h2><span class="section-topic">{{covered}}</span> {{events}}</h2>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-content section_padd30 animated wow fadeIn" data-wow-duration="1s" >
                                        <div class="card-box col-md-3 col-sm-6 col-xs-12" ng-repeat="cx in c| limitTo:4">
                                            <div class="card hm-zoom">
                                                <div class="view overlay hm-white-slight">
                                                    <img src="upload/event_web_logo/{{cx.event_web_logo}}" class="img-fluid mdbc-img" alt="">
                                                    <a>
                                                        <div class="mask"></div>
                                                    </a>
                                                </div>

                                                <!--[Social Icons]-->
                                                <!--  <div class="card-share">
                                                    <div class="social-reveal">
                                                        Facebook
                                                        <a href="javascript:void(0);" class="btn-floating btn-fb"><i class="fa fa-facebook"></i></a>
                                                        Twitter
                                                        <a href="javascript:void(0);" class="btn-floating btn-tw"><i class="fa fa-twitter"></i></a>
                                                        Google 
                                                        <a href="javascript:void(0);" class="btn-floating btn-gplus"><i class="fa fa-google-plus"></i></a>
                                                    </div>
                                                    <a class="btn-floating btn-action share-toggle primary-color-dark"><i class="fa fa-share-alt"></i></a>
                                                </div>-->
                                                <!--[Social Icons]-->

                                                <div class="content" style="height:200px;">
                                                    <h6 class="title bold"><a href="#">{{cx.event_title| limitTo : 100}}</a> 
                                                        <span class="category-label badge badge-primary">{{cx.event_type_tag}}</span></h6>
                                                    <hr>
                                                    <!--<a href="event_tickets.php?c_id={{cx.event_id}}" class="btn success-rounded-outline btn-block waves-effect">Read More <i class="fa fa-arrow-circle-o-right" aria-hidden="true">&nbsp;</i></a>-->
                                                    <a href="event_tickets.php?id={{cx.event_id}}" class="btn success-rounded-outline btn-block waves-effect">Read More <i class="fa fa-arrow-circle-o-right" aria-hidden="true">&nbsp;</i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 col-lg-offset-5 col-md-offset-5 col-sm-offset-4 section-footer text-center section_padd60">
                                        <a href="more_covered_events.php"><button type="button" class="btn btn-block success-rounded-outline waves-effect"><i class="fa fa-arrow-circle-o-down" aria-hidden="true">&nbsp;</i> {{btn_viewMore}}</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--[Covered events ends]-->

                    <div class="clearfix"></div>

                    <!--[Upcoming events starts]-->
                    <div>
                        <div class="section section-featured">
                            <div class="container">
                                <div class="row section_padd30 ">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-heading animated wow fadeIn" data-wow-duration="1s" data-wow-delay="0.02s">
                                        <h2><span class="section-topic">Upcoming</span> Events</h2>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-content section_padd30 animated wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.02s" id="social-reveal">
                                        <div class="card-box col-md-3 col-sm-6 col-xs-12" ng-repeat="ux in u| limitTo:4">
                                            <div class="card collection-card" >
                                                <div class="view  hm-zoom" >
                                                    <img src="upload/event_web_logo/{{ux.event_web_logo}}" class="img-fluid mdbpc-img" alt="">
                                                    <div class="stripe dark" >
                                                        <h6 class="title bold"><a href="#" class="glow txt_sdw2">{{ux.event_title}}</a></h6>
                                                        <!--<a href="event_tickets.php?up_id={{ux.event_id}}" class="btn btn-success btn-raised btn-round waves-effect txt-white">More Info <i class="fa fa-chevron-right"></i></a>-->
                                                        <a href="event_tickets.php?id={{ux.event_id}}" class="btn btn-success btn-raised btn-round waves-effect txt-white">More Info <i class="fa fa-chevron-right"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 col-lg-offset-5 col-md-offset-5 col-sm-offset-4 section-footer text-center section_padd60">
                                        <a href="more_upcoming_events.php"><button type="button" class="btn btn-block success-rounded-outline waves-effect"><i class="fa fa-arrow-circle-o-down" aria-hidden="true">&nbsp;</i> View More</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--[Upcoming events ends]-->
                    <div class="clearfix"></div>
                </div>
                <!--[Hidden Core panel starts / Core panel for city wise search ends]-->  

                <!--[First shown Core panel starts]-->
                <div id="showPart">

                    <!--[Featured events starts]-->
                    <div class="section section-featured">
                        <div class="container">
                            <div class="row section_padd60 ">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-heading">
                                    <h2><span class="section-topic">Featured</span> Events</h2>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-content section_padd30 animated wow fadeIn" data-wow-duration="1s" >
                                    <div class="card-box col-md-3 col-sm-6 col-xs-12" ng-repeat="x in featuredEvents| limitTo : 8 ">
                                        <div class="card" ng-init="InitCrtHpST()">
                                            <div class="header">
                                                <img class="ch-image" src="upload/event_web_logo/{{x.event_web_logo}}" />
                                                <!--<div class="filter"></div>-->
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
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 col-lg-offset-5 col-md-offset-5 col-sm-offset-4 section-footer text-center section_padd60">
                                    <a href="more_featured_events.php"><button type="button" class="btn btn-block success-rounded-outline waves-effect"><i class="fa fa-arrow-circle-o-down" aria-hidden="true">&nbsp;</i> {{btn_viewMore}}</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--[Featured events ends]-->

                    <div class="clearfix"></div>

                    <!--[Covered events starts]-->
                    <div class="section section-featured">
                        <div class="container">
                            <div class="row section_padd60 ">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-heading">
                                    <h2><span class="section-topic">{{covered}}</span> {{events}}</h2>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-content section_padd30 animated wow fadeIn" data-wow-duration="1s" >

                                    <div class="card-box col-md-3 col-sm-6 col-xs-12" ng-repeat="x in coveredEvents| limitTo:4">
                                        <div class="card hm-zoom">
                                            <div class="view overlay hm-white-slight">
                                                <img src="upload/event_web_logo/{{x.event_web_logo}}" class="img-fluid mdbc-img" alt="">
                                                <a>
                                                    <div class="mask"></div>
                                                </a>
                                            </div>
                                            <!--[Social buttons]-->
                                            <!--<div class="card-share">
                                                <div class="social-reveal">
                                                    Facebook
                                                    <a href="javascript:void(0);" class="btn-floating btn-fb"><i class="fa fa-facebook"></i></a>
                                                    Twitter
                                                    <a href="javascript:void(0);" class="btn-floating btn-tw"><i class="fa fa-twitter"></i></a>
                                                    Google 
                                                    <a href="javascript:void(0);" class="btn-floating btn-gplus"><i class="fa fa-google-plus"></i></a>
                                                </div>
                                                <a class="btn-floating btn-action share-toggle primary-color-dark"><i class="fa fa-share-alt"></i></a>
                                            </div>-->
                                            <!--[Social buttons]-->

                                            <div class="content" style="height:200px;">
                                                <h6 class="title bold"><a href="#">{{x.event_title| limitTo : 100}}</a> 
                                                    <span class="category-label badge badge-primary">{{x.event_type_tag}}</span></h6>
                                                <hr>
                                                <!--<a href="checkout1.php?c_id={{x.event_id}}" class="btn success-rounded-outline btn-block waves-effect">Read More <i class="fa fa-arrow-circle-o-right" aria-hidden="true">&nbsp;</i></a>-->
                                                <a href="checkout1.php?c_id={{x.event_id}}" class="btn success-rounded-outline btn-block waves-effect">Read More <i class="fa fa-arrow-circle-o-right" aria-hidden="true">&nbsp;</i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 col-lg-offset-5 col-md-offset-5 col-sm-offset-4 section-footer text-center section_padd60">
                                    <a href="more_covered_events.php"><button type="button" class="btn btn-block success-rounded-outline waves-effect"><i class="fa fa-arrow-circle-o-down" aria-hidden="true">&nbsp;</i> {{btn_viewMore}}</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--[Covered events ends]-->

                    <div class="clearfix"></div>

                    <!--[Upcoming events starts]-->
                    <!--                                        <div class="section section-featured">
                                                                <div class="container">
                                                                    <div class="row section_padd30 ">
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-heading animated wow fadeIn" data-wow-duration="1s" data-wow-delay="0.02s">
                                                                            <h2><span class="section-topic">Upcoming</span> Events</h2>
                                                                        </div>
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-content section_padd30 animated wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.02s" id="social-reveal">
                                                                            <div class="card-box col-md-3 col-sm-6 col-xs-12" ng-repeat="x in upcomingEvents2| limitTo:4">
                                                                                <div class="card collection-card" >
                                                                                    <div class="view  hm-zoom" >
                                                                                        <img src="upload/event_web_logo/{{x.event_web_logo}}" class="img-fluid mdbpc-img" alt="">
                                                                                        <div class="stripe dark" >
                                                                                            <h6 class="title bold"><a href="#" class="glow txt_sdw2">{{x.event_title}}</a></h6>
                                                                                            <a href="checkout1.php?up_id={{x.event_id}}" class="btn btn-success btn-raised btn-round waves-effect txt-white">More Info <i class="fa fa-chevron-right"></i></a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="clearfix"></div>
                                                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 col-lg-offset-5 col-md-offset-5 col-sm-offset-4 section-footer text-center section_padd60">
                                                                            <a href="more_upcoming_events.php"><button type="button" class="btn btn-block success-rounded-outline waves-effect"><i class="fa fa-arrow-circle-o-down" aria-hidden="true">&nbsp;</i> View More</button></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>-->
                    <!--[Upcoming events ends]-->

                    <!--[Popular events starts]-->
                    <div class="section section-featured">
                        <div class="container">
                            <div class="row section_padd30 ">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-heading animated wow fadeIn" data-wow-duration="1s" data-wow-delay="0.02s">
                                    <h2><span class="section-topic">Popular</span> Events</h2>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-content section_padd30 animated wow fadeIn" data-wow-duration="1s" >
                                    <div class="card-box col-md-3 col-sm-6 col-xs-12" ng-repeat="x in upcomingEvents2| limitTo:4">
                                        <div class="card" ng-init="InitCrtHpST()">
                                            <div class="header">
                                                <img class="ch-image" src="upload/event_web_logo/{{x.event_web_logo}}" />
                                                <!--<div class="filter"></div>-->
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
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 col-lg-offset-5 col-md-offset-5 col-sm-offset-4 section-footer text-center section_padd60">
                                    <a href="more_upcoming_events.php"><button type="button" class="btn btn-block success-rounded-outline waves-effect"><i class="fa fa-arrow-circle-o-down" aria-hidden="true">&nbsp;</i> View More</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--[Popular events ends]-->

                </div>
                <!--[First shown Core panel ends]-->

                <!--[Core panel ends]-->

                <div class="clearfix"></div>      

                <!--[Clients opinion starts]-->
                <div class="section section-testimonial">
                    <div class="container">
                        <div class="row section_padd30 ">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-heading animated wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.02s">
                                <h2>{{our_c}} <span class="section-topic">{{customar_say}}</span></h2>
                            </div>


                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-content section_padd30">
                                <div class="carousel slide" data-ride="carousel" id="quote-carousel">
                                    <!-- Bottom Carousel Indicators -->
                                    <ol class="carousel-indicators hidden-xs animated wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.02s" style="top: 265px !important;">
                                        <li data-target="#quote-carousel" data-slide-to="0" class="active" ng-repeat="tes in testimonialController| limitTo : 1"><img class="img-responsive" src="tc-merchant-template/assets/img/{{tes.photo}}" alt=""></li>
                                        <li data-target="#quote-carousel" data-slide-to="1" ng-repeat="tes in testimonialController| limitTo : 10:1"><img class="img-responsive" src=" tc-merchant-template/assets/img/{{tes.photo}}" alt=""></li>

                                    </ol>
                                    <div class="carousel-inner text-center animated wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.02s">
                                        <div class="item active"  ng-repeat="tes in testimonialController| limitTo: 1">
                                            <blockquote>
                                                <div class="row">
                                                    <div class="col-sm-8 col-sm-offset-2">
                                                        <p>{{tes.testimonial_des}}</p>
                                                        <small>{{tes.clients_name}}</small>
                                                    </div>
                                                </div>
                                            </blockquote>
                                        </div>
                                        <div class="item" title="Demo Testimonial" ng-repeat="tes in testimonialController| limitTo : 10:1">
                                            <blockquote>
                                                <div class="row">
                                                    <div class="col-sm-8 col-sm-offset-2">
                                                        <p>{{tes.testimonial_des}}</p>
                                                        <small>{{tes.clients_name}}</small>
                                                    </div>
                                                </div>
                                            </blockquote>
                                        </div>
                                    </div>
                                    <a data-slide="prev" href="#quote-carousel" class="left carousel-control"><i class="fa fa-chevron-left"></i></a>
                                    <a data-slide="next" href="#quote-carousel" class="right carousel-control"><i class="fa fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--[Clients opinion ends]-->

                <div class="clearfix"></div>

                <!--[Clients logo starts]-->
                <div class="section section-clients">
                    <div class="container">
                        <div class="row section_padd30 padd_btm_30">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-heading animated wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.02s">
                                <h2>
                                    {{clients}} <span class="section-topic">{{clients1}}</span><br/>
                                    <small>{{client_span}}</small>
                                </h2>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-content section_padd30 animated wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.02s">
                                <div class="col-md-12">
                                    <div class="well">
                                        <div id="myCarousel" class="carousel slide">
                                            <div class="carousel-inner">
                                                <div class="item active" >
                                                    <div class="row">
                                                        <div class="col-sm-2 col-xs-6"  ng-repeat="c in clientsController| limitTo : 6"><a href="#x"><img src="tc-merchant-template/assets/img/clients/{{c.clients_image}}" alt="Image" class="img-responsive"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item" >
                                                    <div class="row" >
                                                        <div class="col-sm-2  col-xs-6" ng-repeat="c in clientsController| limitTo : 20 : 6"><a href="#x"><img src="tc-merchant-template/assets/img/clients/{{c.clients_image}}" alt="Image" class="img-responsive"></a>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
                                            <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--[Clients logo ends]-->

                <!--[How Ticketchai Works starts]-->
                <div class="section section-testimonial see_how_it_work_sec">
                    <div class="container">
                        <div class="row section_padd30 padd_btm_30">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-heading animated wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.02s">
                                <h2>
                                    {{HTW}} <span class="section-topic">{{HTW1}}</span> ?<br/>
                                </h2>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-content section_padd30 animated wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.02s">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center ticketchai-steps">
                                    <img class="img-responsive" src="tc-merchant-template/assets/img/ts_step_01.png" alt="3" />
                                    <br/>
                                    <p class="tcinfo-grid">
                                        <span class="tcinfo-hw">{{CEPE}}</span>
                                    </p>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center ticketchai-steps">
                                    <img class="img-responsive" src="tc-merchant-template/assets/img/ts_step_03.png" alt="3" />
                                    <br/>
                                    <p class="tcinfo-grid">
                                        <span class="tcinfo-hw">{{sell_ticket}}</span>
                                    </p>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center ticketchai-steps">
                                    <img class="img-responsive" src="tc-merchant-template/assets/img/ts_step_4.png" alt="3" />
                                    <br/>
                                    <p class="tcinfo-grid">
                                        <span class="tcinfo-hw">{{manage_text}}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 col-lg-offset-5 col-md-offset-5 col-sm-offset-4 section-footer text-center section_padd60">
                                <a href="<?php echo $cms->baseUrl(" ../howItWorks.php"); ?>">
                                    <button type="button" class="btn btn-block success-rounded-outline waves-effect">{{btn_learnMore}} &nbsp;<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--[How Ticketchai Works ends]-->

                <!--[Ticketchai growing starts]-->
                <div class="section section-tcinfo hidden-xs">
                    <div class="container">
                        <div class="row section_padd30">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-heading">
                                <h2><span class="section-topic-ol">{{we_g}}</span></h2>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-content section_padd30">
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <h2 class="tcinfo-grid">
                                        <span id="odometer1" class="tcinfo-qty odometer odometer-theme-default" data-theme="default">0</span>
                                        <br/>
                                        <small class="tcinfo-head">{{city}}</small>
                                    </h2>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <h2 class="tcinfo-grid">
                                        <span id="odometer2" class="tcinfo-qty odometer odometer-theme-default" data-theme="default">0</span>
                                        <br/>
                                        <small class="tcinfo-head">{{organizers}}</small>
                                    </h2>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <h2 class="tcinfo-grid">
                                        <span id="odometer3" class="tcinfo-qty odometer odometer-theme-default" data-theme="default">0</span>
                                        <br/>
                                        <small class="tcinfo-head">{{events_created}}</small>
                                    </h2>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <h2 class="tcinfo-grid">
                                        <span id="odometer4" class="tcinfo-qty odometer odometer-theme-default" data-theme="default">0</span>
                                        <br/>
                                        <small class="tcinfo-head">{{registrations}}</small>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--[Ticketchai growing ends]-->

                <!--[Ticketchai simple section starts]-->
                <div class="section section-simple">
                    <div class="container">
                        <div class="row section_padd30">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-heading">
                                <h2>{{feeling}} <span class="section-topic">{{interested}}</span> {{about_us}}</h2>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-content section_padd30 text-center">
                                <!--<button type="button" class="btn btn-success-outline waves-effect">Create Event - It's Free!</button>-->
                                <a href="<?php echo $cms->baseUrl(" ../merchant-dashboard/login.php?ref='ok'"); ?>" class="btn btn-danger btn-raised glow">
                                    <strong style="font-size:14px; letter-spacing: 1.2px;">
                                        <i class="fa fa-paper-plane" aria-hidden="true">&nbsp;</i> {{create_freeEvent}}
                                    </strong>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>


                <!--[Load section starts]-->
                <span id="LoadFeatureInfong" ng-click="LoadFeatureInfo()"></span>
                <span id="clientsInfong" ng-click="clientsInfo()"></span>
                <span id="GetTestimonialng" ng-click="GetTestimonial()"></span>
                <span id="LoadCoveredEventsng" ng-click="LoadCoveredEvents()"></span>
                <span id="LoadUpcomingEventsng" ng-click="LoadUpcomingEvents()"></span>
                <!--[Load section ends]-->

                <div class="section section-simple-close">
                    <div class="container">
                        <div class="row section_padd30">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-heading"></div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-content section_padd30 text-center"></div>
                        </div>
                    </div>
                </div>
                <!--[Ticketchai simple section ends]-->
            </div>
            <!--[main body part ends]-->

            <!--[Footer starts]-->
<?php include 'include/footer.php'; ?>
            <!--[Footer ends]-->
        </div>
        <!--[wrapper class / main class ends]-->
        <div class="clearfix"></div>

        <!--[angular and footer js starts]-->    
<?php
echo $cms->angularJs(array("index"));
echo $cms->fotterJs(array("home"));
?>
        <!--[angular and footer js ends]--> 
        <script src="tc-merchant-template/assets/js/angular-scroll.js"></script>
        <!--[city wise event search js starts]-->    
    <!--        <script>
                $(document).ready(function(){
                    $("#showCityButton").on('click', function(event) {
                        if (this.hash !== "") {
                            event.preventDefault();
                                    var hash = this.hash;
                                    $('html, body').animate({
                                      scrollTop: $(hash).offset().top
                                    }, 800, function(){
                            window.location.hash = hash;
                            });
                        }
                    });
                });
            </script>-->
        <!--[city wise event search js ends]--> 

        <!--[showCityButton action js starts]--> 
        <script type="text/javascript">
            $(document).ready(function () {
            $('#showCityButton').click(function () {
            $('#dismiss').click();
                    $('#showPart').hide();
                    $('#hiddenPart').show();
            });
            });
        </script>
        <!--[showCityButton action js ends]-->     

        <!--[Buy ticket action js starts]-->     
        <script>
                            $(document).ready(function () {
                    $(".buy_tickets").click(function () {
                    $('html,body').animate({
                    scrollTop: $("#showPart").offset().top},
                            'slow');
                    });
                    });        </script>
        <!--[Buy ticket action js ends]-->

        <!--[See how it work action js starts]-->
        <script>
                            $(document).ready(function () {
                    $(".see_how_it_work").click(function () {
                    $('html,body').animate({
                    scrollTop: $(".see_how_it_work_sec").offset().top},
                            'slow');
                    });
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
                    });        </script>
        <!--[See how it work action js ends]-->  

        <!--[myCarousel action js starts]--> 
        <script>
                            new WOW().init();
                            $(document).ready(function () {
                    $('#myCarousel').carousel({
                    interval: 10000
                    })

                            $('#myCarousel').on('slid.bs.carousel', function () {
                    //alert("slid");
                    });
                    });        </script>
        <!--[myCarousel action js ends]-->  

        <!--[owlCarousel action js starts]--> 
        <script>
                            $(document).ready(function () {

                    var owl = $("#owl-demo");
                            owl.owlCarousel({
                            items: 5, //10 items above 1000px browser width
                                    itemsDesktop: [1000, 4], //5 items between 1000px and 901px
                                    itemsDesktopSmall: [900, 3], // betweem 900px and 601px
                                    itemsTablet: [600, 2], //2 items between 600 and 0
                                    itemsMobile: [300, 1], // itemsMobile disabled - inherit from itemsTablet option
                                    autoPlay: 4000,
                                    pagination: false,
                                    //navigation:true
                            });
                            // Custom Navigation Events
                            $(".next").click(function () {
                    owl.trigger('owl.next');
                    });
                            $(".prev").click(function () {
                    owl.trigger('owl.prev');
                    });
                            $("#owl-demo").mouseover(function () {
                    $(".next").addClass('active-prev');
                            $(".prev").addClass('active-next');
                    });
                            $("#owl-demo").mouseout(function () {
                    $(".next").removeClass('active-prev');
                            $(".prev").removeClass('active-next');
                    });
                            $(function () {
                            $('[data-toggle="tooltip"]').tooltip()
                            })
                    });        </script>
        <!--[owlCarousel action js ends]--> 

        <!--[materialKit scroll action js starts]-->
        <script type="text/javascript">
                            $(document).ready(function () {
                    //materialKit.initSliders();
                    $(window).on('scroll', materialKit.checkScrollForTransparentNavbar);
                            window_width = $(window).width();
                            if (window_width >= 768) {
                    big_image = $('.wrapper > .header');
                            $(window).on('scroll', materialKitDemo.checkScrollForParallax);
                    }

                    });        </script>
        <!--[materialKit scroll action js ends]--> 

        <!--[page animation action js starts]-->
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
                            }, 1000);        </script>
        <!--[page animation action js ends]-->    

        <!--[LoadCoveredEventsng action js starts]-->       
        <script type="text/javascript">
                            var scrval = 0;
                            $(window).bind("load", function() {
                    setTimeout(function(){
                    $("#LoadFeatureInfong").click();
                            $("#LoadCoveredEventsng").click();
                    }, 500);
                            setTimeout(function(){
                            $("#clientsInfong").click();
                                    $("#GetTestimonialng").click();
                                    $("#LoadUpcomingEventsng").click();
                            }, 4000);
                            setTimeout(function(){
                            var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
                                    (function(){
                                    var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
                                            s1.async = true;
                                            s1.src = 'https://embed.tawk.to/5882fb625e5821218b487f14/default';
                                            s1.charset = 'UTF-8';
                                            s1.setAttribute('crossorigin', '*');
                                            s0.parentNode.insertBefore(s1, s0);
                                    })();
                            }, 10000);
                    });        </script>
        <!--[LoadCoveredEventsng action js ends]-->      

    </body>
</html>