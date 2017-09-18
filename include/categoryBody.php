<!--[page loader start]-->
        <div class="se-pre-con"></div>
        <!--[page loader end]-->

        <!--[navbar start]-->
        <?php include 'include/navbar.php'; ?>
        <!--[navbar end]-->

        <!--[auto click for page data start]-->
        <?php
        @$page_id = $_GET['page_id'];
        echo '<span id="autoclick2" ng-click="bennerData(' . $page_id . ')"></span> ';
        if (!empty($page_id)) {

            echo '<span id="autoclick" ng-click="categoryData(' . $page_id . ')"></span>';
        } else {
            
        }
        ?>
        <!--[auto click for page data start]-->

        <div class="clearfix"></div>

        <!--[warpper class start]-->
        <div class="wrapper" >

            <!--[growl show message start]-->
            <div growl></div>
            <!--[growl show message ends]-->

            <!--[for facebook like starts]-->
            <?php echo $cms->FbSocialScript(); ?>
            <!--[for facebook like starts]-->

            <!--[main content part starts]-->
            <div class="main" style="background-color: transparent; margin-top:70px !important;" >

                <!--[banner Carousel Starts]-->
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-top-20">

                            <!--[Carousel Wrapper Starts]-->
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators hidden-xs">
                                    <li class="active" data-target="#carousel-example-generic" ng-repeat="banner in bannerValue1| limitTo : 1" data-slide-to="0"></li>
                                    <li class="active" data-target="#carousel-example-generic" ng-repeat="banner in bannerValue1| limitTo : 4 : 1" data-slide-to="0"></li>
                                </ol>
                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" role="listbox" >
                                    <div class="item active" ng-repeat="banner in bannerValue1| limitTo:1">
                                        <!--<img src="upload/event_web_banner/{{banner.event_web_banner}}" class="img-fluid img-responsive carousel-img-bd" style="width:100%; max-height: 350px;">-->
                                        <img src="upload/event_web_banner/{{banner.banner}}" class="img-fluid img-responsive carousel-img-bd" style="width:100%; max-height: 350px;">
                                        <div class="carousel-caption">
                                            {{banner.event_title}}
                                        </div>
                                    </div>

                                    <div class="item" ng-repeat="banner in bannerValue1| limitTo: 4 : 1">
                                        <img src="upload/event_web_banner/{{banner.banner}}" class="img-fluid img-responsive carousel-img-bd" style="width:100%; max-height: 350px;">
                                        <div class="carousel-caption">
                                            {{banner.event_title}}
                                        </div>
                                    </div>
                                </div>
                                <!-- Controls -->

                                <!--[Sorry msg start]-->
                                <div  class="col-md-12 col-sm-12" ng-if="bannerValue1.length == 0" style="">
                                    <div class="event-content">
                                        <h4 class="panel-title h4-responsive padding-10" style="text-align: center;">Sorry! No Banner Found.</h4>
                                    </div>
                                </div>
                                <!--[Sorry msg end]-->

                                <a class="left carousel-control hidden-xs" href="#carousel-example-generic" role="button" data-slide="prev" style="color: #88C659 !important;">
                                    <span class="icon-prev" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control hidden-xs" href="#carousel-example-generic" role="button" data-slide="next" style="color: #88C659 !important;">
                                    <span class="icon-next" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                            <!--[Carousel Wrapper End]-->

                            <div class="clearfix"></div>

                            <!--[Search Navigation Starts]-->
                            <nav class="navbar navbar-success margin-top-15" role="navigation">
                                <div class="container">
                                    <div class="navbar-header">
                                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#search-nav">
                                            <span class="sr-only">Toggle navigation</span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                        </button>
                                        <a class="navbar-brand bold h4-responsive visible-xs text-cente" href="order.php"><i class="fa fa-ticket" aria-hidden="true">&nbsp;</i> {{buyTickets}}</a>
                                    </div>

                                    <div class="collapse navbar-collapse" id="search-nav">
                                        <ul class="nav navbar-nav">
                                            <div class="col-md-4 col-sm-12 col-xs-12 text-center hidden-xs">
                                                <li class="text-center">
                                                    <a class="navbar-brand bold h4-responsive" href="order.php"><i class="fa fa-ticket" aria-hidden="true">&nbsp;</i> {{buy_eventTickets}}</a>
                                                </li>
                                            </div>
                                            <style type="text/css">
                                                select option:empty { display:none }
                                            </style>
                                            <div class="col-md-3 col-sm-12 col-xs-12 text-center">
                                                <li>
                                                    <select ng-model="cID" class="form-control filter-select">
                                                        <option  value="">SELECT LOCATION</option>
                                                        <!--<option ng-repeat="s in AllCity" value="{{s.city_id}}">{{s.city_name}}</option>-->
                                                        <option ng-repeat="s in AllCity" value="{{s.city_name}}">{{s.city_name}}</option>
                                                    </select>
                                                </li>
                                            </div>
                                            <div class="col-md-3 col-sm-12 col-xs-12 text-center">
                                                <li>
                                                    <select ng-model="catId" class="form-control filter-select">
                                                        <option value="">SELECT CATEGORY</option>
                                                        <option ng-repeat="s in element" value="{{s.category_id}}">{{s.category_title}}</option>
                                                    </select>
                                                </li>
                                            </div>
                                            <div class="col-md-2 col-sm-12 col-xs-12 text-center">
                                                <li>
                                                    <a id="search" du-smooth-scroll="s" href="javascript:void(0);" class="btn btn-nav-search"
                                                       ng-click="getEventByKeyword(cID, catId)" >
                                                        <i class="fa fa-search" aria-hidden="true">&nbsp;</i> Search
                                                    </a>
                                                </li>
                                            </div>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                            <!-- Search Navigation Ends Here -->
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!--[banner Carousel Ends]-->

                <div id="s" class="clearfix"></div>

                <!--[search result panel starts]-->
                <div  style="display: none;" id="searchEvent">
                    <h2>Search Result</h2>
                    <div>
                        <div class="container">
                            <div class="row section_padd20 ">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-content section_padd30 animated wow fadeIn" data-wow-duration="1s" >

                                    <!--[single card starts]-->
                                    <div class="card-box col-md-3 col-sm-6 col-xs-12" ng-repeat="x in searchResult">
                                        <div class="card" >
                                            <div class="header">
                                                <img alt="Sorry  Logo missing" class="ch-image" src="upload/event_web_logo/{{x.event_web_logo}}" />
                                                <div class="category">
                                                    <span class="category-label label label-info">{{x.event_type_tag}}</span>
                                                </div>

                                                <div class="actions">
                                                    <a href="checkout1.php?id={{x.event_id}}" class="btn btn-success btn-raised btn-round">
                                                        <i class="fa fa-cart-plus" aria-hidden="true">&nbsp;</i> {{x.btn_name}}
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
                                                <h6 class="title bold" style="font-size:12px !important;"><a class="glow2" href="checkout1.php?id={{x.event_id}}">{{x.event_title.length > '50' ? (x.event_title | limitTo:30) + ' ...' : x.event_title}}</a></h6>
                                                <hr>
                                                <p class="description">   
                                                    <span class="margin5 text-danger bold"><i class="fa fa-map-marker" aria-hidden="true">&nbsp;</i> {{x.venue_title}} <span ng-if="x.city != '' || NULL" style="background: #88C659;padding: 1px;border-radius: 4px;color: #fff;">&nbsp;{{x.city}}</span> </span>
                                                </p>
                                                <p class="description">
                                                    <span class="margin5 text-primary bold"><i class="fa fa-calendar" aria-hidden="true">&nbsp;</i> {{x.venue_start_date}} <span ng-hide="x.venue_end_date == null">-&nbsp;</span> {{x.venue_end_date}}</span>
                                                </p>
                                                <p class="description">
                                                    <span class="margin5 text-warning bold"><i class="fa fa-clock-o" aria-hidden="true">&nbsp;</i> {{x.venue_start_time}} <span ng-hide="x.venue_end_time == null">-&nbsp;</span> {{x.venue_end_time}}</span>
                                                </p>
                                            </div>
                                        </div>
                                        <!-- end card -->
                                    </div>
                                    <!--[single card ends]-->

                                    <div class="clearfix"></div>

                                    <!--[search loader stars]-->
                                    <div  class="col-md-12 col-sm-12" ng-if="loading == true"  style="">
                                        <div class="event-content">
                                            <h4 style="text-align: center;"><img src="./favicon/loading.gif"</h4>
                                        </div>
                                    </div>
                                    <div  class="col-md-12 col-sm-12" ng-if="searchResult.length == 0 && loading == false" style="">
                                        <div class="event-content">
                                            <h4 style="text-align: center;">Sorry! No Event Found. </h4>
                                        </div>
                                    </div>
                                    <!--[search loader ends]-->

                                    <!--[search go back button starts]-->
                                    <div  class="col-lg-2 col-md-2 col-sm-4 col-xs-12 col-lg-offset-5 col-md-offset-5 col-sm-offset-4 section-footer text-center section_padd60">
                                        <a href="javascript:void(0)" id="go_Back_From_search" class="btn btn-block success-rounded-outline waves-effect"><i class="fa fa-arrow-circle-o-down" aria-hidden="true"></i>&nbsp; GO Back!!</a>
                                    </div>
                                    <!--[search go back button ends]-->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--[search result panel ends]-->

                <div class="clearfix"></div>

                <!--[first look part start]-->
                <!--[galaxy1 [featured events, right sidebar banner] starts]-->
                <div class="container" id="c">
                    <div class="row">
                        <!--[Featured events starts]-->
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" >
                            <div class="panel panel-default panel-featured">

                                <!--[title starts]-->
                                <div class="panel-heading">
                                    <h1 class="panel-name h1-responsive">{{pnael_title}}<strong>{{pnael_titleStrong}} </strong>{{onlyMoreData}}</h1>
                                </div>
                                <!--[title ends]-->

                                <!--[panel body starts]-->
                                <div class="panel-body">
                                    <h4 class="panel-title h4-responsive padding-10">{{events_title}}</h4>
                                    <ul class="list-group" ng-repeat="x in eventsValue1| limitTo:7 ">
                                        <li class="list-group-item media">
                                            <div class="media-left">
                                                <a href="checkout1.php?id={{x.event_id}}">
                                                    <img class="media-object img-responsive" src="upload/event_web_logo/{{x.event_web_logo}}" alt="logo_missing" style="display: block; height: 120px; width: 120px;">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="event-title">
                                                    <b><a href="checkout1.php?id={{x.event_id}}" class="glow2">{{x.event_title}}</a></b>
                                                </div>
                                                <a href="checkout1.php?id={{x.event_id}}" class="btn btn-success-outline waves-effect pull-right hidden-xs">
                                                    <!--<i class="fa fa-cart-plus" aria-hidden="true">&nbsp;</i> {{x.btn_name}}-->
                                                    <i class="fa fa-cart-plus" aria-hidden="true">&nbsp;</i> Buy Now
                                                </a>
                                                <div class="event-detail">
                                                    <span class="text-danger margin5"><i aria-hidden="true" class="fa fa-map-marker">&nbsp;</i> {{x.venue_title}} <span ng-if="x.city != '' || NULL" style="background: #88C659;padding: 1px;border-radius: 4px;color: #fff;">&nbsp;{{x.city}}</span></span><br/>
                                                    <span class="text-primary margin5"><i aria-hidden="true" class="fa fa-calendar">&nbsp;</i> {{x.venue_start_date}} <span ng-hide="x.venue_end_date == null">-&nbsp;</span> {{x.venue_end_date}}</span><br/>
                                                    <span class="text-success margin5"><i aria-hidden="true" class="fa fa-clock-o">&nbsp;</i> {{x.venue_start_time}} <span ng-hide="x.venue_end_time == null">-&nbsp;</span> {{x.venue_end_time}}</span><br/>

