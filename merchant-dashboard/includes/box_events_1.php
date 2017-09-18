<style type="text/css">
    .container-fluid, .event-list .container-card {
        margin-left: auto;
        margin-right: auto;
        padding-left: 15px;
        padding-right: 15px;
    }

    .section-topbar .event-tabs .tab-container {
        margin-bottom: 1px;
    }
    .tab-container {
        margin-bottom: 15px;
        position: relative;
    }


    .tab-container.tab-top.tab-moving-line.tabs-justified > ul, .tab-container.tab-top.tab-moving-line.tabs-justified > .scrolling-tab-wrap > ul {
        -moz-box-pack: center;
        display: flex;
        flex-flow: row wrap;
        justify-content: center;
    }
    .tab-container > ul.nav-tabs, .tab-container > .scrolling-tab-wrap > ul.nav-tabs {
        border: medium none;
    }


    .tab-container.tab-top.tab-moving-line.tabs-justified > ul > li, .tab-container.tab-top.tab-moving-line.tabs-justified > .scrolling-tab-wrap > ul > li {
        -moz-box-flex: 1;
        flex: 1 1 0;
        border-bottom: 5px #fff solid;
    }



    .tab-container.tab-top.tab-moving-line.tabs-justified > ul > li.active > a, .tab-container.tab-top.tab-moving-line.tabs-justified > .scrolling-tab-wrap > ul > li.active > a {
        transform: translate3d(0px, 2px, 0px);
    }
    .tab-container.tab-top.tab-moving-line.tabs-justified > ul > li > a, .tab-container.tab-top.tab-moving-line.tabs-justified > .scrolling-tab-wrap > ul > li > a {
        color: #333;
        overflow: visible !important;
        position: relative;
        text-decoration: none;
        transition: color 0.3s ease 0s, transform 0.3s ease 0s;

    }
    .tab-container > ul.nav-tabs > li.active > a, .tab-container > .scrolling-tab-wrap > ul.nav-tabs > li.active > a {
        border: medium none;
        color: #f00;
    }
    .tab-moving-line .nav-tabs > li.active > a, .tab-moving-line .nav-tabs > li.active > a:hover, .tab-moving-line .nav-tabs > li.active > a:focus {
        /*        border-bottom: 5px #f00 solid;*/
    }

    .tab-moving-line .nav-tabs > li.active > a:hover {
        /*        background-color: transparent;*/
        cursor: pointer;
    }

    .tab-container.tab-top > ul > li > a, .tab-container.tab-top > .scrolling-tab-wrap > ul > li > a {
        margin: 0;
        overflow: hidden;
        position: relative;
    }
    .tab-container > ul.nav-tabs > li > a, .tab-container > .scrolling-tab-wrap > ul.nav-tabs > li > a {
        border: medium none;
        border-radius: 0;
        color: #333;
        cursor: pointer;
        font-size: 16px;
        font-weight: 400 !important;
        letter-spacing: 1px;
        line-height: 2.4;
        padding: 10px 20px;
        text-align: center;

    }
    .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
        -moz-border-bottom-colors: none;
        -moz-border-left-colors: none;
        -moz-border-right-colors: none;
        -moz-border-top-colors: none;
        background-color: #fff;
        border-color: #ddd #ddd transparent;
        border-image: none;
        border-style: solid;
        border-width: 1px;
        color: #555;
        cursor: default;


    }

    .tab-container.tab-top.tab-moving-line.tab-primary > ul > li.active > a, .tab-container.tab-top.tab-moving-line.tab-primary > .scrolling-tab-wrap > ul > li.active > a {
        color: #d01c68;
    }



</style>    

<div class="container-fluid event-tabs" ng-init="loadAllActive(1)" >
    <div tabs="3" class="row filter tab-container tab-moving-line tab-top tab-primary tabs-justified">
        <ul  class="nav nav-tabs col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-12">
            <li ng-click="loadAllActive(1)"  ng-init="showEventsByDate = 'showUpcomingEvents'" ng-class="{'active': showEventsByDate == 'showUpcomingEvents', inactive: showEventsByDate != 'showUpcomingEvents'}" class="" style="">
                <a ng-click="showEventsByDate = 'showUpcomingEvents'" href="#"><div>Active Events</div></a>
            </li>
            <li ng-click="loadAllActive(2)" ng-class="{'active': showEventsByDate == 'showPastEvents', inactive: showEventsByDate != 'showPastEvents'}" class="" style="">
                <a ng-click="showEventsByDate = 'showPastEvents'" href="#"><div>Past Events</div></a>
            </li>
            <li ng-click="loadAllActive(3)" ng-class="{'active': showEventsByDate == 'showDrafts', inactive: showEventsByDate != 'showDrafts'}" class="">
                <a ng-click="showEventsByDate = 'showDrafts'" href="#"><div>Drafts</div></a>
            </li>
            <li ng-click="loadAllActive(4)" ng-class="{'active': showEventsByDate == 'showUpcoming', inactive: showEventsByDate != 'showUpcoming'}" class="">
                <a ng-click="showEventsByDate = 'showUpcoming'" href="#"><div>Upcoming</div></a>
            </li>
        </ul>
    </div>
