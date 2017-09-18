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
    <div tabs="4" class="row filter tab-container tab-moving-line tab-top tab-primary tabs-justified">
        <ul  class="nav nav-tabs col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-12">
            <li ng-click="loadAllActive(1)"  ng-init="showEventsByDate = 'showUpcomingEvents'" ng-class="{
                    'active'
                            : showEventsByDate ==  'showUpcomingEvents', inactive: showEventsByDate != 'showUpcomingEvents'}" class="" style="">
                <a ng-click="showEventsByDate = 'showUpcomingEvents'" href="#"><div>Active Events</div></a>
            </li>
            <li ng-click="loadAllActive(2)" ng-class="{
                    'active'
                            : showEventsByDate == 'showPastEvents', inactive: showEventsByDate != 'showPastEvents'}" class="" style="">
                <a ng-click="showEventsByDate = 'showPastEvents'" href="#"><div>Past Events</div></a>
            </li>
            <li ng-click="loadAllActive(3)" ng-class="{
                    'active'
                            : showEventsByDate == 'showDrafts', inactive: showEventsByDate != 'showDrafts'}" class="">
                <a ng-click="showEventsByDate = 'showDrafts'" href="#"><div>Drafts</div></a>
            </li>
            <li ng-click="loadAllActive(4)" ng-class="{
                    'active'
                            : showEventsByDate == 'showUpcoming', inactive: showEventsByDate != 'showUpcoming'}" class="">
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
            height: auto;
            padding: 10px;
        }

        .event-list .event-wrap .event {
            color: #333;
        }

        .event-list .event-wrap .event .event-content h4 {
            line-height: 1.6;
            margin-top: 0;
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
            margin-top: 10px;
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

        /* Ribbon Started From Here */

        .ribbon {
            position: absolute;
            top: 3px;
            left: -5px;
            padding: 15px;
        }
        .ribbon-content{
            position: relative; 
            width: 98%; 
            height: 60px;  

        }
        .ribbon.base {
            background: #3498db;
            color: #fff;
            border-left: 5px solid #8bc4ea;
        }
        .ribbon.light {
            background: #ecf0f1;
            color: #2c3e50;
            border-left: 5px solid #dde4e6;
        }
        .ribbon.dark {
            background: #131313;
            color: #fff;
            border-left: 5px solid #464646;
        }
        .ribbon.base-alt {
            /*            background: #9cd70e;*/
                       background: #87CB16 !important;
                        background: -moz-linear-gradient(top, #87CB16 0%, rgba(109, 192, 48, 0.7) 100%) !important;
                        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #87CB16), color-stop(100%, rgba(109, 192, 48, 0.7))) !important;
                        background: -webkit-linear-gradient(top, #87CB16 0%, rgba(109, 192, 48, 0.7) 100%) !important;
                        background: -o-linear-gradient(top, #87CB16 0%, rgba(109, 192, 48, 0.7) 100%) !important;
                        background: -ms-linear-gradient(top, #87CB16 0%, rgba(109, 192, 48, 0.7) 100%) !important;
                        background: linear-gradient(to bottom, #87CB16 0%, rgba(109, 192, 48, 0.7) 100%) !important;
                        background-size: 150% 150% !important;
            color: #fff;
            border-left: 5px solid #c6f457;
            /*            -webkit-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
                        -moz-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
                        box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);*/
        }
        .ribbon.red {
            background: #e91b23;
            color: #fff;
            border-left: 5px solid #f2787d;
        }
        .ribbon.orange {
            background: #ff8a3c;
            color: #fff;
            border-left: 5px solid #ffc7a2;
        }
        .ribbon.yellow {
            background: #ffd800;
            color: #fff;
            border-left: 5px solid #ffe866;
        }
        .ribbon:before, .ribbon:after {
            content: '';
            position: absolute;
            right: -9px;
            border-right: 10px solid transparent;
        }
        .ribbon:before {
            top: 0;
        }
        .ribbon:after {
            bottom: 0;
        }
        .ribbon.base:before {
            border-top: 27px solid #3498db;
        }
        .ribbon.base:after {
            border-bottom: 27px solid #3498db;
        }
        .ribbon.light:before {
            border-top: 27px solid #ecf0f1;
        }
        .ribbon.light:after {
            border-bottom: 27px solid #ecf0f1;
        }
        .ribbon.dark:before {
            border-top: 27px solid #131313;
        }
        .ribbon.dark:after {
            border-bottom: 27px solid #131313;
        }
        .ribbon.base-alt:before {
            border-top: 27px solid #9cd70e;
        }
        .ribbon.base-alt:after {
            border-bottom: 27px solid #9cd70e;
        }
        .ribbon.red:before {
            border-top: 27px solid #e91b23;
        }
        .ribbon.red:after {
            border-bottom: 27px solid #e91b23;
        }
        .ribbon.orange:before {
            border-top: 27px solid #ff8a3c;
        }
        .ribbon.orange:after {
            border-bottom: 27px solid #ff8a3c;
        }
        .ribbon.yellow:before {
            border-top: 27px solid #ffd800;
        }
        .ribbon.yellow:after {
            border-bottom: 27px solid #ffd800;
        }
        .ribbon span {
            display: block;
            font-size: 16px;
            font-weight: 600;
        }
        /* Ribbon End From Here */

        /* ribbon head corner css */

        /* ribbon head corner css */
        .box_corner_ribbon {
            width:200px;height:300px;
            position:relative;
            border:1px solid #BBB;
            background:#eee;
            float:left;
            margin:20px
        }
        .ribbon_corner {
            position: absolute;
            right: 12px; top: -5px;
            z-index: 1;
            overflow: hidden;
            width: 75px; height: 75px; 
            text-align: right;
            text-transform: capitalize;
        }
        .ribbon_corner span {
            font-size: 10px;
            color: #fff; 
            text-transform: uppercase; 
            text-align: center;
            font-weight: bold; line-height: 20px;
            transform: rotate(45deg);
            width: 100px; display: block;
            background: #79A70A;
            background: linear-gradient(#9BC90D 0%, #79A70A 100%);
            box-shadow: 0 3px 10px -5px rgba(0, 0, 0, 1);
            position: absolute;
            top: 19px; right: -21px;
        }
        .ribbon_corner span::before {
            content: '';
            position: absolute; 
            left: 0px; top: 100%;
            z-index: -1;
            border-left: 3px solid #79A70A;
            border-right: 3px solid transparent;
            border-bottom: 3px solid transparent;
            border-top: 3px solid #79A70A;
        }
        .ribbon_corner span::after {
            content: '';
            position: absolute; 
            right: 0%; top: 100%;
            z-index: -1;
            border-right: 3px solid #79A70A;
            border-left: 3px solid transparent;
            border-bottom: 3px solid transparent;
            border-top: 3px solid #79A70A;
        }
        .red_corner span {background: linear-gradient(#F70505 0%, #8F0808 100%);}
        .red_corner span::before {border-left-color: #8F0808; border-top-color: #8F0808;}
        .red_corner span::after {border-right-color: #8F0808; border-top-color: #8F0808;}

        .blue_corner span {background: linear-gradient(#2989d8 0%, #1e5799 100%);}
        .blue_corner span::before {border-left-color: #1e5799; border-top-color: #1e5799;}
        .blue_corner span::after {border-right-color: #1e5799; border-top-color: #1e5799;}

        /* ribbon head corner css */ 
    </style>
    <form class="step-content">
        <div class="event-list">
            <div  class="container-card">


                <div class="row event-wrap">

                    <!-- ngRepeat: event in filteredData=(data | eventFilter: showEventsByDate) -->
                    <div  class="col-md-4 col-sm-6 col-xs-12" ng-repeat="evtin in eventsdata" style="">
                        <div  title="{{ evtin.event_title}}" class="event">

                            <div class="ribbon_corner {{ params_bg}}">
                                <a href="change_event_status.php?eid={{ evtin.event_id}}"><span>{{ params}}</span></a>
                            </div>

                            <!-- ngIf: event.s3ImageName != undefined -->
                            <!-- ngIf: event.s3ImageName == undefined --><!-- end ngIf: event.s3ImageName == undefined -->
                            <div class="event-content">
                                <h4 class="text-left"><span class="text-danger">EVENT ID :</span> {{ evtin.event_id}}</h4>
                                <div class="date-and-time">
                                    <span  class="ng-binding"><i class="fa fa-calendar"></i> {{ evtin.event_created_on}} - {{ evtin.event_created_end}}</span>
                                </div>
                                <div class="venue">
                                    <span  class="ng-binding"><i class="fa fa-map-marker"></i> {{ evtin.venue}}</span>
                                </div>
                            </div>
                            <a href=".././checkout1.php?id={{evtin.event_id}}">
                            <div class="ribbon-content">
                                <div class="ribbon base-alt col-md-12 col-sm-12 col-xs-12"><span>{{ evtin.event_title}}</span></div>
                            </div>
                            </a>
                            <div class="event-content" style="border-bottom: 1px #ddd solid;">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h4 class="text-center">Ticket Sold</h4>
                                        <h4 class="text-center">{{ evtin.ticket_sold}}</h4>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h4 class="text-center">Total Sales</h4>
                                        <h4 class="text-center">{{ evtin.total_sales}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="event-content">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6 text-left">
                                        <a href="dashboard.php?dsh={{ evtin.event_id}}"><h5 class="text-info"><i class="fa fa-dashboard"></i> <span> Dashboard</span></h5></a>

                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                        <a href="order_list.php?evtId={{ evtin.event_id}}"><h5 class="text-inverse"><i class="fa fa-dashboard"></i> <span> Order-List</span></h5></a>

                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6 text-left">
                                        <a href=".././checkout1.php?id={{evtin.event_id}}"><h5 class="text-success"><i class="fa fa-eye-slash"></i> <span> Preview</span></h5></a>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                        <a href="reports_1.php?rpt={{ evtin.event_id}}"><h5 class="text-warning"><i class="fa fa-pie-chart"></i> <span> Reports</span></h5></a>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-md-6 col-sm-6 col-xs-6 text-left">
                                        
                                        <a ng-if="evtin.event_status=='active'" href="#" ng-click="publishUnPublish(evtin.event_status,evtin.event_id)"><h5 class="text-danger"><i class="fa fa-firefox"></i> <span>UnPublish</span></h5></a>
                                        <a ng-if="evtin.event_status !='active'" href="#" ng-click="publishUnPublish(evtin.event_status,evtin.event_id)"><h5 class="text-danger"><i class="fa fa-firefox"></i> <span> Publish</span></h5></a>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                        <a href="clone_event.php?eid={{evtin.event_id}}"><h5 class="text-primary"><i class="fa fa-clone"></i> <span> Clone</span></h5></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!--small loader-->
                    <div  class="col-md-12 col-sm-12" ng-if="loading == true"  style="">

                        <!-- ngIf: event.s3ImageName != undefined -->
                        <!-- ngIf: event.s3ImageName == undefined --><!-- end ngIf: event.s3ImageName == undefined -->
                        <div class="event-content">
                            <h4 style="text-align: center;"><img src="../favicon/loading.gif"</h4>
                        </div>

                    </div>
                    <div  class="col-md-12 col-sm-12" ng-if="eventsdata.length == 0 && loading == false" style="">

                        <!-- ngIf: event.s3ImageName != undefined -->
                        <!-- ngIf: event.s3ImageName == undefined --><!-- end ngIf: event.s3ImageName == undefined -->
                        <div class="event-content">
                            <h4 style="text-align: center;">No Event Found, <span><a href="./create_event_journey.php" class="btn btn-info active">Create New Event</a></span></h4>
                        </div>

                    </div>
                    <!--small loader-->
                    <!-- end ngRepeat: event in filteredData=(data | eventFilter: showEventsByDate) -->


                    <!-- end ngRepeat: event in filteredData=(data | eventFilter: showEventsByDate) -->


                    <!-- end ngRepeat: event in filteredData=(data | eventFilter: showEventsByDate) -->
                </div>

            </div>





            <div class="clearfix"></div>
        </div>
    </form>
</div>