<!--<a href="checkout1.php?id={{x.event_id}}" class="btn btn-info btn-xs btn-raised text-info waves-effect margin5 hidden-xs">{{more_info}} <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>-->
                                                    <a style="display:none;" href="javascript:void(0)" ng-click=" addToWishlist(x.event_id, 'event')"><span class="btn btn-danger btn-xs btn-raised hidden-xs"><i class="fa fa-heart" aria-hidden="true"></i> {{addTo_wishlist}}</span></a>
                                                </div>
                                            </div>
                                            <div class="clearfix visible-xs"></div>
                                            <div class="media-footer visible-xs">
                                                <a href="checkout1.php?id={{x.event_id}}" class="btn btn-success btn-sm btn-raised btn-block waves-effect margin5 visible-xs">
                                                    <i class="fa fa-cart-plus" aria-hidden="true">&nbsp;</i> {{btn_buy}}
                                                </a>
                                            </div>
                                        </li>
                                    </ul>  

                                    <!--[Sorry msg start]-->
                                    <ul  class="col-md-12 col-sm-12" ng-if="eventsValue1.length == 0" style="">
                                        <li class="event-content">
                                            <h4 class="panel-title h4-responsive padding-10" style="text-align: center;">Sorry! No Featured Event Found.</h4>
                                        </li>
                                    </ul>
                                    <!--[Sorry msg end]-->

                                </div>
                                <!--[panel body ends]-->

                                <!--[view all featured events button starts]-->
                                <div class="panel-footer text-center" ng-if="eventsValue1.length != 0">
                                    <a  href="javascript:void(0)" id="v"  class="btn btn-sm pf-btn waves-effect" ng-click="viewMoreData(<?php echo $_GET['page_id']; ?>, 'f')"><i class="fa fa-arrow-circle-o-down" aria-hidden="true">&nbsp;</i> {{btn_viewAllFeture}}</a>
                                </div>
                                <!--[view all featured events button ends]-->


                            </div>
                        </div>
                        <!--[Featured events ends]-->

                        <!--[right sidebar banner starts]-->
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 hidden-xs" ng-repeat="img in bannerValue1| limitTo: 4">
                            <a href="checkout1.php?id={{img.event_id}}" class="figure img-thumbnail z-depth-1">
                                <img src="upload/event_web_banner/{{img.event_web_banner}}"  class="figure-img img-fluid img-responsive"  style="height:300px; width:100% !important;" alt="image loading problem">
                            </a>
                        </div>
                        <!--[right sidebar banner ends]-->

                        <!--[Sorry msg start]-->
                        <div  class="col-lg-6 col-md-6 col-sm-12 col-xs-12 hidden-xs" ng-if="bannerValue1.length == 0"  style="">
                            <div class="panel panel-default panel-featured">

                                <!--[title starts]-->
                                <div class="panel-heading">
                                    <h1 class="panel-name h1-responsive">No Banner Found</h1>
                                </div>
                                <!--[title ends]-->

                            </div>
                        </div>
                        <!--[Sorry msg end]-->

                    </div>
                </div>
                <!--[galaxy1 [featured events, right sidebar banner] ends]-->

                <div class="clearfix"></div>

                <!--[galaxy2 [upcoming events, covered events] starts]-->
                <div class="container">
                    <div class="row">
                        <!--[Upcoming events starts]-->
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"  id="c2">
                            <div class="panel panel-default panel-upcoming">
                                <!--[title starts]-->
                                <div class="panel-heading">
                                    <h1 class="panel-name h1-responsive">{{pnael2_title}} <strong>{{pnael2_titleStrong}}</strong></h1>
                                </div>
                                <!--[title ends]-->

                                <!--[panel body starts]-->
                                <div class="panel-body">
                                    <h4 class="panel-title h4-responsive padding-10">{{up_commingEvents}}</h4>
                                    <ul class="list-group" ng-repeat="xs in eventsValue2| limitTo:5">
                                        <li class="list-group-item media">
                                            <div class="media-left">
                                                <a href="checkout1.php?up_id={{xs.event_id}}">
                                                    <img class="media-object img-responsive" src="upload/event_web_logo/{{xs.event_web_logo}}" alt="logo missing" style="display: block; height: 120px; width: 120px;">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="event-title">
                                                    <b><a href="checkout1.php?up_id={{xs.event_id}}" class="glow2">{{xs.event_title}}</a></b>
                                                </div>
                                                <a href="checkout1.php?up_id={{xs.event_id}}" class="btn btn-success-outline waves-effect pull-right hidden-xs"><i aria-hidden="true" class="fa fa-gg ">&nbsp;</i> {{btn_details}}</a>

                                                <div class="event-detail">
                                                    <span class="text-danger margin5"><i aria-hidden="true" class="fa fa-map-marker">&nbsp;</i> {{xs.venue_title}} <span ng-if="xs.city != '' || NULL" style="background: #88C659;padding: 1px;border-radius: 4px;color: #fff;">&nbsp;{{xs.city}}</span></span><br/>
                                                    <span class="text-primary margin5"><i aria-hidden="true" class="fa fa-calendar">&nbsp;</i> {{xs.venue_start_date}} <span ng-hide="xs.venue_end_date == null">-&nbsp;</span> {{xs.venue_end_date}}</span><br/>
                                                    <span class="text-success margin5"><i aria-hidden="true" class="fa fa-clock-o">&nbsp;</i> {{xs.venue_start_time}} <span ng-hide="xs.venue_end_time == null">-&nbsp;</span> {{xs.venue_end_time}}</span><br/>