</div>
<div class="card" style="background:none; box-shadow:none;" >


    <style type="text/css">

        .event-list .event-wrap .event {
            background: #fff none repeat scroll 0 0;
            border: 1px solid #ececec;
            border-radius: 3px;
            box-shadow: 2px 2px 5px #ececec;
            color: #333;
            display: block;
            margin-bottom: 35px;
            min-height: 100px;
            outline: 0 none;
            text-decoration: none;
        }

        .event-list .event-wrap .event img {
            height: 210px;
            width: 100%;
        }
        .img-responsive {
            display: block;
            height: auto;
            max-width: 100%;
        }
        img {
            vertical-align: middle;
        }
        img {
            border: 0 none;
        }
        * {
            box-sizing: border-box;
        }

        .event-list .event-wrap .event .event-content {
            height: 185px;
            padding: 20px;
        }

        .event-list .event-wrap .event {
            color: #333;
        }

        .event-list .event-wrap .event .event-content h4 {
            height: 56px;
            line-height: 1.6;
            margin-top: 0;
            text-align: left;
        }
        h4, .h4 {
            font-size: 18px;
        }
        h4, .h4, h5, .h5, h6, .h6 {
            margin-bottom: 10px;
            margin-top: 10px;
        }
        h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
            color: inherit;
            font-family: inherit;
            font-weight: 500;
            line-height: 1.1;
        }

        .event-list .event-wrap .event .event-content .venue, .event-list .event-wrap .event .event-content .date-and-time {
            color: #999;
            font-size: 11px;
            font-weight: 400;
            letter-spacing: 0.4px;
            line-height: 1.8;
            text-transform: uppercase;
        }



        .event-list .event-wrap .event .event-content .venue span, .event-list .event-wrap .event .event-content .date-and-time span {
            display: inline-block;
        }

        .event-list .event-wrap .event .event-content .row {
            margin-top: 20px;
        }

        .status-label.live {
            border-color: #6ccf49;
            color: #6ccf49;
            background: #fff;
        }
        .status-label {
            border: 1px solid;
            border-radius: 2px;
            font-size: 10px;
            padding: 3px 5px;
            text-transform: uppercase;
        }
    </style>
    <form class="step-content">
        <div class="event-list">
            <div  class="container-card">


                <div class="row event-wrap">
                    
                    <!-- ngRepeat: event in filteredData=(data | eventFilter: showEventsByDate) -->
                    <div  class="col-md-4 col-sm-6" ng-repeat="evtin in eventsdata" style="">
                        <a target="_parent" href="e/private-conference-302220" title="private Conference" class="event" href="e/private-conference-302220">
                            <!-- ngIf: event.s3ImageName != undefined -->
                            <!-- ngIf: event.s3ImageName == undefined --><img alt="" class="img-responsive" src="assets/img/background/background-6.jpg"><!-- end ngIf: event.s3ImageName == undefined -->
                            <div class="event-content">
                                <h4>{{ evtin.event_title }}</h4>
                                <div class="venue">
                                    <span  class="ng-binding">Dhaka</span>
                                </div>
                                <div class="date-and-time">
                                    <span  class="ng-binding">20 Dec 2016: 5:00PM - 6:00 PM</span>
                                </div>
                                <div class="row">
                                    <div title="Clone Event" class="col-xs-5" style="color: #999;
                                         font-size: 11px;
                                         font-weight: 400;
                                         letter-spacing: 0.4px;
                                         line-height: 1.8;
                                         text-transform: uppercase;">
                                        <i   class="fa fa-clone hidden-xs"></i> Clone
                                    </div>
                                    <div class="col-xs-7">
                                        <span  class="status-label live">LIVE</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div  class="col-md-12 col-sm-12" ng-if="loading==true"  style="">
                        
                            <!-- ngIf: event.s3ImageName != undefined -->
                            <!-- ngIf: event.s3ImageName == undefined --><!-- end ngIf: event.s3ImageName == undefined -->
                            <div class="event-content">
                                <h4 style="text-align: center;"><img src="../favicon/loading.gif"</h4>
                            </div>
                       
                    </div>
                    <div  class="col-md-12 col-sm-12" ng-if="eventsdata.length==0 && loading==false" style="">
                        
                            <!-- ngIf: event.s3ImageName != undefined -->
                            <!-- ngIf: event.s3ImageName == undefined --><!-- end ngIf: event.s3ImageName == undefined -->
                            <div class="event-content">
                                <h4 style="text-align: center;">No Event Found, <span><a href="./create_event_journey.php" class="btn btn-info active">Create New Event</a></span></h4>
                            </div>
                       
                    </div>
                    
                    <!-- end ngRepeat: event in filteredData=(data | eventFilter: showEventsByDate) -->
                    

                    <!-- end ngRepeat: event in filteredData=(data | eventFilter: showEventsByDate) -->

                    
                    <!-- end ngRepeat: event in filteredData=(data | eventFilter: showEventsByDate) -->
                </div>

            </div>





            <div class="clearfix"></div>
        </div>
    </form>
</div>
