<?php
include './cms/plugin.php';
$cms = new plugin();
?>




<div class="section section-featured">
    <div class="container">
        <div class="row section_padd30 ">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-heading animated wow fadeIn" data-wow-duration="1s" data-wow-delay="0.02s">
                <h2><span class="section-topic">Upcoming</span> Events</h2>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-content section_padd30 animated wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.02s" id="social-reveal">
                <!-- single card starts -->
                <div class="card-box col-md-3 col-sm-6 col-xs-12" ng-repeat="ux in u| limitTo:4">
                    <!--Card-->
                    <!--Collection card-->
                    <div class="card collection-card" >
                        <!--Card image-->
                        <div class="view  hm-zoom" >
                            <img src="upload/event_web_logo/{{ux.event_web_logo}}" class="img-fluid mdbpc-img" alt="">
                            <div class="stripe dark" >
                                <h6 class="title bold"><a href="#" class="glow txt_sdw2">{{ux.event_title}}</a></h6>
                                <a href="event_tickets.php?up_id={{ux.event_id}}" class="btn btn-success btn-raised btn-round waves-effect txt-white">More Info <i class="fa fa-chevron-right"></i></a>
                            </div>
                        </div>
                        <!--/.Card image-->
                    </div>
                    <!--/.Collection card-->
                    <!--/.Card-->
                </div>
                <!-- single card ends -->
            </div>
            <div class="clearfix"></div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 col-lg-offset-5 col-md-offset-5 col-sm-offset-4 section-footer text-center section_padd60">
                <a href="more_upcoming_events.php"><button type="button" class="btn btn-block success-rounded-outline waves-effect"><i class="fa fa-arrow-circle-o-down" aria-hidden="true">&nbsp;</i> View More</button></a>
            </div>
        </div>
    </div>
</div>