<!--<a href="checkout1.php?up_id={{xs.event_id}}" class="btn btn-info btn-xs btn-raised text-info waves-effect margin5 hidden-xs">{{more_info}} <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>-->
                                                    <a style="display:none;" href="javascript:void(0)" ng-click=" addToWishlist(xs.event_id, 'event')"><span class="btn btn-danger btn-xs btn-raised hidden-xs"><i class="fa fa-heart" aria-hidden="true"></i> {{addTo_wishlist}}</span></a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>

                                    <!--[Sorry msg start]-->
                                    <ul  class="col-md-12 col-sm-12" ng-if="eventsValue2.length == 0" style="">
                                        <li class="event-content">
                                            <h4 class="panel-title h4-responsive padding-10" style="text-align: center;">Sorry! No Upcoming Event Found.</h4>
                                        </li>
                                    </ul>
                                    <!--[Sorry msg end]-->

                                </div>
                                <!--[panel body ends]-->

                                <!--[view all upcoming events button starts]-->
                                <div class="panel-footer text-center" ng-if="eventsValue2.length != 0">
                                    <a  href="javascript:void(0)" id="v2"  class="btn btn-sm pf-btn waves-effect" ng-click="viewMoreData(<?php echo $_GET['page_id']; ?>, 'up')"><i class="fa fa-arrow-circle-o-down" aria-hidden="true">&nbsp;</i> {{btn_viewAllUpcoming}}</a>
                                </div>
                                <!--[view all upcoming events button starts]-->

                            </div>
                        </div>
                        <!--[Upcoming events ends]-->

                        <!--[Covered events starts]-->
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" id="c3">
                            <div class="panel panel-default panel-covered">
                                <!--[title starts]-->
                                <div class="panel-heading">
                                    <h1 class="panel-name h1-responsive">{{pnael3_title}} <strong>{{pnael3_titleStrong}}</strong></h1>
                                </div>
                                <!--[title ends]-->

                                <!--[panel body starts]-->
                                <div class="panel-body">
                                    <h4 class="panel-title h4-responsive padding-10">{{panel3_text}}</h4>
                                    <ul class="list-group" ng-repeat="xss in eventsValue3| limitTo:1">
                                        <li class="list-group-item media">
                                            <div class="media-left">
                                                <a href="checkout1.php?c_id={{xss.event_id}}">
                                                    <img class="media-object img-responsive" src="upload/event_web_logo/{{xss.event_web_logo}}" alt="logo missing" style="display: block; height: 120px; width: 120px;">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="event-title">
                                                    <b><a href="checkout1.php?c_id={{xss.event_id}}" class="glow2">{{xss.event_title}}</a></b>
                                                </div>
                                                <a href="checkout1.php?c_id={{xss.event_id}}" class="btn btn-success-outline waves-effect pull-right hidden-xs"><i aria-hidden="true" class="fa fa-cart-plus">&nbsp;</i> View Details</a>

                                                <div class="event-detail">
                                                    <span class="text-danger margin5"><i aria-hidden="true" class="fa fa-map-marker">&nbsp;</i> {{xss.venue_title}} <span ng-if="xss.city != '' || NULL" style="background: #88C659;padding: 1px;border-radius: 4px;color: #fff;">&nbsp;{{xss.city}}</span></span><br/>

<!--<a href="checkout1.php?c_id={{xss.event_id}}" class="btn btn-info btn-xs btn-raised text-info waves-effect margin5 hidden-xs">{{more_info}} <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>-->
<!--<a style="display:none;" href="javascript:void(0);" ng-click=" addToWishlist(xss.event_id, 'event')"><span class="btn btn-danger btn-xs btn-raised hidden-xs"><i class="fa fa-heart" aria-hidden="true"></i> {{addTo_wishlist}}</span></a>-->
                                                </div>
                                            </div>

                                                            <!--<button class="btn btn-success-outline btn-sm btn-block waves-effect pull-right visible-xs"><i aria-hidden="true" class="fa fa-gg">&nbsp;</i> {{btn_details}}</button>-->
                                        </li>
                                    </ul>

                                    <!--[Sorry msg start]-->
                                    <ul  class="col-md-12 col-sm-12" ng-if="eventsValue3.length == 0" style="">
                                        <li class="event-content">
                                            <h4 class="panel-title h4-responsive padding-10" style="text-align: center;">Sorry! No Covered Event Found.</h4>
                                        </li>
                                    </ul>
                                    <!--[Sorry msg end]-->

                                </div>
                                <!--[panel body ends]-->

                                <!--[view all covered events button starts]-->
                                <div class="panel-footer text-center" ng-if="eventsValue3.length != 0">
                                    <a  href="javascript:void(0)" id="v3"  class="btn btn-sm pf-btn waves-effect" ng-click="viewMoreData(<?php echo $_GET['page_id']; ?>, 'c')"><i class="fa fa-arrow-circle-o-down" aria-hidden="true">&nbsp;</i> {{btn_viewAllCovered}}</a>
                                </div>
                                <!--[view all covered events button ends]-->
                            </div>
                        </div>
                        <!--[Covered events ends]-->
                    </div>
                </div>
                <!--[galaxy2 [upcoming events, covered events] ends]-->
                <!--[first look part ends]-->


                <!--[view all events[feature, upcoming and cover] starts]-->
                <div  style="display: none;" id="mo">
                    <div>
                        <div class="container">
                            <div class="row section_padd20 ">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-content section_padd30 animated wow fadeIn" data-wow-duration="1s" >
                                    <!--[single card starts]-->
                                    <div class="card-box col-md-3 col-sm-6 col-xs-12" ng-repeat="x in more">
                                        <div class="card" >
                                            <div class="header">
                                                <img alt="Sorry  Logo missing" class="ch-image" src="upload/event_web_logo/{{x.event_web_logo}}" />

                                                <div class="category">
                                                    <span class="category-label label label-info">{{x.event_type_tag}}</span>
                                                </div>

                                                <div class="actions">
                                                    <a href="checkout1.php?id={{x.event_id}}" class="btn btn-success btn-raised btn-round">
                                                        <i class="fa fa-cart-plus" aria-hidden="true">&nbsp;</i> {{x.btn_name}}
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
                                                <h6 class="title bold" style="font-size:12px !important;"><a class="glow2" href="checkout1.php?id={{x.event_id}}">{{x.event_title.length > '50' ? (x.event_title | limitTo:30) + ' ...' : x.event_title}}</a></h6>
                                                <hr>
                                                <p class="description">   
                                                    <span class="margin5 text-danger bold"><i class="fa fa-map-marker" aria-hidden="true">&nbsp;</i> {{x.venue_title}} <span ng-if="x.city != '' || NULL" style="background: #88C659;padding: 1px;border-radius: 4px;color: #fff;">&nbsp;{{x.city}}</span> </span>
                                                </p>
                                                <p class="description">
                                                    <span class="margin5 text-primary bold"><i class="fa fa-calendar" aria-hidden="true">&nbsp;</i> {{x.venue_start_date}} <span ng-hide="x.venue_end_date == null">-&nbsp;</span> {{x.venue_end_date}}</span>
                                                </p>
                                                <p class="description">
                                                    <span class="margin5 text-warning bold"><i class="fa fa-clock-o" aria-hidden="true">&nbsp;</i> {{x.venue_start_time}} <span ng-hide="x.venue_end_time == null">-&nbsp;</span> {{x.venue_end_time}}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--[single card ends]-->

                                    <!--[search moreloading stars]-->
                                    <div  class="col-md-12 col-sm-12" ng-if="moreloading == true"  style="">
                                        <div class="event-content">
                                            <h4 style="text-align: center;"><img src="./favicon/loading.gif"/></h4>
                                        </div>
                                    </div>
                                    <div  class="col-md-12 col-sm-12" ng-if="more.length == 0 && moreloading == false" style="">
                                        <div class="event-content">
                                            <h4 style="text-align: center;">Sorry! No Event Found.</h4>
                                        </div>
                                    </div>
                                    <!--[search moreloading ends]-->   
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--[go back button starts]-->
                    <div  class="col-lg-2 col-md-2 col-sm-4 col-xs-12 col-lg-offset-5 col-md-offset-5 col-sm-offset-4 section-footer text-center section_padd60">
                        <a href="javascript:void(0)" id="less" class="btn btn-block success-rounded-outline waves-effect"><i class="fa fa-arrow-circle-o-down" aria-hidden="true"></i>&nbsp; GO Back!!</a>
                    </div>
                    <!--[go back button ends]-->
                </div>   
                <!--[view all events[feature, upcoming and cover] ends]-->



                <!--                    <div ng-include="'events_search.php'"></div>-->
                <div class="clearfix"></div>
                <!-- ticketchai simple section starts here -->
                <div class="section section-simple-close">
                    <div class="container">
                        <div class="row section_padd60">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-heading"></div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-content section_padd30 text-center"></div>
                        </div>
                    </div>
                </div>


            </div>
            <!--[main content part starts]-->


            <?php include 'include/footer.php'; ?>

        </div>
        <!--[warpper class end]-->




        <?php echo $cms->fotterJs(array('events')); ?>
        <?php echo $cms->angularJs(array('events_angular')); ?>



        <script src="tc-merchant-template/assets/js/angular-scroll.js"></script>

        <script text="text/javascript">
                                        $(document).ready(function () {
                                        $("#autoclick").click();
                                        });
        </script>

        <script text="text/javascript">
            $(document).ready(function () {
            $("#autoclick2").click();
            });
        </script>

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
            });
        </script>
        <!--searchbar script-->

        <script>
            $(document).ready(function(){
            $('#v').click(function(){
            $('#c').hide();
            $('#c2').hide();
            $('#c3').hide();
            $('#mo').show();
            });
            //$('#search').click(function(){
//                    $('#mo').hide();
//                    $('#c').hide();
//                    $('#c2').hide();
//                    $('#c3').hide();
//                    window.scrollTo($('#s'), 1000);
//                    $('#searchEvent').show();

            // });
            $('#less').click(function(){
            window.scrollTo(0, 0);
//                    window.scrollTo($('#searchEvent'), 1000);
            $('#c').show();
            $('#c2').show();
            $('#c3').show();
            $('#mo').hide();
            $('#searchEvent').hide();
            });
            $('#go_Back_From_search').click(function(){
            window.scrollTo(0, 0);
            //window.scrollTo($('#search-nav'), 1000);
            $('#c').show();
            $('#c2').show();
            $('#c3').show();
            $('#mo').hide();
            $('#searchEvent').hide();
            });
            $('#v2').click(function(){
            $('#c').hide();
            $('#c2').hide();
            $('#c3').hide();
            $('#mo').show();
            });
            $('#v3').click(function(){
            $('#c').hide();
            $('#c2').hide();
            $('#c3').hide();
            $('#mo').show();
            });
            });</script>


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

            });</script>


        <!--[subscription modal js starts here]-->
        <script type="text/javascript">
            $(window).load(function(){
            $('#subscriptionModal').modal('show');
            });
            $('#subscriptionModal').on('show.bs.modal', function () {
            $('.wrapper').addClass('blur');
            });
            setTimeout(function (a) {
            $('#subscriptionModal').modal('hide');
            }, 5000);
            $('#subscriptionModal').on('hide.bs.modal', function () {
            $('.wrapper').removeClass('blur');
            });
        </script>
        <!--[subscription modal js ends here]-->
        
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
            }, 1000);</script>